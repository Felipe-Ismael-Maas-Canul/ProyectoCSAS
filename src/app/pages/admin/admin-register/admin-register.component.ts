import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators} from '@angular/forms';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { CreateAdmin } from '../../../core/models/users';
import { UserService } from '../../../core/services/user.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-admin-register',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule, FormsModule],
  templateUrl: './admin-register.component.html',
  styleUrl: './admin-register.component.scss'
})
export class AdminRegisterComponent {
  /*admin: CreateAdmin = {
    idUsuario: 0,
    nombres: '',
    primer_apellido: '',
    segundo_apellido: '',
    correo: '',
    password: '', // Contraseña principal
    confirmPassword: '', // Campo para confirmar la contraseña
    tipo: 'Administrador',
    Administrador_idAdministrador: 0,
    genero: '',
  };

  isSubmitting = false;

  constructor(private userService: UserService, private router: Router) {}

  // Función para validar si las contraseñas coinciden
  validatePasswordsMatch(): boolean {
    return this.admin.password === this.admin.confirmPassword;
  }

  // Método que se ejecuta al enviar el formulario
  onSubmit(): void {
    if (!this.validatePasswordsMatch()) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Las contraseñas no coinciden. Por favor, verifica e inténtalo nuevamente.',
      });
      return;
    }

    this.isSubmitting = true; // Desactivar el botón mientras se envían los datos

    // Lógica para enviar datos al backend
    this.userService.registerAdmin(this.admin).subscribe(
      (response) => {
        Swal.fire({
          icon: 'success',
          title: 'Registro Exitoso',
          text: 'El administrador ha sido registrado correctamente.',
        }).then(() => {
          this.router.navigate(['/login']); // Redirige al login tras el registro
        });
        this.isSubmitting = false;
      },
      (error) => {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Hubo un problema al registrar al administrador. Por favor, inténtalo de nuevo.',
        });
        console.error('Error al registrar:', error);
        this.isSubmitting = false;
      }
    );
  }*/

}
