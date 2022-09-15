import { Component, OnInit } from '@angular/core';
import { DataService } from '../../../../services/data.service';
import { Procedimiento } from '../../../../interfaces/interfaces';
import { NavController } from '@ionic/angular';
@Component({
  selector: 'app-loadprocedimientos',
  templateUrl: './loadprocedimientos.page.html',
  styleUrls: ['./loadprocedimientos.page.scss'],
})
export class LoadprocedimientosPage implements OnInit {
  procedimientos: Procedimiento[] = []

  constructor(private navControl: NavController, private dataService: DataService) { }
  ngAfterViewInit() {    
  }
  ngOnInit() {
    this.procedimientos = this.dataService.getProcedimientos()
  }

  SetProc(event) {
    let anything
    if (event.detail.checked) {
      anything = this.dataService.setProc(event.detail.value)
    } else {
      anything = this.dataService.delProc(event.detail.value)
    }
  }
}
