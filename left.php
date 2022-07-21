<form name="frmleftsearch" id="frmleftsearch" enctype="multipart/form-data" method="get" action="search-mid.php">
    <input type="hidden" name="brand" id="brand" value="" />
    <input type="hidden" name="cid" id="cid" value="" />
</form>
<div class="category-left">
    <div class="category-left-title">PRODUCT CATEGORIES</div>
    <div class="responsive-category-left-title">PRODUCT CATEGORIES <i class="fa fa-angle-down" aria-hidden="true"></i></div>
    <ul class="category-list">
        <?
        $queryBrndSrc = mysql_query("select jet_node_name,jet_node_id,parent_id from mutual_category where parent_id='0' order by sortorder asc ");
        $resultBrndSrc = mysql_num_rows($queryBrndSrc);
        
        if ($resultBrndSrc > 0) {
            while ($BrndSrcObj = mysql_fetch_object($queryBrndSrc)) {
                $brandnm = stripslashes($BrndSrcObj->jet_node_name);
                $BrNm = str_replace(" ", "+", $brandnm); ?>
        <li><a href="search-mid.php?cid=<?= stripslashes($BrndSrcObj->jet_node_id); ?>"><?= $brandnm; ?></a>
            <? $queryBrndSrc1 = mysql_query("select jet_node_name,jet_node_id,parent_id from mutual_category where parent_id='" . $_GET["id"] . "' and parent_id='" . $BrndSrcObj->jet_node_id . "' order by sortorder asc ");
                    $resultBrndSrc1 = mysql_num_rows($queryBrndSrc1);
                    
                    if ($resultBrndSrc1 > 0) {
                    ?>
            <ul >
                <?
                            while ($BrndSrcObj1 = mysql_fetch_object($queryBrndSrc1)) {
                                $brandnm1 = stripslashes($BrndSrcObj1->jet_node_name);
                                $BrNm1 = str_replace(" ", "+", $brandnm1); ?>
                <li><a href="search-mid.php?cid=<?= stripslashes($BrndSrcObj1->jet_node_id); ?>">- <?= $brandnm1; ?></a>
                
                          
                <? $queryBrndSrc3 = mysql_query("select jet_node_name,jet_node_id,parent_id from mutual_category where parent_id='" . $BrndSrcObj1->jet_node_id . "' order by sortorder asc ");
                                $resultBrndSrc3 = mysql_num_rows($queryBrndSrc3);
                                if ($resultBrndSrc3 > 0) {
                                    while ($BrndSrcObj3 = mysql_fetch_object($queryBrndSrc3)) {
                                        $brandnm3 = stripslashes($BrndSrcObj3->jet_node_name);
                                        $BrNm3 = str_replace(" ", "+", $brandnm3); ?>
                <li><a
                        href="search-mid.php?cid=<?= stripslashes($BrndSrcObj3->jet_node_id); ?>">- <?= $brandnm3; ?></a></li>
                <? } ?>
                <? } ?>
                <? } ?>
            </ul>
                <? } else { ?>
                <? $queryBrndSrc1 = mysql_query("select jet_node_name,jet_node_id,parent_id from mutual_category where jet_node_id='" . $_GET["id"] . "' and parent_id='" . $BrndSrcObj->jet_node_id . "' order by sortorder asc ");
                                                $resultBrndSrc1 = mysql_num_rows($queryBrndSrc1);
                                                if ($resultBrndSrc1 > 0) {
                                                    while ($BrndSrcObj1 = mysql_fetch_object($queryBrndSrc1)) {
                                                        $brandnm1 = stripslashes($BrndSrcObj1->jet_node_name);
                                                        $BrNm1 = str_replace(" ", "+", $brandnm1); ?>
                <? $queryBrndSrc1 = mysql_query("select jet_node_name,jet_node_id,parent_id from mutual_category where parent_id='" . $BrndSrcObj->jet_node_id . "' order by sortorder asc ");
                                                        $resultBrndSrc1 = mysql_num_rows($queryBrndSrc1);
                                                        if ($resultBrndSrc1 > 0) {
                                                            while ($BrndSrcObj1 = mysql_fetch_object($queryBrndSrc1)) {
                                                                $brandnm1 = stripslashes($BrndSrcObj1->jet_node_name);
                                                                $BrNm1 = str_replace(" ", "+", $brandnm1); ?>
               <ul><li><a
                        href="search-mid.php?cid=<?= stripslashes($BrndSrcObj1->jet_node_id); ?>"><span
                            class="category_name">- <?= $brandnm1; ?></a></li></ul></span>
                <? $queryBrndSrc3 = mysql_query("select jet_node_name,jet_node_id,parent_id from mutual_category where parent_id='" . $BrndSrcObj1->jet_node_id . "' order by sortorder asc ");
                                                                $resultBrndSrc3 = mysql_num_rows($queryBrndSrc3);
                                                                if ($resultBrndSrc3 > 0) {
                                                                    while ($BrndSrcObj3 = mysql_fetch_object($queryBrndSrc3)) {
                                                                        $brandnm3 = stripslashes($BrndSrcObj3->jet_node_name);
                                                                        $BrNm3 = str_replace(" ", "+", $brandnm3); ?>
                <li><a
                        href="search-mid.php?cid=<?= stripslashes($BrndSrcObj3->jet_node_id); ?>"><li>- <?= $brandnm3; ?></li></a></li>
                <? } ?>
                <? } ?>
                <? } ?>
                <? } ?>
                <? } ?>
                <? } ?>
                <? } ?>
                <? } ?>
                <? } ?>
            </ul>
        </li>
    </ul>
    <?php /*?><div class="dropdowns">
        <button onClick="myFunction1()" class="dropbtn">BRANDS <span class="responsive-icon">
         class="fa fa-angle-down"
                    aria-hidden="true"></i></span></button>
        <div id="myDropdown1" class="dropdown-content">
            <?
		  $LEFT_queryBrndSrc=mysql_query("select distinct brand from searplus where brand!='' and brand is not null order by brand asc ");
		  $LEFT_resultBrndSrc= mysql_num_rows($LEFT_queryBrndSrc);
		  if($LEFT_resultBrndSrc>0){	
		  while($LEFT_BrndSrcObj=mysql_fetch_object($LEFT_queryBrndSrc))
		  {
			  $LEFT_brandnm=stripslashes($LEFT_BrndSrcObj->brand);
			  $LEFT_BrNm=str_replace(" ","+",$LEFT_brandnm);
		?>
            <span class="ctegories"><input type="radio" name="brandtype" <?
                    if($_GET['brand']==$LEFT_brandnm){echo "checked" ;}?> class="radio-category"
                onclick="document.frmleftsearch.brand.value='<?=$LEFT_BrNm;?>';document.frmleftsearch.submit();"><span
                    class="category_name"><?=$LEFT_brandnm;?></span></span>
            <? } ?>
            <? } ?>
        </div>
    </div><?php */ ?>
    <?php /*?><div class="dropdowns">
        <button onClick="myFunction2()" class="dropbtn">FEATURES <span class="responsive-icon"><i
                    class="fa fa-angle-down" aria-hidden="true"></i></span></button>
        <div id="myDropdown2" class="dropdown-content"> <span>
                <input type="radio" name="features" value="male">
                ANSI Class 2</span> <span>
                <input type="radio" name="features" value="male">
                ANSI Class 3</span> <span>
                <input type="radio" name="features" value="male">
                Zipper</span> <span>
                <input type="radio" name="features" value="male">
                Hook & Loop</span> <span>
                <input type="radio" name="features" value="male">
                Pockets</span> <span>
                <input type="radio" name="features" value="male">
                Mesh</span> <span>
                <input type="radio" name="features" value="male">
                Flame Resistant</span> </div>
    </div><?php */ ?>
    <?php /*?><div class="dropdowns">
        <button onClick="myFunction3()" class="dropbtn">COLOR <span class="responsive-icon"><i class="fa fa-angle-down"
                    aria-hidden="true"></i></span></button>
        <div id="myDropdown3" class="dropdown-content"> <span>
                <input type="radio" name="color" value="male">
                Lime</span> <span>
                <input type="radio" name="color" value="male">
                Orange</span> </div>
    </div>
    <div class="dropdowns">
        <button onClick="myFunction4()" class="dropbtn">SIZE <span class="responsive-icon"><i class="fa fa-angle-down"
                    aria-hidden="true"></i></span></button>
        <div id="myDropdown4" class="dropdown-content"> <span>
                <input type="radio" name="size" value="male">
                Small</span> <span>
                <input type="radio" name="size" value="male">
                Medium</span> <span>
                <input type="radio" name="size" value="male">
                Large</span> <span>
                <input type="radio" name="size" value="male">
                X Large</span> <span>
                <input type="radio" name="size" value="male">
                2X Large</span> <span>
                <input type="radio" name="size" value="male">
                3X Large</span> <span>
                <input type="radio" name="size" value="male">
                4X Large</span> <span>
                <input type="radio" name="size" value="male">
                5X Large</span> </div>
    </div><?php */ ?>
</div>


