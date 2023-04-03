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
class Report_model extends CI_Model {

    /**
     * For getting the total Data Limit
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies 
     * @param type $request
     * @return string
     */
    function getTotalDataLimit($request) {
        $limit = '';
        if (isset($request['start']) && $request['length'] != -1) {
            $limit = "LIMIT " . intval($request['start']) . ", " . intval($request['length']);
        }
        return $limit;
    }

    /**
     * For getting the table column
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumn() {
        return array(
            array('db' => 'm.user_id', 'dt' => 0),
            array('db' => 'u1.user_name', 'dt' => 1),
            array('db' => 'u3.first_name', 'dt' => 2),
            array('db' => 'u1.sponsor_id', 'dt' => 3),
            array('db' => 'u1.email', 'dt' => 4),
            array('db' => 'u1.date', 'dt' => 5),
            array('db' => 'u3.phone_number', 'dt' => 6),
            array('db' => 'u3.date_of_birth', 'dt' => 7),
            array('db' => 'u3.gender', 'dt' => 8),
            array('db' => 'u3.address_1', 'dt' => 9),
            array('db' => 'u3.country_id', 'dt' => 10),
            array('db' => 'u3.state_id', 'dt' => 11),
            array('db' => 'u3.city', 'dt' => 12),
            array('db' => 'u3.zip_code', 'dt' => 13),
            array('db' => 'u3.last_name', 'dt' => 14)
        );
    }

    /**
     * For getting the Total Order Report
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $request
     * @param type $columns
     * @return string
     */
    function getTotalDataOrderReport($request, $columns) {
        $order = '';
        $dtColumns = $this->pluck($columns, 'dt');
        if (isset($request['order']) && count($request['order'])) {
            $orderBy = '';
            for ($i = 0, $ien = count($request['order']); $i < $ien; $i++) {
                $columnIdx = intval($request['order'][$i]['column']);
                $requestColumn = $request['columns'][$columnIdx];
                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $columns[$columnIdx];
                if ($requestColumn['orderable'] == 'true') {
                    $dir = $request['order'][$i]['dir'] === 'asc' ? 'ASC' : 'DESC';

                    $orderBy = '`' . $column['db'] . '` ' . $dir;
                }
            }
            $order = 'ORDER BY ' . implode(', ', $orderBy);
        }
        return $order;
    }

    /**
     * For getting the Data where condition
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $request
     * @param type $columns
     * @return string
     */
    function getTotalDataWhere($request, $columns) {
        $where = '';
        $dtColumns = $this->pluck($columns, 'dt');
        if (isset($request['search']) && $request['search']['value'] != '') {
            $str = $request['search']['value'];
            for ($i = 0, $ien = count($request['columns']); $i < $ien; $i++) {
                $requestColumn = $request['columns'][$i];
                $columnIdx = array_search($requestColumn['data'], $dtColumns);
                $column = $columns[$columnIdx];
                if ($requestColumn['searchable'] == 'true' && $str != '') {
                    $where .= " `" . $column['db'] . "` LIKE " . '"%' . $str . '%" or';
                }
            }
            if ($where) {
                $where = 'where' . ' (' . rtrim($where, 'or') . ')';
            }
        }
        return $where;
    }

    /**
     * For Filtered Data
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $user_id
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredTotalJoin($table1, $table2, $table3, $where, $from_date, $to_date, $user_id) {

        if ($where) {


            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . " AND u1.user_status = 'active' ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND u1.user_status = 'active' AND u1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND u1.user_status = 'active' AND m.path = $user_id ";
            } else {
                $where = $where . " AND u1.user_status = 'active' AND m.path = $user_id AND t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
            }
        } else {



            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = " WHERE u1.user_status = 'active' ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE u1.user_status = 'active' AND u1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE u1.user_status = 'active' AND m.path = $user_id ";
            } else {
                $where = " WHERE u1.user_status = 'active' AND m.path = $user_id AND u1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
            }
        }
        $query = $this->db->query("SELECT m.id FROM " . $table1 . " AS `m`
JOIN " . $table2 . " AS `u1` ON `m`.`user_id` = `u1`.`mlm_user_id`
JOIN " . $table2 . " AS `u2` ON `m`.`path` = `u2`.`mlm_user_id` JOIN " . $table3 . " AS `u3` ON `m`.`user_id` = `u3`.`mlm_user_id` " . $where);
        return $query->num_rows();
    }

    function getResultDataTotalJoin($table1, $table2, $table3, $where, $order, $limit, $from_date, $to_date, $user_id) {
        $data = array();
        if ($where) {


            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . " AND u1.user_status = 'active' ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND u1.user_status = 'active' AND u1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND u1.user_status = 'active' AND m.path = $user_id ";
            } else {
                $where = $where . " AND u1.user_status = 'active' AND m.path = $user_id AND u1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
            }
        } else {



            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = " WHERE u1.user_status = 'active' ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE u1.user_status = 'active' AND u1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE u1.user_status = 'active' AND m.path = $user_id ";
            } else {
                $where = " WHERE u1.user_status = 'active' AND m.path = $user_id AND u1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
            }
        }
//        echo "SELECT m.id, u1.user_name AS `user_id`,u3.first_name,u1.sponsor_id AS `path` ,u1.email,u1.date,u3.phone_number,u3.date_of_birth,u3.gender,u3.address_1,u3.country_id,u3.state_id,u3.zip_code,u3.last_name
//FROM " . $table1 . " AS `m`
//JOIN " . $table2 . " AS `u1` ON `m`.`user_id` = `u1`.`mlm_user_id` JOIN " . $table3 . " AS `u3` ON `m`.`user_id` = `u3`.`mlm_user_id`" . $where . " " . $order . " " . $limit;die;

        $query = $this->db->query("SELECT m.id, u1.user_name AS `user_id`,u3.first_name,u1.sponsor_id AS `path` ,u1.email,u1.date,u3.phone_number,u3.date_of_birth,u3.gender,u3.address_1,u3.country_id,u3.state_id,u3.city,u3.zip_code,u3.last_name
FROM " . $table1 . " AS `m`
JOIN " . $table2 . " AS `u1` ON `m`.`user_id` = `u1`.`mlm_user_id` JOIN " . $table3 . " AS `u3` ON `m`.`user_id` = `u3`.`mlm_user_id`" . $where . " " . $order . " " . $limit);


        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

 
    public function IdToCountryName($id) {
        $country_name = NULL;
        $query = $this->db->select('country_name')
                ->where('id', $id)
                ->limit(1)
                ->get('countries');
        if ($query->num_rows() > 0) {
            $country_name = $query->row()->country_name;
        }
        return $country_name;
    }
    
    public function IdToStateName($country_id) {
        $state_name = NULL;
        $query = $this->db->select('state_name')
                ->from("states")
                ->where("status", '1')
                ->where('country_id', $country_id)
                ->get();
        if ($query->num_rows() > 0) {
            $state_name = $query->row()->state_name;
        }
        return $state_name;
    }
    

    /**
     * For getting the count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @return type
     */
    function countTotalJoin($user_id) {
        return $this->db->select('user_id')
                        ->from('traverse_sponsor')
                        ->where("path", $user_id)
                        ->count_all_results();
    }

