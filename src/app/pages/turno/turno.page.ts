import { Component, OnInit } from '@angular/core';
import { AlertController, NavController, MenuController } from '@ionic/angular';
import { TranslateService } from '@ngx-translate/core';
import { DataService } from '../../services/data.service';

@Component({
  selector: 'app-turno',
  templateUrl: './turno.page.html',
  styleUrls: ['./turno.page.scss'],
})
export class TurnoPage implements OnInit {

  codAmbu: any
  km_actual: String;
  combustible_actual: String;
  cantidadtiket: String;
  observacion: String;

  constructor(public alertController: AlertController, 
    public menuCtrl: MenuController, 
    private navCtrl: NavController, 
    private dataService: DataService,
    private _translate: TranslateService) { }

  ngOnInit() {
    this.codAmbu = this.dataService.codAmbu
  }  

  saveTurno() {
    this.presentAlertConfirm()
  }
  async presentAlertConfirm() {
    const alert = await this.alertController.create({
      header: this._translate.instant("TURNO-COMPONENT.CONFIRM-ABRIR-TURNO.HEADER"),
      message: this._translate.instant("TURNO-COMPONENT.CONFIRM-ABRIR-TURNO.MESSAGE"),
      buttons: [
        {
          text: this._translate.instant("TURNO-COMPONENT.CONFIRM-ABRIR-TURNO.CANCELAR-LABEL"),
          role: 'cancel',
          cssClass: 'secondary',
          handler: (blah) => {
          }
        }, {
          text: this._translate.instant("TURNO-COMPONENT.CONFIRM-ABRIR-TURNO.SI-LABEL"),
          handler: () => {
            this.dataService.setTurno(this.km_actual, this.combustible_actual, this.cantidadtiket, this.observacion)
            this.navCtrl.navigateRoot('inicio');
          }
        }
      ]
    });

    await alert.present();
  }
}
