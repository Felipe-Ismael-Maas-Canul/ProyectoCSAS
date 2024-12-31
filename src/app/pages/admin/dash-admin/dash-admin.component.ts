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
  studentName = ''; // Inicializado vacío

  constructor(private router: Router, private authService: AuthService) {}

  ngOnInit() {
    // Obtener los datos del usuario autenticado desde el AuthService
    const user = this.authService.getCurrentUser();

    if (user) {
      this.studentName = user.nombres; // Solo muestra el nombre
    } else {
      // Si no hay usuario autenticado, redirige al login
      this.router.navigate(['/login']);
    }
  }

}
