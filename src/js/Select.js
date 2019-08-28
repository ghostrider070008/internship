import 'select2/dist/css/select2.min.css';
import 'select2';

export class Select {
  constructor($select) {
    this.$select = $select;

    this.init();
  }

  init() {
    this.$select.select2({
      minimumResultsForSearch: -1,
      width: '100%'
    });
  }
}
