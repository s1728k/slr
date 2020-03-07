<?php
$sterm = '';
$uri = explode('?',$_SERVER['REQUEST_URI']);
if (count($uri)==2) {
    foreach (explode('&',$uri[1]) as $param) {
        if(strpos($param,'pageno')===false){
            $sterm = $sterm . $param . '&';
        }
    }
} else {
    $sterm = '';
}
?>
<?php if($total_pages > 1): ?>
<ul class="pagination">
    <li><a href="<?php echo $uri[0].'?'.$sterm; ?>pageno=1">First</a></li>
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a <?php if($pageno <= 1){  } else { echo 'href="'.$uri[0]."?".$sterm."pageno=".($pageno - 1).'"'; } ?> >Prev</a>
    </li>
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a <?php if($pageno >= $total_pages){  } else { echo 'href="'.$uri[0]."?".$sterm."pageno=".($pageno + 1).'"'; } ?>>Next</a>
    </li>
    <li><a href="<?php echo $uri[0].'?'.$sterm; ?>pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>
<?php endif; ?>