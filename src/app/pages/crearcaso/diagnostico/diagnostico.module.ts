import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { DiagnosticoPageRoutingModule } from './diagnostico-routing.module';

import { DiagnosticoPage } from './diagnostico.page';
import { IonicSelectableModule } from 'ionic-selectable';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    DiagnosticoPageRoutingModule,
    IonicSelectableModule,
    TranslateModule.forChild()
  ],
  declarations: [DiagnosticoPage]
})
export class DiagnosticoPageModule {}
