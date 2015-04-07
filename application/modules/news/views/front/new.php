<?php if(!empty($entry)):?>
	<!-- iMac -->
	<div class="news">
	   <!-- container -->
	   <div class="container">
	      <!-- row -->
	      <div class="row">
	
	         <div class="col-md-12 col-xs-12 news_img">
	            <img src="/images/news/<?=$entry['image']?>" title="">
	         </div>
	
	      </div><!-- row end -->
	   </div><!-- container end -->
	</div><!-- iMac end -->
	
	
	<article class="news">
	   <div class="container">
	      <div class="row">
	      	 <h1><?=$entry['name']?></h1>
	         <div class="col-md-12 col-xs-12">
	            <?=$entry['text']?>
	         </div>
	      </div>
	   </div>
	</article>
<?php endif;?>