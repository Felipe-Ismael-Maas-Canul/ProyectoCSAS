import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { getAdmis, getStudents, UpdateAdmi} from '../models/users';
import { CreateUserBase, CreateStudent, CreateAdmin} from '../models/users';
import { ResponseGet, ResponsePPD } from '../models/responses';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  // URL base de la API
  private apiUrl = "http://localhost:8000/api";

  constructor(private http: HttpClient) { }

  // Registrar estudiante
  registerStudent(student: CreateStudent): Observable<ResponsePPD> {
    return this.http.post<ResponsePPD>(`${this.apiUrl}/Alumnos`, student);
  }

  // Registrar administrador
  registerAdmin(admin: CreateAdmin): Observable<ResponsePPD> {
    return this.http.post<ResponsePPD>(`${this.apiUrl}/Administrador`, admin);
  }

  // Obtener todos los administradores
  getAdmins(): Observable<ResponseGet<getAdmis[]>> {
    return this.http.get<ResponseGet<getAdmis[]>>(`${this.apiUrl}/Administrador`);
  }

  // Obtener todos los estudiantes
  getStudents(): Observable<ResponseGet<getStudents[]>> {
    return this.http.get<ResponseGet<getStudents[]>>(`${this.apiUrl}/Alumnos`);
  }

  // Actualizar administrador
  updateAdmin(id: number, admin: UpdateAdmi): Observable<ResponsePPD> {
    return this.http.put<ResponsePPD>(`${this.apiUrl}/Administrador/${id}`, admin);
  }

  // Obtener todos los usuarios (general)
  getAllUsers(): Observable<ResponseGet<CreateUserBase[]>> {
    return this.http.get<ResponseGet<CreateUserBase[]>>(`${this.apiUrl}/Usuarios`);
  }

}
