import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root',
})
export class CuestionarioService {
  private baseUrl = 'http://localhost:8000/api';

  constructor(private http: HttpClient) {}

  private handleError(error: any): Observable<never> {
    console.error('Ocurrió un error:', error);
    return throwError(() => new Error(error.error?.message || 'Ocurrió un error, intenta nuevamente.'));
  }

  crearEncuesta(encuestaData: any): Observable<any> {
    return this.http
      .post(`${this.baseUrl}/Encuestas`, encuestaData) // Eliminamos las cabeceras de autenticación
      .pipe(catchError(this.handleError));
  }

  obtenerCategorias(): Observable<any> {
    return this.http
      .get(`${this.baseUrl}/Categoria`) // Eliminamos las cabeceras de autenticación
      .pipe(catchError(this.handleError));
  }

  obtenerPreguntas(idEncuesta: number): Observable<any> {
    return this.http
      .get(`${this.baseUrl}/Preguntas/${idEncuesta}`) // Eliminamos las cabeceras de autenticación
      .pipe(catchError(this.handleError));
  }

  agregarPregunta(pregunta: any): Observable<any> {
    return this.http
      .post(`${this.baseUrl}/Pregunta`, pregunta) // Eliminamos las cabeceras de autenticación
      .pipe(catchError(this.handleError));
  }

  eliminarEncuesta(idEncuesta: number): Observable<any> {
    return this.http
      .delete(`${this.baseUrl}/Encuestas/${idEncuesta}`) // Eliminamos las cabeceras de autenticación
      .pipe(catchError(this.handleError));
  }

  actualizarEncuesta(idEncuesta: number, encuestaData: any): Observable<any> {
    return this.http
      .put(`${this.baseUrl}/Encuestas/${idEncuesta}`, encuestaData) // Eliminamos las cabeceras de autenticación
      .pipe(catchError(this.handleError));
  }

  obtenerEncuestas(): Observable<any> {
    return this.http
      .get(`${this.baseUrl}/Encuestas`) // Eliminamos las cabeceras de autenticación
      .pipe(catchError(this.handleError));
  }
}
