import { Component, OnInit } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Router } from '@angular/router';
import { CreateStudent } from '../../../core/models/users';
import { UserService } from '../../../core/services/user.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-student-register',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule, FormsModule],
  templateUrl: './student-register.component.html',
  styleUrl: './student-register.component.scss'
})
export class StudentRegisterComponent implements OnInit {
  // Objeto para almacenar los datos del estudiante
  student: any = {
    tipo: "Alumno", // Especificar siempre el tipo de usuario
    matricula: '',
    nombres: '',
    primer_apellido: '',
    segundo_apellido: '',
    correo: '',
    password: '',
    confirmPassword: '',
    genero: '',
    edad: null,
    Carreras_idCarrera: null,
    Institucion_idInstitucion: null,
    grupo: '',
    semestre: null,
  };

  instituciones: any[] = []; // Lista de institutos
  carreras: any[] = []; // Lista de carreras

  constructor(private userService: UserService, private router: Router) {}

  ngOnInit(): void {
    this.loadCarreras(); // Carga las carreras al iniciar
    this.loadInstituciones(); // Carga los institutos al iniciar
  }

  /**
   * Cargar las instituciones desde la base de datos
   */
  loadInstituciones(): void {
    this.userService.getInstituciones().subscribe(
      (response) => {
        this.instituciones = response;
      },
      (error) => {
        console.error('Error al cargar las instituciones:', error);
      }
    );
  }

  /**
   * Cargar las carreras desde la base de datos
   */
  loadCarreras(): void {
    this.userService.getCarreras().subscribe(
      (response) => {
        this.carreras = response;
      },
      (error) => {
        console.error('Error al cargar las carreras:', error);
      }
    );
  }

  // Registrar estudiante
  registerStudent(): void {
    // Validación de contraseñas
    if (this.student.password !== this.student.confirmPassword) {
      Swal.fire({
        icon: 'error',
        title: 'Error en el registro',
        text: 'Las contraseñas no coinciden.',
        confirmButtonColor: '#53c1b4', // Color del botón de confirmación
      });
      return;
    }

    // Enviar datos del estudiante al servicio
    this.userService.registerStudent(this.student).subscribe(
      (response) => {
        // Mostrar mensaje de éxito
        Swal.fire({
          icon: 'success',
          title: 'Registro exitoso',
          text: `Bienvenido ${this.student.nombres} ha sido registrado correctamente.`,
          confirmButtonColor: '#53c1b4',
        }).then(() => {
          this.router.navigate(['/login']); // Redirigir al login después del registro
        });
      },
      (error) => {
        // Manejar errores
        Swal.fire({
          icon: 'error',
          title: 'Error al registrar',
          text: error.error?.message || 'Ocurrió un error al registrar al estudiante.',
          confirmButtonColor: '#53c1b4',
        });
        console.error('Error al registrar al estudiante:', error);
      }
    );
  }
}
