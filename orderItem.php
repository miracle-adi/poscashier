<?php 
    session_start();
    include("config.php");

    $orderId = $_POST['OrderId'];

    $cost = !empty($_POST['CostPerItem']) ? $_POST['CostPerItem'] : '';
    $productName = !empty($_POST['ProductName']) ? $_POST['ProductName'] : '';
    $prodQuantity = !empty($_POST['Quantity']) ? $_POST['Quantity'] : '';

    //search if there's existing item with same order id
    $sql_search = "SELECT * FROM order_items WHERE order_id = '$orderId' AND product_name = '$productName'";
    if($search_result = mysqli_query($conn, $sql_search)){
        // $rowcount = mysqli_num_rows($search_result);
        $data = mysqli_fetch_assoc($search_result);
        if ($data > 0){
            $id = $data['id'];
            $sql_update = "UPDATE order_items SET quantity = $prodQuantity WHERE id = '$id'";
            if ($result = mysqli_query($conn, $sql_update)){
                echo "Item Updated Successfully"." ".$id;
            }else{
                echo mysqli_error($conn);
            }
        } else {
            $sql_insert = "INSERT INTO order_items (order_id, cost_per_item, product_name, quantity) VALUES (
                '$orderId',
                '$cost',
                '$productName',
                '$prodQuantity'
            )";
            if($result = mysqli_query($conn, $sql_insert)){
                echo "Item Added Successfully"." ".$cost." ".$productName." ".$prodQuantity;
            }
        }
    }
?>