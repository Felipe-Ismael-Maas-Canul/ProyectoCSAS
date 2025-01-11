import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, FormArray, Validators } from '@angular/forms';
//import { SurveyService } from '../../../core/services/cuestionario.service';

@Component({
  selector: 'app-crear-encuestas',
  standalone: true,
    imports: [CommonModule ],
  templateUrl: './crear-encuestas.component.html',
  styleUrl: './crear-encuestas.component.scss'
})
export class CrearEncuestasComponent {
  encuestaForm: FormGroup;
  opcionesRespuesta: string[] = [];
  categorias: any[] = [];

  constructor(private fb: FormBuilder) {
    this.encuestaForm = this.fb.group({
      titulo: ['', Validators.required],
      descripcion: [''],
      opciones: this.fb.array([]),
      categorias: this.fb.array([]),
    });
  }

  get opciones() {
    return this.encuestaForm.get('opciones') as FormArray;
  }

  get categoriasArray() {
    return this.encuestaForm.get('categorias') as FormArray;
  }

  // Añadir opción de respuesta
  addOpcion(opcion: string) {
    this.opciones.push(this.fb.control(opcion, Validators.required));
  }

  // Añadir categoría con preguntas
  addCategoria(nombre: string) {
    const categoria = this.fb.group({
      nombre: [nombre, Validators.required],
      preguntas: this.fb.array([]),
    });
    this.categoriasArray.push(categoria);
  }

  // Añadir pregunta a una categoría
  addPregunta(index: number, pregunta: string) {
    const preguntas = this.categoriasArray.at(index).get('preguntas') as FormArray;
    preguntas.push(this.fb.control(pregunta, Validators.required));
  }

  // Guardar Encuesta
  guardarEncuesta() {
    if (this.encuestaForm.valid) {
      console.log(this.encuestaForm.value);
      // Aquí llamar al servicio para guardar en el backend
    } else {
      alert('Por favor llena todos los campos requeridos.');
    }
  }

}
