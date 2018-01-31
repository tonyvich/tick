import { Component, OnInit } from '@angular/core';
import { UserService } from 'app/service/user.service';
import { ProjectService } from 'app/service/project.service';
import { Router } from '@angular/router';
import { FormGroup, FormControl, Validators } from '@angular/forms';

@Component({
  selector: 'app-new-project',
  templateUrl: './new-project.component.html',
  styleUrls: ['./new-project.component.css']
})
export class NewProjectComponent implements OnInit {

  control = false;        // Control if the template can be rendered
  users                   // Users object
  saveError;              // Control if save corectly done
  projectExist;           // Control if project already exists
  
  // project form declaration
  projectForm = new FormGroup({
    name : new FormControl(
      '',
      [ Validators.required ]
    ),
    description : new FormControl(
      '',
    ),
    ends_at : new FormControl(
      ''
    ),
    color: new FormControl(
      '',
      [ Validators.required ]
    ),
    assigned_to: new FormControl( 
      '',
      [ Validators.required ]
    )
  });

  constructor( private userService:UserService, private projectService:ProjectService, private route:Router ) { }

  /**
   * Ng On Init
   */
  ngOnInit() {
    this.userService.users().subscribe(
      response => {
        this.users = response.json().users;
    });
  }

  /**
   * Get Color ( Return color form control )
   */

  get color(){
    return this.projectForm.get( 'color' );
  }

  /**
   * Get Name ( Return name form control )
   */

  get name(){
    return this.projectForm.get( 'name' );
  }

  get assignedTo(){
    return this.projectForm.get( 'assigned_to' );
  }

  /**
   * Save Project
   */

  saveProject() {
    // Construct project object
    let project = this.projectForm.value;
    if( project.ends_at )
      project.ends_at = project.ends_at.year + "-" + project.ends_at.month + "-" + project.ends_at.day;
    // Save project
    this.projectService.saveProject( project ).subscribe(
      response => {
        this.route.navigate( ['/'] );
      }, error => {
        this.saveError = true;
        if( error.status == 422 ){
         this.projectExist = true; 
        }
      }
    )
  }

}
