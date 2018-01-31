import { Component,  OnInit,  Input, ViewChild } from '@angular/core';
import { DataTable, DataTableResource } from 'angular-4-data-table';
import { ProjectService } from 'app/service/project.service';
import { TaskService } from 'app/service/task.service';
import { Response } from '@angular/http/src/static_response';

@Component({
  selector: 'app-task-table',
  templateUrl: './task-table.component.html',
  styleUrls: ['./task-table.component.css']
})

export class TaskTableComponent implements OnInit {

  @Input() id:number;
  taskResource;
  tasks = [];
  taskCount = 0;
  project;
  control:boolean = false;
  bulkAction = "mark_as_completed";

  @ViewChild(DataTable) tasksTable: DataTable;

  constructor( private service:ProjectService, private taskService:TaskService ) {

  }

  ngOnInit(){
   this.loadProject( false );
  }

  loadProject( reload:boolean ){
    this.service.getProject( this.id, "name", "asc" ).subscribe(
      response => {
          this.project = response.json().project;
          // Count project tasks
          this.project.counted = this.service.countProjectTasks( this.project );
          this.taskResource = new DataTableResource( this.project.tasks );
          this.taskResource.count().then( count => this.taskCount = count );
          this.control = true;
          // Reload data table
          if( reload )
            this.tasksTable._triggerReload();
    });
  }

  reloadTasks( params )
  {
    this.taskResource.query( params ).then( items => this.tasks = items );
  }

  toggleTaskStatus( task ) {
    if( task.completed == 0 ){
      // Mark task completed if not
      this.taskService.completeTask( task.id ).subscribe(
        Response => {
          this.loadProject( true );
        }
      );
    } else {
      // Mark task as not completed
      this.taskService.uncompleteTask( task.id ).subscribe(
        Response => {
          this.loadProject( true );
        }
      );
    }
  }

  bulkActions(){

    Object.entries( this.tasksTable.selectedRows ).forEach(
      ([ key, value ]) => {
        let id = value.item.id;
        if( this.bulkAction == "mark_as_completed" ){
          console.log( id );
          this.taskService.completeTask( id ).subscribe();
        } else {
          this.taskService.uncompleteTask( id ).subscribe();
        }
      }
    );
    this.loadProject( true );
  }

}
