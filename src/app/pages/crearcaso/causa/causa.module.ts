import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { CausaPageRoutingModule } from './causa-routing.module';

import { CausaPage } from './causa.page';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    CausaPageRoutingModule,
    TranslateModule.forChild()
  ],
  declarations: [CausaPage]
})
export class CausaPageModule {}
