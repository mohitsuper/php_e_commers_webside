<?php
session_start();
include("../Commen_file/Get_ip_address.php");
include("../Commen_file/Connction.php");
$totle_price = 0;
$totle_quantity =0;
$email = $_SESSION['email'];
$query_user_info = "SELECT * FROM user_info where email='$email'";
$get_ip_address = get_client_ip();


$data_user_info = mysqli_query($conn,$query_user_info);
$result_user_info = mysqli_fetch_array($data_user_info);
$user_id = $result_user_info['id'];
$invoice = random_int(1000000000, 9999999999);
$order_status = 'panding';
if(isset($_GET['get_ip_address'])){
  $get_ip_address = $_GET['get_ip_address'];
  $query = "SELECT * FROM card_info where get_ip_address='$get_ip_address'";
  $data = mysqli_query($conn, $query);
  if(mysqli_num_rows($data) >0){
    while($result = mysqli_fetch_assoc($data)){
        $product_id = $result['product_add_card_id'];
        $quantity = $result['quantity'];
        $totle_quantity += $quantity;
        
        $query_product_info = "SELECT * FROM product_info where id=$product_id";
        $data_product_info = mysqli_query($conn,$query_product_info);
        while($result_product_info = mysqli_fetch_assoc($data_product_info)){
            $product_price = $result_product_info['product_price'];
            $product_val = $product_price * $quantity;
            $totle_price += $product_val;
        }
    }
}


$query_insert_data ="INSERT INTO order_item(user_id,invoice_number,date_time,total_price,total_product,order_status) VALUES($user_id,$invoice,NOW(),$totle_price,$totle_quantity,'$order_status')";

$res = mysqli_query($conn,$query_insert_data);
if($res){
    $delect_query = "DELETE FROM card_info WHERE  get_ip_address='$get_ip_address'";
    $delect_card_item = mysqli_query($conn,$delect_query);
    echo "<script>alert('order submitted Successfully');
    window.location.href='User.php';</script>";
}
else{
    echo $conn->error;
}

}
?>