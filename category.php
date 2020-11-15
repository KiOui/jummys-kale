<?php
/**
* The category template file.
*
* @package kale
*/
?>
<?php get_header(); ?>

<?php
$kale_posts_sidebar = kale_get_option('kale_posts_sidebar');

?>

<!-- Full Width Category -->
<div class="row two-columns">
    <!-- Main Column -->
    <?php if($kale_posts_sidebar == 1) { ?>
    <div class="main-column <?php if($kale_sidebar_size == 0) { ?> col-md-8 <?php } else { ?> col-md-9 <?php } ?>" role="main">
    <?php } else { ?>
    <div class="main-column col-md-12" role="main">
    <?php } ?>
        <h1 class="block-title"><span><?php single_cat_title(); ?></span></h1>
        <?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>

        <!-- Blog Feed -->
        <div class="blog-feed">
            <?php $kale_i = 0;
            if ( have_posts() ) {
                while ( have_posts() ) : the_post(); ?>
                <?php if($kale_i%2 == 0) { ?><div class="row" data-fluid=".entry-title"><?php } ?>
                <div class="col-md-6"><?php $kale_entry = 'small'; include(locate_template('parts/entry.php')); $kale_i++; ?></div>
                <?php if($kale_i%2 == 0) { ?></div><?php } ?>
                <?php
                endwhile;
                if ($kale_i%2 == 1) { ?></div><?php } 
            }?>

        </div>
        <!-- /Blog Feed -->
        <?php if(get_next_posts_link() || get_previous_posts_link()) { ?>
        <hr />
        <div class="pagination-blog-feed">
            <?php kale_pagination(null, [], function(){ ?>
                <?php if( get_next_posts_link() ) { ?><div class="previous_posts"><?php next_posts_link( esc_html__('Previous Posts', 'kale') ); ?></div><?php } ?>
                <?php if( get_previous_posts_link() ) { ?><div class="next_posts"><?php previous_posts_link( esc_html__('Next Posts', 'kale') ); ?></div><?php } ?>
            <?php }); ?>
        </div>
        <?php } ?>
    </div>
    <!-- /Main Column -->

    <?php if($kale_posts_sidebar == 1)  get_sidebar();  ?>
</div>
<!-- /Full Width Category -->
<hr />

<?php get_footer(); ?>
