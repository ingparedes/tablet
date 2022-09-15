import { Component, OnInit } from '@angular/core';
import { DataService } from '../../services/data.service';
import { Observable } from 'rxjs';
import { Componente } from '../../interfaces/interfaces';
import { MenuController } from '@ionic/angular';
import { TranslateService } from '@ngx-translate/core';

@Component({
  selector: 'app-sismenu',
  templateUrl: './sismenu.component.html',
  styleUrls: ['./sismenu.component.scss'],
})
export class SismenuComponent implements OnInit {

  componentes: Componente[] = [];

  constructor(private dataService: DataService,
    public menuCtrl: MenuController,
    private _translate: TranslateService) { }

  ngOnInit() {
    
    this.dataService.getMenuOpts().subscribe(response => {
      this.componentes = response;
    })
    
  }

  closeSisMenu() {
    this.menuCtrl.enable(false, 'sismenu');    
    this.dataService.turnoc = false
    this.dataService.userToken = 'false'
    this.dataService.user = ''    
  }

}
