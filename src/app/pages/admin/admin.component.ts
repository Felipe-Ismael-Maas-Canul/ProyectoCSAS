import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { RouterModule } from '@angular/router';
import { AuthService } from '../../core/services/auth.service';
import Swal from 'sweetalert2';


@Component({
  selector: 'app-admin',
  standalone: true,
  imports: [RouterModule],
  templateUrl: './admin.component.html',
  styleUrl: './admin.component.scss'
})
export class AdminComponent {
  isSidebarHidden = false;
    userName = '';
    userEmail = '';
    userAvatar = '';

    constructor(private authService: AuthService, private router: Router) {}

    ngOnInit(): void {
      const currentUser = this.authService.getCurrentUser();

      if (currentUser) {
        this.userName = `${currentUser.nombres} ${currentUser.primer_apellido}`;
        this.userEmail = currentUser.correo;
        this.userAvatar = this.getAvatar(currentUser.genero); // Basado en el género
      } else {
        this.router.navigate(['/login']); // Si no hay usuario autenticado, redirigir al login
      }
    }


    toggleSidebar() {
      this.isSidebarHidden = !this.isSidebarHidden;
    }

    getAvatar(gender: string): string {
      switch (gender) {
        case 'Masculino':
          return '../../../assets/avatars/male-avatar.png';
        case 'Femenino':
          return '../../../assets/avatars/female-avatar.png';
        default:
          return '../../../assets/avatars/other-avatar.png';
      }
    }

    logout() {
      Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Deseas cerrar sesión?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#53c1b4',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cerrar sesión',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          this.authService.logout(); // Cerrar sesión usando el servicio
          this.router.navigate(['/login']); // Redirigir al login
        }
      });
    }
}
