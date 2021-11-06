import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { BarbershopComponent } from './barbershop/barbershop.component';
import { AuthGuard } from './guards/auth.guard';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { Page1Component } from './users/page1/page1.component';
import { Page2Component } from './users/page2/page2.component';
import { Page3Component } from './users/page3/page3.component';

const routes: Routes = [
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'page1', component: Page1Component, canActivate: [AuthGuard] },
  { path: 'page2', component: Page2Component, canActivate: [AuthGuard] },
  { path: 'page3', component: Page3Component, canActivate: [AuthGuard] },
  {
    path: 'barbershop',
    component: BarbershopComponent,
    canActivate: [AuthGuard],
  },

  { path: '', component: LoginComponent, pathMatch: 'full' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
