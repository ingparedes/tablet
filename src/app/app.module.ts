import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouteReuseStrategy } from '@angular/router';

import { IonicModule, IonicRouteStrategy } from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';

import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';

import { HTTP } from '@ionic-native/http/ngx'
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { ScreenOrientation } from '@ionic-native/screen-orientation/ngx';
import { File } from '@ionic-native/file/ngx';
import { FileOpener } from '@ionic-native/file-opener/ngx';
import { ComponentsModule } from './components/components.module';
import { DataService } from './services/data.service';
import { Geolocation } from '@ionic-native/geolocation/ngx';
import { FormBuilder } from '@angular/forms';
import { IonicStorageModule } from '@ionic/Storage';
import {AndroidPermissions} from '@ionic-native/android-permissions/ngx';
import { Toast } from '@ionic-native/toast/ngx';
import { UsuarioGuard } from './guards/usuario.guard';
import { TranslateLoader, TranslateModule } from '@ngx-translate/core';
import { createTranslateLoader } from './translation.loader';


@NgModule({
  declarations: [AppComponent],
  entryComponents: [],
  imports: [HttpClientModule, ComponentsModule, BrowserModule, IonicModule.forRoot(), AppRoutingModule, IonicStorageModule.forRoot(),
    TranslateModule.forRoot({
      loader: {
        provide: TranslateLoader,
        useFactory: (createTranslateLoader),
        deps: [HttpClient]
      }
    })

  ],
  providers: [
    UsuarioGuard,
    AndroidPermissions,
    Toast,
    StatusBar,
    SplashScreen,
    ScreenOrientation,
    { provide: RouteReuseStrategy, useClass: IonicRouteStrategy },
    DataService,
    Geolocation,
    HTTP,
    File,
    FileOpener, FormBuilder
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
