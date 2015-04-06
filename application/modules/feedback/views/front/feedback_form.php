<?= form_open_multipart('/contacts/') ?>
               <div class="form-group form-group_2">
                  <label for="exampleInputEmail1">Имя*</label>
                  <input type="text" name='name' value="<?= set_value('name') ?>" class="form-control" id="exampleInputEmail1" placeholder="">
               </div>
               <div class="form-group form-group_2">
                  <label for="exampleInputEmail1">Email*</label>
                  <input type="email" name='email' class="form-control" id="exampleInputEmail1" placeholder="">
               </div>
               <div class="form-group form-group_2">
                  <label for="exampleInputEmail1">Тема*</label>
                  <input type="text" name='theme' class="form-control" id="exampleInputEmail1" placeholder="">
               </div>
               <div class="clear"></div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Сообщение*</label>
                  <textarea name="message" id="" cols="" rows=""></textarea>
               </div>
               <!-- <div class="checkbox">
                  <label>
                  <input type="checkbox"> Отправить копию  этого сообщения  на ваш адрес
                  </label>
               </div> -->
               <input type="hidden" name="do" value="<?= $module ?>Send">
               <button type="submit" class="btn btn-default">Отправить</button>
            </form>




<!-- <div id="feedback_form">
    <form method="POST" action="javascript:" id="save_feedback">
        <input name="name" type="text" value="<?= set_value('name') ?>" <?php
        if (strpos(validation_errors(), '"Имя"')) {
            echo 'style="border:2px solid red;"';
        }
        ?>  placeholder="Ваше имя">
        <input name="phone" type="text" value="<?= set_value('phone') ?>" <?php
        if (strpos(validation_errors(), '"Телефон"')) {
            echo 'style="border:2px solid red;"';
        }
        ?> placeholder="Ваш телефон">
        <input name="email" type="text" value="<?= set_value('email') ?>" <?php
        if (strpos(validation_errors(), '"E-mail"')) {
            echo 'style="border:2px solid red;"';
        }
        ?> placeholder="Ваш email...">
        <textarea name="text" cols="30" rows="10" <?php
        if (strpos(validation_errors(), '"Сообщение"')) {
            echo 'style="border:2px solid red;"';
        }
        ?> placeholder="Ваше сообщение..."><?= set_value('text') ?></textarea>
        <input type="hidden" name="do" value="feedbackSave">
        <input id="submit_msg" type="button" value="Отправить" onclick="javascript:sendfeedback()">
    </form>
</div>
<script>
    function sendfeedback() {
        $('#submit_msg').css('visibility', 'hidden');
        $.ajax({
            url: '/feedback/save',
            type: "POST",
            dataType: "html",
            data: $('#save_feedback').serialize(),
            success: function (response) {
                document.getElementById('feedback_form').innerHTML = response;
                $('#submit_msg').css('visibility', 'visible');
            },
            error: function (response) {
                document.getElementById('feedback_form').innerHTML = "Ошибка при отправке формы";
            }
        });
        return false;
    }
</script> -->