<?php
$xhtmlCategory = $xhtmlBook = '';
$newArrayList = [];

// Lấy danh sách các category special
$listCategory = array_column($this->listSpecial, 'category_name', 'category_id');

// Xử lý lấy các data array gán vào theo từng id category
foreach ($this->listSpecial as $value) {
    if (in_array($value['category_id'], array_flip($listCategory))) {
        $newArrayList[$value['category_id']][] = $value;
    }
}

if (!empty($newArrayList)) {
    $xhtmlCategory .= '<ul class="tabs tab-title">';
    $i = 1;
    foreach ($newArrayList as $keyCategory => $itemCategory) {
        // Danh mục nổi bật
        $activeDefault = ($i == 1) ? 'active default' : '';
        $activeTab = ($i == 1) ? 'class="current"' : '';
        $xhtmlCategory .= '<li ' . $activeTab . '><a href="tab-category-' . $keyCategory . '" class="my-product-tab" data-category="' . $keyCategory . '">' . $itemCategory[0]['category_name'] . '</a></li>';

        // Các sách nổi bật theo từng tab
        $xhtmlBook .= '<div id="tab-category-' . $keyCategory . '" class="tab-content ' . $activeDefault . '">
                            <div class="no-slider row tab-content-inside">';
        $countItemBook = 1;
        foreach ($itemCategory as $keyBook => $valueBook) {
            
            // Danh sách "sản phẩm nổi bật" chỉ cho phép chứa tối đa 8 item, kiểm tra nếu số item vượt quá 8 sẽ ngắt vòng lặp
            if ($countItemBook > 8) {
                break;
            }

            $imgBook        = UPLOAD_BOOK_URL . $valueBook['picture'];
            $linkModalView  = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'ajaxLoadInfo', ['id' => $valueBook['book_id']]);
            $linkItemBook   = URL::createLink($this->arrParam['module'], 'book', 'item', ['bid' => $valueBook['book_id']]);
            $linkViewAll    = URL::createLink($this->arrParam['module'], 'book', 'list', ['cid' => $valueBook['category_id']]);

            $xhtmlBook .= '<div class="product-box">
                <div class="img-wrapper">
                    <div class="lable-block">
                        <span class="lable4 badge badge-danger"> -' . $valueBook['sale_off'] . '%</span>
                    </div>
                    <div class="front">
                        <a href="' . $linkItemBook . '">
                            <img src="' . $imgBook . '" class="img-fluid blur-up lazyload bg-img" alt="product">
                        </a>
                    </div>
                    <div class="cart-info cart-wrap">
                        <a href="#" title="Add to cart"><i class="ti-shopping-cart"></i></a>
                        <a href="javascript:loadModal(\'' . $linkModalView . '\', \'' . UPLOAD_BOOK_URL . '\')" title="Quick View"><i class="ti-search"></i></a>
                    </div>
                </div>
                <div class="product-detail">
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <a href="' . $linkItemBook . '">
                        <h6 class="cs-ellipsis-4 pb-0">' . $valueBook['description'] . '</h6>
                    </a>
                    <h4 class="text-lowercase pt-2">' . HelperFrontend::currencyVND($valueBook['price_discount']) . ' đ <del>' . HelperFrontend::currencyVND($valueBook['price']) . ' đ</del></h4>
                </div>
            </div>';
            $countItemBook++;
        }
        $xhtmlBook .= ' </div>
                        <div class="text-center"><a href="' . $linkViewAll . '" class="btn btn-solid">Xem tất cả</a></div>
                    </div>';
        $i++;
    }
    $xhtmlCategory .= '</ul>';
} else {
    $xhtmlCategory = '<p class="font-weight-bold text-center h6 text-muted">Danh mục đang được cập nhật !</p>';
}
?>

<!-- Home slider -->
<?php include_once "element/home_slider.php" ?>
<!-- Home slider end -->

<!-- Top Collection -->
<?php include_once "element/top_collection.php" ?>
<!-- Top Collection end-->

<!-- service layout -->
<?php include_once "element/service_layout.php" ?>
<!-- service layout  end -->

<!-- Tab product -->
<div class="title1 section-t-space title5">
    <h2 class="title-inner1">Danh mục nổi bật</h2>
    <hr role="tournament6">
</div>

<section class="p-t-0 j-box ratio_asos">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="theme-tab">
                    <?= $xhtmlCategory ?>
                    <div class="tab-content-cls">
                        <?= $xhtmlBook ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick-view modal popup start-->
<?= FormFrontend::modalViewProduct() ?>
<!-- Quick-view modal popup end-->