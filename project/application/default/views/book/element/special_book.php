<?php 
$xhtmlBookSpecial = '';

// Duyệt mảng in ra các sách nổi bật ( `book`.`special` = 'yes' )
if (!empty($this->listItemsSpecial)) {
    $index = 1;
    foreach ($this->listItemsSpecial as $itemSpecial) {
        $linkInfoItem   = URL::createLink($this->arrParam['module'], 'book', 'item', ['bid' => $itemSpecial['book_id']]);
        if ($index == 1) {
            $xhtmlBookSpecial .= '<div>';
        }

        $img            = UPLOAD_BOOK_URL . $itemSpecial['picture'];
        $xhtmlBookSpecial .= '<div class="media">
                <a href="' . $linkInfoItem . '">
                    <img class="img-fluid blur-up lazyload" src="' . $img . '" alt="Special Book" style="width: 130px; height: 160px"></a>
                <div class="media-body align-self-center">
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>

                    <a href="' . $linkInfoItem . '">
                        <h6>' . $itemSpecial['book_name'] . '</h6>
                    </a>                        
                    <h4 class="text-lowercase">' . HelperFrontend::currencyVND($itemSpecial['price_discount']) . ' đ</h4>
                </div>
            </div>';
        $index++;
        if ($index == 5) {
            $xhtmlBookSpecial .= '</div>';
            $index = 1;
        }
    }
} else {
    $xhtmlBookSpecial = '<p class="font-weight-bold text-muted text-center">Đang cập nhật !</p>';
}
?>

<div class="theme-card">
    <h5 class="title-border">Sách nổi bật</h5>
    <div class="offer-slider slide-1">
        <?= $xhtmlBookSpecial ?>
    </div>
</div>