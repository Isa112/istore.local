

/*======= PANEL =======*/
(function($) {
    $(document).ready(function() {
        console.log("I'm work!");
        var $panel = $('#panel');
        if ($panel.length>0) {
            var $sticker = $panel.children('#panel-sticker');
            var showPanel = function() {
                $panel.addClass('visible');
            };
            var hidePanel = function() {
                $panel.removeClass('visible');
            };
            $sticker
                .children('div.active_panel').click(function() {
                    if ($panel.hasClass('visible')) {

                        hidePanel();
                    }
                    else {
                        showPanel();
                    }
                }).andSelf()
                .children('.close').click(function() {
                    $panel.remove();
                });
        }

    });
})(jQuery);
/*======= END OF PANEL =======*/


(function($) {
    $(function() {

        /*======= Nice scroll =======*/
        $("html, #panel-content").niceScroll({
            touchbehavior: false,
            cursorcolor: "#666",
            cursoropacitymax: 0.8,
            cursorwidth: 6,
            cursordragontouch: true,
            railpadding: {top: 0, right: 3, left: 0, bottom: 0},
            cursorborder: 'none',
            zindex: 2
        });
        /*======= End of Nice scroll =======*/

      });
  })(jQuery);