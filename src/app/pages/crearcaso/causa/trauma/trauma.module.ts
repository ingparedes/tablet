import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { TraumaPageRoutingModule } from './trauma-routing.module';

import { TraumaPage } from './trauma.page';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    TraumaPageRoutingModule,
    TranslateModule.forChild()
  ],
  declarations: [TraumaPage]
})
export class TraumaPageModule {}
