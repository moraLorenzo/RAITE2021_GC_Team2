import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { UserService } from './user.service';

@Injectable({
  providedIn: 'root',
})
export class DataService {
  private apiLink = 'http://localhost/RAITE2021_GC_Team2/backend/';

  constructor(private http: HttpClient, private user: UserService) {}

  public processData(endpoint: any, data: any) {
    return this.http.post(this.apiLink + endpoint, JSON.stringify(data));
  }
}
