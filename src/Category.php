<?php

namespace abrahamy\Todo;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Get all tasks of this category.
     */
    public function tasks()
    {
        return $this->hasMany('abrahamy\Todo\Task');
    }
}
