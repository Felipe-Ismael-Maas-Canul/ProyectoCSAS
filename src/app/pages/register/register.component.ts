import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms'; // Importa FormsModule
import { CreateStudent, CreateAdmin } from '../../core/models/users';
import { UserService } from '../../core/services/user.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './register.component.html',
  styleUrl: './register.component.scss'
})
export class RegisterComponent {
  user: Partial<CreateStudent | CreateAdmin> = {
    tipo: '',// Rol del usuario
    nombres: '',
    primer_apellido: '',
    segundo_apellido: '',
    correo: '',
    password: '',
    confirmPassword: '',
    genero: '',
    edad: 0,
  };


  isStudent = true; // Controla los campos visibles

  constructor(private userService: UserService, private router: Router) {}

  toggleFields() {
    this.isStudent = this.user.tipo === 'Alumno';
    if (this.isStudent) {
      this.user.Administrador_idAdministrador = null;
    } else {
      this.user.matricula = null;
      this.user.Alumno_Matricula = null;
    }
  }

  onSubmit() {
    if (this.user.password !== this.user.confirmPassword) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Las contraseñas no coinciden.',
        confirmButtonColor: '#53c1b4', // Cambia el color del botón de confirmación
      });
      return;
    }

    if (this.isStudent) {
      const studentData: CreateStudent = {
        idUsuario: this.user.idUsuario ?? 0, // Asignar un valor predeterminado
        nombres: this.user.nombres || '', // Asegurar que sea un string
        primer_apellido: this.user.primer_apellido || '',
        segundo_apellido: this.user.segundo_apellido || '',
        correo: this.user.correo || '',
        password: this.user.password || '',
        confirmPassword: this.user.confirmPassword || '',
        tipo: this.user.tipo || '',
        genero: this.user.genero || '',
        edad: this.user.edad ?? 0, // Asegurar que no sea undefined
        matricula: this.user.matricula || '',
        Alumno_Matricula: this.user.Alumno_Matricula || '',
        Administrador_idAdministrador: null, // Específicamente null para estudiantes
      };

      this.userService.registerStudent(studentData).subscribe(
        (response) => {
          Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'Alumno registrado correctamente.',
            confirmButtonColor: '#53c1b4', // Cambia el color del botón de confirmación
          }).then(() => {
            this.router.navigate(['/login']);
          });
        },
        (error) => {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo registrar al alumno.',
            confirmButtonColor: '#53c1b4', // Cambia el color del botón de confirmación
          });
        }
      );
    } else {
      const adminData: CreateAdmin = {
        idUsuario: this.user.idUsuario ?? 0, // Asignar un valor predeterminado
        nombres: this.user.nombres || '', // Asegurar que sea un string
        primer_apellido: this.user.primer_apellido || '',
        segundo_apellido: this.user.segundo_apellido || '',
        correo: this.user.correo || '',
        password: this.user.password || '',
        confirmPassword: this.user.confirmPassword || '',
        tipo: this.user.tipo || '',
        genero: this.user.genero || '',
        edad: this.user.edad || 0,
        matricula: null,
        Alumno_Matricula: null,
        Administrador_idAdministrador: (this.user.Administrador_idAdministrador || '').toString(), // Convertir a string
      };

      this.userService.registerAdmin(adminData).subscribe(
        (response) => {
          Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'Administrador registrado correctamente.',
            confirmButtonColor: '#53c1b4', // Cambia el color del botón de confirmación
          }).then(() => {
            this.router.navigate(['/login']);
          });
        },
        (error) => {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo registrar al administrador.',
            confirmButtonColor: '#53c1b4', // Cambia el color del botón de confirmación
          });
        }
      );
    }
  }

}

