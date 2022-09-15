import { Component, OnInit } from '@angular/core';
import { DataService } from '../../../../services/data.service';
import { Insumo, Medicamento, Compmed, Compins } from '../../../../interfaces/interfaces';
import { AlertController } from '@ionic/angular';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-loadcomplementos',
  templateUrl: './loadcomplementos.page.html',
  styleUrls: ['./loadcomplementos.page.scss'],
})
export class LoadcomplementosPage implements OnInit {

  constructor(private dataService: DataService, 
    public alertController: AlertController,
    private _translate: TranslateService) { }

  medicamentos: Medicamento[] = []
  insumos: Insumo[] = []

  selectmedicamentos: Compmed[] = []
  selectinsumos: Compins[] = []
  
  async addInsumo(id:string,insumo:string) {
    const alert = await this.alertController.create({
      cssClass: 'modalAdd',
      header:  this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.FOLDER-LOAD-COMPLEMENTOS.ALERT-INSUMO.HEADER')+ ': '+insumo,      
      inputs: [
        {
          name: 'CantidadInsumos',                    
          type: 'number',
          placeholder:  this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.FOLDER-LOAD-COMPLEMENTOS.ALERT-INSUMO.CANTIDAD'),
          value: '1'
        }
      ],
      buttons: [
        {
          text:  this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.FOLDER-LOAD-COMPLEMENTOS.ALERT-INSUMO.CANCELAR'),
          role: 'cancel',
          cssClass: 'secondary',
          handler: (res) => {
            
          }
        }, {
          text:  this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.FOLDER-LOAD-COMPLEMENTOS.ALERT-INSUMO.ADD'),
          handler: (res) => {
            let ins = {
              idins: id,
              ins: insumo,
              cant: res.CantidadInsumos
            }
            this.selectinsumos.push(ins)
            this.dataService.setInsumos(ins.idins,ins.cant)            
          }
        }
      ]
    });
    await alert.present();
  }
  async addMedicamento(id:string,medicamento:string) {
    const alert = await this.alertController.create({
      cssClass: 'modalAdd',
      header: this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.FOLDER-LOAD-COMPLEMENTOS.ALERT-MEDICAMENTO.HEADER')+ ': '+medicamento,      
      inputs: [
        {
          name: 'CantidadMedicamentos',                       
          type: 'number',
          placeholder: this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.FOLDER-LOAD-COMPLEMENTOS.ALERT-MEDICAMENTO.CANTIDAD'),
          value: '1'
        }
      ],
      buttons: [
        {
          text: this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.FOLDER-LOAD-COMPLEMENTOS.ALERT-MEDICAMENTO.CANCELAR'),
          role: 'cancel',
          cssClass: 'secondary',
          handler: (res) => {            
          }
        }, {
          text: this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.FOLDER-LOAD-COMPLEMENTOS.ALERT-MEDICAMENTO.ADD'),
          handler: (res) => {                        
            let med = {
              idmed: id,
              med: medicamento,
              cant: res.CantidadMedicamentos
            }
            this.selectmedicamentos.push(med)
            this.dataService.setMedicamento(med.idmed,med.cant)            
          }
        }
      ]
    });
    await alert.present();
  }
  ngOnInit() {
    this.insumos = this.dataService.getInsumos();
    this.medicamentos = this.dataService.getMedicamentos();    
  }
  delMed(idmed:string){
    let arraymed = this.selectmedicamentos
    this.selectmedicamentos = []
    arraymed.forEach(element => {
      if (element.idmed !== idmed) {
        this.selectmedicamentos.push(element)
      }
    });
    this.dataService.delMedicamento(idmed)
  }
  delIns(idins:string){
    let arrayins = this.selectinsumos
    this.selectinsumos = []
    arrayins.forEach(element => {
      if (element.idins !== idins) {
        this.selectinsumos.push(element)
      }
    });
    this.dataService.delInsumos(idins)
  }
}