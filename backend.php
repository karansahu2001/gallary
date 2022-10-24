<?php
$targetDir = "uploads/";
$fileName = basename($_FILES["img"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$statusMsg = "";
if($_POST['category'] &&!empty($_FILES["img"]["name"])){
    // Allow certain file formats
    $category = $_POST['category'];
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["img"]["tmp_name"], $targetFilePath)){
            $data = array( "name"=>$category,"path"=>  $fileName,"id"=>date('d-m-y h:i:s'));
            $data_results = file_get_contents('data.json');
            $tempArray = json_decode($data_results);
            $tempArray[] = $data ;
            $jsonData = json_encode($tempArray);
            file_put_contents('data.json', $jsonData);  
            header("location:index.html");
            die();
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}
echo $statusMsg;
?>