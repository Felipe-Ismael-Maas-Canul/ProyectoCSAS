import { Component } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { DatosDemoComponent } from '../datos-demo/datos-demo.component';
import { CuestionarioComponent } from '../cuestionario/cuestionario.component';

import { LoginComponent } from '../login/login.component';
import { AdminComponent } from '../admin/admin.component';
import { AdminRegisterComponent } from '../admin/admin-register/admin-register.component';
import { StudentComponent } from '../student/student.component';
import { StudentRegisterComponent } from '../student/student-register/student-register.component';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [
    ReactiveFormsModule,
    FormsModule,
    DatosDemoComponent,
    CuestionarioComponent,
    LoginComponent,
    AdminComponent,
    AdminRegisterComponent,
    StudentComponent,
    StudentRegisterComponent
  ],

  templateUrl: './home.component.html',
  styleUrl: './home.component.scss'
})
export class HomeComponent {

}
