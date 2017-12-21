<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Project;

class Task extends Model
{
    public function user()
    {
        return $this->belongsTo( User::class );
    }

    public function project()
    {
        return $this->belongsTo( Project::class );
    }

    /**
     * Completed
     * Mark task as completed
     * @return boolean
     */
    public function completed()
    {
        $this->completed = true;
        $this->completed_at = date( 'Y-m-d H:i:s' );
        return ( $this->save() ) ? true : false ;
    }

    /**
     * uncompleted
     * Set a completed task to not completed
     * @return boolean
     */
    public function uncompleted()
    {
        // Check if the task is already completed
        if ( $this->completed ){
            // Set completed task to not completd
            $this->completed = false;
            $this->completed_at = null;
            return ( $this->save() ) ? true : false ;
        } else {
            return 'not_completed';
        }
    }
    
}
