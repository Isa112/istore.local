<script type="text/javascript">


    function getCategories()
        {
            $.ajax({
                type : "POST",
                url  : "/getCategoriesAccessorsAjax/",
                success : function(data)
                {
                    //console.log(data);
                    var categories = $.parseJSON(data);
                    var $select = $('#category');
                    
                    for(i=0;i<categories.length;i++)
                        $select.append("<option value='"+categories[i].id+"'>"+categories[i].name+"</option>");
                },
                error : function(data,text)
                {
                    //var categories = $.parseJSON(data);
                    var $select = $('#category');
                    console.log(text);
                    for(i=0;i<categories.length;i++)
                        $select.append("<option value='"+categories[i].id+"'>"+categories[i].text+"</option>");
                }
            })
        }

    $(function () {
        var url = '/admin/' + '<?= $module ?>' + '/images_upload/' + '<?= $entry['id'] ?>';
        $("#upload_image").imageUpload(url, {
            uploadButtonText: "Добавить",
            previewImageSize: 150,
            onSuccess: function (response) {
                $.ajax(
                        {
                            url: '/admin/<?= $module ?>/get_images/' + '<?= $entry['id'] ?>',
                            type: 'POST',
                            data: {
                            },
                            error: function () {
                                console.log('Ошибка');
                            },
                            success: function (data) {
                                $('.images_group').html(data);
                                image_del_click_subscription('<?= $module ?>');
                            }
                        });
            }
        });
        $.ajax({
            url: '/admin/<?= $module ?>/get_images/' + '<?= $entry['id'] ?>',
            type: 'POST',
            data: {
            },
            error: function () {
                console.log('Ошибка');
            },
            success: function (data) {
                $('.images_group').html(data)
                image_del_click_subscription('<?= $module ?>');
            }
        });
        $("#category").bind({
            blur: function ()
            {
                console.log("Selected " + $(this).val());
            },
            change: function ()
            {
                console.log("Selected " + $(this).children(":checked").text());
                id = $(this).children(":checked").attr('category');
                getAttr(id, attrs);
            }
        });
        $("#hideMeta").toggle(function(){
                $("#meta").hide();
            },
            function(){
                $("#meta").show();
        });

        $("#hideAttr").toggle(function(){
                $("#attr").hide();
            },
            function(){
                $("#attr").show();
        });

        /*$('.good_edit').click(function () {
            console.log("dfjsjfksjdf");
            if (!$(this).parent().parent().find('.good_name').find('input').val()) {
                var good_name = $(this).parent().parent().find('.good_name').text();
                var name = "<input type='text' class='form-control' value='" + good_name + "' placeholder='Название'>";
                $(this).parent().parent().find('.good_name').html(name);
            }
        });
        $('.good_save').click(function () {
            console.log("dasidsasi");
            var good_name = $(this).parent().parent().find('.good_name input').val();
            console.log(good_name);
            $.ajax({
                url: '/admin/goods/good_data_save',
                type: 'POST',
                data: {
                    good_id: $(this).parent().parent().parent().find('.image_del').attr('id'),
                    good_name: good_name
                },
                error: function () {
                    alert("Ошибка!");
                },
                success: function (data) {
                    console.log(data);
                }
            });
            $(this).parent().parent().find('.good_name').html(good_name);
        });*/
        
    });
    
</script>
<div class="row">
    <div class="col-md-12">
        <a href="/admin/<?= $module ?>">
            <button type="button" class="btn btn-default btn-default"><span class='glyphicon glyphicon-step-backward'></span> Назад к списку</button>
        </a>
    </div>
</div>
<div class="page-header">
    <h2>Редактирование модуля "<?= $module_name ?>"</h2>
</div>
<?= form_open_multipart('admin/' . $module . '/edit/' . $entry['id']) ?>
<div class="row" style="margin-bottom: 10px;">
    <div class="col-md-12">
        <button type="submit" class="btn btn-default">Сохранить</button>
    </div>
