
export interface ResponseGet<T> {
  data: T;         // Contiene los datos devueltos por el backend
  status: number;  // Código de estado de la respuesta (200, 404, etc.)
  message: string; // Mensaje asociado a la respuesta
}

export interface ResponsePPD {
  status: number;  // Código de estado de la respuesta
  message: string; // Mensaje asociado a la operación (éxito, error, etc.)
}

export interface ErrorExcep {
  status: number;  // Código de estado de error (400, 500, etc.)
  message: string; // Mensaje descriptivo del error
}
