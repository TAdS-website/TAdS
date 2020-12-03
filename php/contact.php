<?php
if(isset($_POST['Name'])){
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Contact = $_POST['Contact'];
    $Message = $_POST['Message'];

    $conn = mysqli_connect("localhost","root","","tads");
    if(!$conn){
        die("Connection Failed : ".mysqli_connect_error());
    }
    
    $sql = "INSERT INTO `contacts` (`id` `Name`, `Email`, `Contact`, `Message`) VALUES (NULL, $Name , $Email ,$Contact , $Message);";

    if($conn->query($sql) == true){
        echo "Success";
    }
    else {
        echo "ERROR: $sql <br> $conn->error";
    }
        // $stmt = $conn -> prepare("insert into contacts(Name, Email, Contact, Message)
        // values(?, ?, ?, ?)");
        // $stmt -> bind_param("ssis",$Name,$Email,$Contact,$Message);
        // $stmt -> execute();
        // echo "Successfully registered .. ";
        // $stmt -> close();
    $conn -> close();
}
?>
