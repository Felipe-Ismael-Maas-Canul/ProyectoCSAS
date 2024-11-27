import { Component } from '@angular/core';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators} from '@angular/forms';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { CreateAdmin } from '../../../core/models/users';

@Component({
  selector: 'app-admin-register',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule, FormsModule],
  templateUrl: './admin-register.component.html',
  styleUrl: './admin-register.component.scss'
})
export class AdminRegisterComponent {
  admin: CreateAdmin = {
    idUsuario: 0,
    nombres: '',
    primer_apellido: '',
    segundo_apellido: '',
    correo: '',
    password: '', // Contraseña principal
    confirmPassword: '', // Campo para confirmar la contraseña
    tipo: 'Administrador',
    Administrador_idAdministrador: 0,
    genero:'',
  };


  // Función para validar si las contraseñas coinciden
  validatePasswordsMatch(): boolean {
    return this.admin.password === this.admin.confirmPassword;
  }

  // Método que se ejecuta al enviar el formulario
  onSubmit(): void {
    if (!this.validatePasswordsMatch()) {
      alert('Las contraseñas no coinciden. Por favor, verifícalas.');
      return;
    }


    // Lógica para procesar el registro
    console.log('Registro exitoso:', this.admin);
  }

}
