import { Component } from '@angular/core';
import { ReactiveFormsModule} from '@angular/forms';
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
export class StudentRegisterComponent {
  student: CreateStudent = {
    idUsuario: 0,
    matricula: '',
    nombres: '',
    primer_apellido: '',
    segundo_apellido: '',
    correo: '',
    password: '',
    confirmPassword: '',
    tipo: 'Alumno',
    Alumno_Matricula: '',
    genero: '',
    edad: 0,
  };

  isSubmitting = false; // Estado para evitar múltiples envíos

  constructor(private userService: UserService, private router: Router) {}

  // Método para manejar el envío del formulario
  onSubmit(): void {
    if (!this.validatePasswordsMatch()) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Las contraseñas no coinciden. Por favor, verifica e inténtalo nuevamente.',
      });
      return;
    }

    // Convertir edad a número (si está como string)
    this.student.edad = Number(this.student.edad);

    if (isNaN(this.student.edad)) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'La edad debe ser un número válido.',
      });
      return;
    }

    this.isSubmitting = true;

    this.userService.registerStudent(this.student).subscribe(
      (response) => {
        Swal.fire({
          icon: 'success',
          title: 'Registro Exitoso',
          text: 'El estudiante ha sido registrado correctamente.',
        }).then(() => {
          // Redirigir al login tras el registro (opcional)
          this.router.navigate(['/login']);
        });
        this.isSubmitting = false;
      },
      (error) => {
        // Manejo de errores desde el backend
        if (error.status === 400) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'La matrícula ya está registrada. Por favor, utiliza una diferente.',
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al registrar al estudiante. Por favor, inténtalo de nuevo.',
          });
        }
        console.error('Error al registrar estudiante:', error);
        this.isSubmitting = false;
      }
    );
  }

  // Validar que las contraseñas coincidan
  validatePasswordsMatch(): boolean {
    return this.student.password === this.student.confirmPassword;
  }

}
