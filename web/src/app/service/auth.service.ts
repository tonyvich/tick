import { Injectable } from '@angular/core';
import { Http, URLSearchParams, Headers, RequestOptions, Response } from '@angular/http';
import { Router } from '@angular/router';
import { UserService } from './user.service';

@Injectable()
export class AuthService {

  private serverUrl = "http://localhost/tick_master_angular/server/public/api";                    // Url of the laravel server 

  constructor( private http:Http, private router:Router, private userService:UserService ) {} 

/**
 * Login
 * @param credentials 
 */
  login( credentials )
  {
    // Populating request body
    let body = new URLSearchParams;
    Object.entries( credentials ).forEach(
      ([key, value]) => body.set( key, value )
    );
    // Creating request options
    let headers = new Headers;
    headers.append( 'Content-Type', 'application/x-www-form-urlencoded' );
    headers.append( 'X-Requested-With', 'XMLHttpRequest' );
    let options = new RequestOptions({ headers : headers });
    // Send request
    return this.http.post( this.serverUrl + "/login", body.toString(), options );
  }

/**
 * Logout method 
 */
  logout() {
    localStorage.removeItem( 'token' );
    localStorage.removeItem( 'role' );
    this.router.navigate( ['/login'] );
  }

/**
 * isLoggedIn
 * @returns boolean 
 */
  isLoggedIn() {
    let token = localStorage.getItem( 'token' );
    if( token )
      return true;
    else 
      return false;
  }

  /**
   * isAdmin
   * @returns boolean
   */

  isAdmin() {
    let role = localStorage.getItem('role');
    if( role == "admin" )
      return true;
  }
}
