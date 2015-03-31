<a href='/admin/<?= $module ?>/add'><button type="button" style='margin-bottom:20px;' class="btn btn-default btn-default">Добавить</button></a>
<table class="table table-bordered">
    <?php if (is_array($entries)) { ?>
        <tr>
            <td width="30px">#</td>
            <td width="30px">Категория</td>
            <td width="30px">ЧПУ</td>
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
                <td class="id" width="50%"><?= $entry['name'] ?></td>
                <td class="id" width="50%"><?= $entry['url'] ?></td>
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