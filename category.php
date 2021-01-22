<?php
require_once 'template/header.php';
$data = getPostFromCategory($conn);
$catList = getCatInfo($conn);
close($conn);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                <?php
                echo "<h1>{$catList['category']}</h1>";
                ?>
                </div>
                <div class="col-lg-12">
                    <?php
                        echo "<div class='mb-5 mt-5'>".$catList['description']."</div>";
                    ?>
                </div>

            </div>
            <div class="row">
                <?php
                    $out = '';
                    for($i=0; $i < count($data); $i++){
                        $out .='<div class="col-lg-4 col-md-4 col-sm-6 col-6">';
                        $out .='<div class="card mb-3">';
                        $out .= "<img src='/images/{$data[$i]['image']}' class='card-img-top' style='height: 270px;'>";
                        $out .= '<div class="card-body">';
                        $out .= "<h5 class='card-title'>{$data[$i]['title']}</h5>";
                        $out .= "<p class='card-text overflow-hidden' style='max-width: 260px; max-height: 100px;'>{$data[$i]['descr_min']}</p>";
                        $out .= '<p class="text-right"><a href="/article?id='.$data[$i]['id'].'" class="btn btn-primary">Read more...</a></p>';
                        $out .='</div>';
                        $out .='</div>';
                        $out .='</div>';
                    }
                echo $out;
                ?>
            </div>
        </div>
        <div class="col-lg-3">
            <?php require_once 'template/nav.php'; ?>
        </div>
    </div>
</div>

<?php
require_once 'template/footer.php';
?>