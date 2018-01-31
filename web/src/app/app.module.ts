// Module
import { NgModule } from '@angular/core';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { BrowserModule } from '@angular/platform-browser';
import { CommonModule } from '@angular/common';
import { HttpModule } from '@angular/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';
import { DataTableModule } from 'angular-4-data-table/src/index';

import { AppComponent } from './app.component';

import { TaskTableComponent } from './directives/task-table/task-table.component';
import { DashboardComponent } from './directives/dashboard/dashboard.component';
import { NewTaskComponent } from './directives/new-task/new-task.component';
import { NewProjectComponent } from './directives/new-project/new-project.component';
import { ProjectComponent } from './directives/project/project.component';
import { TeamManagementComponent } from './directives/team-management/team-management.component';
import { PasswordEditComponent } from './directives/password-edit/password-edit.component';
import { NotFoundComponent } from './directives/not-found/not-found.component';
import { AccessDeniedComponent } from './directives/access-denied/access-denied.component';
import { UnknownErrorComponent } from './directives/unknown-error/unknown-error.component';
import { RegisterComponent } from './directives/register/register.component';
import { LoginComponent } from './directives/login/login.component';
import { NavbarComponent } from './directives/navbar/navbar.component';
import { FooterComponent } from './directives/footer/footer.component';
import { LogoutComponent } from './directives/logout/logout.component';
import { ServerurlComponent } from './directives/serverurl/serverurl.component';

// Services
import { AuthGuardService } from 'app/service/auth-guard.service';
import { AuthService } from 'app/service/auth.service';
import { ProjectService } from 'app/service/project.service';
import { TaskService } from 'app/service/task.service';
import { UserService } from './service/user.service';
import { AdminGuardService } from 'app/service/admin-guard.service';
import { ServerGuardService } from 'app/service/server-guard.service';

@NgModule({
  imports: [
    BrowserModule,
    CommonModule,
    FormsModule,
    HttpModule,
    ReactiveFormsModule,
    DataTableModule,
    NgbModule.forRoot(),
    // Routing
    RouterModule.forRoot([
      {
        path: '',
        component: DashboardComponent,
        canActivate : [ AuthGuardService, ServerGuardService ]
      },
      // User management routes
      {
        path: 'login',
        component: LoginComponent,
        canActivate : [ ServerGuardService ]
      },
      {
        path: 'logout',
        component: LogoutComponent
      },
      {
        path: 'register',
        component: RegisterComponent,
        canActivate : [ ServerGuardService ]
      },
      {
        path: 'team-management',
        component: TeamManagementComponent,
        canActivate : [ AdminGuardService ]
      },
      {
        path: 'password-edit',
        component: PasswordEditComponent,
        canActivate : [ AuthGuardService ]
      },
      // Task management route
      {
        path: 'project/:project_id',
        component: ProjectComponent,
        canActivate : [ AuthGuardService ]
      },
      {
        path: 'new-project',
        component: NewProjectComponent,
        canActivate : [ AuthGuardService ]
      },
      {
        path: 'new-task/:project_id',
        component: NewTaskComponent ,
        canActivate : [ AuthGuardService ]
      },
      // Error routes
      {
        path: 'access-denied',
        component: AccessDeniedComponent
      },
      {
        path: 'not-found/:message',
        component: NotFoundComponent
      },
      {
        path: 'unknown-error/:message',
        component: UnknownErrorComponent
      },
      {
        path: 'config-url',
        component: ServerurlComponent
      },
      {
        path: '**',
        component: NotFoundComponent
      },
    ])
  ],
  declarations: [
    AppComponent,

    TaskTableComponent,
    DashboardComponent,
    NewTaskComponent,
    NewProjectComponent,
    ProjectComponent,
    TeamManagementComponent,
    PasswordEditComponent,
    NotFoundComponent,
    AccessDeniedComponent,
    UnknownErrorComponent,
    RegisterComponent,
    LoginComponent,
    NavbarComponent,
    FooterComponent,
    LogoutComponent,
    ServerurlComponent,
  ],
  providers: [
    AuthService,
    AuthGuardService,
    ProjectService,
    TaskService,
    UserService,
    AdminGuardService,
    ServerGuardService
  ],
  bootstrap: [
    AppComponent
  ]
})
export class AppModule { }
