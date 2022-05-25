<?php 
    // include('popupmodal.php');
    session_start();
    include('config.php');

    if(isset($_POST['startOrderForm'])){
        $sql_rows = "SELECT id FROM `orders`";
        if($result = mysqli_query($conn, $sql_rows)){
            $rowcount = mysqli_num_rows($result);
        }
        echo $rowcount."<br>";
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
            echo "current order_id: ".$_SESSION['order_id'];
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
            /* .table {
                table-layout: fixed;
            } */
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
                        <?php 
                            // '<tr id="user-product-' + num + '" class="">' + 
                            // '<td id="product">' + name +'</td>' + 
                            // '<td id="item-price">' + price + '</td>' + 
                            // '<td id="item-quan-'+ num +'"  class="item-quan">' + 
                            // '<button class="remove btn btn-info mr-3" id="">' + 
                            // '<i class="fa fa-minus"></i>' + 
                            // '</button>' + ' ' + 1 + ' ' +
                            // '<button class="add btn btn-info ml-3" id="">' + 
                            // '<i class="fa fa-plus"></i>' + 
                            // '</button> ' + 
                            // '</td>' + 
                            // '<td id="item-cost-'+ num +'">' + price + '</td>' + 
                            // '</tr>' + 
                            // '';
                        ?>
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
            <!-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
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

<script type="text/javascript">
    var prod_num = $('.prod').length;
    console.log(prod_num);        
    var tax = 0.06;
    var order_total;

    var name, price, num;

    $("body").on("click", ".prod", function prod(){
        var prod = $(this).attr('id'); //returns product id
        var items_total = parseInt($('#items-total').text());
        var order_subtotal = $('#order-subtotal').text();
        order_subtotal = parseInt(order_subtotal.substring(order_subtotal.indexOf(' ') + 1));
        var quan = 1;

        if (prod == 'product-1'){
            num = 1;
            name = 'P1';
            price = 2;
        }else if(prod == 'product-2'){
            num = 2;
            name = 'P2';
            price = 3;
        }else if(prod == 'product-3'){
            num = 3;
            name = 'P3';
            price = 4;
        }else if(prod == 'product-4'){
            num = 4;
            name = 'P4';
            price = 5;
        }

        var row = '' + 
            '<tr id="user-product-' + num + '" class="">' + 
            '<td id="product">' + name +'</td>' + 
            '<td id="item-price">' + price + '</td>' + 
            '<td id="item-quan-'+ num +'"  class="item-quan">' + 
            '<button class="remove btn btn-info mr-3" id="">' + 
            '<i class="fa fa-minus"></i>' + 
            '</button>' + ' ' + quan + ' ' +
            '<button class="add btn btn-info ml-3" id="">' + 
            '<i class="fa fa-plus"></i>' + 
            '</button> ' + 
            '</td>' + 
            '<td id="item-cost-'+ num +'">' + price + '</td>' + 
            '</tr>' + 
            '';
        var row2 = name;
        // $('#new_row').append(row2);
        var row_count = $('#order-table tr').length;
        if ($('#user-product-'+ num +'').length == 0){
            if (row_count == 1){
                items_total = items_total + 1;
                order_subtotal = order_subtotal + price;
                var order_total = order_subtotal * (1 + tax);
                $('#order-table tr:last').after(row);
                $('#items-total').html(items_total);
                $('#order-subtotal').text('RM ' + order_subtotal.toFixed(2));
                $('#order-total').text('RM ' + order_total.toFixed(2));
                var message;
                $.ajax({
                    method: "post",
                    url: "orderItem.php",
                    data : {
                        'CostPerItem': price,
                        'ProductName': name,
                        'Quantity': quan 
                    },
                    success: function (response) {
                        message = response;
                        console.log(message);
                    }
                });
            }else if (row_count > 1){
                items_total = items_total + 1;
                order_subtotal = order_subtotal + price;
                var order_total = order_subtotal * (1 + tax);
                $('#order-table tr:last').after(row);
                $('#items-total').html(items_total);
                $('#order-subtotal').text('RM ' + order_subtotal.toFixed(2));
                $('#order-total').text('RM ' + order_total.toFixed(2));
                var message;
                $.ajax({
                    method: "post",
                    url: "orderItem.php",
                    data : {
                        'CostPerItem': price,
                        'ProductName': name,
                        'Quantity': quan 
                    },
                    success: function (response) {
                        message = response;
                        console.log(message);
                    }
                });
            }
        }
    });

    $("body").on("click", ".add", function add(){
        var prod = $(this).closest('tr').attr('id');
        var item = $(this).parent().attr('id');
        console.log(prod);
        console.log(item);
        var quan = parseInt($('#'+prod+' #'+item).text());
        var items_total = parseInt($('#items-total').text());
        var order_subtotal = $('#order-subtotal').text();
        order_subtotal = parseInt(order_subtotal.substring(order_subtotal.indexOf(' ') + 1));
        
        if (prod == 'user-product-1'){
            num = 1;
            name = 'P1';
            price = 2;
        }else if(prod == 'user-product-2'){
            num = 2;
            name = 'P2';
            price = 3;
        }else if(prod == 'user-product-3'){
            num = 3;
            name = 'P3';
            price = 4;
        }else if(prod == 'user-product-4'){
            num = 4;
            name = 'P4';
            price = 5;
        }
        quan = quan+1;
        items_total = items_total + 1;
        var item_cost = quan * price;
        var input =
            '<button class="remove btn btn-info mr-3" id="">' + 
            '<i class="fa fa-minus"></i>' + 
            '</button>' + ' ' + quan + ' ' +
            '<button class="add btn btn-info ml-3" id="">' + 
            '<i class="fa fa-plus"></i>' + 
            '</button> ';

        if(quan > 0){
            order_subtotal = order_subtotal + price;
            order_total = order_subtotal * (1 + tax);
            $('#'+prod+' #'+item).html(input);
            $('#items-total').html(items_total);
            $('#'+prod+' #item-cost-'+num).text(item_cost);
            $('#order-subtotal').text('RM ' + order_subtotal.toFixed(2));
            $('#order-total').text('RM ' + order_total.toFixed(2));
            var message;
            $.ajax({
                method: "post",
                url: "orderItem.php",
                data : {
                    'CostPerItem': price,
                    'ProductName': name,
                    'Quantity': quan 
                },
                success: function (response) {
                    message = response;
                    console.log(message);
                }
            });
        }


    });

    $("body").on('click', ".remove", function remove(){
        var prod = $(this).closest('tr').attr('id');
        var item = $(this).parent().attr('id');
        var quan = parseInt($('#'+prod+' #'+item).text());
        var items_total = parseInt($('#items-total').text());
        var order_subtotal = $('#order-subtotal').text();
        order_subtotal = parseInt(order_subtotal.substring(order_subtotal.indexOf(' ') + 1));
        // items_total = 0;
        if (prod == 'user-product-1'){
            num = 1;
            name = 'P1';
            price = 2;
        }else if(prod == 'user-product-2'){
            num = 2;
            name = 'P2';
            price = 3;
        }else if(prod == 'user-product-3'){
            num = 3;
            name = 'P3';
            price = 4;
        }else if(prod == 'user-product-4'){
            num = 4;
            name = 'P4';
            price = 5;
        }
        quan = quan-1;
        // console.log(quan);
        if(quan > 0 ){
            items_total = items_total - 1;
            var item_cost = quan * price;
            order_subtotal = order_subtotal - price;
            order_total = order_subtotal * (1 + tax);
            var input =
            '<button class="remove btn btn-info mr-3" id="">' + 
            '<i class="fa fa-minus"></i>' + 
            '</button>' + ' ' + quan + ' ' +
            '<button class="add btn btn-info ml-3" id="">' + 
            '<i class="fa fa-plus"></i>' + 
            '</button> ';
            $('#'+prod+' #'+item).html(input);
            $('#items-total').html(items_total);
            $('#'+prod+' #item-cost-'+num).text(item_cost);
            $('#order-subtotal').text('RM ' + order_subtotal.toFixed(2));
            $('#order-total').text('RM ' + order_total.toFixed(2));
            var message;
            $.ajax({
                method: "post",
                url: "orderItem.php",
                data : {
                    'CostPerItem': price,
                    'ProductName': name,
                    'Quantity': quan 
                },
                success: function (response) {
                    message = response;
                    console.log(message);
                }
            });
        } else {
            order_subtotal = order_subtotal - price;
            order_total = order_subtotal * (1 + tax);
            $('#order-subtotal').text('RM ' + order_subtotal.toFixed(2));
            $('#order-total').text('RM ' + order_total.toFixed(2));
            $('#'+prod).remove();
            var message;
            $.ajax({
                method: "post",
                url: "orderItem.php",
                data : {
                    'CostPerItem': price,
                    'ProductName': name,
                    'Quantity': 0 
                },
                success: function (response) {
                    message = response;
                    console.log(message);
                }
            });
        }

    });

    $('#order-check-out').on('click',function(e){
        e.preventDefault();
        console.log('open modal checkout');
        var row_count = $('#order-table tr').length;
        // console.log('row'+ row_count);
        if(row_count <= 1){
            $('#checkout-error').modal('toggle');
        } else {
            $('#payment-check-out').modal('toggle');
            var order_total = $('#order-total').text();
            // console.log(order_total);
            $('#checkout-order-total').text(order_total); //fill in modal
            order_total = order_total.replace('.','');
            console.log(order_total);

            order_total = order_total.substring(order_total.indexOf(' '));
            console.log(order_total);
            $.ajax({
                method: "post",
                url: "checkout.php",
                data : {
                    'Status': 'Pending',
                    'PaidAmountCents': order_total
                },
                success: function (response) {
                    message = response;
                    console.log(message);
                }
            });
        }


    });

    $('#checkout-total-paid').keyup(function(){
        // console.log($('#checkout-order-total').text());
        var order_total = $('#checkout-order-total').text();
        order_total = parseFloat(order_total.substring(order_total.indexOf(' ') + 1));
        // console.log('total');
        // console.log(order_total);
        order_total = order_total.toFixed(2);
        order_total_return = order_total.replace('.','');
        var total_paid = parseFloat($('#checkout-total-paid').val());
        total_paid = total_paid.toFixed(2);

        $('#checkout-order-total-input').val(order_total_return);
        if( total_paid >= order_total){
            $('#trans-submit').prop('disabled', false);
            var keyin_paid = total_paid - order_total;
            $('#checkout-change').text('RM '+ keyin_paid.toFixed(2));
            // $('#checkout-change-input').val(keyin_paid.toFixed(2));
        }

    });

    function transPaid(){
        var order_total = $('#order-total').text();
        order_total = order_total.replace('.','');
        order_total = order_total.substring(order_total.indexOf(' '));
        $.ajax({
            method: "post",
            url: "paid.php",
            data : {
                'Status': 'Completed',
                'TotalAmount': order_total,
                'IsWalkIn': true
            },
            success: function(response) {
                message = response;
                console.log(message);
            }
        })
    }

    $('#trans-submit').on('click', function(e){
        e.preventDefault();
        //paymentmethod, status, paidamountcents
        var paymentMethod = $('#payment-method').find(':selected').text();
        var status = 'Paid';
        var paidAmountCents = $('#checkout-order-total-input').val();
        $.ajax({
                method: "post",
                url: "checkout.php",
                data : {
                    'Status': status,
                    'PaidAmountCents': paidAmountCents,
                    'paymentMethod': paymentMethod
                },
                success: function (response) {
                    message = response;
                    transPaid();
                    console.log(message);
                    window.location.href = 'transaction.html';
                }
            });
    });

    $('#order-cancel').on('click', function(e){
        e.preventDefault();
        var order_total = $('#order-total').text();
        order_total = order_total.replace('.','');
        order_total = order_total.substring(order_total.indexOf(' '));
        $.ajax({
            method: "post",
            url: "paid.php",
            data : {
                'Status': 'Cancelled',
                'TotalAmount': order_total,
                'IsWalkIn': true
            },
            success: function(response) {
                message = response;
                console.log(message);
                window.location.href = 'orderCancel.html';
            }
        })
    });


</script>