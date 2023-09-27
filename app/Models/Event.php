<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public ?string $title;
    public ?string $place;
    public ?DateTime $date;
    public ?int $period;
    public ?string $period_type;

}
