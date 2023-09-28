<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use App\Services\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'place',
        'date',
        'period',
        'period_type'
    ];

    protected function date(): Attribute
    {

        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d.m.Y'),
        );
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->title . ' ' . $this->place
        );
    }


    protected function periodType(): Attribute
    {
        return Attribute::make(
            set: fn () => Helper::calculatePeriodFromNow(new DateTime($this->date))['type']
        );
    }

    protected function period(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Helper::getPeriodPhrase($this->period_type, $value),
            set: fn () => Helper::calculatePeriodFromNow(new DateTime($this->date))['value']
        );
    }

   
}
