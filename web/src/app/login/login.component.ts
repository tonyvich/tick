import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from '../service/auth.service';
import { UserService } from 'app/service/user.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  invalidLogin = false;
  /**
   * Login Form
   */
  form = new FormGroup({
    username  : new FormControl(
      '',
      [ Validators.email, Validators.required ]
    ),  
    password  : new FormControl(
      '',
      [ Validators.required ]
    )  
  });

  constructor( private authService:AuthService, private router:Router, private userService:UserService )  { }

  /**
   * On Init
   */
  ngOnInit() {
  }

  /**
   * Get Username ( Return form username control )
   */
  get username(){
    return this.form.get( 'username' );
  }

  /**
   * get Password ( Return form password control )
   */
  get password(){
    return this.form.get( 'password' );
  }

  /**
   * Login
   */
  login() {
    console.log( this.form.value );
    this.authService.login( this.form.value ).subscribe( 
      response => {
        let result = response.json();
        localStorage.setItem( 'token', result.success.token );
        this.userService.currentUser().subscribe(
          response => {
            localStorage.setItem( 'role', response.json().user.role );
            // Redirect
            this.router.navigate( ['/'] );
          }
        );
      }, error => {
        this.invalidLogin = true;
      }
    ); 
  }

}
