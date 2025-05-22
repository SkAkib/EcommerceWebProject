<?php
if(isset($_POST['delete'])){
    $user_name=$_SESSION['username'];

    $delete_user="delete from `users` where user_name='$user_name'";
    $result_user=mysqli_query($con,$delete_user);
    if($result_user){
        session_destroy();
        echo "<script>alert('Deleted success fully!')</script>";
    }
    echo "<script>window.open('../index.php','_self')</script>";
}elseif(isset($_POST['cancel'])){
    echo "<script>window.open('profile.php','_self')</script>";
}
?>

<div class="container m-10 border border-2">
    <h1 class="text-center text-danger mb-4">Delete Account?</h1>
    <div>
        <form action="" method="post" style="width:20%" class="my-4 m-auto">
            <div class="form-outline">
                <input type="submit" class="form-control text-danger" name="delete" value="Confirm">
                <input type="submit" class="form-control" name="cancel" value="Cancel">
            </div>
        </form>
    </div>
</div>