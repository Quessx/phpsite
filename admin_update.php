<?php
require_once 'core/config.php';
require_once 'core/function.php';
$conn = connect();
$cat = getAllCatInfo($conn);
?>
<?php
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
    $conn = connect();

    if ($_FILES['image']['name'] != '') {
        move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$_FILES['image']['name']);
        $sql = "UPDATE info set title = '".$title."', category = '".$category."', descr_min = '".$descrMin."', description = '".$description."', image = '".$_FILES['image']['name']."' WHERE id=".$_GET['id'];
    }
    else {
        $sql = "UPDATE info set title = '".$title."', category = '".$category."', descr_min = '".$descrMin."', description = '".$description."' WHERE id=".$_GET['id'];
    }

    if (mysqli_query($conn, $sql)) {
        $sql = "DELETE FROM tag WHERE post=".$_GET['id'];
        mysqli_query($conn, $sql);

        for($i = 0; $i < count($newTags); $i++){
            $sql = "INSERT INTO tag (tag,post) VALUES ('".$newTags[$i]."',".$_GET['id'].")";
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
<?php
    $sql = 'SELECT * FROM info WHERE id='.$_GET['id'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $sql = 'SELECT tag FROM tag WHERE post='.$_GET['id'];
    $result = mysqli_query($conn, $sql);
    $t = array();
    while($tag = mysqli_fetch_assoc($result)) {
        $t[] = $tag['tag'];
    }
?>
<?php
require_once('template/header_admin.php');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <form action="" method="POST" enctype="multipart/form-data">
            <h2 class="mt-5">Update post <?php echo $_GET['id']; ?></h2>
            <div class="form-group mt-3">
                <label for="title">Title</label>
                <input type="text" name="title" value="<?php echo $row['title'];?>" class="form-control" id="title">
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
                    <option value="<?php echo $row['category'] ?>">Choose...</option>
                    <option value="1">Медведи</option>
                    <option value="2">Австралия</option>
                    <option value="3">Интересное</option>
                    <option value="4">Разное</option>
                </select>
            </div>
            </div>
            <div class="form-group">
                <label for="descr_min">Min description</label>
                <input type="text" value="<?php echo $row['descr_min']; ?>" name="descr-min" class="form-control" id="descr_min">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" name="description" class="form-control" id="description"><?php echo $row['description']; ?> </textarea>
            </div>
            <div class="form-group">
                <img src="images/<?php echo $row['image'];?>" alt="" style="width: 150px;">
            </div>
            <div class="form-group">
                <label for="image">Photo</label>
                <input type="file" name="image" class="form-control-file" id="image">
            </div>
            <div class="form-group">
                <label for="title">Tags</label>
                <input type="text" name="tag" value="<?php echo join(',', $t); ?>" placeholder="one, two, three" class="form-control col-lg-6 col-md-6 col-sm-6" id="title">
            </div>
            <div class="form-group text-right">
                <input type="submit" value="Update article" class="btn btn-success">
            </div>
        </form>
        </div>
    </div>
    
</div>

<?php 
    require_once('template/footer.php');
?>
