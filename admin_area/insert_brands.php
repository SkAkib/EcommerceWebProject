<?php
include('../includes/connect.php');
if(isset($_POST['insert_brand'])){
   $brand_title=$_POST['brand_title'];
   
   //select data from database
   $select_query="select * from `brands` where brand_title='$brand_title'";
   $result_select=mysqli_query($con,$select_query);
   $number=mysqli_num_rows($result_select);
   if($number>0){
    echo"<script>alert('Brand is already present in the database')</script>";
   }
   else{
   $insert_query="insert into `brands` (brand_title) values('$brand_title')";
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
</div>
<div class="input-group w-10 mb-2 m-auto">
    <input type="submit" class="form-control bg-info" name="insert_brand" value="Insert brands">
    <!--<button class="bg-info p-2 my-3 border-0">Insert brand</button>   -->
  </div>
</div>
</form>
