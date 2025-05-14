import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment';

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

export interface DocumentStats {
  type: string;
  total_documents: number;
  total_pages: number;
  avg_pages: number;
  min_pages: number;
  max_pages: number;
  unique_authors: number;
  unique_formats: number;
}

@Injectable({
  providedIn: 'root'
})
export class DocumentService {
  private apiUrl = environment.apiUrl;

  constructor(private http: HttpClient) {}

  getDocuments(): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/get_documents.php`);
  }

  getFilteredDocuments(type?: string, format?: string): Observable<any[]> {
    let url = `${this.apiUrl}/get_filtered_documents.php`;
    const params: any = {};
    
    if (type) params.type = type;
    if (format) params.format = format;
    
    return this.http.get<any[]>(url, { params });
  }

  getDocumentOptions(): Observable<DocumentOptions> {
    return this.http.get<DocumentOptions>(`${this.apiUrl}/get_document_options.php`);
  }

  addDocument(document: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/add_document.php`, document);
  }

  updateDocument(document: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/update_document.php`, document);
  }

  deleteDocument(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/delete_document.php?id=${id}`);
  }

  getDocumentTypes(): Observable<string[]> {
    return this.http.get<string[]>(`${this.apiUrl}/get_document_types.php`);
  }

  getDocumentFormats(): Observable<string[]> {
    return this.http.get<string[]>(`${this.apiUrl}/get_document_formats.php`);
  }

  getDocumentStats(): Observable<DocumentStats[]> {
    return this.http.get<DocumentStats[]>(`${this.apiUrl}/get_document_stats.php`);
  }
}
