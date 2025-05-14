import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface Document {
  id: number;
  author: string;
  title: string;
  pages: number;
  type: string;
  format: string;
}

export interface DocumentOptions {
  types: string[];
  formats: string[];
}

@Injectable({
  providedIn: 'root'
})
export class DocumentService {
  private baseUrl = 'http://localhost:8000/api';

  constructor(private http: HttpClient) {}

  getDocuments(): Observable<Document[]> {
    return this.http.get<Document[]>(`${this.baseUrl}/get_documents.php`);
  }

  getDocumentOptions(): Observable<DocumentOptions> {
    return this.http.get<DocumentOptions>(`${this.baseUrl}/get_document_options.php`);
  }

  addDocument(document: Omit<Document, 'id'>): Observable<any> {
    return this.http.post(`${this.baseUrl}/add_document.php`, document);
  }

  updateDocument(document: Document): Observable<any> {
    return this.http.put(`${this.baseUrl}/update_document.php`, document);
  }

  deleteDocument(id: number): Observable<any> {
    return this.http.delete(`${this.baseUrl}/delete_document.php?id=${id}`);
  }
}
