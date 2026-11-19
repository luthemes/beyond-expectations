/*
================================================================================================
Beyond Expectations - navigation.js
================================================================================================
The primary navigation itself is now Chassis's app-nav.js (the mobile toggle
and the submenu toggles), so this file only keeps the two behaviours that are
not part of the menu: wrapping centered images in a figure, and smooth
scrolling for in-page links.

@package        Beyond Expectations WordPress Theme
@copyright      Copyright (C) 2016. Benjamin Lu
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Benjamin Lu (http://luminathemes.com/)
================================================================================================
*/
( function( $ ) {

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
