<?php

include('../db.php');



// Uploads files
if (isset($_POST['send'])) { // if save button on the form is clicked
    // name of the uploaded file


    $documentType = $_POST['type'];
    $details = $_POST['details'];
    $purpose = $_POST['purpose'];
    $created_at = date('m/d/Y h:i:s a', time()); 
    $department = $_POST['department'];
    $id = $_POST['id'];

    $today = date("Ymd");
    $rand = strtoupper(substr(uniqid(sha1(time())),0,4));
    $tracking_code = $today . $rand;

    
    $filename = $_FILES['document']['name'];
    // destination of the file on the server
    $destination = '../../Document/attachment/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['document']['tmp_name'];
    $size = $_FILES['document']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx', 'jpeg', 'jpg', 'png'])) {
        echo "You file extension must be .zip, .pdf, .docx , .jpeg, .jpg, or .png";
    } elseif ($_FILES['document']['size'] > 10000000) { // file shouldn't be larger than 10Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO document (documentType,details,purpose,created_at, user_id,attachment) VALUES ('$documentType','$details','$purpose','$created_at', '$id', '$filename')";
            if (mysqli_query($con, $sql)) {
                $last_id = mysqli_insert_id($con);
               $query1= mysqli_query($con,"INSERT INTO tracking_history (document_id,sender_user_id,recipient_user_id,dateTimeSent, tracking_code,receiverAction) VALUES ('$last_id','$id','$department','$created_at','$tracking_code','ONGOING')") ;
               $_SESSION['message'] = $tracking_code; 
               header("Location: ../../pages/user/send_docu.php");    





            }
        } else {
            echo "Failed to upload file.";
        }
    }
}