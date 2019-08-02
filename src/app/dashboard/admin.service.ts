import { Injectable } from '@angular/core';
import {AuthService} from '../auth.service';
import {HttpClient, HttpParams} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AdminService {

  constructor(private auth: AuthService, private http : HttpClient) { }

  getAllUsers(){
    return this.http.get<any>(this.auth.server_url + '/auth/getusers', this.auth.httpOptions);
  }

  getUserData(id){
    let params = new HttpParams();
    params = params.append('id', id);
    return this.http.get<any>(this.auth.server_url + '/auth/getusersdetail?id='+id,  this.auth.httpOptions);
  }

  updateUser(data){
    let params = new HttpParams();
    params = params.append('id', data.id);
    params = params.append('name', data.name);
    params = params.append('email', data.email);
    params = params.append('password', data.password);
    return this.http.post<any>(this.auth.server_url + '/auth/updateuser', params, this.auth.httpOptions);
  }

  deleteUser(id){
    return this.http.get<any>(this.auth.server_url + '/auth/deleteuser?id='+id, this.auth.httpOptions);
  }
}
