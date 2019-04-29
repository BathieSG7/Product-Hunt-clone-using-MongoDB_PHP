<?php 
    $pageTitle="Add product";
    include('../../partials/header.php') ; 
?> 


<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4>Add Product</h4>
            <hr>
            <?php 
                // ERROR CHECK
                if(isset($_SESSION['errorMessage']['UploadError']) ){
                    echo '
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                                </button>
                            <strong>Warning:</strong>'.$_SESSION['errorMessage']['UploadError'].' 
                        </div>';
                }
                if(isset($_SESSION['errorMessage']['allFieldSet']) ){
                    echo '
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                                </button>
                            <strong>Warning:</strong>'.$_SESSION['errorMessage']['allFieldSet'].' 
                        </div>';
                }
            ?> 
            <form action="add.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Enter title" required>
                </div>
                <div class="form-group">
                    <label for="body">Description</label>
                    <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="url">Product url</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Enter product url"
                        required>
                </div>
                <div class="form-group">
                    <label for="icon">Product icon</label>
                    <input type="file" class="form-control-file" id="icon" name="icon">
                </div>
                <div class="form-group">
                    <label for="icon">Product image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-primary" name="Upload" >Upload</button>
            </form>
        </div>
    </div>
</div>
<br><br><br><br>

<?php 
    include('../../partials/footer.php'); 
?> 