import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';
import { UsuarioGuard } from './guards/usuario.guard';

const routes: Routes = [
  {  
    path: '',
    redirectTo: 'login',
    pathMatch: 'full'
  },
  {
    path: 'inicio',
    canLoad: [UsuarioGuard], canActivate: [UsuarioGuard],
    loadChildren: () => import('./pages/inicio/inicio.module').then( m => m.InicioPageModule)
  },
  {
    path: 'login',
    loadChildren: () => import('./pages/login/login.module').then( m => m.LoginPageModule)
  },
  {
    path: 'crearcaso',
    canLoad: [UsuarioGuard], canActivate: [UsuarioGuard],
    loadChildren: () => import('./pages/crearcaso/crearcaso.module').then( m => m.CrearcasoPageModule)
  },
  {
    path: 'exportarcasos',
    canLoad: [UsuarioGuard], canActivate: [UsuarioGuard],
    loadChildren: () => import('./pages/exportarcasos/exportarcasos.module').then( m => m.ExportarcasosPageModule)
  },
  {
    path: 'turno',
    canLoad: [UsuarioGuard], canActivate: [UsuarioGuard],
    loadChildren: () => import('./pages/turno/turno.module').then( m => m.TurnoPageModule)
  },
  {
    path: 'asignados',
    canLoad: [UsuarioGuard], canActivate: [UsuarioGuard],
    loadChildren: () => import('./pages/asignados/asignados.module').then( m => m.AsignadosPageModule)
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
