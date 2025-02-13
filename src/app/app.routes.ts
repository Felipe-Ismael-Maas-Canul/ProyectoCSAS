import { Routes } from '@angular/router';
import { HomeComponent } from './pages/home/home.component';
import { LoginComponent } from './pages/login/login.component';
import { AuthGuard } from './guards/auth.guard'; // Asegúrate de tener este guard

//Componentes para Admin
import { AdminComponent } from './pages/admin/admin.component';
import { DashAdminComponent } from './pages/admin/dash-admin/dash-admin.component';
import { AdminRegisterComponent } from './pages/admin/admin-register/admin-register.component';
import { CrearEncuestasComponent } from './pages/admin/crear-encuestas/crear-encuestas.component';
import { ReportesComponent } from './pages/admin/reportes/reportes.component';
import { UsuariosComponent } from './pages/admin/usuarios/usuarios.component';
import { HomeEncuestaComponent } from './pages/admin/home-encuesta/home-encuesta.component';
//Componentes para Student
import { StudentComponent } from './pages/student/student.component';
import { StudentRegisterComponent } from './pages/student/student-register/student-register.component';
import { DashStudentComponent } from './pages/student/dash-student/dash-student.component';
import { EncuestasComponent } from './pages/student/encuestas/encuestas.component';
import { CompletadasComponent } from './pages/student/completadas/completadas.component';

//Despues se elimina esto
import { DatosDemoComponent } from './pages/datos-demo/datos-demo.component';
import { CuestionarioComponent } from './pages/cuestionario/cuestionario.component';


export const routes: Routes = [
  { path: '', redirectTo: 'home', pathMatch: 'full' },
  { path: 'home', component: HomeComponent },
  { path: 'login', component: LoginComponent },
  { path: 'admin/register', component: AdminRegisterComponent },
  { path: 'student/register', component: StudentRegisterComponent },

  //para ver componentes por separados
  { path: 'datos-demo', component: DatosDemoComponent },
  { path: 'cuestionario', component: CuestionarioComponent },

  // Rutas para Admin
  { path: '', redirectTo: '/admin', pathMatch: 'full' },

  {
    path: 'admin',
    component: AdminComponent,
    children: [
      { path: 'dash-admin', component: DashAdminComponent },
      { path: 'form-encuestas', component: HomeEncuestaComponent },
      { path: 'crear-encuestas', component: CrearEncuestasComponent },
      { path: 'reportes', component: ReportesComponent },
      { path: 'usuarios', component: UsuariosComponent },
      { path: '', redirectTo: 'dash-admin', pathMatch: 'full' }
    ]
  },


  // Rutas para Student
  { path: '', redirectTo: '/student', pathMatch: 'full' },

  {
    path: 'student',
    component: StudentComponent,
    children: [
      { path: 'dash-student', component: DashStudentComponent },
      { path: 'surveys', component: EncuestasComponent},
      { path: 'completed', component: CompletadasComponent},
      { path: '', redirectTo: 'dash-student', pathMatch: 'full' }
    ]
  }

];
