<div class="footerwrapper">
    <div class="wrapper">
        <div class="footer-link-main">
            <div class="footer-link-left">
                <h2 class="footer-link-head">PRODUCTS</h2>
                <div class="responsive-fl-head pro-head">PRODUCTS <i class="fa fa-angle-down" aria-hidden="true"></i>
                </div>
                <ul class="footer-links footer-pro-link">
                    <? $queryBrndSrc = mysql_query("select jet_node_name,jet_node_id from mutual_category where parent_id='0' order by sortorder asc limit 0,9");
                    $resultBrndSrc = mysql_num_rows($queryBrndSrc);
                    if ($resultBrndSrc > 0) {
                        while ($BrndSrcObj = mysql_fetch_object($queryBrndSrc)) {
                            $brandnm = stripslashes($BrndSrcObj->jet_node_name);
                            $BrNm = str_replace(" ", "+", $brandnm); ?>
                    <li><a href="<?= GetUrl_Catt($BrndSrcObj->jet_node_id); ?>"><?= $brandnm; ?></a></li>
                    <? } ?>
                    <? } ?>
                </ul>
                <!-- <ul class="footer-links footer-pro-link">
                    <li><a href="#">Marking and Measuring</a></li>
                    <li><a href="#">Pennants and Markers</a></li>
                    <li><a href="#">Rebar Caps</a></li>
                    <li><a href="#">Safety Bests & Apparel</a></li>
                    <li><a href="#">Traffic Safety</a></li>
                    <li><a href="#">Personal Protection</a></li>
                    <li><a href="#">Tools</a></li>
                    <li><a href="#">Building Materials</a></li>
                </ul> -->

                <ul class="footer-links footer-pro-link">
                    <? $queryBrndSrc = mysql_query("select jet_node_name,jet_node_id from mutual_category where parent_id='0' order by sortorder asc limit 10,18");
                    $resultBrndSrc = mysql_num_rows($queryBrndSrc);
                    if ($resultBrndSrc > 0) {
                        while ($BrndSrcObj = mysql_fetch_object($queryBrndSrc)) {
                            $brandnm = stripslashes($BrndSrcObj->jet_node_name);
                            $BrNm = str_replace(" ", "+", $brandnm); ?>
                    <li><a href="<?= GetUrl_Catt($BrndSrcObj->jet_node_id); ?>"><?= $brandnm; ?></a></li>
                    <? } ?>
                    <? } ?>
                </ul>
                <div class="clear"></div>
            </div>
            <!-- <div class="footer-link-left">
                <h2 class="footer-link-head">PRODUCTS</h2>
                <div class="responsive-fl-head pro-head">PRODUCTS <i class="fa fa-angle-down" aria-hidden="true"></i></div>
                <ul class="footer-links footer-pro-link">
                    <li><a href="#">Silt Fence</a></li>
                    <li><a href="#">Erosion Control</a></li>
                    <li><a href="#">Sandbags</a></li>
                    <li><a href="#">Geotextiles</a></li>
                    <li><a href="#">Safety Fence</a></li>
                    <li><a href="#">Tapes - Barricade</a></li>
                    <li><a href="#">Tapes - Flagging</a></li>
                    <li><a href="#">Tapes - Reflective</a></li>
                    <li><a href="#">Tapes - Specialized</a></li>
                </ul>
                <ul class="footer-links footer-pro-link">
                    <li><a href="#">Marking and Measuring</a></li>
                    <li><a href="#">Pennants and Markers</a></li>
                    <li><a href="#">Rebar Caps</a></li>
                    <li><a href="#">Safety Bests & Apparel</a></li>
                    <li><a href="#">Traffic Safety</a></li>
                    <li><a href="#">Personal Protection</a></li>
                    <li><a href="#">Tools</a></li>
                    <li><a href="#">Building Materials</a></li>
                </ul>
                <div class="clear"></div>
            </div> -->
            <div class="footer-link-right">
                <div class="footer-link-right-box">
                    <h3 class="footer-link-head">ABOUT</h3>
                    <div class="responsive-fl-head about-head">ABOUT <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </div>
                    <ul class="footer-links footer-about-link">
                        <li><a href="<?= $SITE_URL; ?>/about-us">About</a></li>
                        <li><a href="<?= $SITE_URL; ?>/privacy-policy">Privacy Policy</a></li>
                        <li><a href="<?= $SITE_URL; ?>/become-a-vendor">Become a Distributor</a></li>
                        <li><a href="<?= $SITE_URL; ?>/careers">Careers</a></li>
                        <li><a href="<?= $SITE_URL; ?>/contact-us">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-link-right-box">
                    <h4 class="footer-link-head">MY ACCOUNT</h4>
                    <div class="responsive-fl-head account-head">MY ACCOUNT <i class="fa fa-angle-down"
                            aria-hidden="true"></i></div>
                    <ul class="footer-links footer-acc-link">
                        <li><a href="<?= $SITE_URL; ?>/login">Distributor Login</a></li>
                        <li><a href="<?= $SITE_URL; ?>/register">My Dashboard</a></li>
                        <li><a href="<?= $SITE_URL; ?>/myaccount">Order History</a></li>
                        <li><a href="<?= $SITE_URL; ?>/my-orders">Email Notifications</a></li>
                        <?php /*?><li><a href="#">Email Notifications</a></li>
                        <li><a href="#">Trims & Textiles</a></li>
                        <li><a href="#">High Technology Tapes</a></li><?php */ ?>
                    </ul>
                </div>
                <div class="footer-link-right-box">
                    <h5 class="footer-link-head">Customer Service</h5>
                    <div class="responsive-fl-head service-head">Customer Service <i class="fa fa-angle-down"
                            aria-hidden="true"></i></div>
                    <ul class="footer-links footer-service-link">
                        <li><a href="<?= $SITE_URL; ?>/ordering">Shipping Policy</a></li>
                        <li><a href="<?= $SITE_URL; ?>/order-tracking">Feedback</a></li>
                        <!-- <?php /*?><li><a href="<?=$SITE_URL;?>/shipping-policy">Shipping Policy</a></li><?php */ ?>
                        <li><a href="<?= $SITE_URL; ?>/standard-return-policy">Returns</a></li>
                        <li><a href="<?= $SITE_URL; ?>/contact-us">Feedback</a></li> -->
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <!-- <div class="footer-newsletter">
					<div class="footer-newsletter-title">Subscribe to Our Newsletter for Product Specials!</div>
					<form name="subscribe" id="subscribe" method="post" enctype="multipart/form-data">
						<div class="subscribe-newsletter-box">
							<label>Enter Email</label>
							<input class="newsletter-input" type="text" id="email" name="email">
						</div>
					</form>
		</div> -->
        <div class="footer-newsletter">
            <form name="Frmnewsletter" id="Frmnewsletter" method="post" enctype="multipart/form-data" onSubmit="return checkvalhom();return false;">
            <div class="footer-newsletter-title">Subscribe to Our Newsletter for Product Specials!</div>
            <div class="subscribe-newsletter-box">
							<label>Enter Email</label>
							<input class="newsletter-input" type="text" id="email" name="email">
						</div>
            </form>
            <!-- <span id="NEWLATr" style="color:#FFFFFF"></span> </div> -->
        </div>
    </div>
    <div class="copyright-deta">
        <div class="wrapper">
            <div class="copyright-bottom-logo">
                <img src="images/footer-bottom-logo.png" alt="" />
            </div>
            <a class="copyright-btn" href="#">Mutual Industries, Inc &copy; 2022</a>
            <div class="clear"></div>
        </div>
    </div>
