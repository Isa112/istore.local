<?php if(!empty($entries)):?>
   <div id="panel">
       <div id="panel-content">
         <?php foreach($entries as $good):?>
            <div class="panel-navigation-item clearfix">
               <a href="/<?=$catUrl?>/<?=$good['url']?>/">
                   <img src="/images/accessors/<?=$good['imageSm']?>" alt=""/>
                  <span><?=$good['name']?></span>
                  <span class="load_more">подробнее</span>
               </a>
            </div>
         <?php endforeach;?>
       </div>
       <div id="panel-sticker" title="Еще товары">
            <p></p>
            <p></p>
            <p>Е</p>
            <p>щ</p>
            <p>е</p>
            <p></p>
            <p>т</p>
            <p>о</p>
            <p>в</p>
            <p>а</p>
            <p>р</p>
            <p>ы</p>
           <div class="close">×</div>
       </div>
   </div>
<?php endif;?>
<?php if(!empty($images)):?>
   <!-- slider -->
   <div class="slider product">
      <!-- container -->
      <div class="container">
         <!-- #myCarousel -->
         <div id="myCarousel" class="carousel slide" data-ride="carousel">
            
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
               <?php foreach($images as $key=>$image):?>
                  <div class="item <?php if($key==0):?>active<?php endif;?>">
                     <a href="#"><img src="/images/accessors/<?=$image['image']?>" alt="" title=""></a>
                     <h3><a href="#"><?=$image['name']?></a></h3>
                  </div><!-- item end -->
               <?php endforeach;?>
   
            </div>
             <!-- Wrapper for slides -->
   
            <!-- carousel-indicators -->
              <ol class="carousel-indicators">
                <?php foreach($images as $key => $image):?>
                  <li data-target="#myCarousel" data-slide-to="<?=$key?>" <?php if($key==0):?>class="active"<?php endif;?>><a href="#"><img src="/images/accessors/<?=$image['image']?>" alt=""></a></li>
                <?php endforeach;?>
              </ol>
            <!-- carousel-indicators end -->
   
         </div><!-- #myCarousel end -->
      </div><!-- container end -->
   </div><!-- slider end -->
<?php endif;?>

<?php if(!empty($entry)):?>
<!-- product_description -->
<div class="product_description">
   <!-- container -->
   <div class="container">
      <!-- row -->
      <div class="row">
         <div class="col-md-5 col-xs-12">
            <h5><?=$entry['name']?></h5>
            <p><?=$entry['text']?></p>
            <img src="/images/accessors/<?=$entry['imageSm']?>" alt="">
         </div><!-- col-md-5 end -->

            <div class="col-md-1"></div>
         <?php if(!empty($attrs)):?>
            <div class="col-md-6 col-xs-12 characteristic">
               <?php foreach($attrs as $attr):?>
                  <div class="characteristic_item">
                     <p><?=$attr['attr_name']?></p>
                     <p><?=$attr['value']?></p>
                  </div>
               <?php endforeach;?>
   
            </div><!-- col-md-6 end -->
         <?php endif;?>

      </div><!-- row end -->
   </div><!-- container end -->
</div><!-- product_description end -->
<?php endif;?>