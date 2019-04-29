
<?php
    session_start();
    # importing classes in the views
    require_once('../../vendor/autoload.php');
    require_once('../../config/MongoDB.php');
    require_once('../../config/Products.php');
    require_once('../../config/voter.php');

    $target_dir = "../../uploads/";
    function PictureUpload($fileToUpload){
        /* 
            $target_dir = "uploads/" - specifies the directory where the file is going to be placed
            $target_file specifies the path of the file to be uploaded
            $uploadOk=1 is not used yet (will be used later)
            $imageFileType holds the file extension of the file (in lower case)
            Next, check if the image file is an actual image or a fake image
        */
        global $target_dir;

        $target_file = $target_dir.basename($_FILES[$fileToUpload]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        var_dump( $imageFileType );
        echo '<br>';
        // Check if image file is a actual image or fake image
        var_dump($_FILES[$fileToUpload]);
        $check = getimagesize($_FILES[$fileToUpload]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        /*
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES[$fileToUpload]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        */
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" 
        && $imageFileType != "gif" && $imageFileType != "svg" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded. Make sure that you provided an image in JPG or, JPEG, PNG, GIF format";
            return false;
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$fileToUpload]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES[$fileToUpload]["name"]). " has been uploaded.";
                return true;
            } else {
                echo "Sorry, there was an error uploading your file. Please try again";
                return false;
            }
        }
    }

    function formCheck(){
        global $target_dir;
        # check if all files are set
        if(isset($_POST['title'],$_POST['body'],$_POST['url'],$_FILES['icon'],$_FILES['image'])){
            # ALl files are in this case set
            $allFieldSet=true;
        }else{
            $_SESSION['errorMessage']['allFieldSet']= 'Please input all fields';
            return false;
        }

        // try to upload files
        if( PictureUpload('icon') &&  PictureUpload('image')){
            return $allFieldSet;
        }else{
            $_SESSION['errorMessage']['UploadError']='Sorry, your file was not uploaded. Make sure that you provided an image in JPG or, JPEG, PNG, GIF format';
            return false;
        }
    }
/*------------------------security check (i think)------------------------------*/
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        return header('location:add.view.php');
    }else{
/*--------------------------- Creating new product ----------------------*/
        $Product = new Products; 
        #Testing the uploaded files format and form inputs
        if(formCheck()){
            $ProductID=$Product->addProduct($_POST,$_FILES);
            return header('location:/views/product/detail.view.php?id='.$ProductID); 
        }else{
            return header('location:add.view.php');
        }
    }
    
