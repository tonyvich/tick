<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SubmitProjectRequest;

class ProjectController extends Controller
{
/**
 * getUserProject
 * ( Return Current user projects )
 * @param column ( Column to order projects by )
 * @param order ( Order type )
 * @return \IlluminateHttp\Response
 */
    public function get_user_projects( $column = 'ends_at', $order = 'asc' )
    {
        $projects = Project::where( 'user_id', Auth::id() )->orderBy( $column , $order )->get();
        foreach( $projects as &$project )
        {
            $project[ 'tasks' ] = $project->tasks()->get();
        }
        return response()->json([
            'projects' =>  $projects
        ], $this->successStatus );
    }

/**
 * view 
 * ( Return project detail with project tasks )
 * @param id ( Project Id )
 * @param task_column ( Column to order task by ) 
 * @param task_order ( Order Type ) 
 * @return \Illuminate\Response
 */
    public function view( $id, $task_column = 'name', $task_order = 'asc' )
    {
        if( Project::where( 'id', $id )->exists() )
        {
            $project = Project::find( $id );
            return response()->json([
                    'project' => [
                        'project'   => $project,
                        'tasks'     => $project->tasks( $task_column, $task_order )->get(),
                        'assignee'  => $project->assignee()->first()
                    ]
                ],
                $this->successStatus
            );
        } 
        else 
        {
            return response()->json(
                $this->errorArray,
                $this->notFoundStatus
            );
        }
    }

/**
 * create
 * ( Create a project )
 * @param request
 * @return \Illuminate\Response
 */
    public function create( SubmitProjectRequest $request )
    {
        $project = new Project;
        $project->user_id       = Auth::id();
        $project->name          = $request->input( 'name' );
        $project->color         = $request->input( 'color' );
        $project->assigned_to   = $request->input( 'assigned_to' );
        $project->description   = $request->input( 'description' );
        $project->ends_at       = $request->input( 'ends_at' );

        if ( $project->save() ) {
            return response()->json( $this->successArray, $this->successStatus );  
        } else {
            return response()->json( $this->errorArray, $this->errorStatus );
        }
    }

/**
 * update
 * ( Modify the project )
 * @param request
 * @return \Illuminate\Response
 */
    public function update( SubmitProjectRequest $request )
    {
        if( Project::where( 'id', $request->input( 'id' ) )->exists() )
        {
            $project = Project::find( $request->input( 'id' ) );
            if( $project->check_author( Auth::id() ) )
            {
                $project->name          = $request->input( 'name' );
                $project->color         = $request->input( 'color' );
                $project->description   = $request->input( 'description' );
                $project->ends_at       = $request->input( 'ends_at' );
                $project->deleted       = $request->input( 'deleted' );
                $project->assigned_to   = $request->input( 'assigned_to' );

                if ( $project->save() ) {
                    return response()->json( $this->successArray, $this->successStatus );  
                } else {
                    return response()->json( $this->errorArray, $this->errorStatus );
                }
            } 
            else 
            {
                return response()->json( $this->errorArray, $this->unauthorizedStatus );
            }            
        } else {
            return response()->json( $this->errorArray, $this->notFoundStatus );
        } 
    }


}