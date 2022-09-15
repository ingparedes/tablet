import { Component, OnInit } from '@angular/core';
import { DataService } from '../../services/data.service';
import { NavController, MenuController } from '@ionic/angular';
import { CasosAsignados } from '../../interfaces/interfaces';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-asignados',
  templateUrl: './asignados.page.html',
  styleUrls: ['./asignados.page.scss'],
})
export class AsignadosPage implements OnInit {
  casos: CasosAsignados[] = []
  codambu: number;

  constructor(
    private dataService: DataService,
    public navCtrl: NavController,
    public menuCtrl: MenuController,
    private _translate: TranslateService
  ) {
    this.menuCtrl.enable(true, 'sismenu');
  }
  ionViewWillEnter() {
    this.dataService.updateMode = 'true'
    this.dataService.syncalldata('Casos Asignados')
    this.casos = this.dataService.localData.getCasosAsignados(this.dataService.codAmbu)
    setTimeout(() => {
      this.dataService.updateMode = 'false'
    }, 5000);
  }
  ionViewWillLeave() {
    clearInterval(this.dataService.asigninterval)
  }
  ngOnInit() {
    this.dataService.asigninterval = setInterval(() => {
      this.dataService.updateMode = 'true'
      this.dataService.syncalldata('Casos Asignados')
      this.casos = this.dataService.localData.getCasosAsignados(this.dataService.codAmbu)
      setTimeout(() => {
        this.dataService.updateMode = 'false'
      }, 5000);
    }, 30000)
  }
  getFechaOr(fecha: string) {
    fecha = fecha.replace('T', ' ')
    fecha = fecha.replace('-05:00', '')
    return fecha
  }
  reloader(ev) {
    this.dataService.presentToast(this._translate.instant('ASIGNADOS-COMPONENT.SYNC-CASOS'))
    this.dataService.updateMode = 'true'
    this.dataService.syncalldata('Casos Asignados')
    this.casos = this.dataService.localData.getCasosAsignados(this.dataService.codAmbu)
    setTimeout(() => {
      this.dataService.updateMode = 'false'
    }, 5000);
    ev.target.complete()            
  }
  cargarCaso(cod_caso: string, cod_hospital: string, hospital: string) {
    this.dataService.codCaso = cod_caso
    this.dataService.codHospital = cod_hospital
    this.dataService.Hospital = hospital
    this.navCtrl.navigateRoot('asignados/cargar');
  }
}
