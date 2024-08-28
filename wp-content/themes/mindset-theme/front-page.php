<?php
/**
 * The template for displaying the front page (Home).
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
            ?>

            <section class='home-intro'>
                <?php
                the_post_thumbnail();
                if ( function_exists ( 'get_field' )) {
                    if ( get_field( 'top_section' )) {
                        the_field( 'top_section' );
                    }
                }
                ?>
            </section>

            <section class='home-work'>
                <?php
                // Works Section - - does not present if there are no works
                    $args = array(
                        'post_type'      => 'fwd-work',
                        'posts_per_page' => 4,
                        'tax_query'      => array(
                            array(
                                'taxonomy'          => 'fwd-featured',
                                'field'             => 'slug',
                                'terms'             => 'front-page'
                            )
                        )
                    );
                    $query = new WP_Query( $args );
                    
                    if ( $query->have_posts() ) {
                        echo '<section class="home-work"><h2>';
                        esc_html_e( 'Featured Works', 'fwd' );
                        echo '</h2>';
                        while( $query->have_posts() ) {
                            $query->the_post(); 
                            ?>
                            <article>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                    <h3><?php the_title(); ?></h3>
                                </a>
                            </article>
                            <?php
                        }
                        wp_reset_postdata();
                        echo '</section>';
                    }
                ?>
            </section>

            <section class='home-work2'>
                <h2><?php esc_html_e( 'Featured Works via ACF Relationship', 'fwd' ); ?></h2>
                <?php
                $featured_posts = get_field('relationship');
                if( $featured_posts ): ?>
                    <?php foreach( $featured_posts as $featured_post ): 
                        $permalink = get_permalink( $featured_post->ID );
                        $title = get_the_title( $featured_post->ID );
                        $thumbnail = get_the_post_thumbnail( $featured_post->ID, 'medium' );
                    ?>
                        <a href="<?php echo esc_url( $permalink ); ?>">
                            <h3><?php echo esc_html( $title ); ?></h3>
                            <?php echo $thumbnail; ?>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>

            <section class='home-left'>
                <?php
                if ( function_exists ( 'get_field' )) {
                    if ( get_field( 'left_section_heading' )) {
                        echo '<h2>';
                        the_field( 'left_section_heading' );
                        echo '</h2>';
                    }
                    if ( get_field( 'left_section_paragraph' )) {
                        echo '<p>';
                        the_field( 'left_section_paragraph' );
                        echo '</p>';
                    }
                    if ( get_field( 'right_section_heading' )) {
                        echo '<h2>';
                        the_field( 'right_section_heading' );
                        echo '</h2>';
                    }
                    if ( get_field( 'right_section_paragraph' )) {
                        echo '<p>';
                        the_field( 'right_section_paragraph' );
                        echo '</p>';
                    }
                }
                ?>
            </section>

            <section class='home-right'></section>
            <section class='home-slider'></section>

            <section class='home-blog'>
                <h2><?php esc_html_e( 'Latest Blog Posts', 'fwd' ); ?></h2>
                <?php
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 4,
                );
                $blog_query = new WP_Query( $args );
                if ( $blog_query->have_posts() ) {
                    while ( $blog_query->have_posts() ) {
                        $blog_query->the_post();
                        ?>
                        <article>
                            <a href="<?php the_permalink(); ?>">
                                <h3><?php the_title(); ?></h3>
                                <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>
                                <br />
                                <?php the_post_thumbnail( 'landscape-blog' ); ?>
                            </a>
                        </article>
                        <?php
                    }
                    wp_reset_postdata();
                }
                ?>
            </section>
            
            <?php
		endwhile; // End of the loop.
		?>

	</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
