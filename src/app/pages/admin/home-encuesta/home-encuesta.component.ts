import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-home-encuesta',
  templateUrl: './home-encuesta.component.html',
  styleUrls: ['./home-encuesta.component.scss'],
})
export class HomeEncuestaComponent {
  // Lista de formularios recientes simulada
  recentForms = [
    { id: 1, title: 'Encuesta de Satisfacción', description: 'Cuestionario para evaluar la satisfacción del cliente.' },
    { id: 2, title: 'Encuesta de Opinión', description: 'Encuesta para recopilar opiniones sobre productos.' },
    { id: 3, title: 'Escala Likert', description: 'Evaluación de actitudes mediante preguntas tipo Likert.' },
  ];

  constructor(private router: Router) {}

  // Navegar al componente de creación de encuestas
  navigateToCreateForm(): void {
    this.router.navigate(['/admin/crear-encuestas']);
  }

  // Métodos para editar y eliminar formularios
  editForm(id: number) {
    console.log('Editar formulario con ID:', id);
    // Implementar lógica de edición si es necesario
  }

  deleteForm(id: number) {
    console.log('Eliminar formulario con ID:', id);
    // Implementar lógica de eliminación si es necesario
  }
}
