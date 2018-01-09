import { Router } from '@angular/router';
import { UserService } from './../service/user.service';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

  saveError:boolean; // Control if save correctly executed
  usernameExists;    // Control if username exist
  passwordMatch:boolean = true;      // Control if two passwords match

  // Register form

  registerForm = new FormGroup({
    name : new FormControl(
      '',
      [ Validators.required, Validators.minLength( 6 ) ]
    ),
    email : new FormControl(
      '',
      [ Validators.email, Validators.required ]
    ),
    password : new FormControl(
      '',
      [ Validators.required, Validators.minLength(6) ]
    ),
    c_password : new FormControl(
      '',
      [ Validators.required ]
    )
  });

  /**
   * Constructor
   */
  constructor( private userService:UserService, private router:Router ) { }

  /**
   * On Init
   */
  ngOnInit() {
  }

  /**
   * Save User ( Register user )
   */
  saveUser() {
    this.userService.createUser( this.registerForm.value ).subscribe(
      response => {
        this.router.navigate( ['/login'] );
      }, error => {
        this.saveError = true;
      }
    )
  }

  /**
   * Check Password Match
   */
  checkPasswordMatch() {
    console.log( "call" );
    if( this.password.value != this.cPassword.value )
      this.passwordMatch = false;
    else
      this.passwordMatch = true;
  }

  /**
   * Get Name 
   */
  get name(){
    return this.registerForm.get( 'name' );
  }

  /**
   * Get Email 
   */
  get email(){
    return this.registerForm.get( 'email' );
  }

  /**
   * Get Password 
   */
  get password(){
    return this.registerForm.get( 'password' );
  }

  /**
   * Get Username 
   */
  get cPassword(){
    return this.registerForm.get( 'c_password' );
  }

}
