import { Injectable } from '@angular/core';
import { CanActivate, CanLoad } from '@angular/router';
import { DataService } from '../services/data.service';
import { NavController } from '@ionic/angular';

@Injectable({
  providedIn: 'root'
})
export class UsuarioGuard implements CanActivate, CanLoad {
  constructor(private dataService:DataService, private navCtrl:NavController){

  }
  canActivate(): boolean {
    //return true;
    if (this.dataService.userToken ==='true') {
      console.log('Puede Entrar')
      return true;      
    }else{
      this.navCtrl.navigateRoot('login')
      console.log('No Puede Entrar')
      return false;
    }
  }  
  canLoad(): boolean {
    //return true;
    if (this.dataService.userToken ==='true') {
      console.log('Puede Entrar')
      return true;      
    }else{
      this.navCtrl.navigateRoot('login')
      console.log('No Puede Entrar')
      return false;
    }
  }
}
