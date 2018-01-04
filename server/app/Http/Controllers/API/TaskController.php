<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use App\Project;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SubmitTaskRequest;

class TaskController extends Controller
{

/**
 * create
 * ( Create a task )
 * @return \Illuminate\Response
 */
    public function create( SubmitTaskRequest $request )
    {
        // Create task object
        $task = new Task;
        $task->user_id       = Auth::id();
        $task->project_id    = $request->input( 'project_id' );
        $task->name          = $request->input( 'name' );
        $task->description   = $request->input( 'description' );
        $task->ends_at       = $request->input( 'ends_at' );
        $task->scheduled     = !empty( $request->input( 'ends_at' ) );

        // Check if the current user can add task to the project
        $project = Project::find( $task->project_id );
        if( $project->check_author( Auth::id() ) )
        {
            // Save task
            if ( $task->save() ) {
                return response()->json( $this->successArray, $this->successStatus );  
            } else {
                return response()->json( $this->errorArray, $this->errorStatus );
            }
        } 
        else 
        {
            return response()->json( $this->errorArray, $this->unauthorizedStatus );
        }
    }

/**
 * update
 * ( Modify the task )
 * @return \Illuminate\Response
 */
    public function update( SubmitTaskRequest $request )
    {
        if( Task::where( 'id', $request->input( 'id' ) )->exists() )
        {
            $task = Task::find( $request->input( 'id' ) );
            if( $task->check_can_edit( Auth::id() ) )
            {
                $task->name          = $request->input( 'name' );
                $task->description   = $request->input( 'description' );
                $task->ends_at       = $request->input( 'ends_at' );
                $task->deleted       = $request->input( 'deleted' );
                $task->scheduled     = !empty( $request->input( 'ends_at' ) );

                if ( $task->save() ) {
                    return response()->json( $this->successArray, $this->successStatus );  
                } else {
                    return response()->json( $this->errorArray, $this->errorStatus );
                }
            } 
            else 
            {
                return response()->json( $errorArray, $this->unauthorizedStatus );
            }            
        } else {
            return response()->json( $errorArray, $this->notFoundStatus );
        } 
    }

/**
 * Completed
 * ( Set task to completed )
 * @return \Illuminate\Response
 */
    public function completed( $id )
    {
        $task = Task::find( $id );
        if( Task::where( 'id', $id )->exists() ){
            if( $task->check_can_complete( Auth::id() ) )
            {
                if( $task->completed( Auth::id() ) )
                {
                    return response()->json( $this->successArray, $this->successStatus );
                } else {
                    return response()->json( $this->errorArray, $this->errorStatus );
                }
            } else {
                return response()->json( $errorArray, $this->unauthorizedStatus );
            }
        } else {
            return response()->json( $errorArray, $this->notFoundStatus );
        }
    }

/**
 * UnCompleted
 * ( Set task to not completed )
 * @return \Illuminate\Response
 */
    public function uncompleted( $id )
    {
        $task = Task::find( $id );
        if( Task::where( 'id', $id )->exists() ){
            if( $task->check_can_complete( Auth::id() ) )
            {
                if( $task->uncompleted() )
                {
                    return response()->json( $this->successArray, $this->successStatus );
                } else {
                    return response()->json( $this->errorArray, $this->errorStatus );
                }
            } else {
                return response()->json( $errorArray, $this->unauthorizedStatus );
            }
        } else {
            return response()->json( $errorArray, $this->notFoundStatus );
        }
    }

}