import { Routes } from '@angular/router';
import { HomeComponent } from './pages/home/home.component';
import { DatosDemoComponent } from './pages/datos-demo/datos-demo.component';
import { CuestionarioComponent } from './pages/cuestionario/cuestionario.component';


export const routes: Routes = [
  { path: '', redirectTo: 'home', pathMatch: 'full' },

  { path: 'home', component: HomeComponent },
  { path: 'datos', component: DatosDemoComponent},
  { path: 'cuestionario', component: CuestionarioComponent}

];
