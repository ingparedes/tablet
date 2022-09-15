import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { LoadotrosPageRoutingModule } from './loadotros-routing.module';

import { LoadotrosPage } from './loadotros.page';
import { IonicSelectableModule } from 'ionic-selectable';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    LoadotrosPageRoutingModule,
    IonicSelectableModule,
    TranslateModule.forChild()
  ],
  declarations: [LoadotrosPage]
})
export class LoadotrosPageModule {}
