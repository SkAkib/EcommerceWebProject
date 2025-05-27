<?php
//delete a category
if (isset($_GET['delete_category'])) {
    $delete_id = $_GET['delete_category'];
    
}
$get_category_title="select * from `categories` where category_id=$delete_id";
$result=mysqli_query($con,$get_category_title);
$row_result=mysqli_fetch_assoc($result);
$category_title=$row_result['category_title'];



?>
<form action="" method="post">
    <div class="container h-50 w-75 bg-secondary border border-5 rounded">
        <div class="h-25 w-50 border border-dark mt-5 w-75 m-auto">
            <div class="text-center pb-3">
                <h3>Delete <?php echo $category_title; ?>?</h3>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary px-3 m-2" name="delete_btn_yes">Yes</button>
            <button type="submit" class="btn btn-primary px-3 m-2" name="delete_btn_no">No</button>
        </div>
    </div>
</form>
<?php
if (isset($_POST['delete_btn_yes'])) {
    // Perform the deletion
    $delete_query = "DELETE FROM `categories` WHERE category_id = $delete_id";
    $result_delete = mysqli_query($con, $delete_query);
    if ($result_delete) {
        echo "<script>alert('category deleted successfully');</script>";
        echo "<script>window.location.href = 'index.php?view_categories';</script>";
    }
} elseif (isset($_POST['delete_btn_no'])) {
    // Redirect without deleting
    echo "<script>window.location.href = 'index.php?view_categories';</script>";
}
?>