<?php
include('../Commen_file/Connction.php');
if(isset($_GET['id'])){
     $user_id = $_GET['id'];
     $total = $_GET['total'];
    if(isset($_POST['submit'])){
        $card_number = $_POST['card_number'];
        $valid_dates = $_POST['valid_dates'];
        $cvv = $_POST['cvv'];

        $query_debit = "INSERT INTO debit_card_info(user_id,amount,card_number,valid_dates,cvv) values($user_id,$total,$card_number,'$valid_dates',$cvv)";
        $result_debit = mysqli_query($conn,$query_debit);
        if($result_debit){
            echo "<script>alert('Payment Successfully Done...'); window.location.href='User.php';</script>";
        }
        else{
            echo "Payment Failed...";
        }

    }
   Debit_card($total);

}

function Debit_card($total){
    ?>
   <script src="https://cdn.tailwindcss.com"></script>
    <body class="bg-gray-100 flex items-center justify-center h-[100vh]">

        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Payment Confirm Page</h2>
            
            <form action="" method="post" class="space-y-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Debit Card Number</label>
                <input type="number"  name="card_number" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1" readonly>Year/Months</label>
                <input type="text" name="valid_dates" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1" readonly>Cvv</label>
                <input type="number"  name="cvv" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Payment</label>
                <input type="number" readonly id="password" name="total_product" required readonly value="<?php echo $total?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
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

?>
