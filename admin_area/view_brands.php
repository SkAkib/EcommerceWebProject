<div class="container">
    <h1 class="text-center text-dark">All Brands</h1>
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>brand title</th>
                <th>category</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $get_brands = "select * from `brands`";
            $result_brand = mysqli_query($con, $get_brands);
            $sl = 1;
            while ($row_brand = mysqli_fetch_assoc($result_brand)) {
                $brand_id = $row_brand['brand_id'];
                $brand_title = $row_brand['brand_title'];
                $category_id = $row_brand['category_id'];

                $select_query = "SELECT * FROM `categories` where category_id=$category_id";
                $result_query = mysqli_query($con, $select_query);
                $row = mysqli_fetch_assoc($result_query);
                $category_title = $row['category_title'];
                
                
                

                echo "<tr>
                        <td>$sl</td>
                        <td>$brand_title</td>
                        <td>$category_title</td>
                        <td><a href='index.php?edit_brand=$brand_id' class='text-success'><i CLASS='fa-solid fa-pen-to-square'></i></a></td>
                        <td><a href='index.php?delete_brand=$brand_id' class='text-danger'><i CLASS='fa-solid fa-trash'></i></a></td>
                    </tr>";
                $sl++;
            }
            ?>

        </tbody>
    </table>
</div>