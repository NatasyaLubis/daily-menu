<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['tag_name', 'task_id'];

    public function tasks()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }
}
