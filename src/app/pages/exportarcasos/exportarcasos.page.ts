import { Component, OnInit } from '@angular/core';
import { DataService } from '../../services/data.service';
import { NavController, MenuController } from '@ionic/angular';

@Component({
  selector: 'app-exportarcasos',
  templateUrl: './exportarcasos.page.html',
  styleUrls: ['./exportarcasos.page.scss'],
})
export class ExportarcasosPage implements OnInit {

  constructor(private dataService: DataService, private navCtrl: NavController, public menuCtrl: MenuController) { }

  ngOnInit() {    
  }

}
