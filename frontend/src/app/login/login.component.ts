import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { DataService } from '../services/data.service';
import { UserService } from '../services/user.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
})
export class LoginComponent implements OnInit {
  constructor(
    private dataService: DataService,
    private router: Router,
    private UserService: UserService
  ) {}

  ngOnInit(): void {
    if (this.UserService.isLoggedIn() && this.UserService.isUser() == '1') {
      this.router.navigate(['/page1']);
    } else if (
      this.UserService.isLoggedIn() &&
      this.UserService.isUser() == '0'
    ) {
      this.router.navigate(['/barbershop']);
    }
  }

  login(e: any) {
    e.preventDefault();

    let username = e.target[0].value;
    let password = e.target[1].value;

    this.dataService
      .processData('login', { username, password })
      .subscribe((res: any) => {
        try {
          if (res.status.remarks == 'Success') {
            if (res.payload.role == '1') {
              console.log('user');
              console.log(res.payload);
              alert(res.status.message);
              this.UserService.setUserLoggedIn(res.payload);
              this.router.navigate(['/page1']);
            } else {
              console.log('Baber');
              alert(res.status.message);
              this.UserService.setBarberLoggedIn(res.payload);
              this.router.navigate(['/barbershop']);
            }
          } else {
            console.log(res.status.remarks);
          }
        } catch (e) {
          console.log(e);
        }
      });
  }
}
