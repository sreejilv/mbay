<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * 
 * For backup related models
 * @package     Site
 * @subpackage  Base Extended
 * @category    backup
 * @author      Techffodils Technologies LLP
 * @link        https://techffodils.com
 */
class Backup_model extends CI_Model {

    /**
     * For Database Backup
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param NILL
     * @return Backup Status
     */
    function dbBackup() {
        $this->load->model("cron_job_model");
        $insert_id = $this->cron_job_model->insertCronJobHistory('db_backup', 'Admin');
        $res = $this->cron_job_model->generateBackup($insert_id);
        if ($res) {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Success');
        } else {
            $this->cron_job_model->updateCronJobHistory($insert_id, 'Failed');
        }
        return $res;
    }

    /**
     * For Create Backup File
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param Cron Id
     * @param Compression
     * @return File Name
     */
    function genBackup($insert_id, $compression = TRUE) {
        $this->load->dbutil(); // Load the DB utility class
        $backup = $this->dbutil->backup(); // Backup your entire database and assign it to a variable
        $this->load->helper('file'); // Load the file helper and write the file to your server

        $BACKUP_PATH = FCPATH . "application/backup/";
        $file_name = 'db-' . time() . '.gz';
        $full_path = $BACKUP_PATH . $file_name;
        $zp = gzopen($full_path, "a9");
        write_file($full_path, $backup);

        if (file_exists($full_path)) {
            $this->db->set('data ', $file_name);
            $this->db->where('id ', "$insert_id");
            $query = $this->db->update('cron_job');

            return $file_name;
        }
        return 0;
    }

    /**
     * For Delete Old Backup Files
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param Number Of Days
     * @return TRUE
     */
    function deleteOlderBackup($day) {
        $deleting_day = date('Y-m-d', strtotime("-$day days"));
        $query = $this->db->select("id,data")
                ->from("cron_job")
                ->where("cron_job", 'db_backup')
                ->where("file_status !=", 'deleted')
                ->where('date <=', $deleting_day)
                ->get();
        foreach ($query->result() as $row) {
            $filename = $row->data;
            $cron_job_id = $row->id;
            $path = FCPATH . "application/backup/" . $filename;
            if ($filename != '' && file_exists($path) && is_file($path)) {
                unlink($path);

                $this->db->set('file_status ', "deleted")
                        ->where('id ', "$cron_job_id")
                        ->update('cron_job');
            }
        }
        return TRUE;
    }

    /**
     * For Fetching Latest Backups   
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies  
     * @return Latest Backups 
     */
    function getLastBackups() {
        $data = array();
        $res = $this->db->select("id,date,data,done_by")
                ->from("cron_job")
                ->where("cron_job", 'db_backup')
                ->where("file_status !=", 'deleted')
                ->where("status", 'Success')
                ->order_by("id", "desc")
                ->limit(10)
                ->get();
        $slno = 1;
        foreach ($res->result() as $row) {
            $data[$slno]['id'] = $row->id;
            $data[$slno]['date'] = $row->date;
            $data[$slno]['file_name'] = $row->data;
            $data[$slno]['done_by'] = $row->done_by;
            $slno++;
        }
        return $data;
    }

    /**
     * For Database Backup
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param Cron Id
     * @param Compression
     * @return Backup Status
     */
    function generateBackup($insert_id, $compression = true) {
        $db_hostname = $this->db->hostname;
        $db_username = $this->db->username;
        $db_password = $this->db->password;
        $db_database = $this->db->database;
        ;
        $DBH = new PDO("mysql:host=$db_hostname;dbname=$db_database; charset=utf8", $db_username, $db_password);

        return $this->backup_tables($DBH, $insert_id, $compression);
    }

    /**
     * For Create Backup File
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param PDO Configs
     * @param Compression
     * @return File Name
     */
    function backup_tables($DBH, $cron_job_id, $compression) {
        $tables = array();
        $DBH->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_NATURAL);

        $BACKUP_PATH = FCPATH . "application/backup/";
        $nowtimename = 'db-' . time();
        if ($compression) {
            $zp = gzopen($BACKUP_PATH . $nowtimename . '.sql.gz', "a9");
        } else {
            $handle = fopen($BACKUP_PATH . $nowtimename . '.sql', 'a+');
        }
        $numtypes = array('tinyint', 'smallint', 'mediumint', 'int', 'bigint', 'float', 'double', 'decimal', 'real');

        $unwanted_tables = $this->getHistoryTables();
        
