import {Component, OnInit} from '@angular/core';
import {AuthService} from './auth.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements  OnInit{
  constructor(private auth: AuthService, private route: Router){

  }

  ngOnInit(): void {
    if(this.auth.checkLoginStatus()){
      this.route.navigate(['/dashboard']);
    }
  }
}
