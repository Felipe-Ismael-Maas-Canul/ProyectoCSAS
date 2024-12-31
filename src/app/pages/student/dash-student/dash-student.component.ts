import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../../../core/services/auth.service';

@Component({
  selector: 'app-dash-student',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './dash-student.component.html',
  styleUrl: './dash-student.component.scss'
})
export class DashStudentComponent implements OnInit {
  isSidebarHidden = false;
  studentName = ''; // Inicializado vacío

  pendingSurveys = [
    { id: 1, title: 'Encuesta de Actitudes 1' },
    { id: 2, title: 'Encuesta de Actitudes 2' },
    { id: 3, title: 'Encuesta de Actitudes 3' }
  ];

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

  toggleSidebar() {
    this.isSidebarHidden = !this.isSidebarHidden;
  }

  startSurvey(id: number) {
    console.log('Iniciando encuesta con ID:', id);
    this.router.navigate(['/student/surveys', id]);
  }
}
