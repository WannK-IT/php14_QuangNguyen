<?php 
$xhtmlPagination = '';
if($this->totalItems > 12){
    $xhtmlPagination = '<div class="product-pagination">
    <div class="theme-paggination-block">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <nav aria-label="Page navigation">
                        <nav>'.
                        $this->pagination->showPaginationFrontend(URL::createLink($this->arrParam['module'], $this->arrParam['controller'], $this->arrParam['action'], ['cid' => @$this->arrParam['cid'], 'sort' => @$this->arrParam['sort']])).
                        '</nav>
                    </nav>
                </div>
                <!-- <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="product-search-count-bottom">
                        <h5>Showing Items 1-12 of 55 Result</h5>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>';
}

echo $xhtmlPagination;
?>

