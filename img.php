<?php 
if($_POST['img']=='imgShow'){
    $path = "data.json";
    $jsonString = file_get_contents($path);
    $jsonData = json_decode($jsonString, true);

    for($i=0;$i<count($jsonData);$i++){
        $path = 'uploads/'.$jsonData[$i]['path'];
        ?>
            <div>
                <dir onclick="deleteImg('<?php echo $i ?>')">
                    <svg  xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <   path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>
                </dir>
                <img class="img" src="<?php echo $path;?>" alt="nnn">
                <p><?php echo $jsonData[$i]['name'] ?></p>
            </div>
        <?php


    }

}


if(isset($_POST['id']) && $_POST['id'] != ""){
    $id = $_POST['id'];
    $data = file_get_contents('data.json');
    $json_arr = json_decode($data, true);
    unlink('upload/'.$json_arr[$id]['path']);
    unset($json_arr[$id]);
    $json_arr = array_values($json_arr);
    file_put_contents('data.json', json_encode($json_arr));
}

?>