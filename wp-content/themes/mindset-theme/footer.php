<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FWD_Starter_Theme
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="footer-contact">	
            <?php
                if ( !is_page( 'contact' ) && function_exists ( 'get_field' ) ) {
                    
                    if ( get_field( 'street_address', 16 )) {
                        $street = get_field( 'street_address', 16 );
                        echo '<i class="footer_contact_right">'
                            . $street
                            .'</i>';
                    }
                    
                    if ( get_field( 'email_address', 16 )) {
                    // Where 16 is the unique ID of the Contact page
                        $email = get_field( 'email_address', 16 );
                        $mailto = 'mailto:' . $email;
                        echo '<i class="footer_contact_right"><a href="'
                            .esc_url( $mailto )
                            .'">'
                        .esc_html( $email )
                        . '</a></i>';
                    }
                }
            ?>
		</div><!-- footer-contact -->
		<div class="footer-menus">
				<nav class="footer-navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'footer-left' )); ?>
                </nav>
                <nav>
                    <?php wp_nav_menu( array( 'theme_location' => 'footer-right' )); ?>
                </nav>
		</div><!-- .footer-menus -->
		<div class="site-info">
            <?php the_privacy_policy_link(); ?></br>
			<?php esc_html_e( 'Created by ', 'fwd' ); ?><a href="<?php echo esc_url( __( 'https://wp.bcitwebdeveloper.ca/', 'fwd' ) ); ?>"><?php esc_html_e( 'Jonathon Leathers', 'fwd' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
