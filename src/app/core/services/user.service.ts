import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { getAdmis, getStudents, UpdateAdmi } from '../models/users';
import { CreateUserBase, CreateStudent, CreateAdmin } from '../models/users';
import { ResponseGet, ResponsePPD } from '../models/responses';

@Injectable({
  providedIn: 'root',
})
export class UserService {
  // URL base de la API
  private apiUrl = 'http://localhost:8000/api';

  constructor(private http: HttpClient) {}

  /**
   * Registrar un estudiante
   * @param student Datos del estudiante
   */
  registerStudent(student: CreateStudent): Observable<any> {
    return this.http.post<any>(`${this.apiUrl}/Usuarios`, student);
  }


  /**
   * Registrar un administrador
   * @param admin Datos del administrador
   */
  registerAdmin(admin: CreateAdmin): Observable<ResponsePPD> {
    return this.http.post<ResponsePPD>(`${this.apiUrl}/Usuarios`, admin);
  }

  /**
   * Obtener todos los administradores
   */
  getAdmins(): Observable<ResponseGet<CreateUserBase[]>> {
    return this.http.get<ResponseGet<CreateUserBase[]>>(
      `${this.apiUrl}/Usuarios?tipo=Administrador`
    );
  }

  /**
   * Obtener todos los estudiantes
   */
  getStudents(): Observable<ResponseGet<CreateUserBase[]>> {
    return this.http.get<ResponseGet<CreateUserBase[]>>(
      `${this.apiUrl}/Usuarios?tipo=Alumno`
    );
  }

  /**
   * Actualizar un administrador
   * @param id ID del administrador a actualizar
   * @param admin Datos a actualizar
   */
  updateAdmin(id: number, admin: UpdateAdmi): Observable<ResponsePPD> {
    return this.http.put<ResponsePPD>(`${this.apiUrl}/Usuarios/${id}`, admin);
  }

  /**
   * Obtener todos los usuarios (sin filtro)
   */
  getAllUsers(): Observable<ResponseGet<CreateUserBase[]>> {
    return this.http.get<ResponseGet<CreateUserBase[]>>(`${this.apiUrl}/Usuarios`);
  }

  deleteUser(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/Usuarios/${id}`);
  }

}
