/**
	Template Name 	 : Pixio
	Author			 : Darte
	Version			 : 1.2
	File Name	     : custom.js
	Author Portfolio : https://themeforest.net/user/Darte/portfolio

	Core script to handle the entire theme and core functions
**/

var Pixio = function () {
	'use strict';

	var screenWidth = $(window).width();

	/* Cookies Function */
	function setCookie(cname, cvalue, exhours) {
		var d = new Date();
		d.setTime(d.getTime() + (exhours * 60 * 60 * 1000));
		var expires = "expires=" + d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	function getCookie(cname) {
		var name = cname + "=";
		var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}

	function deleteCookie(cname) {
		var d = new Date();
		d.setTime(d.getTime() + (1)); // 1/1000 second
		var expires = "expires=" + d.toString();
		document.cookie = cname + "=1;" + expires + ";path=/";
	}
	/* Cookies Function END */

	var homeSearch = function () {
		/* top search in header on click function */
		var quikSearch = jQuery("#quik-search-btn");
		var quikSearchRemove = jQuery("#quik-search-remove");

		quikSearch.on('click', function () {
			jQuery('.dz-quik-search').fadeIn(500);
			jQuery('.dz-quik-search').addClass('On');
		});

		quikSearchRemove.on('click', function () {
			jQuery('.dz-quik-search').fadeOut(500);
			jQuery('.dz-quik-search').removeClass('On');
		});
		/* top search in header on click function End*/
	}

	/* WOW ANIMATION ============ */
	var wow_animation = function () {
		if ($('.wow').length > 0) {
			var wow = new WOW(
				{
					boxClass: 'wow',      // animated element css class (default is wow)
					animateClass: 'animated', // animation css class (default is animated)
					offset: 50,          // distance to the element when triggering the animation (default is 0)
					mobile: false       // trigger animations on mobile devices (true is default)
				});

			setTimeout(function () {
				wow.init();
			}, 150);
		}
	}

	/* One Page Layout ============ */
	var onePageLayout = function () {
		var headerHeight = parseInt($('.onepage').css('height'), 10);

		$(".scroll").unbind().on('click', function (event) {
			event.preventDefault();

			if (this.hash !== "") {
				var hash = this.hash;
				var seactionPosition = $(hash).offset().top;
				var headerHeight = parseInt($('.onepage').css('height'), 10);


				$('body').scrollspy({ target: ".navbar", offset: headerHeight + 2 });

				var scrollTopPosition = seactionPosition - (headerHeight);

				$('html, body').animate({
					scrollTop: scrollTopPosition
				}, 800, function () {

				});
			}
		});
		$('body').scrollspy({ target: ".navbar", offset: headerHeight + 2 });
	}

	/* Header Height ============ */
	var handleResizeElement = function () {
		var headerTop = 0;
		var headerNav = 0;

		$('.header .sticky-header').removeClass('is-fixed');
		$('.header').removeAttr('style');

		if (jQuery('.header .top-bar').length > 0 && screenWidth > 991) {
			headerTop = parseInt($('.header .top-bar').outerHeight());
		}

		if (jQuery('.header').length > 0) {
			headerNav = parseInt($('.header').height());
			headerNav = (headerNav == 0) ? parseInt($('.header .main-bar').outerHeight()) : headerNav;
		}

		var headerHeight = headerNav + headerTop;

		jQuery('.header').css('height', headerHeight);
	}

	var handleResizeElementOnResize = function () {
		var headerTop = 0;
		var headerNav = 0;

		$('.header .sticky-header').removeClass('is-fixed');
		$('.header').removeAttr('style');

		setTimeout(function () {
			if (jQuery('.header .top-bar').length > 0 && screenWidth > 991) {
				headerTop = parseInt($('.header .top-bar').outerHeight());
			}
			if (jQuery('.header').length > 0) {
				headerNav = parseInt($('.header').height());
				headerNav = (headerNav == 0) ? parseInt($('.header .main-bar').outerHeight()) : headerNav;
			}

			var headerHeight = headerNav + headerTop;
			jQuery('.header').css('height', headerHeight);
		}, 500);
	}

	/* Load File ============ */
	var dzTheme = function () {
		if (screenWidth <= 991) {
			var menuObj;
			jQuery('.navbar-nav > li > a, .sub-menu > li > a, .navbar-nav > li > a > i, .sub-menu > li > a > i')
				.unbind()
				.on({
					click: function (e) {
						menuObj = jQuery(this);
						handleMenus(e, menuObj);
					},
					keypress: function (e) {
						if (e.key !== 'Enter') {
							return false;
						}
						menuObj = jQuery(this);
						handleMenus(e, menuObj);
					},
				});
			jQuery('.tabindex').attr("tabindex", "0");

			function handleMenus(e, menuObj) {
				if (menuObj.parent('li').has('ul').length > 0) {
					e.preventDefault();
				}
				if (menuObj.parent().hasClass('open')) {
					menuObj.parent().removeClass('open');
				} else {
					if (menuObj.hasClass('sub-menu')) {
						menuObj.parent().addClass('open');
					} else {
						menuObj.parent().parent().find('li').removeClass('open');
						menuObj.parent().addClass('open');
					}
				}
			}
		} else {
			jQuery('.tabindex').removeAttr("tabindex");
		}

		jQuery('.menu-btn, .openbtn').on('click', function () {
			jQuery('.contact-sidebar').addClass('active');
		});
		jQuery('.menu-close').on('click', function () {
			jQuery('.contact-sidebar').removeClass('active');
			jQuery('.menu-btn').removeClass('open');
		});

		jQuery(document).on('click', '.dz-wishicon', function (e) {
			const $this = jQuery(this);
			const productId = $this.data('product-id');
			const variantId = $this.data('variant-id');

			if (typeof checkUserAuth === 'function' && !checkUserAuth()) {
				e.preventDefault();
				return false; // Stop if not authenticated
			}

			if (!productId) return;

			// Perform AJAX to add to wishlist
			fetch('/wishlist/add', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
				},
				body: JSON.stringify({ 
					product_id: productId,
					product_varient_id: variantId
				})
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
                    $this.toggleClass('active');
					Swal.fire({
						title: 'Success!',
						text: data.message,
						icon: 'success',
						timer: 1500,
						showConfirmButton: false
					}).then(() => {
						location.reload();
					});
				} else {
					Swal.fire({
						title: 'Error!',
						text: data.message || 'Failed to add to wishlist.',
						icon: 'error'
					});
				}
			})
			.catch(error => {
				console.error('Error:', error);
				Swal.fire({
					title: 'Error!',
					text: 'Something went wrong.',
					icon: 'error'
				});
			});
		});

		jQuery(document).on('click', '.dz-carticon', function (e) {
            // If the element has an onclick attribute (like we added in blade), let that handle it.
            // Otherwise, we can add a fallback here if needed.
			if (this.hasAttribute('onclick')) return;
            
			if (typeof checkUserAuth === 'function' && !checkUserAuth()) {
				e.preventDefault();
				return false;
			}
			jQuery(this).toggleClass('active');
		});
	}

	//lightGallery
	var handleLightgallery = function () {
		if (jQuery('#lightgallery').length > 0) {
			lightGallery(document.getElementById('lightgallery'), {
				plugins: [lgThumbnail, lgZoom],
				selector: '.lg-item',
				thumbnail: true,
				exThumbImage: 'data-src'
			});
		}
		if (jQuery('#lightgallery2').length > 0) {
			lightGallery(document.getElementById('lightgallery2'), {
				plugins: [lgThumbnail, lgZoom],
				selector: '.lg-item',
				thumbnail: true,
				exThumbImage: 'data-src'
			});
		}
		if (jQuery('#lightgallery3').length > 0) {
			lightGallery(document.getElementById('lightgallery3'), {
				plugins: [lgThumbnail, lgZoom],
				selector: '.lg-item',
				thumbnail: true,
				exThumbImage: 'data-src'
			});
		}
		if (jQuery('#lightgallery4').length > 0) {
			lightGallery(document.getElementById('lightgallery4'), {
				plugins: [lgThumbnail, lgZoom],
				selector: '.lg-item',
				thumbnail: true,
				exThumbImage: 'data-src'
			});
		}
		if (jQuery('#lightgallery5').length > 0) {
			lightGallery(document.getElementById('lightgallery5'), {
				plugins: [lgThumbnail, lgZoom],
				selector: '.lg-item',
				thumbnail: true,
				exThumbImage: 'data-src'
			});
		}
	}

	/* Magnific Popup ============ */
	var MagnificPopup = function () {
		if (jQuery('.mfp-gallery').length > 0) {
			/* magnificPopup function */
			jQuery('.mfp-gallery').magnificPopup({
				delegate: '.mfp-link',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				mainClass: 'mfp-img-mobile',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function (item) {
						return item.el.attr('title') + '<small></small>';
					}
				}
			});
			/* magnificPopup function end */
		}

		if (jQuery('.mfp-video').length > 0) {
			/* magnificPopup for Play video function */
			jQuery('.mfp-video').magnificPopup({
				type: 'iframe',
				iframe: {
					markup: '<div class="mfp-iframe-scaler">' +
						'<div class="mfp-close"></div>' +
						'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
						'<div class="mfp-title">Some caption</div>' +
						'</div>'
				},
				callbacks: {
					markupParse: function (template, values, item) {
						values.title = item.el.attr('title');
					}
				}
			});

		}

		if (jQuery('.popup-youtube, .popup-vimeo, .popup-gmaps').length > 0) {
			/* magnificPopup for Play video function end */
			$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,
				fixedContentPos: true
			});
		}
	}

	/* Scroll To Top ============ */
	var scrollTop = function () {
		var scrollTop = jQuery("button.scroltop");
		/* page scroll top on click function */
		scrollTop.on('click', function () {
			jQuery("html, body").animate({
				scrollTop: 0
			}, 1000);
			return false;
		})

		jQuery(window).bind("scroll", function () {
			var scroll = jQuery(window).scrollTop();
			if (scroll > 900) {
				jQuery("button.scroltop").fadeIn(1000);
			} else {
				jQuery("button.scroltop").fadeOut(1000);
			}
		});
		/* page scroll top on click function end*/
	}

	/* Header Fixed ============ */
	var headerFix = function () {
		/* Main navigation fixed on top  when scroll down function custom */
		jQuery(window).on('scroll', function () {
			if (jQuery('.sticky-header').length > 0) {
				var menu = jQuery('.sticky-header');
				if ($(window).scrollTop() > menu.offset().top) {
					menu.addClass('is-fixed');
				} else {
					menu.removeClass('is-fixed');
				}
			}
		});
		/* Main navigation fixed on top  when scroll down function custom end*/
	}

	/* Masonry Box ============ */
	var masonryBox = function () {
		/* masonry by  = bootstrap-select.min.js */
		if (jQuery('#masonry, .masonry').length > 0) {
			jQuery('.filters li').removeClass('active');
			jQuery('.filters li:first').addClass('active');
			var self = jQuery("#masonry, .masonry");
			var filterValue = "";

			if (jQuery('.card-container').length > 0) {
				var gutterEnable = self.data('gutter');

				var gutter = (self.data('gutter') === undefined) ? 0 : self.data('gutter');
				gutter = parseInt(gutter);


				var columnWidthValue = (self.attr('data-column-width') === undefined) ? '' : self.attr('data-column-width');
				if (columnWidthValue != '') { columnWidthValue = parseInt(columnWidthValue); }

				self.imagesLoaded(function () {
					filter: filterValue,
						self.masonry({
							gutter: gutter,
							columnWidth: columnWidthValue,
							//columnWidth:3,
							//gutterWidth: 15,
							isAnimated: true,
							itemSelector: ".card-container",
							//gutterWidth: 15,
							//horizontalOrder: true,
							//fitWidth: true,
							//stagger: 30
							//containerStyle: null
							//percentPosition: true
						});

				});
			}
		}

		if (jQuery('.filters').length > 0) {

			jQuery(".filters li:first").addClass('active');

			jQuery(".filters li").on('click', function () {

				jQuery('.filters li').removeClass('active');
				jQuery(this).addClass('active');

				var filterValue = $(this).attr("data-filter");

				self.isotope({
					filter: filterValue,
				});
			});
		}
		/* masonry by  = bootstrap-select.min.js end */
	}

	var handleIsotope = function () {
		/* masonry by  = bootstrap-select.min.js */
		if (jQuery('#Isotope, .isotope').length > 0) {
			var self = jQuery('#Isotope, .isotope');
			self.isotope({
				itemSelector: '.card-container',
				layoutMode: 'fitRows',
			})
		}

		if (jQuery('.filter-isotope').length > 0) {
			jQuery(".filter-isotope li:first").addClass('active');
			jQuery(".filter-isotope li").on('click', function () {

				jQuery('.filter-isotope li').removeClass('active');
				jQuery(this).addClass('active');

				var filterValue = $(this).attr("data-filter");

				self.isotope({
					filter: filterValue,
				});
			});
		}
		/* masonry by  = bootstrap-select.min.js end */
	}

	/* Counter Number ============ */
	var counter = function () {
		if (jQuery('.counter').length) {
			jQuery('.counter').counterUp({
				delay: 10,
				time: 3000
			});
		}
	}

	/* Video Popup ============ */
	var handleVideo = function () {
		/* Video responsive function */
		jQuery('iframe[src*="youtube.com"]').wrap('<div class="embed-responsive embed-responsive-16by9"></div>');
		jQuery('iframe[src*="vimeo.com"]').wrap('<div class="embed-responsive embed-responsive-16by9"></div>');
		/* Video responsive function end */
	}

	/* Gallery Filter ============ */
	var handleFilterMasonary = function () {
		/* gallery filter activation = jquery.mixitup.min.js */
		if (jQuery('#image-gallery-mix').length) {
			jQuery('.gallery-filter').find('li').each(function () {
				$(this).addClass('filter');
			});
			jQuery('#image-gallery-mix').mixItUp();
		};
		if (jQuery('.gallery-filter.masonary').length) {
			jQuery('.gallery-filter.masonary').on('click', 'span', function () {
				var selector = $(this).parent().attr('data-filter');
				jQuery('.gallery-filter.masonary span').parent().removeClass('active');
				jQuery(this).parent().addClass('active');
				jQuery('#image-gallery-isotope').isotope({ filter: selector });
				return false;
			});
		}
		/* gallery filter activation = jquery.mixitup.min.js */
	}

	/* Resizebanner ============ */
	var handleBannerResize = function () {
		$(".full-height").css("height", $(window).height());
	}

	/* BGEFFECT ============ */
	var reposition = function () {
		var modal = jQuery(this),

			dialog = modal.find('.modal-dialog');
		modal.css('display', 'block');

		/* Dividing by two centers the modal exactly, but dividing by three  or four works better for larger screens.  */
		dialog.css("margin-top", Math.max(0, (jQuery(window).height() - dialog.height()) / 2));
	}

	var handelResize = function () {
		/* Reposition when the window is resized */
		jQuery(window).on('resize', function () {
			jQuery('.modal:visible').each(reposition);
		});
	}

	/* Website Launch Date */
	var WebsiteLaunchDate = new Date();
	var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	WebsiteLaunchDate.setMonth(WebsiteLaunchDate.getMonth() + 1);
	WebsiteLaunchDate = WebsiteLaunchDate.getDate() + " " + monthNames[WebsiteLaunchDate.getMonth()] + " " + WebsiteLaunchDate.getFullYear();
	/* Website Launch Date END */

	/* Countdown ============ */
	var handleCountDown = function (WebsiteLaunchDate) {
		/* Time Countr Down Js */
		if ($(".countdown").length) {
			$('.countdown').countdown({ date: WebsiteLaunchDate + ' 23:5' }, function () {
				$('.countdown').text('we are live');
			});
		}
		/* Time Countr Down Js End */
	}

	var boxHover = function () {
		jQuery('.box-hover').on('mouseenter', function () {
			var selector = jQuery(this).parent().parent();
			selector.find('.box-hover').removeClass('active');
			jQuery(this).addClass('active');
		});
	}

	var handleCurrentActive = function () {
		for (var nk = window.location, o = $("ul.navbar a").filter(function () {
			return this.href == nk;
		}).addClass("active").parent().addClass("active"); ;) {

			if (!o.is("li")) break;

			o = o.parent()
				.addClass("show")
				.parent('li')
				.addClass("active");
		}
	}

	/* Mini Cart Function*/
	var handleShopCart = function () {
		$(".remove").on('click', function () {
			$(this).closest(".mini_cart_item").hide('500');
		});
		$('.cart-btn').unbind().on('click', function () {
			$(".cart-list").slideToggle('slow');
		})
	}

	/* Range ============ */
	var priceslider = function () {
		if ($("#slider-tooltips").length > 0) {
			var tooltipSlider = document.getElementById('slider-tooltips');

			var formatForSlider = {
				from: function (formattedValue) {
					return Number(formattedValue);
				},
				to: function (numericValue) {
					return Math.round(numericValue);
				}
			};

			if (tooltipSlider) {
				if (!tooltipSlider.noUiSlider) {
					noUiSlider.create(tooltipSlider, {
						start: [40, 346],
						connect: true,
						format: formatForSlider,
						tooltips: [wNumb({ decimals: 1 }), true],
						range: {
							'min': 0,
							'max': 400
						}
					});
				}

				var formatValues = [
					document.getElementById('slider-margin-value-min'),
					document.getElementById('slider-margin-value-max')
				];

				if (formatValues[0] && formatValues[1]) {
					tooltipSlider.noUiSlider.off('update');
					tooltipSlider.noUiSlider.on('update', function (values, handle, unencoded) {
						formatValues[0].innerHTML = "Min Price: " + "₹" + values[0];
						formatValues[1].innerHTML = "Max Price: " + "₹" + values[1];
					});
				}
			}
		}
	}

	/* handle Bootstrap Touch Spin ============ */
	var handleBootstrapTouchSpin = function () {
		if ($("input[name='demo_vertical2']").length > 0) {
			jQuery("input[name='demo_vertical2']").TouchSpin({
				verticalbuttons: true,
				verticalupclass: 'fa-solid fa-plus',
				verticaldownclass: 'fa-solid fa-minus'
			});
		}
		if ($(".quantity-input").length > 0) {
			jQuery(".quantity-input").TouchSpin({
				verticalbuttons: true,
				verticalupclass: 'fa-solid fa-plus',
				verticaldownclass: 'fa-solid fa-minus'
			});
		}
	}

	var handleSmartWizard = function () {
		if (jQuery('#smartwizard').length > 0) {
			$('#smartwizard').smartWizard();
		}
	}

	var handleSelectpicker = function () {
		if (jQuery('.default-select').length > 0) {
			jQuery('.default-select').selectpicker();
		}
	}

	var dzCategoryToggle = function () {
		jQuery('.category-toggle .toggle-btn').on('click', function () {
			$(".toggle-items").slideToggle("slow");
			jQuery(this).toggleClass('active');
		});
		jQuery('.browse-category-menu .category-btn').on('click', function () {
			$(".category-menu-items").slideToggle("slow");
			jQuery(this).toggleClass('active');
		});
		/* accordion-button */
	}

	var heartBlast = function () {
		$(".heart").on("click", function () {
			$(this).toggleClass("heart-blast");
		});
	}

	/* Mini Cart Function*/
	var handleShopPannel = function () {
		if (screenWidth <= 1199) {
			$(".panel-btn, .filter-top-btn").on('click', function () {
				$(".shop-filter,.panel-close-btn").addClass('active');
			});
		}
		$('.panel-close-btn').on('click', function () {
			$(".shop-filter,.panel-close-btn").removeClass('active');
		})
		if (screenWidth >= 1199) {
			$("#filterTopBtn").click(function () {
				$("#shopFilter").slideToggle("slow");
			});
		}
		$(".btn-filter-left").on('click', function () {
			$(".shop-filter, .panel-close-btn").addClass('active');
		});
	}

	var cartButton = function () {
		$(".dz-close").on('click', function () {
			$(this).closest(".sidebar-cart-list li").fadeOut("normal", function () {
				$(this).remove();
			});
		});
		$(".tag-close").on('click', function () {
			$(this).closest(".filter-tag li").fadeOut("normal", function () {
				$(this).remove();
			});
		});
	}

	/* Header Menu Item Function*/
	var handleHeaderMenuItem = function () {
		$(".menu-item").on('click', function () {
			$(".dzdrop-menu").toggleClass('show');
		});
		$(".menu-items").on('click', function () {
			$(this).toggleClass('active');
		});
	}

	var handleColorFilter = function () {
		var colorsInput = document.querySelectorAll(".color-filter .form-check-input");
		colorsInput.forEach(colorChange)
		function colorChange(item, index, arr) {
			var color = $(item).val();
			var element = $(item).closest('.form-check').find('span');
			element.css({ backgroundColor: color });
		}
	}

	var handleMultipleImageSize = function () {
		jQuery('.smart-product-details .dz-media img').removeAttr('style');

		setTimeout(function () {
			jQuery('.smart-product-details .dz-content').each(function () {
				var ch = Math.ceil(jQuery(this).outerHeight());
				jQuery(this).parent().find('.dz-media img').css('--static-height', ch + 'px');
			});
		}, 500);
	}

	var menuHover = function () {
		jQuery('.header-menu .nav > li').on('mouseenter', function () {
			jQuery('.header-menu .nav > li').removeClass('active');
			jQuery(this).addClass('active');
		})
		jQuery('.menu-nav-btn').on('click', function () {
			jQuery('.page-wraper').toggleClass('active-menu');
		})
	}

	var wishlistBtn = function () {
		jQuery('.wishlist-link').on('click', function () {
			jQuery('.product-description .nav-tabs button[data-bs-target="#wishlist-pane"]').tab('show');
		})
		jQuery('.cart-btn').on('click', function () {
			jQuery('.product-description .nav-tabs button[data-bs-target="#shopping-cart-pane"]').tab('show');
		})
	}

	/* Coming Soon Counter ============ */
	var handleComingSoonCounter = function () {

		var commingSoonDate = new Date(WebsiteLaunchDate).getTime();

		var x = setInterval(function () {
			clockCounter();
		}, 1000);

		function clockCounter() {
			var currentTime = new Date().getTime();
			var clockTime = commingSoonDate - currentTime;

			// Time calculations for days, hours, minutes and seconds
			var days = Math.floor(clockTime / (1000 * 60 * 60 * 24));
			var hours = Math.floor((clockTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((clockTime % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((clockTime % (1000 * 60)) / 1000);

			var remainDays = (days.toString().length == 1) ? '0' + days : days;
			var remainHour = (hours.toString().length == 1) ? '0' + hours : hours;
			var remainMinutes = (minutes.toString().length == 1) ? '0' + minutes : minutes;
			var remainSeconds = (seconds.toString().length == 1) ? '0' + seconds : seconds;

			jQuery('#day').text(remainDays);
			jQuery('#hour').text(remainHour);
			jQuery('#min').text(remainMinutes);
			jQuery('#second').text(remainSeconds);

			if (clockTime < 0) {
				clearInterval(x);
				jQuery('#day, #hour, #min, #second').text('00');
			}
		}
	}

	var handleShowPass = function () {
		jQuery('.show-pass').on('click', function () {
			var input = jQuery(this).parent().find('.dz-password');
			if (input.attr('type') == 'password') {
				input.attr('type', 'text');
				jQuery(this).addClass('active');
			} else {
				input.attr('type', 'password');
				jQuery(this).removeClass('active');
			}
		});
	}

	var setCurrentYear = function () {
		var year = new Date().getFullYear();
		if ($('.current-year').length > 0) {
			$('.current-year').text(year);
		}
	}

	var handlePointerEffect = function () {
		if (jQuery('#pointer-ring').length == 0) return;

		const ring = document.getElementById('pointer-ring');
		const dot = document.getElementById('pointer-dot');

		let mouseX = 0, mouseY = 0, ringX = 0, ringY = 0;

		document.addEventListener('mousemove', (e) => {
			mouseX = e.clientX;
			mouseY = e.clientY;
			dot.style.transform = `translate(${mouseX}px, ${mouseY}px)`;
		});

		function render() {
			ringX += (mouseX - ringX) * 0.15;
			ringY += (mouseY - ringY) * 0.15;
			ring.style.transform = `translate(${ringX}px, ${ringY}px)`;
			requestAnimationFrame(render);
		}
		render();

		jQuery('a, button').on('mouseenter', function () {
			jQuery('#pointer-ring').addClass('active');
		});
		jQuery('a, button').on('mouseleave', function () {
			jQuery('#pointer-ring').removeClass('active');
		});
	}

    var handleTagSlider = function() {
        jQuery("#tagSlider").length > 0 && $("#tagSlider").grouploop({ velocity: 1, forward: !1, pauseOnHover: !0, childNode: ".item", childWrapper: ".item-wrap" }), 
        jQuery("#tagSlider2").length > 0 && $("#tagSlider2").grouploop({ velocity: 1, forward: !0, pauseOnHover: !0, childNode: ".item", childWrapper: ".item-wrap" })
    }

    var handleParallaxScroll = function() {
        jQuery(".dz-parallax").length > 0 && $(window).on("load scroll", function() {
            var t = $(".dz-parallax");
            window.requestAnimationFrame(function() {
                t.each(function() {
                    var t = $(this), e = $(window).scrollTop(), i = t.offset().top, n = t.height(), o = e - i + (.5 * window.innerHeight - .5 * n), a = t.data("parallax-speed") || .1;
                    t.css({ transform: "translate3d(0," + -(o * a) + "px, 0) rotate(" + -(o * a) + "deg)" })
                })
            })
        }), jQuery(".bg-parallax").length > 0 && $(window).on("scroll", function() {
            let t = $(window).scrollTop();
            $(".bg-parallax").css("background-position-y", .02 * t + "px")
        })
    }

    var navScroller = function() {
        var e = 0;
        $(window).scroll(function() {
            if (screenWidth <= 768) {
                $(this).scrollTop() + $(this).innerHeight() >= document.querySelector("body").scrollHeight ? $(".extra-nav").addClass("bottom-end") : $(".extra-nav").removeClass("bottom-end");
                var i = $(this).scrollTop();
                i > e ? $(".extra-nav").addClass("active") : $(".extra-nav").removeClass("active"), e = i
            }
        })
    }

    var handleMagnifyGallery = function() {
        let t = $(".DZoomImage");
        t.on("mousemove", function(t) {
            let e = $(this).offset();
            var i = (t.pageX - e.left) / $(this).width() * 100 <= 100 ? (t.pageX - e.left) / $(this).width() * 100 : 100, n = (t.pageY - e.top) / $(this).height() * 100 <= 100 ? (t.pageY - e.top) / $(this).height() * 100 : 100;
            $(this).find("img").css("transform-origin", i + "% " + n + "%")
        }), t.on("mouseenter", function(t) {
            let e = $(this).find("img");
            e.css("cursor", "pointer"), e.css("transition", "0.1s"), e.css("transform", "scale(1.5)"), $(this).find(".mfp-link i").css({ opacity: 1, zIndex: 1 })
        }), t.on("mouseleave", function(t) {
            let e = $(this).find("img");
            e.css("transition", "0.1s"), e.css("transform", "scale(1)"), $(this).find(".mfp-link i").css({ opacity: 0, zIndex: 1 })
        })
    }

    var handleMultiScroll = function() {
        jQuery("#myContainer").length > 0 && ($(window).width() > 960 && $("#myContainer").multiscroll({ licenseKey: "YOUR KEY HERE", navigation: !0, navigationTooltips: !0, loopBottom: !0, loopTop: !0 }), $(window).on("resize", function() {
            $(window).width() > 960 && $("#myContainer").multiscroll({ licenseKey: "YOUR KEY HERE", navigation: !0, navigationTooltips: !0, loopBottom: !0, loopTop: !0 })
        }))
    }

    var handleTextChar = function() {
        document.querySelectorAll(".word-rotate").forEach((t, e) => {
            var i = $(t).text().split("");
            let n = 360 / i.length;
            i.forEach((e, i) => { $(t).closest(".word-rotate-box").append('<span class="text__char" style="--char-rotate :' + i * n + 'deg">' + e + "</span>") }), $(t).remove()
        })
    }

    var handleOpenModalCookie = function() {
        $(document).on("click", ".modal-content .btn-close", function() {
            var t, e;
            (t = new Date).setTime(t.getTime() + 18e5), e = "expires=" + t.toString(), document.cookie = "prevent_subscription=true;" + e + ";path=/"
        })
    }

    var handleMapScroll = function() {
        if (jQuery("#Maping").length > 0) {
            var t = $("#Maping"), e = $("#map-line"), i = t[0].getBoundingClientRect();
            if (i.top >= 0 && i.bottom <= $(window).height()) {
                var n = (i.bottom - $(window).height()) / (i.height - $(window).height()) * 100, o = (n = Math.min(100, Math.max(0, n))).toFixed() + "%";
                e.css("height", o)
            }
        }
    }

    var handleSplitSlider = function() {
        jQuery("#myContainer").length > 0 && $("#myContainer").multiscroll({ sectionsColor: ["#fff", "#fff", "#fff"], navigation: !0, navigationTooltips: !0, loopBottom: !0, loopTop: !0 })
    }

    var handleOpenModal = function() {
        var t = `<div class="modal fade inquiry-modal style-1" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="inquiry-adv">
					<img src="assets/images/adv-2.webp" alt=""/>
				</div>
				<div class="modal-content">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="    background-color: black !important;">
					  <span aria-hidden="true">
						<i class="icon feather icon-x"></i>
					  </span>
					</button>
					<div>
						<div class="modal-header">
							<span class="title-head">Newsletter</span>
							<h3 class="modal-title" id="exampleModalLongTitle">Subscribe Now</h3>
							<p class="text">Stay updated on all that's new add noteworthy</p>
						</div>
						<div class="modal-body">
							<form action="script/mailchamp.php" class="dzSubscribe" method="post">
								<div class="dzSubscribeMsg"></div>
								<div class="form-group">
									<label class="form-label">Email Address</label>
									<input type="email" name="dzEmail" class="form-control" required placeholder="Enter Email Address">
								</div>
								<button name="submit" type="submit" value="Submit" class="btn btn-secondary btn-block m-b15 text-uppercase">Subscribe</button>
								<div class="custom-checkbox">
									<input type="checkbox" class="form-check-input" id="basic_checkbox_3">
									<label class="form-check-label" for="basic_checkbox_3">I agree to receive marketing materials</label>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>`;
        "true" != getCookie("prevent_subscription") && (jQuery("body").append(t), setTimeout(function() {
            jQuery("#myModal").modal("show")
        }, 5e3))
    }

	/* Function ============ */
	return {
		init: function () {
			// CRITICAL: Essentials for initial render
			dzTheme();
			headerFix();
			setCurrentYear();
			
			// Slightly faster for WOW to keep perception of speed
			setTimeout(function() {
				wow_animation();
			}, 150);
			
			// STAGGERED DEFERRAL: Spread the load to keep TBT low
			setTimeout(function() {
				boxHover();
				handleTagSlider();
				handleParallaxScroll();
				onePageLayout();
				homeSearch();
			}, 500);

			setTimeout(function() {
				MagnificPopup();
				scrollTop();
				handleVideo();
				handleFilterMasonary();
				handleCountDown(WebsiteLaunchDate);
			}, 800);

			setTimeout(function() {
				handleBannerResize();
				handelResize();
				jQuery('.modal').on('show.bs.modal', reposition);
				priceslider();
				handleCurrentActive();
				handleShopCart();
				handleBootstrapTouchSpin();
				handleSelectpicker();
				handleSmartWizard();
				handleShowPass();
			}, 1200);

			setTimeout(function() {
				dzCategoryToggle();
				heartBlast();
				handleComingSoonCounter();
				handleShopPannel();
				handleHeaderMenuItem();
				cartButton();
				handlePointerEffect();
				handleColorFilter();
				handleLightgallery();
				handleOpenModal();
				menuHover();
				wishlistBtn();
				navScroller();
				handleMagnifyGallery();
				handleMultiScroll();
				handleTextChar();
				handleOpenModalCookie();
			}, 1500);
		},

		load: function () {
			counter();
			masonryBox();
			handleMultipleImageSize();
			handleIsotope();
			handleOpenModal();
		},

		scroll: function () {
			handleMapScroll();
		},

		resize: function () {
			screenWidth = $(window).width();
			dzTheme();
			handleSplitSlider();
			handleMultipleImageSize();
			handleMagnifyGallery();
		}
	}

}();

/* Document.ready Start */
jQuery(document).ready(function () {
	Pixio.init();
	jQuery('.navicon').on('click', function () {
		$(this).toggleClass('open');
	});
	jQuery('.toggle-btn').on('click', function () {
		$(this).toggleClass('active');
		$('.account-sidebar').toggleClass('show');
	});
});
/* Document.ready END */

/* Window Load START */
jQuery(window).on('load', function () {
	Pixio.load();
	jQuery('#loading-area').remove();
});
/*  Window Load END */

/* Window Resize START */
jQuery(window).on('resize', function () {
	Pixio.resize();
});
/*  Window Resize END */

/* Window Scroll START */
jQuery(window).on('scroll', function () {
	Pixio.scroll();
});
/*  Window Scroll END */
