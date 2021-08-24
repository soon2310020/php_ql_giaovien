<?php
//models/Pagination.php
//Class phân trang
//ý tương của phân trang:
//giả sử trong bảng categories có 36 bản ghi
//và yêu cầu là hiển thị 10 bản ghi trên 1 trang
//-> tổng số trang cần tạo để chứa hết 36 bản ghi
// = ceil(36/10) = 4
//như vậy cần xác định các tham số sau
// - tổng số bản ghi: total
// - số bản ghi trên 1 trang: limit
//url phân trang sẽ có dạng sau, theo mô hình mvc
//index.php?controller=category&action=index&page=3
//- controller xử lý phân trang: controller
//- action xử lý phân trang: action
// - chế độ hiển thị phân trang: full_mode
class Pagination
{
    public $items;
    public $rowCount = 0;
    public $numberPerPage = 5;
    public $pageNumber = 1;
    public $checkLast = 0;
    public $pages;
    public $pageCount;
    public $items2;
    public $items3;

    /**
     * @return mixed
     */
    public function getItems3()
    {
        return $this->items3;
    }

    /**
     * @param mixed $items3
     */
    public function setItems3($items3)
    {
        $this->items3 = $items3;
    }

    /**
     * @return mixed
     */
    public function getItems2()
    {
        return $this->items2;
    }

    /**
     * @param mixed $items2
     */
    public function setItems2($items2)
    {
        $this->items2 = $items2;
    }

    public function setPageCount()
    {
        $this->pageCount=$this->getPageCount();
    }
    public function __construct()
    {
         $items=null;
        $rowCount = 40;
        $numberPerPage = 5;
        $pageNumber = 1;
         $checkLast = 0;
         $pages = $this->getPageList();

    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param mixed $pages
     */
    public function setPages()
    {
        $this->pages = $this->getPageList();
    }


    public function getPageList()
    {
        $pages = array();
        $from = $this->pageNumber - 4;
        $to = $this->pageNumber + 7;
        if ($from < 0) {
            $to -= $from;
            $from = 1;
        }

        if ($from < 1) {
            $from = 1;
        }

        if ($to > $this->getPageCount()) {
            $to = $this->getPageCount();
        }

        for ($i = $from; $i <= $to; ++$i) {
            array_push($pages,$i);
        }
        return $pages;
    }

    public function getPageCount()
    {
        return (ceil($this->rowCount /$this->numberPerPage));
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @return int
     */
    public function getRowCount()
    {
        return $this->rowCount;
    }

    /**
     * @param int $rowCount
     */
    public function setRowCount($rowCount)
    {
        $this->rowCount = $rowCount;
    }

    /**
     * @return int
     */
    public function getNumberPerPage()
    {
        return $this->numberPerPage;
    }

    /**
     * @param int $numberPerPage
     */
    public function setNumberPerPage($numberPerPage)
    {
        $this->numberPerPage = $numberPerPage;
    }

    /**
     * @return int
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    /**
     * @param int $pageNumber
     */
    public function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;
    }

    /**
     * @return int
     */
    public function getCheckLast()
    {
        return $this->checkLast;
    }

    /**
     * @param int $checkLast
     */
    public function setCheckLast($checkLast)
    {
        $this->checkLast = $checkLast;
    }

}
