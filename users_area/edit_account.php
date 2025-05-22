<?php
    if(isset($_GET['edit_account'])){
        $user_session_name=$_SESSION['username'];
        $select_query="select * from `users` where user_name='$user_session_name'";
        $result_query=mysqli_query($con,$select_query);
        $row_fetch=mysqli_fetch_assoc($result_query);
        $user_id=$row_fetch['user_id'];
        $user_name=$row_fetch['user_name'];
        $user_email=$row_fetch['user_email'];
        $user_address=$row_fetch['user_address'];
        $user_mobile=$row_fetch['user_mobile'];
}
    if(isset($_POST['user_update'])){
        $update_id=$user_id;
        $user_name=$_POST['user_name'];
        $user_email=$_POST['user_email'];
        $user_address=$_POST['user_address'];
        $user_mobile=$_POST['user_mobile'];
        $user_image=$_FILES['user_image']['name'];
        $user_image_tmp=$_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_tmp,"./users_images/$user_image");

        //update query
        $update_data="update `users` set user_name='$user_name',User_email='$user_email',user_image='$user_image',user_address='$user_address',user_mobile='$user_mobile' where user_id='$update_id'";
        $result_update=mysqli_query($con,$update_data);
        if($result_update){
            echo "<script>alert('Data updated!')</script>";
            echo "<script>window.open(profile.php,'_self')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>
<body>
    <h3 class="text-success mb-4">Edit account</h3>
    <div class="d-flex justify-content-center bg-success p-2" style="--bs-bg-opacity: .5">
    <div class="bg-success p-2 px-5 border border-5 rounded-4" style="--bs-bg-opacity: .5">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4 d-flex">
            <label for="user_name" class="form-label">Name:</label>
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_name ?>" name="user_name">
        </div>
        <div class="form-outline mb-4 d-flex">
            <label for="user_name" class="form-label">Email:</label>
            <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email ?>" name="user_email">
        </div>
        <div class="form-outline mb-4 d-flex">
            <label for="user_name" class="form-label">Image:</label>
            <input type="file" class="form-control " name="user_image">
            <img class="edit_image" src="./users_images/<?php echo $user_image?>" alt="">
        </div>
        <div class="form-outline mb-4 d-flex">
            <label for="user_name" class="form-label">Address:</label>
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address ?>" name="user_address">
        </div>
        <div class="form-outline mb-4 d-flex">
            <label for="user_name" class="form-label">Mobile:</label>
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_mobile ?>" name="user_mobile">
        </div>

        <input type="submit" value="update" class="bg-info py-2 px-3 b-0" name="user_update">
    </form>
    </div>
    </div>
</body>
</html>