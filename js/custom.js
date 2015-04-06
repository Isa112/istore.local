
// (function($) {
//     $(function() {

//         /*======= search =======*/
//             search_button.onclick = function (){
//                 var className = search_area.className;
//                 if( className.indexOf(' expanded') == -1 ){
//                     className += ' expanded';
//                 }
//                 else {
//                     className = className.replace(' expanded', '');
//                 }
//                 search_area.className = className;
//                 return false;
//             };
//         /*======= End of search =======*/

//       });
//   })(jQuery);





/*======= MAIN MULTIPLE NAVIGATION =======*/
    // $(function(){
    //   $(".dropdown-menu > li > a.trigger").on("click",function(e){
    //     var current=$(this).next();
    //     var grandparent=$(this).parent().parent();
    //     if($(this).hasClass('left-caret')||$(this).hasClass('right-caret'))
    //       $(this).toggleClass('right-caret left-caret');
    //     grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
    //     grandparent.find(".sub-menu:visible").not(current).hide();
    //     current.toggle();
    //     e.stopPropagation();
    //   });

    //   $(".dropdown-menu > li > a:not(.trigger)").on("click",function(){
    //     var root=$(this).closest('.dropdown');
    //     root.find('.left-caret').toggleClass('right-caret left-caret');
    //     root.find('.sub-menu:visible').hide();
    //   });
    // });
/*======= END OF MAIN MULTIPLE NAVIGATION =======*/

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
                .children('p').click(function() {
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