<?php
    if($currentPage > 3){
        $firstPage = 1;
?>
<a class="page-link" href="?per_page=<?=$data_Rows_Per_Page?>&page=<?=$firstPage?>" style="color: red;">1</a>
<a class="page-link">...</a>
<?php
    }
    for($num = 1; $num <= $pageRecord; $num++){
?>
<nav aria-label="Page navigation">
    <ul class="pagination">
    
<?php
    if($num != $currentPage)
    {
        if($num > $currentPage - 3 && $num < $currentPage + 3)
        {
?>  
  <li class="page-item"><a class="page-link" href="?per_page=<?=$data_Rows_Per_Page?>&page=<?=$num?>" style="color: red;"><?=$num?></a></li>
  <?php
        }
    } 
    else
    {
?> 
    <strong style = "font-weight: bold; color: blue; " class="page-link"><?=$num?></strong>
<?php
    }
?>
    </ul>
</nav>
<?php
}
    if($currentPage < $pageRecord - 3){

        $endPage = $pageRecord;
        ?>
        <a class="page-link">...</a>
        <a class="page-link" href="?per_page=<?=$data_Rows_Per_Page?>&page=<?=$endPage?>" style="color: red;"><?=$endPage?></a>

        <?php } 
    

?>
