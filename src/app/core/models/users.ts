//Modelo para Usuario
export interface CreateUserBase {
  idUsuario?: number; // Clave primaria (opcional al crear)
  tipo: string; // Tipo de usuario ('Alumno' o 'Administrador')
  nombres: string; // Nombres del usuario
  primer_apellido: string; // Primer apellido
  segundo_apellido: string; // Segundo apellido
  correo: string; // Correo electrónico
  password: string; // Contraseña
  confirmPassword: string; // Confirmación de contraseña
  genero: string; // Género
  edad: number; // Edad del usuario
}

//Modelo para Usuario de tipo Alumno
export interface CreateStudent extends CreateUserBase {
  tipo: "Alumno"; // Siempre "Alumno"
  matricula: string; // Matrícula del estudiante
  Administrador_idAdministrador?: null; // Siempre nulo para estudiantes
  Carreras_idCarrera: number; // Carrera asociada
  grupo: string; // Grupo del estudiante
  semestre: number; // Semestre del estudiante
  Institucion_idInstitucion: number; // Institución a la que pertenece
}

//Modelo para Usuario de tipo Admin
export interface CreateAdmin extends CreateUserBase {
  tipo: "Administrador"; // Siempre "Administrador"
  matricula?: null; // Sin matrícula para administradores
  id_admin: string; // Relación con el modelo Administrador
  Institucion_idInstitucion: number; // Institución a la que pertenece
}

////////////////////////////////////////////////////////////////////////////////////

export interface getAdmis {
  idUsuario: number;
  nombres: string;
  primer_apellido: string;
  segundo_apellido: string;
  correo: string;
  tipo: "Administrador"; // Siempre "Administrador"
  Administrador_idAdministrador: string;
}

export interface getStudents {
  idUsuario: number;
  matricula: string;
  nombres: string;
  primer_apellido: string;
  segundo_apellido: string;
  correo: string;
  tipo: "Alumno"; // Siempre "Alumno"
  Carreras_idCarrera: number; // Carrera asociada
  grupo: string; // Grupo del estudiante
  semestre: number; // Semestre del estudiante
  Institucion_idInstitucion: number; // Institución a la que pertenece
}

export interface UpdateAdmi {
  idUsuario: number;
  nombres?: string;
  primer_apellido?: string;
  segundo_apellido?: string;
  correo?: string;
  Administrador_idAdministrador?: string;
  Institucion_idInstitucion?: number;
}
