<?php 
    session_start();
    include("config.php");

    $orderId = $_SESSION['order_id'];
    $paymentMethod = !empty($_POST['paymentMethod']) ? $_POST['paymentMethod'] : '';
    $status = !empty($_POST['Status']) ? $_POST['Status'] : '';
    $paid_amount = !empty($_POST['PaidAmountCents']) ? $_POST['PaidAmountCents'] : '';

    //search if there's existing transaction with same order id
    $sql_search = "SELECT * FROM transactions WHERE order_id = '$orderId'";
    if($search_result = mysqli_query($conn, $sql_search)){
        // $rowcount = mysqli_num_rows($search_result);
        $data = mysqli_fetch_assoc($search_result);
        
        if ($data > 0){
            $id = $data['id'];
            $sql_update = "UPDATE transactions SET 
                payment_method = '$paymentMethod',
                `status` = '$status',
                paid_amount_cents = '$paid_amount' 
                WHERE id = '$id'";
                if ($result = mysqli_query($conn, $sql_update)){
                    echo "Transaction Updated Successfully"." ".$id;
                }
        } else {
            $sql_insert = "INSERT INTO transactions (id, `order_id`, payment_method, `status`, paid_amount_cents) VALUES (
                '$orderId',
                '$orderId',
                '$paymentMethod',
                '$status',
                '$paid_amount'
            )";
            if($result = mysqli_query($conn, $sql_insert)){
                echo "Transaction Added Successfully"." ".$orderId." ".$status." ".$paid_amount;
            }
        }
    }
?>