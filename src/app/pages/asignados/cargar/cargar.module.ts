import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { CargarPageRoutingModule } from './cargar-routing.module';

import { ComponentsModule } from '../../../components/components.module';
import { CargarPage } from './cargar.page';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    CargarPageRoutingModule,
    ComponentsModule,
    TranslateModule.forChild()
  ],
  declarations: [CargarPage]
})
export class CargarPageModule {}
