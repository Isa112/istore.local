<a href='/admin/<?= $module ?>/add'><button type="button" style='margin-bottom:20px;' class="btn btn-default btn-default">Добавить</button></a>
<table class="table table-bordered">
    <?php if (is_array($entries)) { ?>
        <tr>
            <td width="30px">#</td>
            <td width="30%">Название</td>
            <td width="30%">ЧПУ</td>
            <td width="30%">
                <!-- <a href="/admin/goods/subcategory_id/asc">Подкатегория</a> -->
                <div class="btn-group">
                  <button type="button" class="btn btn-default" onclick="location.href='/admin/accessors/';">Категории</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <?php if(!empty($subcategories)):?>
                    <ul class="dropdown-menu" role="menu">
                      <?php foreach($categories as $category):?>
                        <li><a href="/admin/accessors/category/<?=$subcategory['id']?>"><?=$category['name']?></a></li>
                      <?php endforeach;?>
                    </ul>
                  <?php endif;?>
                </div>
            </td>
            <td>Миниатюра</td>
            <td>Активен</td>
            <td>Порядок</td>
            <td width="30px">Редактировать</td>
            <td width="30px">Удалить</td>
        </tr>
        <?php
        foreach ($entries as $entry):
            ?>
            <tr>
                <td class="id" width="30px"><?= $entry['id'] ?></td>
                <td width="30%"><?= $entry['name'] ?></td>
                <td width="30%"><?= cut_str($entry['url'], 30) ?></td>
                <td witdth="30%"><?= $entry['category_name']?></td>
                <td width="20px"><img width="50px" src='/images/<?= $module ?>/<?= $entry['imageSm'] ?>'></td>
                <td width="30px"><?php
                    if ($entry['active'] == 'on') {
                        echo '<span style="-webkit-user-select: none;" class="label label-success active">да</span>';
                    } else {
                        echo '<span style="-webkit-user-select: none;" class="label label-danger active">нет</span>';
                    }
                    ?></td>
                <td><a href='/admin/<?= $module ?>/up/<?= $entry['id'] ?>'><span class="glyphicon glyphicon-arrow-up"></span></a><a href='/admin/<?= $module ?>/down/<?= $entry['id'] ?>'><span class="glyphicon glyphicon-arrow-down"></span></a> (<?= $entry['order'] ?>)</td>
                <td width="30px"><a href='/admin/<?= $module ?>/edit/<?= $entry['id'] ?>'><span class="glyphicon glyphicon-edit"></span></a></td>
                <td width="30px"><a href='/admin/<?= $module ?>/delete/<?= $entry['id'] ?>'><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
            <?php
        endforeach;
    } else {
        echo '<div class="alert alert-danger" role="alert"><strong>Oops! </strong>Записей в базе не найдено</div>';
    }
    ?>
</table>
