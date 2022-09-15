import { HttpClient } from '@angular/common/http'
import { Injectable } from "@angular/core";
import { Componente, checkboxarray, insinsumos, insmedicamento, insexpf, nosynchs, insinfobasica, insdiagnostico, insotros, insobste, turno, insfirmas, Triage, oCasoMedico, Language } from '../interfaces/interfaces';
import { HTTP } from '@ionic-native/http/ngx';
import { Platform, ToastController } from '@ionic/angular';
import { environment } from '../../environments/environment.prod';
import { from } from 'rxjs';
import { LocaldataService } from './localdata.service';
import { Storage } from '@ionic/Storage';

const apiUrl = environment.apiUrl;
@Injectable({
    providedIn: 'root'
})
export class DataService {
    constructor(private http: HttpClient, private plt: Platform, private httn: HTTP, public localData: LocaldataService, public lStorage: Storage, public toastCtrl: ToastController) { }
    lang: string = "es"
    caso: any;
    myinterval: any;
    loginterval: any;
    initinterval: any;
    asigninterval: any;
    turno: turno;
    turnoc: boolean = false;
    causa: any;
    narray: checkboxarray[] = [];
    firma: insfirmas;
    infobasica: insinfobasica;
    causatrauma: checkboxarray[] = [];
    nosynchcases: nosynchs[] = [];
    explo_fisica: insexpf[] = [];
    explo_general: checkboxarray[] = [];
    procedimientos: checkboxarray[] = [];
    causaobstetrico: insobste;
    diagnostico: insdiagnostico;
    medicamentos: insmedicamento[] = [];
    insumos: insinsumos[] = [];
    otros: insotros;
    hora_i: any;
    hora_e: any;
    hora_h: any;
    hora_b: any;
    public medico: string = '';
    public firsttime: string = '';
    public userToken: string = 'false';
    public user: string = '';
    public codAmbu: string = '';
    public icodAmbu: string = '';
    public codCaso: string = '';
    public codHospital: string = '';
    public Hospital: string = '';
    public gp: string = '';
    public corlat: string;
    public corlong: string;
    public fhora: string = '';
    public kinicial: string = '';
    public updateMode: string = '';
    public conxn: string = '';

