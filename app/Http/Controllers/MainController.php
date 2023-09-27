<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        $event1 = new Event();
        $event1->title = 'test';
        // $event1->save();

        return view('main');
    }

    public function test(): string
    {

        

        // Cache::put('a', array_push(Cache::get('a'), '5'));

        // Cache::put('collection');

        return print_r(Cache::get('events'), true);
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect('/');
    }
}
