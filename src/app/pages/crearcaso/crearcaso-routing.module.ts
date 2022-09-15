import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CrearcasoPage } from './crearcaso.page';
import { UsuarioGuard } from '../../guards/usuario.guard';

const routes: Routes = [
  {
    path: '',
    component: CrearcasoPage,
    children: [      
      {
        path: 'infobasica',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./infobasica/infobasica.module').then(m => m.InfobasicaPageModule)
      },
      {
        path: 'causa',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./causa/causa.module').then(m => m.CausaPageModule)        
      },      
      {
        path: 'expgeneral',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./expgeneral/expgeneral.module').then(m => m.ExpgeneralPageModule)
      },
      {
        path: 'expfisica',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./expfisica/expfisica.module').then(m => m.ExpfisicaPageModule)
      },
      {
        path: 'diagnostico',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./diagnostico/diagnostico.module').then(m => m.DiagnosticoPageModule)
      },
      {
        path: 'procedimientos',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./procedimientos/procedimientos.module').then(m => m.ProcedimientosPageModule)
      },
      {
        path: 'complementos',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./complementos/complementos.module').then(m => m.ComplementosPageModule)
      },
      {
        path: 'otros',
        canLoad: [UsuarioGuard],
        loadChildren: () => import('./otros/otros.module').then(m => m.OtrosPageModule)
      }
    ]

  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CrearcasoPageRoutingModule { }
