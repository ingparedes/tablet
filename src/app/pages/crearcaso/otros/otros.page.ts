import { Component, OnInit, ViewChild, AfterViewInit } from '@angular/core';
import { Platform, NavController, AlertController } from '@ionic/angular';
import { DataService } from '../../../services/data.service';
import { CierreCaso, Hospital } from '../../../interfaces/interfaces';
import { IonicSelectableComponent } from 'ionic-selectable';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-otros',
  templateUrl: './otros.page.html',
  styleUrls: ['./otros.page.scss'],
})
export class OtrosPage implements OnInit, AfterViewInit {
  @ViewChild('imageCanvas', { static: false }) canvas: any;
  @ViewChild('selectHops') selectComponent: IonicSelectableComponent
  desc: String = '';
  nombre_confirma: String = '';
  telefono_confirma: String = '';
  megaposy: string = '';
  megaposx: string = '';
  kfinal: String = '';
  hospistal: String = '';
  med: String = '';
  obscaso: String = '';
  firma: any;
  cierre: String = '';
  CierreCasos: CierreCaso[] = []
  hospitales: Hospital[] = [];
  hos: any;
  canvasElement: any;
  saveX: number;
  saveY: number;

  selectedColor = '#000000';
  lineWidth = 5;
  drawing = false;


  constructor(private plt: Platform, 
    private dataService: DataService, 
    private navControl: NavController, 
    private alertController: AlertController,
    private _translate: TranslateService) { }

  ngOnInit() {
    this.CierreCasos = this.dataService.getCierreCaso();
    this.hospitales = this.dataService.getHospitales();
  }
  ngAfterViewInit() {
    // Set the Canvas Element and its size
    this.canvasElement = this.canvas.nativeElement;
    this.canvasElement.width = this.plt.width() + '';
    this.canvasElement.height = 200;
  }
  clear() {
    var ctx = this.canvasElement.getContext('2d')
    ctx.clearRect(0, 0, this.canvasElement.width, this.canvasElement.height)
    this.megaposx = ''
    this.megaposy = ''
  }
  startDrawing(ev) {
    this.drawing = true;
    var canvasPosition = this.canvasElement.getBoundingClientRect();
    if (this.plt.is('cordova')) {
      this.saveX = ev.touches[0].pageX - canvasPosition.x;
      this.saveY = ev.touches[0].pageY - canvasPosition.y;
    } else {
      this.saveX = ev.pageX - canvasPosition.x;
      this.saveY = ev.pageY - canvasPosition.y;
    }
    if (this.megaposx == '') {
      this.megaposx = this.saveX.toString()
    } else {
      this.megaposx = this.megaposx + '|' + this.saveX.toString()
    }
    if (this.megaposy == '') {
      this.megaposy = this.saveY.toString()
    } else {
      this.megaposy = this.megaposy + '|' + this.saveY.toString()
    }
  }
  moved(ev) {
    if (!this.drawing) return;
    const canvasPosition = this.canvasElement.getBoundingClientRect();
    let ctx = this.canvasElement.getContext('2d');
    let curretX, curretY: any
    if (this.plt.is('cordova')) {
      curretX = ev.touches[0].pageX - canvasPosition.x
      curretY = ev.touches[0].pageY - canvasPosition.y
    } else {
      curretX = ev.pageX - canvasPosition.x
      curretY = ev.pageY - canvasPosition.y
    }

    ctx.lineJoin = 'round'
    ctx.strokeStyle = this.selectedColor
    ctx.lineWidth = this.lineWidth

    ctx.beginPath();
    ctx.moveTo(this.saveX, this.saveY);
    ctx.lineTo(curretX, curretY)
    ctx.closePath();

    ctx.stroke();

    this.saveX = curretX
    this.saveY = curretY
    if (this.megaposx == '') {
      this.megaposx = this.saveX.toString()
    } else {
      this.megaposx = this.megaposx + ';' + this.saveX.toString()
    }
    if (this.megaposy == '') {
      this.megaposy = this.saveY.toString()
    } else {
      this.megaposy = this.megaposy + ';' + this.saveY.toString()
    }
  }
  endDrawing() {
    this.drawing = false;
  }

  //BUSCAR ASEGURADORA
  hospCancel() {
    this.selectComponent.clear();
    this.selectComponent.close();
  }
  hospClear() {
    this.selectComponent.clear();
    this.selectComponent.close();
  }
  hospConf() {
    this.selectComponent.confirm();
    this.selectComponent.close();
    this.hospistal = this.hos.id
  }
  searchAseg(event: {
    component: IonicSelectableComponent,
    text: string
  }) {
    let text = event.text.trim().toLowerCase();
    event.component.startSearch();

    if (!text) {
      event.component.items = [];
      event.component.endSearch();
      return;
    }

    let filterditems: Hospital[] = [];
    let items = this.filterPorts(this.hospitales, text);
    for (let i = 0; i < items.length; i++) {
      if (i < 10) {
        filterditems.push(items[i])
      } else {
        break
      }
    }
    event.component.items = filterditems
    event.component.endSearch();
  };
  filterPorts(hospitales: Hospital[], text: string) {
    return hospitales.filter(hospital => {
      return hospital.nombre.toLowerCase().indexOf(text) !==-1 || hospital.dist.toLowerCase().indexOf(text) !==-1 || hospital.prov.toLowerCase().indexOf(text) !==-1 || hospital.dpto.toLowerCase() == text
    });
  }
  cerrarCaso() {
    this.presentMSG(this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.FOLDER-LOAD-OTROS.ALERT-CERRAR-CASO.CONFIRMACION'))
  }
  async presentMSG(mensaje: string) {
    const alert = await this.alertController.create({
      header: this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.FOLDER-LOAD-OTROS.ALERT-CERRAR-CASO.HEADER'),
      message: mensaje,
      buttons: [
        {
          text: this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.FOLDER-LOAD-OTROS.ALERT-CERRAR-CASO.NO'),
          role: 'cancel',
          cssClass: 'secondary',
          handler: (blah) => {
            this.cierre = undefined
          }
        }, {
          text: this._translate.instant('ASIGNADOS-COMPONENT.FOLDER-CARGAR.FOLDER-LOAD-OTROS.ALERT-CERRAR-CASO.SI'),
          handler: () => {
            this.firma = this.canvasElement.toDataURL()
            this.dataService.setFirma(this.megaposx, this.megaposy, this.plt.width() + '')
            this.dataService.setOthers(this.desc, this.nombre_confirma, this.telefono_confirma, this.kfinal, this.hospistal, this.med, this.obscaso, this.cierre)
            this.navControl.navigateRoot('inicio');
            this.dataService.conxn = 'false'
          }
        }
      ]
    });

    await alert.present();
  }
}
