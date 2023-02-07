<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'budget', 'complete_status', 'delete_status', 'start_date', 'end_date', 's_id', 'c_id'
    ];
}
