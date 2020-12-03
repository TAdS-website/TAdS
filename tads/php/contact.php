<?php
require '../../configs/tads-config.php';
include 'vendor/autoload.php';
use \unreal4u\TelegramAPI\TgLog;
use \unreal4u\TelegramAPI\Telegram\Methods\SendMessage;


if(isset($_POST['contact'])){
    $id = uniqid('qr_');
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Contact = $_POST['Contact'];
    $Message = $_POST['Message'];
    
    $sql = "INSERT INTO `contacts` (`id`, `Name`, `Email`, `Contact`, `Message`) VALUES ( '$id', '$Name' , '$Email' ,'$Contact' , '$Message');";

    if($conn->query($sql) == true){
        $sendMessage = new SendMessage();
        $sendMessage->chat_id = GROUP_ID;
        $sendMessage->text = '
New Query!

Date& Time : '.date("dS D M Y H:i:s").'
Name : '.$Name.'
Email : '.$Email.'
Mobile : '.$Contact.'
Message : 

'.$Message.'
        ';
        $tgLog = new TgLog(BOT_TOKEN);
        if ($message = $tgLog->performApiRequest($sendMessage)){
            echo '<script>
                    alert("Thank you for contacting us. Our executive will be reaching you soon.")
                    window.location.href = "'.URL.'"
                 </script>';
        }
    }
    else {
        echo '<script>
                alert("Oops! Something went wrong! ERROR : '.$conn->error.'")
                window.location.href = "'.URL.'"
              </script>';
    }
        // $stmt = $conn -> prepare("insert into contacts(Name, Email, Contact, Message)
        // values(?, ?, ?, ?)");
        // $stmt -> bind_param("ssis",$Name,$Email,$Contact,$Message);
        // $stmt -> execute();
        // echo "Successfully registered .. ";
        // $stmt -> close();
    $conn -> close();
}

