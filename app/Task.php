<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'description',
        'deadline',
        'is_done',
        'priority'
    ];
    
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
