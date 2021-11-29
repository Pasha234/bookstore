<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;


class Offer_items extends Model
{
    use AsSource, Filterable, Attachable;
    use HasFactory;
    protected $table = 'offer_items';
}
