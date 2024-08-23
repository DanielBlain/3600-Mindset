<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.

        if ( is_page( 'contact' )) :
        ?>
            <div class="entry-content">
                <?php
                if ( function_exists ( 'get_field' ) ) {
                    
                    if ( get_field( 'street_address' ) ) {
                        echo '<p>';
                        the_field( 'street_address' );
                        echo '</p>';
                    }
                    
                    if ( get_field( 'email_address' ) ) {
                        echo '<p>';
                        the_field( 'email_address' );
                        echo '</p>';
                    }
                }
                ?>
            </div>
        <?php
        endif;
        ?>
	</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
