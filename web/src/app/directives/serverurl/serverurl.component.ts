import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl} from '@angular/forms';

@Component({
  selector: 'app-serverurl',
  templateUrl: './serverurl.component.html',
  styleUrls: ['./serverurl.component.css']
})
export class ServerurlComponent implements OnInit {

  serverUrl;
  /**
   * Form
   */
  form = new FormGroup({
    url : new FormControl(
      '',
      []
    )
  });

  constructor() { }

  ngOnInit() {
    this.serverUrl = localStorage.getItem( 'config.server_url' );
  }

  setUrl() {
    localStorage.setItem( 'config.server_url', this.form.get( 'url' ).value );
    this.serverUrl = this.form.get( 'url' ).value;
  }

}
