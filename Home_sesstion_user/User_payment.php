<?php
include('../Commen_file/Connction.php');
if(isset($_GET['id'])){
    $user_id = $_GET['id'];
    $total = $_GET['total'];
    $qurey_payment = "SELECT * FROM order_item WHERE user_id=$user_id and total_price=$total";
    $result_payment = mysqli_query($conn, $qurey_payment);
    if(!$result_payment){
        echo $conn->error;
    }
    $result = mysqli_fetch_array($result_payment);

    //user payment value to get 
    if(isset($_POST['submit'])){
        $user_id = $_GET['id'];
        $invoice_number = $_POST['invoice_number'];
        $total_amount = $_POST['total_price'];
        $total_product = $_POST['total_product'];
        $payment_mode = $_POST['payment_mode'];
        $order_status = "confirm";
        //not dubble data inset a query 



        $select_payment = "SELECT * FROM user_confirm_payment WHERE invoice_number=$invoice_number and total_amount=$total";
        $res_select_payment = mysqli_query($conn,$select_payment);
        $row_data = mysqli_num_rows($res_select_payment);
        if($row_data>0){
            echo "<script>alert('You Alreay pay Amount ".$total_amount."'); window.location.href='User.php';</script>";
        }
        else{
            $insert_data = "INSERT INTO user_confirm_payment(user_id,invoice_number	,date_time,total_amount,total_product,payment_mode,order_status)  VALUES($user_id,$invoice_number,NOW(),$total_amount,$total_product,'$payment_mode','$order_status')";
            $qurey_payment = mysqli_query($conn,$insert_data);

            if($qurey_payment){
             echo "<script>window.location.href='Debit_card.php?id=".$user_id."&total=".$total."';</script>";
            }
            else{
                echo $conn->error;
            }
        }

    }
   Payment_info($result);
}

function Payment_info($result){
    if(!isset($_POST['submit'])){
        if(!isset($_POST['payment_mode'])){
    ?>
   <script src="https://cdn.tailwindcss.com"></script>
    <body class="bg-gray-100 flex items-center justify-center h-[100vh]">

        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Payment Confirm Page</h2>
            
            <form action="" method="post" class="space-y-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">invoice number</label>
                <input type="number" readonly  name="invoice_number" value="<?php echo $result['invoice_number']?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1" readonly>Date Time</label>
                <input type="text" value="<?php echo $result['date_time']?>" name="date_time" required readonly
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1" readonly>Total Amount Pay</label>
                <input type="text" readonly value="<?php echo $result['total_price']?>" name="total_price" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Products</label>
                <input type="number" readonly value="<?php echo $result['total_product']?>" id="password" name="total_product" required readonly
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Select Payment Mode</label>
                <select name="payment_mode" class="bg-white w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="Select">Select</option>
                    <option value="Debit Card">Debit Card</option>
                </select>
            </div>
            
            <input type="submit"
            value="Submit"
            name="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition ">

            </form>
        </div>
    </body>
    <?php
    }
  }
}


?>
