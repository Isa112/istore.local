<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Front extends MX_Controller {

    public function __construct() {
        parent::__construct();
    }
    public function main() {
//        $this->lang->load('translations', $this->uri->segment(1));
        $data['title'] = 'Купить iPhone в Бишкеке, купить ipad - Магазин Apple iStore (Кыргызстан)';
        $this->load->view('templates/metahead', $data);
        $this->load->view('templates/head', $data);
        $this->load->view('templates/slider', $data);
        $this->load->view('pages/main', $data);
        $this->load->view('templates/footer', $data);
    }

    public function subcategories($url) {
        $cat = Modules::run('categories/get_by_url', $url);
        $sub = Modules::run('subcategories/getByCatUrl',$url);
        if ($cat) {
            foreach($sub as &$subCat)
            $subCat['category_url'] = $url;
            $data['keyw'] = $cat['keyw'];
            $data['desc'] = $cat['desc'];
            $data['title'] = $cat['metatitle'];
            $data['url'] = $url;
            $data['entry'] = $cat;
            $data['entry']['sub'] = $sub;
            $this->load->view('templates/metahead', $data);
            $this->load->view('templates/head', $data);
            $this->load->view('pages/subcategory', $data);
            $this->load->view('templates/footer', $data);
        } else {
            show_404();
        }
    }

    public function goods($catUrl,$subCatUrl)
    {
        $cat = Modules::run('categories/get_by_url', $catUrl);
        if($cat)
        {
            $goods = Modules::run('goods/getBySubCatUrl',$subCatUrl);
            if($goods)
            {
                foreach($goods as &$good)
                {
                    $good['subcategory_name'] = Modules::run('goods/getSubCatNameById',$good['subcategory_id']);
                }
                $data['title'] = "Товары";
                $data['catUrl'] = $catUrl;
                $data['subCatUrl'] = $subCatUrl;
                $data['entries'] = $goods;
                $this->load->view('templates/metahead', $data);
                $this->load->view('templates/head', $data);
                $this->load->view('pages/goods', $data);
                $this->load->view('templates/footer', $data);
            }
            else
            {
                $data['title'] = "Товары";
                $data['catUrl'] = $catUrl;
                $data['subCatUrl'] = $subCatUrl;
                $data['entries'] = $goods;
                $this->load->view('templates/metahead', $data);
                $this->load->view('templates/head', $data);
                $this->load->view('pages/goods', $data);
                $this->load->view('templates/footer', $data);
            }
        }
        else
        {
            show_404();
        }
    }

    public function good($catUrl,$subCatUrl,$goodUrl)
    {
        $cat = Modules::run('categories/get_by_url', $catUrl);
        if($cat)
        {
            $good   = Modules::run('goods/get_by_url',$goodUrl);
            $goods  = Modules::run('goods/getBySubCatUrl',$subCatUrl);

            if($good)
            {
                $images = Modules::run('goods/get_images',$good['id'],true);
                $attrs  = Modules::run('goods/getAttrById',$good['id']);
                foreach($attrs as &$attr)
                {
                    $attr['attr_name'] = Modules::run('goods/getAttrNameById',$attr['attr_id']);
                }
                $data['title']   = $good['name'];
                $data['entry']   = $good;
                $data['entries'] = $goods;
                $data['attrs']   = $attrs;
                $data['images']  = $images;
                $data['catUrl'] = $catUrl;
                $data['subCatUrl'] = $subCatUrl;
                $this->load->view('templates/metahead', $data);
                $this->load->view('templates/head', $data);
                $this->load->view('pages/good', $data);
                $this->load->view('templates/footer', $data);
            }
            else
            {
                show_404();
            }
        }
        else
        {
            show_404();
        }
        
    }

    public function about() {
        $data['title'] = 'О нас';
        $this->load->view('templates/metahead', $data);
        $this->load->view('templates/head', $data);
        $this->load->view('pages/about', $data);
        $this->load->view('templates/footer', $data);
    }

    public function contacts() {
        $data['title'] = 'Контакты';
        $this->load->view('templates/metahead', $data);
        $this->load->view('templates/head', $data);
        $this->load->view('pages/contacts', $data);
        $this->load->view('templates/footer', $data);
    }

    public function allreviews() {
        $data['title'] = 'Отзывы';
        $contacts = Modules::run('contacts/get');
        $data['contacts'] = $contacts;
        $this->load->view('templates/metahead', $data);
        $this->load->view('templates/head', $data);
        $this->load->view('templates/slider', $data);
        $this->load->view('templates/none_reservation', $data);
        $this->load->view('pages/allreviews', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tours() {
        $data['title'] = 'Туры за рубеж';
        $this->load->view('templates/metahead', $data);
        $this->load->view('templates/head', $data);
        $this->load->view('pages/tours', $data);
        $this->load->view('templates/contacts', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tour($url) {
        $tour = Modules::run('tours/get_by_url', $url);
        $hotel = Modules::run('hotels/get', $tour['hotel_id'], true);
        $tour_images = Modules::run('tours/get_images', $tour['id'], true);
        $hotel_images = Modules::run('hotels/get_images', $hotel['id'], true);
        $data['keyw'] = $tour['keyw'];
        $data['desc'] = $tour['desc'];
        if ($tour) {
            $data['title'] = $tour['name'];
            $data['url'] = $url;
            $data['entry'] = $tour;
            $data['tour_images'] = $tour_images;
            $data['hotel_images'] = $hotel_images;
            if ($tour['hotel_id']) {
                $data['hotel'] = $hotel;
            } else {
                $data['hotel'] = 'Нет';
            }
            $this->load->view('templates/metahead', $data);
            $this->load->view('templates/head', $data);
            $this->load->view('pages/tour', $data);
            $this->load->view('templates/contacts', $data);
            $this->load->view('templates/footer', $data);
        } else {
            show_404();
        }
    }

    public function vises() {
        $data['title'] = 'Визовые услуги';
        $this->load->view('templates/metahead', $data);
        $this->load->view('templates/head', $data);
        $this->load->view('templates/none_reservation', $data);
        $this->load->view('pages/vises', $data);
        $this->load->view('templates/contacts', $data);
        $this->load->view('templates/footer', $data);
    }

    public function belay() {
        $data['title'] = 'Медицинаская страховка';
        $this->load->view('templates/metahead', $data);
        $this->load->view('templates/head', $data);
        $this->load->view('templates/slider', $data);
        $this->load->view('templates/none_reservation', $data);
        $this->load->view('pages/belay', $data);
        $this->load->view('templates/contacts', $data);
        $this->load->view('templates/footer', $data);
    }

    public function reservation() {
        $data['title'] = 'Онлайн бронирование';
        $this->load->view('templates/metahead', $data);
        $this->load->view('templates/head', $data);
        $this->load->view('templates/slider', $data);
        $this->load->view('templates/reservation', $data);
        $this->load->view('pages/reservation', $data);
        $this->load->view('templates/contacts', $data);
        $this->load->view('templates/footer', $data);
    }

    public function blog() {
        $data['title'] = 'Блог';
        $this->load->view('templates/metahead', $data);
        $this->load->view('templates/head', $data);
        $this->load->view('pages/blog', $data);
        $this->load->view('templates/footer', $data);
    }

    public function post($url) {
        $post = Modules::run('blog/get_by_url', $url);
        $data['entry'] = $post;
        $data['title'] = 'Блог - ' . $post['name'];
        $data['url'] = $url;
        $this->load->view('templates/metahead', $data);
        $this->load->view('templates/head', $data);
        $this->load->view('templates/slider', $data);
        $this->load->view('templates/none_reservation', $data);
        $this->load->view('pages/post', $data);
        $this->load->view('templates/contacts', $data);
        $this->load->view('templates/footer', $data);
    }

    public function news() {
        $data['title'] = 'Новости';
        $this->load->view('templates/metahead', $data);
        $this->load->view('templates/head', $data);
        $this->load->view('pages/news', $data);
        $this->load->view('templates/footer', $data);
    }

    public function onenew($url) {
        $new = Modules::run('news/get_by_url', $url);
        $data['entry'] = $new;
        $data['title'] = 'Новости - ' . $new['name'];
        $data['url'] = $url;
        $this->load->view('templates/metahead', $data);
        $this->load->view('templates/head', $data);
        $this->load->view('pages/new', $data);
        $this->load->view('templates/footer', $data);
    }

}
