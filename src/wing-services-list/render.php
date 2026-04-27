<?php
/**
 * Wing Services List — front-end template.
 *
 * Receives $attributes, $content, and $block from WordPress's render mechanism.
 *
 * @package WingServicesList
 */

$heading    = isset( $attributes['heading'] ) ? $attributes['heading'] : '';
$subheading = isset( $attributes['subheading'] ) ? $attributes['subheading'] : '';
$columns    = isset( $attributes['columns'] ) ? (int) $attributes['columns'] : 3;
$services   = isset( $attributes['services'] ) && is_array( $attributes['services'] )
	? $attributes['services']
	: array();

if ( empty( $services ) && empty( $heading ) && empty( $subheading ) ) {
	return '';
}

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'wing-services wing-services--cols-' . esc_attr( $columns ),
	)
);
?>
<section <?php echo $wrapper_attributes; ?>>
	<?php if ( ! empty( $heading ) || ! empty( $subheading ) ) : ?>
		<header class="wing-services__header">
			<?php if ( ! empty( $heading ) ) : ?>
				<h2 class="wing-services__heading">
					<?php echo wp_kses_post( $heading ); ?>
				</h2>
			<?php endif; ?>
			<?php if ( ! empty( $subheading ) ) : ?>
				<p class="wing-services__subheading">
					<?php echo wp_kses_post( $subheading ); ?>
				</p>
			<?php endif; ?>
		</header>
	<?php endif; ?>

	<?php if ( ! empty( $services ) ) : ?>
		<div class="wing-services__grid">
			<?php foreach ( $services as $service ) :
				$has_image       = ! empty( $service['imageUrl'] );
				$has_title       = ! empty( $service['title'] );
				$has_description = ! empty( $service['description'] );
				$has_link        = ! empty( $service['linkUrl'] );

				if ( ! $has_image && ! $has_title && ! $has_description ) {
					continue;
				}
				?>
				<article class="wing-services__card">
					<div class="wing-services__media">
						<?php if ( $has_image ) : ?>
							<img src="<?php echo esc_url( $service['imageUrl'] ); ?>" alt="<?php echo esc_attr( $service['imageAlt'] ?? '' ); ?>" loading="lazy" />
						<?php else : ?>
							<span class="wing-services__media-placeholder" aria-hidden="true"></span>
						<?php endif; ?>
					</div>

					<?php if ( $has_title ) : ?>
						<h3 class="wing-services__card-title"><?php echo wp_kses_post( $service['title'] ); ?></h3>
					<?php endif; ?>

					<?php if ( $has_description ) : ?>
						<p class="wing-services__card-description"><?php echo wp_kses_post( $service['description'] ); ?></p>
					<?php endif; ?>

					<?php if ( $has_link ) : ?>
						<a class="wing-services__card-link" href="<?php echo esc_url( $service['linkUrl'] ); ?>"<?php echo ! empty( $service['linkOpenInNewTab'] ) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
							<?php echo esc_html( ! empty( $service['linkLabel'] ) ? $service['linkLabel'] : __( 'Learn More', 'wing-services-list' ) ); ?>
						</a>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</section>