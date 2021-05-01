<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoIng extends Model
{
    use HasFactory;

    protected $table = 'todoing';
    protected $fillable = ['id', 'titulo', 'user_id', 'created_at'];
    public $timestamps = false;
}
