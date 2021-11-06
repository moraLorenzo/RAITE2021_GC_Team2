import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { DataService } from '../services/data.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css'],
})
export class RegisterComponent implements OnInit {
  constructor(private dataService: DataService, private router: Router) {}

  ngOnInit(): void {}

  reg(e: any) {
    e.preventDefault();

    let username = e.target[0].value;
    let email = e.target[1].value;
    let password = e.target[2].value;

    this.dataService
      .processData('register', { username, email, password })
      .subscribe((res: any) => {
        try {
          if (res.status.remarks == 'Success') {
            alert(res.status.message);
            this.router.navigate(['login']);
          } else {
            console.log(res.status.remarks);
          }
        } catch (e) {
          console.log(e);
        }
      });
  }
}
