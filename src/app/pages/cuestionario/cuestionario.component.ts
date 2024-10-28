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

  questions:string[] =[

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


  options:string[]=[

    "Totalmente en desacuerdo",
    "Desacuerdo",
    "Algo en desacuerdo",
    "Ni estoy de acuerdo ni en desacuerdo",
    "Parcialmente de acuerdo",
    "De acuerdo",
    "Totalmente de acuerdo",

  ];

  //Inizializa con ceros segun la cantidad de preguntas
  selections:number[]=[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];



  calculateSum(){


    //Verificar que no falten respuestas

    if (this.selections.includes(0)) {

      // Al menos una respuesta
      Swal.fire({
        icon:'error',
        title:'ERROR',
        text: 'Por favor complete todas las respuestas antes de continuar.',
        confirmButtonText:'OK'
      })

    }else{

    // Guardar las selecciones en el localStorage
    localStorage.setItem('questionnaireSelections',JSON.stringify(this.selections));

    //Obtener los datos del localstorage

    const resultadoStr = localStorage.getItem('questionnaireSelections');

    if (resultadoStr !== null) {

      const resultados = JSON.parse(resultadoStr);

      //Inisializa tres arrays para las sumas

        const visual = [1, 5, 9, 10, 11, 16, 17, 22, 26, 27, 32, 36];
        const auditivo = [2, 3, 12, 13, 15, 19, 20, 23, 24, 28, 29, 33];
        const kinestesico = [4, 6, 7, 8, 14, 18, 21, 25, 30, 31, 34, 35];

        let sumaVisual = 0;
        let sumaAuditivo = 0;
        let sumaKinestesico = 0;

        for (let i = 0; i < resultados.length; i++) {
          const resultado = resultados[i];

          if (visual.includes(i + 1)) { // Suma para visual
            sumaVisual += resultado;
          } else if (auditivo.includes(i + 1)) { // Suma para auditivo
            sumaAuditivo += resultado;
          } else if (kinestesico.includes(i + 1)) { // Suma para kinestésico
            sumaKinestesico += resultado;
          }
        }


        //Encuentre el mayor de las tres sumas
        let mayor = Math.max (sumaVisual, sumaAuditivo, sumaKinestesico);
        let mensaje ='';

        if (mayor === sumaVisual) {
          mensaje = 'El tipo predominante es Visual.';
        } else if (mayor === sumaAuditivo) {
          mensaje = 'El tipo predominante es Auditivo.';
        } else if (mayor === sumaKinestesico) {
          mensaje = 'El tipo predominante es Kinestésico.';
        }

        console.log('Suma Visual:', sumaVisual);
        console.log('Suma Auditivo:', sumaAuditivo);
        console.log('Suma Kinestésico:', sumaKinestesico);
        console.log('Mensaje:', mensaje);


        Swal.fire({
          icon:'success',
          title:'RESULTADO SRP',
          text: mensaje,
          confirmButtonText:'OK'
        }).then((result)=>{
          if (result.value) {
            localStorage.removeItem('questionnaireSelections');
            location.reload();
          }
        })
      }
    }
  }
}


