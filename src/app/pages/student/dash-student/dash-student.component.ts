import { CommonModule } from '@angular/common';
import { Component,  OnInit  } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-dash-student',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './dash-student.component.html',
  styleUrl: './dash-student.component.scss'
})
export class DashStudentComponent implements OnInit {
  isSidebarHidden = false;
  studentName = 'Juan Pérez'; // Simulado, debe venir del UserService
  studentEmail = 'juanperez@example.com';
  userAvatar = 'assets/avatars/male-avatar.png';

  pendingSurveys = [
    { id: 1, title: 'Encuesta de Actitudes 1' },
    { id: 2, title: 'Encuesta de Actitudes 2' },
    { id: 3, title: 'Encuesta de Actitudes 3' }
  ];

  constructor(private router: Router) {}

  ngOnInit() {
    // Aquí podrías cargar los datos reales del estudiante desde un servicio
  }

  toggleSidebar() {
    this.isSidebarHidden = !this.isSidebarHidden;
  }

  startSurvey(id: number) {
    console.log('Iniciando encuesta con ID:', id);
    this.router.navigate(['/student/surveys', id]);
  }

  logout() {
    if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
      console.log('Cerrando sesión...');
      this.router.navigate(['/home']);
    }
  }
}
