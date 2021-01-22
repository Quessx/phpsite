<?php
require_once("template/header_admin.php");

$data = select($conn);
close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                    echo $flash;
                    echo '<h2>Admin-panel</h2>';
                    echo '<div class="mt-2 mb-2 text-right"><a href="/admin_create.php">';
                    echo '<button class="btn btn-success">Add new</button></a></div>';
                    $out = '<table class="table table-bordered table-dark">';
                    $out .= '<tr><th>ID</th><th>Title</th><th>Description min</th><th>Image</th><th>Update</th><th>Action</th></tr>';
                    for($i=0; $i < count($data); $i++){
                        $out .= "<tr><td>{$data[$i]['id']}</td><td>{$data[$i]['title']}</td><td>".$data[$i]['descr_min']."</td><td><img src='images/{$data[$i]['image']}' width='40'></td>";
                        $out .= "<td><a href='/admin_update.php?id={$data[$i]['id']}' data='{$data[$i]['id']}'><button class='btn btn-primary'>Update</button></a></td>";
                        $out .= "<td><a href='/admin_delete.php?id={$data[$i]['id']}' data='{$data[$i]['id']}' class='check-delete'><button class='btn btn-danger'>Delete</button></a></td></tr>";
                    }
                    $out .= '</table>';
                    echo $out;
                ?>
            </div>
        </div>
    </div>
<script>
    window.onload = function(){
        let checkDelete = document.querySelectorAll('.check-delete');
        checkDelete.forEach(function(element){
            element.onclick = checkDeleteFunction;
        })
        function checkDeleteFunction(event){
            event.preventDefault();
            let a = confirm('Do you want delete?');
            if (a == true){
                location.href = '/admin_delete.php?id='+this.getAttribute('data');
            }
            return false;
        }
    }
</script>
<?php
require_once 'template/footer.php';
?>