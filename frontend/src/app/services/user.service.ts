import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  public loggedIn: boolean;
  public UserObj: any;
  role: string;
  constructor() {
    this.loggedIn = false;
  }

  setUserLoggedIn(user: any) {
    this.loggedIn = true;
    this.UserObj = user;
    this.role = '1';
  }

  setBarberLoggedIn(user: any) {
    this.loggedIn = true;
    this.UserObj = user;
    this.role = '0';
  }

  setLoggedOut() {
    this.loggedIn = false;
    this.UserObj = [];
    this.role = null;
  }

  isLoggedIn() {
    return this.loggedIn;
  }

  isUser() {
    return this.role;
  }

  getUser() {
    return this.UserObj;
  }
}
