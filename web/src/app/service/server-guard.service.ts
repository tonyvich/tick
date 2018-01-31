import { Injectable } from '@angular/core';
import { Router,CanActivate } from '@angular/router';

@Injectable()
export class ServerGuardService {

  constructor(
    private router:Router
  ) { }

  canActivate() {
    let serverUrl = localStorage.getItem( 'config.server_url' );
    if( serverUrl ){
      return true;
    }
    this.router.navigate( [ '/config-url' ] );
    return false;
  }
}
