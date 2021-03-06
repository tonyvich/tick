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

    public function login( Request $request )
    {
        if( Auth::attempt([ 'email' => $request->input( 'username' ), 'password' => $request->input( 'password' )] ))
        {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } 
        else 
        {
            return response()->json([ 'error' => $request->input( 'username' ) ], 401);
        }   
    }

    
/**
 * Register api
 *
 * @return \Illuminate\Http\Response
**/

    public function register( SubmitUserRequest $request)
    {
        // Checking if first register 
        $userCount = User::count();
        if( $userCount == 0){
            $role = 'admin'; // Default admin role for the first user
        } else  {
            $role = 'subordinate'; // Default subordinate role for others
        }

        // Saving user
        $input = $request->all();
        $input[ 'role' ] = $role;
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
            [ 'users' => User::where( 'id','<>', 1)->get() ],
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