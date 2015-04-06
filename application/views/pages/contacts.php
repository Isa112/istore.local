<!-- contacts -->
<div class="contacts">
   <!-- container -->
   <div class="container">
      <!-- row -->
      <div class="row">

         <div class="col-md-10 col-md-offset-1">
            <h2>Форма обратной связи</h2>
            <?= Modules::run('feedback/save') ?>
         </div>

      </div><!-- row end -->
   </div><!-- container end -->
</div><!-- contacts end -->

<div class="location">
   <div class="container">
      <div class="row">

         <div class="col-md-8 col-xs-12 col-md-offset-2">
            <h5>Контакт:</h5>
            <p><?= Modules::run('widget/getByTitle', 'contacts-contacts') ?></p>
            <h5>Адрес: </h5>
            <?= Modules::run('widget/getByTitle', 'contacts-adress') ?>
            <h5><a href="<?= base_url() ?>"><?= base_url() ?></a></h5>
         </div>
      </div>
   </div>
</div>