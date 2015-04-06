<?php if(!empty($entries)):?>
    <!-- iMac -->
    <div class="allnews">
       <!-- container -->
       <div class="container">
          <!-- row -->
          <div class="row">
            <?php foreach($entries as $entry):?>
                <div class="col-md-12 col-xs-12 allnews_img">
                   <a href="/blog/<?=$entry['url']?>"><img src="/images/blog/<?= $entry['image'] ?>" title=""></a>
                   <p><?= mb_strimwidth(strip_tags($entry['text']), 0, 300, "..."); ?><a href="">Подробнее...</a></p>
                </div>
            <?php endforeach;?> 
    
          </div><!-- row end -->
       </div><!-- container end -->
    </div><!-- iMac end -->
<?php endif;?>