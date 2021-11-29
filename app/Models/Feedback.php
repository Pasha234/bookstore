<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;


class Feedback extends Model
{
    protected $table = 'feedbacks';
    use AsSource, Filterable, Attachable;
    use HasFactory;
}
