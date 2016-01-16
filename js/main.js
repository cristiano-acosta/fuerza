$(document).ready(function () {
    $('a.off-canvas-toggle').sidr({
        name: 'off-side-navigation', side: 'left', // By default
        // source: '#off-side-navigation',
        displace: false, onOpen: function () {
            $('a.off-canvas-toggle').parent('li').addClass('active');
            if ($('a.off-canvas-toggle i').hasClass("fa-bars")) {
                $('a.off-canvas-toggle i').removeClass("fa-bars").addClass("fa-times");
            }
        }, onClose: function () {
            $('a.off-canvas-toggle').parent('li').removeClass('active');
            if ($('a.off-canvas-toggle i').hasClass("fa-times")) {
                $('a.off-canvas-toggle i').removeClass("fa-times").addClass("fa-bars");
            }
        }
    });
    $('.nav a[href^="#"]').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
    /** telefone br */
    jQuery.validator.addMethod("phoneBR", function (phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 9 && phone_number.match(/^\([1-9]{2}\)\d{4}\-\d{4}|\([1-9]{2}\)\d{4}\-\d{5}$/);
        //phone_number.match(/^\([1-9]{2}\)\d{4}\-\d{4}$/);
    }, "Informe DD. Ex. (xx)xxxxxxxx.");
    /** */

    $('#quick-contact').validate({
        errorPlacement: function (label, element) {
            real_label = label.clone();
            real_label.addClass('label label-danger').insertAfter(element);
            //console.log(element);
            element.parents(".form-group").addClass('has-error');
            element.blur(function () {
                $(this).next('label.error').fadeOut(200);
            });
            element.focus(function () {
                $(this).next('label.error').fadeIn(200);
                element.parents(".form-group").removeClass('has-error');
            });
            /*element.next('label.error').mouseover(function () {
             $(this).animate({  opacity:0, top:'100%' }, 1500).css('display','none');
             }).mouseout(function () {
             $(this).animate({ opacity:0, top:'100%' }, 1500).css('display','none');
             })*/
        }, rules: {
            name: {required: true, minlength: 4}, email: {required: true, email: true}, company: {required: true,}
        }, messages: {
            nome: {required: 'Preencha o campo nome.', minlength: 'No mínimo 4 letras'},
            email: {required: 'Informe o seu email.', email: 'Ops, informe um email válido'},
            company: {required: 'Por favor, digite sua empresa.'}
        }, submitHandler: function (form) {
            var dados = $('#contato').serialize();
            console.log(dados);
            $.ajax({
                type: "POST", url: "send.php", data: dados, dataType: 'html', success: function (data) {
                    $('.validation-alert').html(data).animate({opacity: 1}, 1000).mouseover(function () {
                        $(this).animate({opacity: 0}, 1000);
                    });
                    $('#quick-contact').reset();
                    /** https://developers.google.com/analytics/devguides/collection/analyticsjs/events?hl=pt-br */
                    /**
                     *  ‘Email’ is the event category
                     *  ‘click to email’ is the event action
                     *  ‘himanshu@google.com’ is the event label.
                     *  Read more: http://www.optimizesmart.com/event-tracking-guide-google-analytics-simplified-version/#ixzz3TWB1Wcsl
                     *  */
                    ga('send', 'event', 'Contato', 'Envio de formulado', 'Contato', '1');
                }
            });
            return false;
        }
    });
});