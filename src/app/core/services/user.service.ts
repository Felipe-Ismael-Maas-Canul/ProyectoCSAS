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
  private apiUrl = "http://localhost:8000/api/Usuarios";

  constructor(private http: HttpClient) { }

  // Registrar estudiante
  registerStudent(student: CreateStudent): Observable<ResponsePPD> {
    return this.http.post<ResponsePPD>(`${this.apiUrl}/register-student`, student);
  }

  // Registrar administrador
  registerAdmin(admin: CreateAdmin): Observable<ResponsePPD> {
    return this.http.post<ResponsePPD>(`${this.apiUrl}/register-admin`, admin);
  }

  // Obtener todos los administradores
  getAdmins(): Observable<ResponseGet<getAdmis[]>> {
    return this.http.get<ResponseGet<getAdmis[]>>(`${this.apiUrl}/admins`);
  }

  // Obtener todos los estudiantes
  getStudents(): Observable<ResponseGet<getStudents[]>> {
    return this.http.get<ResponseGet<getStudents[]>>(`${this.apiUrl}/students`);
  }

  // Actualizar administrador
  updateAdmin(id: number, admin: UpdateAdmi): Observable<ResponsePPD> {
    return this.http.put<ResponsePPD>(`${this.apiUrl}/admins/${id}`, admin);
  }

  // Obtener todos los usuarios (general)
  getAllUsers(): Observable<ResponseGet<CreateUserBase[]>> {
    return this.http.get<ResponseGet<CreateUserBase[]>>(`${this.apiUrl}/users`);
  }

}
