<?php

/**
 * Class: fireSQL
 * Author: Jacob McKinney
 * Date: 3/17/2017
**/

class fireSQL {
    
    function __construct() {
        
    }
    
    /**
     *  Inserts data into the specified table.
     *  
     *  The data inserted and columns to be inserted into are provided in array format with $cols and $datas
     *  
     *  @param string $table with the name of the table you wish to insert the data into
     *  @param array $cols with an array of columns to be inserted
     *  @param array $datas with an array of values to be inserted with the associated columns
     * 
     *  @return int $insert_id; 
     **  
    */
    
    function direct_call($query){
        $db = db::instance();
        $call = $db->query($query);
        return $call;
    }

    function insert($table, $cols = array(), $datas = array()) {
        $db = db::instance();
        $fCols = '';
        $fVals = '';
        foreach($cols as $col) { $fCols .= ($fCols)?",".$col:$col; }
        foreach($datas as $data) { $fVals .= ($fVals)?(",'".$data."'"):("'".$data."'"); }
        $qryStr = "INSERT INTO $table ($fCols) VALUES ($fVals)";
        //print($qryStr.'</br>');
        $query = $db->query($qryStr);
        return $db->insert_id;
    }
    
    /**
     *  Selects data into the specified table.
     *  
     *  The data is selected by specifing cols for return and results in a col / val pairing
     *  
     *  @param string $table with the name of the table you wish to update the data of
     *  @param array $cols with an array of columns to be updated
     *  @param array $rules with an array of SQL WHERE values to be used with the update, in a col / val, key / val pairing. Rules only allow for "AND" additional statements
     * 
     *  @return associated array with requested cols; 
     **  
    */
    function select_old($table, $cols = array(), $rules = array()) {
        $db = db::instance();
        $fCols = '';
        $fRules = '';
        foreach($cols as $col) { $fCols .= ($fCols)?",".$col:$col; }
        foreach($rules as $col => $val) { $fRules .= ($fRules)?(" && $col = '$val'"):("$col = '$val'");}
        if($fRules != "") {
            $query = "SELECT $fCols FROM $table WHERE $fRules";
        } else {
            $query = "SELECT $fCols FROM $table";
        }
        $call = $db->query($query);
    
        return $call;
    }
    
    function select($table, $cols = array(), $rules = array(), $conCat = null, $order = null) {
        $db = db::instance();
        $fCols = '';
        $fRules = '';
        if($conCat == "OR") {
            $appender = "||";
        } else {
            $appender = "&&";
        }
        
        if($order != "" && $order != NULL) {
            $sort = $order;
        } else {
            $sort = "";
        }
        
        foreach($cols as $col) { $fCols .= ($fCols)?",".$col:$col; }
        foreach($rules as $col => $val) { $fRules .= ($fRules)?(" $appender $col = '$val'"):("$col = '$val'");}
        if($fRules != "") {
            $query = "SELECT $fCols FROM $table WHERE $fRules $sort";
        } else {
            $query = "SELECT $fCols FROM $table $sort";
        }
        
        $call = $db->query($query);
        return $call;
    }
    
    /**
     *  Updates data from the specified table.
     *  
     *  The data is selected by specifing cols for return and results in a col / val pairing and columns to be used are provided in array format with $cols and $datas
     *  
     *  @param string $table with the name of the table you wish to update the data of
     *  @param array $cols with an array of columns to be updated
     *  @param array $datas with an array of values to be updated with the associated columns
     *  @param array $rules with an array of SQL WHERE values to be used with the update, in a col / val, key / val pairing. Rules only allow for "AND" additional statements
     * 
     *  @return void; 
     **  
    */
    function update($table, $cols = array(), $datas = array(), $rules = array()) {
        $db = db::instance();
        $colsVals = '';
        $fRules = '';
        
        $i = 0;
        $len = count($cols);
        foreach($cols as $key => $col) { 
            if($i == $len -1){
                $colsVals .= "`$col`=\"".$datas[$key]."\"";
            }else{
                $colsVals .= "`$col`=\"".$datas[$key]."\", ";
            }
            $i++;
        }

        foreach($rules as $col => $val) { $fRules .= ($fRules)?($fRules." && $col = '$val'"):("$col = \"$val\"");}
        $query = "UPDATE $table SET $colsVals WHERE $fRules";
        //print_r($query);
        $call = $db->query($query);
        return $call;

    }
    
    /**
     *  Deletes data from the specified table.
     *  
     *  The data deleted SQL WHERE rules to be provided in a col / val pairing to delete specified rows. LIMIT clause not added by default, allows multiple row deletion, considered unsafe.
     *  
     *  @param string $table with the name of the table you wish to delete the data into
     *  @param array $rules with an array of SQL WHERE values to be used with the update, in a col / val, key / val pairing. Rules only allow for "AND" additional statements
     * 
     *  @return void; 
     **  
    */
    function delete($table, $rules) {
        $db = db::instance();
        $fRules = '';
        foreach($rules as $col => $val) { $fRules .= ($fRules)?(" && $col = '$val'"):("$col = '$val'");}
        $query = $db->query("DELETE FROM $table WHERE $fRules");
        return $db->affected_rows;
    }


    function search($table, $rules){
        $db = db::instance();
        $fRules = '';
        foreach($rules as $col => $val) { $fRules .= ($fRules)?(" && $col LIKE '%$val%'"):("$col LIKE '%$val%'");}
        $query = "SELECT FROM $table WHERE $fRules";
        //print($query);
        $call = $db->query($query);

        return $call;
    }
}

?>