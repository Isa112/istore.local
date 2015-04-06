<?php $categories = Modules::run('categories/get');?>

<!-- header -->
<header class="navbar navbar-default navbar-fixed-top" role="navigation">
   <!-- container -->
    <div class="container">
      <!-- row -->
        <div class="row">

         <!-- navbar-header -->
            <div class="navbar-header">
                <a class="logo" href="/"><img src="/img/logo.png" height="25" width="73" alt="iStore" title="iStore"></a><!-- logo -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
         <!-- .navbar-header end -->

         <!-- .navbar-collapse -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav b-nav_1">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/about/">О нас</a></li>
                    <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-delay="100">Гаджеты<b class="caret"></b></a>
                     <ul class="dropdown-menu">
                        <?php foreach($categories as $category):?>
                        <?php $subcategories = Modules::run('subcategories/getByCatId',$category['id']);?>
                          <li>
                              <a href="/<?= $category['url'] ?>" class="trigger"><?=$category['name']?></a>
                              <?php if(count($subcategories)>0):?>
                                <ul class="dropdown-menu sub-menu">
                                <?php foreach($subcategories as $subcategory):?>
                                  <li><a href="/<?=$category['url']?>/<?=$subcategory['url']?>/"><?=$subcategory['text']?></a></li>
                                <?php endforeach;?>
                                </ul>
                              <?php endif;?>
                          </li>
                        <?php endforeach;?>
                     </ul>
               </li>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-delay="100">Аксессуары<b class="caret"></b></a>
                     <ul class="dropdown-menu">
                        <li>
                           <a class="trigger">Level 1</a>
                           <ul class="dropdown-menu sub-menu">
                              <li><a href="#">Level 2</a></li>
                              <li><a href="#">Level 2</a></li>
                              <li><a href="#">Level 2</a></li>
                           </ul>
                        </li>
                        <li>
                           <a class="trigger">Level 1</a>
                           <ul class="dropdown-menu sub-menu">
                              <li><a href="#">Level 2</a></li>
                              <li><a href="#">Level 2</a></li>
                              <li><a href="#">Level 2</a></li>
                           </ul>
                        </li>
                        <li>
                           <a class="trigger">Level 1</a>
                           <ul class="dropdown-menu sub-menu">
                              <li><a href="#">Level 2</a></li>
                              <li><a href="#">Level 2</a></li>
                              <li><a href="#">Level 2</a></li>
                           </ul>
                        </li>
                     </ul>
               </li>
                    <li><a href="/news/">Статьи</a></li>
                    <li><a href="/contacts/">Контакты</a></li>
                    <li>
                      <form action="#" role="search">
                        <input type="submit" value="" class="search-submit">
                        <input type="search" name="search_text" class="search-text" placeholder="Поиск..." autocomplete="off">
                      </form>
                     </li>
                </ul><!-- ul.nav end -->
            </div>
         <!--.collapse end -->

        </div><!-- .row end -->
    </div><!-- .container end -->
</header><!-- header end -->