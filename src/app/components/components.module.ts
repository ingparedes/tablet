import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { IonicModule } from '@ionic/angular';

import { HeaderComponent } from './header/header.component';
import { SismenuComponent } from './sismenu/sismenu.component';
import { RouterModule } from '@angular/router';
import { TranslateModule } from '@ngx-translate/core';


@NgModule({
  declarations: [
    HeaderComponent,
    SismenuComponent    
  ],
  exports: [
    HeaderComponent,
    SismenuComponent    
  ],
  imports: [
    CommonModule,
    IonicModule,
    RouterModule,
    TranslateModule.forChild()
  ]
})
export class ComponentsModule { }
