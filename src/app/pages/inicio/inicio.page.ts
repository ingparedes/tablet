import { Component, OnInit, ViewChild } from '@angular/core';
import { MenuController, NavController, Platform } from '@ionic/angular';
import { CasoPDF, TraumaCaso, ExpfCaso, ExpgCaso, InsuCaso, MediCaso, ProcCaso, DiagCaso, Trauma, ObstCaso, Insumo } from '../../interfaces/interfaces';
import { DataService } from '../../services/data.service';
import { PdfMakeWrapper, Img, Table, Ul, Txt, Cell } from 'pdfmake-wrapper'
import pdfMake from 'pdfmake/build/pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
pdfMake.vfs = pdfFonts.pdfMake.vfs;
import { File } from '@ionic-native/file/ngx';
import { FileOpener } from '@ionic-native/file-opener/ngx';
import { LocaldataService } from '../../services/localdata.service';
import { element } from 'protractor';
import { UsuarioGuard } from '../../guards/usuario.guard';
import { TranslateService } from '@ngx-translate/core';
@Component({
  selector: 'app-inicio',
  templateUrl: './inicio.page.html',
  styleUrls: ['./inicio.page.scss'],
})
export class InicioPage implements OnInit {
  @ViewChild('cuerpoCanvas', { static: false }) bcanvas: any;
  @ViewChild('firmaCanvas', { static: false }) fcanvas: any;
  selectedColor = '#000000';
  lineWidth = 5;
  canvasfirma: any;
  canvasbody: any;
  arraymed = []
  arrayinsu = []
  casos: CasoPDF[] = []
  casocarga: CasoPDF[] = []
  obstcarga: ObstCaso[] = []
  traumacarga: TraumaCaso[] = []
  expgcarga: ExpgCaso[] = []
  proccarga: ProcCaso[] = []
  medicarga: MediCaso[] = []
  insucarga: InsuCaso[] = []
  expfcarga: ExpfCaso[] = []
  diagcarga: DiagCaso[] = []
  obscaso: ObstCaso
  caso: string;
  casopdf: CasoPDF
  firma: string
  btraumas: string

  constructor(
    private localDataService: LocaldataService,
    private dataService: DataService,
    public navCtrl: NavController,
    public menuCtrl: MenuController,
    private plt: Platform,
    private file: File,
    private fileOpener: FileOpener,
    private uValida: UsuarioGuard,
    private _translate: TranslateService) {
    this.menuCtrl.enable(true, 'sismenu');
  }

