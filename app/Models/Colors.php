<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Projects;

class Colors extends Model
{
    protected $fillable = [
        'name',
        'hex'
    ];
    
    public function projects()
    {
        return $this->belongsToMany('Projects');
    }
}
