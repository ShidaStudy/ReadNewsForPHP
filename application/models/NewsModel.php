<?php
include "BaseModel.php";

class NewsModel extends BaseModel {

    public function __construct() {
        // 加载数据库
        $this->load->database();
    }

    /**
     * 获取新闻列表
     * @param  [type] $limit [description]
     * @return [type]        [description]
     */
    public function getNews($start = false, $end = false) {

        // 分页查询
        if ($start !== false && $end !== false) {
            $query = $this->db->limit($end, $start)->get('news');
            return $query->result_array();
		}
        $query = $this->db->get('news');
        return $query->result_array();
    }
}



?>
