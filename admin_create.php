<?php
require_once 'template/header_admin.php';

if(isset($_POST['title']) && $_POST['title'] !=''){
    $title = $_POST['title'];
    $category = $_POST['category'];
    $descrMin = $_POST['descr-min'];
    $description = $_POST['description'];
    $tags = trim($_POST['tag']);
    $tags = explode(",", $tags);
    $newTags = [];
    for($i = 0; $i < count($tags); $i++){
        if(trim($tags[$i])!='') {
            $newTags[] = trim($tags[$i]);
        }
    }

    move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$_FILES['image']['name']);

    $conn = connect();
    $sql = "INSERT INTO info (title, category, descr_min, description, image) VALUES ('".$title."','".$category."', '".$descrMin."', '".$description."', '".$_FILES['image']['name']."')";

    if (mysqli_query($conn, $sql)) {
        $lastId = mysqli_insert_id ($conn);
        for($i = 0; $i < count($newTags); $i++){
            $sql = "INSERT INTO tag (tag,post) VALUES ('".$newTags[$i]."',".$lastId.")";
            mysqli_query($conn, $sql);
        }
        // var_dump($lastId);
        setcookie('bd_create_success', 1, time()+10);
        header('Location: /admin.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    close($conn);

}

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <form action="" method="POST" enctype="multipart/form-data">
            <h2 class="mt-5">Create post</h2>
            <div class="form-group mt-3">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title">
            </div>
            <!-- <div class="form-group mt-3">
                <label for="category">Category</label>
                <input type="text" name="category" class="form-control" id="category">
            </div> -->
            <div class="mb-3">
                <div class="input-group is-invalid">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="validatedInputGroupSelect">Category</label>
                    </div>
                <select name="category" class="custom-select" id="validatedInputGroupSelect" required>
                    <option value="">Choose...</option>
                    <option value="1">Медведи</option>
                    <option value="2">Австралия</option>
                    <option value="3">Интересное</option>
                    <option value="4">Разное</option>
                </select>
            </div>
            <div class="invalid-feedback">
                Select a category
            </div>
            </div>
            <div class="form-group">
                <label for="descr_min">Min description</label>
                <input type="text" name="descr-min" class="form-control" id="descr_min">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" name="description" class="form-control" id="description"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Photo</label>
                <input type="file" name="image" class="form-control-file" id="image">
            </div>
            <div class="form-group">
                <label for="title">Tags</label>
                <input type="text" name="tag" placeholder="one, two, three" class="form-control col-lg-6 col-md-6 col-sm-6" id="title">
            </div>
            <div class="form-group text-right">
                <input type="submit" value="Add new article" class="btn btn-success">
            </div>
        </form>
        </div>
    </div>
    
</div>


