<!-- row -->
      <div class="row">
<?php if(!empty($entries)): ?>
   <?php foreach($entries as $e): ?>
         <div class="col-md-3 col-xs-12 main_pagination_item main_pagination_item_1">
            <div class="main_pagination_wrapper">
               <h4><a href="/<?= $e['url'] ?>/"><?= $e['text'] ?></a></h4>
               <a href="/<?= $e['url'] ?>/" class="main_pagination_item_container">
                  <img src="/images/categories/<?= $e['image'] ?>" alt="" title="">
               </a>
            </div>
         </div>
      <?php endforeach; ?>
<?php endif; ?>
      </div><!-- row end -->