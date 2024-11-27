import { Component } from '@angular/core';
import { ReactiveFormsModule} from '@angular/forms';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { CreateStudent } from '../../../core/models/users';
import { UserService } from '../../../core/services/user.service';

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
    confirmPassword:'',
    tipo: 'Alumno',
    Alumno_Matricula: '',
    genero:'',
    edad: 0,
  };

  constructor(private userService: UserService) {}


  // Método para manejar el envío del formulario
  onSubmit(): void {
    if (this.validatePasswordsMatch()) {
      console.log('Formulario enviado:', this.student);
      // Aquí puedes agregar la lógica para enviar los datos al backend.
    } else {
      alert('Las contraseñas no coinciden.');
    }

      // Convertir edad a número
    this.student.edad = Number(this.student.edad);

    if (isNaN(this.student.edad)) {
      console.error('La edad debe ser un número válido');
      return;
    }

  }

  // Validar que las contraseñas coincidan
  validatePasswordsMatch(): boolean {
    return this.student.password === this.student.confirmPassword;
  }



  registerStudent(): void {
    this.userService.registerStudent(this.student).subscribe(
      (response) => {
        console.log('Estudiante registrado:', response.message);
      },
      (error) => {
        console.error('Error al registrar estudiante:', error);
      }
    );
  }

}
