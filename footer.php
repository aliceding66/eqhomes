<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package EQ HOMES
 */
?>

<div class="bottom">
    <div class="container narrow">
        <div class="row">
            <div class="col-md-4">
                <h4><?php the_field('title_quick_movein', 'option'); ?></h4>

                <?php the_field('description_quick_movein', 'option'); ?>
                <a href="<?php the_field('read_more_link_quick_movein', 'option'); ?>"><button type="button" class="btn btn-primary">learn more</button></a>

		<script src="https://cdn.avidratings.com/www/js/avidwidget_min.js"></script>
		<script type="text/javascript">window.onload = function() {
					AvidWidget("eq-homes");
				}
		</script>
				<style>

					div#AvidWidgetDiv tr td {
						color: #000;
					}

				</style>

                <div style="margin-top: 15px; margin-bottom: 20px; background-color: #fff; padding: 5px; border: 1px solid transparent;
    border-radius: 4px;" id="AvidWidgetDiv">

				</div>

         		<div style="padding-bottom: 12px;">
					<a target="_blank" title="eQ Homes Takes Home Top Honours at GOHBA Awards Gala"	href="https://www.eqhomes.ca/awards-copy/">
						<img alt="2018 GOHBA Housing Awards Production Builder of the Year"	style="border: 0;" src="https://www.eqhomes.ca/wp-content/uploads/2019/10/190227_0.png" />
					</a>
				</div>

          		<div style="padding-bottom: 12px;">
					<a target="_blank" title="Click to find out more about the eQ Homes Pro
					Builder Rating"
					href="http://www.ottawasnewesthomes.com/Home-Builder-Ratings/">
					<img alt="Click to find out more about the eQ Homes Pro Builder Rating"
					style="border: 0;"
					src="https://www.ottawasnewesthomes.com/ratings/eq-Homes-rating-badge.png"
					/>
					</a>
				</div>

           		<div><a target="_blank" title="Click for the Business Review of EQ Homes, a TBD in Ottawa ON" href="http://www.bbb.org/ottawa/business-reviews/home-builders/eq-homes-in-ottawa-on-58254#sealclick"><img alt="Click for the BBB Business Review of this TBD in Ottawa ON" style="border: 0;" src="https://seal-ottawa.bbb.org/seals/blue-seal-160-82-eqhomes-58254.png" /></a>
				</div>



            </div>
            <div class="col-md-4 testimonial">
                <?php
                remove_all_filters('posts_orderby'); // posts order by plugin conflict resolution to get random posts the normal way
                $my_query = new WP_Query(array(
                    'post_type' => array('testimonial'),
                    'posts_per_page' => 1,
                    'orderby' => 'rand',
                    'ignore_sticky_posts' => 1,
                ));
                ?>
                <?php while ($my_query->have_posts()) : $my_query->the_post();
                    ?>
                    <h4>Testimonials</h4>
                    <?php the_content(); ?>
<!--                     <div class="author"> -->
                         <!--<img src="<?php // echo get_template_directory_uri();       ?>/temp/judy.png">-->
                        <?php //the_post_thumbnail('gallery-thumb'); ?>
<!--                         <div class="name"> -->
							<?php //echo get_post_meta($post->ID, "_eqh_tname", true) ?>
<!-- 						</div> -->
<!--                         <div class="info"> -->
                            <?php //echo get_post_meta($post->ID, "_eqh_ttitle", true) ?>
<!--                         </div> -->
<!--                     </div> -->
<!--                     <a href="<?php //echo esc_url(home_url('/')); ?>video-testimonials"> -->
<!-- 						<button type="button" class="btn btn-primary">learn more</button> -->
<!-- 				</a> -->

                    <?php
                endwhile;
                wp_reset_query();
                ?>

            </div>
            <div class="col-md-4">

                <h4>Stay up-to-date with eQ Homes</h4>
                <form  method="post" id="contact-form" name="contact-form">

                	<!-- lasso elements -->
                    <input type="hidden" name="domainAccountId" id="domainAccountId" value="LAS-382183-01" />
                    <input type="hidden" name="guid" id="guid" value="" />
                    <!-- lasso elements ends -->

                    <div style="color:red" id="contact-alert"></div>
                    <label for="c-name">*First Name</label>
                    <input type="text" name="c-name" id="c-name" placeholder="Your first name*" class="form-control required">
                    <label for="c-lname">*Last Name</label>
                    <input type="text" name="c-lname" id="c-lname" placeholder="Your last name*" class="form-control required">
                    <label for="c-lname">*Phone Number</label>
                    <input type="text" name="c-phone" id="c-phone" placeholder="Your Phone Number*" class="form-control required">
                    <label for="c-name">*Email</label>
                    <input type="text" name="c-email" id="c-email" placeholder="Your email*" class="form-control required">
                   	<label for="c-lname">*Community</label>
                    <select id="c-community" name="c-community" class="form-control" >
                    	<option value="eQ Corporate||493||5122">Select Community</option>
                    <?php
						eqCommunityDropDownList();
					?>
                    </select>

                    <input type="checkbox" name="c-subscribe" id="c-subscribe">
                    <span> By clicking this box or by completing this Registration Form for eQ Homes Inc., I expressly provide my consent to receive electronic messages from eQ Homes retroactively, today and in the future for any projects by eQ Homes. I understand that I may withdraw my consent by unsubscribing at any time.</span>


                    <?php wp_nonce_field('contact-nonce', 'contactme'); ?>
                    <button type="submit" class="btn btn-primary pull-right" id="footer-submit-btn" name="footer-submit-btn">Send</button>


                </form>

            </div>

        </div>

