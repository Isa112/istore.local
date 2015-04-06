<!-- Main component for a primary marketing message or call to action -->
<div class="jumbotron">
    <h1>Добро пожаловать!</h1>
    <p>Вы находитесь в административной части сайта: <?= str_ireplace('http://', '', substr(base_url(), 0, -1)); ?>, отсюда вы сможете управлять вашим сайтом.</p>
    <p>Начните с добавление <?= anchor('admin/goods', 'товаров') ?></p>
    <p>По всем вопросам и найденным ошибкам обращайтесь: protected.for@gmail.com, в теме укажите название вашего сайта.</p>
</div>