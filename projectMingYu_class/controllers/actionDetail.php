<?php 
    session_start();
    header("content-type:text/html;charset=utf-8");
    include("../models/detailSQL.php");
    
    /*--取得此筆訂單編號--*/
    $orderform=$_GET['orderform'];
    
    /*--修改明細POST的值--*/
    $updateDetailOK = $_POST["updateDetailOK"];
    $update_quantity = $_POST["update_quantity"];
    $update_productID = $_POST["update_productID"];
    $update_orderformID = $_POST["update_orderformID"];
    $page = $_POST["p"];
    $plus_quantity = $_POST["plus_quantity"];
    
    /*--新增明細POST的值--*/
    $insertDetailOK=$_POST["insertDetailOK"];
    $product = $_POST ["product"];
    $insertQuantity = $_POST["insertQuantity"];
    $insert_orderformID = $_POST["insert_orderformID"];
    $insert_clientID = $_POST["insert_clientID"];
    
    /*--刪除明細POST的值--*/
    $deleteDetailOK = $_POST["deleteDetailOK"];
    $delete_productID = $_POST["delete_productID"];
    $delete_orderformID = $_POST["delete_orderformID"];
    
    /*--取得案名--*/
    $select_clientName = new orderform();
    $clientName = $select_clientName -> select_clientName($orderform);
    
    /*--計算分頁--*/
    $compute_paging = new detail();
    $show_total = $compute_paging -> content($orderform);
    $total = mysql_num_rows($show_total); //取得資料的總數
    $pagesize=10;                           //單頁筆數
    $totalpages= ceil($total/ $pagesize);   //總頁數
    $detailPage = $_GET['detailPage'];
    if ($detailPage=="")
        $detailPage=0;
    
    /*--顯示分頁於table--*/
    $paging = new detail();
    $show_paging = $paging -> paging($orderform,$detailPage,$pagesize);
    
    /*--顯示此筆明細於update modal--*/
    $update_modal = new detail();
    $show_update_modal = $update_modal -> content($orderform);
    
    /*--顯示此筆明細於delete modal--*/
    $delete_modal = new detail();
    $show_delete_modal = $delete_modal -> content($orderform);
    
    /*--顯示商品清單於insert modal--*/
    $select_product = new product();
    $show_list = $select_product -> content();
    
    /*--修改明細數量--*/
    if(isset ($updateDetailOK))
    {
        $update = new detail();
        $update -> update($update_quantity,$update_productID);
        
        refresh_detail($update_orderformID,$page);
    }
    
    /*--新增明細--*/
    $quantityNotNull = @array_filter($insertQuantity); //將空值濾掉，保留有值的元素
    $insertDetail = @array_combine($product, $quantityNotNull); //結合2個陣列，2個陣列元素的數量須相同
    
    if(isset($insertDetailOK))
    {
        foreach ($insertDetail as $key => $value)
        {    
            $insert = new detail();
            $insert -> insert($insert_orderformID,$key,$value,$insert_clientID);
        }
        
        refresh_detail($insert_orderformID,$page);
    }
    
    /*--刪除此筆明細--*/
    if(isset($deleteDetailOK))
    {
        $delete = new detail();
        $delete -> Delete($delete_orderformID,$delete_productID);
        
        refresh_detail($delete_orderformID,$page);
    }
    
    /*--刷新頁面--*/
    function refresh_detail($orderID,$page)
    {
        $url = '../views/detail.php?orderform='.$orderID.'&detailPage='.$page; 
        header("refresh: 1;url='$url'"); 
    }
?>