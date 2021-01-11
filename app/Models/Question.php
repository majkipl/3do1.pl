<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'answer_1', 'answer_2', 'answer_3', 'correct'];

    public $timestamps = false;
}
