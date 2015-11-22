<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include 'Base.php';

class News extends Base {

	/**
	 * 分页条数
	 * @var integer
	 */
	private $_pageSize = 10;

	public function __construct() {
		parent::__construct();
	}

	/**
	 * 获取 新闻列表
	 * @return [type] [description]
	 */
	public function getNewsList() {

		// 接收参数
		$inputArr['pageNo'] = $this->getParam("pageNo", 1);
		// 去除不合法的参数
		foreach ($inputArr as $key => $value) {
			if ($value === false) {
				unset($inputArr[$key]);
			}
		}

		// 参数验证
		if (is_empty($inputArr['pageNo']) || !is_int_number($inputArr['pageNo'])) {
			json_return(1010, "pageNo不能为空，且pageNo必须为整数");
		}

		// 加载NewsModel
		$this->load->model("newsModel");
		// 计算页码
		$start = page_start($inputArr['pageNo'], $this->_pageSize);
		$end = $start + $this->_pageSize;
		$newsArr = $this->newsModel->getNews($start, $end);

		// 返回正常结果
		json_return(1001, $newsArr);
	}
}
