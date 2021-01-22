<?php

function connect(){
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function select($conn){
    $sql = "SELECT * FROM info";
    $result = mysqli_query($conn, $sql);

    $a = array();

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $a[] = $row;
        }
    }
    return $a;
}

function selectMain($conn){
    $offset = 0;
    if(isset($_GET['page']) && trim($_GET['page']) != ''){
        $offset = trim($_GET['page']);
    }
    $sql = "SELECT * FROM info ORDER BY id DESC LIMIT 6 OFFSET ".$offset * 6;
    $result = mysqli_query($conn, $sql);

    $a = array();

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $a[] = $row;
        }
    }
    return $a;
}

function selectArticle($conn){
    $sql = "SELECT * FROM info WHERE id=".$_GET['id'];
    $result = mysqli_query($conn, $sql);

    $a = array();

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    return false;
}

function paginationCount($conn){
    $sql = "SELECT * FROM info";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_num_rows($result);
    return ceil($result/6);
}

function getAllTags($conn){
    $sql = "SELECT DISTINCT(tag) FROM tag";
    $result = mysqli_query($conn, $sql);

    $a = array();

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $a[] = $row['tag'];
        }
    }
    return $a;
}

function getArticleTags($conn){
    $sql = "SELECT * FROM tag WHERE post=".$_GET['id'];
    $result = mysqli_query($conn, $sql);

    $a = array();

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $a[] = $row;
        }
    }
    return $a;
}

function getPostFromTag($conn){
    $sql = "SELECT post FROM tag WHERE tag='".$_GET['tag']."'";
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row['post'];
        }
    } 

    $sql = "SELECT * FROM info WHERE id in (".join(",", $a).")";
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row;
        }
    } 
    return $a;
    
}

function getPostFromCategory($conn){
    $sql = "SELECT * FROM info WHERE category=".$_GET['id'];
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row;
        }
    }

    return $a;
    
}

function getCatInfo($conn){
    $sql = "SELECT * FROM category WHERE id=".$_GET['id'];
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }
    
    return $row;
    
}

function getAllCatInfo($conn){
    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row;
        }
    }
    
    return $a;
    
}

function deleteArticle($conn, $del){
    if(isset($del) && trim($del) != ''){
        $sql = "DELETE FROM info WHERE id=".$del;
    
            if (mysqli_query($conn, $sql)) {
                setcookie('bd_delete_success', 1, time()+10);
                header('Location: /admin.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
}

function getDeletArticle($conn){
    $sql = "SELECT title FROM info WHERE id=".$_GET['id'];
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }
    
    return $row['title'];
}

function alertDeletArticle(){
    if(isset($_COOKIE['bd_delete_success']) && $_COOKIE['bd_delete_success'] != ''){
        if($_COOKIE['bd_delete_success'] == 1){
            echo $refresh = 10;
        }
        else {
            echo $refresh = 360;
        }
    }
}

function tag($tag){
    for($i=0; $i < count($tag); $i++){
        echo "<a href='/tag.php?tag={$tag[$i]}' class='badge badge-light mr-1 p-2'>{$tag[$i]}</a>";
    }
}

function close($conn){
    mysqli_close($conn);

}