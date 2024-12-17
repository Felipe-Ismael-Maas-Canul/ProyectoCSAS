import { Component } from '@angular/core';
import { RouterModule } from '@angular/router';

@Component({
  selector: 'app-admin',
  standalone: true,
  imports: [RouterModule],
  templateUrl: './admin.component.html',
  styleUrl: './admin.component.scss'
})
export class AdminComponent {
  isSidebarHidden = false;
  userName = 'John Doe';
  userEmail = 'johndoe@example.com';
  userAvatar = this.getAvatar('other'); // Cambiar a 'female' o 'other'

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
