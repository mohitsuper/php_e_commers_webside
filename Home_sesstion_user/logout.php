<?php
include('../Commen_file/Connction.php');
       if(isset($_GET['id'])){
        $user_id = $_GET['id'];
        $query_delect = "DELETE FROM user_info where id=$user_id";
        $res_delect = mysqli_query($conn,$query_delect);
        if($res_delect){
                session_unset();
                echo "<script>window.location.href='index.php'</script>";
        }
       }
    
?>