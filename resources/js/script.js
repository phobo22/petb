// (function($) {

//   "use strict";

//   var initPreloader = function() {
//     $(document).ready(function($) {
//     var Body = $('body');
//         Body.addClass('preloader-site');
//     });
//     $(window).load(function() {
//         $('.preloader-wrapper').fadeOut();
//         $('body').removeClass('preloader-site');
//     });
//   }

//   // init Chocolat light box
// 	var initChocolat = function() {
// 		Chocolat(document.querySelectorAll('.image-link'), {
// 		  imageSize: 'contain',
// 		  loop: true,
// 		})
// 	}

//   var initSwiper = function() {

//     var swiper = new Swiper(".main-swiper", {
//       speed: 500,
//       loop: true,
//       autoplay: {
//         delay: 5000, // 2 seconds
//         disableOnInteraction: false, // keep autoplay after user swipes
//       },
//       pagination: {
//         el: ".swiper-pagination",
//         clickable: true,
//       },
//     });

//     var bestselling_swiper = new Swiper(".bestselling-swiper", {
//       slidesPerView: 4,
//       spaceBetween: 30,
//       speed: 500,
//       breakpoints: {
//         0: {
//           slidesPerView: 1,
//         },
//         768: {
//           slidesPerView: 3,
//         },
//         991: {
//           slidesPerView: 4,
//         },
//       }
//     });

//     var testimonial_swiper = new Swiper(".testimonial-swiper", {
//       slidesPerView: 1,
//       speed: 500,
//       pagination: {
//         el: ".swiper-pagination",
//         clickable: true,
//       },
//     });

//     var products_swiper = new Swiper(".products-carousel", {
//       slidesPerView: 4,
//       spaceBetween: 30,
//       speed: 500,
//       breakpoints: {
//         0: {
//           slidesPerView: 1,
//         },
//         768: {
//           slidesPerView: 3,
//         },
//         991: {
//           slidesPerView: 4,
//         },
//       }
//     });

//   }

//   var initProductQty = function(){

//     $('.product-qty').each(function(){

//       var $el_product = $(this);
//       var quantity = 0;

//       $el_product.find('.quantity-right-plus').click(function(e){
//           e.preventDefault();
//           var quantity = parseInt($el_product.find('#quantity').val());
//           $el_product.find('#quantity').val(quantity + 1);
//       });

//       $el_product.find('.quantity-left-minus').click(function(e){
//           e.preventDefault();
//           var quantity = parseInt($el_product.find('#quantity').val());
//           if(quantity>0){
//             $el_product.find('#quantity').val(quantity - 1);
//           }
//       });

//     });

//   }

//   // init jarallax parallax
//   var initJarallax = function() {
//     jarallax(document.querySelectorAll(".jarallax"));

//     jarallax(document.querySelectorAll(".jarallax-keep-img"), {
//       keepImg: true,
//     });
//   }

//   // document ready
//   $(document).ready(function() {
    
//     initPreloader();
//     initSwiper();
//     initProductQty();
//     initJarallax();
//     initChocolat();

//         // product single page
//         var thumb_slider = new Swiper(".product-thumbnail-slider", {
//           spaceBetween: 8,
//           slidesPerView: 3,
//           freeMode: true,
//           watchSlidesProgress: true,
//         });
    
//         var large_slider = new Swiper(".product-large-slider", {
//           spaceBetween: 10,
//           slidesPerView: 1,
//           effect: 'fade',
//           thumbs: {
//             swiper: thumb_slider,
//           },
//         });

//     window.addEventListener("load", (event) => {
//       //isotope
//       $('.isotope-container').isotope({
//         // options
//         itemSelector: '.item',
//         layoutMode: 'masonry'
//       });


//       var $grid = $('.entry-container').isotope({
//         itemSelector: '.entry-item',
//         layoutMode: 'masonry'
//       });


//       // Initialize Isotope
//       var $container = $('.isotope-container').isotope({
//         // options
//         itemSelector: '.item',
//         layoutMode: 'masonry'
//       });

//       $(document).ready(function () {
//         //active button
//         $('.filter-button').click(function () {
//           $('.filter-button').removeClass('active');
//           $(this).addClass('active');
//         });
//       });

//       // Filter items on button click
//       $('.filter-button').click(function () {
//         var filterValue = $(this).attr('data-filter');
//         if (filterValue === '*') {
//           // Show all items
//           $container.isotope({ filter: '*' });
//         } else {
//           // Show filtered items
//           $container.isotope({ filter: filterValue });
//         }
//       });

//     });

//   }); // End of a document

// })(jQuery);


