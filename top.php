<div class="headerwrapper" id="myHeader">
    <div class="top-head-line">
        <div class="wrapper">
            <h1>Manufacturer of Quality Construction, Safety, Surveying Accessories, Geotextile and Erosion Control
                Materials</h1>
        </div>
    </div>

    <div class="header-main">
        <div class="wrapper">
            <div class="logo">
                <a href="<?= $SITE_URL; ?>"><img src="images/brands-logo1.png" alt="Logo <?= $siteALTTXT; ?>" /></a>
            </div>
            <div class="responsive-menu">
                <div id="myNav" class="overlay">
                    <a href="javascript:void(0)" class="closebtn" onClick="closeNav()">&times;</a>
                    <ul class="topnav">
                        <li><a href="<?= $SITE_URL; ?>">HOME</a></li>
                        <li><a href="<?= $SITE_URL; ?>/about-us">ABOUT</a></li>
                        <li><a href="<?= $SITE_URL; ?>/category/silt-fence/11">CATEGORIES</a></li>
                        <li><a href="<?= $SITE_URL; ?>/product-specials-fd">SPECIALS</a></li>
                        <li><a href="<?= $SITE_URL; ?>/spec-sheets">SPEC SHEETS</a></li>
                        <li><a href="<?= $SITE_URL; ?>/contact-us">CONTACT US</a></li>
                    </ul>
                </div>
                <span class="responsive-menu-btn" onClick="openNav()">&#9776;</span>
                <div class="responsive-order-call">TO ORDER, CALL TOLL FREE: <span>800-523-0888</span></div>
            </div>
            <div class="header-right">
                <div class="header-right-search">
                    <div class="header-search-left">
                        <form name="search" id="search" method="post" enctype="multipart/form-data"
                            action="search-mid.php">
                            <div class="search-box">
                                <input class="search-input" type="text" placeholder="Search" name="keyword">
                                <a class="search-btn" href="#"><img src="images/search-icon.png" alt="" /></a>
                            </div>
                        </form>
                    </div>
                    <div class="header-search-right">
                        <a href="#"><img src="images/fb-icon.png" alt="" /></a>
                        <a href="#"><img src="images/tw-icon.png" alt="" /></a>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="header-bottom">
                    <div class="order-call">TO ORDER, CALL TOLL FREE: <span>800-523-0888</span></div>
                    <div class="cart-detail">
                        <ul class="login-btn">
                            <? if($_SESSION['UsErId']!="" && $_SESSION['UsErId']!="0"){?>
                            <li>Welcome!</li>
                            <li><a href="myaccount">My Account</a></li>
                            <li>|</li>
                            <li><a href="logout.php">Sign out</a></li>
                            <? }else{?>
                            <li><a href="<?=$SITE_URL;?>/login">Sign In</a></li>
                            <span>or</span>
                            <li><a href="<?=$SITE_URL;?>/register">Create Account</a></li>
                            <? } ?>
                        </ul>
                        <div class="cart-icon">
                            <a href="items-in-your-cart">
                                <span>Cart</span>
                                <img src="images/cart-icon.png" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="header-menu">
        <div class="wrapper">
            <ul>
                <li class="<? if($page=='home'){echo 'active';}?>"><a href="<?= $SITE_URL; ?>" <? if ($TopTab=="Home" )
                        { ?>
                        <? } ?>>HOME
                    </a></li>
                <li class="<? if($page=='about'){echo 'active';}?>"><a href="<?= $SITE_URL; ?>/about-us" <? if
                        ($TopTab=="About" ) { ?>class=""
                        <? } ?>>ABOUT
                    </a></li>
                <li class="<? if($page=='category' || $page=='detail'){echo 'active';}?>"> <a
                        href="<?= $SITE_URL; ?>/category/silt-fence/11" <? if ($TopTab=="Categories" ) { ?>class=""
                        <? } ?>>CATEGORIES
                    </a>
                    <!-- <ul class="sub-menu">
                        <? $CateQur = "select * from mutual_category where parent_id='0' order by sortorder asc";
                        $CateRes = mysql_query($CateQur);
                        $CateTot = mysql_affected_rows();
                        if ($CateTot > 0) {
                            while ($CateRow = mysql_fetch_array($CateRes)) { ?>
                        <? $CateQur2 = "select * from mutual_category where parent_id='" . $CateRow['jet_node_id'] . "' order by jet_node_id asc";
                                $CateRes2 = mysql_query($CateQur2);
                                $CateTot2 = mysql_affected_rows(); ?>
                        <li> <a href="<?= GetUrl_Catt($CateRow['jet_node_id']); ?>"><?php echo stripslashes($CateRow['jet_node_name']); ?>
                                <? if ($CateTot2 > 0) { ?> <span><i class="fa fa-angle-right"
                                        aria-hidden="true"></i></span>
                                <? } ?>
                            </a>
                            <? if ($CateTot2 > 0) { ?>

                            <ul class="subin-menu">
                                <? while ($CateRow2 = mysql_fetch_array($CateRes2)) { ?>
                                <? $CateQur3 = "select * from mutual_category where parent_id='" . $CateRow2['jet_node_id'] . "' order by jet_node_id asc";
                                                $CateRes3 = mysql_query($CateQur3);
                                                $CateTot3 = mysql_affected_rows(); ?>
                                <li><a href="<?= GetUrl_Catt($CateRow2['jet_node_id']); ?>"><?php echo stripslashes($CateRow2['jet_node_name']); ?>
                                        <? if ($CateTot3 > 0) { ?> <span><i class="fa fa-angle-right"
                                                aria-hidden="true"></i></span>
                                        <? } ?>
                                    </a>
                                    <? if ($CateTot3 > 0) { ?>
                                    <ul class="sub3-menu">
                                        <? while ($CateRow3 = mysql_fetch_array($CateRes3)) { ?>
                                        <li><a
                                                href="<?= GetUrl_Catt($CateRow3['jet_node_id']); ?>"><?php echo stripslashes($CateRow3['jet_node_name']); ?></a>
                                        </li>
                                        <? } ?>
                                    </ul>
                                    <? } ?>
                                </li>
                                <? } ?>
                            </ul>
                            <? } ?>
                        </li>
                        <? }
                        } ?>
                    </ul> -->
                    <!-- <ul class="sub-menu">
                        <li>
                            <a href="javascript:void(0)">Slit Fence
                                <span>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </span>
                            </a>
                            <ul class="subin-menu">
                                <li><a href="javascript:void(0)">Prefabricated</a></li>
                                <li><a href="javascript:void(0)">Prefabricated</a></li>
                                <li><a href="javascript:void(0)">Prefabricated</a></li>
                                <li><a href="javascript:void(0)">Prefabricated</a></li>
                                <li><a href="javascript:void(0)">Prefabricated</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0)">Slit Fence
                                <span>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </span>
                            </a>
                            <ul class="subin-menu">
                                <li><a href="javascript:void(0)">Prefabricated</a></li>
                                <li><a href="javascript:void(0)">Prefabricated</a></li>
                                <li><a href="javascript:void(0)">Prefabricated</a></li>
                                <li><a href="javascript:void(0)">Prefabricated</a></li>
                                <li><a href="javascript:void(0)">Prefabricated</a></li>
                            </ul>
                        </li>

                        <li><a href="javascript:void(0)">Slit Fence</a></li>
                        <li><a href="javascript:void(0)">Slit Fence</a></li>
                        <li><a href="javascript:void(0)">Slit Fence</a></li>
                    </ul> -->
                </li>
                <li class="<? if($page=='specials'){echo 'active';}?>"><a href="<?= $SITE_URL; ?>/product-specials-fd"
                        <? if ($TopTab=="Blog" ) { ?>
                        <? } ?>>SPECIALS
                    </a></li>
                <li class="<? if($page=='spec_sheet'){echo 'active';}?>"><a href="<?= $SITE_URL; ?>/spec-sheets" <? if
                        ($TopTab=="Sheet" ) { ?>
                        <? } ?>>SPEC SHEETS
                    </a></li>
                <li class="<? if($page=='contact-us'){echo 'active';}?>"><a href="<?= $SITE_URL; ?>/contact-us" <? if
                        ($TopTab=="contact-us" ) { ?>
                        <? } ?>>CONTACT US
                    </a></li>
            </ul>
        </div>
    </div>
</div>