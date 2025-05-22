import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { DocumentService, Document, DocumentOptions } from '../../services/document.service';

@Component({
  selector: 'app-document-list',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './document-list.component.html',
  styleUrls: ['./document-list.component.css']
})
export class DocumentListComponent implements OnInit {
  documents: Document[] = [];
  documentOptions: DocumentOptions = {
    types: [],
    formats: []
  };
  documentTypes: string[] = [];
  documentFormats: string[] = [];
  selectedType: string = '';
  selectedFormat: string = '';

  constructor(
    private documentService: DocumentService,
    public router: Router
  ) {}

  ngOnInit() {
    this.loadDocuments();
    this.loadDocumentOptions();
    this.loadDocumentTypes();
    this.loadDocumentFormats();
  }

  loadDocuments() {
    this.documentService.getFilteredDocuments(
      this.selectedType || undefined,
      this.selectedFormat || undefined
    ).subscribe({
      next: (data) => {
        this.documents = data;
      },
      error: (error) => {
        console.error('Error loading documents:', error);
      }
    });
  }

  loadDocumentOptions() {
    this.documentService.getDocumentOptions().subscribe({
      next: (options) => {
        this.documentOptions = options;
      },
      error: (error) => {
        console.error('Error loading document options:', error);
      }
    });
  }

  loadDocumentTypes() {
    this.documentService.getDocumentTypes().subscribe({
      next: (types) => {
        this.documentTypes = types;
      },
      error: (error) => {
        console.error('Error loading document types:', error);
      }
    });
  }

  loadDocumentFormats() {
    this.documentService.getDocumentFormats().subscribe({
      next: (formats) => {
        this.documentFormats = formats;
      },
      error: (error) => {
        console.error('Error loading document formats:', error);
      }
    });
  }

  deleteDocument(id: number) {
    if (confirm('Are you sure you want to delete this document?')) {
      this.documentService.deleteDocument(id).subscribe({
        next: () => {
          this.loadDocuments();
        },
        error: (err) => console.error('Error deleting document', err)
      });
    }
  }

  applyFilters() {
    this.loadDocuments();
  }

  clearFilters() {
    this.selectedType = '';
    this.selectedFormat = '';
    this.loadDocuments();
  }
}
