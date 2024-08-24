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
        if ( have_posts() ) {
            if ( function_exists ( 'get_field' ) ) {

                /** Display Service mini-nav */
                $args = array(
                    'post_type'      => 'fwd-service',
                    'posts_per_page' => -1,
                    'order'          => 'ASC',
                );
                $query = new WP_Query( $args );
                
                if ( $query->have_posts() ) {
                    echo '<nav class="service-links">';
                    while( $query->have_posts() ) {
                        $query->the_post(); 
                        echo '<a href="#';
                            the_ID();
                            echo '">';
                            the_title();
                        echo '</a>';
                    }
                    wp_reset_postdata();
                    echo '</nav>';
                }
        

                /** Display each Service in ascending order */
                // Using the same $args array
                $query = new WP_Query( $args );
                
                if ( $query->have_posts() ) {
                    while( $query->have_posts() ) {
                        $query->the_post(); 
                        ?>
                        <article id="<?php the_ID(); ?>">
                            <a href="<?php the_permalink(); ?>">
                                <h2><?php the_title(); ?></h2>
                            </a>
                            <?php
                                if ( get_field( 'service_description' )) {
                                    $service_description = get_field( 'service_description' );
                                    echo $service_description;
                                }
                            ?>
                        </article>
                        <?php
                    }
                    wp_reset_postdata();
                }
            }
        }
        else {

            get_template_part( 'template-parts/content', 'none' );

        }
        ?>
    </main>

<?php
get_sidebar();
get_footer();
