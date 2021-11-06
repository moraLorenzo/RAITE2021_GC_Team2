import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { UserService } from 'src/app/services/user.service';

@Component({
  selector: 'app-page3',
  templateUrl: './page3.component.html',
  styleUrls: ['./page3.component.css'],
})
export class Page3Component implements OnInit {
  username: string = 'Sample';
  email: string = 'sampleemail@gmail.com';
  user_obj: any;
  constructor(public userService: UserService, public router: Router) {}

  ngOnInit(): void {
    // console.log(this.userService.getUser());
    this.user_obj = this.userService.getUser();
    this.username = this.user_obj.username;
    this.email = this.user_obj.email;
  }

  logout() {
    var r = confirm('Do you confirm to sign out?');
    if (r == true) {
      console.log('You pressed OK!');
      this.userService.setLoggedOut();
      this.router.navigate(['/login']);
    }
  }
}
