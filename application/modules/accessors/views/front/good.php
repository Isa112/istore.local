<div class="tour_main">
    <div class="wrapper">
        <h3 class="main_title"><?= $entry['name'] ?></h3>

        <div class="single_tour">

            <div class="images-block">
                <div class="main-image rotator">
                    <a href="/images/tours/<?= $entry['image'] ?>"><img src="/images/tours/<?= $entry['image'] ?>" alt="<?= $entry['name'] ?>"></a>
                </div>
                <div class="rotation-images">
                    <ul class="rotate-1">
                        <?php foreach ($tour_images as $img): ?>
                            <li><a href="/images/tours/<?= $img['image'] ?>"><img src="/images/tours/<?= $img['image'] ?>" alt=""/></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="tour_description" style="width: 835px;">
                <p><span>Вылет:</span><?= $entry['flightout'] ?></p>
                <p><span>Курорт:</span><?= $entry['country'] ?></p>
                <p><span>Длительность:</span><?= $entry['duration'] ?></p>
                <p><span>Даты тура:</span><?= mysql_russian_date($entry['datefrom']) ?> по <?= mysql_russian_date($entry['dateto']) ?></p>
                <p><span>Отель:</span><?php
                    if (count($hotel) > 1) {
                        echo $hotel['name'];
                    } else {
                        echo 'Нет';
                    }
                    ?></p>
                <div class="clear clear_padding"></div>
                <p><span>Размещение:</span><?= $entry['placement'] ?></p>
                <p><span>Питание:</span><?= $entry['feed'] ?></p>
                <p><span>Номер:</span><?= $entry['room'] ?></p>
                <div class="clear clear_padding"></div>
                <p><span>Рейс туда:</span><?php
                    if ($entry['outflight']) {
                        echo $entry['outflight'];
                    } else {
                        echo 'Нет данных';
                    }
                    ?></p>
                <p><span>Рейс обратно:</span><?php
                    if ($entry['backflight'])
                        echo $entry['outflight'];
                    else
                        echo 'Нет данных';
                    ?></p>
                <div class="clear clear_padding"></div>
                <label>В стоимость тура включено: <?= $entry['priceinc'] ?></label>
            </div>
            <div class="clear"></div>
            <a href="javascript:" class="cost">Итоговая цена<span><?= $entry['price'] ?></span>= <?= $entry['priceperone'] ?> за 1 чел.</a>
            <a href="/toursbuy/send/<?= $entry['id'] ?>" class="buy">Купить</a>
            <a class="tour_number">Тур № <?= $entry['id'] ?></a>
        </div>
        <?php if (count($hotel) > 1): ?>
            <h3 class="main_title hotel_description_title">Описание отеля
                <ul>
                    <?php $s = $hotel['status'] ?>
                    <p>Рейтинг</p>
                    <li <?php if ($s >= 1): ?> class="active" <?php endif; ?>></li>
                    <li <?php if ($s >= 2): ?> class="active" <?php endif; ?>></li>
                    <li <?php if ($s >= 3): ?> class="active" <?php endif; ?>></li>
                    <li <?php if ($s >= 4): ?> class="active" <?php endif; ?>></li>
                    <li <?php if ($s >= 5): ?> class="active" <?php endif; ?>></li>
                    <li <?php if ($s >= 6): ?> class="active" <?php endif; ?>></li>
                    <li <?php if ($s >= 7): ?> class="active" <?php endif; ?>></li>
                    <li <?php if ($s >= 8): ?> class="active" <?php endif; ?>></li>
                    <li <?php if ($s >= 9): ?> class="active" <?php endif; ?>></li>
                    <li <?php if ($s >= 10): ?> class="active" <?php endif; ?>></li>
                    <li></li>
                    <li></li>
                </ul>
            </h3>

            <div class="hotel_description">

                <div class="hotel_description_content">

                    <div class="hotel_description_content_left_side">
                        <div class="hotel_info">
                            <div class="images-block">
                                <div class="main-image rotator2">
                                    <a href="/images/tours/<?= $entry['image'] ?>"><img src="/images/tours/<?= $entry['image'] ?>" alt="<?= $entry['name'] ?>"></a>
                                </div>
                                <div class="rotation-images">
                                    <ul class="rotate-2">
                                        <?php foreach ($hotel_images as $img): ?>
                                            <li><a href="/images/hotels/<?= $img['image'] ?>"><img src="/images/hotels/<?= $img['image'] ?>" alt=""/></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="hotel_info_inner">
                                <h5 class="hotel_title_2"><?= $hotel['name'] ?></h5>
                                <p>Сайт отеля:<a href="<?= $hotel['site'] ?>"><?=mb_strimwidth($hotel['site'], 0, 35, "...") ?></a></p>
                                <p>Телефон: <?= $hotel['phone'] ?></p>
                                <p>Email:<a href="mailto:<?= $hotel['email'] ?>"><?= $hotel['email'] ?></a></p>
                                <p>Дата постройки: 2010</p>
                                <p>Количество номеров: <?= $hotel['rooms'] ?></p>
                                <p>Пляжная линия: <?= $hotel['beachl'] ?></p>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <h5 class="hotel_title_2">Информация об отеле:</h5>
                        <div class="hotel_info_text">
                            <?= $hotel['text'] ?>
                        </div>
                    </div>

                    <div class="hotel_description_content_right_side">
                        <h5 class="hotel_title_2">Услуги при отеле</h5>
                        <ul>
                            <li>
                                <img src="/img/sample_icons/hotel_icon.jpg" alt="">
                                <h6>Общие услуги</h6>
                                <p>Сад</p>
                            </li>
                            <li>
                                <img src="/img/sample_icons/hotel_icon.jpg" alt="">
                                <h6>Общие услуги</h6>
                                <p>Сад</p>
                            </li>
                            <li>
                                <img src="/img/sample_icons/hotel_icon.jpg" alt="">
                                <h6>Общие услуги</h6>
                                <p>Сад</p>
                            </li>
                            <li>
                                <img src="/img/sample_icons/hotel_icon.jpg" alt="">
                                <h6>Общие услуги</h6>
                                <p>Сад</p>
                            </li>
                            <li>
                                <img src="/img/sample_icons/hotel_icon.jpg" alt="">
                                <h6>Общие услуги</h6>
                                <p>Сад</p>
                            </li>
                            <li>
                                <img src="/img/sample_icons/hotel_icon.jpg" alt="">
                                <h6>Общие услуги</h6>
                                <p>Сад</p>
                            </li>
                            <li>
                                <img src="/img/sample_icons/hotel_icon.jpg" alt="">
                                <h6>Общие услуги</h6>
                                <p>Сад</p>
                            </li>
                            <li>
                                <img src="/img/sample_icons/hotel_icon.jpg" alt="">
                                <h6>Общие услуги</h6>
                                <p>Сад</p>
                            </li>
                            <li>
                                <img src="/img/sample_icons/hotel_icon.jpg" alt="">
                                <h6>Общие услуги</h6>
                                <p>Сад</p>
                            </li>
                            <li>
                                <img src="/img/sample_icons/hotel_icon.jpg" alt="">
                                <h6>Общие услуги</h6>
                                <p>Сад</p>
                            </li>
                        </ul>
                    </div>

                    <div class="clear"></div>

                </div>

            </div>
        <?php endif; ?>
        <div id="reviews-form-block">
            <?= Modules::run('reviews/save', $entry['id']) ?>
        </div>
        <?= Modules::run('reviews/view', true, $entry['id']) ?>
    </div>
</div>