(function($) {

  "use strict";

  var initPreloader = function() {
    $(document).ready(function($) {
      var Body = $('body');
      Body.addClass('preloader-site');
    });
    $(window).on('load', function() {
      $('.preloader-wrapper').fadeOut();
      $('body').removeClass('preloader-site');
    });
  }

  // init Chocolat light box
  var initChocolat = function() {
    Chocolat(document.querySelectorAll('.image-link'), {
      imageSize: 'contain',
      loop: true,
    })
  }

  var initSwiper = function() {

    var swiper = new Swiper(".main-swiper", {
      speed: 500,
      loop: true,
      autoplay: {
        delay: 5000, // 5 seconds
        disableOnInteraction: false, // keep autoplay after user swipes
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });

    var bestselling_swiper = new Swiper(".bestselling-swiper", {
      slidesPerView: 4,
      spaceBetween: 30,
      speed: 500,
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 3,
        },
        991: {
          slidesPerView: 4,
        },
      }
    });

    var testimonial_swiper = new Swiper(".testimonial-swiper", {
      slidesPerView: 1,
      speed: 500,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });

    // products_swiper removed - we convert .products-carousel to a Bootstrap grid instead
  }

  // Convert .products-carousel (swiper structure) to a static Bootstrap grid
  var initProductsGrid = function() {
    $('.products-carousel').each(function() {
      var $container = $(this);

      // don't run twice
      if ($container.data('grid-initialized')) return;

      // try to find swiper slides inside (fallback to direct children)
      var $slides = $container.find('.swiper-slide');
      if ($slides.length === 0) {
        // maybe already plain children
        $slides = $container.children();
      }

      // build a row and put each slide content inside a col
      var $row = $('<div class="row gx-3"></div>');

      $slides.each(function() {
        var $slide = $(this);
        var $col = $('<div class="col-6 col-md-3 mb-3"></div>'); // 4 per row on md+
        // move slide's inner content into the column (use clone to avoid losing event bindings if needed)
        // If you prefer to move rather than clone, replace .clone(true) with .contents()
        var $inner = $slide.children().clone(true, true);
        // if slide has no inner children (text nodes), clone the slide itself content
        if ($inner.length === 0) {
          $inner = $slide.clone(true, true).contents();
        }
        $col.append($inner);
        $row.append($col);
      });

      // replace container contents with the new grid
      $container.empty().addClass('products-grid').append($row);
      $container.data('grid-initialized', true);
    });
  }

  var initProductQty = function(){

    $('.product-qty').each(function(){

      var $el_product = $(this);

      $el_product.find('.quantity-right-plus').click(function(e){
        e.preventDefault();
        var quantity = parseInt($el_product.find('#quantity').val());
        $el_product.find('#quantity').val(quantity + 1);
      });

      $el_product.find('.quantity-left-minus').click(function(e){
        e.preventDefault();
        var quantity = parseInt($el_product.find('#quantity').val());
        if(quantity>0){
          $el_product.find('#quantity').val(quantity - 1);
        }
      });

    });

  }

  // init jarallax parallax
  var initJarallax = function() {
    jarallax(document.querySelectorAll(".jarallax"));

    jarallax(document.querySelectorAll(".jarallax-keep-img"), {
      keepImg: true,
    });
  }

  // document ready
  $(document).ready(function() {

    initPreloader();
    initSwiper();
    initProductQty();
    initJarallax();
    initChocolat();
    initProductsGrid(); // <-- initialize the static product grid

    // product single page
    var thumb_slider = new Swiper(".product-thumbnail-slider", {
      spaceBetween: 8,
      slidesPerView: 3,
      freeMode: true,
      watchSlidesProgress: true,
    });

    var large_slider = new Swiper(".product-large-slider", {
      spaceBetween: 10,
      slidesPerView: 1,
      effect: 'fade',
      thumbs: {
        swiper: thumb_slider,
      },
    });

    window.addEventListener("load", (event) => {
      //isotope
      $('.isotope-container').isotope({
        // options
        itemSelector: '.item',
        layoutMode: 'masonry'
      });


      var $grid = $('.entry-container').isotope({
        itemSelector: '.entry-item',
        layoutMode: 'masonry'
      });


      // Initialize Isotope
      var $container = $('.isotope-container').isotope({
        // options
        itemSelector: '.item',
        layoutMode: 'masonry'
      });

      $(document).ready(function () {
        //active button
        $('.filter-button').click(function () {
          $('.filter-button').removeClass('active');
          $(this).addClass('active');
        });
      });

      // Filter items on button click
      $('.filter-button').click(function () {
        var filterValue = $(this).attr('data-filter');
        if (filterValue === '*') {
          // Show all items
          $container.isotope({ filter: '*' });
        } else {
          // Show filtered items
          $container.isotope({ filter: filterValue });
        }
      });

    });

  }); // End of a document

})(jQuery);