<style type="text/css">

    @media screen and (min-height: 500px) {
        .modal-content{
            margin-top: 100px !important;
        }
    }
    @media screen and (min-height: 900px) {
        .modal-content{
            margin-top: 300px !important;
        }
    }
</style>

<div class="modal fade" id="register-thank-you-modal" style="background:rgba(255,255,255,0.85)">
    <div class="modal-dialog">
        <div class="modal-content" style="margin:auto;background: black;color:white;max-width:440px;border-radius: 0; ">
            <div class="modal-body" style="text-align: center;font-size:26px;font-family: Source Sans Pro;font-weight: 300;padding-top:10px; line-height: 26px; ">
                <h1 style="font-size: 67px ">thank you</h1>
                <p>for registering, we will<p>be in touch</p>
                <button style="background: black;color:white;border:1px solid white;font-size:16px; margin-top: 20px; border-radius: 0;font-weight: 100;margin-bottom:4px; " class="btn" data-dismiss="modal">close window</button>
            </div>
        </div>
    </div>
</div>

        <div class="row">
            <hr>
        </div>
        <div class="row socialmedia">
            <ul class="social">
                <a href="https://www.facebook.com/eqhomesottawa" target="_blank"><li class="facebook"></li></a>
                <a href="https://www.instagram.com/eqhomes.ottawa/" target="_blank"><li class="instagram"></li></a>
                <a href="https://www.youtube.com/eQHomes" target="_blank"><li class="youtubei"></li></a>
<!--                 <a href="http://pinterest.com/eqhomesottawa/" target="_blank"><li class="pinterest"></li></a>
                <a href="http://www.houzz.com/pro/eqhomes/eq-homes" target="_blank"><li class="houzz"></li></a> -->
            </ul>
        </div>
        <p class="credits"><a href="http://regionalgroup.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/regional1.png" alt=""/></a></p>
        <p class="credits">
            Copyright ©&nbsp;<?php echo date("Y") ?>&nbsp;eQ Homes. All rights reserved. *Prices subject to change without notice E&OE. **All Renderings are artists concept.<br>
            The ENERGY STAR® mark is administered and promoted in Canada by Natural Resources Canada. Used with permission.<br>
            Site design and branding by <a href="http://www.ryan-design.com" target="_blank">&nbsp;G Ryan Design</a>&nbsp;|&nbsp;<a href="<?php echo esc_url(home_url('/')); ?>privacy" >PRIVACY POLICY</a>
        </p>

    </div>
</div>
<!-- Global site tag (gtag.js) - Google Ads: 954694860 --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-954694860"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-954694860'); </script>
<script type="text/javascript">    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-23086901-1']);
    _gaq.push(['_trackPageview']);
    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();</script>

<script type="text/javascript">
    jQuery(function () {
        jQuery(".youtube").YouTubeModal({autoplay: 0, width: 800, height: 600});
    });
</script>
<script type="text/javascript">
    adroll_adv_id = "3LNV6SUFR5GQZBCJPTO2OC";
    adroll_pix_id = "W6YT5LOLTBDBDJLD7R7YT7";
    (function () {
        var oldonload = window.onload;
        window.onload = function () {
            __adroll_loaded = true;
            var scr = document.createElement("script");
            var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
            scr.setAttribute('async', 'true');
            scr.type = "text/javascript";
            scr.src = host + "/j/roundtrip.js";
            ((document.getElementsByTagName('head') || [null])[0] ||
                    document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
            if (oldonload) {
                oldonload()
            }
        };
    }());
</script>
<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 954694860;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/954694860/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<?php wp_footer(); ?>


<script type="text/javascript">
var _ldstJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
_ldstJsHost += "www.mylasso.com";
document.write(unescape("%3Cscript src='" + _ldstJsHost + "/analytics.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
<!--
var LassoCRM = LassoCRM || {};
(function(ns){
    ns.tracker = new LassoAnalytics('LAS-382183-01');
})(LassoCRM);
try {
    LassoCRM.tracker.setTrackingDomain(_ldstJsHost);
    LassoCRM.tracker.init();  // initializes the tracker
    LassoCRM.tracker.track(); // track() records the page visit with the current page title, to record multiple visits call repeatedly.
} catch(error) {}
-->
</script>


<script type="text/javascript">
(function(i) {var u =navigator.userAgent;
var e=/*@cc_on!@*/false; var st = setTimeout;if(/webkit/i.test(u)){st(function(){var dr=document.readyState;
if(dr=="loaded"||dr=="complete"){i()}else{st(arguments.callee,10);}},10);}
else if((/mozilla/i.test(u)&&!/(compati)/.test(u)) || (/opera/i.test(u))){
document.addEventListener("DOMContentLoaded",i,false); } else if(e){     (
function(){var t=document.createElement("doc:rdy");try{t.doScroll("left");
i();t=null;}catch(e){st(arguments.callee,0);}})();}else{window.onload=i;}})
(function() {
	var formsCollection = document.getElementsByTagName("form");
	for(var i=0;i<formsCollection.length;i++)
	{

	   if(typeof(formsCollection[i].guid) !== 'undefined'){
	   		formsCollection[i].guid.value = LassoCRM.tracker.readCookie("ut");
	   }
	}

	});
</script>

<script defer src="https://connect.podium.com/widget.js#API_TOKEN=8ecbbb52-f227-4608-a998-20b26ff10812" id="podium-widget" data-api-token="8ecbbb52-f227-4608-a998-20b26ff10812"></script>

<!-- Start of LiveChat (www.livechatinc.com) code -->
<!-- <script type="text/javascript">
window.__lc = window.__lc || {};
window.__lc.license = 8472971;
(function() {
  var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
  lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
})();
</script> -->
<!-- End of LiveChat code -->

</body>
</html>
