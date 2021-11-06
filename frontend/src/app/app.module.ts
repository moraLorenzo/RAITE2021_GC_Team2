import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { HttpClientModule } from '@angular/common/http';

import { RouterModule } from '@angular/router';
import { Page1Component } from './users/page1/page1.component';
import { Page2Component } from './users/page2/page2.component';
import { NavbarComponent } from './navbar/navbar.component';
import { Page3Component } from './users/page3/page3.component';
import { BarbershopComponent } from './barbershop/barbershop.component';
import { FormsModule } from '@angular/forms';
@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    RegisterComponent,
    Page1Component,
    Page2Component,
    NavbarComponent,
    Page3Component,
    BarbershopComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    RouterModule,
    FormsModule,
  ],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}
