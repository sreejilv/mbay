<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * For 
 * @package     Site
 * @subpackage  Base Extended
 * @category    Registration
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class News_model extends CI_Model {

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $data
     * @param type $status
     * @return type
     */
    public function addNews($user_id, $data, $status = 0) {
        $background_colors = array('white', 'red', 'yellow', 'white', 'green', 'blue', 'purple', 'green', 'red', 'orange', 'white', 'pink', 'azure', 'white');
        $color = $background_colors[array_rand($background_colors)];

        $month = date('F Y', strtotime(date("Y-m-d H:i:s")));
        $this->db->set('mlm_user_id ', $user_id)
                ->set('title', $data['news_title'])
                ->set('content ', $data['news_content'])
                ->set('image', $data['news_img'])
                ->set('status', $status)
                ->set('date', date("Y-m-d H:i:s"))
                ->set('month', $month)
                ->set('day_char', date("l"))
                ->set('day', date("d"))
                ->set('color', $color)
                ->insert('news');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $status
     * @param type $news_id
     * @param type $last_news
     * @return string
     */
    public function getAllNews($status = 0, $news_id = 0, $last_news = 0) {
        $background_colors = array('white', 'grey', 'red', 'yellow', 'green', 'blue', 'purple', 'dark', 'orange', 'pink', 'azure');

        $data = array();
        $this->db->select("id,title,content,image,mlm_user_id,date,month,day,color,day_char,status");
        $this->db->from("news");
        if ($status) {
            $this->db->where("status", $status);
        }
        if ($news_id) {
            $this->db->where("id", $news_id);
        }
        $this->db->order_by('id', 'DESC');
        if ($status) {
            $this->db->limit(15);
        }
        if ($last_news) {
            $this->db->where("id <", $last_news);
        }
        $res = $this->db->get();
        $i = 0;
        $month = '';
        foreach ($res->result() as $row) {
            $data[$i]['id'] = $row->id;
            $data[$i]['title'] = $row->title;
            $data[$i]['content'] = $row->content;
            $data[$i]['image'] = $row->image;
            $data[$i]['mlm_user_id'] = $row->mlm_user_id;
            $data[$i]['username'] = $this->helper_model->IdToUserName($row->mlm_user_id);
            $data[$i]['date'] = $row->date;
            $data[$i]['month'] = $row->month;
            if ($month != $row->month) {
                if ($i > 0 || $last_news) {
                    $data[$i]['new_month'] = 1;
                }
            }
            $month = $row->month;
            $data[$i]['day'] = $row->day;
            $data[$i]['day_char'] = $row->day_char;
            $data[$i]['status'] = $row->status;
            $color = $background_colors[$i % 11];

            $data[$i]['color'] = $color; //$row->color;
            $i++;
        }
        if ($news_id) {
            return $data[0];
        } else {

            return $data;
        }
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $news_id
     * @param type $status
     * @return type
     */
    public function changeNewsStatus($news_id, $status) {
        $this->db->set('status', $status)
                ->where('id', $news_id)
                ->update('news');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $news_id
     * @return type
     */
    public function deleteNews($news_id) {
        $this->db->where('id', $news_id)
                ->delete('news');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $data
     * @return type
     */
    public function updateNews($data) {
        $this->db->set('title', $data['news_title']);
        $this->db->set('content', $data['news_content']);
        if ($data['news_img']) {
            $this->db->set('image', $data['news_img']);
        }
        $this->db->where('id', $data['update_news']);
        $res = $this->db->update('news');
        if ($this->db->affected_rows() > 0) {
            return $res;
        }
        return false;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function countOfNewsList() {
        return $this->db->select('id')
                        ->from("news")
                        ->count_all_results();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnNewsList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'title', 'dt' => 1),
            array('db' => 'content', 'dt' => 2),
            array('db' => 'image', 'dt' => 3),
            array('db' => 'date', 'dt' => 4),
            array('db' => 'status', 'dt' => 5)
        );
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $where
     * @return type
     */
    function getTotalFilteredNewsList($table, $where) {
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $column
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataNewsList($table, $column, $where, $order, $limit) {
        $data = array();
        $query = $this->db->query("select " . implode(' , ', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the table column
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnViewNewsList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'title', 'dt' => 1),
            array('db' => 'content', 'dt' => 2),
            array('db' => 'image', 'dt' => 3),
            array('db' => 'date', 'dt' => 4)
        );
    }

    /**
     * For Filtered Data
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $where
     * @param type $user_id
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredViewNewsList($table, $where, $from_date, $to_date) {
        if ($where) {
            $where = $where . " AND status='1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
        } else {
            $where = " WHERE status='1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
        }
        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * For getting the Result data
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table     
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getResultDataViewNewsList($table, $column, $where, $order, $limit, $from_date, $to_date) {
        $data = array();
        if ($where) {
            $where = $where . " AND status='1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
        } else {
            $where = " WHERE  status='1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
        }
        $query = $this->db->query("select " . implode(' , ', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function countViewNewsList($from_date, $to_date) {
        return $this->db->select('id')
                        ->from('news')
                        ->where('date BETWEEN "' . $from_date . '" and "' . $to_date . '"')
                        ->count_all_results();
    }

    /**
     * For created News details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $enq_id
     * @return string
     */
    public function createNewsDetails($news_id) {
        $image = $content = $title = '';
        $query = $this->db->select('image,content,title')
                ->from('news')
                ->where('id', $news_id)
                ->limit(1)
                ->get();
        foreach ($query->result_array() as $row) {
            $image = $row['image'];
            $content = $row['content'];
            $title = $row['title'];
        }
        $data = '<div class="new_container"><div class = "centered"><h2 align="center">' . $title . '</h2></div>';
        if ($image) {
            $data .='<img src="assets/images/news/' . $image . '" alt="" style="width:690px;">';
        }
        $data .='<p>' . $content . '</p>';

        return $data;
    }

}
