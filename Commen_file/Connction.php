<?php
 $conn = new mysqli("localhost","root","","e_commerce");
 if(!$conn){
    echo "conntion is failed".$conn->error;
 }
?>