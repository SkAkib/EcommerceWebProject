<!--

<--cart table body static->
<tbody>
    <td>Apple</td>
    <td> <img src="./image/apple.jpg" alt="image-alt" class="cart_img"></td>
    <td> <input type="text" name="" id=""></td>
    <td>900</td>
    <td> <input type="checkbox" name="" id=""></td>
    <td>
    <button class="bg-info px-3 border-0 p-2 mx-1">Update</button>
    <button class="bg-info px-3 border-0 p-2 mx-1">Remove</button>
    </td>
</tbody>


<form action='' method='post'>
        <tbody>
        <td>$product_title</td>
        <td> <img src='./admin_area/product_images/$product_image' alt='image-alt' class='cart_img'></td>
        <td> <input type='text' name='qty' id='' class='form-input w-35 text-center'></td>
        
        <td>$product_price_sum</td>
        <td> <input type='checkbox' name='' id=''></td>
        <td>
          <input type='submit' value='update cart' name='update_cart' class='bg-info px-3 border-0 p-2 mx-1'></button>
          <button class='bg-info px-3 border-0 p-2 mx-1'>Remove</button>
        </td>
      </tbody>
       </form>

       //function to update item quantity in cart
      if(isset($_POST['update_cart'])){
        $quantities=$_POST['qty'];
        $update_cart="update `cart_details` set quantity=$quantities where ip_address='$ip_add'";
        $result_quantity=mysqli_query($con,$update_cart);
        $total=$total*$quantities;
        
      }


      if (isset($_POST['update_cart'])) {
                $quantities = $_POST['qty'];
                $update_cart = "update `cart_details` set quantity=$quantities where ip_address='$ip_add'";
                $result_quantity = mysqli_query($con, $update_cart);
                $total = $total * $quantities;
              }
    -->

    <tr class='text-center'>
                    <td>$product_id</td>
                    <td>$product_title</td>
                    <td>$product_image1</td>
                    <td>$product_price</td>
                    <td>$total_sold</td>
                    <td>$product_status</td>
                    <td><a href='' class='text-success'><i CLASS='fa-solid fa-pen-to-square'></i></a></td>
                    <td><a href='' class='text-danger'><i CLASS='fa-solid fa-trash'></i></a></td>
                </tr>