import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { LoadprocedimientosPageRoutingModule } from './loadprocedimientos-routing.module';

import { LoadprocedimientosPage } from './loadprocedimientos.page';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    LoadprocedimientosPageRoutingModule,
    TranslateModule.forChild()
  ],
  declarations: [LoadprocedimientosPage]
})
export class LoadprocedimientosPageModule {}
