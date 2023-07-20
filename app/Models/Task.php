<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;
use EloquentFilter\Filterable;

class Task extends Model
{
    use HasFactory;
    use HasTags;
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'todo_list',
        'thumbnail',
        'image',
        'completed'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['tags:name'];

    public static function new($title, $list)
    {
        return static::create([
            'title' => $title,
            'todo_list' => $list
        ]);
    }

    public function updateImage($thumbnail, $image)
    {
        $this->thumbnail = $thumbnail;
        $this->image = $image;

        return $this->save();
    }

    public function list()
    {
        return $this->belongsTo(TodoList::class, 'todo_list');
    }
}
