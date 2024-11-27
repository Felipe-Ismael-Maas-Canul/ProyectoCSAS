
export interface CreateUserBase {
  idUsuario: number; // Clave primaria
  nombres: string; // Nombres del usuario
  primer_apellido: string; // Primer apellido
  segundo_apellido: string; // Segundo apellido
  correo: string; // Correo electrónico
  password: string; // Contraseña
  confirmPassword: string;
  tipo: string; // Tipo de usuario ('Alumno' o 'Administrador')
  genero: string; // Género (opcional)
}


//Extensiones Específicas para Estudiantes y Administradores
export interface CreateStudent extends CreateUserBase {
  edad: number;
  matricula:string;
  Alumno_Matricula: string; // Relación con el modelo Alumno
  Administrador_idAdministrador?: null; // Siempre nulo para estudiantes
}

export interface CreateAdmin extends CreateUserBase {
  edad?:null;
  matricula?:null;
  Alumno_Matricula?: null; // Siempre nulo para administradores
  Administrador_idAdministrador: number; // Relación con el modelo Administrador
}



export interface getAdmis {
  idUsuario: number;
  nombres: string;
  primer_apellido: string;
  segundo_apellido: string;
  correo: string;
  tipo: string; // Debe ser 'Administrador'
  Administrador_idAdministrador: number;
}

export interface getStudents {
  idUsuario: number;
  matricula: string;
  nombres: string;
  primer_apellido: string;
  segundo_apellido: string;
  correo: string;
  tipo: string; // Debe ser 'Alumno'
  Alumno_Matricula: string;
}

export interface UpdateAdmi {
  idUsuario: number;
  nombres?: string;
  primer_apellido?: string;
  segundo_apellido?: string;
  correo?: string;
  Administrador_idAdministrador?: number;
}
