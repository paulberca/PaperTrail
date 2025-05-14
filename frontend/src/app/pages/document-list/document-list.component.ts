import { Component } from '@angular/core';
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
export class DocumentListComponent {
  documents: Document[] = [];
  documentOptions: DocumentOptions = {
    types: [],
    formats: []
  };
  editingDocument: Document | null = null;
  formErrors = {
    author: '',
    title: '',
    pages: '',
    type: '',
    format: ''
  };

  constructor(
    private documentService: DocumentService,
    public router: Router
  ) {
    this.loadDocuments();
    this.loadDocumentOptions();
  }

  loadDocuments() {
    this.documentService.getDocuments().subscribe({
      next: (docs) => this.documents = docs,
      error: (err) => console.error('Error loading documents', err)
    });
  }

  loadDocumentOptions() {
    this.documentService.getDocumentOptions().subscribe({
      next: (options) => {
        this.documentOptions = options;
      },
      error: (err) => console.error('Error loading document options', err)
    });
  }

  editDocument(doc: Document) {
    this.editingDocument = { ...doc };
  }

  validateForm(): boolean {
    if (!this.editingDocument) return false;
    
    let isValid = true;
    this.formErrors = {
      author: '',
      title: '',
      pages: '',
      type: '',
      format: ''
    };

    if (!this.editingDocument.author.trim()) {
      this.formErrors.author = 'Author is required';
      isValid = false;
    }

    if (!this.editingDocument.title.trim()) {
      this.formErrors.title = 'Title is required';
      isValid = false;
    }

    if (!this.editingDocument.pages || this.editingDocument.pages <= 0) {
      this.formErrors.pages = 'Pages must be a positive number';
      isValid = false;
    }

    if (!this.editingDocument.type) {
      this.formErrors.type = 'Type is required';
      isValid = false;
    }

    if (!this.editingDocument.format) {
      this.formErrors.format = 'Format is required';
      isValid = false;
    }

    return isValid;
  }

  saveDocument() {
    if (!this.editingDocument || !this.validateForm()) {
      return;
    }

    this.documentService.updateDocument(this.editingDocument).subscribe({
      next: () => {
        this.editingDocument = null;
        this.loadDocuments();
      },
      error: (err) => console.error('Error updating document', err)
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

  cancelEdit() {
    this.editingDocument = null;
  }
}
