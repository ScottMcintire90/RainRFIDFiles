<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7 ltie8 ltie9" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8 ltie9" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php
		global $theme_option, $gdlr_post_option;
		$body_wrapper = '';
		if(empty($theme_option['enable-responsive-mode']) || $theme_option['enable-responsive-mode'] == 'enable'){
			echo '<meta name="viewport" content="initial-scale=1.0" />';
		}else{
			$body_wrapper .= 'gdlr-no-responsive ';
		}
	?>
	
	<?php if( !function_exists( '_wp_render_title_tag' ) ){ ?>
		<title><?php wp_title(); ?></title>
	<?php } ?>
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php
		if( !empty($gdlr_post_option) ){ $gdlr_post_option = json_decode($gdlr_post_option, true); }

		wp_head();
	?>
</head>

<body <?php body_class(); ?>>
<?php

	if($theme_option['enable-boxed-style'] == 'boxed-style'){
		$body_wrapper  .= 'gdlr-boxed-style';
		if( !empty($theme_option['boxed-background-image']) && is_numeric($theme_option['boxed-background-image']) ){
			$alt_text = get_post_meta($theme_option['boxed-background-image'] , '_wp_attachment_image_alt', true);
			$image_src = wp_get_attachment_image_src($theme_option['boxed-background-image'], 'full');
			echo '<img class="gdlr-full-boxed-background" src="' . $image_src[0] . '" alt="' . $alt_text . '" />';
		}else if( !empty($theme_option['boxed-background-image']) ){
			echo '<img class="gdlr-full-boxed-background" src="' . $theme_option['boxed-background-image'] . '" />';
		}
	}

	$body_wrapper .= ($theme_option['enable-float-menu'] != 'disable')? ' float-menu': '';
?>
<div class="body-wrapper <?php echo esc_attr($body_wrapper); ?>" data-home="<?php echo home_url(); ?>" >
	<?php
		// page style
		if( empty($gdlr_post_option) || empty($gdlr_post_option['page-style']) ||
			  $gdlr_post_option['page-style'] == 'normal' ||
			  $gdlr_post_option['page-style'] == 'no-footer'){
	?>
	<header class="gdlr-header-wrapper">
		<!-- top navigation -->
		<?php if( empty($theme_option['enable-top-bar']) || $theme_option['enable-top-bar'] == 'enable' ){ ?>
		<div class="top-navigation-wrapper">
			<div class="top-navigation-container container">
				<div class="top-navigation-left">
					<div class="top-social-wrapper">
						<?php gdlr_print_header_social(); ?>
					</div>
				</div>
				<div class="top-navigation-right">
					<div class="top-navigation-right-text">
						<?php
							if( !empty($theme_option['top-bar-right-text']) )
								echo gdlr_text_filter($theme_option['top-bar-right-text']);
						?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php } ?>
		<!-- logo -->
		<div class="gdlr-header-inner">
		<div class="acceptto-logo">
			<p>Powered by </p>
			<a href="https://acceptto.com/"><img src="https://s3.postimg.io/ir61bzs0j/com_acceptto_mfa_150x150.png" id="acceptto-logo" style="width:100px"></a>
		</div>
			<div class="gdlr-header-container container">
			
				<!-- logo -->
				<div class="gdlr-logo">
					<a href="http://rainrfid.org/"><img src="http://rainrfid.org/wp-content/uploads/2015/06/Rain-logo-large-horiz.png"></a>
					<?php
						// mobile navigation
						if( class_exists('gdlr_dlmenu_walker') && has_nav_menu('main_menu') &&
							( empty($theme_option['enable-responsive-mode']) || $theme_option['enable-responsive-mode'] == 'enable' ) ){
							echo '<div class="gdlr-responsive-navigation dl-menuwrapper" id="gdlr-responsive-navigation" >';
							echo '<button class="dl-trigger">Open Menu</button>';
							wp_nav_menu( array(
								'theme_location'=>'main_menu',
								'container'=> '',
								'menu_class'=> 'dl-menu gdlr-main-mobile-menu',
								'walker'=> new gdlr_dlmenu_walker()
							) );
							echo '</div>';
						}
					?>
				</div>

				<!-- navigation -->
				<?php get_template_part( 'header', 'nav' ); ?>

				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</header>
	<div id="gdlr-header-substitute" ></div>
	<?php get_template_part( 'header', 'title' );

	} // page style ?>
	<div class="content-wrapper">