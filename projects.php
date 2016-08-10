<?php /* Template Name: What We Do */ ?>

<?php
$projectNav = [];
$projectCategory = get_term_by('name', 'Projects', 'category');
$projectHeaders = get_terms('category', array('parent' => $projectCategory->term_id));
foreach ($projectHeaders as $projectHeader) {
    $projectNav[$projectHeader->name] = get_terms('category', array('parent' => $projectHeader->term_id));
}
$projectsFilters = array(
    'posts_per_page' => -1,
    'post_type'     => 'page',
    'post_status' => 'publish',
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('projects'),
        ),
    ),
);
$featuredFilters = array(
    'posts_per_page' => -1,
    'post_type'     => 'page',
    'post_status' => 'publish',
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => array('featured'),
        ),
    ),
);
$projects = get_posts($projectsFilters);
$featured = get_posts($featuredFilters);
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div id="intro">
    <div class="container">
    <?php $customFields = get_post_custom(); ?>
    <h1><?php echo the_title(); ?></h1>
    <?php if ($introText = $customFields['Intro text'][0]): ?>
    <p><?php echo $introText; ?></p>
    <?php endif; ?>
    </div>
</div>

<div id="content">
    <?php echo the_content(); ?>
    <nav>
        <h2>Browse Projects</h2>
        <ul>
        <?php foreach($projectNav as $filter => $categories): ?>
            <?php if (count($categories) > 0): ?>
            <li>By <?php echo $filter; ?>
                <ul>
                    <?php foreach ($categories as $category): ?>
                    <li><a href="<?php echo esc_url(get_category_link($category->term_id)); ?>#projects"><?php echo $category->name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php endif; ?>
        <?php endforeach; ?>
        </ul>
    </nav>
    <div id="projects">
        <div id="featured">
            <h3>Featured Projects</h3>
            <?php foreach ($featured as $featuredProject): ?>
                <?php
                $projectID = $featuredProject->ID;
                $projectMeta = get_post_custom($projectID);
                $imgBgUrl = '';
                ?>
                <div class="project">
                    <?php
                    $imgBgUrl = '';
                    if ( has_post_thumbnail($projectID) ) {
                        $imgBgUrl = wp_get_attachment_image_src( get_post_thumbnail_id($projectID), 'large' );
                        $imgBgUrl = $imgBgUrl[0];
                    } else if (isset($projectMeta['Image'])) {
                        $imgBgUrl = site_url() . '/ui/i/project-images/' . $projectMeta['Image'][0];
                    }
                    ?>
                    <a href="<?php echo esc_url(get_permalink($projectID)); ?>" class="thumbnail" style="background-image:url('<?php echo $imgBgUrl; ?>')"></a>
                    <h4><a href="<?php echo esc_url(get_permalink($projectID)); ?>"><?php echo $featuredProject->post_title; ?></a></h4>
                    <?php if (isset($projectMeta['Short Description'])): ?>
                    <?php echo $projectMeta['Short Description'][0]; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php foreach ($projects as $project): ?>
            <?php
            $projectID = $project->ID;
            $projectMeta = get_post_custom($projectID);
            $imgBgUrl = '';
            ?>
            <div class="project">
                <?php
                $imgBgUrl = '';
                if ( has_post_thumbnail($projectID) ) {
                    $imgBgUrl = wp_get_attachment_image_src( get_post_thumbnail_id($projectID), 'large' );
                    $imgBgUrl = $imgBgUrl[0];
                } else if (isset($projectMeta['Image'])) {
                    $imgBgUrl = site_url() . '/ui/i/project-images/' . $projectMeta['Image'][0];
                }
                ?>
                <a href="<?php echo esc_url(get_permalink($projectID)); ?>" class="thumbnail" style="background-image:url('<?php echo $imgBgUrl; ?>')"></a>
                <h4><a href="<?php echo esc_url(get_permalink($projectID)); ?>"><?php echo $project->post_title; ?></a></h4>
            </div>
        <?php endforeach; ?>
    </div>

    </div>
</div>

<?php endwhile; else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php get_footer(); ?>