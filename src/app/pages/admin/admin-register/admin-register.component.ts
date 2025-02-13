import { Component, OnInit } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Router } from '@angular/router';
import { CreateAdmin } from '../../../core/models/users';
import { UserService } from '../../../core/services/user.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-admin-register',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule, FormsModule],
  templateUrl: './admin-register.component.html',
  styleUrl: './admin-register.component.scss',
})
export class AdminRegisterComponent implements OnInit {
  // Objeto para almacenar los datos del administrador
  admin: CreateAdmin = {
    tipo: 'Administrador', // Siempre "Administrador"
    id_admin:'',
    nombres: '',
    primer_apellido: '',
    segundo_apellido: '',
    correo: '',
    password: '',
    confirmPassword: '',
    genero: '',
    edad: 0,
    Institucion_idInstitucion: 0,
  };

  instituciones: any[] = []; // Lista de institutos disponibles

  constructor(private userService: UserService, private router: Router) {}

  ngOnInit(): void {
    this.loadInstituciones(); // Carga las instituciones al iniciar
  }

  /**
   * Cargar las instituciones desde la base de datos
   */
  loadInstituciones(): void {
    this.userService.getInstituciones().subscribe(
      (response) => {
        this.instituciones = response.instituciones; // Accedemos al array de instituciones
      },
      (error) => {
        console.error('Error al cargar las instituciones:', error);
      }
    );
  }

  /**
   * Registrar administrador
   */
  registerAdmin(): void {
    if (this.admin.password !== this.admin.confirmPassword) {
      Swal.fire({
        icon: 'error',
        title: 'Error en las contraseñas',
        text: 'Las contraseñas no coinciden. Por favor, verifica.',
        confirmButtonColor: '#53c1b4',
      });
      return;
    }

    this.userService.registerAdmin(this.admin).subscribe(
      (response) => {
        Swal.fire({
          icon: 'success',
          title: 'Registro exitoso',
          text: `El administrador ${this.admin.nombres} ha sido registrado correctamente.`,
          confirmButtonColor: '#53c1b4',
        }).then(() => {
          this.router.navigate(['/login']); // Redirige al login tras registro exitoso
        });
      },
      (error) => {
        Swal.fire({
          icon: 'error',
          title: 'Error al registrar',
          text: 'Ocurrió un error al registrar al administrador. Por favor, intenta de nuevo.',
          confirmButtonColor: '#53c1b4',
        });
        console.error('Error al registrar al administrador:', error);
      }
    );
  }
}
