import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {LoginComponent} from './auth/login/login.component';
import {SignupComponent} from './auth/signup/signup.component';
import {DashboardComponent} from './dashboard/dashboard.component';
import {AddComponent} from './dashboard/add/add.component';
import {EditComponent} from './dashboard/edit/edit.component';
import {UsersComponent} from './dashboard/users/users.component';
import {LogoutComponent} from './auth/logout/logout.component';
import {AuthGuard} from './auth.guard';


const routes: Routes = [
  { path: '', component: LoginComponent },
  { path: 'register', component: SignupComponent },
  { path: 'logout', component: LogoutComponent },
  { path: 'dashboard', component: DashboardComponent, children:[
      { path: '', component: UsersComponent },
      { path: 'users', component: UsersComponent },
      { path: 'add', component: AddComponent },
      { path: 'edit/:id', component: EditComponent }
    ]}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
