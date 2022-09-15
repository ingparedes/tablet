import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { LoadcausaPage } from './loadcausa.page';
import { UsuarioGuard } from '../../../../guards/usuario.guard';

const routes: Routes = [
  {
    path: '',
    component: LoadcausaPage
  },
  {
    path: 'loadobstetrico',
    canLoad: [UsuarioGuard],
    loadChildren: () => import('./loadobstetrico/loadobstetrico.module').then( m => m.LoadobstetricoPageModule)
  },
  {
    path: 'loadtrauma',
    canLoad: [UsuarioGuard],
    loadChildren: () => import('./loadtrauma/loadtrauma.module').then( m => m.LoadtraumaPageModule)
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class LoadcausaPageRoutingModule {}
