<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
    $select_data="select * from `user_orders` where order_id=$order_id";
    $result_data=mysqli_query($con,$select_data);
    $row_fetch=mysqli_fetch_assoc($result_data);
    $invoice_number=$row_fetch['invoice_number'];
    $invoice_number=$row_fetch['invoice_number'];
    $amount_due=$row_fetch['amount_due'];

    if(isset($_POST['confirm_payment'])){
        $payment_method=$_POST['payment_mode'];

        $insert_query="insert into `user_payments` (order_id,invoice_number,amount,payment_method) values ($order_id,$invoice_number,$amount_due,'$payment_method')";
        $result_insert=mysqli_query($con,$insert_query);
        if($result_insert){
            echo "<h3 class='text-center text-light'>Successfully Done!</h3>";
            echo "<script>window.open('profile.php?my_orders','_self')</script>";
        }
        $update_orders="update `user_orders` set order_status='completed' where order_id=$order_id";
        $result_update=mysqli_query($con,$update_orders);
        $update_pending_orders_status="update `pending_orders` set order_status='completed' where order_id=$order_id";
        $result_update_pending_order_status=mysqli_query($con,$update_pending_orders_status);
    }

}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment</title>
    <!-- bootsrap CSS link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--CSS link-->
  <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-secondary m-5 border border-4 p-2">
    
    <div class="container my-5 border border-2">
        <h1 class="text-center text-light">Confirm Payment</h1>
        <form action="" method="post" class="border border-2 border-danger">
            <div class="form-outline my-4 text-center border border-1 w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto mb-3" name="invoice_number" value="<?php echo $invoice_number; ?>" readonly>
            </div>
            <div class="form-outline my-4 text-center border border-1 w-50 m-auto">
                <label for="" class="text-light">Amount:</label>
                <input type="text" class="form-control w-50 m-auto" name="Amount" value="<?php echo $amount_due; ?>" readonly>
            </div>
            <div class="form-outline my-4 text-center border border-1 w-50 m-auto">
                <select name="payment_mode" id="" class="form-select w-50 m-auto">
                    <option value="">Select Payment method</option>
                    <option value="">Internet Banking</option>
                    <option value="">Paypal</option>
                    <option value="">Cash on delivery</option>
                    <option value="">Pay offline</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center border border-1 w-50 m-auto">
                <input type="submit" class="bg-info py-2 px-3 border-0" value="confirm_payment" name="confirm_payment">
            </div>
        </form>
    </div>

<!-- bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>