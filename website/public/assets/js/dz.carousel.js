/**
	Template Name 	 : Pixio
	Author			 : Darte
	Version			 : 1.2
	File Name	     : custom.js
	Author Portfolio : https://themeforest.net/user/Darte/portfolio
	
	Core script to handle the entire theme and core functions
**/

/**
 * Returns true only when the Swiper container has enough slides
 * to support loop mode (minimum: slidesPerView * 2).
 * @param {string|Element} selector  CSS selector or DOM element
 * @param {number}         perView   Expected slidesPerView value
 */
function loopSafe(selector, perView) {
	var el = (typeof selector === 'string') ? document.querySelector(selector) : selector;
	if (!el) return false;
	var slides = el.querySelectorAll('.swiper-slide');
	var needed = Math.ceil(perView) * 2;
	return slides.length >= needed;
}

var PixioCarousel = function(){
	
	// Main Swiper1 ====
	var handleMainSwiper = function () {
		jQuery(document).ready(function($) {
			if ($('.main-swiper').length > 0) {
				// Main Swiper
				var mainSwiper = new Swiper(".main-swiper", {
					slidesPerView: 1,
					spaceBetween: 10,
					loop: loopSafe('.main-swiper', 1),
					autoplay: {
					   delay: 3500,
                       disableOnInteraction: false,
					},
					pagination: {
						el: ".swiper-pagination",
						clickable: true,
						renderBullet: function (index, className) {
							return '<span class="' + className + '">' + 0 + (index + 1) + "</span>";
						},
					},
					navigation: {
						nextEl: ".swiper-button-next",
						prevEl: ".swiper-button-prev",
					},					
				});
				
				// Thumbnail Swiper
				var thumbnailSwiper = new Swiper(".main-swiper-thumb", {
					slidesPerView: 1.4,
					spaceBetween: 100,
					loop: loopSafe('.main-swiper-thumb', 1.4),
					autoplay: {
					   delay: 3500,
                       disableOnInteraction: false,
					},
					breakpoints: {
						0: { slidesPerView: 1, spaceBetween: 30,  },
						600: { slidesPerView: 1.2, spaceBetween: 30,  },
						767: { slidesPerView: 1.2, spaceBetween: 50,  },
						991: { slidesPerView: 1.2, spaceBetween: 50,  },
						1024: { slidesPerView: 1.2, spaceBetween: 50, },
						1200: { slidesPerView: 1.3, spaceBetween: 50, },
						1400: { slidesPerView: 1.2, spaceBetween: 100, },
						1680: { slidesPerView: 1.4, spaceBetween: 100,},
					},
					navigation: {
						nextEl: ".swiper-button-next",
						prevEl: ".swiper-button-prev",
					},
				});
				// Connect the two swipers
				mainSwiper.controller.control = thumbnailSwiper;
				thumbnailSwiper.controller.control = mainSwiper;
			}
		});
	}
	
	// Main Swiper2====
	var handleMainSwiper2 = function() {
		if(jQuery('.main-swiper2').length > 0){
			var swiper = new Swiper(".main-swiper-thumb", {
				loop: loopSafe('.main-swiper-thumb', 1),
				spaceBetween: 10,
				//slidesPerView: "auto",
				freeMode: true,
				watchSlidesProgress: true,
				autoplay: {
					delay: 1500,
				},
			});
			var swiper2 = new Swiper(".main-swiper", {
				loop: loopSafe('.main-swiper', 1),
				effect: "fade",
				speed: 1000,
				parallax: true,
				autoplay: {
					delay: 1500,
				},
				pagination: {
					el: ".swiper-pagination-five",
					clickable: true,
					renderBullet: function (index, className) {
						return '<span class="' + className + '">' + 0 + (index + 1) + "</span>";
					},
				},
				navigation: {
					nextEl: ".swiper-button-next",
					prevEl: ".swiper-button-prev",
				},
			});
		}
	}

	// kanbern Swiper ==
	var handlekanbernSwiper = function() {	
		if(jQuery('.kanbern-bnr').length > 0){
			var swiperTestimonial = new Swiper('.kanbern-bnr', {
				loop: loopSafe('.kanbern-bnr', 1),
				spaceBetween: 10,
				slidesPerView: "auto",
				effect: "fade",
				parallax: true,
				speed: 1500,
				autoplay: {
				   delay: 2000,
				},
			});
		}
	}
	
	// Blog slideshow Swiper ==
	var BlogSlideshowSwiper = function() {	
		if(jQuery('.blog-slideshow').length > 0){
			var swiperTestimonial = new Swiper('.blog-slideshow', {
				loop: loopSafe('.blog-slideshow', 1),
				spaceBetween: 0,
				slidesPerView: "auto",
				speed: 1500,
				//autoplay: {
				//   delay: 2000,
				//},
				pagination: {
				  el: ".swiper-pagination-two",
				  clickable: true,
				},
			});
		}
	}
	
	// Project Carousel Swiper ==
	var handleProjectCarousel = function() {	
		if(jQuery('.project-carousel').length > 0){
			var swiperBook = new Swiper('.project-carousel', {
				loop: loopSafe('.project-carousel', 1.5),
				centeredSlides: true,
				spaceBetween:30,
				slidesPerView: 1.5,
				autoplay: {
					delay: 4000,
				},
				navigation: {
					nextEl: ".portfolio-button-next",
					prevEl: ".portfolio-button-prev",
				},
				breakpoints: {
					0: {
						slidesPerView: 1,
					},
					600: {
						slidesPerView: 1,
					},
					767: {
						slidesPerView: 2,
					},
					991: {
						slidesPerView: 1.5,
					},
					1600: {
						slidesPerView:1.5,
					},
				}
			});
		}	
	}
	
	// Swiper Four ==
	var handleSwiperFour = function() {	
		if(jQuery('.swiper-four').length > 0){
			var swiper = new Swiper( '.swiper-four', {
				speed: 1000,
				loop: loopSafe('.swiper-four', 4),
				parallax: true,
				slidesPerView: 4,
				spaceBetween: 30,
				autoplay: {
					delay: 2500,
				},
				navigation: {
					nextEl: ".tranding-button-next",
					prevEl: ".tranding-button-prev",
				},	
				breakpoints: {
					1200: {
						slidesPerView: 4,
					},
					1024: {
						slidesPerView: 4,
					},
					991: {
						slidesPerView: 3,
					},
					591: {
						slidesPerView: 2,
						spaceBetween: 20,
					},
					0: {
						slidesPerView: 1,
						spaceBetween: 15,
					},
				}
			});
		}
	}
	
	//  Swiper Five ==
	var handleSwiperFive = function() {	
		if(jQuery('.swiper-five').length > 0){
			var swiper = new Swiper( '.swiper-five', {
				slidesPerView: 1,
				spaceBetween: 20,
				loop: loopSafe('.swiper-five', 1),
				pagination: {
				  el: ".swiper-pagination-two",
				  clickable: true,
				},
				navigation: {
				  nextEl: ".about-button-next",
				  prevEl: ".about-button-prev",
				},
				breakpoints: {
					1600: {
						slidesPerView: 1,
					},
				}
			} );
		}
	}
	
	// Swiper Six ==
	var handleSwiperSix = function() {	
		if(jQuery('.swiper-six').length > 0){
			var swiper = new Swiper( '.swiper-six', {
				slidesPerView: 2,
				spaceBetween: 30,
				loop: loopSafe('.swiper-six', 2),
				autoplay: {
					delay: 2500,
				},
				breakpoints: {
					591: {
						slidesPerView: 2,
					},
					0: {
						slidesPerView: 2,
						spaceBetween: 15,
					},
				}
			});
		}
	}

	//  Swiper Blog Post ==
	var handleSwiperBlogPost = function() {	
		if(jQuery('.swiper-blog-post').length > 0){
			var swiper = new Swiper( '.swiper-blog-post', {
				slidesPerView: 4.5,
				spaceBetween: 30,
				loop: loopSafe('.swiper-blog-post', 4.5),
				speed: 1000,
				pagination: {
					el: ".swiper-pagination-trading",
				},
				
				breakpoints: {
					1600: {
						slidesPerView: 4.5,
					},
					1400: {
						slidesPerView: 3.5,
					},
					1024: {
						slidesPerView: 2.5,
					},
					991: {
						slidesPerView: 2,
					},
					767: {
						slidesPerView: 1.5,
						spaceBetween: 15,
						centeredSlides: true,
					},
					575: {
						slidesPerView: 1.5,
						spaceBetween: 15,
						centeredSlides: true,
					},
					0: {
						slidesPerView: 1.2,
						spaceBetween: 15,
					},
					
				}
			});
		}
	}
	
	//  handle Category Swiper ==
	var handleCategorySwiper = function() {	
		if(jQuery('.category-swiper').length > 0){
			var swiper = new Swiper( '.category-swiper', {
				slidesPerView: 7,
				centeredSlides: false,
				spaceBetween: 20,
				loop: loopSafe('.category-swiper', 7),
					pagination: {
					el: ".swiper-pagination-two",
				},
				autoplay: {
					delay: 3000,
				},
				navigation: {
					nextEl: ".tranding-button-next", 
					prevEl: ".tranding-button-prev",
				},	
				breakpoints: {
					1600: {
						slidesPerView: 7,
					},
					1200: {
						slidesPerView: 5,
					},
					991: {
						slidesPerView: 4,
					},
					591: {
						slidesPerView: 3, 	
					},
					320: {
						slidesPerView: 2,
						spaceBetween: 15,
					},
				}
			});
		}
	}
	
	//  handle Category Swiper2 ==
	var handleCategorySwiper2 = function() {	
		if(jQuery('.category-swiper2').length > 0){
			var swiper = new Swiper( '.category-swiper2', {
				slidesPerView: 6,
				centeredSlides: false,
				spaceBetween: 20,
				loop: loopSafe('.category-swiper2', 6),
				/* pagination: {
					el: ".swiper-pagination-two",
				}, */
				autoplay: {
					delay: 3000,
				},
				navigation: {
					nextEl: ".tranding-button-next", 
					prevEl: ".tranding-button-prev",
				},	
				breakpoints: {
					1600: {
						slidesPerView: 6,
						spaceBetween: 40,
					},
					1200: {
						slidesPerView: 6,
						spaceBetween: 20,
					},
					991: {
						slidesPerView: 4,
						spaceBetween: 20,
					},
					575: {
						slidesPerView: 3, 	
						spaceBetween: 15,
					},
					320: {
						slidesPerView: 2,
						spaceBetween: 15,
					},
				}
			});
		}
	}
	
	//  Product Swiper ==
	var handleSwiperProduct = function() {	
		if(jQuery('.swiper-product').length > 0){
			var swiper = new Swiper( '.swiper-product', {
				speed: 1000,
				loop: loopSafe('.swiper-product', 3),
				parallax: true,
				slidesPerView: 3,
				spaceBetween: 15,
				pagination: {
					el: ".swiper-pagination-trading",
				},
				breakpoints: {
					1400: {
						slidesPerView: 3,
					},
					1024: {
						slidesPerView: 2,
					},
					991: {
						slidesPerView: 2,
					},
					767: {
						slidesPerView: 1.5,
					},
					600: {
						slidesPerView: 1,
					},
					575: {
						slidesPerView: 1,
					},
					0: {
						slidesPerView: 1,
						centeredSlides: true,
					},
				}
			});
		}
	}

		//  Product Swiper ==
		var handleSwiperProduct2 = function() {	
			if(jQuery('.swiper-product2').length > 0){
				var swiper = new Swiper( '.swiper-product2', {
					speed: 1000,
					loop: loopSafe('.swiper-product2', 3),
					parallax: true,
					slidesPerView: 3,
					spaceBetween: 30,
					pagination: {
						el: ".swiper-pagination-trading",
					},
					autoplay: {
						delay: 2500,
					},
					breakpoints: {
						1400: {
							slidesPerView: 3,
						},
						1024: {
							slidesPerView: 2,
						},
						991: {
							slidesPerView: 2,
						},
						767: {
							slidesPerView: 1.5,
						},
						600: {
							slidesPerView: 1,
						},
						575: {
							slidesPerView: 1,
						},
						0: {
							slidesPerView: 1,
							centeredSlides: true,
						},
					}
				});
			}
		}
	
	//  shop Swiper ==
	var handleSwiperShop = function() {	
		if(jQuery('.swiper-shop').length > 0){
			var swiper = new Swiper( '.swiper-shop', {
				slidesPerView: 5,
				spaceBetween: 15,
				loop: loopSafe('.swiper-shop', 5),
				pagination: {
					el: ".swiper-pagination-trading",
				},
				
				navigation: {
					nextEl: ".shop-button-next",
					prevEl: ".shop-button-prev",
				},
				breakpoints: {
					1600: {
						slidesPerView: 5,
					},
					1400: {
						slidesPerView: 4,
					},
					991: {
						slidesPerView: 3,
					},
					767: {
						slidesPerView: 3,
					},
					575: {
						slidesPerView: 2,
					},
					0: {
						slidesPerView: 2,
					},
				}
			});
		}
	}

	// Swiper Four ==
	var handleSwiperShop2 = function() {	
		if(jQuery('.swiper-shop2').length > 0){
			var swiper = new Swiper( '.swiper-shop2', {
				speed: 1000,
				loop: loopSafe('.swiper-shop2', 4),
				parallax: true,
				slidesPerView: 4,
				spaceBetween: 30,
				autoplay: {
					delay: 2500,
				},
				pagination: {
					el: ".swiper-pagination-trading",
				},
				
				navigation: {
					nextEl: ".shop-button-next",
					prevEl: ".shop-button-prev",
				},	
				breakpoints: {
					1600: {
						slidesPerView: 4,
					},
					1440: {
						slidesPerView: 3,
					},
					10: {
						slidesPerView: 5,
					},
					991: {
						slidesPerView: 4,
					},
					767: {
						slidesPerView: 2,
					},
					575: {
						slidesPerView: 2,
					},
					0: {
						slidesPerView: 1,
						centeredSlides: true,
					},
				}
			});
		}
	}
	
	
	//  company Swiper ==
	var handleSwiperCompany = function() {	
		if(jQuery('.swiper-company').length > 0){
			var swiper = new Swiper( '.swiper-company', {
				slidesPerView: 4,
				spaceBetween: 30,
				loop: loopSafe('.swiper-company', 4),
				pagination: {
					el: ".swiper-pagination-trading",
				},
				breakpoints: {
					1200: {
						slidesPerView: 4,
					},
					991: {
						slidesPerView: 3,
					},
					767: {
						slidesPerView: 2,
					},
					575: {
						slidesPerView: 1.5,
					},
					0: {
						slidesPerView: 1,
						centeredSlides: true,
					},
				}
			});
		}
	}
	
	
	
	//  Product Gallery Swiper1 ==
	var ProductGallerySwiper1 = function() {	
		if(jQuery('.product-gallery-swiper').length > 0){
			var swiper = new Swiper(".product-gallery-swiper", {
				spaceBetween: 10,
				slidesPerView: 2,
				//freeMode: true,
				//watchSlidesProgress: true,
				pagination: {
					el: ".swiper-pagination-trading",
				},
			});
			var swiper2 = new Swiper(".product-gallery-swiper2", {
			  spaceBetween: 0,
			  updateOnWindowResize: true,	
			  navigation: {
				nextEl: ".gallery-button-next",
				prevEl: ".gallery-button-prev",
			  },
			  thumbs: {
				swiper: swiper,
			  },
			});
		}
	}
	

	
	//  Product Gallery Swiper ==
	var handleProductGallery = function() {	
		if(jQuery('.product-gallery').length > 0){
			var swiper = new Swiper(".product-thumb", {
				slidesPerView: "2",
				spaceBetween: 0,
				
				grid: {
					rows: 2,
				},
				pagination: {
					el: ".product-swiper-pagination",
					clickable: true,
					renderBullet: function (index, className) {
					  return '<span class="' + className + '">0' + (index + 1) + "</span>";
					},
				},
				breakpoints: {
					
					576: {
						slidesPerView: 2,
					},
					0: {
						slidesPerView: 1,
					},
				}
			});
			var swiper2 = new Swiper(".product-gallery", {
				slidesPerView: "1",
				
				thumbs: {
				  swiper: swiper,
				},
			});
		}
	}
	
	//  Portfolio Gallery Swiper1 ==
	var handlePortfolioGallery = function() {	
		if(jQuery('.portfolio-gallery').length > 0){
			var swiper = new Swiper(".portfolio-thumb", {
				slidesPerView: "auto",
				spaceBetween: 0,
				
			});
			var swiper2 = new Swiper(".portfolio-gallery", {
				slidesPerView: "1",
				
				thumbs: {
				  swiper: swiper,
				},
			});
		}
	}
	
	//  Portfolio Gallery Swiper2 ==
	var handlePortfolioGallery2 = function() {	
		if(jQuery('.portfolio-gallery2').length > 0){
			var swiper = new Swiper( '.portfolio-gallery2', {
				slidesPerView: "auto",
				spaceBetween: 30,
				loop: loopSafe('.portfolio-gallery2', 2),
				autoplay: {
					delay: 2500,
				},
				pagination: {
					el: ".swiper-pagination-two",
				},
				navigation: {
					nextEl: ".portfolio-button-next",
					prevEl: ".portfolio-button-prev",
				},
				breakpoints: {
					1200: {
						slidesPerView: "auto",
					},
					576: {
						slidesPerView: "auto",
					},
					0: {
						slidesPerView: 1,
					},
				}
			} ); 
		}
	}
	
	//  Portfolio Gallery Swiper3 ==
	var handlePortfolioGallery3 = function() {	
		if(jQuery('.portfolio-gallery3').length > 0){
			var swiper = new Swiper( '.portfolio-gallery3', {
				slidesPerView: 3,
				spaceBetween: 30,
				loop: loopSafe('.portfolio-gallery3', 3),
				autoplay: {
					delay: 2500,
				},
				pagination: {
					el: ".swiper-pagination-two",
				},
				navigation: {
					nextEl: ".portfolio-button-next",
					prevEl: ".portfolio-button-prev",
				},
				breakpoints: {
					1200: {
						slidesPerView: 3,
					},
					768: {
						slidesPerView: 2,
					},
					600: {
						slidesPerView: 2,
						spaceBetween: 15,
					},
					0: {
						slidesPerView: 1,
						spaceBetween: 15,
					},
				}
			} ); 
		}
	}
	
	//  Portfolio Detail Swiper ==
	var handlePortfolioDetail3 = function() {	
		if(jQuery('.portfolio-detail3').length > 0){
			var swiper = new Swiper( '.portfolio-detail3', {
				slidesPerView: 4,
				spaceBetween: 30,
				loop: loopSafe('.portfolio-detail3', 4),
				autoplay: {
					delay: 2500,
				},
				breakpoints: {
					1200: {
						slidesPerView: 4,
					},
					768: {
						slidesPerView: 3,
					},
					600: {
						slidesPerView: 2,
						spaceBetween: 15,
					},
					0: {
						slidesPerView: 1,
						spaceBetween: 15,
					},
				}
			} ); 
		}
	}
	
	// Split Swiper ==
	var handleSplitSwiper = function() {	
		if(jQuery('.spilt-swiper-slider').length > 0){
			var spiltSwiper = new Swiper('.spilt-swiper-slider', {
				direction: "vertical",
				loop: loopSafe('.spilt-swiper-slider', 1),
				slidesPerView: 1,
				mousewheel: true,
				paginationClickable: true,
				pagination: {
					el: ".swiper-pagination-two",
				},
				grabCursor: true,
				parallax: true,
				speed: 1000,
				effect: "slide",
				mousewheelControl: 1,
			});
		}
	}

	// Collections Swiper ==
	var handleCollectionsSwiper = function() {
		if (jQuery('.about-main-swiper').length) {
			var aboutMainSwiper = new Swiper('.about-main-swiper', {
				speed: 1500,
				parallax: true,
				slidesPerView: 1,
				loop: loopSafe('.about-main-swiper', 1),
			});
		}

		if (jQuery('.testimonial-swiper').length) {
			var testimonialSwiper = new Swiper('.testimonial-swiper', {
				speed: 6000,
				loop: true,
				freeMode: true,
				freeModeMomentum: false,
				autoplay: {
					delay: 0,
					disableOnInteraction: false,
					pauseOnMouseEnter: true,
				},
				slidesPerView: 3.5,
				spaceBetween: 24,
				breakpoints: {
					1600: {
						slidesPerView: 3.5,
					},
					1200: {
						slidesPerView: 3.2,
					},
					1024: {
						slidesPerView: 2.8,
					},
					768: {
						slidesPerView: 2.2,
					},
					0: {
						slidesPerView: 1.5,
						spaceBetween: 16,
					},
				},
			});
		}
	}
	




	// Category grouped slider (home page) ==
	var handleCatSlider = function() {
		if (jQuery('.home-cat-slider').length > 0) {
			new Swiper('.home-cat-slider', {
				slidesPerView: 1,
				loop: loopSafe('.home-cat-slider', 1),
				speed: 800,
				autoplay: {
					delay: 4000,
					disableOnInteraction: false,
				},
			});
		}
	}

	// Instagram Carousel ==
	var handleInstaCarousel = function() {
		if (jQuery('.swiper-insta').length > 0) {
			var swiperInsta = new Swiper('.swiper-insta', {
				slidesPerView: 2,
				spaceBetween: 0,
				loop: loopSafe('.swiper-insta', 2),
				speed: 10000,
				freeMode: true,
				autoplay: {
					delay: 0,
					disableOnInteraction: false,
				},
				breakpoints: {
					575: {
						slidesPerView: 2,
					},
					767: {
						slidesPerView: 3,
					},
					991: {
						slidesPerView: 4,
					},
					1200: {
						slidesPerView: 5,
					},
					1600: {
						slidesPerView: 6,
					},
				}
			});
		}
	}

	/* Function ============ */
	return {
	
		init:function(){
			handleMainSwiper();
		},

		load:function(){
			handleMainSwiper();
			handleCollectionsSwiper();
			handleMainSwiper2();
			handlekanbernSwiper();
			BlogSlideshowSwiper();
			handleProjectCarousel();
			handleSwiperFour();
			handleSwiperFive();
			handleSwiperSix();
			handleSwiperBlogPost();
			handleCategorySwiper();
			handleCategorySwiper2();
			handleSwiperProduct();
			handleSwiperProduct2();
			handleSwiperCompany();
			ProductGallerySwiper1();
			handleProductGallery();
			handlePortfolioGallery();
			handlePortfolioGallery2();
			handlePortfolioGallery3();
			handlePortfolioDetail3();
			handleSplitSwiper();

			handleSwiperShop();
			handleSwiperShop2();
			handleCatSlider();
			handleInstaCarousel();
		},
		
		resize:function(){
			ProductGallerySwiper1();
		}
	}
	
}();


/* Document.ready Start */	
jQuery(document).ready(function() {
    'use strict';
	
	PixioCarousel.init();
	
	
});
/* Document.ready END */

/* Window Load START */
jQuery(window).on('load',function () {
	'use strict'; 
	PixioCarousel.load();

	
});
/*  Window Load END */

/* Window Resize START */
jQuery(window).on('resize',function () {
	'use strict'; 
	PixioCarousel.resize();
});
/*  Window Resize END */
