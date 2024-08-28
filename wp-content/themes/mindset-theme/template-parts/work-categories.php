<?php
    $terms = get_terms( 
        array(
            'taxonomy' => 'fwd-work-category',
        )
    );
    if ( $terms && ! is_wp_error($terms) ) : ?>
        <section>
            <h3><?php esc_html_e( 'See Our Work', 'fwd' ); ?></h3>
            <ul>
                <?php foreach ( $terms as $term ) : ?>
                    <li><a href="<?php echo get_term_link( $term ); ?>"><?php echo esc_html( $term->name ) . ' (' . esc_html( $term->count ) . ')'; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>
<?php endif;