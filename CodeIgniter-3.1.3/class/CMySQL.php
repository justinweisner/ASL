<?php

class CMySQL {

    // Variables
    var $sDbName;
    var $sDbUser;
    var $sDbPass;

    var $vLink;

    // Constructor
    function CMySQL() {
        $this->sDbName = 'Guestbook';
        $this->sDbUser = 'root';
        $this->sDbPass = 'root';

        // create db link
        $this->vLink = mysql_connect("localhost", $this->sDbUser, $this->sDbPass);

        //select the database
        mysql_select_db($this->sDbName, $this->vLink);

        mysql_query("SET names UTF8");
    }

    // Return one value result
    function getOne($query, $index = 0) {
        if (! $query)
            return false;
        $res = mysql_query($query);
        $arr_res = array();
        if ($res && mysql_num_rows($res))
            $arr_res = mysql_fetch_array($res);
        if (count($arr_res))
            return $arr_res[$index];
        else
            return false;
    }

    // Executing the SQL
    function res($query, $error_checking = true) {
        if(!$query)
            return false;
        $res = mysql_query($query, $this->vLink);
        if (!$res)
            $this->error('Database query error', false, $query);
        return $res;
    }

    // Return table of records as result in pairs
    function getPairs($query, $sFieldKey, $sFieldValue, $arr_type = MYSQL_ASSOC) {
        if (! $query)
            return array();

        $res = $this->res($query);
        $arr_res = array();
        if ($res) {
            while ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
                $arr_res[$row[$sFieldKey]] = $row[$sFieldValue];
            }
            mysql_free_result($res);
        }
        return $arr_res;
    }

    // Return table of records as result
    function getAll($query, $arr_type = MYSQL_ASSOC) {
        if (! $query)
            return array();

        if ($arr_type != MYSQL_ASSOC && $arr_type != MYSQL_NUM && $arr_type != MYSQL_BOTH)
            $arr_type = MYSQL_ASSOC;

        $res = $this->res($query);
        $arr_res = array();
        if ($res) {
            while ($row = mysql_fetch_array($res, $arr_type))
                $arr_res[] = $row;
            mysql_free_result($res);
        }
        return $arr_res;
    }

    // Return one row result
    function getRow($query, $arr_type = MYSQL_ASSOC) {
        if(!$query)
            return array();
        if($arr_type != MYSQL_ASSOC && $arr_type != MYSQL_NUM && $arr_type != MYSQL_BOTH)
            $arr_type = MYSQL_ASSOC;
        $res = $this->res ($query);
        $arr_res = array();
        if($res && mysql_num_rows($res)) {
            $arr_res = mysql_fetch_array($res, $arr_type);
            mysql_free_result($res);
        }
        return $arr_res;
    }

    // Escape
    function escape($s) {
        return mysql_real_escape_string($s);
    }

    // Get last id
    function lastId() {
        return mysql_insert_id($this->vLink);
    }

    // Display errors
    function error($text, $isForceErrorChecking = false, $sSqlQuery = '') {
        echo $text; exit;
    }
}

$GLOBALS['MySQL'] = new CMySQL();