<!-- Static navbar -->
<div class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin/"><img style="margin-bottom: 7px;" src="/img/favicon.ico"> <?= str_ireplace('http://', '', substr(base_url(), 0, -1)); ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php
                if ($this->uri->segment(2) == 'main') {
                    echo "class=\"active\"";
                }
                ?> ><a href="/admin/main">Главная</a></li>
                <li <?php
                if ($this->uri->segment(2) == 'hotels') {
                    echo "class=\"active\"";
                }
                ?> ><!-- <a href="/admin/hotels">Отели</a></li> -->
                <li <?php
                if ($this->uri->segment(2) == 'goods') {
                    echo "class=\"active\"";
                }
                ?> ><a href="/admin/goods">Товары</a></li>
                <li <?php
                if ($this->uri->segment(2) == 'widget') {
                    echo "class=\"active\"";
                }
                ?> ><a href="/admin/widget">Виджеты</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Модули <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li <?php
                        if ($this->uri->segment(2) == 'categories') {
                            echo "class=\"active\"";
                        }
                        ?>><a href="/admin/categories">Категории</a></li>
                        <li <?php
                        if ($this->uri->segment(2) == 'subcategories') {
                            echo "class=\"active\"";
                        }
                        ?>><a href="/admin/subcategories">Подкатегории</a></li>
                        <li <?php
                        if ($this->uri->segment(2) == 'attributes') {
                            echo "class=\"active\"";
                        }
                        ?>><a href="/admin/attributes">Атрибуты</a></li>
                        <li <?php
                        if ($this->uri->segment(2) == 'toursbuy') {
                            echo "class=\"active\"";
                        }
                        ?>><!-- <a href="/admin/toursbuy">Покупка туров</a></li> -->
                        <li <?php
                        if ($this->uri->segment(2) == 'blog') {
                            echo "class=\"active\"";
                        }
                        ?>><a href="/admin/blog">Блог</a></li>
                        <li <?php
                        if ($this->uri->segment(2) == 'news') {
                            echo "class=\"active\"";
                        }
                        ?>><a href="/admin/news">Новости</a></li>
                        <li <?php
                        if ($this->uri->segment(2) == 'contacts') {
                            echo "class=\"active\"";
                        }
                        ?>><a href="/admin/contacts">Контакты</a></li>
                        <li <?php
                        if ($this->uri->segment(2) == 'backcall') {
                            echo "class=\"active\"";
                        }
                        ?>><a href="/admin/backcall">Обратный звонок</a></li>
                        <li <?php
                        if ($this->uri->segment(2) == 'feedback') {
                            echo "class=\"active\"";
                        }
                        ?>><a href="/admin/feedback">Обратная связь</a></li>
                        <li <?php
                        if ($this->uri->segment(2) == 'allreviews') {
                            echo "class=\"active\"";
                        }
                        ?>><a href="/admin/allreviews">Отзывы</a></li>
                        <li <?php
                        if ($this->uri->segment(2) == 'reviews') {
                            echo "class=\"active\"";
                        }
                        ?>><!-- <a href="/admin/reviews">Отзывы о турах</a></li> -->
                        <li <?php
                        if ($this->uri->segment(2) == 'vises') {
                            echo "class=\"active\"";
                        }
                        ?>><!-- <a href="/admin/vises">Визовые услуги</a></li> -->
                        <li <?php
                        if ($this->uri->segment(2) == 'partners') {
                            echo "class=\"active\"";
                        }
                        ?>><a href="/admin/partners">Партнеры</a></li>
                        <li <?php
                        if ($this->uri->segment(2) == 'slider') {
                            echo "class=\"active\"";
                        }
                        ?>><a href="/admin/slider">Слайдер</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="/admin/requests">Запросы <span style="background-color:green;" class="badge"><?php
                            if (isset($msgs)) {
                                echo $msgs;
                            }
                            ?></span></a></li>
                <li><a href="/" target="_blank">Перейти на сайт <span class='glyphicon glyphicon-new-window'></span></a></li>
                <li><a href="<?= '/admin/logout' ?>">Выход</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</div>