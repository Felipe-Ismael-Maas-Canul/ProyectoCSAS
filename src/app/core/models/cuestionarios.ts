export interface Encuesta {
  titulo: string;
  descripcion: string;
  preguntas: Pregunta[];
  categorias: number[]; // IDs de categorías
  alumnos: string[]; // Matrículas de los alumnos asignados
}

export interface Pregunta {
  texto: string;
  tipo: string; // 'respuesta-corta', 'respuesta-larga', etc.
  categoria: string;
  opciones?: string[]; // Solo para 'opcion-multiple' o 'likert'
}
