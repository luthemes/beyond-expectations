/*
================================================================================================
Beyond Expectations - navigation.js
================================================================================================
This is the most generic template file in a WordPress theme and is one of required files to hide
and show the primary navigation for the Primary Navigation in different resolution and other
features.

@package        Beyond Expectations WordPress Theme
@copyright      Copyright (C) 2016. Benjamin Lu
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Benjamin Lu (http://luminathemes.com/)
================================================================================================
*/
( function( $ ) {
	var container, button, menu, links, subMenus;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	// `aria-expanded` lives on the toggle button (which already has
	// `aria-expanded="false"` in the template), not on the menu list.
	if ( -1 === menu.className.indexOf( 'primary-navigation__menu' ) ) {
		menu.className += ' primary-navigation__menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'primary-navigation--toggled' ) ) {
			container.className = container.className.replace( ' primary-navigation--toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' primary-navigation--toggled';
			button.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( var i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .primary-navigation__menu.
		while ( -1 === self.className.indexOf( 'primary-navigation__menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	function initMainNavigation( container ) {
		// Add dropdown toggle that display child menu items.
		container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( '<button class="primary-navigation__dropdown" aria-expanded="false">' + screenReaderText.expand + '</button>' );

		container.find( '.primary-navigation__dropdown' ).click( function( e ) {
			var _this = $( this );
			e.preventDefault();
			_this.toggleClass( 'primary-navigation__dropdown--open' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'primary-navigation__submenu--open' );
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			_this.html( _this.html() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
		} );
	}
	initMainNavigation( $( '.primary-navigation' ) );

	// Re-initialize the main navigation when it is updated, persisting any existing submenu expanded states.
	$( document ).on( 'customize-preview-menu-refreshed', function( e, params ) {
		if ( 'primary' === params.wpNavMenuArgs.theme_location ) {
			initMainNavigation( params.newContainer );

			// Re-sync expanded states from oldContainer.
			params.oldContainer.find( '.primary-navigation__dropdown.primary-navigation__dropdown--open' ).each(function() {
				var containerId = $( this ).parent().prop( 'id' );
				$( params.newContainer ).find( '#' + containerId + ' > .primary-navigation__dropdown' ).triggerHandler( 'click' );
			});
		}
	});

	// Wrap centered images in a new figure element
	$( 'img.aligncenter' ).wrap( '<figure class="centered-image"></figure>');


    // Smooth scrolling for in-page links. The skip link is left out: the
    // browser moves keyboard focus to its target itself (see the
    // `tabindex="-1"` on #site-content). After scrolling, focus is moved to
    // the target so keyboard users land on the content, not just the viewport.
    $('a[href*="#"]:not([href="#"]):not(.skip-link)').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000, function() {
                    if ( ! target.is( ':focus' ) ) {
                        target.attr( 'tabindex', '-1' );
                        target.trigger( 'focus' );
                    }
                });
            return false;
        }
    }
  });
} )( jQuery );