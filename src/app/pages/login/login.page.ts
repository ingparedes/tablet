import { Component, OnInit, OnDestroy, ViewChild } from '@angular/core';
import { NavController, MenuController, AlertController, ToastController, Platform } from '@ionic/angular';
import { ScreenOrientation } from '@ionic-native/screen-orientation/ngx';
import { DataService } from '../../services/data.service';
import { Ambulancia, Usuario, Language } from '../../interfaces/interfaces';
import { IonicSelectableComponent } from 'ionic-selectable';
import { LocaldataService } from '../../services/localdata.service';
import { AndroidPermissions } from '@ionic-native/android-permissions/ngx';
import * as BCrypt from 'bcryptjs'
import { TranslateService } from '@ngx-translate/core';
import { AppComponent } from '../../app.component';
@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnDestroy, OnInit {
  @ViewChild('selectDiag') selectComponent: IonicSelectableComponent
  ambul: any
  currentScreenOrientation: string
  Usuario: string;
  Password: string;
  backButtonSubscription: any;
  Ambulancias: Ambulancia[] = []
  usuarios: Usuario[] = []
  languages: Language[] = []

  constructor(
    public appM: AppComponent,
    public localService: LocaldataService,
    public navCtrl: NavController,
    public menuCtrl: MenuController,
    public dataService: DataService,
    public alertController: AlertController,
    public toastCtrl: ToastController,
    private plt: Platform,
    private screenOrientation: ScreenOrientation,
    private androidPermissions: AndroidPermissions,
    private _translate: TranslateService) { }
  ionViewWillEnter() {
    this.setLandscape()
    this.menuCtrl.enable(false, 'sismenu');
    this.dataService.turnoc = false
    this.dataService.userToken = 'false'
    this.dataService.user = ''
    this.dataService.getLanguages().toPromise().then(languages => {
      languages.forEach(element => {
        this.languages.push(element)
      });
    });
  }
  setLang(lang) {
    switch (lang) {
      case "01":
        this.appM._translate.use('es');
        this.dataService.lang = 'es'
        this.localService.lang = 'es'
        break;
      case "02":
        this.appM._translate.use('en');
        this.dataService.lang = 'en'
        this.localService.lang = 'en'
        break;
      case "03":
        this.appM._translate.use('po');
        this.dataService.lang = 'po'
        this.localService.lang = 'po'
        break;
      case "04":
        this.appM._translate.use('fr');
        this.dataService.lang = 'fr'
        this.localService.lang = 'fr'
        break;
      default:
        this.appM._translate.use('es');
        this.dataService.lang = 'es'
        this.localService.lang = 'es'
        break;
    }
  }
  ionViewDidEnter() {
    this.backButtonSubscription = this.plt.backButton.subscribe(async () => {
      this.confirmExit()
    });
  }
  ionViewDidLeave() {
    this.backButtonSubscription.unsubscribe();
  }
  async confirmExit() {
    const alert = await this.alertController.create({
      header: this._translate.instant('LOGIN-COMPONENT.CONFIRM-EXIT.HEADER'),
      message: this._translate.instant('LOGIN-COMPONENT.CONFIRM-EXIT.MESSAGE'),
      buttons: [
        {
          text: this._translate.instant('LOGIN-COMPONENT.CONFIRM-EXIT.CANCELAR-LABEL'),
          role: 'cancel',
          cssClass: 'secondary',
          handler: (blah) => {

          }
        }, {
          text: this._translate.instant('LOGIN-COMPONENT.CONFIRM-EXIT.SI-LABEL'),
          handler: () => {
            navigator['app'].exitApp();
          }
        }
      ]
    });

    await alert.present();
  }
  setAmbu() {
    this.dataService.codAmbu = this.ambul.cod_ambulancias
    this.dataService.icodAmbu = this.ambul.id_ambulancias
    this.login()
  }
  async allowpermissions() {
    this.androidPermissions.checkPermission(this.androidPermissions.PERMISSION.ACCESS_FINE_LOCATION).then(result => {
      if (result.hasPermission == false) {
        this.androidPermissions.requestPermissions([this.androidPermissions.PERMISSION.ACCESS_FINE_LOCATION, this.androidPermissions.PERMISSION.ACCESS_COARSE_LOCATION])
      }
    })
    this.androidPermissions.checkPermission(this.androidPermissions.PERMISSION.READ_EXTERNAL_STORAGE).then(result => {
      if (result.hasPermission == false) {
        this.androidPermissions.requestPermissions([this.androidPermissions.PERMISSION.WRITE_EXTERNAL_STORAGE, this.androidPermissions.PERMISSION.MANAGE_EXTERNAL_STORAGE, this.androidPermissions.PERMISSION.READ_EXTERNAL_STORAGE])
      }
    })
  }
  async ngOnInit() {
    await this.allowpermissions()
    this.dataService.lStorage.get("Ambulancias").then(value => {
      if (value == null || value.length == 0) {
        this.dataService.firsttime = 'true'
        if (this.plt.is('cordova')) {
          this.androidPermissions.checkPermission(this.androidPermissions.PERMISSION.WRITE_EXTERNAL_STORAGE).then(result => {
            if (result.hasPermission == true) {
              this.presentMSG(this._translate.instant('LOGIN-COMPONENT.CONFIRM-EXIT.SI-LABEL'));
            } else {
              this.ngOnInit()
            }
          })
        } else {
          this.presentMSG(this._translate.instant('LOGIN-COMPONENT.REGISTROS-LOCALES'));
        }
      } else {
        this.dataService.lStorage.length().then(value => {
          if (value < 20) {
            this.dataService.updateMode = 'true'
            this.dataService.syncalldata()
          }
        })
        this.dataService.firsttime = 'false'
        this.dataService.updateMode = 'true'
        this.dataService.syncalldata('Usuarios')
        this.dataService.syncalldata('Ambulancias')
        this.Ambulancias = this.dataService.localData.getAmbulancias()
        this.usuarios = this.dataService.localData.getUsuarios()
        this.dataService.loginterval = setInterval(() => {
          this.dataService.updateMode = 'true'
          this.dataService.syncalldata('Usuarios')
          this.dataService.syncalldata('Ambulancias')
          this.Ambulancias = this.dataService.localData.getAmbulancias()
          this.usuarios = this.dataService.localData.getUsuarios()
          setTimeout(() => {
            this.dataService.updateMode = 'false'
          }, 5000);
        }, 90000)
      }
    })
  }
  updateusers() {

  }
  ngOnDestroy() {
    this.menuCtrl.enable(true, 'sismenu');
    clearInterval(this.dataService.loginterval)
  }
  setLandscape() {
    // set to landscape
    this.screenOrientation.lock(this.screenOrientation.ORIENTATIONS.LANDSCAPE);
  }
  //BUSCADOR SELECCIONABLE
  diagCancel() {
    this.selectComponent.clear();
    this.selectComponent.close();
  }
  diagClear() {
    this.selectComponent.clear();
    this.selectComponent.close();
  }
  diagConf() {
    this.selectComponent.confirm();
    this.selectComponent.close();
  }
  searchDiag(event: {
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

    event.component.items = this.filterPorts(this.Ambulancias, text);
    event.component.endSearch();
  };
  filterPorts(ambulancias: Ambulancia[], text: string) {
    return ambulancias.filter(ambulancia => {
      return ambulancia.cod_ambulancias.toLowerCase().indexOf(text) !== -1
    });
  }
  login() {
    this.verifyUser(this.Usuario, this.Password)
  }
  buscarUsuario(usuarios: Usuario[], text: string) {
    return usuarios.filter(usuario => {
      return usuario.login.toLowerCase().indexOf(text) !== -1
    });
  }
  verifyUser(user: string, pass: string) {
    let veruser = this.buscarUsuario(this.usuarios, user)
    if (user == '' || user == undefined) {
      this.presentAlertConfirm(this._translate.instant('LOGIN-COMPONENT.CONFIRM-VERIFY.USUARIO-INCORRECTO'));
    } else {
      if (veruser.length == 0) {
        this.presentAlertConfirm(this._translate.instant('LOGIN-COMPONENT.CONFIRM-VERIFY.USUARIO-INEXISTENTE'));
      } else {
        if (pass == '' || pass == undefined) {
          this.presentAlertConfirm(this._translate.instant('LOGIN-COMPONENT.CONFIRM-VERIFY.CONTRASENA-VACIA'));
        } else {
          let hash = veruser[0].pw
          if (BCrypt.compareSync(pass, hash)) {
            if (this.ambul == '' || this.ambul == undefined) {
              this.presentAlertConfirm(this._translate.instant('LOGIN-COMPONENT.CONFIRM-VERIFY.AMBULANCIA-VACIA'));
            } else {
              this.dataService.userToken = 'true'
              this.dataService.user = user
              this.navCtrl.navigateRoot('inicio');
            }
          } else {
            this.presentAlertConfirm(this._translate.instant('LOGIN-COMPONENT.CONFIRM-VERIFY.CONTRASENA-INCORRECTA'))
          }
        }
      }
    }

  }
  async presentAlertConfirm(mensaje: string, header: string = 'Error') {
    const alert = await this.alertController.create({
      header: header,
      message: mensaje,
      buttons: [
        {
          text: this._translate.instant('LOGIN-COMPONENT.OK-LABEL'),
          handler: () => {
          }
        }
      ]
    });

    await alert.present();
  }
  async presentMSG(mensaje: string) {
    const alert = await this.alertController.create({
      header: 'Alert',
      message: mensaje,
      buttons: [
        {
          text: this._translate.instant('LOGIN-COMPONENT.CANCELAR-LABEL-2'),
          role: 'cancel',
          cssClass: 'secondary',
          handler: (blah) => {

          }
        }, {
          text: this._translate.instant('LOGIN-COMPONENT.SI-LABEL-2'),
          handler: () => {
            if (this.plt.is('cordova')) {
              this.androidPermissions.checkPermission(this.androidPermissions.PERMISSION.WRITE_EXTERNAL_STORAGE).then(result => {
                if (result.hasPermission == true) {
                  this.dataService.syncalldata().finally(() => {
                    setTimeout(() => {
                      this.dataService.presentToast(this._translate.instant('LOGIN-COMPONENT.REINICIANDO'))
                      setTimeout(() => {
                        window.location.reload()
                      }, 2000);
                    }, 15000);
                  })
                }
              })
            } else {
              this.dataService.syncalldata().finally(() => {
                setTimeout(() => {
                  this.dataService.presentToast(this._translate.instant('LOGIN-COMPONENT.REINICIANDO'));
                  setTimeout(() => {
                    window.location.reload()
                  }, 2000);
                }, 15000);
              })
            }
          }
        }
      ]
    });

    await alert.present();
  }
}
