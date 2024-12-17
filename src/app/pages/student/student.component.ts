import { Component } from '@angular/core';
import { RouterModule } from '@angular/router';

@Component({
  selector: 'app-student',
  standalone: true,
  imports: [RouterModule],
  templateUrl: './student.component.html',
  styleUrl: './student.component.scss'
})
export class StudentComponent {
  isSidebarHidden = false;
  userName = 'Juan Pérez';
  userEmail = 'juanperez@example.com';
  userAvatar = this.getAvatar('male'); // Cambiar a 'female' o 'other'

  toggleSidebar() {
    this.isSidebarHidden = !this.isSidebarHidden;
  }

  getAvatar(gender: string): string {
    switch (gender) {
      case 'male':
        return '../../../assets/avatars/male-avatar.png';
      case 'female':
        return '../../../assets/avatars/female-avatar.png';
      default:
        return '../../../assets/avatars/other-two.png';
    }
  }

  logout() {
    console.log('Cerrando sesión...');
    // Lógica para cerrar sesión
  }
}
