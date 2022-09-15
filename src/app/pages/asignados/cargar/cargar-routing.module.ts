import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CargarPage } from './cargar.page';
import { UsuarioGuard } from '../../../guards/usuario.guard';

const routes: Routes = [
  {
    path: '',
    component: CargarPage,
    children: [
      {
        path: 'infobasica',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./loadinfobasica/loadinfobasica.module').then(m => m.LoadinfobasicaPageModule)
      },
      {
        path: 'causa',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./loadcausa/loadcausa.module').then(m => m.LoadcausaPageModule)
      },
      {
        path: 'expgeneral',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./loadexpgeneral/loadexpgeneral.module').then(m => m.LoadexpgeneralPageModule)
      },
      {
        path: 'expfisica',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./loadexpfisica/loadexpfisica.module').then(m => m.LoadexpfisicaPageModule)
      },
      {
        path: 'diagnostico',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./loaddiagnostico/loaddiagnostico.module').then(m => m.LoaddiagnosticoPageModule)
      },
      {
        path: 'procedimientos',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./loadprocedimientos/loadprocedimientos.module').then(m => m.LoadprocedimientosPageModule)
      },
      {
        path: 'complementos',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./loadcomplementos/loadcomplementos.module').then(m => m.LoadcomplementosPageModule)
      },
      {
        path: 'otros',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./loadotros/loadotros.module').then(m => m.LoadotrosPageModule)
      }
    ]
  }
]

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CargarPageRoutingModule { }
