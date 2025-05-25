<?php
include('../includes/connect.php');
if(isset($_POST['insert_brand'])){
   $brand_title=$_POST['brand_title'];
   $category_id=$_POST['product_category'];
   
   //select data from database
   $select_query="select * from `brands` where brand_title='$brand_title'";
   $result_select=mysqli_query($con,$select_query);
   $number=mysqli_num_rows($result_select);
   if($number>0){
    echo"<script>alert('Brand is already present in the database')</script>";
   }
   else{
   $insert_query="insert into `brands` (brand_title,category_id) values('$brand_title','$category_id')";
   $result=mysqli_query($con,$insert_query);
   if($result){
    echo"<script>alert('brand has been inserted successfully')</script>";
   }
  }
}
?>
<h2 class="text-center">Insert Brands</h2>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-info"><i class="fa-solid fa-receipt"></i></span> 
  <div class="form-floating">
    <input type="text" class="form-control" name="brand_title" id="floatingInputGroup1" placeholder="Insert a Brand">
    <label for="floatingInputGroup1"></label>
  </div>
  <div class="form-outline mb-4 w-50 m-auto">
            <select name="product_category" id="" class="form-select">
                <option value="">select a category</option>
                <?php
                $select_query="select * from `categories`";
                $result_query=mysqli_query($con,$select_query);
                while($row=mysqli_fetch_assoc($result_query)){
                    $category_title=$row['category_title'];
                    $category_id=$row['category_id'];
                    echo "<option value='$category_id'>$category_title</option>";

                }
                ?>
            </select>
        </div>
</div>
<div class="input-group w-10 mb-2 m-auto">
    <input type="submit" class="form-control bg-info" name="insert_brand" value="Insert brands">
    <!--<button class="bg-info p-2 my-3 border-0">Insert brand</button>   -->
  </div>
</div>
</form>
