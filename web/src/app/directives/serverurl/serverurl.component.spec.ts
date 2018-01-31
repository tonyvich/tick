import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ServerurlComponent } from './serverurl.component';

describe('ServerurlComponent', () => {
  let component: ServerurlComponent;
  let fixture: ComponentFixture<ServerurlComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ServerurlComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ServerurlComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
