<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * For employee related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    employee
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */

class Employee_model extends CI_Model {
    /**
     * for enrolling an employee
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
        function enrollEmployee($data) {
        $this->db->trans_start();
        $array = array('user_name' => $data['user_name'],
            'password' => hash("sha256", $data['password']),
            'modules' => 'a:25:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:3:"106";i:3;s:2:"14";i:4;s:2:"23";i:5;s:2:"22";i:6;s:2:"26";i:7;s:2:"43";i:8;s:3:"116";i:9;s:3:"107";i:10;s:3:"108";i:11;s:2:"38";i:12;s:3:"110";i:13;s:3:"117";i:14;s:2:"27";i:15;s:2:"45";i:16;s:2:"46";i:17;s:2:"17";i:18;s:2:"73";i:19;s:2:"74";i:20;s:1:"7";i:21;s:1:"4";i:22;s:3:"150";i:23;s:3:"151";i:24;s:3:"152";}'
        );
        $result = $this->db->insert('employee_login', $array);
        $data['insert_id'] = $this->db->insert_id();
        if ($result) {
            $emp_data = array(
                'employee_id' => $data['insert_id'],
                'first_name' => $data['firstname'],
                'last_name' => $data['lastname'],
                'gender' => $data['gender'],
                'date_of_birth' => $data['year'] . '-' . $data['month'] . '-' . $data['day'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'country' => $data['country'],
                'state' => $data['state'],
                'user_photo' => $data['photo'],
                'city' => $data['city'],
                'zipcode' => $data['zipcode'],
            );
            $res = $this->db->insert('employee_details', $emp_data);
            $this->helper_model->insertActivity($data['user_id'], 'enroll_new_employee', serialize($data));
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * for validating employee name
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function checkIsUserNameExistsOrNot($user_name) {
        $result = $this->db->select('count(*)')->from('employee_login')->like('user_name', $user_name)->where('status !=', '3')->count_all_results();
        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * for getting all registered employees
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getAllRegisteredEmployee() {
        $result = $this->db->select('id,employee_login.employee_id,user_photo,employee_login.status,user_name,first_name,last_name,email,address,phone,country,zipcode,gender,date_of_birth,state')->from('employee_details')->join('employee_login', 'employee_login.employee_id=employee_details.employee_id', 'left')->where('employee_login.status =', 1)->get();
        $i = 0;
        $details = array();
        foreach ($result->result_array() as $row) {
            $details[$i]['id'] = $row['id'];
            $details[$i]['employee_id'] = $row['employee_id'];
            $details[$i]['user_name'] = $row['user_name'];
            $details[$i]['first_name'] = $row['first_name'];
            $details[$i]['last_name'] = $row['last_name'];
            $details[$i]['email'] = $row['email'];
            $details[$i]['address'] = $row['address'];
            $details[$i]['phone'] = $row['phone'];
            $explode = explode('-', $row['date_of_birth']);
            $details[$i]['month'] = $explode[1];
            $details[$i]['year'] = $explode[0];
            $details[$i]['day'] = $explode[2];
            $details[$i]['country'] = $row['country'];
            $details[$i]['state'] = $row['state'];
            $details[$i]['gender'] = $row['gender'];
            $details[$i]['status'] = $row['status'];
            $details[$i]['user_photo'] = $row['user_photo'];
            $details[$i]['date_of_birth'] = $row['date_of_birth'];
            $i++;
        }
        return $details;
    }

    /**
     * for getting employee details
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getSelectedUserData($id) {
        $result = $this->db->select('ed.id,el.status,ed.user_photo,el.user_name,first_name,last_name,email,gender,address,phone,country,zipcode,gender,date_of_birth,state')
                ->from('employee_details as ed')
                ->join('employee_login as el', 'el.employee_id=ed.employee_id', 'left')
                ->where('ed.id', $id)
                ->get();
        $i = 0;
        $details = array();
        foreach ($result->result() as $row) {
            $details['id'] = $row->id;
            $details['user_name'] = $row->user_name;
            $details['first_name'] = $row->first_name;
            $details['last_name'] = $row->last_name;
            $details['email'] = $row->email;
            $details['address'] = $row->address;
            $details['phone'] = $row->phone;
            $details['gender'] = $row->gender;
            $details['status'] = $row->status;
            $details['country'] = $row->country;
            $details['state'] = $row->state;
            $details['zipcode'] = $row->zipcode;
            $details['user_photo'] = $row->user_photo;
            $details['date_of_birth'] = $row->date_of_birth;
            $orderdate = explode('-', $row->date_of_birth);
            $details['month'] = $orderdate[1];
            $details['day'] = $orderdate[2];
            $details['year'] = $orderdate[0];
            $i++;
        }
        return $details;
    }

    /**
     * for deleting employee
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function deleteEmployee($delete_id) {
        $result = $this->db->set('status', 3)->where('employee_id', $delete_id)->update('employee_login');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * for edit employee
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function editEmployee($activate_id, $status) {
        $result = $this->db->set('status', $status)->where('employee_id', $activate_id)->update('employee_login');
        if ($result > 0) {
            return $result;
        }
        return false;
    }

    /**
     * for updating employee
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function updateEmployeeDetails($data) {
        $this->db->trans_start();

        if (!empty($data)) {
            $emp_data = array(
                'first_name' => $data['firstname'],
                'last_name' => $data['lastname'],
                'gender' => $data['gender'],
                'date_of_birth' => $data['year'] . '-' . $data['month'] . '-' . $data['day'],
                'email' => $data['email'],
                'user_photo' => $data['photo'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'country' => $data['country'],
                'state' => $data['state'],
                'city' => $data['city'],
                'zipcode' => $data['zipcode'],
            );
            $res = $this->db->where('employee_id', $data['id'])->update('employee_details', $emp_data);
            $this->helper_model->insertActivity($data['user_id'], 'update_emplo_details', serialize($data));
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * for getting all active employees
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getAllActiveEmployeeList($query) {
        if ($query != '') {
            $res = $this->db->select("user_name")
                    ->from('employee_login')
                    ->like('user_name', trim($query))
                    ->where('status', 1)
                    ->get();
        } else {
            $res = $this->db->select("user_name")
                    ->from('employee_login')
                    ->where('status  ', 1)
                    ->get();
        }
        $json = [];
        foreach ($res->result_array() as $row) {
            $json[] = $row['user_name'];
        }
        return json_encode($json);
    }

    /**
     * for getting all employee menus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getAllEmployeeMenus() {
        $result = $this->db->select('id,name,link,order,lock,root_id')
                ->from('menus')
                ->where('root_id', '#')
                ->where('employee_permission', 1)
                ->where('status', 1)
                ->get();
        $empl_menu_arr = array();
        $i = 0;
        foreach ($result->result_array() as $row) {
            $sub_menu = ($row['link'] == '#') ? $this->getSubMenus($row['id']) : NULL;
            if ($row['link'] != '#' || $sub_menu) {
                $empl_menu_arr[$i]['id'] = $row['id'];
                $empl_menu_arr[$i]['name'] = $row['name'];
                $empl_menu_arr[$i]['link'] = $row['link'];
                $empl_menu_arr[$i]['root_id'] = $row['root_id'];
                $empl_menu_arr[$i]['sub_menu'] = $sub_menu;
            }
            $i++;
        }
        return $empl_menu_arr;
    }

    /**
     * for getting all sub-menus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getSubMenus($id) {
        $result = $this->db->select('id,name,link,order,lock,root_id')
                ->from('menus')
                ->where('root_id', $id)
                ->where('employee_permission', 1)
                ->where('status', 1)
                ->get();
        $empl_menu_arr = [];
        $i = 0;
        foreach ($result->result_array() as $row) {
            $sub_menu = ($row['link'] == '#') ? $this->getSubSubMenu($row['id']) : NULL;
            if ($row['link'] != '#' || $sub_menu) {
                $empl_menu_arr[$i]['sub_id'] = $row['id'];
                $empl_menu_arr[$i]['name'] = $row['name'];
                $empl_menu_arr[$i]['link'] = $row['link'];
                $empl_menu_arr[$i]['sub_menu'] = $sub_menu;
            }
            $i++;
        }
        return $empl_menu_arr;
    }

    /**
     * for getting all inner-menus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    public function getSubSubMenu($menu_id) {

        $menu_permisson = true;
        $empl_menu_arr = array();
        $i = 0;
        $res = $this->db->select("id, name, link, icon, order, lock, target")
                ->where("status", 1)
                ->where("root_id", $menu_id)
                ->where('employee_permission', 1)
                ->order_by("order")
                ->get("menus");

        foreach ($res->result_array() as $row) {

            $empl_menu_arr[$i]['sub_id'] = $row['id'];
            $empl_menu_arr[$i]['name'] = $row['name'];
            $empl_menu_arr[$i]['link'] = $row['link'];
            $i++;
        }
        return $empl_menu_arr;
    }

    /**
     * foe getting all allocated menus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getAllUserAllocatedMenus($user_name) {

        $result = $this->db->select('modules')->from('employee_login')->like('user_name', $user_name)->where('status', 1)->get();
        $arr = [];
        foreach ($result->result_array() as $row) {
            if (!empty($row['modules'])) {
                $arr['menus'] = unserialize($row['modules']);
            }
        }
        return $arr;
    }

    /**
     * for getting employee id
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getEmployeeId($user_name) {
        $employee_id = $this->db->select('employee_id')->from('employee_login')->like('user_name', $user_name)->get()->row()->employee_id;
        if ($employee_id > 0) {
            return $employee_id;
        }
        return false;
    }

    /**
     * for getting Employee UserName
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getEmployeeUsername($user_id) {
        $employee = $this->db->select('user_name')->from('employee_login')->like('employee_id', $user_id)->get()->row()->user_name;
        if ($employee > 0) {
            return $employee;
        }
        return false;
    }

    /**
     * for updating module permission
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function upDateModulePermission($post_arr) {
        $user_id = $post_arr['emp_id'];
        $length = count($post_arr);

        $output = array_slice($post_arr, 1, -1);

        $array = array();

        foreach ($output as $value) {
            array_push($array, $value);
        }

        $serialize = serialize($array);

        $result = $this->db->set('modules', $serialize)->where('employee_id', $user_id)->update('employee_login');
        return $result;
    }

    /**
     * for getting employee count
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function countOfEmployee() {
        return $this->db->select('id')
                        ->from("employee_login")
                        ->where('status!=', 3)
                        ->count_all_results();
    }

    /**
     * for setting datatable heaing for employees
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getTableColumnEmployee() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'user_name', 'dt' => 1),
            array('db' => 'user_photo', 'dt' => 2),
            array('db' => 'zipcode', 'dt' => 3),
            array('db' => 'email', 'dt' => 4),
            array('db' => 'phone', 'dt' => 5),
            array('db' => 'address', 'dt' => 6),
            array('db' => 't1.status', 'dt' => 7),
            array('db' => 'first_name', 'dt' => 8),
            array('db' => 'last_name', 'dt' => 9),
            array('db' => 'employee_id', 'dt' => 10)
        );
    }

    /**
     * for getting filtered data count of employees
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getTotalFilteredEmployee($table1, $table2, $where) {
        if ($where) {
            $where = $where . " AND t1.status != 3 AND ";
        } else {
            $where = " WHERE t1.status != 3 AND ";
        }
        $query = $this->db->query("select t2.id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.employee_id = t2.employee_id ");
        return $query->num_rows();
    }

    /**
     * for getting datatable details for employees
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getResultDataEmployee($table1, $table2, $where, $order, $limit) {
        $data = array();
        if ($where) {
            $where = $where . " AND t1.status != 3 AND ";
        } else {
            $where = " WHERE t1.status != 3 AND ";
        }
        $query = $this->db->query("select t2.id,t1.user_name,t2.user_photo,t2.zipcode,t2.email,t2.phone,t2.address,t1.status,t2.first_name,t2.last_name,t2.employee_id from " . $table1 . " AS t1 INNER JOIN " . $table2 . " AS t2 " . $where . "t1.employee_id = t2.employee_id " . $order . " " . $limit);

        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    /**
     * for getting all active menus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getAllActivatedMenu($employee_menu, $allocate_menu, $employee_id) {

        $allocate_menu_id = [];
        foreach ($allocate_menu as $data) {
            $allocate_menu_id = $data;
        }
        $menu = "<table style='background:white;height:100px;' class='table table-responsive table-full-width' id='sample_1'>";
        foreach ($employee_menu as $row) {

            $menu_id = $row['id'];
            $menu_name = lang('menu_name_' . $row['id']);

            if (in_array($menu_id, $allocate_menu_id)) {
                foreach ($allocate_menu_id as $allocate_id) {
                    if ($menu_id == $allocate_id) {

                        $checked = true;
                    } else {
                        $checked = false;
                    }
                }
                $menu .= "<tr style='color:#0000'>
                                     <td>
                                     <div class='radio-inline'>
                                        <input checked='" . $checked . "' type='checkbox' name='" . strtolower($menu_name) . "' id='" . $menu_name . "' value='" . $menu_id . "' class='square-teal'/>
                                        <label for='" . $row['id'] . "'></label>
                                           <font color ='#0000'> $menu_name </font>
                                            </div>
                                          </div>
                                       </td>
                                    <td colspan='2'></td>
                                  </tr>";
            } else {
                $menu .= "<tr style='color:#0000'>
                                       <td>
                                        <div class='radio-inline'>
                                             <input  type='checkbox' name='" . strtolower($menu_name) . "' id='" . $menu_name . "' value='" . $menu_id . "' class='square-teal'/>
                                            <label for='" . $row['id'] . "'></label>
                                           <font color ='#0000'> $menu_name </font>
                                         </div>
                                      </td>
                                    <td colspan='2'></td>
                                  </tr>";
            }
            if ($row['sub_menu']) {
                foreach ($row['sub_menu'] as $value) {
                    $sub_menu_id = $value['sub_id'];
                    $sub_menu_name = lang('menu_name_' . $value['sub_id']);
                    if (in_array($sub_menu_id, $allocate_menu_id)) {
                        foreach ($allocate_menu_id as $allocate_id) {
                            if ($sub_menu_id == $allocate_id) {
                                $checked = TRUE;
                            } else {
                                $checked = FALSE;
                            }
                        }
                        $menu .= "<tr tr style='color:#0000'>
                                            <td></td>
                                            <td>
                                             <div class='radio-inline'>
                                                <input checked='" . $checked . "' type='checkbox' name='" . strtolower($sub_menu_name) . "' id='" . $sub_menu_name . "' value='" . $sub_menu_id . "' class='square-teal'/>
                                                <label for='" . $value['sub_id'] . "'></label>
                                                <font color ='#0000'> $sub_menu_name </font>
                                                    </div>
                                            </td>
                                             <td></td>
                                         </tr>";
                    } else {
                        $menu .= "<tr tr style='color:#0000'>
                                            <td></td>
                                            <td>
                                             <div class='radio-inline'>
                                                <input  type='checkbox' name='" . strtolower($sub_menu_name) . "' id='" . $sub_menu_name . "' value='" . $sub_menu_id . "' class='square-teal'/>
                                                <label for='" . $value['sub_id'] . "'></label>
                                                <font color ='#0000'> $sub_menu_name </font>
                                                    </div>
                                            </td>
                                             <td></td>
                                         </tr>";
                    }
                }
            }
        }
        $menu .= "</table>";

        return $menu;
    }

    /**
     * for checking image uploaded or not
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function checkImageUploadFirstTimeOrNot($employee_id, $file_name) {

        $status = $this->db->select('*')
                ->from('employee_details')
                ->where('employee_id', $employee_id)
                ->where('user_photo =', $file_name)
                ->get();

        if (count($status) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * for updating employee password
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function updateEmployeePassword($emp_id, $password) {
        $pswd = $this->db->set('password', hash("sha256", $password))->where('employee_id', $emp_id)->update('employee_login');
        if ($pswd > 0) {
            return $pswd;
        }
        return false;
    }

    /**
     * for getting all allocated menus for an employee
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getAllEmployeeAllocatedMenus($employee_id) {
        $result = $this->db->select('modules')->from('employee_login')->where('employee_id', $employee_id)->where('status', 1)->get();
        $arr = array();
        foreach ($result->result_array() as $row) {
            if (!empty($row['modules'])) {
                $arr = unserialize($row['modules']);
            }
        }
        return $arr;
    }

    /**
     * for getting employee menus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getEmployeeMenus($allocated_menus) {
        $result = $this->db->select('id,link')
                ->from('menus')
                ->where('root_id', '#')
                ->where('employee_permission', 1)
                ->where('status', 1)
                ->order_by('order', 'ASC')
                ->get();
        $empl_menu_arr = array();
        $i = 0;
        foreach ($result->result_array() as $row) {
            //$sub_menu = ($row['link'] == '#') ? $this->getEmployeeSubMenus($row['id'], $allocated_menus) : array();
            $sub_menu=$this->getEmployeeSubMenus($row['id'], $allocated_menus);
            if ($row['link'] != '#' || $sub_menu) {
                $empl_menu_arr[$i]['id'] = $row['id'];
                $empl_menu_arr[$i]['sub_menu'] = $sub_menu;
                $empl_menu_arr[$i]['menu_permission'] = false;
                if (in_array($row['id'], $allocated_menus)) {
                    $empl_menu_arr[$i]['menu_permission'] = true;
                }
            }
            $i++;
        }
        return $empl_menu_arr;
    }

    /**
     * get employee sub-menus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getEmployeeSubMenus($id, $allocated_menus) {
        $empl_menu_arr = array();
        $result = $this->db->select('id,link')
                ->from('menus')
                ->where('root_id', $id)
                ->where('employee_permission', 1)
                ->where('status', 1)
                ->order_by('order', 'ASC')
                ->get();        
        $i = 0;
        foreach ($result->result_array() as $row) {
            $sub_menu = $this->getEmployeeSubMenus($row['id'], $allocated_menus);
            if ($row['link'] != '#' || $sub_menu) {
                $empl_menu_arr[$i]['id'] = $row['id'];
                $empl_menu_arr[$i]['sub_menu'] = $sub_menu;
                $empl_menu_arr[$i]['menu_permission'] = false;
                if (in_array($row['id'], $allocated_menus)) {
                    $empl_menu_arr[$i]['menu_permission'] = true;
                }
            }
            $i++;
        }
        return $empl_menu_arr;
    }

    /**
     * for updating employee allocated menus
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function updateAllocatedMenus($employee_id, $menu_id, $status) {
        $allocate_menu = $this->employee_model->getAllEmployeeAllocatedMenus($employee_id);
        $new_menus = array();
        if ($status) {
            foreach ($allocate_menu as $value) {
                $new_menus[] = $value;
            }
            $new_menus[] = $menu_id;
        } else {
            foreach ($allocate_menu as $value) {
                if ($menu_id != $value) {
                    $new_menus[] = $value;
                }
            }
        }

        $serialize = serialize($new_menus);
        return $this->db->set('modules', $serialize)->where('employee_id', $employee_id)->update('employee_login');
    }

    /**
     * for getting last created employee number
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function getLastNumber() {
        $qry = $this->db->select('MAX(employee_id)as id')
                ->from('employee_login')
                ->get();
        if ($qry->num_rows() > 0) {
            return $qry->row()->id + 1;
        }
        return false;
    }

    /**
     * for changing employee status
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type
     * @param type
     * @return
     */
    function changeEmployeeStatus($value) {
        $this->db->set('value', $value)
                ->where('key', 'EMPLOYEE_NAME_GENERATION_STATUS')
                ->update('config');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }
    
    
    function getAllEmployeeAllocatedDepartment($employee_id) {
        $result = $this->db->select('department_id')->from('employee_login')->where('employee_id', $employee_id)->where('status', 1)->get();
        $arr = array();
        foreach ($result->result_array() as $row) {
            if (!empty($row['department_id'])) {
                $arr = unserialize($row['department_id']);
            }
        }
        return $arr;
    }

}
