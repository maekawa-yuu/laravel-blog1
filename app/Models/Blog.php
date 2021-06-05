<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    // テーブル名
    protected $table = 'blogs';

    protected $fillable =
    [
        'title',
        'content'
    ];
}
