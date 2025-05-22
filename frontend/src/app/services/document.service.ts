import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment';
import { map } from 'rxjs/operators';

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

  getFilteredDocuments(type?: string, format?: string): Observable<any[]> {
    let url = `${this.apiUrl}/documents`;
    console.log(url);
    const params: any = {};
    if (type) params.type = type;
    if (format) params.format = format;
    return this.http.get<any[]>(url, { params });
  }

  getDocumentOptions(): Observable<DocumentOptions> {
    return this.http.get<DocumentOptions>(`${this.apiUrl}/documents/options`);
  }

  addDocument(document: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/documents`, document);
  }

  updateDocument(document: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/documents/${document.id}`, document);
  }

  deleteDocument(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/documents/${id}`);
  }

  getDocumentStats(): Observable<DocumentStats[]> {
    return this.http.get<DocumentStats[]>(`${this.apiUrl}/documents/stats`);
  }

  getDocumentTypes(): Observable<string[]> {
    return this.http.get<DocumentOptions>(`${this.apiUrl}/documents/options`).pipe(
      map(options => options.types)
    );
  }

  getDocumentFormats(): Observable<string[]> {
    return this.http.get<DocumentOptions>(`${this.apiUrl}/documents/options`).pipe(
      map(options => options.formats)
    );
  }
}
