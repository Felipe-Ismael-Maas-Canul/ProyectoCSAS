import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, of } from 'rxjs';
import { tap, catchError } from 'rxjs/operators';


@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private apiUrl = 'http://localhost:8000/api'; // URL base de tu API
  private currentUser: any = null; // Usuario autenticado

  constructor(private http: HttpClient) { }

  /**
   * Método para iniciar sesión.
   * @param credentials Credenciales del usuario (correo y contraseña).
   * @returns Observable con los datos del usuario autenticado.
   */
  login(credentials: { correo: string; password: string }): Observable<any> {
    return this.http.post<any>(`${this.apiUrl}/login`, credentials).pipe(
      tap((response) => {
        if (response.success) {
          this.setCurrentUser(response.user); // Guardar usuario autenticado
        }
      }),
      catchError((error) => {
        console.error('Error en el inicio de sesión:', error);
        throw error;
      })
    );
  }


  /**
   * Establece el usuario autenticado en memoria.
   * @param user Datos del usuario autenticado.
   */
  setCurrentUser(user: any): void {
    this.currentUser = user;
    localStorage.setItem('currentUser', JSON.stringify(user)); // Almacenar en localStorage
  }

  /**
   * Obtiene el usuario autenticado.
   * @returns Datos del usuario autenticado.
   */
  getCurrentUser(): any {
    if (!this.currentUser) {
      const storedUser = localStorage.getItem('currentUser');
      if (storedUser) {
        this.currentUser = JSON.parse(storedUser);
      }
    }
    return this.currentUser;
  }


  /**
   * Verifica si el usuario es administrador.
   * @returns True si el usuario es administrador.
   */
  isAdmin(): boolean {
    const user = this.getCurrentUser();
    return user && user.tipo === 'Administrador';
  }

  /**
   * Verifica si el usuario es estudiante.
   * @returns True si el usuario es estudiante.
   */
  isStudent(): boolean {
    const user = this.getCurrentUser();
    return user && user.tipo === 'Alumno';
  }

  /**
   * Verifica si hay un usuario autenticado.
   * @returns True si hay un usuario autenticado.
   */
  isAuthenticated(): boolean {
    return !!this.getCurrentUser();
  }


  /**
   * Método para cerrar sesión.
   */
  logout(): void {
    this.currentUser = null;
    localStorage.removeItem('currentUser'); // Eliminar del almacenamiento local
  }

}
