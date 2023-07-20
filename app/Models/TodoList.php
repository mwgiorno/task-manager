<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'user'
    ];

    public static function new($title, $description, $user)
    {
        return static::create([
            'title' => $title,
            'description' => $description,
            'user' => $user
        ]);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'todo_list');
    }
}
