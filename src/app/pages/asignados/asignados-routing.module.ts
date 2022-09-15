import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AsignadosPage } from './asignados.page';
import { UsuarioGuard } from '../../guards/usuario.guard';

const routes: Routes = [
  {
    path: '',
    component: AsignadosPage
  },
  {
    path: 'cargar',
    canLoad: [UsuarioGuard],
    loadChildren: () => import('./cargar/cargar.module').then( m => m.CargarPageModule)
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class AsignadosPageRoutingModule {}
