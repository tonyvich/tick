import { Injectable } from '@angular/core';
import { Router,CanActivate } from '@angular/router';
import { AuthService } from 'app/service/auth.service';

@Injectable()
export class AdminGuardService implements CanActivate{

  constructor( 
    private authService: AuthService,
    private router:Router 
  ) { }

  canActivate() {
    if( this.authService.isAdmin() ) {
      return true;
    }

    return false;
  }
}
