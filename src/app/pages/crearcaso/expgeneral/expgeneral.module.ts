import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { ExpgeneralPageRoutingModule } from './expgeneral-routing.module';

import { ExpgeneralPage } from './expgeneral.page';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ExpgeneralPageRoutingModule,
    TranslateModule.forChild()
  ],
  declarations: [ExpgeneralPage]
})
export class ExpgeneralPageModule {}
