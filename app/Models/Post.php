<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;


class Post extends Model
{
    use HasFactory;
    use HasTrixRichText;

    protected $table    = 'posts';
    public $primary_key = 'id';
    protected $guarded = [];

}