  ngOnInit() {
  }
  ngAfterViewInit() {
    this.canvasbody = this.bcanvas.nativeElement;
    this.canvasfirma = this.fcanvas.nativeElement;
    this.setBackground()
  }
  async setBackground() {
    this.canvasbody.width = 250;
    this.canvasbody.height = 448;
    let body = new Image();
    body.src = './assets/img/body.png';
    let ctx = this.canvasbody.getContext('2d')

    body.onload = () => {
      ctx.drawImage(body, 0, 0, 250, 448);
    }
  }
  ionViewWillLeave() {
    clearInterval(this.dataService.initinterval)
  }
  ionViewWillEnter() {
    this.dataService.updateMode = 'true'
    this.dataService.syncalldata('Casos Cerrados')
    this.casos = this.dataService.localData.getCasos(this.dataService.codAmbu)
    setTimeout(() => {
      this.dataService.updateMode = 'false'
    }, 5000);
    this.dataService.initinterval = setInterval(() => {
      this.dataService.updateMode = 'true'
      this.dataService.syncalldata('Casos Cerrados')
      this.casos = this.dataService.localData.getCasos(this.dataService.codAmbu)
      setTimeout(() => {
        this.dataService.updateMode = 'false'
      }, 5000);
    }, 30000)
  }
  reloader(ev) {
    this.dataService.presentToast(this._translate.instant('INICIO-COMPONENT.SYNC-CASOS-CERRADOS'));
    this.dataService.updateMode = 'true'
    this.dataService.syncalldata('Casos Cerrados')
    this.casos = this.dataService.localData.getCasos(this.dataService.codAmbu)
    setTimeout(() => {
      this.dataService.updateMode = 'false'
    }, 5000);
    ev.target.complete()        
  }
  dibujafirma(posx: string, posy: string, ancho: string) {
    this.canvasfirma.width = ancho + '';
    this.canvasfirma.height = 200;
    let ctx = this.canvasfirma.getContext('2d');
    let ct_x
    let ct_y
    let arraydx: String[] = posx.split("|")
    let arraydy: String[] = posy.split("|")
    for (let d = 0; d < arraydx.length; d++) {
      let arraytx = arraydx[d].split(";");
      let arrayty = arraydy[d].split(";");
      for (let t = 0; t < arraytx.length; t++) {
        let trazox = arraytx[t];
        let trazoy = arrayty[t];
        if (t == 0) {
          ct_x = trazox
          ct_y = trazoy
        } else {
          ctx.lineJoin = 'round'
          ctx.strokeStyle = this.selectedColor
          ctx.lineWidth = this.lineWidth
          ctx.beginPath();
          ctx.moveTo(trazox, trazoy);
          ctx.lineTo(ct_x, ct_y)
          ctx.closePath();
          ctx.stroke();
          ct_x = trazox
          ct_y = trazoy
        }
      }
    }
    this.firma = this.canvasfirma.toDataURL()
  }
  dibujatrauma() {
    let circulo = this.canvasbody.getContext('2d')
    for (let exf = 0; exf < this.expfcarga.length; exf++) {
      this.expfcarga[exf].posx = this.expfcarga[exf].posx.replace(",015625", "")
      circulo.fillStyle = '#ff0000ab';
      circulo.beginPath();
      circulo.arc(Number(this.expfcarga[exf].posx), Number(this.expfcarga[exf].posy), 15, 0, 2 * Math.PI);
      circulo.fill();
      circulo.closePath();
      circulo.fillStyle = '#000000';
      circulo.beginPath();
      circulo.font = "15px Verdana";
      circulo.fillText(this.expfcarga[exf].pos, Number(this.expfcarga[exf].posx) - 4, Number(this.expfcarga[exf].posy) + 4);
      circulo.stroke();
      circulo.closePath();
    }
    this.btraumas = this.canvasbody.toDataURL()
  }
  async CargarCasoPDF(idcaso: any) {
    this.dataService.presentToast(this._translate.instant('INICIO-COMPONENT.DESCARGANDO-CASO')  + idcaso)
    this.caso = idcaso
    this.dataService.updateMode = 'true'
    this.casocarga = this.dataService.getCasoPDF(idcaso)
    this.diagcarga = this.dataService.getCasoDiag(idcaso)
    this.traumacarga = this.dataService.getCasoTrauma(idcaso)
    this.obstcarga = this.dataService.getCasoObst(idcaso)
    this.expfcarga = this.dataService.getCasoExpF(idcaso)
    this.expgcarga = this.dataService.getCasoExpG(idcaso)
    this.insucarga = this.dataService.getCasoInsumos(idcaso)
    this.medicarga = this.dataService.getCasoMedicamentos(idcaso)
    this.proccarga = this.dataService.getCasoProc(idcaso)
    setTimeout(() => {
      this.obstcarga.forEach(element => {
        this.obscaso = element
      })
      if (this.expfcarga.length >= 1) {
        this.dibujatrauma()
      }
      this.casocarga.forEach(element => {
        this.dibujafirma(element.pos_firma_x, element.pos_firma_y, element.ancho_firma)
        this.verCasoPdf(element)
      });
    }, 1000);
    this.dataService.updateMode = 'false'
  }
  async verCasoPdf(casocarga: CasoPDF) {
    let pdf = new PdfMakeWrapper();
    pdf.pageSize('A4')
    pdf.styles({
      header: {
        fontSize: 18,
        bold: true,
      },
      subheader: {
        fontSize: 14,
        bold: true,
        margin: [0, 15, 0, 0]
      },
      imga: {
        fontSize: 14,
        bold: true,
        margin: [0, 15, 0, 0]
      }
    })
    await new Img(this.localDataService.img).width('200').alignment('center').build().then(img => {
      pdf.add(img)
    })
    pdf.add(new Txt(this._translate.instant('INICIO-COMPONENT.INFORME-CASO') + casocarga.caso + '').alignment('center').style('subheader').bold().end)
    pdf.add(new Txt('').alignment('center').style('subheader').bold().end);
    // ------------------ TABLA 1 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-1.FECHA')).bold().fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-1.HORA')).bold().fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-1.AMBULANCIA')).bold().fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-1.KM-INICIAL')).bold().fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-1.KM-FINAL')).bold().fontSize(10).end],
      [new Txt(casocarga.fecha.substring(0, 10)).fontSize(10).end,
      new Txt(casocarga.fecha.substring(11, 16)).fontSize(10).end,
      new Txt(casocarga.ambulancia).fontSize(10).end,
      new Txt(casocarga.km_inicial).fontSize(10).end,
      new Txt(casocarga.km_final).fontSize(10).end]
    ]).widths(['*', '*', 'auto', '*', '*']).end)
    pdf.add(new Txt('').alignment('center').style('subheader').bold().end);
     // ------------------ TABLA 2 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-2.PACIENTE')).bold().fontSize(10).end,
      new Txt(casocarga.paciente_dni_tipo + '').bold().fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-2.GENERO')).bold().fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-2.EDAD')).bold().fontSize(10).end],
      [new Txt(casocarga.paciente).fontSize(10).end,
      new Txt(casocarga.paciente_dni).fontSize(10).end,
      new Txt(casocarga.genero).fontSize(10).end,
      new Txt(casocarga.edad + ' ' + casocarga.edad_tipo).fontSize(10).end]
    ]).widths(['auto', '*', '*', '*']).end)
    pdf.add(new Txt('').alignment('center').style('subheader').bold().end)
     // ------------------ TABLA 3 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-3.CAUSA')).alignment('center').bold().fontSize(12).end],
      [new Txt(casocarga.causa).alignment('center').fontSize(10).end]
    ]).widths(['*']).end)

    if (casocarga.causa == 'Trauma') {
      this.traumacarga.forEach(element => {
        // ------------------ TABLA 4 -----------------
        pdf.add(new Table([
          [new Txt(element.causa_trauma + ': ').bold().fontSize(10).end, new Txt(element.nombre).fontSize(10).end],
        ]).widths(['*', '*']).end)
      });
    } else if (casocarga.causa == 'Obstétrico') {
      if (this.obscaso.fuente == '1') {
        this.obscaso.fuente = 'INICIO-COMPONENT.SI';
      } else {
        this.obscaso.fuente = 'INICIO-COMPONENT.NO';
      }
      if (this.obscaso.sangradovaginal == '1') {
        this.obscaso.sangradovaginal = 'INICIO-COMPONENT.SI';
      } else {
        this.obscaso.sangradovaginal = 'INICIO-COMPONENT.NO';
      }
      if (this.obscaso.trabajoparto == '1') {
        this.obscaso.trabajoparto = 'INICIO-COMPONENT.SI';
      } else {
        this.obscaso.trabajoparto = 'INICIO-COMPONENT.NO'
      }
      pdf.add(new Txt('').alignment('center').style('subheader').bold().end);
      // ------------------ TABLA 5 -----------------
      pdf.add(new Table([
        [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-5.TIEMPO-GESTACION')).alignment('center').bold().fontSize(10).end,
        new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-5.FUENTE')).alignment('center').bold().fontSize(10).end,
        new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-5.SANGRADO')).alignment('center').bold().fontSize(10).end,
        new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-5.TRABAJO-PARTO')).alignment('center').bold().fontSize(10).end],
        [new Txt(this.obscaso.tiempo).alignment('center').fontSize(10).end,
        new Txt(this._translate.instant(this.obscaso.fuente)).alignment('center').bold().fontSize(10).end,
        new Txt(this._translate.instant(this.obscaso.sangradovaginal)).alignment('center').bold().fontSize(10).end,
        new Txt(this._translate.instant(this.obscaso.trabajoparto)).alignment('center').bold().fontSize(10).end],
      ]).widths(['*', '*', '*', '*']).end)
      pdf.add(new Txt('').alignment('center').style('subheader').bold().end)
      // ------------------ TABLA 6 -----------------
      pdf.add(new Table([
        [new Txt('G').alignment('center').bold().fontSize(10).end,
        new Txt('P').alignment('center').bold().fontSize(10).end,
        new Txt('A').alignment('center').bold().fontSize(10).end,
        new Txt('C').alignment('center').bold().fontSize(10).end,
        new Txt('N').alignment('center').bold().fontSize(10).end],
        [new Txt(this.obscaso.g).alignment('center').fontSize(10).end,
        new Txt(this.obscaso.p).alignment('center').fontSize(10).end,
        new Txt(this.obscaso.a).alignment('center').fontSize(10).end,
        new Txt(this.obscaso.c).alignment('center').fontSize(10).end,
        new Txt(this.obscaso.n).alignment('center').fontSize(10).end]
      ]).widths(['*', '*', '*', '*', '*']).end)
    }
    pdf.add(new Txt('').alignment('center').style('subheader').bold().end);
    // ------------------ TABLA 7 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-7.INFO-TIEMPOS')).alignment('center').bold().fontSize(12).end]
    ]).widths(['*']).end)
    // ------------------ TABLA 8 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-8.HORA-INICIO')).bold().fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-8.HORA-LUGAR')).bold().fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-8.HORA-HOSPITAL')).bold().fontSize(10).end],
      [new Txt(casocarga.hora_inicio.replace("T", " ").replace("-05:00", "").substring(0, 16)).fontSize(10).end,
      new Txt(casocarga.hora_evento.replace("T", " ").replace("-05:00", "").substring(0, 16)).fontSize(10).end,
      new Txt(casocarga.hora_hospital.replace("T", " ").replace("-05:00", "").substring(0, 16)).fontSize(10).end]
    ]).widths(['*', '*', '*']).end);
    if (this.expgcarga.length >= 1) {
      pdf.add(new Txt('').alignment('center').style('subheader').bold().end);
      // ------------------ TABLA 9 -----------------
      pdf.add(new Table([
        [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-9.HORA-HOSPITAL')).alignment('center').bold().fontSize(12).end]
      ]).widths(['*']).end)
      // ------------------ TABLA 10 -----------------
      pdf.add(new Table([
        [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-10.CATEGORIA')).bold().fontSize(10).end,
        new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-10.NOMBRE')).bold().fontSize(10).end]
      ]).widths(['*', '*']).end);
      this.expgcarga.forEach(element => {
        // ------------------ TABLA 11 -----------------
        pdf.add(new Table([
          [new Txt(element.categoria).fontSize(10).end,
          new Txt(element.nombre).fontSize(10).end]
        ]).widths(['*', '*']).end);
      })
    }
    if (this.proccarga.length >= 1) {
      let arrayproc = []
      this.proccarga.forEach(element => {
        arrayproc.push(element.nombre_procedimeto)
      })
      pdf.add(new Txt(this._translate.instant('INICIO-COMPONENT.PROCEDIMIENTOS')).alignment('center').style('subheader').bold().end);
      pdf.add(new Ul(arrayproc).end);
    }
    if (this.expfcarga.length >= 1) {
      pdf.add(new Txt('').alignment('center').style('subheader').pageBreak("before").bold().end);
      
      // ------------------ TABLA 12 -----------------
      pdf.add(new Table([
        [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-12.EXPLORACION')).alignment('center').bold().fontSize(12).end]
      ]).widths(['*']).end);
      // ------------------ TABLA 13 -----------------
      pdf.add(new Table([
        [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-13.POSICION')).bold().fontSize(10).end,
        new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-13.TRAUMA')).bold().fontSize(10).end]
      ]).widths(['*', '*']).end);
      // ------------------ TABLA 14 -----------------

      this.expfcarga.forEach(element => {
        pdf.add(new Table([
          [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-14.PUNTO') + element.pos).fontSize(10).end,
          new Txt(element.nombre).fontSize(10).end]
        ]).widths(['*', '*']).end);
      })
      pdf.add(new Txt('').alignment('center').style('subheader').bold().end);
      await new Img(this.btraumas).width('150').alignment('center').build().then(img => {
        pdf.add(img)
      })
    }
    pdf.add(new Txt('').alignment('center').style('subheader').bold().end);
    // ------------------ TABLA 15 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-15.SIGNOS')).alignment('center').bold().fontSize(12).end]
    ]).widths(['*']).end)
    // ------------------ TABLA 16 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-16.HORA')).bold().fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-16.FR')).bold().fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-16.TA')).bold().fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-16.FC')).bold().fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-16.SA02')).bold().fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-16.TEMP')).bold().fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-16.GLASGOW')).bold().fontSize(10).end],
      [new Txt(casocarga.hora_evaluacion.substring(11, 16)).fontSize(10).end,
      new Txt(casocarga.frecuencia_respiratoria).fontSize(10).end,
      new Txt(casocarga.presion_arterial).fontSize(10).end,
      new Txt(casocarga.frecuencia_cardiaca).fontSize(10).end,
      new Txt(casocarga.saturacion_o2).fontSize(10).end,
      new Txt(casocarga.temperatura).fontSize(10).end,
      new Txt(casocarga.glasgow).fontSize(10).end]
    ]).widths(['*', '*', '*', '*', '*', '*', '*']).end);
    if (casocarga.a_diabetes == '1') {
      casocarga.a_diabetes = 'INICIO-COMPONENT.SI';
    } else {
      casocarga.a_diabetes = 'INICIO-COMPONENT.NO';
    }
    if (casocarga.a_cardiopatia == '1') {
      casocarga.a_cardiopatia = 'INICIO-COMPONENT.SI';
    } else {
      casocarga.a_cardiopatia = 'INICIO-COMPONENT.NO';
    }
    if (casocarga.a_convul == '1') {
      casocarga.a_convul = 'INICIO-COMPONENT.SI';
    } else {
      casocarga.a_convul = 'INICIO-COMPONENT.NO';
    }
    if (casocarga.a_asma == '1') {
      casocarga.a_asma = 'INICIO-COMPONENT.SI';
    } else {
      casocarga.a_asma = 'INICIO-COMPONENT.NO';
    }
    if (casocarga.a_acv == '1') {
      casocarga.a_acv = 'INICIO-COMPONENT.SI';
    } else {
      casocarga.a_acv = 'INICIO-COMPONENT.NO';
    }
    if (casocarga.a_has == '1') {
      casocarga.a_has = 'INICIO-COMPONENT.SI';
    } else {
      casocarga.a_has = 'INICIO-COMPONENT.NO';
    }
    if (casocarga.a_alergia == '1') {
      casocarga.a_alergia = 'INICIO-COMPONENT.SI';
    } else {
      casocarga.a_alergia = 'INICIO-COMPONENT.NO';
    }
    pdf.add(new Txt('').alignment('center').style('subheader').bold().end);
    // ------------------ TABLA 17 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-17.ANTECEDENTES')).alignment('center').bold().fontSize(12).end]
    ]).widths(['*']).end)
    // ------------------ TABLA 18 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-18.DIABETES') + ':' + this._translate.instant(casocarga.a_diabetes)).fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-18.CARDIOPATIA') + ':' + this._translate.instant(casocarga.a_cardiopatia)).fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-18.CONVULSIONES') + ':' + this._translate.instant(casocarga.a_convul)).fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-18.ASMA') + ':' + this._translate.instant(casocarga.a_asma)).fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-18.ACV') + ':' + this._translate.instant(casocarga.a_acv)).fontSize(10).end],
    ]).widths(['*', '*', '*', '*', '*']).end);
    // ------------------ TABLA 19 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-19.HAS') + ': ' + this._translate.instant(casocarga.a_has)).fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-19.ALERGIA') + ': ' + this._translate.instant(casocarga.a_alergia)).fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-19.OTROS') + ': ' + casocarga.a_otros).fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-19.MEDICAMENTOS') + ': ' + casocarga.a_medicamentos).fontSize(10).end],
    ]).widths(['auto', 'auto', '*', '*']).end);
    if (this.diagcarga.length >= 1) {
      pdf.add(new Txt('').alignment('center').style('subheader').bold().end);
      // ------------------ TABLA 20 -----------------
      pdf.add(new Table([
        [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-20.DIAGNOSTICOS')).alignment('center').bold().fontSize(12).end]
      ]).widths(['*']).end)
      // ------------------ TABLA 21 -----------------
      pdf.add(new Table([
        [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-21.CODIGO-CIE10')).bold().fontSize(10).end,
        new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-21.DIAGNOSTICO')).bold().fontSize(10).end]
      ]).widths(['*', '*']).end);
      this.diagcarga.forEach(element => {
        // ------------------ TABLA 22 -----------------
        pdf.add(new Table([
          [new Txt(element.codigo_cie).fontSize(10).end,
          new Txt(element.diagnostico).fontSize(10).end]
        ]).widths(['*', '*']).end);
      })
    }
    pdf.add(new Txt('').alignment('center').style('subheader').pageBreak("before").bold().end);
    // ------------------ TABLA 23 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-23.COMPLEMENTOS')).alignment('center').bold().fontSize(12).end]
    ]).widths(['*']).end)
    if (this.medicarga.length >= 1) {
      this.medicarga.forEach(element => {
        this.arraymed.push(element.nombre_medicamento + ' ' + this._translate.instant('INICIO-COMPONENT.CANTIDAD') + ': ' + element.cantidad)
      })
    }
    if (this.insucarga.length >= 1) {
      this.insucarga.forEach(element => {
        this.arrayinsu.push(element.nombre_insumo + ' ' + this._translate.instant('INICIO-COMPONENT.CANTIDAD') + ': ' + element.cantidad)
      })
    }
    // ------------------ TABLA 24 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-24.MEDICAMENTOS')).alignment('center').bold().fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-24.INSUMOS')).alignment('center').bold().fontSize(10).end],
      [new Ul(this.arraymed).end,
      new Ul(this.arrayinsu).end,]
    ]).widths(['*', '*']).end)
    pdf.add(new Txt('').alignment('center').style('subheader').bold().end);
    // ------------------ TABLA 25 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-25.OTROS')).alignment('center').bold().fontSize(12).end]
    ]).widths(['*']).end)
    // ------------------ TABLA 26 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-26.TRIAGE') + ': ' + casocarga.triage).fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-26.OBSERVACIONES') + ': ' + casocarga.observaciones).fontSize(10).end],
    ]).widths(['*', '*']).end);
    pdf.add(new Txt('').alignment('center').style('subheader').bold().end);
    // ------------------ TABLA 27 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-27.PERTENENCIAS')).alignment('center').bold().fontSize(12).end]
    ]).widths(['*']).end)
    // ------------------ TABLA 28 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-28.DESCRIPCION') + ': ' + casocarga.descrip_pertenencias).fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-28.NOMBRE') + ': ' + casocarga.nombre_p_recibe).fontSize(10).end],
    ]).widths(['*', '*']).end);
    pdf.add(new Txt('').alignment('center').style('subheader').bold().end);
    // ------------------ TABLA 29 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-29.OPCION-CIERRE')).alignment('center').bold().fontSize(12).end],
      [new Txt(casocarga.cierre).fontSize(10).end]
    ]).widths(['*']).end);
    pdf.add(new Txt('').alignment('center').style('subheader').bold().end);
    // ------------------ TABLA 30 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-30.DESTINO')).alignment('center').bold().fontSize(12).end]
    ]).widths(['*']).end)
    // ------------------ TABLA 31 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-31.HOSPITAL') + ': ' + casocarga.hospital_nombre).fontSize(10).end,
      new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-31.MEDICO') + ': ' + casocarga.medico_recibe).fontSize(10).end],
    ]).widths(['*', '*']).end);
    // ------------------ TABLA 32 -----------------
    pdf.add(new Table([
      [new Txt(this._translate.instant('INICIO-COMPONENT.TABLA-32.FIRMA')).alignment('center').bold().fontSize(12).end]
    ]).widths(['*']).end)
    await new Img(this.firma).width('520').alignment('center').build().then(img => {
      pdf.add(img)
    })

    this.downloadPdf(pdf)
  }

  downloadPdf(pdf) {
    if (this.plt.is('cordova')) {
      pdf.create().getBuffer((buffer) => {
        var blob = new Blob([buffer], { type: 'application/pdf' });

        // Save the PDF to the data Directory of our App
        this.file.writeFile(this.file.dataDirectory, this._translate.instant('INICIO-COMPONENT.CASO-N') + this.caso + '.pdf', blob, { replace: true }).then(fileEntry => {
          // Open the PDf with the correct OS tools
          this.fileOpener.open(this.file.dataDirectory + this._translate.instant('INICIO-COMPONENT.CASO-N') + this.caso + '.pdf', 'application/pdf');
        })
      });
    } else {
      // On a browser simply use download!
      pdf.create().download(this._translate.instant('INICIO-COMPONENT.CASO-N') + this.caso)
    }
    this.arrayinsu = [];
    this.arraymed = [];
  }

}