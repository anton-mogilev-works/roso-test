<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessEvent;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function index(): View
    {       

        if(Cache::has('events')) {
            $events = Cache::get('events');
        }
        else {
            $events = Event::all();
            Cache::put('events', $events, now()->addMinutes(5));
        }

        return view('main', ['events' => $events]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|',
            'place' => 'required|',
            'date' => 'required|date_format:d.m.Y',

        ]);

        $events = Cache::get('events', function () {
            return Event::all();
        });

        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }

        $event = new Event();

        $event->title = $request->input('title');
        $event->place = $request->input('place');
        $event->date = Carbon::createFromFormat('d.m.Y', $request->input('date'));
        $event->fill(['period' => null, 'period_type' => null]);

        $event->save();

        ProcessEvent::dispatch($event);

        $events[] = $event;

        Cache::put('events', $events, now()->addMinutes(5));

        return redirect('/');
    }
}
