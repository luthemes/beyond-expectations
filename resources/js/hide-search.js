/*
================================================================================================
Beyond Expectations - hide-search.js
================================================================================================
This is the most generic template file in a WordPress theme and is one of required files to hide
and show the Search Toggle Navigation.

@package        Beyond Expectations WordPress Theme
@copyright      Copyright (C) 2016. Benjamin Lu
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Benjamin Lu (http://ninjablume.com/contact/
@since          0.0.1
================================================================================================
*/
jQuery(document).ready(function($){
    // The toggle is a div, with a screen reader link inside it so keyboard users can reach it.
    // A click on the link bubbles up to the div; the link itself shouldn't jump to the form.
    $(".search-toggle__link").on('click', function(event){
        event.preventDefault();
    });

    $(".search-toggle").click(function(){
        $("#search-container").slideToggle('slow', function(){
            var open = $("#search-container").is(':visible');

            $(".search-toggle").toggleClass('search-toggle--active', open);
            $(".search-toggle__link").attr('aria-expanded', open ? 'true' : 'false');

            // Move focus into the search field when the form opens.
            if ( open ) {
                $("#search-container .search-field").trigger('focus');
            }
        });
    });
});
