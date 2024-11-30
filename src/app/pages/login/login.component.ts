import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { AuthService } from '../../core/services/auth.service';
import Swal from 'sweetalert2';


@Component({
  selector: 'app-login',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule, FormsModule],
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
      });
      return;
    }

    const credentials = { correo: this.correo, password: this.password };

    this.authService.login(credentials).subscribe(
      (user) => {
        this.authService.setCurrentUser(user);

        Swal.fire({
          icon: 'success',
          title: 'Inicio de sesión exitoso',
          text: `Bienvenido, ${user.nombres || 'Usuario'}`,
        }).then(() => {
          this.redirectUserByRole();
        });
      },
      (error) => {
        Swal.fire({
          icon: 'error',
          title: 'Error al iniciar sesión',
          text: 'Correo o contraseña incorrectos. Por favor, intenta nuevamente.',
        });
        console.error('Error al iniciar sesión:', error);
      }
    );
  }

  // Redirigir al usuario según su rol
  private redirectUserByRole(): void {
    const user = this.authService.getCurrentUser();

    if (!user) {
      this.router.navigate(['/login']);
      return;
    }

    if (this.authService.isAdmin()) {
      this.router.navigate(['/dash-admin']);
    } else if (this.authService.isStudent()) {
      this.router.navigate(['/dash-student']);
    } else {
      this.router.navigate(['/login']);
    }
  }

}
