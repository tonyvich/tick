import { TestBed, inject } from '@angular/core/testing';

import { ServerGuardService } from './server-guard.service';

describe('ServerGuardService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [ServerGuardService]
    });
  });

  it('should be created', inject([ServerGuardService], (service: ServerGuardService) => {
    expect(service).toBeTruthy();
  }));
});
