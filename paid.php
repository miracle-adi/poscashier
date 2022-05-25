<?php 

    session_start();
    include('config.php');

    $orderId = $_SESSION['order_id'];
    $status = !empty($_POST['Status']) ? $_POST['Status'] : '';
    $totalAmount = !empty($_POST['TotalAmount']) ? $_POST['TotalAmount'] : '';
    $isWalkIn = !empty($_POST['IsWalkIn']) ? $_POST['IsWalkIn'] : '';

    if ($isWalkIn){
        $isWalkIn = 1;
    }else {
        $isWalkIn = 0;
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