    //GLOBAL FUNCTIONS
    dateLocale(date): string {
        return date.getFullYear()
            + '-' + this.leftpad(date.getMonth() + 1, 2)
            + '-' + this.leftpad(date.getDate(), 2)
            + ' ' + this.leftpad(date.getHours(), 2)
            + ':' + this.leftpad(date.getMinutes(), 2)
            + ':' + this.leftpad(date.getSeconds(), 2);
    }
    leftpad(val, resultLength = 2, leftpadChar = '0'): string {
        return (String(leftpadChar).repeat(resultLength)
            + String(val)).slice(String(val).length);
    }
    async presentToast(message: string) {
        await this.toastCtrl.create({ message: message, duration: 1500 }).then(res => { res.present() })
    }
    //GET DATA    
    private getData(servicio: String, dataToSend: any) {
        servicio = apiUrl + servicio;
        let respuestaDatos = []
        if (this.plt.is('cordova')) {
            this.httn.setDataSerializer('json')
            dataToSend = JSON.parse(dataToSend)
            let nativeCall = this.httn.post(servicio + '', dataToSend, { 'Content-Type': 'application/json' })
            from(nativeCall).subscribe(data => {
                let newdata = JSON.parse(data.data)
                for (let items in newdata) {
                    if (newdata.hasOwnProperty(items)) {
                        let arrayDatos = newdata[items]
                        if (arrayDatos.length >= 1) {
                            arrayDatos.forEach(element => {
                                respuestaDatos.push(element)
                            });
                        } else {
                            respuestaDatos.push(arrayDatos)
                        }
                    }
                }
            })
            from(nativeCall).toPromise().finally(() => {
                if (respuestaDatos.length == 0) {

                } else {

                }
            })
        } else {
            this.http.post(servicio + '', dataToSend, { headers: { "Content-Type": "application/json" } }).toPromise().then(data => {                
                for (let items in data) {
                    if (data.hasOwnProperty(items)) {
                        let arrayDatos = data[items]
                        if (arrayDatos.length >= 1) {
                            arrayDatos.forEach(element => {
                                respuestaDatos.push(element)
                            });
                        } else {
                            respuestaDatos.push(arrayDatos)
                        }
                    }
                }
            }).finally(() => {
                if (respuestaDatos.length == 0) {

                } else {

                }
            })
        }
        return respuestaDatos
    }
    //SET DATA
    private setData(servicio: String, dataToSend: any) {
        servicio = apiUrl + servicio;
        let respuestaDatos = []
        if (this.plt.is('cordova')) {
            this.httn.setDataSerializer('json')
            dataToSend = JSON.parse(dataToSend)
            let nativeCall = this.httn.post(servicio + '', dataToSend, { 'Content-Type': 'application/json' })
            from(nativeCall).subscribe(data => {
                let newdata = JSON.parse(data.data)
                for (let items in newdata) {
                    if (newdata.hasOwnProperty(items)) {
                        let arrayDatos = newdata[items]
                        if (arrayDatos.length >= 1) {
                            arrayDatos.forEach(element => {
                                respuestaDatos.push(element)
                            });
                        } else {
                            respuestaDatos.push(arrayDatos)
                        }
                    }
                }
            })
            from(nativeCall).toPromise().finally(() => {
                if (respuestaDatos.length == 0) {

                } else {

                }
            })
        } else {
            this.http.post(servicio + '', dataToSend, { headers: { "Content-Type": "application/json" } }).toPromise().then(data => {
                for (let items in data) {
                    if (data.hasOwnProperty(items)) {
                        let arrayDatos = data[items]
                        if (arrayDatos.length >= 1) {
                            arrayDatos.forEach(element => {
                                respuestaDatos.push(element)
                            });
                        } else {
                            respuestaDatos.push(arrayDatos)
                        }
                    }
                }
            }).finally(() => {
                if (respuestaDatos.length == 0) {

                } else {

                }
            })
        }
        return respuestaDatos
    }
    //STATIC METHODS        
    getMenuOpts() {
        return this.http.get<Componente[]>('../assets/data/menu.json')
    }
    getLanguages() {
        return this.http.get<Language[]>('../assets/data/languages.json')
    }
    //DINAMIC METHODS
    async syncalldata(dato: string = '') {
        let ambulancias, usuarios, casosasignados, aseguradoras, insumos, medicamentos, diagnosticos, explofisica, explogen, procedimientos, deptos, distos, provin, dni, genero, traumas, triage, cierrecaso, hospitales, casoscerrados: any[]
        switch (dato) {
            case '':
                this.presentToast('Actualizando registros')
                ambulancias = await this.getAmbulancias();
                usuarios = await this.getUsuarios();
                casosasignados = await this.getCasosAsignados();
                aseguradoras = await this.getAseg();
                insumos = await this.getInsumos();
                medicamentos = await this.getMedicamentos();
                diagnosticos = await this.getDiagnosticos();
                explofisica = await this.getExploFisica();
                explogen = await this.getExploGen();
                procedimientos = await this.getProcedimientos();
                deptos = await this.getDpto();
                distos = await this.getDist();
                provin = await this.getProv();
                dni = await this.getDNI();
                genero = await this.getGen();
                traumas = await this.getTrauma();
                triage = await this.getTriage();
                cierrecaso = await this.getCierreCaso();
                hospitales = await this.getHospitales();
                casoscerrados = await this.getCasosCerrados();
                setTimeout(() => {
                    if (ambulancias.length >= 1) {
                        this.lStorage.set('Ambulancias', ambulancias)
                    }
                    if (usuarios.length >= 1) {
                        this.lStorage.set('Usuarios', usuarios)
                    }
                    if (casosasignados.length >= 1) {
                        this.lStorage.set('Casos Asignados', casosasignados)
                    }
                    if (insumos.length >= 1) {
                        this.lStorage.set('Insumos', insumos)
                    }
                    if (medicamentos.length >= 1) {
                        this.lStorage.set('Medicamentos', medicamentos)
                    }
                    if (diagnosticos.length >= 1) {
                        this.lStorage.set('Diagnosticos', diagnosticos)
                    }
                    if (explofisica.length >= 1) {
                        this.lStorage.set('Explo Fisica', explofisica)
                    }
                    if (procedimientos.length >= 1) {
                        this.lStorage.set('Procedimientos', procedimientos)
                    }
                    if (deptos.length >= 1) {
                        this.lStorage.set('Departamentos', deptos)
                    }
                    if (provin.length >= 1) {
                        this.lStorage.set('Provincias', provin)
                    }
                    if (distos.length >= 1) {
                        this.lStorage.set('Distritos', distos)
                    }
                    if (dni.length >= 1) {
                        this.lStorage.set('DNI', dni)
                    }
                    if (genero.length >= 1) {
                        this.lStorage.set('Genero', genero)
                    }
                    if (casoscerrados.length >= 1) {
                        this.lStorage.set('Casos Cerrados', casoscerrados)
                    }
                    if (aseguradoras.length >= 1) {
                        this.lStorage.set('Aseguradoras', aseguradoras)
                    }
                    if (traumas.length >= 1) {
                        this.lStorage.set('Traumas', traumas)
                    }
                    if (explogen.length >= 1) {
                        this.lStorage.set('Explo Gen', explogen)
                    }
                    if (triage.length >= 1) {
                        this.lStorage.set('Triage', triage)
                    }
                    if (cierrecaso.length >= 1) {
                        this.lStorage.set('Cierre Caso', cierrecaso)
                    }
                    if (hospitales.length >= 1) {
                        this.lStorage.set('Hospitales', hospitales)
                    }
                }, 10000);
                this.firsttime = 'false'
                break;
            case 'Ambulancias':
                ambulancias = await this.getAmbulancias();
                setTimeout(() => {
                    if (ambulancias.length >= 1) {
                        console.log('Registros Actualizados')
                        this.lStorage.set('Ambulancias', ambulancias)
                    }
                }, 1500);
                break;
            case 'Usuarios':
                usuarios = await this.getUsuarios();
                setTimeout(() => {
                    if (usuarios.length >= 1) {
                        console.log('Registros Actualizados')
                        this.lStorage.set('Usuarios', usuarios)
                    }
                }, 1500);
                break;
            case 'Casos Asignados':
                casosasignados = await this.getCasosAsignados();
                setTimeout(() => {
                    if (casosasignados.length >= 1) {
                        console.log('Casos Asignados')
                        this.lStorage.set('Casos Asignados', casosasignados)
                    } else {
                        this.lStorage.remove('Casos Asignados')
                    }
                }, 2000);
                break;
            case 'Casos Cerrados':
                casoscerrados = await this.getCasosCerrados();
                setTimeout(() => {
                    if (casoscerrados.length >= 1) {
                        console.log('Casos Cerrados Actualizados')
                        this.lStorage.set('Casos Cerrados', casoscerrados)
                    } else {
                        this.lStorage.remove('Casos Cerrados')
                    }
                }, 2000);
                break;
            default:
                break;
        }
    }
    //GET METHODS    
    getAmbulancias() {
        let Ambulancias: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Ambulancias', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            Ambulancias = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Ambulancias', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            Ambulancias = this.getData(url, dataToSend)
        } else {
            Ambulancias = this.localData.getAmbulancias()
        }
        return Ambulancias
    }
    getCasosAsignados() {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Casos Asignados', Cod_Ambu: this.icodAmbu, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Casos Asignados', Cod_Ambu: this.icodAmbu, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getCasosAsignados(this.codAmbu)
        }
        return datos
    }
    getUsuarios() {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Usuarios', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Usuarios', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getUsuarios()
        }
        return datos
    }
    getAseg() {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Aseguradoras', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Aseguradoras', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getAseg()
        }
        return datos
    }
    getInsumos() {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Insumos', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Insumos', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getInsumos()
        }
        return datos
    }
    getMedicamentos() {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Medicamentos', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Medicamentos', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getMedicamentos()
        }
        return datos
    }
    getDiagnosticos() {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Diagnosticos', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Diagnosticos', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getDiagnosticos()
        }
        return datos
    }
    getExploFisica() {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Explo Fisica', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Explo Fisica', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getExploFisica()
        }
        return datos
    }
    getProcedimientos() {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Procedimientos', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Procedimientos', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getProcedimientos()
        }
        return datos
    }
    getDpto() {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Departamento', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Departamento', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getDpto()
        }
        return datos
    }
    getProv(Dp: string = '') {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Provincia', Departamento: Dp, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Provincia', Departamento: Dp, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getProv(Dp)
        }
        return datos
    }
    getDist(Dp: string = '', Pr: string = '') {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Distrito', Departamento: Dp, Provincia: Pr, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Distrito', Departamento: Dp, Provincia: Pr, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getDist(Dp, Pr)
        }
        return datos
    }
    getDNI() {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'DNI', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'DNI', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getDNI()
        }
        return datos
    }
    getGen() {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Genero', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Genero', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getGen()
        }
        return datos
    }
    getTrauma(categoria: string = '') {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Trauma', Categoria: categoria, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Trauma', Categoria: categoria, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getTrauma(categoria)
        }
        return datos
    }
    getExploGen(categoria: string = '') {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Explo Gen', Categoria: categoria, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Explo Gen', Categoria: categoria, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getExploGen(categoria)
        }
        return datos
    }
    getTriage() {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Triage', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Triage', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getTriage()
        }
        return datos
    }
    getCierreCaso() {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Cierre Caso', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Cierre Caso', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getCierreCaso()
        }
        return datos
    }
    getHospitales() {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Hospitales', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Hospitales', Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getHospitales()
        }
        return datos
    }
    getCasosCerrados() {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Casos Cerrados', Cod_Ambu: this.icodAmbu, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Casos Cerrados', Cod_Ambu: this.icodAmbu, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            datos = this.localData.getCasos(this.icodAmbu)
        }
        return datos
    }
    getCasoPDF(idcaso: any) {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso PDF', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso PDF', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            this.presentToast("Hubo un error")
        }
        return datos
    }
    getCasoTrauma(idcaso: any) {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso Trauma', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso Trauma', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            this.presentToast("Hubo un error")
        }
        return datos
    }
    getCasoExpG(idcaso: any) {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso ExpG', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso ExpG', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            this.presentToast("Hubo un error")
        }
        return datos
    }
    getCasoExpF(idcaso: any) {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso ExpF', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso ExpF', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            this.presentToast("Hubo un error")
        }
        return datos
    }
    getCasoMedicamentos(idcaso: any) {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso Medicamentos', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso Medicamentos', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            this.presentToast("Hubo un error")
        }
        return datos
    }
    getCasoInsumos(idcaso: any) {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso Insumos', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso Insumos', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            this.presentToast("Hubo un error")
        }
        return datos
    }
    getCasoProc(idcaso: any) {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso Procedimientos', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso Procedimientos', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            this.presentToast("Hubo un error")
        }
        return datos
    }
    getCasoDiag(idcaso: any) {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso Diagnosticos', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso Diagnosticos', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            this.presentToast("Hubo un error")
        }
        return datos
    }
    getCasoObst(idcaso: any) {
        let datos: any[]
        if (this.firsttime == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso Obstetrico', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else if (this.updateMode == 'true') {
            let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Caso Obstetrico', Caso: idcaso, Lang: this.lang }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/gAPI.php'
            datos = this.getData(url, dataToSend)
        } else {
            this.presentToast("Hubo un error")
        }
        return datos
    }
    async getMedicaso(idcaso: any) {
        let datos: oCasoMedico[]
        let jsontext = { Token: 'MAgJKq3LaKxL3pae', Servicio: 'Medicaso', Caso: idcaso, Lang: this.lang }
        let dataToSend = JSON.stringify(jsontext)
        let url = '/gAPI.php'
        datos = await this.getData(url, dataToSend)
        if (datos.length >= 1) {
            for (let i = 0; i < 1; i++) {
                const element = datos[i];
                this.codHospital = element.cod_hospital
                this.medico = element.medico
                this.Hospital = element.nombre_hospital
            }
        }
        if (this.codHospital !== '' || this.codHospital !== undefined) {
            if (this.Hospital !== '' || this.Hospital !== undefined) {
                console.log(this.medico, this.Hospital, this.codHospital)
                clearInterval(this.myinterval)
            }
        }
        return datos
    }



    //INSERT METHODS
    setTurno(km_actual: String, combustible_actual: String, cantidadtiket: String, observacion: String) {
        if (this.conxn == 'true') {
            this.turnoc = true
            let data = { cod_ambu: this.codAmbu, km_actual: km_actual, combustible_actual: combustible_actual, cantidadtiket: cantidadtiket, observacion: observacion, usuario: this.user }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setTurno' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            let arrayx = this.setData(url, dataToSend)
            console.log("Con Conexión")
            return arrayx
        } else {
            this.turnoc = false
        }
    }
    setPaciente(num_doc: string, tipo_doc: string, nombre1: string, nombre2: string, apellido1: string, apellido2: string, genero: string, edad: Number, fecha_nacido: string, cod_edad: string, telefono: string, celular: string, direccion: string, asegurador: string, dpto: string, prov: string, dist: string, kinicial: string) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, num_doc: num_doc, tipo_doc: tipo_doc, nombre1: nombre1, nombre2: nombre2, apellido1: apellido1, apellido2: apellido2, genero: genero, edad: edad, fecha_nacido: fecha_nacido, cod_edad: cod_edad, telefono: telefono, celular: celular, direccion: direccion, asegurador: asegurador, dpto: dpto, prov: prov, dist: dist, k_inicial: kinicial }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setPaciente' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            let arrayx = this.setData(url, dataToSend)
            return arrayx
        } else {
            this.infobasica = { num_doc: num_doc, tipo_doc: tipo_doc, nombre1: nombre1, nombre2: nombre2, apellido1: apellido1, apellido2: apellido2, genero: genero, edad: edad, fecha_nacido: fecha_nacido, cod_edad: cod_edad, telefono: telefono, celular: celular, direccion: direccion, asegurador: asegurador, dpto: dpto, prov: prov, dist: dist }
        }
    }
    setCausa(cod_causa: String) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, cod_causa: cod_causa }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setCausa' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            this.causa = cod_causa
            this.causaobstetrico = undefined
            this.causatrauma = undefined
        }
    }
    setTrauma(cod_trauma: string) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, cod_trauma: cod_trauma }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setTrauma' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            let data = { id: cod_trauma }
            this.causatrauma.push(data)
            this.causaobstetrico = undefined
        }
    }
    delTrauma(cod_trauma: string) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, cod_trauma: cod_trauma }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'delTrauma' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            this.causatrauma.forEach(element => {
                if (element.id !== cod_trauma) {
                    this.narray.push(element)
                }
            });
            this.causatrauma = this.narray
            this.narray = []
        }
    }
    setObstetrico(trab: String, sang: String, g: String, p: String, a: String, n: String, c: String, fuente: String, tgest: String) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, trabajoparto: trab, sangradovaginal: sang, g: g, p: p, a: a, n: n, c: c, fuente: fuente, tiempo: tgest }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setObstetrico' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            let data = { trabajoparto: trab, sangradovaginal: sang, g: g, p: p, a: a, n: n, c: c, fuente: fuente, tiempo: tgest }
            this.causaobstetrico = { trabajoparto: trab, sangradovaginal: sang, g: g, p: p, a: a, n: n, c: c, fuente: fuente, tiempo: tgest }
            this.causatrauma = undefined
        }
    }
    setExpGeneral(cod_trauma: string) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, cod_trauma: cod_trauma }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setExpGeneral' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            let data = { id: cod_trauma }
            this.explo_general.push(data)
        }
    }
    delExpGeneral(cod_trauma: string) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, cod_trauma: cod_trauma }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'delExpGeneral' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            this.explo_general.forEach(element => {
                if (element.id !== cod_trauma) {
                    this.narray.push(element)
                }
            });
            this.explo_general = this.narray
            this.narray = []
        }
    }
    setDiagnostico(fecha_horaevaluacion: String, triage: String, sv_tx: String, sv_fc: String, sv_fr: String, sv_temp: String, sv_satO2: String, sv_gl: String, cod_diag_cie: String, ap_diabetes: String, ap_cardiop: String, ap_convul: String, ap_asma: String, ap_acv: String, ap_has: String, ap_alergia: String, ap_med_paciente: String, ap_otros: String) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, fecha_horaevaluacion: fecha_horaevaluacion, triage: triage, sv_tx: sv_tx, sv_fc: sv_fc, sv_fr: sv_fr, sv_temp: sv_temp, sv_satO2: sv_satO2, sv_gl: sv_gl, cod_diag_cie: cod_diag_cie, ap_diabetes: ap_diabetes, ap_cardiop: ap_cardiop, ap_convul: ap_convul, ap_asma: ap_asma, ap_acv: ap_acv, ap_has: ap_has, ap_alergia: ap_alergia, ap_med_paciente: ap_med_paciente, ap_otros: ap_otros }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setDiagnostico' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            this.diagnostico = { fecha_horaevaluacion: fecha_horaevaluacion, triage: triage, sv_tx: sv_tx, sv_fc: sv_fc, sv_fr: sv_fr, sv_temp: sv_temp, sv_satO2: sv_satO2, sv_gl: sv_gl, cod_diag_cie: cod_diag_cie, ap_diabetes: ap_diabetes, ap_cardiop: ap_cardiop, ap_convul: ap_convul, ap_asma: ap_asma, ap_acv: ap_acv, ap_has: ap_has, ap_alergia: ap_alergia, ap_med_paciente: ap_med_paciente, ap_otros: ap_otros }
        }
    }
    setProc(id_proc: string) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, id_proc: id_proc }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setProc' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            let data = { id: id_proc }
            this.procedimientos.push(data)
        }
    }
    delProc(id_proc: string) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, id_proc: id_proc }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'delProc' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            this.procedimientos.forEach(element => {
                if (element.id !== id_proc) {
                    this.narray.push(element)
                }
            });
            this.procedimientos = this.narray
            this.narray = []
        }
    }
    setMedicamento(id_med: string, cant: string) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, id_med: id_med, cant: cant }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setMedicamentos' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            let data = { id: id_med, cant: cant }
            this.medicamentos.push(data)
        }
    }
    delMedicamento(id_med: string) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, id_med: id_med }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'delMedicamentos' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            let medarray: insmedicamento[] = []
            this.medicamentos.forEach(element => {
                if (element.id !== id_med) {
                    medarray.push(element)
                }
            });
            this.medicamentos = medarray
            this.narray = []
        }
    }
    setInsumos(id_insu: string, cant: string) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, id_insu: id_insu, cant: cant }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setInsumo' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            let data = { id: id_insu, cant: cant }
            this.insumos.push(data)
        }
    }
    delInsumos(id_insu: string) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, id_insu: id_insu }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'delInsumo' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            let insarray: insinsumos[] = []
            this.insumos.forEach(element => {
                if (element.id !== id_insu) {
                    insarray.push(element)
                }
            });
            this.medicamentos = insarray
            this.narray = []
        }
    }
    setOthers(desc: String, nombre_confirma: String, telefono_confirma: String, kfinal: String, hospital: String, med: String, obscaso: String, cierre: String) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, desc: desc, nombre_confirma: nombre_confirma, telefono_confirma: telefono_confirma, kfinal: kfinal, hospital: hospital, med: med, obscaso: obscaso, cierre: cierre }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setOthers' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            this.otros = { desc: desc, nombre_confirma: nombre_confirma, telefono_confirma: telefono_confirma, kfinal: kfinal, hospital: hospital, med: med, obscaso: obscaso, cierre: cierre }
        }
    }
    setFirma(posx: string, posy: string, ancho) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, posx: posx, posy: posy, ancho: ancho }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setFirma' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            let data = { posx: posx, posy: posy, ancho: ancho }
            this.firma = data
        }
    }
    setTraumaFisico(id_trauma_fisico: number, posx: number, posy: number, pos: number) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, id_trauma_fisico: id_trauma_fisico, posx: posx, posy: posy, pos: pos }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setTraumaFisico' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            let data = { id: id_trauma_fisico, posx: posx, posy: posy, pos: pos }
            this.explo_fisica.push(data)
        }
    }
    setDelTraumaFisico() {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'delTraumaFisico' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            this.explo_fisica = []
        }
    }
    setHoraI(longitud: string, latitud: string) {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, hora: this.fhora, latitud: latitud, longitud: longitud }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setHoraI' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            this.hora_i = this.fhora
        }
    }
    setHoraE() {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, hora: this.fhora }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setHoraE' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            this.hora_e = this.fhora
        }
    }
    setHoraH() {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, hora: this.fhora }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setHoraH' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            this.hora_h = this.fhora
        }
    }
    setHoraB() {
        if (this.conxn == 'true') {
            let data = { cod_caso: this.codCaso, hora: this.fhora }
            let jsontext = { JsonParam: data, Token: 'MAgJKq3LaKxL3pae', Servicio: 'setHoraB' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            return this.setData(url, dataToSend)
        } else {
            this.hora_b = this.fhora
        }
    }
    saveCase() {
        let data = {
            cod_caso: this.codCaso, infobasica: this.infobasica, causa: this.causa, subcausat: this.causatrauma, subcausao: this.causaobstetrico, exporacion_general: this.explo_general, diagnostico: this.diagnostico, procedimientos: this.procedimientos, medicamentos: this.medicamentos, insumos: this.insumos, otros: this.otros, exploracion_fisica: this.explo_fisica, hora_i: this.hora_i, hora_e: this.hora_e, hora_b: this.hora_b, hora_h: this.hora_h, latitud: this.corlat, longitud: this.corlong, kinicial: this.kinicial, firmas: this.firma
        }
        // imgs: this.imagenes,
        this.caso = data
        this.nosynchcases.push(this.caso)
    }
    synchCases() {
        if (this.turnoc == false) {
            let jsontext = { JsonParam: this.turno }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            let arrayx = this.getData(url, dataToSend)
        }
        this.nosynchcases.forEach(element => {
            let jsontext = { JsonParam: element, Token: 'MAgJKq3LaKxL3pae', Servicio: 'SynchLocal' }
            let dataToSend = JSON.stringify(jsontext)
            let url = '/sAPI.php'
            let anything = this.setData(url, dataToSend)
        });
    }
}