<?php 

    session_start();
    include('config.php');

    $orderId = $_POST['OrderId'];
    $status = !empty($_POST['Status']) ? $_POST['Status'] : '';
    $totalAmount = !empty($_POST['TotalAmount']) ? $_POST['TotalAmount'] : '';
    $isWalkIn = !empty($_POST['IsWalkIn']) ? $_POST['IsWalkIn'] : '';
    $transRefund = !empty($_POST['TransRefund']) ? $_POST['TransRefund'] : '';
    if ($isWalkIn){
        $isWalkIn = 1;
    }else {
        $isWalkIn = 0;
    }
    
    if(!empty($transRefund)){
        $sql_trans_search = "SELECT * FROM transactions WHERE order_id = '$orderId'";
        if($search_result = mysqli_query($conn, $sql_trans_search)){
            // $rowcount = mysqli_num_rows($search_result);
            $data = mysqli_fetch_assoc($search_result);
            if ($data > 0){
                $id = $data['id'];
                $sql_update = "UPDATE transactions SET 
                    `status` = '$transRefund'
                    WHERE id = '$id'";
                    if ($result = mysqli_query($conn, $sql_update)){
                        echo "Transaction Updated Successfully"." ".$id;
                    }
            }
        }
    }
    $sql_search = "SELECT * FROM `orders` WHERE id = '$orderId'";
    if($search_result = mysqli_query($conn, $sql_search)){
        $data = mysqli_fetch_assoc($search_result);

        if($data > 0){
            $id = $data['id'];
            $sql_update = "UPDATE `orders` SET 
            `status` = '$status',
            total_amount_cents = '$totalAmount',
            is_walkin = '$isWalkIn'
            WHERE id ='$id'";

            if($result = mysqli_query($conn, $sql_update)){
                echo "Order Updated Successfully";
            }
        }
    }
?>