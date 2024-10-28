import { Component, OnInit } from '@angular/core';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Router } from '@angular/router'; // Importa Router

@Component({
  selector: 'app-datos-demo',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  templateUrl: './datos-demo.component.html',
  styleUrls: ['./datos-demo.component.scss'] // Corrige 'styleUrl' a 'styleUrls'
})
export class DatosDemoComponent implements OnInit {
  cuestionarioForm: FormGroup;
  questions: string[] = [
    '5. ¿Es usted miembro actual o alumno de una institucion?',
    '6. ¿Es usted miembro de alguna organizacion referente al servicio?',
    '7. ¿Ha sido voluntario durante los últimos doce meses?',
  ];
  options: string[] = ['Sí', 'No'];

  currentPage: number = 0;
  itemsPerPage: number = 5;

  constructor(private fb: FormBuilder, private router: Router) { // Inyecta Router
    this.cuestionarioForm = this.fb.group({
      matricula: ['', [
        Validators.required,
        Validators.pattern(/^\d{4,6}$/)
      ]],
      genero: ['', Validators.required],
      otroGenero: [''],
      edad: ['', [
        Validators.required,
        Validators.min(0),
        Validators.max(999)
      ]],
      descripcion: ['', Validators.required],
      otroDescripcion: [''],
      question1: ['', Validators.required],
      question2: ['', Validators.required],
      question3: ['', Validators.required],
      participacion: ['', Validators.required],
      question8: ['', Validators.required]
    });
  }

  ngOnInit() {
    this.cuestionarioForm.get('genero')?.valueChanges.subscribe(value => {
      const otroGeneroControl = this.cuestionarioForm.get('otroGenero');
      if (value === 'otro') {
        otroGeneroControl?.setValidators(Validators.required);
      } else {
        otroGeneroControl?.clearValidators();
      }
      otroGeneroControl?.updateValueAndValidity();
    });

    this.cuestionarioForm.get('descripcion')?.valueChanges.subscribe(value => {
      const otroDescripcionControl = this.cuestionarioForm.get('otroDescripcion');
      if (value === 'Otro') {
        otroDescripcionControl?.setValidators(Validators.required);
      } else {
        otroDescripcionControl?.clearValidators();
      }
      otroDescripcionControl?.updateValueAndValidity();
    });
  }

  get matricula() {
    return this.cuestionarioForm.get('matricula');
  }

  get genero() {
    return this.cuestionarioForm.get('genero');
  }

  get otroGenero() {
    return this.cuestionarioForm.get('otroGenero');
  }

  get edad() {
    return this.cuestionarioForm.get('edad');
  }

  get descripcion() {
    return this.cuestionarioForm.get('descripcion');
  }

  get otroDescripcion() {
    return this.cuestionarioForm.get('otroDescripcion');
  }

  get question1() {
    return this.cuestionarioForm.get('question1');
  }

  get question2() {
    return this.cuestionarioForm.get('question2');
  }

  get question3() {
    return this.cuestionarioForm.get('question3');
  }

  get participacion() {
    return this.cuestionarioForm.get('participacion');
  }

  get question8() {
    return this.cuestionarioForm.get('question8');
  }

  // Método para navegar a la página siguiente
  nextPage() {
    if (this.cuestionarioForm.valid) {
      this.router.navigate(['/cuestionario']); // Cambia la ruta a tu página de encuesta
    } else {
      this.cuestionarioForm.markAllAsTouched(); // Marca todos los campos como tocados
      alert('Por favor, completa todos los campos antes de continuar.');
    }
  }

  // Método para navegar a la página anterior
  previousPage() {
    if (this.currentPage > 0) {
      this.currentPage--;
    }
  }

  getTotalPages() {
    return Math.ceil((this.questions.length + 1) / this.itemsPerPage);
  }

  onSubmit() {
    if (this.cuestionarioForm.valid) {
      const formData = this.cuestionarioForm.value;
      console.log('Formulario válido:', formData);
    } else {
      this.cuestionarioForm.markAllAsTouched();
    }
  }
}

