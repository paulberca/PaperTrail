import { Routes } from '@angular/router';
import { DocumentListComponent } from './pages/document-list/document-list.component';
import { AddDocumentComponent } from './pages/add-document/add-document.component';
import { EditDocumentComponent } from './pages/edit-document/edit-document.component';

export const routes: Routes = [
  { path: '', component: DocumentListComponent },
  { path: 'add', component: AddDocumentComponent },
  { path: 'edit/:id', component: EditDocumentComponent }
];
