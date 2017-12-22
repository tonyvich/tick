<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;
use App\User;

class Project extends Model
{
    public function tasks ( $column = 'name', $type = 'asc' ) 
    {
        return $this->hasMany( Task::class )->orderBy( $column, $type );
    }

    public function User()
    {
        return $this->belongsTo( User::class );
    }

    public function assignee(){
        return $this->belongsTo( User::class, 'assigned_to' );
    }

    public function check_author( $author )
    {
        return ( $this->user_id != $author ) ? false : true; 
    }

}