</div>
<script src="js/easyzoom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnify/2.3.3/js/jquery.magnify.min.js" integrity="sha512-YKxHqn7D0M5knQJO2xKHZpCfZ+/Ta7qpEHgADN+AkY2U2Y4JJtlCEHzKWV5ZE87vZR3ipdzNJ4U/sfjIaoHMfw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- easyzoom -->
<script>
	// Instantiate EasyZoom instances
	var $easyzoom = $('.easyzoom').easyZoom();

	// Setup thumbnails example
	var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

	$('.thumbnails').on('click', 'a', function(e) {
		var $this = $(this);

		e.preventDefault();

		// Use EasyZoom's `swap` method
		api1.swap($this.data('standard'), $this.attr('href'));
	});
</script>

<!-- cdnjs jquery -->
<script src="js/jquery-2.2.0.min.js"></script>
<!-- Top navigation -->
<script language="JavaScript">
		$(document).ready(function() {
			$(".topnav").accordion({
				accordion:false,
				speed: 500,
				closedSign: '<i class="fa fa-plus"></i>',
				openedSign: '<i class="fa fa-minus"></i>'
			});
		});	
		function openNav() {
		document.getElementById("myNav").style.width = "100%";
		}
		
		function closeNav() {
		document.getElementById("myNav").style.width = "0%";
		}	
	</script>

<script>
    function checkvalhom() {
        if (document.getElementById("newsletteremail").value == "" || document.getElementById("newsletteremail").value ==
            "Email Address") {
            alert("Please enter your email address.");
            document.getElementById("newsletteremail").focus();
            return false;
        } else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(document.getElementById("newsletteremail")
            .value))) {
            alert("Please enter a proper email address.");
            document.getElementById("newsletteremail").focus();
            return false;
        } else {
            LoadAllColorsHOM();
            return false;
        }
    }

    function LoadAllColorsHOM() {
        email = document.getElementById("newsletteremail").value;
        var http3_Ftr = false;
        if (navigator.appName == "Microsoft Internet Explorer") {
            http3_Ftr = new ActiveXObject("Microsoft.XMLHTTP");
        } else {
            http3_Ftr = new XMLHttpRequest();
        }
        http3_Ftr.abort();
        http3_Ftr.open("GET", "ajax_newlater.php?email=" + email, true);
        http3_Ftr.onreadystatechange = function() {
            if (http3_Ftr.readyState == 4) {
                document.getElementById("NEWLATr").innerHTML = http3_Ftr.responseText;
                document.getElementById("newsletteremail").value = "";
                return false;
            }
        }
        http3_Ftr.send(null);
    }
</script>
<script>
    window.onscroll = function() {
        myFunctiontopFix()
    };

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunctiontopFix() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
</script>
<!-- Responsive footer  -->
<script>
        $(document).ready(function() {
            $(".pro-head").click(function() {
                $(".footer-pro-link").toggle();
            });
        });
        $(document).ready(function() {
            $(".about-head").click(function() {
                $(".footer-about-link").toggle();
            });
        });
        $(document).ready(function() {
            $(".account-head").click(function() {
                $(".footer-acc-link").toggle();
            });
        });
        $(document).ready(function() {
            $(".service-head").click(function() {
                $(".footer-service-link").toggle();
            });
        });
</script>
<!--Responsive help topics  -->
<script>
        $(document).ready(function(){
          $(".responsive-category-left-title").click(function(){
        	$(".category-list").toggle();
          });
        });
</script>
