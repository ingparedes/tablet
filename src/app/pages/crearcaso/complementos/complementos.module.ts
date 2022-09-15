import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { ComplementosPageRoutingModule } from './complementos-routing.module';

import { ComplementosPage } from './complementos.page';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ComplementosPageRoutingModule,
    TranslateModule.forChild()
  ],
  declarations: [ComplementosPage]
})
export class ComplementosPageModule {}
