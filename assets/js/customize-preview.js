(function($) {
    wp.customize('bachpedia_primary_color', function(value) {
        value.bind(function(newval) {
            $(':root').css('--bs-primary', newval);
            $('.navbar').css('background-color', newval);  // Preview en navbar
        });
    });
})(jQuery);
