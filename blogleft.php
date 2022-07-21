<div class="category-left">
    <div class="category-left-title about-list-title">News And Industry Info </div>
    <div class="responsive-category-left-title responsive-about-list-title">News And Industry Info <i class="fa fa-angle-down" aria-hidden="true"></i></div>
    <ul class="category-list about-list">
        <?
        $BlogQur = "select * from mutual_blog order by createdate desc limit 0,5";
        $BlogRes = mysql_query($BlogQur);
        $Blogtot = mysql_affected_rows();
        if ($Blogtot > 0) {
            while ($BlogRow = mysql_fetch_array($BlogRes)) {
        ?>
                <li><a href="<?php echo GetUrl_Blog($BlogRow['id']); ?>"><b><?php echo stripslashes($BlogRow['title']); ?></b></a></li>
                <p><?php echo substr(strip_tags(stripslashes($BlogRow['description']), "<a><b><i><strong></a></b></i></strong><br></br><u></u>"), 0, 150); ?>...</p>
                <div class="left-blog-read-more-btn"><a href="<?php echo GetUrl_Blog($BlogRow['id']); ?>">Read More >></a></div>
        <? }
        } ?>
    </ul>
</div>