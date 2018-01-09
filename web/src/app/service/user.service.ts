import { Injectable } from '@angular/core';
import { Http, RequestOptions, Headers, URLSearchParams } from '@angular/http';

@Injectable()
export class UserService {

  private serverUrl = "http://localhost/tick_master_angular/server/public/api";                    // Url of the laravel server
  private options
  
  constructor( private http:Http ) { 
    // Getting current users token
    let token = localStorage.getItem( 'token' );
    // Setting Headers
    let headers = new Headers;
    headers.append( 'Accept', 'application/json' );
    headers.append( 'Authorization', 'Bearer ' + token );
    // Headers for creating and updating
    headers.append( 'Content-Type', "application/x-www-form-urlencoded" );
    headers.append( 'X-Requested-With', 'XMLHttpRequest' );
    // Creating request options
    this.options = new RequestOptions({ headers : headers });
  }

  /**
   * Get users
   */
  users(){
    return this.http.get( this.serverUrl + "/users", this.options );
  }

  /**
   * Get Current User
   */
  currentUser(){
    return this.http.get( this.serverUrl + "/details", this.options );
  }

  createUser( user ){
    // Populating the request body
    let body = new URLSearchParams
    Object.entries( user ).forEach(
      ([key, value]) => body.set( key, value )
    );
    // Sending the request
    return this.http.post( this.serverUrl + "/register", body.toString(), this.options );
  }

  /**
   * Edit password
   * @param user
   */
  editPassword( user )
  {
    // Populating the request body
    let body = new URLSearchParams
    Object.entries( user ).forEach(
      ([key, value]) => body.set( key, value )
    );
    // Sending the request
    return this.http.put( this.serverUrl + "/password_edit", body.toString(), this.options );
  }

  /**
   * editRole
   */
  editRole( user ){
    // Populating the request body
    let body = new URLSearchParams
    Object.entries( user ).forEach(
      ([key, value]) => body.set( key, value )
    );
    // Sending the request
    return this.http.put( this.serverUrl + "/role_edit", body.toString(), this.options );
  }
}
