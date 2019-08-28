import 'desoslide/dist/css/jquery.desoslide.css';
import 'desoslide//dist/js/jquery.desoslide.min.js';

export class Gallery {
  constructor($gallery, $galleryThumbs) {
    this.$gallery = $gallery;
    this.$galleryThumbs = $galleryThumbs;
    this.init();
  }

  init() {
    this.$gallery.desoSlide({
      thumbs: this.$galleryThumbs,
      first: 0,
      interval: 2000,
      auto: {
        load: true,
        start: false
      },
      overlay: 'none',
      controls: {
        show: false,
        keys: false
      },
      thumbEvent: 'mouseover',
      first: 2,
      effect: {
        provider: 'animate',
        name: 'fade'
      }
    });
  }
}
