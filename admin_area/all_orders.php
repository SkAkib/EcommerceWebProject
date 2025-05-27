<div class="container">
    <h1 class="text-center text-dark">All Categories</h1>
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Order id</th>
                <th>User id</th>
                <th> Total Amount</th>
                <th>Invoice No</th>
                <th>total products</th>
                <th>Order Date</th>
                <th>Order_status</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $get_all_orders = "select * from `user_orders`";
            $result_all_orders = mysqli_query($con, $get_all_orders);
            $sl = 1;
            while ($row_orders = mysqli_fetch_assoc($result_all_orders)) {
                $order_id = $row_orders['order_id'];
                $user_id = $row_orders['user_id'];
                $amount = $row_orders['amount_due'];
                $invoice = $row_orders['invoice_number'];
                $total_products = $row_orders['total_products'];
                $date = $row_orders['order_date'];
                $order_status= $row_orders['order_status'];
                
                

                echo "<tr>
                        <td>$sl</td>
                        <td>$order_id</td>
                        <td>$user_id</td>
                        <td>$amount</td>
                        <td>$invoice</td>
                        <td>$total_products</td>
                        <td>$date</td>
                        <td>$order_status</td>
                        </tr>";
                $sl++;
            }
            ?>

        </tbody>
    </table>
</div>