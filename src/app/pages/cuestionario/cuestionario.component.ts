import { Component, OnInit } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

import Swal from 'sweetalert2';


@Component({
  selector: 'app-cuestionario',
  standalone: true,
  imports: [ CommonModule, FormsModule, ReactiveFormsModule],
  templateUrl: './cuestionario.component.html',
  styleUrls: ['./cuestionario.component.scss']
})
export class CuestionarioComponent {

  questions: string[] = [ /* Lista de tus preguntas */
    // Preguntas...
    '10. Los grupos comunitarios necesitan nuestra ayuda.',
    '11. Hay muchas personas en la comunidad que necesitan ayuda.',
    '12. Hay necesidades en la comunidad.',
    '13. Hay personas que tienen necesidades que no están satisfechas.',
    '14. El trabajo voluntario en agencias comunitarias ayuda a resolver problemas sociales.',
    '15. Los voluntarios en las agencias comunitarias marcan la diferencia, aunque sea una pequeña diferencia.',


    '16. Los estudiantes universitarios voluntarios pueden ayudar a mejorar la comunidad local.',
    '17. El voluntariado en proyectos comunitarios puede mejorar enormemente los recursos de la comunidad.',
    '18. Cuanta más gente ayude, mejor será la situación.',
    '19. Contribuir con mis habilidades hará de la comunidad un lugar mejor.',
    '20. Mi contribución a la comunidad marcará una diferencia real.',
    '21. Puedo marcar la diferencia en la comunidad.',


    '22. Es importante ayudar a las personas en general.',
    '23. Mejorar las comunidades es importante para mantener una sociedad de calidad.',
    '24. Nuestra comunidad necesita buenos voluntarios.',
    '25. Todas las comunidades necesitan buenos voluntarios.',
    '26. Es importante brindar un servicio útil a la comunidad a través de la comunidad.',
    '27. Cuando conozco personas que están pasando por momentos difíciles, me pregunto si estaría en su lugar.',
    '28. Me siento mal porque algunos miembros de la comunidad sufren de falta de recursos.',



    '29. Me siento mal por la disparidad entre los miembros de la comunidad.',
    '30. Si me ofreciera como voluntario, tendría menos tiempo para mis tareas escolares.',
    '31. Si me ofreciera como voluntario, habría perdido la oportunidad de ganar dinero en un puesto remunerado.',
    '32. Si me ofreciera como voluntario, tendría menos energía.',
    '33. Si me ofreciera como voluntario, tendría menos tiempo para trabajar.',
    '34. Si me ofreciera como voluntario, tendría menos tiempo libre.',


    '35. Si fuera voluntario, tendría menos tiempo para pasar con mi familia.',
    '36. Si me ofreciera como voluntario, estaría contribuyendo al mejoramiento de la comunidad.',
    '37. Si me ofreciera como voluntario, experimentaría una satisfacción personal al saber que estoy ayudando a otros.',
    '38. Si me ofreciera como voluntario, conocería a otras personas que disfrutan del servicio comunitario.',
    '39. Si me ofreciera como voluntario, estaría desarrollando nuevas habilidades.',
    '40. Si me ofreciera como voluntario, haría contactos valiosos para mi carrera profesional.',
    '41. Si me ofreciera como voluntario, obtendría una experiencia valiosa para mi currículum.',


    '42. La falta de participación en el servicio comunitario causará graves daños a nuestra sociedad.',
    '43. Sin servicio comunitario, los ciudadanos desfavorecidos de hoy no tienen esperanza.',
    '44. El servicio comunitario es necesario para mejorar nuestras comunidades.',
    '45. Es fundamental que los ciudadanos se involucren para ayudar a sus comunidades.',
    '46. El servicio comunitario es un componente crucial de la solución a los problemas comunitarios.',
    '47. Participaré en un proyecto de servicio comunitario el próximo año.',
    '48. Buscaré una oportunidad para hacer servicio comunitario el próximo año.',
  ];

  options: string[] = [
    "Totalmente en desacuerdo",
    "En desacuerdo",
    "Algo en desacuerdo",
    "Ni estoy de acuerdo ni en desacuerdo",
    "Parcialmente de acuerdo",
    "De acuerdo",
    "Totalmente de acuerdo",
  ];

  selections: number[] = Array(this.questions.length).fill(0); // Inicializa las selecciones a 0

  currentPage: number = 1; // Página actual
  questionsPerPage: number = 10; // Número de preguntas por página

  // Cálculo del total de páginas
  get totalPages(): number {
    return Math.ceil(this.questions.length / this.questionsPerPage);
  }

  // Obtiene las preguntas para la página actual
  get currentQuestions(): string[] {
    const start = (this.currentPage - 1) * this.questionsPerPage;
    const end = start + this.questionsPerPage;
    return this.questions.slice(start, end);
  }

  // **Método que faltaba para validar las respuestas de la página actual**
  validatePage(): boolean {
    const start = (this.currentPage - 1) * this.questionsPerPage;
    const end = start + this.questionsPerPage;
    // Verifica que todas las selecciones en la página actual sean diferentes de 0 (es decir, respondidas)
    return this.selections.slice(start, end).every(selection => selection !== 0);
  }

  // Cambiar de página solo si las preguntas de la página actual están respondidas
  goToPage(page: number): void {
    if (page >= 1 && page <= this.totalPages) {
      if (page < this.currentPage || this.validatePage()) { // Permitir ir a la página anterior sin validar
        this.currentPage = page;
      } else {
        Swal.fire({
          icon: 'error',
          title: 'ERROR',
          text: 'Por favor complete todas las respuestas antes de continuar.',
          confirmButtonText: 'OK'
        });
      }
    }
  }

  calculateSum() {
    // Implementación de la suma
  }
}
