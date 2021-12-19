<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;

class Direction extends Model
{
    use AsSource, Filterable, Attachable;
    use HasFactory;
    public $timestamps = false;
}
