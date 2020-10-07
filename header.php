<?php
global $post;
if(is_single()) {
    $slug = get_post($post)->post_name;
} else {
    $slug = '';
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(' - ', true, 'right'); ?> Roy Rosenzweig Center for History and New Media</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic,300|Oswald:400,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo bloginfo('template_directory'); ?>/style.css" type="text/css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="<?php echo bloginfo('template_directory'); ?>/js/globals.js"></script>
    <?php if ( is_page()): ?>
        <?php $customFields = get_post_custom(); ?>
        <?php if (isset($customFields['Image'])): ?>
            <?php $imgBgUrl = $customFields['Image']; ?>
        <?php elseif (has_post_thumbnail()): ?>
            <?php $imgBgUrl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>
        <?php endif; ?>
    <style>
        #intro:before {
            <?php if (get_field('header-image')): ?>
            background-image: url('<?php echo get_field('header-image'); ?>');
            <?php elseif (isset($imgBgUrl)): ?>
            background-image: url('<?php echo $imgBgUrl[0]; ?>');
            <?php endif; ?>
        }
    </style>
    <?php endif; ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class($slug); ?>>

    <header>
        <a id="skipnav" href="#content">Skip to content</a>
        <div class="logo"><a href="<?php echo home_url(); ?>">Roy Rosenzweig Center for History and New Media</a></div>

        <nav id="global">
            <a href="#" class="mobile-toggle" role="button">
              <span class="mobile-toggle-icon" aria-hidden="true"></span>
              <span class="sr-only">Toggle mobile navigation</span>
            </a>
           <?php wp_nav_menu( array( 'theme_location' => 'header-menu') ); ?>
        </nav>
        <div id="search">
            <button type="button" class="search-toggle">
                <span class="search-toggle-icon" aria-hidden="true"></span>
                <span class="sr-only">Toggle search form</span>
            </button>
            <?php echo get_search_form(); ?>
        </div>
    </header>
    <div id="content" role="main" tabindex="-1">