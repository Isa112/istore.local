<script>
    $(document).ready(function () {
        $('#emailsave').click(function () {
            $.ajax({
                url: '/backcall/savemail',
                type: "POST",
                dataType: "html",
                data: {
                    email: $(this).parent().parent().find('input').val()
                },
                success: function (response) {
                    console.log('Успех');
                },
                error: function (response) {
                    console.log('Ошибка');
                }
            });
        });
    });
</script>
<div style="margin-bottom: 10px; width:30%;">
    <div class="input-group">
        <span class="input-group-addon">@</span>
        <input type="text" placeholder="E-mail" class="form-control" value="<?= $email['email'] ?>">
        <span class="input-group-btn">
            <button id="emailsave" class="btn btn-default" type="button">Сохранить</button>
        </span>
    </div>
</div>
<table class="table table-bordered">
    <?php if (is_array($entries)) { ?>
        <tr>
            <td width="30px">#</td>
            <td width="30%">Имя</td>
            <td width="30%">Телефон</td>
            <td width="30%">IP</td>
            <td>Дата</td>
            <td>Прочитан</td>
            <td width="30px">Подробнее</td>
            <td width="30px">Удалить</td>
        </tr>
        <?php
        foreach ($entries as $entry):
            ?>
            <tr>
                <td class="id" width="30px"><?= $entry['id'] ?></td>
                <td width="30%"><?= $entry['name'] ?></td>
                <td width="30%"><?= $entry['phone'] ?></td>
                <td width="30%"><?= $entry['ip'] ?></td>
                <td width="30%"><?= date('d.m.Y h:i', strtotime($entry['date'])) ?></td>
                <td width="30px"><?php
                    if ($entry['read'] == 'on') {
                        echo '<span style="-webkit-user-select: none;" class="label label-success active">да</span>';
                    } else {
                        echo '<span style="-webkit-user-select: none;" class="label label-danger active">нет</span>';
                    }
                    ?></td>
                <td width="30px"><a href='/admin/<?= $module ?>/more/<?= $entry['id'] ?>'><span class="glyphicon glyphicon-edit"></span></a></td>
                <td width="30px"><a href='/admin/<?= $module ?>/delete/<?= $entry['id'] ?>'><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
            <?php
        endforeach;
    } else {
        echo '<div class="alert alert-danger" role="alert"><strong>Oops! </strong>Записей в базе не найдено</div>';
    }
    ?>
</table>
