import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { DocumentService, Document, DocumentOptions } from '../../services/document.service';

@Component({
  selector: 'app-add-document',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './add-document.component.html',
  styleUrls: ['./add-document.component.css']
})
export class AddDocumentComponent implements OnInit {
  document = {
    author: '',
    title: '',
    pages: '',
    type: '',
    format: ''
  };

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
    public router: Router
  ) {}

  ngOnInit() {
    this.documentService.getDocumentOptions().subscribe({
      next: (options) => {
        this.documentOptions = options;
      },
      error: (err) => console.error('Error loading document options', err)
    });
  }

  validateForm(): boolean {
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

    if (!this.document.pages) {
      this.formErrors.pages = 'Pages is required';
      isValid = false;
    } else if (isNaN(Number(this.document.pages)) || Number(this.document.pages) <= 0) {
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

  onSubmit() {
    if (!this.validateForm()) {
      return;
    }

    this.documentService.addDocument({
      ...this.document,
      pages: parseInt(this.document.pages)
    }).subscribe({
      next: () => {
        this.router.navigate(['/']);
      },
      error: (err) => console.error('Error adding document', err)
    });
  }
} 