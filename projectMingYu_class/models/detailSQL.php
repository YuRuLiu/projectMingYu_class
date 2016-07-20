<?php
    require_once("connect.php");
    header("content-type:text/html;chaset=utf-8");
    
    class orderform
    {
        function select_clientName($orderform)
        {
            $sql_select_clientName = "select `client`.`clientID`,`client`.`clientName` 
                                      from `orderform`
                                      inner join `client`
                                      on `orderform`.`clientID`=`client`.`clientID`
                                      where `orderformID`='".$orderform."'";
            $result_select_clientName = mysql_query($sql_select_clientName) or die('MySQL query error1');
            $row_select_clientName = mysql_fetch_row($result_select_clientName);
            return $row_select_clientName;
        }
    }
    
    class detail
    {
        function content($orderform)
        {
            $sql_content = "select `detail`.`productID`,`product`.`productName`,`detail`.`quantity`,`detail`.`orderformID` 
                            from `detail` 
                            inner join  `product`
                            on `detail`.`productID` = `product`.`productID`
                            where `detail`.`orderformID`= '".$orderform."'";
            $result_content = mysql_query($sql_content) or die('MySQL query error2');
            return $result_content;
        }
        
        function paging($orderform,$p,$pagesize)
        {
            $sql_paging = "select `detail`.`productID`,`product`.`productName`,`detail`.`quantity` 
                           from `detail` 
                           inner join  `product`
                           on `detail`.`productID` = `product`.`productID`
                           where `detail`.`orderformID`= '".$orderform."'
                           limit ".($p * $pagesize).", ".$pagesize."";
            $result_paging = mysql_query($sql_paging) or die('MySQL query error3');
            return $result_paging;
        }
        
        function update($quantity,$productID)
        {
            $sql_update = "update `detail` 
                           set `quantity`='".$quantity."'
                           where `productID`='".$productID."'";
            $result_update = mysql_query($sql_update) or die('MySQL query error4'); 
            return $result_update;
        }
        
        function insert($orderID,$key,$value,$clientID)
        {
            $sql_insert = "insert into `detail`
                           (`orderformID`,`productID`,`quantity`,`clientID`)
                           values('".$orderID."','".$key."','".$value."','".$clientID."')";
            $result_insert = mysql_query($sql_insert) or die('MySQL query error6');
            return $result_insert;
        }
        
        function Delete($deleteOrderformID,$deleteProductID)
        {
            $sql_delete = "delete from `detail` 
                           where `orderformID` = '".$deleteOrderformID."' AND `productID` = '$deleteProductID'";
            $result_delete = mysql_query($sql_delete) or die('MySQL query error7');
            return $result_delete;
        }
    }
    
    class product
    {
        function content()
        {
            $sql_content = "select `productID`,`productName` 
                            from `product` 
                            where `placeID`='2'";
            $result_content = mysql_query($sql_content) or die('MySQL query error5');
            return $result_content;
        }
    }
?>