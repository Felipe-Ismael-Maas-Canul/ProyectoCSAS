import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { RouterModule } from '@angular/router';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { AuthService } from '../../core/services/auth.service';
import Swal from 'sweetalert2';


@Component({
  selector: 'app-login',
  standalone: true,
  imports: [
    CommonModule,
    RouterModule,
    ReactiveFormsModule,
    FormsModule,],
  templateUrl: './login.component.html',
  styleUrl: './login.component.scss'
})
export class LoginComponent {
  correo: string = '';
  password: string = '';

  constructor(private authService: AuthService, private router: Router) {}

  // Método para manejar el inicio de sesión
  login(): void {
    if (!this.correo || !this.password) {
      Swal.fire({
        icon: 'error',
        title: 'Campos obligatorios',
        text: 'Por favor, ingresa tu correo y contraseña.',
        confirmButtonColor: '#53c1b4', // Cambia el color del botón de confirmación
      });
      return;
    }

    const credentials = { correo: this.correo, password: this.password };

    this.authService.login(credentials).subscribe(
      (response) => {
        if (response && response.success) {
          const user = response.user;
          this.authService.setCurrentUser(user); // Guardar el usuario actual

          Swal.fire({
            icon: 'success',
            title: 'Inicio de sesión exitoso',
            text: `Bienvenido, ${user.nombres || 'Usuario'}`,
            confirmButtonColor: '#53c1b4',
          }).then(() => {
            this.redirectUserByRole(user.tipo); // Pasar el tipo de usuario
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error al iniciar sesión',
            text: response.message,
            confirmButtonColor: '#53c1b4',
          });
        }
      },
      (error) => {
        Swal.fire({
          icon: 'error',
          title: 'Error al iniciar sesión',
          text: 'Correo o contraseña incorrectos. Por favor, intenta nuevamente.',
          confirmButtonColor: '#53c1b4',
        });
        console.error('Error al iniciar sesión:', error);
      }
    );
  }

  private redirectUserByRole(tipo: string): void {
    if (tipo === 'Administrador') {
      this.router.navigate(['/admin/dash-admin']);
    } else if (tipo === 'Alumno') {
      this.router.navigate(['/student/dash-student']);
    } else {
      this.router.navigate(['/login']); // Por defecto, vuelve al login si no tiene rol
    }
  }

}
