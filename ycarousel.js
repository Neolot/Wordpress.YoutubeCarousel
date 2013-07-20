(function($) {
    $(function() {
        var ycarousel = $('.ycarousel');

        // Carousel
        ycarousel.each(function(){
            var carousel = $('.ycarousel-container', this).jcarousel({
                'wrap': 'circular'
            });
            $('.ycarousel-prev', this).jcarouselControl({
                target: '-=1',
                carousel: carousel
            });
            $('.ycarousel-next', this).jcarouselControl({
                target: '+=1',
                carousel: carousel
            });
        });

        // Video window
        $('a', ycarousel).fancybox({
            padding: 0,
            closeBtn: false
        });
    })
})(jQuery)
