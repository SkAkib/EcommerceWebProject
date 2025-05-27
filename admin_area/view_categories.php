<div class="container">
    <h1 class="text-center text-dark">All Categories</h1>
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Category title</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $get_categories = "select * from `categories`";
            $result_cat = mysqli_query($con, $get_categories);
            $sl = 1;
            while ($row_cat = mysqli_fetch_assoc($result_cat)) {
                $cat_id = $row_cat['category_id'];
                $cat_title = $row_cat['category_title'];
                

                echo "<tr>
                        <td>$sl</td>
                        <td>$cat_title</td>
                        <td><a href='index.php?edit_category=$cat_id' class='text-success'><i CLASS='fa-solid fa-pen-to-square'></i></a></td>
                        <td><a href='index.php?delete_category=$cat_id' class='text-danger'><i CLASS='fa-solid fa-trash'></i></a></td>
                    </tr>";
                $sl++;
            }
            ?>

        </tbody>
    </table>
</div>