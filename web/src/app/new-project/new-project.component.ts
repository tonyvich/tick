import { Component, OnInit } from '@angular/core';
import { UserService } from 'app/service/user.service';
import { ProjectService } from 'app/service/project.service';
import { FormGroup, FormControl, Validators } from '@angular/forms';

@Component({
  selector: 'app-new-project',
  templateUrl: './new-project.component.html',
  styleUrls: ['./new-project.component.css']
})
export class NewProjectComponent implements OnInit {

  control = false;
  users
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

  });

  constructor( private userService:UserService, projectService:ProjectService ) { }

  ngOnInit() {
    this.userService.users().subscribe(
      response => {
        this.users = response.json().users;
        console.log( this.users );
    });
  }

}
