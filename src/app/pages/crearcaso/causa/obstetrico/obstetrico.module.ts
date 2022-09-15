import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { ObstetricoPageRoutingModule } from './obstetrico-routing.module';

import { ObstetricoPage } from './obstetrico.page';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ObstetricoPageRoutingModule,
    TranslateModule.forChild()
  ],
  declarations: [ObstetricoPage]
})
export class ObstetricoPageModule {}
