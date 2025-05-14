import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DocumentService, DocumentStats } from '../../services/document.service';

@Component({
  selector: 'app-document-stats',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './document-stats.component.html',
  styleUrls: ['./document-stats.component.css']
})
export class DocumentStatsComponent implements OnInit {
  stats: DocumentStats[] = [];
  loading = true;
  error: string | null = null;

  constructor(private documentService: DocumentService) {}

  ngOnInit() {
    this.loadStats();
  }

  loadStats() {
    this.loading = true;
    this.error = null;
    
    this.documentService.getDocumentStats().subscribe({
      next: (data) => {
        this.stats = data;
        this.loading = false;
      },
      error: (error) => {
        this.error = 'Failed to load document statistics';
        this.loading = false;
        console.error('Error loading stats:', error);
      }
    });
  }
} 