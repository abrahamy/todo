<?php

namespace abrahamy\Todo;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'category_id',
        'description',
        'done'
    ];

    /**
     * Get the category of a task.
     */
    public function category()
    {
        return $this->belongsTo('abrahamy\Todo\Category');
    }
}
