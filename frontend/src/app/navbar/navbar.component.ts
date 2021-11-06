import { Component, OnInit } from '@angular/core';
import { UserService } from '../services/user.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css'],
})
export class NavbarComponent implements OnInit {
  username: string = 'Sample';
  user_obj: any;
  constructor(public userService: UserService) {}

  ngOnInit(): void {
    this.user_obj = this.userService.getUser();
    // console.log(this.user_obj.username);
    this.username = this.user_obj.username;
  }
}