        if (empty($tables)) {
            $pstm1 = $DBH->query('SHOW TABLES');
            while ($row = $pstm1->fetch(PDO::FETCH_NUM)) {
                $tables[] = $row[0];
            }
        } else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }
        foreach ($tables as $table) {
            $unwanted_flag = 0;
            $result = $DBH->query("SELECT * FROM $table");
            $num_fields = $result->columnCount();
            $num_rows = $result->rowCount();
            $return = "";
            $pstm2 = $DBH->query("SHOW CREATE TABLE $table");
            $row2 = $pstm2->fetch(PDO::FETCH_NUM);
            $ifnotexists = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $row2[1]);
            $return .= "\n\n" . $ifnotexists . ";\n\n";
            if ($compression) {
                gzwrite($zp, $return);
            } else {
                fwrite($handle, $return);
            }
            $return = "";
            if ($num_rows) {
                if ($this->dbvars->SMALL_DB || !in_array($table, $unwanted_tables)) {
                    $unwanted_flag = 1;
                    $return = 'INSERT INTO `' . "$table" . "` (";
                    $pstm3 = $DBH->query("SHOW COLUMNS FROM $table");
                    $count = 0;
                    $type = array();
                    while ($rows = $pstm3->fetch(PDO::FETCH_NUM)) {
                        if (stripos($rows[1], '(')) {
                            $type[$table][] = stristr($rows[1], '(', true);
                        } else {
                            $type[$table][] = $rows[1];
                        }
                        $return .= "`" . $rows[0] . "`";
                        $count++;
                        if ($count < ($pstm3->rowCount())) {
                            $return .= ", ";
                        }
                    }
                    $return .= ")" . ' VALUES';
                    if ($compression) {
                        gzwrite($zp, $return);
                    } else {
                        fwrite($handle, $return);
                    }
                    $return = "";
                }
            }
            $count = 0;
            if ($unwanted_flag) {
                while ($row = $result->fetch(PDO::FETCH_NUM)) {
                    $return = "\n\t(";
                    for ($j = 0; $j < $num_fields; $j++) {
                            if (isset($row[$j])) {
                                if ((in_array($type[$table][$j], $numtypes)) && (!empty($row[$j])))
                                    $return .= $row[$j];
                                else
                                    $return .= $DBH->quote($row[$j]);
                            } else {
                                $return .= 'NULL';
                            }
                            if ($j < ($num_fields - 1)) {
                                $return .= ',';
                            }                        
                    }
                    $count++;
                    if ($count < ($result->rowCount())) {
                        $return .= "),";
                    } else {
                        $return .= ");";
                    }
                    if ($compression) {
                        gzwrite($zp, $return);
                    } else {
                        fwrite($handle, $return);
                    }
                    $return = "";
                }
            }

            $return = "\n\n-- ------------------------------------------------ \n\n";
            if ($compression) {
                gzwrite($zp, $return);
            } else {
                fwrite($handle, $return);
            }
            $return = "";
        }
        $error1 = $pstm2->errorInfo();
        $error2 = $pstm3->errorInfo();
        $error3 = $result->errorInfo();
        //echo $error1[2];
        //echo $error2[2];
        //echo $error3[2];
        if ($compression) {
            gzclose($zp);
        } else {
            fclose($handle);
        }
        if ($compression) {
            $path = $BACKUP_PATH . $nowtimename . '.sql.gz';
            $file = $nowtimename . '.sql.gz';
        } else {
            $path = $BACKUP_PATH . $nowtimename . '.sql';
            $file = $nowtimename . '.sql';
        }
        if (file_exists($path)) {
            $this->db->set('data ', $file);
            $this->db->where('id ', "$cron_job_id");
            $query = $this->db->update('cron_job');
            return $file;
        } else {
            return 0;
        }
    }

    /**
     * For getting the count of affiliates list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function countOfBackupList() {
        return $this->db->select('id')
                        ->from("cron_job")
                        ->where("cron_job", 'db_backup')
                        ->where("file_status !=", 'deleted')
                        ->where("status", 'Success')
                        ->order_by("id", "desc")
                        ->count_all_results();
    }

    /**
     * For getting the table column affiliates 
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @return type
     */
    function getTableColumnBackupList() {
        return array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'status', 'dt' => 1),
            array('db' => 'done_by', 'dt' => 2),
            array('db' => 'date', 'dt' => 3),
            array('db' => 'data', 'dt' => 4)
        );
    }

    /**
     * For total filtered affiliates list
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $where
     * @return type
     */
    function getTotalFilteredBackupList($table, $where) {

        if ($where) {
            $where = $where . " AND cron_job = 'db_backup' AND file_status != 'deleted' AND status = 'Success' ";
        } else {
            $where = " WHERE cron_job = 'db_backup' AND file_status != 'deleted' AND status = 'Success' ";
        }

        $query = $this->db->query("select * from " . $table . " " . $where . "");
        return $query->num_rows();
    }

    /**
     * For getting the affiliates List
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $table
     * @param type $where
     * @param type $order
     * @param type $limit
     * @return type
     */
    function getResultDataBackupList($table, $column, $where, $order, $limit) {
        $data = array();

        if ($where) {
            $where = $where . " AND cron_job = 'db_backup' AND file_status != 'deleted' AND status = 'Success' ";
        } else {
            $where = " WHERE cron_job = 'db_backup' AND file_status != 'deleted' AND status = 'Success' ";
        }

        $query = $this->db->query("select " . implode(' , ', $column) . " from " . $table . " " . $where . " " . $order . " " . $limit);
        foreach ($query->result_array() as $key => $val) {
            $data[] = array_values($val);
        }
        return $data;
    }

    function getHistoryTables() {
        $data=array();
        $res = $this->db->select("table_name")
                ->from("db_optimize")
                ->where('status', 1)
                ->get();
        $i=0;
        foreach ($res->result() as $row) {
            $data[$i] = $row->table_name;
            $i++;
        }
        return $data;
    }
    
}
