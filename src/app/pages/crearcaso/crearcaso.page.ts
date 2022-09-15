import { Component, OnInit } from '@angular/core';
import { AlertController, NavController, MenuController } from '@ionic/angular';
import { TranslateService } from '@ngx-translate/core';
import { DataService } from '../../services/data.service';

@Component({
  selector: 'app-crearcaso',
  templateUrl: './crearcaso.page.html',
  styleUrls: ['./crearcaso.page.scss'],
})
export class CrearcasoPage implements OnInit {

  constructor(private dataService: DataService, 
    public menuCtrl: MenuController, 
    public alertController: AlertController, 
    private navCtrl: NavController,
    private _translate: TranslateService
) { }

  ngOnInit() {
    this.presentAlertConfirm()
  }
  async setCaso() {
    const alert = await this.alertController.create({
      cssClass: 'modalAdd',
      header: this._translate.instant('CREARCASOS-COMPONENT.ALERT-CASO-MANUAL.HEADER'),
      inputs: [
        {
          name: 'codecaso',
          type: 'number',
          placeholder: this._translate.instant('CREARCASOS-COMPONENT.ALERT-CASO-MANUAL.CODIGO-CASO')
        }
      ],
      buttons: [
        {
          text: this._translate.instant('CREARCASOS-COMPONENT.ALERT-CASO-MANUAL.CANCELAR'),
          role: 'cancel',
          cssClass: 'secondary',
          handler: (res) => {
            this.navCtrl.navigateRoot('inicio');
            this.dataService.conxn = 'true'
          }
        }, {
          text: this._translate.instant('CREARCASOS-COMPONENT.ALERT-CASO-MANUAL.INICIAR-CASO'),
          handler: (res) => {
            if (res.codecaso != '') {
              this.dataService.codCaso = res.codecaso
              this.navCtrl.navigateRoot('crearcaso/infobasica');
              this.dataService.conxn = 'false'
            } else {
              this.setCaso()
            }
          }
        }
      ]
    });
    await alert.present();
  }
  async presentAlertConfirm() {
    const alert = await this.alertController.create({
      header: this._translate.instant('CREARCASOS-COMPONENT.ALERT-CONFIRMAR.HEADER'),
      message: this._translate.instant('CREARCASOS-COMPONENT.ALERT-CONFIRMAR.MENSAJE'),
      buttons: [
        {
          text: this._translate.instant('CREARCASOS-COMPONENT.ALERT-CONFIRMAR.CANCELAR'),
          role: 'cancel',
          cssClass: 'secondary',
          handler: (blah) => {
            this.navCtrl.navigateRoot('inicio');
          }
        }, {
          text: this._translate.instant('CREARCASOS-COMPONENT.ALERT-CONFIRMAR.SI'),
          handler: () => {
            this.setCaso()
          }
        }
      ]
    });

    await alert.present();
  }
}
