import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { ExpfisicaPageRoutingModule } from './expfisica-routing.module';

import { ExpfisicaPage } from './expfisica.page';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ExpfisicaPageRoutingModule,
    TranslateModule.forChild()
  ],
  declarations: [ExpfisicaPage]
})
export class ExpfisicaPageModule {}
