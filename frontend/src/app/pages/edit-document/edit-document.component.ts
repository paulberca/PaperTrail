import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';
import { DocumentService, Document, DocumentOptions } from '../../services/document.service';

@Component({
  selector: 'app-edit-document',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './edit-document.component.html',
  styleUrls: ['./edit-document.component.css']
})
export class EditDocumentComponent implements OnInit {
  document: Document | null = null;
  documentOptions: DocumentOptions = {
    types: [],
    formats: []
  };
  formErrors = {
    author: '',
    title: '',
    pages: '',
    type: '',
    format: ''
  };

  constructor(
    private documentService: DocumentService,
    public router: Router,
    private route: ActivatedRoute
  ) {}

  ngOnInit() {
    const id = this.route.snapshot.paramMap.get('id');
    if (id) {
      this.documentService.getDocuments().subscribe({
        next: (docs) => {
          const doc = docs.find(d => d.id === Number(id));
          if (doc) {
            this.document = { ...doc };
          } else {
            this.router.navigate(['/']);
          }
        },
        error: (err) => {
          console.error('Error loading document', err);
          this.router.navigate(['/']);
        }
      });
    }

    this.documentService.getDocumentOptions().subscribe({
      next: (options) => {
        this.documentOptions = options;
      },
      error: (err) => console.error('Error loading document options', err)
    });
  }

  validateForm(): boolean {
    if (!this.document) return false;
    
    let isValid = true;
    this.formErrors = {
      author: '',
      title: '',
      pages: '',
      type: '',
      format: ''
    };

    if (!this.document.author.trim()) {
      this.formErrors.author = 'Author is required';
      isValid = false;
    }

    if (!this.document.title.trim()) {
      this.formErrors.title = 'Title is required';
      isValid = false;
    }

    if (!this.document.pages || this.document.pages <= 0) {
      this.formErrors.pages = 'Pages must be a positive number';
      isValid = false;
    }

    if (!this.document.type) {
      this.formErrors.type = 'Type is required';
      isValid = false;
    }

    if (!this.document.format) {
      this.formErrors.format = 'Format is required';
      isValid = false;
    }

    return isValid;
  }

  saveDocument() {
    if (!this.document || !this.validateForm()) {
      return;
    }

    this.documentService.updateDocument(this.document).subscribe({
      next: () => {
        this.router.navigate(['/']);
      },
      error: (err) => console.error('Error updating document', err)
    });
  }

  deleteDocument() {
    if (!this.document) return;

    if (confirm('Are you sure you want to delete this document?')) {
      this.documentService.deleteDocument(this.document.id).subscribe({
        next: () => {
          this.router.navigate(['/']);
        },
        error: (err) => console.error('Error deleting document', err)
      });
    }
  }
} 