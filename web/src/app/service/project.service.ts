import { Injectable } from '@angular/core';
import { Http, RequestOptions, Headers, URLSearchParams, Response } from '@angular/http';

@Injectable()
export class ProjectService {
  
  private serverUrl = "http://localhost/tick_master_angular/server/public/api";
  private options;

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
   * getProjects ( Get current user projects )
   * @param column 
   * @param order 
   */

  getProjects( column:string , order:string )
  {
    return this.http.get( this.serverUrl + "/projects/" + column + "/" + order, this.options );
  }

  /**
   * getProject( Get the project with the id project_id )
   * @param project_id 
   * @param task_column 
   * @param order 
   */
  getProject( project_id, task_column:string, order:string )
  {
    return this.http.get( this.serverUrl + "/project/" + project_id + "/" + task_column + "/" + order, this.options ) ;
  }

  /**
   * CountProjectTasks ( Get the status of the project tasks )
   * @param project 
   */
  countProjectTasks( project )
  {
    let counted = { 
      all      : 0,
      finished : 0,
      remaining: 0
    };

    Object.entries( project.tasks ).forEach(
      ([key, value]) => {
        counted.all++;
        if( value.completed == 1 )
          counted.finished++;
        else
          counted.remaining++;
      }
    );
    return counted;
  }

  /**
   * Save project ( Save project to database )
   * @param project
   */
  saveProject( project )
  {
    // Populating the request body
    let body = new URLSearchParams
    Object.entries( project ).forEach(
      ([key, value]) => body.set( key, value )
    );
    // Sending the request
    return this.http.post( this.serverUrl + "/project", body.toString(), this.options );
  }

}
