import { Component, Input, OnInit } from '@angular/core';
import { Geolocation } from '@ionic-native/geolocation/ngx';
import { DataService } from '../../services/data.service';


@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss'],
})
export class HeaderComponent implements OnInit {
  @Input() showH: boolean = false
  @Input() showHH: boolean = true
  @Input() showHI: boolean = true
  @Input() showHB: boolean = true
  @Input() showHE: boolean = true

  constructor(
    private geo: Geolocation, 
    private data: DataService
    
    ) { }

  ghBase() {
    this.data.fhora = this.data.dateLocale(new Date())
    this.data.setHoraB()
    this.showHB = false
    this.showH = false
  }

  ghStart() {
    this.data.fhora = this.data.dateLocale(new Date())
    this.geo.getCurrentPosition().then((resp) => {      
      this.data.setHoraI(resp.coords.longitude.toString(),resp.coords.latitude.toString())      
    })
    this.showHI = false
  }

  ghEvent() {
    this.data.fhora = this.data.dateLocale(new Date())
    this.data.setHoraE()
    this.showHE = false
  }

  ghHosp() {
    this.data.fhora = this.data.dateLocale(new Date())
    this.data.setHoraH()
    this.showHH = false
  }

  ngOnInit() {

  }
}
