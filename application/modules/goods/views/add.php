<div class="row">
    <div class="col-md-12">
        <a href="/admin/<?= $module ?>">
            <button type="button" class="btn btn-default btn-default"><span class='glyphicon glyphicon-step-backward'></span> Назад к списку</button>
        </a>
    </div>
</div>
<div class="page-header">
    <h2>Добавление записи в модуль "<?= $module_name ?>"</h2>
</div>
<?= form_open_multipart('admin/' . $module . '/add') ?>
<div class="row" style="margin-bottom: 10px;">
    <div class="col-md-12">
        <button type="submit" class="btn btn-default">Добавить</button>
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

    <script type="text/javascript">
        function getAttr(id)
        { 
            $.ajax({
                type : "POST",
                url  : "/getAttrAjax/",
                data : 'id='+id,
                success: function(data){
                    console.log("it's attr: "+data);
                    $elem = $('#attr');
                    var attr = $.parseJSON(data);
                    $elem.empty();
                    for(i=0;i<attr.length;i++)
                    {
                        $elem.append(
                                "<div class='form-group'>"+
                                    "<label for=attr'"+attr[i].id+"'>"+attr[i].name+"</lable>"+
                                    "<input type='text' class='form-control' name='attr["+attr[i].id+"]' id='attr'"+attr[i].id+"'>"+
                                "</div"
                                );
                    }
                }
            })
        }

        function getCategories()
        {
            $.ajax({
                type : "POST",
                url  : "/getCategoriesAjax/",
                success : function(data)
                {
                    var categories = $.parseJSON(data);
                    var $select = $('#category');
                    console.log(categories);
                    for(i=0;i<categories.length;i++)
                        $select.append("<option value='"+categories[i].id+"'>"+categories[i].text+"</option>");
                }
            })
        }

        function getSubCategories()
        {
            $.ajax({
                type : "POST",
                url  : "/getSubCategoriesAjax/",
                success : function(data)
                {
                    var subCategories = $.parseJSON(data);
                    var $select = $('#category');
                    console.log(subCategories);
                    for(i=0;i<subCategories.length;i++)
                        $select.append("<option value='"+subCategories[i].category_id+"'>"+subCategories[i].text+"</option>");
                }
            })
        }

        $(function(){
            getSubCategories();
            $("#category").bind({
                blur: function()
                {
                    console.log("Selected "+$(this).val());
                },

                change: function()
                {
                    console.log("Selected "+$(this).children(":checked").text());
                    id = $(this).val();
                    getAttr(id);
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
        });
    </script>
     <div class="col-md-6">
        <div class="form-group">
            <label for="name">Название</label>
            <input required name='name' value="<?= set_value('name') ?>" type="text" class="form-control name" id="name" placeholder="">
        </div>
        <div class="form-group">
            <label for="url">ЧПУ</label>
            <input name='url' value="<?= set_value('url') ?>" type="text" class="form-control name_translit" id="url" placeholder="">
        </div>
        <div class="form-group">
            <label for="category">Выберите подкатегорию</label>
            <select class="form-control" id="category" name="subcategory"></select>
        </div>
        <div class="form-group">
            <label for="title">Цена</label>
            <input name='price' value="<?= set_value('price') ?>" type="text" class="form-control" id="price" placeholder="">
        </div>

        <div class="checkbox">
            <label>
                <input name='active' type="checkbox"> Активен
            </label>
        </div>
        <div class="form-group">
            <label for="imageBg">Изображение</label><br/>
            <input name='imageBg' type="file" class="btn-file" id="imageBg">
            <p class="help-block">Выберите главное фото</p>
        </div>
    </div>
    <div class="col-md-6">
        <button type="button" id="hideAttr" class="btn btn-default">Attributes</button>
        <div id='attr'></div>
        <button type="button" id="hideMeta" class="btn btn-default">Meta</button>
        <div id="meta">
            <div class="form-group">
                <label for="metatitle" class='hides'>Мета title</label>
                <input name='metatitle' value="<?= set_value('metatitle')?>" type="text" class="form-control" id="metatitle" placeholder="">
            </div>
            <div class="form-group">
                <label for="desc" class='hides'>Мета description</label>
                <textarea name='desc' rows="5" class="form-control" id="desc" placeholder=""><?= set_value('desc') ?></textarea>
            </div>
            <div class="form-group">
                <label for="keyw" class='hides'>Мета keywords</label>
                <textarea name='keyw' rows="3" class="form-control" id="keyw" placeholder=""><?= set_value('keyw') ?></textarea>
            </div>
            <div class="form-group">
                <label for="imageSm">Изображение</label><br/>
                <input name='imageSm' type="file" class="btn-file" id="imageSm">
                <p class="help-block">Выберите дополнительное фото</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="text">Информация о товаре</label>
                <textarea name="text" id="text" rows="30">
                    <?= set_value('text') ?>
                </textarea>
            </div>
            <script>
                CKEDITOR.replace('text');
            </script>
        </div>
    </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col-md-12">
            <input type="hidden" name="do" value="<?= $module ?>Add">
            <button type="submit" class="btn btn-default">Добавить</button>
        </div>    
    </div>
    <?form_close(); ?>

    