import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { InfobasicaPageRoutingModule } from './infobasica-routing.module';

import { InfobasicaPage } from './infobasica.page';
import { IonicSelectableModule } from 'ionic-selectable';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,    
    InfobasicaPageRoutingModule,
    IonicSelectableModule,
    TranslateModule.forChild()
  ],
  declarations: [InfobasicaPage]
})
export class InfobasicaPageModule {}
