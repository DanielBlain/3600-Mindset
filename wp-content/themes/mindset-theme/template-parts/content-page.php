<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php fwd_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fwd' ),
				'after'  => '</div>',
			)
		);
        
        if ( is_page( 'contact' )) :
        ?>
            <div class="entry-content">
                <?php
                if ( get_field( 'street_address' )) {
                    $street = get_field( 'street_address' );
                    echo '<i class="footer_contact_right">'
                        . $street
                        .'</i>';
                }

                if ( get_field( 'email_address' )) {
                    $email = get_field( 'email_address' );
                    $mailto = 'mailto:' . $email;
                    echo '<i class="footer_contact_right"><a href="'
                        . esc_url( $mailto )
                        .'">'
                    .esc_html( $email )
                    . '</a></i>';
                }
                ?>
            </div>
        <?php
        endif;
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php fwd_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
