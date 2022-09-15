import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { AsignadosPageRoutingModule } from './asignados-routing.module';

import { AsignadosPage } from './asignados.page';
import { ComponentsModule } from '../../components/components.module';
import { TranslateModule } from '@ngx-translate/core';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ComponentsModule,
    AsignadosPageRoutingModule,
    TranslateModule.forChild()
  ],
  declarations: [AsignadosPage]
})
export class AsignadosPageModule {}
