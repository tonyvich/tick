import { Component, OnInit, ViewChild } from '@angular/core';
import { DataTable, DataTableResource } from 'angular-4-data-table';
import { UserService } from 'app/service/user.service';

@Component({
  selector: 'app-team-management',
  templateUrl: './team-management.component.html',
  styleUrls: ['./team-management.component.css']
})
export class TeamManagementComponent implements OnInit {

  control;           // Control when to render the template
  users;             // Users list
  items = [];           // Datatble items
  userResource;      // User data table Ressource
  userCount;         // Count the users in datatable

  @ViewChild( DataTable ) userTable:DataTable;

  constructor( private userService:UserService ) { }

  ngOnInit() {
    this.loadUsers();
  }

  loadUsers() {
    // Load user from service
    this.userService.users().subscribe(
      response => {
        this.users = response.json().users;
        this.userResource = new DataTableResource( this.users );
        this.userResource.count().then( count => this.userCount = count ); 
        this.control = true;
        // Reload datatable
        this.userTable._triggerReload();
      }
    ); 
  }

  reloadUsers( params )
  {
    this.userResource.query( params ).then( items => this.items = items );
  }

  changeRole( user, role ){
    user.role = role;
    this.userService.editRole( user ).subscribe(
      response => {
        this.loadUsers();
      }
    );
  }
}
