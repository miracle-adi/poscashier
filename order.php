<?php 
    session_start();
    include('config.php');

    if(isset($_POST['startOrderForm'])){
        $sql_rows = "SELECT id FROM `orders`";
        if($result = mysqli_query($conn, $sql_rows)){
            $rowcount = mysqli_num_rows($result);
        }
        // echo $rowcount."<br>";
        $rowcount+=1;
        
        $orderTax = $_POST['orderTax'];
        $orderServiceCharge = $_POST['orderServiceCharge'];
        $totalAmountCents = $_POST['totalAmountCents'];
        $isWalkIn = $_POST['isWalkIn'];
        $orderStatus = $_POST['orderStatus'];
        $datetime = date("YmdHis");


        $sql_insert = "INSERT INTO `orders` (reference_no, tax, service_charge, total_amount_cents, is_walkin, `status`) VALUES (
            '$datetime$rowcount',
            '$orderTax', 
            '$orderServiceCharge',
            '$totalAmountCents',
            '$isWalkIn',
            '$orderStatus'
            )";
        if(mysqli_query($conn, $sql_insert)){
            $_SESSION['order_id'] =  mysqli_insert_id($conn);
            // echo "current order_id: ".$_SESSION['order_id'];
        }
        // echo "here";
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>POS Cashier</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <!-- jQuery library -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            .table td,th {
                text-align: center;   
            }

            .hr-color {
                border-bottom: solid black;
                width: 100%;
            }
            .border-col {
                border-right: solid black;
                height: 100%;
            }
            .btn-co {
                width: 150px;
                height: 80px;
            }
            .btn-success {
                width: 150px;
                height: 100px;
                font-size: large;
            }
            .padding-0 {
                padding-right:0;
                padding-left:0;
            }

            .btn-info {
                width: 30px;
                height: 30px;
                padding: 6px 0px;
                border-radius: 15px;
                font-size: 8px;
                text-align: center;
            }
        </style>       
    </head>
    <body>        
        <!-- <script src="" async defer></script> -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 border-col">
                    <div class="text-center mb-3">
                        POS <br> Cashier
                    </div>
                    <div class="row">
                        <table class="table" id="order-table">
                            <tr id="product-header">
                                <th>Product</th>
                                <th>Price <br>(RM)</th>
                                <th>Quantity</th>
                                <!-- <th></th> -->
                                <th>Cost <br> (RM)</th>
                            </tr>
                        </table>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-2">Subtotal</div>
                        <div class="col-md-8"></div>
                        <div class="col-md-2 text-center" id="order-subtotal">RM 0.00</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-4" id="items-no">No. of items</div>
                        <div class="col-md-6"></div>
                        <div class="col-md-2 text-center" id="items-total">0</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-4">Tax</div>
                        <div class="col-md-6"></div>
                        <div class="col-md-2 text-center">6%</div>
                    </div>
                    <div class="row my-1">
                        <div class="col-md-4">Service Charge</div>
                        <div class="col-md-6"></div>
                        <div class="col-md-2 text-center">-</div>
                    </div>
                    <hr class="hr-color">
                    <div class="row mb-5">
                        <div class="col-md-2">Total</div>
                        <div class="col-md-8"></div>
                        <div class="col-md-2 text-center" id="order-total">RM 0.00</div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <button class="btn btn-secondary btn-co" id="order-cancel">Cancel</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary btn-co" id="order-check-out">Check Out</button> 
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 text-center pt-2">
                            Products
                        </div>
                    </div>
                    <div class="row m-5 text-center">
                        <div class="col-md-12 my-2">
                            <button class="btn btn-success mr-5 w-300 prod" id="product-1">P1</button>
                            <button class="btn btn-success w-300 prod" id="product-2">P2</button>
                        </div>
                    </div>
                    <div class="row my-1 mx-5 text-center">
                        <div class="col-md-12 my-2">
                            <button class="btn btn-success mr-5 prod" id="product-3">P3</button>
                            <button class="btn btn-success prod" id="product-4">P4</button>
                        </div>
                    </div>
                </div>
            </div>
 
        </div>
    </body>

    <!-- Modal -->
    <div class="modal fade" id="payment-check-out" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row my-4">
                        <div class="col-md-8">
                            Total Paid Amount
                        </div>
                        <div class="col-md-3" id="">
                            <input type="text" placeholder="0.00" class="form-control" name="checkoutTotalPaid" id="checkout-total-paid" value="">
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-8">
                            Total
                        </div>
                        <div class="col-md-4" id="checkout-order-total"></div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-8">
                            Payment method
                        </div>
                        <div class="col-md-4" id="">
                        <select class="custom-select" name="PaymentMethod" id="payment-method">
                            <option selected value="Cash">Cash</option>
                            <option value="Card">Card</option>
                            <option value="Online Banking">Online Banking</option>
                        </select>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-8">
                            Change
                        </div>
                        <div class="col-md-4" id="checkout-change">
                            RM 0.00
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-right">
                            <button type="button" id="trans-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        <input type="hidden" name="checkoutOrderTotal" id="checkout-order-total-input" value="">
                        <!-- <input type="hidden" name="checkoutChange" id="checkout-change-input" value=""> -->
                        <div class="col-md-4 text-center">
                            <button type="button" id="trans-submit" disabled class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- Error checkout modal-->
    <div class="modal fade" id="checkout-error"tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Please choose a product</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
</html>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

<script type="text/javascript" src="js/order.js"></script>