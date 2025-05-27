<div class="container">
    <h1 class="text-center text-dark">All Categories</h1>
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Payment id</th>
                <th>Order id</th>
                <th>Invoice No</th>
                <th> Total Amount</th>
                <th>Payment method</th>
                <th>Order Date</th>
                
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $get_all_payments = "select * from `user_payments`";
            $result_all_payments = mysqli_query($con, $get_all_payments);
            $sl = 1;
            while ($row_payments = mysqli_fetch_assoc($result_all_payments)) {
                $payment_id = $row_payments['payment_id'];
                $order_id = $row_payments['order_id'];
                $invoice = $row_payments['invoice_number'];
                $amount = $row_payments['amount'];
                $payment_method = $row_payments['payment_method'];
                $date = $row_payments['date'];
                
                echo "<tr>
                        <td>$sl</td>
                        <td>$payment_id</td>
                        <td>$order_id</td>
                        <td>$invoice</td>
                        <td>$amount</td>
                        <td>$payment_method</td>
                        <td>$date</td>
                        </tr>";
                $sl++;
            }
            ?>

        </tbody>
    </table>
</div>