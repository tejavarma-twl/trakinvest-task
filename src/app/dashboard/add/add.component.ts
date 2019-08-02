import { Component, OnInit } from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {ActivatedRoute, Router} from '@angular/router';
import {AdminService} from '../admin.service';
import {AuthService} from '../../auth.service';

@Component({
  selector: 'app-add',
  templateUrl: './add.component.html',
  styleUrls: ['./add.component.scss']
})
export class AddComponent implements OnInit {
  addForm: FormGroup;
  constructor(private route: ActivatedRoute, private adminSer: AdminService, private auth: AuthService, private router: Router) { }

  ngOnInit() {
    this.addForm = new FormGroup({
      name: new FormControl('', [Validators.required]),
      email: new FormControl('', [Validators.required, Validators.email]),
      password: new FormControl('', Validators.required)
    });
  }

  onAddSubmit(){
    if (this.addForm.valid) {
      this.auth.register(this.addForm.value).subscribe(
        (res) => {
          this.router.navigate(['/dashboard']).then(r => console.log('done'));
        }
      );
    }
  }

}
