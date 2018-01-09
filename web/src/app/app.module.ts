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

// Components
import { DataTableDemo1 } from './demo1/data-table-demo1';
import { DataTableDemo2 } from './demo2/data-table-demo2';
import { DataTableDemo3 } from './demo3/data-table-demo3';
import { DataTableDemo1Remote } from './demo1/data-table-demo1-remote';

import { TaskTableComponent } from './task-table/task-table.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { NewTaskComponent } from './new-task/new-task.component';
import { NewProjectComponent } from './new-project/new-project.component';
import { ProjectComponent } from './project/project.component';
import { TeamManagementComponent } from './team-management/team-management.component';
import { PasswordEditComponent } from './password-edit/password-edit.component';
import { NotFoundComponent } from './not-found/not-found.component';
import { AccessDeniedComponent } from './access-denied/access-denied.component';
import { UnknownErrorComponent } from './unknown-error/unknown-error.component';
import { RegisterComponent } from './register/register.component';
import { LoginComponent } from './login/login.component';
import { NavbarComponent } from './navbar/navbar.component';
import { FooterComponent } from './footer/footer.component';

// Services
import { AuthGuardService } from 'app/service/auth-guard.service';
import { AuthService } from 'app/service/auth.service';
import { ProjectService } from 'app/service/project.service';
import { TaskService } from 'app/service/task.service';
import { UserService } from './service/user.service';

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
        canActivate : [ AuthGuardService ] 
      },
      // User management routes
      { 
        path: 'login', 
        component: LoginComponent 
      },
      { 
        path: 'register', 
        component: RegisterComponent 
      },
      { 
        path: 'team-management', 
        component: TeamManagementComponent,
        canActivate : [ AuthGuardService ]
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
        path: '**', 
        component: NotFoundComponent
      },
    ]) 
  ],
  declarations: [ 
    AppComponent, 

    DataTableDemo1, 
    DataTableDemo2,
    DataTableDemo3, 
    DataTableDemo1Remote, 
    
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
  ],
  providers: [
    AuthService,
    AuthGuardService,
    ProjectService,
    TaskService,
    UserService
  ],
  bootstrap: [ 
    AppComponent 
  ]
})
export class AppModule { }
