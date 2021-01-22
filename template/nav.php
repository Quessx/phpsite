<?php
    $out = '<div class="list-group">';
        for($i=0; $i < count($cat); $i++){
            $out .= '<a class="list-group-item list-group-item-action" href="/category.php?id='.$cat[$i]['id'].'">';
            $out .= $cat[$i]['description'].'</a>';
        }
    echo $out;
    echo '</div>';
?>
