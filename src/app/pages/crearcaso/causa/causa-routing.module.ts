import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CausaPage } from './causa.page';
import { UsuarioGuard } from '../../../guards/usuario.guard';

const routes: Routes = [
  {
    path: '',
    component: CausaPage
  }
  ,
  {
    path: 'trauma',
    canLoad: [UsuarioGuard],
    loadChildren: () => import('./trauma/trauma.module').then(m => m.TraumaPageModule)
  },
  {
    path: 'obstetrico',
    canLoad: [UsuarioGuard],
    loadChildren: () => import('./obstetrico/obstetrico.module').then(m => m.ObstetricoPageModule)
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CausaPageRoutingModule { }