    /**
     * For getting the COUNT Date
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $from_date
     * @param type $to_date
     * @return type
     */


    function countDateJoin($table1, $table2, $from_date, $to_date, $user_id) {

        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = " WHERE t2.user_status = 'active' ";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE t2.user_status = 'active' AND t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        } elseif ($user_id && $from_date == '' && $to_date == '') {
            $where = " WHERE t2.user_status = 'active' AND t1.path = $user_id ";
        } else {
            $where = " WHERE t2.user_status = 'active' AND t1.path = $user_id AND t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
        }

        $query = $this->db->query("select t1.user_id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.user_id = t2.mlm_user_id " . $where . " ");


        return $query->num_rows();
    }



    /**
     * 
     * For total amount commission
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $user_id
     * @param type $table
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function totalAmountCommission($table, $from_date, $to_date, $user_id) {
        $amount = 0;
        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = " WHERE type = 'credit' AND `bonus_flag` = '1' ";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE type = 'credit' AND `bonus_flag` = '1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        } elseif ($user_id && $from_date == '' && $to_date == '') {
            $where = " WHERE type = 'credit' AND `bonus_flag` = '1' AND mlm_user_id = $user_id ";
        } else {
            $where = " WHERE type = 'credit' AND `bonus_flag` = '1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND mlm_user_id = $user_id  GROUP BY mlm_user_id ASC, wallet_type ";
        }

        $query = $this->db->query("select SUM(amount1) as t1 ,SUM(amount2) as t2 from " . $table . " " . $where);

        foreach ($query->result() as $row) {
            $amount = $row->t1 + $row->t2;
        }
        return round($amount, 8);
    }

    /**
     * For getting the Report commission COUNT
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $from_date
     * @param type $to_date
     * @return type
     */


    function getTableColumnReortCommission() {
        return array(
            array('db' => 't1.mlm_user_id', 'dt' => 0),
            array('db' => 't2.user_name', 'dt' => 1),
            array('db' => 't3.first_name', 'dt' => 2),
            array('db' => 't1.wallet_type', 'dt' => 3),
            array('db' => 't3.last_name', 'dt' => 4)
        );
    }

    /**
     * For getting the Report commission COUNT
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function countRportCommission($table, $from_date, $to_date, $user_id) {

        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = " WHERE type = 'credit' AND `bonus_flag` = '1' GROUP BY mlm_user_id , wallet_type ";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE type = 'credit' AND `bonus_flag` = '1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' GROUP BY mlm_user_id , wallet_type ";
        } elseif ($user_id && $from_date == '' && $to_date == '') {
            $where = " WHERE type = 'credit' AND `bonus_flag` = '1' AND mlm_user_id = $user_id GROUP BY mlm_user_id , wallet_type ";
        } else {
            $where = " WHERE type = 'credit' AND `bonus_flag` = '1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND mlm_user_id = $user_id  GROUP BY mlm_user_id , wallet_type ";
        }


        //$where = " WHERE type = 'credit' AND `bonus_flag` = '1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' GROUP BY mlm_user_id ASC, wallet_type ";
        $query = $this->db->query("select mlm_user_id from " . $table . " " . $where);
        return $query->num_rows();
    }

    /**
     * For getting the filtered commission report
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $where
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredReportCommission($table1, $table2, $table3, $where, $from_date, $to_date, $user_id) {
        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . " AND t1.type = 'credit' AND `bonus_flag` = '1' GROUP BY t1.mlm_user_id ASC, t1.wallet_type ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.type = 'credit' AND `bonus_flag` = '1' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'GROUP BY t1.mlm_user_id ASC, t1.wallet_type ";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.type = 'credit' AND `bonus_flag` = '1' AND t1.mlm_user_id = $user_id GROUP BY t1.mlm_user_id ASC, t1.wallet_type ";
            } else {
                $where = $where . " AND t1.type = 'credit' AND `bonus_flag` = '1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id  GROUP BY t1.mlm_user_id ASC, wallet_type ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = " WHERE t1.type = 'credit' AND `bonus_flag` = '1' GROUP BY t1.mlm_user_id ASC, t1.wallet_type ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE t1.type = 'credit' AND `bonus_flag` = '1' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'GROUP BY t1.mlm_user_id ASC, t1.wallet_type ";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE t1.type = 'credit' AND `bonus_flag` = '1' AND t1.mlm_user_id = $user_id GROUP BY t1.mlm_user_id ASC, t1.wallet_type ";
            } else {
                $where = " WHERE t1.type = 'credit' AND `bonus_flag` = '1' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id  GROUP BY t1.mlm_user_id ASC, t1.wallet_type ";
            }
        }
        $query = $this->db->query("select t1.mlm_user_id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id INNER JOIN " . $table3 . " As t3 ON t1.mlm_user_id=t3.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }

    /**
     * For getting the commission report details
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
    function getResultDataReportCommission($table1, $table2, $table3, $where, $order, $limit, $from_date, $to_date, $user_id) {
        $data = array();
        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . " AND t1.type = 'credit' AND `bonus_flag` = '1' GROUP BY t1.mlm_user_id ASC, t1.wallet_type, t3.first_name, t3.last_name ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.type = 'credit' AND `bonus_flag` = '1' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'GROUP BY t1.mlm_user_id ASC, t1.wallet_type, t3.first_name, t3.last_name ";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.type = 'credit' AND `bonus_flag` = '1' AND t1.mlm_user_id = $user_id GROUP BY t1.mlm_user_id ASC, t1.wallet_type , t3.first_name, t3.last_name t3.first_name, t3.last_name";
            } else {
                $where = $where . " AND t1.type = 'credit' AND `bonus_flag` = '1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id  GROUP BY t1.mlm_user_id ASC, wallet_type,t3.first_name, t3.last_name";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = " WHERE t1.type = 'credit' AND `bonus_flag` = '1' GROUP BY t1.mlm_user_id ASC, t1.wallet_type,t3.first_name, t3.last_name ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE t1.type = 'credit' AND `bonus_flag` = '1' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'GROUP BY t1.mlm_user_id ASC, t1.wallet_type,t3.first_name, t3.last_name ";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE t1.type = 'credit' AND `bonus_flag` = '1' AND t1.mlm_user_id = $user_id GROUP BY t1.mlm_user_id ASC, t1.wallet_type,t3.first_name, t3.last_name ";
            } else {
                $where = " WHERE t1.type = 'credit' AND `bonus_flag` = '1' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id  GROUP BY t1.mlm_user_id ASC, t1.wallet_type, t3.first_name, t3.last_name ";
            }
        }

        $query = $this->db->query("select t1.mlm_user_id,t2.user_name,t3.first_name,t1.wallet_type,t3.last_name from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id INNER JOIN " . $table3 . " AS t3 ON t1.mlm_user_id=t3.mlm_user_id " . $where . $order . " " . $limit);


        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * 
     * For table column report orders
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */


    function getTableColumnReortOrders() {
        return array(
            array('db' => 't1.id', 'dt' => 0),
            array('db' => 't2.user_name', 'dt' => 1),
            array('db' => 't3.first_name', 'dt' => 2),
            array('db' => 't1.total_amount', 'dt' => 3),
            array('db' => 't1.product_count', 'dt' => 4),
            array('db' => 't1.order_date', 'dt' => 5),
            array('db' => 't3.last_name', 'dt' => 6),
        );
    }

    /**
     * For COUNT report orders
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function countRportOrders($table, $from_date, $to_date, $user_id) {
        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = " WHERE order_status = '1'";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE order_status = '1' AND order_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        } elseif ($user_id && $from_date == '' && $to_date == '') {
            $where = " WHERE order_status = '1' AND user_id = $user_id ";
        } else {
            $where = " WHERE order_status = '1' AND order_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND user_id = $user_id ";
        }



        $query = $this->db->query("select id from " . $table . " " . $where);
        return $query->num_rows();
    }

    /**
     * For getting the filtered order report
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredReportOrders($table1, $table2, $table3, $where, $from_date, $to_date, $user_id) {
        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . " AND order_status = '1'";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND order_status = '1' AND order_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND order_status = '1' AND user_id = $user_id ";
            } else {
                $where = $where . " AND order_status = '1' AND order_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND user_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = " WHERE order_status = '1'";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE order_status = '1' AND order_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE order_status = '1' AND user_id = $user_id ";
            } else {
                $where = " WHERE order_status = '1' AND order_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND user_id = $user_id ";
            }
        }
        //$query = $this->db->query("select * from " . $table . " " . $where);

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.user_id = t2.mlm_user_id INNER JOIN " . $table3 . " As t3 ON t1.user_id=t3.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }

    /**
     * For getting the result all order details
     * 
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
    function getResultDataReportOrders($table1, $table2, $table3, $where, $order, $limit, $from_date, $to_date, $user_id) {
        $data = array();


        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . " AND order_status = '1'";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND order_status = '1' AND order_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND order_status = '1' AND user_id = $user_id ";
            } else {
                $where = $where . " AND order_status = '1' AND order_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND user_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = " WHERE order_status = '1'";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE order_status = '1' AND order_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE order_status = '1' AND user_id = $user_id ";
            } else {
                $where = " WHERE order_status = '1' AND order_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND user_id = $user_id ";
            }
        }



        $query = $this->db->query("select t1.id,t2.user_name,t3.first_name,t1.total_amount,t1.product_count,t1.order_date,t3.last_name from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.user_id = t2.mlm_user_id INNER JOIN " . $table3 . " AS t3 ON t1.user_id=t3.mlm_user_id " . $where . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the all product details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $order_id
     * @return string
     */
    function getAllProductDetails($order_id) {
        $data = array();
        $details = '';
        $query = $this->db->select("amount,quantity,product_id")
                ->from("order_products")
                ->where("order_id", $order_id)
                ->get();
        $i = 0;
        foreach ($query->result_array() as $row) {
            $data[$i]['amount'] = $row['amount'];
            $data[$i]['quantity'] = $row['quantity'];
            $data[$i]['product_name'] = $this->getProductName($row['product_id']);
            $details = $details . "" . $data[$i]['product_name'] . "(" . $data[$i]['quantity'] . ") - " . round($data[$i]['amount'], 8) . ",<br>";
            $i++;
        }
        return $details;
    }

    /**
     * For getting the product name based on Product ID
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $id
     * @return type
     */
    public function getProductName($id) {
        $product_name = '';
        $query = $this->db->select("product_name")
                ->where("id", $id)
                ->limit(1)
                ->get("products");
        if ($query->num_rows() > 0) {
            $product_name = $query->row()->product_name;
        }
        return $product_name;
    }

    /**
     * For getting the count of total balance
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function countOfTotalBalance($table1, $table2, $from_date, $to_date, $user_id) {
        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = " WHERE t1.user_status = 'active' ";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE t1.user_status = 'active' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        } elseif ($user_id && $from_date == '' && $to_date == '') {
            $where = " WHERE t1.user_status = 'active' AND t1.mlm_user_id = $user_id ";
        } else {
            $where = " WHERE t1.user_status = 'active' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id ";
        }


        $query = $this->db->query("select t1.mlm_user_id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id " . $where . " ");

        return $query->num_rows();
    }

    /**
     * For getting the Table name
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnReortBalance() {
        return array(
            array('db' => 't2.id', 'dt' => 0),
            array('db' => 't1.user_name', 'dt' => 1),
            array('db' => 't2.total_amount', 'dt' => 2),
            array('db' => 't2.released_amount', 'dt' => 3),
            array('db' => 't2.balance_amount', 'dt' => 4),
            array('db' => 't1.date', 'dt' => 5)
        );
    }

    /**
     * For getting the total balance filtered data
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredTotalBalance($table1, $table2, $where, $from_date, $to_date, $user_id) {
        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . " AND t1.user_status = 'active' ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.user_status = 'active' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.user_status = 'active' AND t1.mlm_user_id = $user_id ";
            } else {
                $where = $where . " AND t1.user_status = 'active' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = " WHERE t1.user_status = 'active' ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE t1.user_status = 'active' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE t1.user_status = 'active' AND t1.mlm_user_id = $user_id ";
            } else {
                $where = " WHERE t1.user_status = 'active' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id ";
            }
        }

        $query = $this->db->query("select t1.mlm_user_id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }

    /**
     * For getting the Details of total balance 
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getResultDataTotalBalance($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id) {
        $data = array();


        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . " AND t1.user_status = 'active' ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.user_status = 'active' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.user_status = 'active' AND t1.mlm_user_id = $user_id ";
            } else {
                $where = $where . " AND t1.user_status = 'active' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = " WHERE t1.user_status = 'active' ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE t1.user_status = 'active' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE t1.user_status = 'active' AND t1.mlm_user_id = $user_id ";
            } else {
                $where = " WHERE t1.user_status = 'active' AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id ";
            }
        }

        $query = $this->db->query("select t1.mlm_user_id,t1.user_name,t2.total_amount,t2.released_amount,t2.balance_amount,t1.date from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id  " . $where . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the column  history report
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnReortHistory() {
        return array(
            array('db' => 't2.id', 'dt' => 0),
            array('db' => 't1.user_name', 'dt' => 1),
            array('db' => 't2.activity', 'dt' => 2),
            array('db' => 't2.date', 'dt' => 3),
            array('db' => 't2.ip_address', 'dt' => 4),
            array('db' => 't2.country', 'dt' => 5),
            array('db' => 't2.region', 'dt' => 6),
            array('db' => 't2.city', 'dt' => 7),
            array('db' => 't2.user_agent', 'dt' => 8)
        );
    }

    /**
     * For getting the count of total history
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function countOfTotalHistory($table1, $table2, $from_date, $to_date, $user_id) {
        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = "  ";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE  t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        } elseif ($user_id && $from_date == '' && $to_date == '') {
            $where = " WHERE  t2.mlm_user_id = $user_id ";
        } else {
            $where = " WHERE  t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t2.mlm_user_id = $user_id ";
        }


        $query = $this->db->query("select t2.mlm_user_id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id " . $where . " ");

        return $query->num_rows();
    }

    /**
     * For getting the Total Filtered History report
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredTotalHistory($table1, $table2, $where, $from_date, $to_date, $user_id) {
        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t2.mlm_user_id = $user_id ";
            } else {
                $where = $where . " AND t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t2.mlm_user_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t2.mlm_user_id = $user_id ";
            } else {
                $where = " WHERE  t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t2.mlm_user_id = $user_id ";
            }
        }

        $query = $this->db->query("select t2.mlm_user_id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }

    /**
     * For getting the Activity History
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getResultDataTotalHistory($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id) {
        $data = array();


        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t2.mlm_user_id = $user_id ";
            } else {
                $where = $where . " AND t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t2.mlm_user_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t2.mlm_user_id = $user_id ";
            } else {
                $where = " WHERE  t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t2.mlm_user_id = $user_id ";
            }
        }



        $query = $this->db->query("select t2.mlm_user_id,t1.user_name,t2.activity,t2.date,t2.ip_address,t2.country,t2.region,t2.city,t2.user_agent from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id  " . $where . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the user commission details sql condition
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredReportCommissionUser($table, $where, $from_date, $to_date) {
        $user_id = $this->aauth->getId();
        if ($where) {
            $where = $where . " AND mlm_user_id=$user_id AND type = 'credit' AND `bonus_flag` = '1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' GROUP BY mlm_user_id ASC, wallet_type ";
        } else {
            $where = " WHERE mlm_user_id=$user_id AND type = 'credit' AND `bonus_flag` = '1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' GROUP BY mlm_user_id ASC, wallet_type ";
        }
        $query = $this->db->query("select * from " . $table . " " . $where);
        return $query->num_rows();
    }

    /**
     * For getting the details
     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getResultDataReportCommissionUser($table, $where, $order, $limit, $from_date, $to_date) {
        $data = array();
        $user_id = $this->aauth->getId();
        if ($where) {
            $where = $where . " AND mlm_user_id=$user_id AND type = 'credit' AND `bonus_flag` = '1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' GROUP BY mlm_user_id ASC, wallet_type ";
        } else {
            $where = " WHERE mlm_user_id=$user_id AND type = 'credit' AND `bonus_flag` = '1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' GROUP BY mlm_user_id ASC, wallet_type ";
        }
        $query = $this->db->query("select id,mlm_user_id,date,wallet_type,amount1,amount2 from " . $table . " " . $where . " " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * Sql statement for getting the order user
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredReportOrdersUser($table, $where, $from_date, $to_date) {
        $user_id = $this->aauth->getId();
        if ($where) {
            $where = $where . " AND user_id=$user_id AND order_status = '1' AND order_date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
        } else {
            $where = " WHERE  user_id=$user_id AND  order_status = '1' AND order_date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
        }
        $query = $this->db->query("select * from " . $table . " " . $where);
        return $query->num_rows();
    }

    /**
     * 
     * For getting the user order details
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
    function getResultDataReportOrdersUser($table, $where, $order, $limit, $from_date, $to_date) {
        $data = array();
        $user_id = $this->aauth->getId();
        if ($where) {
            $where = $where . "  AND user_id=$user_id AND order_status = '1' AND order_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        } else {
            $where = " WHERE  user_id=$user_id AND  order_status = '1' AND order_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'  ";
        }
        $query = $this->db->query("select id,user_id,total_amount,product_count,order_date,payment_type from " . $table . " " . $where . " " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the user order history
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredTotalHistoryUser($table1, $table2, $where, $from_date, $to_date) {
        $user_id = $this->aauth->getId();
        if ($where) {
            $where = $where . " AND t2.mlm_user_id=$user_id AND  t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND ";
        } else {
            $where = " WHERE t2.mlm_user_id=$user_id AND t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND ";
        }


        $query = $this->db->query("select t1.mlm_user_id,t1.user_name,t2.activity,t2.date from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id");
        return $query->num_rows();
    }

    /**
     * For  sql statement for Total History users
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getResultDataTotalHistoryUser($table1, $table2, $where, $order, $limit, $from_date, $to_date) {
        $user_id = $this->aauth->getId();
        $data = array();
        if ($where) {
            $where = $where . " AND t2.mlm_user_id=$user_id AND  t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND ";
        } else {
            $where = " WHERE t2.mlm_user_id=$user_id AND t2.date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND ";
        }



        $query = $this->db->query("select t1.mlm_user_id,t1.user_name,t2.activity,t2.date,t2.ip_address,t2.country,t2.region,t2.city,t2.user_agent from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.mlm_user_id = t2.mlm_user_id " . $order . " " . $limit);


        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * 
     * For count user history details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function countOfTotalHistoryUser($from_date, $to_date) {
        $user_id = $this->aauth->getId();
        return $this->db->select('t1.mlm_user_id')
                        ->from('user AS t1')
                        ->join("activity as t2", 't1.mlm_user_id = t2.mlm_user_id', 'inner')
                        ->where('t2.date BETWEEN "' . $from_date . '" and "' . $to_date . '"')
                        ->where('t2.mlm_user_id', $user_id)
                        ->count_all_results();
    }

    /**
     * For user order details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function countRportOrdersUser($table, $from_date, $to_date) {
        $user_id = $this->aauth->getId();
        $where = " WHERE user_id=$user_id AND order_status = '1' AND order_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        $query = $this->db->query("select user_id from " . $table . " " . $where);
        return $query->num_rows();
    }

    /**
     * For getting the count of user   commission
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function countRportCommissionUser($table, $from_date, $to_date) {
        $user_id = $this->aauth->getId();
        $where = " WHERE mlm_user_id=$user_id AND type = 'credit' AND `bonus_flag` = '1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' GROUP BY mlm_user_id ASC, wallet_type ";
        $query = $this->db->query("select mlm_user_id from " . $table . " " . $where);
        return $query->num_rows();
    }

    /**
     * For getting the count of Employee's active
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function countOfEmployeeActive($table1, $table2, $from_date, $to_date, $user_id) {

        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = "  ";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        } elseif ($user_id && $from_date == '' && $to_date == '') {
            $where = " WHERE  t1.employee_id = $user_id ";
        } else {
            $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.employee_id = $user_id ";
        }


        $query = $this->db->query("select t2.employee_id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.employee_id = t2.employee_id " . $where . " ");

        return $query->num_rows();
    }

    /**
     * For getting the Employee table column name
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnEmployee() {
        return array(
            array('db' => 't1.employee_id', 'dt' => 0),
            array('db' => 't1.user_name', 'dt' => 1),
            array('db' => 't2.email', 'dt' => 2),
            array('db' => 't2.phone', 'dt' => 3),
            array('db' => 't2.address', 'dt' => 4),
            array('db' => 't2.first_name', 'dt' => 5),
            array('db' => 't2.last_name', 'dt' => 6),
            array('db' => 't1.status', 'dt' => 7)
        );
    }

    /**
     * For getting the Inactive Employee 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @return type
     */
    function getTotalFilteredEmployeeActive($table1, $table2, $where, $from_date, $to_date, $user_id) {
        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.employee_id = $user_id ";
            } else {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.employee_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t1.employee_id = $user_id ";
            } else {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.employee_id = $user_id ";
            }
        }

        $query = $this->db->query("select t2.employee_id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.employee_id = t2.employee_id " . $where . " ");
        return $query->num_rows();
    }

    /**
     * For getting the sql statement for getting the active employee details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataEmployeeActive($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id) {
        $data = array();


        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.employee_id = $user_id ";
            } else {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.employee_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t1.employee_id = $user_id ";
            } else {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.employee_id = $user_id ";
            }
        }



        $query = $this->db->query("select t2.employee_id,t1.user_name,t2.email,t2.phone,t2.address,t2.first_name,t2.last_name,t1.status from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.employee_id = t2.employee_id  " . $where . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the count of cron list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function countOfCronList($table, $from_date, $to_date, $user_id) {

        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = "  ";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE  date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
        } else {
            $where = " WHERE  date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
        }


        $query = $this->db->query("select id from " . $table . " " . $where . " ");

        return $query->num_rows();
    }

    /**
     * For getting the table column name for cron list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnCronList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'cron_job', 'dt' => 1),
            array('db' => 'ip', 'dt' => 2),
            array('db' => 'date', 'dt' => 3),
            array('db' => 'status', 'dt' => 4)
        );
    }

    /**
     * For getting the filtered Cron List
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @return type
     */
    function getTotalFilteredCronList($table, $where, $from_date, $to_date, $user_id) {
        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
            } else {
                $where = $where . " AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
            } else {
                $where = " WHERE  date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
            }
        }

        $query = $this->db->query("select id from " . $table . " " . $where . " ");
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

    function getResultDataCronList($table,$column, $where, $order, $limit, $from_date, $to_date, $user_id) {
        $data = array();

if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
            } else {
                $where = $where . " AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
            } else {
                $where = " WHERE  date BETWEEN '" . $from_date . "' AND '" . $to_date . "' ";
            }
        }


        $query = $this->db->query("select " . implode(',', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the affiliates history table column name
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnReortHistoryAffiliates() {
        return array(
            array('db' => 't1.id', 'dt' => 0),
            array('db' => 't2.username', 'dt' => 1),
            array('db' => 't1.activity', 'dt' => 2),
            array('db' => 't1.date', 'dt' => 3),
            array('db' => 't1.ip_address', 'dt' => 4),
            array('db' => 't1.country', 'dt' => 5),
            array('db' => 't1.region', 'dt' => 6),
            array('db' => 't1.city', 'dt' => 7),
            array('db' => 't1.user_agent', 'dt' => 8)
        );
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function countOfTotalHistoryAffiliates($table1, $table2, $from_date, $to_date, $user_id) {

        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = "  ";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        } elseif ($user_id && $from_date == '' && $to_date == '') {
            $where = " WHERE  t1.affiliate_id = $user_id ";
        } else {
            $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.affiliate_id = $user_id ";
        }


        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.affiliate_id = t2.id " . $where . " ");

        return $query->num_rows();
    }
    function countOfTotalHistoryAffiliatesUser($table1, $table2, $from_date, $to_date, $user_id) {

        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = "  ";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        } elseif ($user_id && $from_date == '' && $to_date == '') {
            $where = " WHERE  t2.sponser_id = $user_id ";
        } else {
            $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t2.sponser_id = $user_id ";
        }


        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.affiliate_id = t2.id " . $where . " ");

        return $query->num_rows();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredTotalHistoryAffiliates($table1, $table2, $where, $from_date, $to_date, $user_id) {
        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.affiliate_id = $user_id ";
            } else {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.affiliate_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t1.affiliate_id = $user_id ";
            } else {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.affiliate_id = $user_id ";
            }
        }

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.affiliate_id = t2.id " . $where . " ");
        return $query->num_rows();
    }
    function getTotalFilteredTotalHistoryAffiliatesUser($table1, $table2, $where, $from_date, $to_date, $user_id) {
        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t2.sponser_id = $user_id ";
            } else {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t2.sponser_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t2.sponser_id = $user_id ";
            } else {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t2.sponser_id = $user_id ";
            }
        }

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.affiliate_id = t2.id " . $where . " ");
        return $query->num_rows();
    }

    /**
     * For sql statements for total affiliates history details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getResultDataTotalHistoryAffiliates($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id) {
        $data = array();


        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.affiliate_id = $user_id ";
            } else {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.affiliate_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t1.affiliate_id = $user_id ";
            } else {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.affiliate_id = $user_id ";
            }
        }



        $query = $this->db->query("select t1.id,t2.username,t1.activity,t1.date,t1.ip_address,t1.country,t1.region,t1.city,t1.user_agent from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.affiliate_id = t2.id  " . $where . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }
    function getResultDataTotalHistoryAffiliatesUser($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id) {
        $data = array();


        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t2.sponser_id = $user_id ";
            } else {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t2.sponser_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t2.sponser_id = $user_id ";
            } else {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t2.sponser_id = $user_id ";
            }
        }



        $query = $this->db->query("select t1.id,t2.username,t1.activity,t1.date,t1.ip_address,t1.country,t1.region,t1.city,t1.user_agent from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.affiliate_id = t2.id  " . $where . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * For getting the table name for Employee history column name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnEmployeeReortHistory() {
        return array(
            array('db' => 't1.id', 'dt' => 0),
            array('db' => 't2.user_name', 'dt' => 1),
            array('db' => 't1.activity', 'dt' => 2),
            array('db' => 't1.date', 'dt' => 3),
            array('db' => 't1.ip_address', 'dt' => 4),
            array('db' => 't1.country', 'dt' => 5),
            array('db' => 't1.region', 'dt' => 6),
            array('db' => 't1.city', 'dt' => 7),
            array('db' => 't1.user_agent', 'dt' => 8)
        );
    }

    /**
     * For getting the count of total employee history report
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function countOfTotalEmployeeHistory($table1, $table2, $from_date, $to_date, $user_id) {

        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = "  ";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        } elseif ($user_id && $from_date == '' && $to_date == '') {
            $where = " WHERE  t1.employee_id = $user_id ";
        } else {
            $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.employee_id = $user_id ";
        }


        $query = $this->db->query("select t2.employee_id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.employee_id = t2.employee_id " . $where . " ");

        return $query->num_rows();
    }

    /**
     * For getting the sql statement for Employee History
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getTotalFilteredTotalEmployeeHistory($table1, $table2, $where, $from_date, $to_date, $user_id) {
        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.employee_id = $user_id ";
            } else {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.employee_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t1.employee_id = $user_id ";
            } else {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.employee_id = $user_id ";
            }
        }

        $query = $this->db->query("select t2.employee_id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.employee_id = t2.employee_id " . $where . " ");
        return $query->num_rows();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $where
     * @param type $order
     * @param type $limit
     * @param type $from_date
     * @param type $to_date
     * @return type
     */
    function getResultDataTotalEmployeeHistory($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id) {
        $data = array();


        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.employee_id = $user_id ";
            } else {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.employee_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t1.employee_id = $user_id ";
            } else {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.employee_id = $user_id ";
            }
        }



        $query = $this->db->query("select t1.id,t2.user_name,t1.activity,t1.date,t1.ip_address,t1.country,t1.region,t1.city,t1.user_agent from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.employee_id = t2.employee_id  " . $where . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function countOfAffiliatesActive($table1, $table2, $from_date, $to_date, $user_id) {

        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = "  ";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE  t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        } elseif ($user_id && $from_date == '' && $to_date == '') {
            $where = " WHERE  t1.id = $user_id ";
        } else {
            $where = " WHERE  t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.id = $user_id ";
        }


        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.sponser_id = t2.mlm_user_id " . $where . " ");

        return $query->num_rows();
    }
    function countOfAffiliatesActiveUser($table1, $table2, $from_date, $to_date, $user_id) {

        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = "  ";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE  t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        } elseif ($user_id && $from_date == '' && $to_date == '') {
            $where = " WHERE  t1.sponser_id = $user_id ";
        } else {
            $where = " WHERE  t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.sponser_id = $user_id ";
        }


        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.sponser_id = t2.mlm_user_id " . $where . " ");

        return $query->num_rows();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnAffiliates() {
        return array(
            array('db' => 't1.id', 'dt' => 0),
            array('db' => 't1.username', 'dt' => 1),
            array('db' => 't2.user_name', 'dt' => 2),
            array('db' => 't1.email', 'dt' => 3),
            array('db' => 't1.mobile', 'dt' => 4),
            array('db' => 't1.first_name', 'dt' => 5),
            array('db' => 't1.last_name', 'dt' => 6),
            array('db' => 't1.status', 'dt' => 7)
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
    function getTotalFilteredAffiliatesActive($table1, $table2, $where, $from_date, $to_date, $user_id) {
        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.id = $user_id ";
            } else {
                $where = $where . " AND t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t1.id = $user_id ";
            } else {
                $where = " WHERE  t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.id = $user_id ";
            }
        }

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.sponser_id = t2.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }
    function getTotalFilteredAffiliatesActiveUser($table1, $table2, $where, $from_date, $to_date, $user_id) {
        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.sponser_id = $user_id ";
            } else {
                $where = $where . " AND t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.sponser_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t1.sponser_id = $user_id ";
            } else {
                $where = " WHERE  t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.sponser_id = $user_id ";
            }
        }

        $query = $this->db->query("select t1.id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.sponser_id = t2.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataAffiliatesActive($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id) {
        $data = array();


        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.id = $user_id ";
            } else {
                $where = $where . " AND t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t1.id = $user_id ";
            } else {
                $where = " WHERE  t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.id = $user_id ";
            }
        }



        $query = $this->db->query("select t1.id,t1.username,t2.user_name,t1.email,t1.mobile,t1.first_name,t1.last_name,t1.status from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.sponser_id = t2.mlm_user_id  " . $where . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }
    function getResultDataAffiliatesActiveUser($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id) {
        $data = array();


        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.sponser_id = $user_id ";
            } else {
                $where = $where . " AND t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.sponser_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t1.sponser_id = $user_id ";
            } else {
                $where = " WHERE  t1.enroll_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.sponser_id = $user_id ";
            }
        }



        $query = $this->db->query("select t1.id,t1.username,t2.user_name,t1.email,t1.mobile,t1.first_name,t1.last_name,t1.status from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.sponser_id = t2.mlm_user_id  " . $where . $order . " " . $limit);
        

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }



    /**
     * For table column rank history table
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function getTableColumnRankHistoryList() {
        return array(
            array('db' => "t1.id", 'dt' => 0),
            array('db' => "t3.user_name", 'dt' => 1),
            array('db' => "t4.first_name", 'dt' => 2),
            array('db' => "t2.rank_name", 'dt' => 3),
            array('db' => "t1.update_date", 'dt' => 4),
            array('db' => "t4.last_name", 'dt' => 5)
        );
    }

    /**
     * For count of rank history 
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function countOfRankHistoryList($table, $from_date, $to_date, $user_id) {
        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = " ";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE  update_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        } elseif ($user_id && $from_date == '' && $to_date == '') {
            $where = " WHERE  mlm_user_id = $user_id ";
        } else {
            $where = " WHERE  update_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND mlm_user_id = $user_id ";
        }
        $query = $this->db->query("select id from " . $table . " " . $where);
        return $query->num_rows();
    }

    /**
     * For getting the total rank history details
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $table3
     * @param type $where
     * @return type
     */
    function getTotalFilteredRankHistoryList($table1, $table2, $table3, $table4, $where, $from_date, $to_date, $user_id) {
        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . " ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.update_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.mlm_user_id = $user_id ";
            } else {
                $where = $where . " AND t1.update_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND mlm_user_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = " ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.update_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t1.mlm_user_id = $user_id ";
            } else {
                $where = " WHERE  t1.update_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id ";
            }
        }
        $query = $this->db->query("select t2.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 ON t1.new_rank = t2.id INNER JOIN " . $table3 . " AS t3 ON t3.mlm_user_id = t1.mlm_user_id INNER JOIN " . $table4 . " AS t4 ON t4.mlm_user_id = t1.mlm_user_id " . $where);
        return $query->num_rows();
    }

    /**
     * For getting the rank history
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table1
     * @param type $table2
     * @param type $table3
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataRankHistoryList($table1, $table2, $table3, $table4, $where, $order, $limit, $from_date, $to_date, $user_id) {
        $data = array();


        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . " ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.update_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.mlm_user_id = $user_id ";
            } else {
                $where = $where . " AND t1.update_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND mlm_user_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = " ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.update_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t1.mlm_user_id = $user_id ";
            } else {
                $where = " WHERE  t1.update_date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id ";
            }
        }



        $query = $this->db->query("select t2.id,t3.user_name,t4.first_name,t2.rank_name,t1.update_date,t4.last_name from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 ON t1.new_rank = t2.id INNER JOIN " . $table3 . " AS t3 ON t3.mlm_user_id = t1.mlm_user_id INNER JOIN " . $table4 . " AS t4 ON t4.mlm_user_id = t1.mlm_user_id " . $where . " " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function countOfUserAffiliatesActive($sponser_id) {
        return $this->db->select('id')
                        ->from("affiliates")
                        ->where('status', 1)
                        ->where('sponser_id', $sponser_id)
                        ->count_all_results();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @return type
     */
    function getTotalFilteredUserAffiliatesActive($table, $where, $user_id) {
        if ($where) {
            $where = $where . " AND status=1 AND sponser_id=" . $user_id;
        } else {
            $where = " WHERE status=1 AND sponser_id=" . $user_id;
        }
        $query = $this->db->query("select id from " . $table . " " . $where);
        return $query->num_rows();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataUserAffiliatesActive($table, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND status=1 AND sponser_id=" . $user_id;
        } else {
            $where = " WHERE status=1 AND sponser_id=" . $user_id;
        }
        $query = $this->db->query("select id,username,email,mobile,first_name,last_name from " . $table . " " . $where . " " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @return type
     */
    function countOfUserAffiliatesInActive($sponser_id) {
        return $this->db->select('id')
                        ->from("affiliates")
                        ->where('status', 0)
                        ->where('sponser_id', $sponser_id)
                        ->count_all_results();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @return type
     */
    function getTotalFilteredUserAffiliatesInActive($table, $where, $user_id) {
        if ($where) {
            $where = $where . " AND status=0 AND sponser_id=" . $user_id;
        } else {
            $where = " WHERE status=0 AND sponser_id=" . $user_id;
        }
        $query = $this->db->query("select id from " . $table . " " . $where);
        return $query->num_rows();
    }

    /**
     * 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies

     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataUserAffiliatesInActive($table, $where, $order, $limit, $user_id) {
        $data = array();
        if ($where) {
            $where = $where . " AND status=0 AND sponser_id=" . $user_id;
        } else {
            $where = " WHERE status=0 AND sponser_id=" . $user_id;
        }
        $query = $this->db->query("select id,username,email,mobile,first_name,last_name from " . $table . " " . $where . " " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }
    
    function totalCommissionAmount($user_id='', $from_date='', $to_date='', $amount_type='',$table='') {
        $amount = 0;
        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = " WHERE type = 'credit' AND `bonus_flag` = '1' AND `wallet_type` = '".$amount_type."' ";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE type = 'credit' AND `bonus_flag` = '1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND `wallet_type` = '".$amount_type."' ";
        } elseif ($user_id && $from_date == '' && $to_date == '') {
            $where = " WHERE type = 'credit' AND `bonus_flag` = '1' AND mlm_user_id = $user_id AND `wallet_type` = '".$amount_type."' ";
        } else {
            $where = " WHERE type = 'credit' AND `bonus_flag` = '1' AND date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND mlm_user_id = $user_id AND `wallet_type` = '".$amount_type."' ";
        }

        $query = $this->db->query("select SUM(amount1)as amt1 from " . $table . " " . $where);

        foreach ($query->result() as $row) {
            $amount = $row->amt1;
        }
        return $amount;
    }

    function getTableColumnBinaryHistory() {
        return array(
            array('db' => 't1.id', 'dt' => 0),
            array('db' => 't2.user_name', 'dt' => 1),
            array('db' => 't1.user_L', 'dt' => 2),
            array('db' => 't1.user_R', 'dt' => 3),
            array('db' => 't1.user_L_carry', 'dt' => 4),
            array('db' => 't1.user_R_carry', 'dt' => 5),
            array('db' => 't1.binary_pair', 'dt' => 6),
            array('db' => 't1.capped_amount', 'dt' => 7),
            array('db' => 't1.dist_amount', 'dt' => 8),
            array('db' => 't1.date', 'dt' => 9)
        );
    }
    
      function countOfTotalBinaryHistory($table1, $table2, $from_date, $to_date, $user_id) {

        if ($from_date == '' && $to_date == '' && $user_id == '') {
            $where = "  ";
        } elseif ($user_id == '' && $from_date && $to_date) {
            $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
        } elseif ($user_id && $from_date == '' && $to_date == '') {
            $where = " WHERE  t1.mlm_user_id = $user_id ";
        } else {
            $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id ";
        }


        $query = $this->db->query("select t2.mlm_user_id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id " . $where . " ");

        return $query->num_rows();
    }

      function getTotalFilteredTotalBinaryHistory($table1, $table2, $where, $from_date, $to_date, $user_id) {
        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.mlm_user_id = $user_id ";
            } else {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t1.mlm_user_id = $user_id ";
            } else {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id ";
            }
        }

        $query = $this->db->query("select t2.mlm_user_id from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id " . $where . " ");
        return $query->num_rows();
    }

    
    function getResultDataTotalBinaryHistory($table1, $table2, $where, $order, $limit, $from_date, $to_date, $user_id) {
        $data = array();


        if ($where) {

            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = $where . "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = $where . " AND t1.mlm_user_id = $user_id ";
            } else {
                $where = $where . " AND t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id ";
            }
        } else {
            if ($from_date == '' && $to_date == '' && $user_id == '') {
                $where = "  ";
            } elseif ($user_id == '' && $from_date && $to_date) {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'";
            } elseif ($user_id && $from_date == '' && $to_date == '') {
                $where = " WHERE  t1.mlm_user_id = $user_id ";
            } else {
                $where = " WHERE  t1.date BETWEEN '" . $from_date . "' AND '" . $to_date . "'AND t1.mlm_user_id = $user_id ";
            }
        }



        $query = $this->db->query("select t1.id,t2.user_name,t1.user_L,t1.user_R,t1.user_L_carry,t1.user_R_carry,t1.binary_pair,t1.capped_amount,t1.dist_amount,t1.date from " . $table1 . " AS t1  INNER JOIN " . $table2 . " AS t2 ON t1.mlm_user_id = t2.mlm_user_id  " . $where . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }
    public function updateAddaddress($address_post){
        $user_id =$address_post['user_id'];
        $default = $address_post['default'];
        $i = 0;
        foreach($address_post['address'] as $updateaddress){
            if($i==$default){
                $useraddAddress = $updateaddress;
                $data = [
                    'address_1' => $useraddAddress['address_1'],
                    'address_2' => $useraddAddress['address_2'],
                    'city' => $useraddAddress['city'],
                    'country_id' => $address_post['country_id'],
                    'state_id' => $address_post['state'],
                    'zip_code' =>$useraddAddress['zip_code'],
                ];
                $this->db->where('mlm_user_id', $user_id);
                $this->db->update('user_details', $data);

            }else{

                    // $res = $this->deleteadduser_address($user_id);
                    // if($res){

                $useraddAddress = $updateaddress;
                $this->db->set('address_1', $useraddAddress['address_1'])
                ->set('mlm_user_id', $user_id)
                ->set('address_2', $useraddAddress['address_2'])
                ->set('city', $useraddAddress['city'])
                ->set('zip_code', $useraddAddress['zip_code'])
                ->set('country_id', $address_post['country_id'])
                ->set('state_id', $address_post['state'])
                ->insert('user_address');

                    // }
            }
            $i++;
        }
        return true;

    }

    public function updateAddress($address_post, $user_id){
        // print_r($address_post);die;

          // $default = $address_post['default'];
          $i = 0;
        foreach($address_post['address'] as $updateaddress){
                // if($i==$default){
                    $useraddAddress = $updateaddress;
                    $data = [
                        'address_1' => $address_post['address_1'],
                        'address_2' => $useraddAddress['address_2'],
                        'country_id' => $address_post['country_id'],
                        'state_id' => $address_post['state'],
                        'zip_code' =>$address_post['zip_code'],
                    ];
                    // print_r($data);die;
                    $this->db->where('mlm_user_id', $user_id);
                    $this->db->update('user_details', $data);
                // }else{
                   
                //     $res = $this->deleteadduser_address($user_id);
                //     if($res){
              
                //         $useraddAddress = $updateaddress;
                //         $this->db->set('address_1', $useraddAddress['address_1'])
                //         ->set('mlm_user_id', $user_id)
                //         ->set('address_2', $useraddAddress['address_2'])
                //         ->set('city', $useraddAddress['city'])
                //         ->set('zip_code', $useraddAddress['zip_code'])
                //         ->set('country_id', $address_post['country_id'])
                //         ->insert('user_address');
                //     }
                // }
                 $i++;
          }
          return true;
    }

    public function deleteadduser_address($user_id){
          return $this->db->where('mlm_user_id', $user_id)
                ->delete('user_address');

    }
    public function joinuserdetails(){
        $query = $this->db->select('mlm_user_id ,email,user_status,date')
            ->where('user_type !=','admin')
            ->limit(10)
            ->get('user');
            $i=1;
       $datauser = array();
        foreach ($query->result() as $row) {
                   $datauser[$i]['id'] = $i;
                   $datauser[$i]['mlm_user_id'] = $row->mlm_user_id;
                   $datauser[$i]['email'] = $row->email;
                   $datauser[$i]['user_status'] = $row->user_status;
                   $datauser[$i]['date'] = $row->date;
                   $datauser[$i]['first_name'] =  $this->db->where('mlm_user_id', $row->mlm_user_id)->get('user_details')->row()->first_name;//$row->mlm_user_id;
                   $datauser[$i]['last_name'] = $this->db->where('mlm_user_id', $row->mlm_user_id)->get('user_details')->row()->last_name;//$row->mlm_user_id;
               $i++;
            }
            return $datauser;
    }

    public function edituserdetails($user_id){
        $detail = $this->db->select('id,email,first_name,last_name,address_2,address_1,city,zip_code,phone_number,country_id,state_id')
        ->from('user')
        ->join('user_details', 'user.mlm_user_id = user_details.mlm_user_id', 'inner')
        ->where('user.mlm_user_id', $user_id)
        ->get();
            // print_R($detail->result());die; 
            $details = array(); 
            foreach ($detail->result() as $row) {
            $details['id'] = $row->id;
            $details['email'] = $row->email;
            $details['first_name'] =  $row->first_name;
            $details['last_name'] = $row->last_name;
            $details['address_2'] = $row->address_2;
            $details['address_1'] = $row->address_1;
            $details['city'] = $row->city;
            $details['zip_code'] = $row->zip_code;
            $details['country_id'] = $row->country_id;
            $details['state'] = $row->state_id;
            $details['phone_number'] = $row->phone_number;
            $details['user_id'] = $user_id;
            }
            return $details;
    }
    public function updategeneral($update_user_data,$user_id){

        $data = [
            'first_name' => $update_user_data['first_name'],
            'last_name' => $update_user_data['last_name'],
            'phone_number' => $update_user_data['phone_number']
        ];
        $this->db->where('mlm_user_id', $user_id);
        $this->db->update('user_details', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }
    public function updatepassword($update_user_data, $user_id){
        $password = $this->aauth->hash_password($update_user_data['password'],'');
        $data = [
            'password' => $password,
        ];
        $this->db->where('mlm_user_id', $user_id);
        $this->db->update('user', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }
}
