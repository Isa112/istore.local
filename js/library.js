function image_del_click_subscription(module) {
    $('.image_del').click(function () {
        var image_del = this;
        if (confirm('Удалить?')) {
            $.ajax({
                url: '/admin/' + module + '/image_delete',
                type: 'POST',
                data: {
                    id: $(this).attr('id')
                },
                error: function () {
                    alert("Ошибка!");
                },
                success: function (data) {
                    $(image_del).parent().parent().remove();
                }
            });
            return true;
        } else {
            return false;
        }
    });

    

    /*$('.image_view').colorbox({
        rel: 'gal',
        current: "Фото {current} из {total}",
        previous: 'Пред.',
        next: 'След.',
        opacity: 0.5,
        width: "800",
        height: "600",
        close: "Закрыть"
    });
    $('.main_image').colorbox({
        current: "Фото {current} из {total}",
        previous: 'Пред.',
        next: 'След.',
        opacity: 0.5,
        width: "800",
        height: "600",
        close: "Закрыть"
    });*/
}

jQuery.br2nl = function (varTest) {
    return varTest.replace(/<br>/g, "\r");
};

jQuery(document).ready(function () {
    $('a .glyphicon-remove, a .glyphicon-trash').click(function () {
        if (confirm('Удалить?')) {
            return true
        } else {
            return false;
        }
    })
    $('#order_by_category').change(function () {
        window.location.href = "/admin/sports/order/" + this.value;
    });

    var count = 0;
    $('#add_tag_field').click(function () {
        count += 1;
        $('.tags').append('<div class="input-group tag" style="margin-top: 10px; width:50%">\n\
                            <input type="text" name="tags[' + count + ']" class="form-control tags">\n\
                                <span class="input-group-btn del_tag">\n\
                                    <button class="btn btn-danger" title="Удалить">\n\
                                        <span class="glyphicon glyphicon-remove"></span>\n\
                                    </button>\n\
                                </span>\n\
                        </div>');

        $('.del_tag').click(function () {
            $(this).parent().remove();
        })
        return false;
    });


    $('.tags').keydown(function () {
        if (event.keyCode == $.ui.keyCode.ENTER) {
            return false;
        }
    });

    image_del_click_subscription();
    

});