import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { DataService } from 'src/app/services/data.service';
import { UserService } from 'src/app/services/user.service';

@Component({
  selector: 'app-page1',
  templateUrl: './page1.component.html',
  styleUrls: ['./page1.component.css'],
})
export class Page1Component implements OnInit {
  Barber: string;
  user_id: number;
  user_obj: any;
  constructor(
    private userService: UserService,
    private dataService: DataService,
    private router: Router
  ) {
    this.user_obj = this.userService.getUser();
    this.user_id = this.user_obj.id;
  }

  ngOnInit(): void {}

  req(e: any) {
    e.preventDefault();

    // console.log(e.target[0].value);
    // console.log(this.formatDate(e.target[0].value));

    let employeeId = e.target[0].value;
    let date = this.formatDate(e.target[1].value);
    let status = 'pending';
    console.log(date);

    this.dataService
      .processData('insertsched', {
        userId: this.user_id.toString(),
        employeeId,
        date,
        status,
      })
      .subscribe((res: any) => {
        try {
          if (res.status.remarks == 'Success') {
            if (res.payload.role == '1') {
              console.log(res.payload);
            } else {
              console.log('Baber');
              alert(res.status.message);
              this.router.navigate(['/page2']);
            }
          } else {
            console.log(res.status.remarks);
          }
        } catch (e) {
          console.log(e);
        }
      });
  }

  formatDate(date) {
    var d = new Date(date),
      month = '' + (d.getMonth() + 1),
      day = '' + d.getDate(),
      year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
  }
}
