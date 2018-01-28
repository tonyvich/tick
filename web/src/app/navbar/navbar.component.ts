import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {

  @Input() firstTitle:string;
  @Input() navTitle:string;
  @Input() navLink:string;

  username:any;

  constructor() { }

  ngOnInit() {
    this.username = localStorage.getItem( 'user.name' );
  }

}
