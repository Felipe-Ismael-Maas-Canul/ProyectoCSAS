import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormBuilder, FormGroup, FormArray, Validators, AbstractControl, ReactiveFormsModule } from '@angular/forms';
import { CuestionarioService } from '../../../core/services/cuestionario.service';


@Component({
  selector: 'app-crear-encuestas',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  templateUrl: './crear-encuestas.component.html',
  styleUrls: ['./crear-encuestas.component.scss'],
})
export class CrearEncuestasComponent {
  encuestaForm: FormGroup;

  constructor(private fb: FormBuilder) {
    this.encuestaForm = this.fb.group({
      titulo: ['', Validators.required],
      descripcion: [''],
      preguntas: this.fb.array([]),
    });
  }

  // Getter para el array de preguntas
  get preguntasArray(): FormArray {
    return this.encuestaForm.get('preguntas') as FormArray;
  }

  // Función para castear AbstractControl a FormGroup
  getPreguntaFormGroup(control: AbstractControl): FormGroup {
    return control as FormGroup;
  }

  // Agregar pregunta
  agregarPregunta(): void {
    const nuevaPregunta = this.fb.group({
      texto: ['', Validators.required],
      tipo: ['respuesta-corta', Validators.required],
      categoria: ['Sin Categoría'],
      opciones: this.fb.array([]),
    });
    this.preguntasArray.push(nuevaPregunta);
  }

  // Eliminar pregunta
  eliminarPregunta(index: number): void {
    this.preguntasArray.removeAt(index);
  }

  // Manejo de tipo de pregunta
  onTipoPreguntaChange(index: number): void {
    const pregunta = this.preguntasArray.at(index) as FormGroup;
    const tipo = pregunta.get('tipo')?.value;

    // Limpiar opciones si existen
    const opcionesArray = pregunta.get('opciones') as FormArray;
    opcionesArray.clear();

    // Si el tipo es "likert", agregar opciones por defecto
    if (tipo === 'likert') {
      opcionesArray.push(this.fb.control('Muy en Desacuerdo'));
      opcionesArray.push(this.fb.control('Neutral'));
      opcionesArray.push(this.fb.control('Muy de Acuerdo'));
    }
  }

  // Obtener opciones de una pregunta
  getOpcionesArray(index: number): FormArray {
    return this.preguntasArray.at(index).get('opciones') as FormArray;
  }

  // Agregar opción
  agregarOpcion(index: number): void {
    const opciones = this.getOpcionesArray(index);
    if (opciones.length < 7) {
      opciones.push(this.fb.control('', Validators.required));
    }
  }

  // Eliminar opción
  eliminarOpcion(preguntaIndex: number, opcionIndex: number): void {
    const opciones = this.getOpcionesArray(preguntaIndex);
    opciones.removeAt(opcionIndex);
  }

  // Guardar borrador
  guardarBorrador(): void {
    console.log('Borrador guardado', this.encuestaForm.value);
  }

  // Publicar encuesta
  guardarEncuesta(): void {
    console.log('Encuesta publicada', this.encuestaForm.value);
  }

}
