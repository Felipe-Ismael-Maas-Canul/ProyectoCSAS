import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../../../core/services/auth.service';

@Component({
  selector: 'app-dash-admin',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './dash-admin.component.html',
  styleUrl: './dash-admin.component.scss'
})
export class DashAdminComponent implements OnInit {
  isSidebarHidden = false;
  adminName = ''; // Nombre del administrador
  welcomePrefix = ''; // La palabra Bienvenido/a/e

  constructor(private router: Router, private authService: AuthService) {}

  ngOnInit() {
    // Obtener los datos del usuario autenticado desde el AuthService
    const user = this.authService.getCurrentUser();

    if (user) {
      console.log('Datos del usuario autenticado:', user); // Depuración
      this.adminName = user.nombres;
      this.setWelcomePrefix(user.genero); // Ajustar "Bienvenido/a/e" según el género
    } else {
      // Si no hay usuario autenticado, redirige al login
      this.router.navigate(['/login']);
    }
  }


  setWelcomePrefix(genero: string): void {
    // Asegúrate de que los valores del género coincidan con lo que envía tu backend
    if (genero === 'male' || genero === 'Masculino') {
      this.welcomePrefix = 'Bienvenido';
    } else if (genero === 'female' || genero === 'Femenino') {
      this.welcomePrefix = 'Bienvenida';
    } else {
      this.welcomePrefix = 'Bienvenide';
    }
  }

}
