<div class="container">
    <h3 class="text-success">All Orders</h3>
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Order number</th>
                <th>Amount due</th>
                <th>Total products</th>
                <th>Invoice No.</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $user_name = $_SESSION['username'];
            $get_user_id = "select * from `users` where user_name='$user_name'";
            $result_get_user_id = mysqli_query($con, $get_user_id);
            $row_user_id = mysqli_fetch_assoc($result_get_user_id);
            $user_id = $row_user_id['user_id'];

            $get_order_details = "select * from `user_orders` where user_id=$user_id";
            $result_order_details = mysqli_query($con, $get_order_details);
            $sl_no = 1; //for user_orders_table serial no display
            while ($row_order_details = mysqli_fetch_assoc($result_order_details)) {
                $order_id = $row_order_details['order_id'];
                $order_amount = $row_order_details['amount_due'];
                $order_total_products = $row_order_details['total_products'];
                $order_invoice_number = $row_order_details['invoice_number'];
                $order_status = $row_order_details['order_status'];
                $order_date = $row_order_details['order_date'];


                if ($order_status == 'pending') {
                    $order_status = 'incomplete';
                } else {
                    $order_status = 'complete';
                }

                echo "<tr>
                    <td>$sl_no</td>
                    <td>$order_id</td>
                    <td>$order_amount</td>
                    <td>$order_total_products</td>
                    <td>$order_invoice_number</td>
                    <td>$order_date</td>
                    <td>$order_status</td>";
                if ($order_status == 'pending' OR $order_status == 'incomplete') {
                    echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-success'>Confirm</td>";
                } else {
                    echo "<td><a href='profile.php?order_details=?' class='text-success'>View</td>";
                }

                echo "</tr>";
                $sl_no++;
            }
            ?>

        </tbody>
    </table>

</div>