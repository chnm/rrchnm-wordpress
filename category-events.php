<?php
$customFields = get_post_custom();
$rrchnmAtTag = get_term_by('slug', 'rrchnm-at', 'post_tag');
$atRrchnmTag = get_term_by('slug', 'at-rrchnm', 'post_tag');
?>

<?php get_header(); ?>

<div class="container">

<aside id="blog-meta">
    <h1>Events</h1>

    <a href="<?php echo get_tag_link($rrchnmAtTag->term_id); ?>" class="rrchnm-at tag">RRCHNM@</a>
    <a href="<?php echo get_tag_link($atRrchnmTag->term_id); ?>" class="at-rrchnm tag">@RRCHNM</a>
</aside>

<?php include('event-posts.php'); ?>

</div>

<?php get_footer(); ?>