</div>
<div class="row" style="margin-bottom: 5px;">
    <div class="col-md-12">
        <?= validation_errors(); ?>
        <?php
        if ($this->session->userdata('error')) {
            echo $this->session->userdata('error');
        }
        $this->session->unset_userdata('error');
        ?>
    </div>
</div>
<div class="row">

    <!-- form for select -->

    
<div class="col-md-6">
    <div class="form-group">
        <label for="name">Название</label>
        <input required name='name' value="<?= $entry['name'] ?>" type="text" class="form-control" placeholder="">
    </div>
    <div class="form-group">
        <label for="url">ЧПУ</label>
        <input name='url' value="<?= $entry['url'] ?>" type="text" class="form-control" id="url" placeholder="">
    </div>
    <div class="form-group">
        <label for="category">Выберите категорию</label>
        <select class="form-control" id="category" name="category"></select>
    </div>
    <div class="form-group">
        <label for="title">Цена</label>
        <input name='price' value="<?= $entry['price'] ?>" type="text" class="form-control" id="price" placeholder="">
    </div>
    <div class="checkbox">
        <label>
            <input name='active' <?php
            if ($entry['active'] == 'on') {
                echo 'checked';
            }
            ?> type="checkbox"> Активен
        </label>
    </div>
    <div class="form-group">
        <label for="image">Главное изображение</label><br/>
        <div class="well">
            <a class="main_image" href="/images/<?= $module ?>/<?= $entry['imageBg'] ?>">
                <img width="200px" style="border: 1px solid black; background-color: grey;" src="/images/<?= $module ?>/<?= $entry['imageBg'] ?>">
            </a>
        </div>
        <input name='imageBg' type="file" class="btn-file" id="image">
        <p class="help-block">Выберите главное фото</p>
    </div>
</div>
<div class="col-md-6">
    <button type="button" id="hideAttr" class="btn btn-default">Attributes</button>
    <div id='attr'>
        <?php if (!empty($attrs)): ?>
            <?php foreach ($attrs as $attr): ?>
                <div class='form-group'>
                    <label for=attr'"+attr[i].id+"'><?= $attr['name'] ?></lable>
                    <input type='text' class='form-control' name='attr[<?= $attr['attr_id'] ?>]' value="<?= $attr['value'] ?>">
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <button type="button" id="hideMeta" class="btn btn-default">Meta</button>
    <div id="meta">
        <div class="form-group">
            <label for="metatitle" class="hides">Мета title</label>
            <input name='metatitle' value="<?= $entry['metatitle'] ?>" type="text" class="form-control figu" id="metatitle" placeholder="">
        </div>
        <div class="form-group">
            <label for="desc" class="hides">Мета description</label>
            <textarea name='desc' rows="5" class="form-control" id="desc" placeholder=""><?= $entry['desc'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="keyw" class="hides">Мета keywords</label>
            <textarea name='keyw' rows="3" class="form-control" id="keyw" placeholder=""><?= $entry['keyw'] ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="image">Маленькое Изображение</label><br/>
        <div class="well">
            <a class="main_image" href="/images/<?= $module ?>/<?= $entry['imageSm'] ?>">
                <img width="200px" style="border: 1px solid black; background-color: grey;" src="/images/<?= $module ?>/<?= $entry['imageSm'] ?>">
            </a>
        </div>
        <input name='imageSm' type="file" class="btn-file" id="image">
        <p class="help-block">Выберите дополнительное фото</p>
    </div>
    
</div>
<div class="row">
    <div class="col-md-12">
        <label for="text">Картинки</label>
        <div class="alert alert-info" role="alert">
            <div id="upload_image"></div>
        </div>
        <div class="images_group"></div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="text">Информация о товаре</label>
            <textarea name="text" id="text" rows="30">
                <?= $entry['text'] ?>
            </textarea>
        </div>
        <script>
            CKEDITOR.replace('text');
        </script>
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
        <input type="hidden" name="do" value="<?= $module ?>Edit">
        <button type="submit" class="btn btn-default">Сохранить</button>
    </div>    
</div>
<?php form_close(); ?>