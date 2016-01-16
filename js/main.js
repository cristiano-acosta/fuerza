$(document).ready(function() {

    $('a.off-canvas-toggle').sidr({
        name: 'off-side-navigation',
        side: 'left', // By default
        // source: '#off-side-navigation',
        displace: false,
        onOpen: function(){
            $('a.off-canvas-toggle').parent('li').addClass('active');
            if ($('a.off-canvas-toggle i').hasClass("fa-bars")) {
                $('a.off-canvas-toggle i').removeClass("fa-bars").addClass("fa-times");
            }

        },
        onClose: function(){
            $('a.off-canvas-toggle').parent('li').removeClass('active');
            if ($('a.off-canvas-toggle i').hasClass("fa-times")) {
                $('a.off-canvas-toggle i').removeClass("fa-times").addClass("fa-bars");
            }

        }
    });
    $('.nav a[href^="#"]').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
            || location.hostname == this.hostname) {

            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
});