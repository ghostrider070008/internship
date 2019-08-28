import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';
import 'owl.carousel';

//Import images for navs
import arrowLeft from '../images/main-page/featured-products/fp-arrow-left.png';
import arrowRight from '../images/main-page/featured-products/fp-arrow-right.png';
import catArrowRight from '../images/categories/subcat-right.png';
import catArrowLeft from '../images/categories/subcat-left.png';

export class Carousel {
  constructor($carousel) {
    this.$carousel = $carousel;

    this.options = {
      ...this.parseUserOptions()
    };

    this.init();
  }

  parseUserOptions() {
    const slider = this.$carousel.data('type');

    const options = {};

    if (slider === 'lead-slider') {
      options.items = 1;
      options.dots = true;
      options.loop = true;
      options.autoplay = true;
    }
    if (slider === 'brands-slider') {
      options.dots = false;
      options.loop = true;
      options.autoplay = true;
      options.responsive = {
        0: {
          items: 2,
          margin: 20
        },
        400: {
          items: 3,
          margin: 20
        },
        576: {
          items: 5,
          margin: 20
        },
        768: {
          items: 7,
          margin: 20
        }
      };
    }

    if (slider === 'featured-products-slider') {
      options.dots = false;
      options.nav = true;
      options.loop = true;
      options.autoplay = true;
      options.navText = [`<img src=${arrowLeft}>`, `<img src=${arrowRight}>`];
      options.responsive = {
        0: {
          items: 1
        },
        400: {
          items: 1
        },
        576: {
          items: 2,
          margin: 30
        },
        768: {
          items: 2,
          margin: 30
        },
        992: {
          items: 3,
          margin: 30
        },
        1230: {
          items: 4,
          margin: 30
        }
      };
    }

    if (slider === 'subcategory-slider') {
      options.dots = false;
      options.nav = true;
      options.loop = true;
      options.autoplay = false;
      options.navText = [`<img src=${catArrowLeft}>`, `<img src=${catArrowRight}>`];
      options.responsive = {
        0: {
          items: 1,
          margin: 15,
          stagePadding: 5
        },
        400: {
          items: 1,
          margin: 15,
          stagePadding: 30
        },
        576: {
          items: 2,
          margin: 30,
          stagePadding: 0
        },
        768: {
          items: 2,
          margin: 30,
          stagePadding: 0
        },
        992: {
          items: 3,
          margin: 40,
          stagePadding: 0
        }
      };
    }

    if (slider === 'product-slider') {
      options.dots = true;
      options.loop = true;
      options.autoplay = true;
      options.items = 1;
    }

    return options;
  }

  init() {
    this.$carousel.owlCarousel({
      ...this.options
    });
  }
}
