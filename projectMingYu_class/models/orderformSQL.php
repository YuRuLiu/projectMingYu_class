<?php
    require_once("connect.php");
    header("content-type:text/html;chaset=utf-8");
    
    class orderform
    {
        function update($orderformID,$deadline,$totalPrice,$clientName)
        {
            $sql_update = "update `orderform`
                           inner join `client`
                           on `orderform`.`clientID`=`client`.`clientID`
                           set `orderform`.`orderformID`='".$orderformID."',`client`.`deadline`='".$deadline."',`orderform`.`total`='".$totalPrice."' 
                           where `client`.`clientName`='".$clientName."'";
            $result_update = mysql_query($sql_update) or die('MySQL query error3'); 
            return $result_update;
        }
        
        function content()
        {
            $sql_content = "select `orderform`.`orderformID`,`client`.`clientName`,`client`.`deadline`,`orderform`.`total` 
                            from `orderform`
                            inner join `client`
                            on `orderform`.`clientID`=`client`.`clientID`";
            $result_content = mysql_query($sql_content) or die('MySQL query error1');
            return $result_content;
        }
        
        function paging($orderpage,$pagesize)
        {
            $sql_paging = "select `orderform`.`orderformID`,`client`.`clientName`,`client`.`deadline`,`orderform`.`total` 
                           from `orderform`
                           inner join `client`
                           on `orderform`.`clientID`=`client`.`clientID`
                           limit ".$orderpage*$pagesize.",".$pagesize."";
            $result_paging = mysql_query($sql_paging) or die('MySQL query error2');
            return $result_paging;
        }
        
        function insert_IDTotal($insertOrderformID,$insertTotal)
        {
            $sql_insert_IDTotal = "insert `orderform`(`orderformID`,`total`) 
                                   value('".$insertOrderformID."','".$insertTotal."')";
            $result_insert_IDTotal = mysql_query($sql_insert_IDTotal) or die('MySQL query error4');
            return $result_insert_IDTotal;     
        }
        
        function update_clientID($plusClientID)
        {
            $sql_update_clientID = "update `orderform` 
                                    set `clientID`='".$plusClientID."' 
                                    where `clientID`=''";
            $result_update_clientID = mysql_query($sql_update_clientID) or die('MySQL query error8');
            return $result_update_clientID;
        }
        
        function Delete($deleteOrderID)
        {
            $sql_delete = "delete from `orderform` 
                           where `orderform`.`orderformID` = '".$deleteOrderID."'";
            $result_delete = mysql_query($sql_delete) or die('MySQL query error10');
        }
    }
    
    class client
    {
        function insert_NameDeadline($insertClientName,$insertDeadline)
        {
            $sql_insert_NameDeadline = "insert `client`(`clientName`,`deadline`) 
                                        value('".$insertClientName."','".$insertDeadline."')";
            $result_insert_NameDeadline = mysql_query($sql_insert_NameDeadline) or die('MySQL query error5');
            return $result_insert_NameDeadline;     
        }
        
        function select_clientID()
        {
            $sql_select_clientID = "select `clientID` 
                                    from `client` 
                                    order by `clientID` desc 
                                    limit 1";
            $result_select_clientID = mysql_query($sql_select_clientID) or die('MySQL query error6'); 
            $row_select_clientID = mysql_fetch_row($result_select_clientID);
            return $row_select_clientID;
        }
        
        function update_clientID($plusClientID)
        {
            $sql_update_clientID = "update `client` 
                                    set `clientID`='".$plusClientID."' 
                                    where `clientID`=''";
            $result_update_clientID = mysql_query($sql_update_clientID) or die('MySQL query error7');
            return $result_update_clientID;
        }
        
        function Delete($deleteOrderID)
        {
            $sql_delete = "delete `client` from `client` 
                           inner join `orderform`
                           on `client`.`clientID`=`orderform`.`clientID`
                           where `orderformID` = '".$deleteOrderID."'";                    
            $result_delete = mysql_query($sql_delete) or die('MySQL query error9');
            return $result_delete;
        }
    }
    
    class detail
    {
        function Delete($deleteOrderID)
        {
            $sql_delete = "delete from `detail` 
                           where `orderformID` = '".$deleteOrderID."'";
            $result_delete = mysql_query($sql_delete) or die('MySQL query error11');
        }
    }
?>