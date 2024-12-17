import { Routes } from '@angular/router';
import { HomeComponent } from './pages/home/home.component';
import { LoginComponent } from './pages/login/login.component';
import { AdminComponent } from './pages/admin/admin.component';
import { DashAdminComponent } from './pages/admin/dash-admin/dash-admin.component';
import { AdminRegisterComponent } from './pages/admin/admin-register/admin-register.component';
import { StudentComponent } from './pages/student/student.component';
import { DashStudentComponent } from './pages/student/dash-student/dash-student.component';
import { StudentRegisterComponent } from './pages/student/student-register/student-register.component';
import { CrearEncuestasComponent } from './pages/admin/crear-encuestas/crear-encuestas.component';
import { ReportesComponent } from './pages/admin/reportes/reportes.component';
import { UsuariosComponent } from './pages/admin/usuarios/usuarios.component';

export const routes: Routes = [
  { path: '', redirectTo: 'home', pathMatch: 'full' },
  { path: 'home', component: HomeComponent },
  { path: 'login', component: LoginComponent },
  { path: 'register-admin', component: AdminRegisterComponent },
  { path: 'register-student', component: StudentRegisterComponent },


  // Rutas para Admin
  { path: '', redirectTo: '/admin', pathMatch: 'full' },

  {
    path: 'admin',
    component: AdminComponent,
    children: [
      { path: 'dash-admin', component: DashAdminComponent },
      { path: 'crear-encuestas', component: CrearEncuestasComponent },
      { path: 'reportes', component: ReportesComponent },
      { path: 'usuarios', component: UsuariosComponent },
      { path: '', redirectTo: 'dash-admin', pathMatch: 'full' }
    ]
  },


  // Rutas para Student
  {
    path: 'student',
    component: StudentComponent,
    children: [
      { path: '', redirectTo: 'dash-student', pathMatch: 'full' },
      { path: 'dash-student', component: DashStudentComponent },
    ]
  }

];
