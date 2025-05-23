import { Component } from '@angular/core';
import { RouterOutlet, Router } from '@angular/router';
import { AuthService } from './services/document.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-root',
  imports: [RouterOutlet, CommonModule],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'frontend';

  constructor(private auth: AuthService, private router: Router) {
    this.auth.checkSession().subscribe({
      error: () => {
        if (this.router.url !== '/login') {
          this.router.navigate(['/login']);
        }
      }
    });
  }
}
