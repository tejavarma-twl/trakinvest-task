import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, ParamMap, Router} from '@angular/router';
import {switchMap} from 'rxjs/operators';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {AdminService} from '../admin.service';

@Component({
  selector: 'app-edit',
  templateUrl: './edit.component.html',
  styleUrls: ['./edit.component.scss']
})
export class EditComponent implements OnInit {
  urlData = '';
  editForm: FormGroup;
  constructor(private route: ActivatedRoute, private adminSer: AdminService, private router: Router) { }

  ngOnInit() {
    this.urlData = this.route.snapshot.paramMap.get('id');
    this.editForm = new FormGroup({
      id: new FormControl('', [Validators.required]),
      name: new FormControl('', [Validators.required]),
      email: new FormControl('', [Validators.required, Validators.email]),
      password: new FormControl('', Validators.required)
    });
    this.adminSer.getUserData(this.urlData).subscribe(
      res => {
        this.editForm.patchValue({
          id:    res.data.id,
          name:    res.data.name,
          email:    res.data.email
        });
      }
    )
  }

  onEditSubmit(){
    if (this.editForm.valid) {
      this.adminSer.updateUser(this.editForm.value).subscribe(
        res => {
          // console.log(res);
          this.router.navigate(['/dashboard']).then(r => console.log('done'));
        }
      );
    }
  }

}
