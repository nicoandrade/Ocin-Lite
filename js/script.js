var $container_isotope, args_isotope;
jQuery(document).ready(function($) {

			//Anomation at load -----------------
			Pace.on('done', function(event) {
				
			});//Pace

			$(".sidebar_btn").on('click', function(event) {
				event.preventDefault();
				$(this).toggleClass('open');
				$(".woocommerce-sidebar").slideToggle().toggleClass('open');
			});


			/*
			WooCommerce Cart Widget
			=========================================================
			*/
			function createCarousel(){
				$owl_cart = $("#ql_woo_cart .products");
				$owl_cart.owlCarousel({
				    loop:false,
				    margin:10,
				    dots: false,
				    responsiveClass:true,
				    responsive:{
				        0:{
				            items:1
				        },
				        760:{
				            items:3
				        },
				        1306:{
				            items:5
				        },
				        1490:{
				            items:6
				        }
				    }
				});
			}
			createCarousel();

			$( 'body' ).on('click', '#ql_woo_cart .owl-next', function(event) {
				event.preventDefault();
				$owl_cart.trigger('next.owl.carousel');
			});
			$( 'body' ).on('click', '#ql_woo_cart .owl-prev', function(event) {
				event.preventDefault();
				$owl_cart.trigger('prev.owl.carousel');
			});
			//Updates Owl Carouse after the mini cart is updated
			$(document.body).bind("added_to_cart",function(){
				$owl_cart.trigger('destroy.owl.carousel');
			  	createCarousel();
			});


			


			/*
			WooCommerce Masonry
			=========================================================
			*/
			$container_isotope = $('#main .products');
			//Add preloader
			$container_isotope.append('<div class="preloader"><i class="fa fa-cog fa-spin"></i></div>');

			//Isotope parameters
			args_isotope = {
				itemSelector : '.product',
				layoutMode : 'packery',
			    percentPosition: true
			};
			
			//Wait to images load
			$container_isotope.imagesLoaded(  function( $images, $proper, $broken ) {

				if ( $container_isotope.hasClass( 'masonry' ) ) {
					//Start Isotope
					$container_isotope.isotope( args_isotope );
				};

				//Remove preloader
				$container_isotope.find('.preloader i').css('display', 'none');
				$container_isotope.children('.preloader').css('opacity', 0).delay(900).fadeOut();
						
			});//images loaded



			/*
			// WooCommerce Carousel
			//===========================================================
			*/
			//Carousel for Single WooCommerce images
			var ql_owl_woo = $('.ql_main_images');
			ql_owl_woo.owlCarousel({
			    center: true,
			    items: 1,
			    loop: false,
			    dots: false,
			    margin:10
			});

			$ql_woo_thumbnails = $(".ql_thumbnail_column a");
			//Change thumbnails state on slider change
			ql_owl_woo.on('changed.owl.carousel', function(event) {
				var item = event.item.index;
				$ql_woo_thumbnails.removeClass("current");
				$ql_woo_thumbnails.eq(item).addClass("current");
			})
			//WooCommerce thumbnails
			$ql_woo_thumbnails.on('click', function(event) {
				event.preventDefault();
			});
			$ql_woo_thumbnails.hover(function() {				
				$ql_woo_thumbnails.removeClass("current");
				$(this).addClass("current");
				ql_owl_woo.trigger('to.owl.carousel', [$(this).index(), false, true]);
			});
			//Prev and Next buttons
			$(".ql_main_images_btn.ql_next").on('click', function(event) {
				event.preventDefault();
				ql_owl_woo.trigger('next.owl.carousel');
			});
			$(".ql_main_images_btn.ql_prev").on('click', function(event) {
				event.preventDefault();
				ql_owl_woo.trigger('prev.owl.carousel');
			});
			//PhotoSwipe for WooCommerce Images
			initPhotoSwipe('.ql_main_images', 'img', ql_owl_woo);
			/*			
			//===========================================================
			*/

			/*
			// WooCommerce Custom Single Add to cart button
			//===========================================================
			*/
			$( ".summary-bottom .quantity .qty" ).change(function() {
				$( ".entry .quantity .qty" ).val( $(this).val() );
			});
			$( 'body' ).on('click', '.summary-bottom .single_add_to_cart_button', function(event) {
				$( ".entry .single_add_to_cart_button" ).click();
			});


			/*
			// WooCommerce Custom Variations
			//===========================================================
			*/
			$(".variations").after('<div class="ql_custom_variations"></div>');
			//Create custom variations
			$(".variations tr").each(function(index, el) {
				var $select = $(this).find("select");
				var ul = $("<ul></ul>");
				var div_variation = $('<div class="ql_custom_variation"></div>');
				var select_id = $select.attr('id');

				ul.attr('id', 'ql_' + select_id);
				ul.attr('class', 'ql_select_id');

				//If the variation is color
				if (select_id.indexOf("color") > -1) {
					ul.addClass("ql_color_variation");
				};

				$select.find('option').each(function(index_option, el_option) {
					var current_value = $(this).attr('value');
					if (current_value != '') {
						var li = $("<li></li>");
						var a = $("<a href='#'></a>");
						a.attr('data-value', current_value);
						a.text($(this).text());
						//If the variation is color
						if (select_id.indexOf("color") > -1) {
							a.prepend($('<i></i>').css('background-color', current_value).addClass("ql_" + current_value));
						};
						li.append(a);
						ul.append(li);
					};
				});
				div_variation.append($("<h5></h5>").text($(el).find(".label").text()));
				div_variation.append(ul);
				$(".ql_custom_variations").append(div_variation);
			});
			$('body').on('click', ".ql_custom_variation ul li a", function(event) {
				event.preventDefault();
				var option_val = $(this).attr('data-value');
				var slect_id = $(this).parents(".ql_select_id").attr('id');;
				slect_id = slect_id.replace("ql_", "");
				$("#"+slect_id + ' option').each(function(index, el) {
					$(el).removeAttr('selected');
				});
				$("#"+slect_id + ' option[value="' + option_val + '"]').prop('selected', true).attr('selected', 'selected');
				//$("#"+slect_id).val(option_val);
				$("#"+slect_id).change();

				$(this).parents(".ql_select_id").find("a").removeClass("current");
				$(this).addClass("current");
			});
			/*			
			//===========================================================
			*/






			$(".ql_scroll_top").click(function() {
			  $("html, body").animate({ scrollTop: 0 }, "slow");
			  return false;
			});

			$("#primary-menu > li > ul > li.dropdown").each(function(index, el) {
				$(el).removeClass('dropdown').addClass('dropdown-submenu');
			});


			
			$('.dropdown-toggle').dropdown();

			$('*[data-toggle="tooltip"]').tooltip();
			

			//Sidebar Menu Function
			$('#sidebar .widget ul:not(.product-categories) li ul').parent().addClass('hasChildren').append("<i class='fa fa-angle-down'></i>");
			var children;
			$("#sidebar .widget ul:not(.product-categories) li").hoverIntent(
				function () {
					children = $(this).children("ul");
					if($(children).length > 0){ $(children).stop(true, true).slideDown('fast'); }
				}, 
				function () {
				  $(this).children('ul').stop(true, true).slideUp(500);
				}
			);
			//Footer Menu Function
			$('footer .widget ul:not(.product-categories) li ul').parent().addClass('hasChildren').append("<i class='fa fa-angle-down'></i>");
			var children;
			$("footer .widget ul:not(.product-categories) li").hoverIntent(
				function () {
					children = $(this).children("ul");
					if($(children).length > 0){ $(children).stop(true, true).slideDown('fast'); }
				}, 
				function () {
				  $(this).children('ul').stop(true, true).slideUp(500);
				}
			);	

			
			
								
							
														

});