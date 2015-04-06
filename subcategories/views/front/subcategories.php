<?php var_dump($entries);if (!empty($entries)): ?>
    <div class="row">
        <?php foreach ($entries as $e): ?>
            <div class="col-md-3 col-xs-12 main_pagination_item">
                <div class="main_pagination_wrapper">
                    <h4><a href="#"><?= $e['name'] ?></a></h4>
                    <a href="/<?= $e['url'] ?>/" class="main_pagination_item_container">
                        <img src="/images/categories/<?= $e['image'] ?>" alt="" title="">
                    </a>
                </div>
            </div><!-- main_pagination_item -->
        <?php endforeach; ?>
    </div><!-- row end -->
<?php endif; ?>