import { Component, OnInit } from '@angular/core';
import { AlertController, NavController, MenuController } from '@ionic/angular';
import { TranslateService } from '@ngx-translate/core';
import { DataService } from '../../../services/data.service';
@Component({
  selector: 'app-cargar',
  templateUrl: './cargar.page.html',
  styleUrls: ['./cargar.page.scss'],
})
export class CargarPage implements OnInit {

  constructor(public alertController: AlertController, private dataService: DataService,
    public navCtrl: NavController,
    public menuCtrl: MenuController,
    private _translate:TranslateService) { }

  ngOnInit() {
    this.presentAlertConfirm()
  }
  async presentAlertConfirm() {
    const alert = await this.alertController.create({
      header: this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.ALERT.HEADER'),
      message: this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.ALERT.MENSAJE') + this.dataService.codCaso + '?',
      buttons: [
        {
          text: this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.ALERT.CANCELAR'),
          role: 'cancel',
          cssClass: 'secondary',
          handler: (blah) => {
            this.navCtrl.navigateRoot('inicio');
            this.dataService.codCaso = ''
            this.dataService.codHospital = ''
            this.dataService.conxn = 'false'
          }
        }, {
          text: this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.ALERT.SI'),
          handler: () => {
            this.dataService.conxn = 'true'
            this.navCtrl.navigateRoot('asignados/cargar/infobasica');
            this.dataService.myinterval = setInterval(() => {
              this.dataService.getMedicaso(this.dataService.codCaso)
            }, 1500);
          }
        }
      ]
    });

    await alert.present();
  }
}
