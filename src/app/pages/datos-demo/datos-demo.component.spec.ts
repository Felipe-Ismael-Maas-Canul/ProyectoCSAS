import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DatosDemoComponent } from './datos-demo.component';

describe('DatosDemoComponent', () => {
  let component: DatosDemoComponent;
  let fixture: ComponentFixture<DatosDemoComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [DatosDemoComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DatosDemoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
