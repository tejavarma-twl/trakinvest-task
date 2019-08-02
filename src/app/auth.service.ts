import { Injectable } from '@angular/core';
import {environment} from '../environments/environment';
import {HttpClient, HttpHeaders, HttpParams} from '@angular/common/http';
import { Subject} from 'rxjs';
import { Router} from '@angular/router';
import {User} from './auth/user.model';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  apikey = environment.php_rest.apiKey;
  project_id = environment.php_rest.projectId;
  server_url = environment.php_rest.serverurl;
  token = '';
  isLoggedIn = false;
  redirectUrl = '';
  status = new Subject<User>();

  httpOptions = {
    headers: new HttpHeaders({
      'Client-Service': this.project_id,
      'Content-Type': 'application/x-www-form-urlencoded',
      'Auth-Key': this.apikey
    })
  };
  constructor(private http: HttpClient, private route: Router) {

  }

  checkLoginStatus(){
    if(localStorage.access_token){
      this.status.next(new User(localStorage.id, localStorage.access_token));
      return true;
    }
    return false;
  }

  login(data){
    let params = new HttpParams();
    params = params.append('username', data.email);
    params = params.append('password', data.password);
    return this.http.post<any>(this.server_url + '/auth/login', params, this.httpOptions).subscribe(
      (res) => {
        localStorage.setItem('access_token', res.token);
        localStorage.setItem('id', res.id);
        // console.log(localStorage);
        this.route.navigate(['/dashboard']);
        this.isLoggedIn = true;
        const status = new User(res.id, res.token);
        this.status.next(status);
      }
    );
  }

  register(data){
    let rparams = new HttpParams();
    rparams = rparams.append('name', data.name);
    rparams = rparams.append('username', data.email);
    rparams = rparams.append('password', data.password);
    return this.http.post<any>(
      this.server_url + '/auth/register', rparams, this.httpOptions);
  }

  logout(){
    this.isLoggedIn = false;
    this.status.next(null);
    this.route.navigate(['/']);
    localStorage.clear();
  }

}
