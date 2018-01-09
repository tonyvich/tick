import { Component, OnInit } from '@angular/core';
import { ProjectService } from '../service/project.service';
import { forEach } from '@angular/router/src/utils/collection';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  projects: any[];

  constructor( private service:ProjectService ) { }

  ngOnInit() {
    
    // Get current user projects
    this.service.getProjects( "created_at", "asc" ).subscribe(
      response => {
        this.projects = response.json().projects;
        Object.entries( this.projects ).forEach(
          ([key, value]) => { 
            value.counted = this.service.countProjectTasks( value );
          }
        );
    });

  }

}
