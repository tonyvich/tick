import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProjectService } from 'app/service/project.service';
import { TaskService } from 'app/service/task.service';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Response } from '@angular/http';
import { Router } from '@angular/router';
import { error } from 'util';

@Component({
  selector: 'app-new-task',
  templateUrl: './new-task.component.html',
  styleUrls: ['./new-task.component.css']
})
export class NewTaskComponent implements OnInit {

  project_id ;
  project;
  dataReady:boolean = false;
  formError:boolean = false;
  
  // Task form declaration
  private taskForm = new FormGroup({
    name : new FormControl(
      '',
      [ Validators.required ]
    ),
    description : new FormControl(
      ''
    ),
    ends_at : new FormControl(
      '',
    ),
    ends_hour : new FormControl(
      ''
    )
  });

  constructor( private route:ActivatedRoute, private projectService:ProjectService, private taskService:TaskService, private router:Router ) { }

  /**
   * On init
   */
  ngOnInit() {
    // Get project id query parameter
    this.project_id = this.route.snapshot.paramMap.get( 'project_id' );
    // Get project from the id
    this.projectService.getProject( this.project_id, "name", "asc" ).subscribe(
      response => {
          this.project = response.json().project;
          // Count project tasks 
          this.project.counted = this.projectService.countProjectTasks( this.project );
          this.dataReady = true;
    });
  }

  /**
   * Save task to database
   */
  saveTask()
  {
    // Construct task object
    let task = this.taskForm.value;
    task.project_id = this.project_id;
    if( task.ends_at ){
      task.ends_at = task.ends_at.year + "-" + task.ends_at.month + "-" + task.ends_at.day;
      if( task.ends_hour ) 
        task.ends_at += " " + task.ends_hour.hour + ":" + task.ends_hour.minute + ":" + task.ends_hour.second;
    }
    task.ends_hour = null;
    // save Task 
    this.taskService.saveTask( task ).subscribe(
      Response => {
        if( Response.status == 200 )
          this.router.navigate( [ '/project/' + this.project_id ] );
      }, Response => {
        if( Response.status != 200 )
          this.formError = true;
      }
    )
  }

  /**
   * Get Form task name
   */
  get name(){
    return this.taskForm.get( 'name' );
  }

  /**
   * Get Form task description
   */
  get description(){
    return this.taskForm.get( 'description' );
  }

  /**
   * get Form Task ends_date
   */
  get ends_at(){
    return this.taskForm.get( 'ends_at' );
  }
}
