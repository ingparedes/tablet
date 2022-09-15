import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { LoadexpfisicaPageRoutingModule } from './loadexpfisica-routing.module';

import { LoadexpfisicaPage } from './loadexpfisica.page';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    LoadexpfisicaPageRoutingModule,
    TranslateModule.forChild()
  ],
  declarations: [LoadexpfisicaPage]
})
export class LoadexpfisicaPageModule {}
