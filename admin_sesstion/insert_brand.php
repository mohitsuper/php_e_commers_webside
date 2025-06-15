<?php
include('../Commen_file/Connction.php');
$query_brand_table = "CREATE TABLE IF NOT EXISTS insert_brand(id INT(11) AUTO_INCREMENT PRIMARY KEY, brand_name VARCHAR(255))";
mysqli_query($conn,$query_brand_table);

//insert a data
if(isset($_POST['submit'])){
    $val = $_POST['brand_name'];
    $user_id = $_SESSION['username_id'];
    $get_ip_address = get_client_ip();
    //select a data query
    $query_brand_select = "SELECT * FROM insert_brand WHERE brand_name = '$val'";
    $data = mysqli_query($conn,$query_brand_select);
    $row = mysqli_num_rows($data);
    if($row == 0){
        $query_brand_insert = "INSERT INTO insert_brand(brand_name,user_id,user_ip_address) VALUES('$val',$user_id,'$get_ip_address')";
        $res = mysqli_query($conn,$query_brand_insert);
        if(!$res){
            echo $conn->error;
        }
        else{
            echo "<script>alert('Brand Add..')</script>";
        }
    }
    else{
        echo "<script>alert('Data already present')</script>";
    }
}

?>
    
<form action="" method="POST" class="h-[100vh] w-full flex justify-center items-center flex-col">
    <h1 class="text-lg uppercase font-bold mb-3">insert brand page</h1>
    <div class="border flex flex-col p-3">
        <label for="" class="font-bold mb-1">brand:</label>
        <input type="text" name="brand_name" class="border px-1" placeholder="Enter Your brand">
        <input type="submit" name="submit" class="bg-red-500 object-contain mt-2 text-white py-1" value="submit">
    </div>
</form>
