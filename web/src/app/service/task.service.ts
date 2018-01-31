import { Injectable } from '@angular/core';
import { Http, RequestOptions, Headers, URLSearchParams, Response } from '@angular/http';

@Injectable()
export class TaskService {

  private serverUrl = localStorage.getItem( 'config.server_url' );
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
   * save Task ( add a task to a project )
   * @param task,
   *
   */
  saveTask( task ) {
    // Populating the request body
    let body = new URLSearchParams
    Object.entries( task ).forEach(
      ([key, value]) => body.set( key, value )
    );
    // Sending the request
    return this.http.post( this.serverUrl + "/tasks", body.toString(), this.options );
  }

  /**
   * Complete task (Mark a task as completed )
   */
  completeTask( task_id ) {
    return this.http.put( this.serverUrl + "/complete_task/" + task_id, task_id, this.options );
  }

  /**
   * unComplete task (Mark a task as not completed )
   */
  uncompleteTask( task_id ) {
    return this.http.put( this.serverUrl + "/uncomplete_task/" + task_id, task_id, this.options );
  }

  /**
   * Update task (Mark a task as completed )
   */
  updateTask( task ) {
    // Populating the request body
    let body = new URLSearchParams
    Object.entries( task ).forEach(
      ([key, value]) => body.set( key, value )
    );
    // Sending the request
    return this.http.put( this.serverUrl + "/tasks/", body.toString(), this.options );
  }

}
