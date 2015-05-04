$(function() {
    // let's define some fx here for easy access...
    // so we can switch effect based on element id
    var fx_1 = {
        'example_1': {
            height: $(document).height(),
            opacity: 0.9
        },
        'example_2': {
            width: $(document).width(),
            opacity: 0.9
        },
        'example_3': {
            height: $(document).height(),
            width: $(document).width(),
            opacity: 0.9
        }
    };
    var fx_2 = {
        'example_1': {
            'visibility': 'visible',
            'height': 0,
            'opacity': 0,
            'cursor': 'pointer'
        },
        'example_2': {
            'visibility': 'visible',
            'width': 0,
            'opacity': 0,
            'cursor': 'pointer'
        },
        'example_3': {
            'visibility': 'visible',
            'width': 0,
            'height': 0,
            'opacity': 0,
            'cursor': 'pointer'
        }
    };
    $('.thumb').colorbox({

        // use the onOpen event...

        onOpen: function() {
            var id = $(this).attr('id');
            var effects_1 = fx_1[id];
            var effects_2 = fx_2[id];
            // prevent Overlay from being displayed...

            $('#cboxOverlay,#colorbox').css('visibility', 'hidden');

            // make the overlay visible and
            // re-add all it's original properties!

            $('#cboxOverlay').css(effects_2).animate(effects_1, 1200,
            function() {

                // this is not required is just for sake of demo...
                // you can JUST USE:  $('#colorbox').css(visibility,'visible').fadeIn(500);

                var $cB = $('#colorbox');
                var cbW = $cB.height();
                var cbT = $cB.position().top;
                $('#colorbox').css({
                    visibility: 'visible',
                    height: 0,
                    opacity: 0,
                    top: (cbT - 100) + 'px'
                }).animate({
                    height: cbW + 'px',
                    opacity: 1,
                    top: cbT + 'px'
                },
                {
                    duration: 1000,
                    // make use of easing plugin for apply some effect to the colorbox
                    easing: 'easeOutElastic'
                });
                // EOF sake ;-)
            });
        }
    });
});