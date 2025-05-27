<div class="container">
    <h1 class="text-center text-dark">All Categories</h1>
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>user id</th>
                <th>User name</th>
                <th>User email</th>
                <th>Image</th>
                <th>Ip address</th>
                <th>User address</th>
                <th>Mobile number</th>
                
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $get_all_users = "select * from `users`";
            $result_all_users = mysqli_query($con, $get_all_users);
            $sl = 1;
            while ($row_users = mysqli_fetch_assoc($result_all_users)) {
                $user_id = $row_users['user_id'];
                $user_name = $row_users['user_name'];
                $user_email = $row_users['user_email'];
                $user_image= $row_users['user_image'];
                $user_ip = $row_users['user_ip'];
                $user_address= $row_users['user_address'];
                $user_mobile= $row_users['user_mobile'];
                
                echo "<tr>
                        <td>$sl</td>
                        <td>$user_id</td>
                        <td>$user_name</td>
                        <td>$user_email</td>
                        <td>$user_image</td>
                        <td>$user_ip</td>
                        <td>$user_address</td>
                        <td>$user_mobile</td>

                        </tr>";
                $sl++;
            }
            ?>

        </tbody>
    </table>
</div>