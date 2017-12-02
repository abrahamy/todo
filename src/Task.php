<?php

namespace abrahamy\Todo;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * Get the category of a task.
     */
    public function category()
    {
        return $this->belongsTo('abrahamy\Todo\Category');
    }
}
