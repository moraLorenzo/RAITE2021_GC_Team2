import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { DataService } from '../services/data.service';
import { UserService } from '../services/user.service';

@Component({
  selector: 'app-barbershop',
  templateUrl: './barbershop.component.html',
  styleUrls: ['./barbershop.component.css'],
})
export class BarbershopComponent implements OnInit {
  schedules: any;

  user_id: number;
  user_obj: any;
  constructor(
    private dataService: DataService,
    public userService: UserService,
    public router: Router
  ) {
    this.user_obj = this.userService.getUser();
    this.user_id = this.user_obj.id;
  }

  ngOnInit(): void {
    this.dataService.processData('getsched', null).subscribe((res: any) => {
      try {
        if (res.status.remarks == 'Success') {
          console.log(res.payload);
          this.schedules = res.payload;
        } else {
          console.log(res.status.remarks);
        }
      } catch (e) {
        console.log(e);
      }
    });
  }

  logout() {
    var r = confirm('Do you confirm to sign out?');
    if (r == true) {
      console.log('You pressed OK!');
      this.userService.setLoggedOut();
      this.router.navigate(['/login']);
    }
  }

  update(status: string, id: any) {
    this.dataService
      .processData('updatesched', {
        id,
        status,
      })
      .subscribe((res: any) => {
        try {
          if (res.status.remarks == 'Success') {
            console.log(res.payload);
            this.ngOnInit();
          } else {
            console.log(res.status.remarks);
          }
        } catch (e) {
          console.log(e);
        }
      });
  }
}
