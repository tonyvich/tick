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
     * Check can complete
     * ( Check if a user is the owner of a task or it's assigned )
     * @return boolean
     */
    public function check_can_complete( $author )
    {
        $project = $this->project()->first();
        if( $project->assigned_to != null ){
            return ( $project->assigned_to == $author ) ? true : false ; 
        } else {
            return ( $project->user_id == $author ) ? true : false ;
        }
    }

    /**
     * Check Author
     * ( Check if a user is the owner of a task and can edit )
     * @return boolean
     */
    public function check_can_edit( $author )
    {
        $project = $this->project()->first();
        return ( $project->user_id == $author ) ? true : false ;
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
        $this->completed_by = Auth::id();
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
            $this->completed_by = null;
            return ( $this->save() ) ? true : false ;
        } else {
            return 'not_completed';
        }
    }
    
}
