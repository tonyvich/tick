<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;
use App\Folder;

class Project extends Model
{
    public function tasks ()
    {
        return $this->hasMany( Task::class );
    }

    public function User()
    {
        return $this->belongsTo( User::class );
    }

}
