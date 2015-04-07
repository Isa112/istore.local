<?php if(!empty($entries)):?>
   <?php var_dump($entries)?>
   <!-- slider -->
   <div class="slider about_iMac_slider">
      <!-- container -->
      <div class="container">
         <!-- #myCarousel -->
         <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <?php foreach($entries as $key=>$entry):?>
            <!-- Wrapper for slides -->
               <div class="carousel-inner" role="listbox">
      
                  <div class="item <?php if($key==0):?>active<?php endif;?>">
                     <a href="/" class="clearfix"><img src="/images/goods/<?=$entry['imageBg']?>"></a>
                     <h3 class="carousel_caption"><a href="#"><?=$entry['name']?></a></h3>
                  </div><!-- item end -->
      
               </div>
             <!-- Wrapper for slides -->
            <?php endforeach;?>
            <?php if(count($entries)>1):?>
               <!-- Left and right controls -->
               <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
               </a>
               <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
               </a>
               <!-- Left and right controls end -->
            <?php endif;?>
   
         </div><!-- #myCarousel end -->
      </div><!-- container end -->
   </div><!-- slider end -->
   
   
   
   <!-- main_pagination -->
   <div class="main_pagination about_iMac_pagination">
      <!-- container -->
      <div class="container">
         <!-- row -->
         <div class="row">
            <?php var_dump($entries);die;?>
            <?php foreach($entries as $entry):?>
               <!-- <div class="col-md-<?=12/count($entries)?> col-xs-12 main_pagination_item main_pagination_item_<?=$key+1?>">
                  <div class="main_pagination_wrapper">
      
                     <h5>MF883  - 21.5"</h5>
                     <a href="#" class="main_pagination_item_container">
                        <img src="/images/goods/<?=$entry['imageSm']?>" alt="" title="">
                     </a>
                     <h4><a href="#"><?=$entry['subcategory_name']?></a></h4>
                     <a href="#" class="link">Подробнее...</a>
                  </div>
               </div><!-- main_pagination_item --> -->
            <?php endforeach;?>

            <?php for($i=0;$i<7;$i++):?>
               <div class="col-md-3 col-xs-12 main_pagination_item main_pagination_item_<?=$key+1?>">
                  <div class="main_pagination_wrapper">
               
                     <h5>MF883  - 21.5"</h5>
                     <a href="#" class="main_pagination_item_container">
                        <img src="/images/goods/<?=$entry['imageSm']?>" alt="" title="">
                     </a>
                     <h4><a href="#"><?=$entry['subcategory_name']?></a></h4>
                     <a href="#" class="link">Подробнее...</a>
                  </div>
               </div><!-- main_pagination_item -->
            <?php endfor;?>
         </div><!-- row end -->
      </div><!-- container end -->
   </div><!-- main_pagination end -->
<?php endif;?>