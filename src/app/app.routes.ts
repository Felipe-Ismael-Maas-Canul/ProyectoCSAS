import { Routes } from '@angular/router';
import { HomeComponent } from './pages/home/home.component';
import { DatosDemoComponent } from './pages/datos-demo/datos-demo.component';
import { CuestionarioComponent } from './pages/cuestionario/cuestionario.component';
import { LoginComponent } from './pages/login/login.component';
import { AdminComponent } from './pages/admin/admin.component';
import { AdminRegisterComponent } from './pages/admin/admin-register/admin-register.component';
import { StudentComponent } from './pages/student/student.component';
import { StudentRegisterComponent } from './pages/student/student-register/student-register.component';
import { DashAdmiComponent } from './pages/dash-admi/dash-admi.component'; // Importa el nuevo componente

export const routes: Routes = [
  { path: '', redirectTo: 'home', pathMatch: 'full' },
  //{ path: '**', redirectTo: 'home' }, // Para manejar rutas no encontradas

  { path: 'home', component: HomeComponent },

  { path: 'login', component: LoginComponent },

  { path: 'datos', component: DatosDemoComponent },
  { path: 'cuestionario', component: CuestionarioComponent },

  { path: 'admin', component: AdminComponent },
  { path: 'register-admin', component: AdminRegisterComponent },

  { path: 'student', component: StudentComponent },
  { path: 'register-student', component: StudentRegisterComponent },

  { path: 'dash-admin', component: DashAdmiComponent } // Nueva ruta para DashAdmiComponent
];
