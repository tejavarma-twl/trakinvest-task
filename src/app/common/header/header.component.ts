import {Component, OnDestroy, OnInit} from '@angular/core';
import {AuthService} from '../../auth.service';
import {Subscription} from 'rxjs';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit, OnDestroy {
  private userSub: Subscription;
  show = false;
  constructor(private auth: AuthService) {

    // Subscribe here, this will automatically update
    // "isUserLoggedIn" whenever a change to the subject is made.

  }

  ngOnInit() {
    // this.show = localStorage.access_token !== undefined;
    this.userSub = this.auth.status.subscribe(
      status => {
        this.show = !!status;
      }
    )
    this.show = this.auth.checkLoginStatus();
  }

  onLogout(){
    this.auth.logout();
  }

  ngOnDestroy(): void {
    this.userSub.unsubscribe();
  }

}
