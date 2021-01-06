import $ from 'jquery';

(function ($) {
    $.fn.matchMaxHeight = function () {
        const items = $(this);
        $(items).attr('style', '');
        $(items).css({});
        let max = 0;
        for (let i = 0; i < items.length; i++) {
            max = max < $(items[i]).height() ? $(items[i]).height() : max;

        }
        $(items).css({'display': 'block', 'height': '' + max + 'px'});
    }
})(jQuery);

$(window).on("load", () => {
    starter.main.init();
});

$(window).on("resize", () => {
});

$(window).scroll(() => {
});

const starter = {
    _var: {
        error: []
    },

    main: {
        init: function () {
            starter.main.onClick();
            starter.main.onChange();
            starter.main.onSubmit();

            $('.owl-carousel').owlCarousel({
                autoHeight: true,
            });
        },

        onClick: function () {
        },

        onChange: function () {
        },

        onSubmit: function () {
        },
    },
}
