<h1 class="text-center text-success">All Products</h1>

<div class="container">
    <table class="table table-bordered border-dark mt-5 w-75 m-auto">
        <thead class="">
            <tr>
                <th class="bg-info">Product Id</th>
                <th class="bg-info">Title</th>
                <th class="bg-info">Image</th>
                <th class="bg-info">Price</th>
                <th class="bg-info">Total sold</th>
                <th class="bg-info">Status</th>
                <th class="bg-info">Edit</th>
                <th class="bg-info">Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $get_products = "select * from `products`";
            $result = mysqli_query($con, $get_products);
            while ($row_result = mysqli_fetch_assoc($result)) {
                $product_id = $row_result['product_id'];
                $product_title = $row_result['product_title'];
                $product_image1 = $row_result['product_image1'];
                $product_price = $row_result['product_price'];
                $status = $row_result['status'];

                //counting total sold
                $total_qty=0;
                $get_total_sold="select * from `pending_orders` where product_id=$product_id";
                $result_total=mysqli_query($con,$get_total_sold);
                while($rows_count=mysqli_fetch_array($result_total)){
                    $select_quantity=array($rows_count['quantity']);
                    $qty=array_sum($select_quantity);
                    $total_qty+=$qty;
                }
                

                echo "<tr class='text-center align-middle'>
                            <td>$product_id</td>
                            <td>$product_title</td>
                            <td><img src='./product_images/$product_image1' class='product_images'/></td>
                            <td>$product_price</td>
                            <td>$total_qty</td>
                            <td>$status</td>
                            <td><a href='index.php?edit_product=$product_id' class='text-success'><i CLASS='fa-solid fa-pen-to-square'></i></a></td>
                            <td><a href='index.php?delete_product=$product_id' class='text-danger'><i CLASS='fa-solid fa-trash'></i></a></td>
                        </tr>";
            }
            
            ?>
            
        </tbody>
    </table>
</div>