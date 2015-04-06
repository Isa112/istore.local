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
    <div class="col-md-6">
        <div class="form-group">
            <label for="image">Главное изображение</label><br/>
            <input required name='image' type="file" class="btn-file" id="image">
            <p class="help-block">Выберите картинку</p>
        </div>
        <div class="form-group">
            <label for="name">Название</label>
            <input required name='name' value="<?= set_value('name') ?>" type="text" class="form-control name" id="name" placeholder="">
        </div>
        <div class="form-group">
            <label for="url">ЧПУ</label>
            <input required name='url' value="<?= set_value('url') ?>" type="text" class="form-control name_translit" id="url" placeholder="">
        </div>
        <div class="form-group">
            <select name="category" class="form-control" id="category">
                <option disabled selected>Выберите подкатегорию</option>
                <?foreach($categories as $category):?>
                    <option value='<?=$category['id']?>'><?=$category['name']?></option>
                <?endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Дата публикаци</label>
            <div class='input-group date' id='date'>
                <input name="date" type='text' value="<?= set_value('date') ?>" class="form-control" />
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
        <script>
            $(function () {
                $('#date').datetimepicker();
            });
        </script>
    </div>
    <div class="col-md-6">
        <div class="checkbox">
            <label>
                <input name='active' type="checkbox"> Активен
            </label>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input name='title' value="<?= set_value('title') ?>" type="text" class="form-control" id="title" placeholder="">
        </div>
        <div class="form-group">
            <label for="desc">Мета description</label>
            <textarea name='desc' rows="5" class="form-control" id="desc" placeholder=""><?= set_value('desc') ?></textarea>
        </div>
        <div class="form-group">
            <label for="keyw">Мета keywords</label>
            <textarea name='keyw' rows="3" class="form-control" id="keyw" placeholder=""><?= set_value('keyw') ?></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="text">Текст</label>
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