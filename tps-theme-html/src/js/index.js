//ReactJS
import React from 'react';
import ReactDom from 'react-dom';

class App extends React.Component {
    render() {
      return <h6>React successfully connect</h6>
    }
};
ReactDom.render(<App/>, document.getElementById('root'));

//Bootstrap
import 'bootstrap';

// jQuery plugins
import { Select } from './Select';
import { Carousel } from './Carousel';
import { Validate } from './Validate';
import { Rating } from './Rating';
import { Range } from './Range';
import { Gallery } from './Gallery';
import { Map } from './Map';

//SASS
import '../sass/style.scss';

// Font Awesome

import '@fortawesome/fontawesome-free/js/fontawesome';
import '@fortawesome/fontawesome-free/js/solid';
import '@fortawesome/fontawesome-free/js/regular';
import '@fortawesome/fontawesome-free/js/brands';

//Import background images used with inline style so that can be build ind dist/images folder
import leadSliderImgSmall from '../images/lead-slider-small-img-01.png';
import leadSliderImg from '../images/lead-slider-img-01.png';
import leadSliderImgBig from '../images/lead-slider-big-img-01.png';
import subscribeSmallImg from '../images/subscribe-bg-img-01.png';
import subscribeBgImg from '../images/subscribe-bg-img-02.png';

$(document).ready(() => {
  const hamburger = $('.hamburger');
  const mobileMenu = $('.mobile-menu');
  const mobileMenuClose = $('.mobile-menu-close');
  const mobileMenuL1Close = $('.back');
  const mobileMenuL1 = $('.mobile-menu-level-1');
  const mobileMenuNavLink = $('.mobile-menu-nav-link');
  const smallCartToggler = $('.icon-wrapper');
  const smallCart = $('.small-cart-dropdown');
  const overlay = $('.overlay-body');
  const selects = $('.js-select');
  const clearSelectBtn = $('.clear-selects');
  const slider = $('.owl-carousel');
  const filters = $('.filters');
  const filtersOpen = $('.filters-button');
  const filtersClose = $('.filters-header-close');
  const rangeSlider = $('.price-range-slider');
  const specsBtn = $('.specs-btn');
  const forms = $('.form');

  //Open mobile menu
  hamburger.click(() => {
    mobileMenu.addClass('active');
    overlay.show();
  });

  //Close mobile menu
  mobileMenuClose.click(() => {
    mobileMenu.removeClass('active');
    overlay.hide();
  });

  //Open mobile menu level 2
  mobileMenuNavLink.click(function(e) {
    $(this)
      .next()
      .addClass('active');
    e.preventDefault();
  });

  //Close mobile menu level 2
  mobileMenuL1Close.click(() => {
    mobileMenuL1.removeClass('active');
  });

  //Toggle small cart
  smallCartToggler.click(() => {
    smallCart.toggleClass('active');
  });

  //Clear select fields
  clearSelectBtn.click(e => clearSelect(e));

  // Sliders
  slider.each(function() {
    new Carousel($(this));
  });

  //Select fields
  new Select($('.select'));

  // Star rating
  document.querySelectorAll('[data-js-rating]').forEach(elem => {
    new Rating(elem, {
      onRate(value) {
        document.querySelector(`#sylius_product_review_rating_${value - 1}`).checked = true;
      }
    });
  });

  //Footer link collapse icon

  $('.collapse').each(function() {
    $(this).on('show.bs.collapse', function() {
      $(this)
        .parent()
        .find('.footer-collapse-icon')
        .css({
          transform: 'rotateX(180deg)',
          top: '30%'
        });
      $(this)
        .parent()
        .find('.filter-collapse-icon')
        .css({
          transform: 'rotateZ(360deg)',
          top: '18%'
        });
      $(this)
        .parent()
        .find('.product-collapse-icon')
        .css({
          transform: 'rotateX(180deg)',
          top: '41%'
        });
    });
  });
  $('.collapse').each(function() {
    $(this).on('hide.bs.collapse', function() {
      $(this)
        .parent()
        .find('.footer-collapse-icon')
        .css({
          transform: 'rotateX(0)',
          top: '10%'
        });
      $(this)
        .parent()
        .find('.product-collapse-icon')
        .css({
          transform: 'rotateX(0)',
          top: '15%'
        });
      $(this)
        .parent()
        .find('.filter-collapse-icon')
        .css({
          transform: 'rotateZ(270deg)',
          top: '26%'
        });
    });
  });

  //Price range slider
  rangeSlider.each(function() {
    new Range($(this));
    $(this).jRange('setValue', '0, 6000');
  });

  //Toggle filters
  filtersOpen.click(e => {
    filters.addClass('active');
    overlay.show();
  });
  filtersClose.click(() => {
    filters.removeClass('active');
    overlay.hide();
  });

  //Active class on questions
  $('.question-link')
    .filter(function() {
      return this.href == location.href;
    })
    .parent()
    .addClass('active')
    .siblings()
    .removeClass('active');
  $('.question-link').click(function() {
    $(this)
      .parent()
      .addClass('active')
      .siblings()
      .removeClass('active');
  });

  //Specs buttons toggle muted class
  specsBtn.click(function() {
    $(this)
      .siblings('a')
      .removeClass('selected')
      .end()
      .addClass('selected');
  });

  //Product gallery
  new Gallery($('#slideshow'), $('#slideshow-thumbs li > a'));

  // Init google map
  const map = document.getElementById('map');
  if (map) {
    initMap();
  }

  //Forms validation
  forms.each(function() {
    new Validate($(this));
  });

  //Functions

  //Clear select fields on main-page
  function clearSelect(e) {
    selects.each(function() {
      $(this)
        .prop('selectedIndex', 0)
        .trigger('change');
    });
    e.preventDefault();
  }

  //Google map
  function initMap() {
    let mapElement = map;
    Map.loadGoogleMapsApi().then(function(googleMaps) {
      Map.createMap(googleMaps, mapElement);
    });
  }
});
