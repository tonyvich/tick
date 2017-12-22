<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SubmitUserRequest;

class UserController extends Controller
{

/**
 * login api
 *
 * @return \Illuminate\Http\Response
**/

    public function login()
    {
        if( Auth::attempt(['email' => request('email'), 'password' => request('password')] ))
        {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } 
        else 
        {
            return response()->json(['error'=>'Unauthorised'], 401);
        }   
    }

    
/**
 * Register api
 *
 * @return \Illuminate\Http\Response
**/

    public function register( SubmitUserRequest $request)
    {
        // Saving user
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        
        return response()->json(['success'=>$success], $this->successStatus);
    }

/**
 * details api
 *
 * @return \Illuminate\Http\Response
**/

    public function details()
    {
        $user = Auth::user();
        return response()->json([ 'user' => $user ], $this->successStatus);
    }
/**
 * User List API
 * @return \Illuminate\Http\Response
 */
    public function users(){
        return response()->json(
            [ 'users' => User::all() ],
            $this->successStatus
        );
    }

/**
 * Password edit api
 * @param request
 * @return \Illuminate\Http\Response
**/

    public function password_edit( SubmitUserRequest $request )
    {
        $user = User::find( $request->input( 'id' ) );
        if( $user->id == Auth::id() )
        {
            $user->password = $request->input( 'password' );
            if( $user->save() ){
                return response()->json( $this->successArray, $this->successStatus );
            } else {
                return response()->json( $this->errorArray, $this->errorStatus );
            }
        } else {
            return response()->json( $this->errorArray, $this->unauthorizedStatus );
        }
    }

/**
 * Role edit api
 * @param request
 * @return \Illuminate\Http\Response
**/
    public function role_edit( Request $request )
    {
        if( Auth::user()[ 'role' ] == 'admin' )
        {
            $user = User::find( $request->input( 'id' ) );
            $user->role = $request->input( 'role' );
            if( $user->save() ){
                return response()->json( $this->successArray, $this->successStatus );
            } else {
                return response()->json( $this->errorArray, $this->errorStatus );
            }
        } else {
            return response()->json( $this->errorArray, $this->unauthorizedStatus );
        }
    }

}