import { Component } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { DatosDemoComponent } from '../datos-demo/datos-demo.component';
import { CuestionarioComponent } from '../cuestionario/cuestionario.component';
import { HeaderComponent } from '../../core/layouts/header/header.component';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [ReactiveFormsModule, FormsModule, DatosDemoComponent, CuestionarioComponent, HeaderComponent],
  templateUrl: './home.component.html',
  styleUrl: './home.component.scss'
})
export class HomeComponent {

}
