import 'jquery-range/jquery.range.css';
import 'jquery-range/jquery.range';

export class Range {
  constructor($range) {
    this.$range = $range;
    this.init();
  }

  init() {
    this.$range.jRange({
      from: 0,
      to: 6000,
      width: 240,
      showLabels: false,
      isRange: true,
      theme: 'theme-blue',
      onstatechange: function(value) {
        const valArr = JSON.parse('[' + value + ']');
        const lowVal = valArr[0];
        const highVal = valArr[1];
        const lowValueInput = $('.low-value-input');
        const highValueInput = $('.high-value-input');
        $('.low-val').text(`$${lowVal}`);
        $('.high-val').text(`$${highVal}`);
        lowValueInput.val(lowVal);
        highValueInput.val(highVal);
      }
    });
  }
}
