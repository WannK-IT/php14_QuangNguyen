<?php
class BookController extends Controller
{

	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('default/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
		Session::init();

		// Navbar
		$this->_view->categoriesNavbar 	= $this->_model->listItems($this->_arrParam, 'categoryNavbar');

		// Breadcrumb
		if ($this->_arrParam['action'] == 'list') {
			$this->_view->breadcrumb 		= '<span class="mx-1">TẤT CẢ SÁCH </span>';
			if (isset($this->_arrParam['cid'])) {
				$getCategoryName 			= $this->_model->singleItem($this->_arrParam, 'getCategoryName');
				$this->_view->breadcrumb 	= '<a href="' . URL::createLink($this->_arrParam['module'], $this->_arrParam['controller'], $this->_arrParam['action']) . '" class="mx-1" style="color: #5fcbc4">TẤT CẢ SÁCH </a>' . DS . '<span class="mx-1"> ' . $getCategoryName['name'] . '</span>';
			}
		} elseif ($this->_arrParam['action'] == 'item') {
			$getBookInfo = $this->_model->singleItem($this->_arrParam, 'getBookName');
			$this->_view->breadcrumb = '<a href="' . URL::createLink($this->_arrParam['module'], $this->_arrParam['controller'], 'list') . '" class="mx-1" style="color: #5fcbc4">TẤT CẢ SÁCH </a>' . DS . '<a href="' . URL::createLink($this->_arrParam['module'], $this->_arrParam['controller'], 'list', ['cid' => $getBookInfo['category_id']]) . '" class="mx-1" style="color: #5fcbc4"> ' . $getBookInfo['category_name'] . ' </a>' . DS . '<span class="mx-1"> ' . $getBookInfo['book_name'] . '</span>';
		}
	}

	public function listAction()
	{
		$title = (isset($this->_arrParam['cid'])) ? $this->_model->singleItem($this->_arrParam, 'getCategoryName')['name'] . ' | ' . 'BookStore' : 'BookStore';
		$this->_view->setTitle($title);
		@$totalItems = $this->_model->countItem($this->_arrParam);
		$this->_view->totalItems = $totalItems['total'];

		// Pagination
		$configPagination = ['totalItemsPerPage'	=> 12, 'pageRange' => 3];
		$this->setPagination($configPagination);
		@$this->_view->pagination	= new Pagination($totalItems['total'], $this->_pagination);

		$this->_view->listCategories 	= $this->_model->listItems($this->_arrParam, 'listCategories');
		$this->_view->listBooks 		= $this->_model->listItems($this->_arrParam, 'listBooks');
		$this->_view->listItemsSpecial 	= $this->_model->listItems($this->_arrParam, 'bookSpecial');
		$this->_view->render('book/list', true);
	}

	public function itemAction()
	{
		$title = $this->_model->singleItem($this->_arrParam, 'getBookName')['book_name'];
		$this->_view->setTitle($title . ' | BookStore');
		$this->_view->infoItem 			= $this->_model->singleItem($this->_arrParam, 'infoItem');
		$this->_view->listItemsSpecial 	= $this->_model->listItems($this->_arrParam, 'bookSpecial');
		$this->_view->listItemsNew 		= $this->_model->listItems($this->_arrParam, 'bookNew');
		$this->_view->listItemsRelate 	= $this->_model->listItems($this->_arrParam, 'listRelate');
		$this->_view->render('book/item', true);
	}

	public function ajaxLoadInfoAction()
	{
		$result = $this->_model->singleItem($this->_arrParam, 'ajaxModalView');
		echo json_encode($result);
	}

}
