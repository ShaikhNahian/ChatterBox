<?php
session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "master/php/config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);

        ////////////////////////////////////////////////////////////////////////////////////////////////
        if(isset($_FILES)){
            $img_name = $_FILES['fileToUpload']['name'];
            $img_type = $_FILES['fileToUpload']['type'];
            $tmp_name = $_FILES['fileToUpload']['tmp_name'];
            echo $_POST['incoming_id'];
            var_dump($_POST);
            $img_explode = explode('.',$img_name);
            $img_ext = end($img_explode);
            $extensions = ["jpeg", "png", "jpg"];
            if(in_array($img_ext, $extensions) === true){
                $types = ["image/jpeg", "image/jpg", "image/png"];
                if(in_array($img_type, $types) === true){
                    $time = time();
                    $new_img_name = $time.$img_name;
                    if(move_uploaded_file($tmp_name,"master/uploaded_media/".$new_img_name)){
                        $ran_id = rand(time(), 100000000);
                        if(!empty($new_img_name)){
                            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$new_img_name}')") or die();
                        }
                        else{
                            header("location: ../master/login.php");
                        }
                    }
                }
            }
        }



        /////////////////////////////////////////////////////////////////////////////
        
    }

?>
