import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { DataService } from 'src/app/services/data.service';
import { UserService } from 'src/app/services/user.service';

@Component({
  selector: 'app-page2',
  templateUrl: './page2.component.html',
  styleUrls: ['./page2.component.css'],
})
export class Page2Component implements OnInit {
  user_id: number;
  user_obj: any;

  schedules: any;
  constructor(
    private userService: UserService,
    private dataService: DataService,
    private router: Router
  ) {
    this.user_obj = this.userService.getUser();
    this.user_id = this.user_obj.id;

    this.get();
  }

  ngOnInit(): void {}

  get() {
    this.dataService
      .processData('getschedById', {
        uId: this.user_id.toString(),
      })
      .subscribe((res: any) => {
        try {
          if (res.status.remarks == 'Success') {
            console.log(res.payload);
            this.schedules = res.payload.reverse();
          } else {
            console.log(res.status.remarks);
          }
        } catch (e) {
          console.log(e);
        }
      });
  }
}
