import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DashAdmiComponent } from './dash-admi.component';

describe('DashAdmiComponent', () => {
  let component: DashAdmiComponent;
  let fixture: ComponentFixture<DashAdmiComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [DashAdmiComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DashAdmiComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
