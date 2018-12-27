(function()
    {
        if ($.cookie('cookie') === undefined)
        {
            $('body').append('<div class="cookie_bar text-center" id="cookie_bar">Nous utilisons des cookies pour vous garantir la meilleure expérience sur notre site. Si vous continuez à utiliser ce dernier, nous considérerons que vous acceptez l\'utilisation des cookies.<span class="cookie_bar_btn"><span class="cookie_btn"><a href="index.php?action=legalNotice">En savoir plus</a></span><span class="cookie_btn" id="cookie_btn_ok">Ok</span></span>');
            $('#cookie_btn_ok').click(function(e)
            {
                e.preventDefault();
                $('#cookie_bar').fadeOut();
                $.cookie('cookie', 'cookie-valid', {expires: 360});
            })
        }


    }
)();