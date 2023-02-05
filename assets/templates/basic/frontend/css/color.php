<?php
header("Content-Type:text/css");
$color = "#f0f"; // Change your Color Here
$secondColor = "#ff8"; // Change your Color Here

function checkhexcolor($color){
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if (isset($_GET['color']) AND $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

if (!$color OR !checkhexcolor($color)) {
    $color = "#336699";
}


function checkhexcolor2($secondColor){
    return preg_match('/^#[a-f0-9]{6}$/i', $secondColor);
}

if (isset($_GET['secondColor']) AND $_GET['secondColor'] != '') {
    $secondColor = "#" . $_GET['secondColor'];
}

if (!$secondColor OR !checkhexcolor2($secondColor)) {
    $secondColor = "#336699";
}
?>


.btn--base, .btn--base:hover, body::-webkit-scrollbar-thumb, .scroll-to-top, .about-thumb .play-btn, .donor-card, .work-item__icon .step, .blog-post__meta .tag, .footer-widget__title::after, .subscribe-form button, .contact-wrapper-content > .title::after, .preloader div:before {
    background-color: <?php echo $color ?>;
}

.custom--accordion-two .accordion-button:not(.collapsed), .header .site-logo.site-title, .hero__blood-search-form .input-field i, .avaiable-blood-single::after, .avaiable-blood-single__name, .about-item__icon, .work-item__icon i, .tags .single-tag, .sidebar-category__single a:hover, .sidebar-category .more, .footer .footer-contact-list li .icon i, .footer-links-list li a:hover, .single-info__content a:hover, .overview-item__icon,.header .main-menu li a:hover, .header .main-menu li a:focus, .page-breadcrumb li:first-child::before{
    color: <?php echo $color ?>;
}

.text--base{
    color:  <?php echo $color ?> !important;
}
.caption-list-two {
    background-color: <?php echo $color ?>1a;
}
.bg--base {
    background-color: <?php echo $color ?> !important;
}


.custom--table thead, .header, .header.menu-fixed .header__bottom, .language-select option, .inner-hero::after, .avaiable-blood-single, .about-item__icon, .donor-card::before, .work-item__icon, .testimonial-card, .sidebar-widget__header, .contact-form .select option, .section--bg2, .preloader-holder, .blood-donor-info-area{
    background-color: <?php echo $secondColor ?>;
}

.blood-donor-info-area {
    box-shadow: 0 5px 15px <?php echo $secondColor ?>4f;
}