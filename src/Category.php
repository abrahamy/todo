<?php

namespace abrahamy\Todo;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    /**
     * Get all tasks of this category.
     */
    public function tasks()
    {
        return $this->hasMany('abrahamy\Todo\Task');
    }
}
