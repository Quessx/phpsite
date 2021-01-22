<?php
require_once('template/header.php');

$data = deleteArticle($conn,$_GET['id']);
$sql = "DELETE FROM tag WHERE post=".$_GET['id'];
mysqli_query($conn, $sql);
?>
<div class="container">
    <div class="ro">
        <div class="col-lg-12">
            <?php
                if ($data === true) {
                    echo 'Article was deleted';
                }
                else {
                    echo 'Error!'.$data;
                }
            ?>
        </div>
    </div>
</div>
<?php
close($conn);
