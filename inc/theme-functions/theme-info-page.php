<?php
add_action( 'admin_menu', 'ocin_lite_getting_started_menu' );
function ocin_lite_getting_started_menu() {
	add_theme_page( esc_attr__( 'Theme Info', 'ocin-lite' ), esc_attr__( 'Theme Info', 'ocin-lite' ), 'manage_options', 'ocin_lite_theme-info', 'ocin_lite_getting_started_page' );
}

/**
 * Theme Info Page
 */
function ocin_lite_getting_started_page() {
	if ( ! current_user_can( 'manage_options' ) )  {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'ocin-lite' ) );
	}
	echo '<div class="getting-started">';
	?>
	<div class="getting-started-header">
		<div class="header-wrap">
			<div class="theme-image">
				<span class="top-browser"><i></i><i></i><i></i></span>
				<img src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" alt="">
			</div>
			<div class="theme-content">
				<div class="theme-content-wrap">
				<h4><?php esc_html_e( 'Getting Started', 'ocin-lite' ); ?></h4>
				<h2 class="theme-name"><?php echo esc_html( QL_THEME_NAME ); ?> <span class="ver"><?php echo 'v' . esc_html( QL_THEME_VERSION ); ?></span></h2>
				<p><?php echo sprintf( esc_html__( 'Thanks for using %s, we appriciate that you create with our products.', 'ocin-lite' ), esc_html( QL_THEME_NAME ) ); ?></p>
				<p><?php esc_html_e( 'Check the content below to get started with our theme.', 'ocin-lite' ); ?></p>
				</div>

				<ul class="getting-started-menu">
					<?php
					if ( isset ( $_GET['tab'] ) ){
						$tab = $_GET['tab'];
					}else{
						$tab = 'docs';
					}
					?>
					<li><a href="?page=ocin_lite_theme-info&amp;tab=docs" class="<?php echo ( $tab == 'docs' ) ? ' active' : ''; ?>"><i class="fa fa-file-text-o"></i> <?php esc_html_e( 'Documentation', 'ocin-lite' ); ?></a></li>
					<li><a href="https://www.quemalabs.com/theme/ocin/" target="_blank"><i class="fa fa-star-o"></i> <?php esc_html_e( 'PRO Version', 'ocin-lite' ); ?></a></li>
					<!--<li><a href="?page=ocin_lite_theme-info&amp;tab=more-themes" class="<?php echo ( $tab == 'more-themes' ) ? ' active' : ''; ?>"><i class="fa fa-wordpress"></i> <?php esc_html_e( 'More Themes', 'ocin-lite' ); ?></a></li>-->
					 
				</ul>

			</div><!-- .theme-content -->
		</div>
		<a href="https://www.quemalabs.com/" class="ql_logo" target="_blank"><img  src="<?php echo get_template_directory_uri() . '/images/quemalabs.png'; ?>" alt="Quema Labs" /></a>
	</div><!-- .getting-started-header -->

	<div class="getting-started-content">

	<?php
	global $pagenow;
	global $updater;
	
	if ( $pagenow == 'themes.php' && $_GET['page'] == 'ocin_lite_theme-info' ){
		if ( isset ( $_GET['tab'] ) ){
			$tab = $_GET['tab'];
		}else{
			$tab = 'docs';
		}

		switch ( $tab ){
			case 'docs' :
	?>

			<div class="theme-docuementation">
				<div class="help-msg-wrap">
					<div class="help-msg"><?php echo sprintf( esc_html__( 'You can find the ocin-lite documentation and more at our %sHelp Center%s.', 'ocin-lite' ), '<a href="https://www.quemalabs.com/help-center/" target="_blank">', '</a>' ); ?></div>
				</div>
				
			</div><!-- .theme-docuementation -->
			<?php
	      	break;
	      	case 'license' :

	      	
			$updater->license_page();
	      	
	        ?>

        <?php
        	break;
        	case 'more-themes' :

        	$url = wp_nonce_url( 'themes.php?page=ocin_lite_theme-info', 'more-themes' );
			if ( false === ( $creds = request_filesystem_credentials( $url, '', false, false, null ) ) ) {
				return; // stop processing here
			}
			if ( ! WP_Filesystem( $creds ) ) {
				request_filesystem_credentials( $url, '', true, false, null );
				return;
			}
			global $wp_filesystem;
			$json = $wp_filesystem->get_contents( 'https://www.quemalabs.com/wp-json/quemalabs/v1/themes/' );
			$themes = json_decode( $json );

        	echo '<div class="more-themes">';

				foreach ( $themes as $theme ) {
					if ( QL_THEME_SLUG == $theme->slug ) continue;
						
					?>
					<div class="ql-theme">
						<a href="<?php echo esc_url( $theme->url ); ?>" class="ql-theme-image" target="_blank"><img src="<?php echo $theme->image; ?>" alt="<?php echo esc_attr( $theme->slug ); ?>" /></a>
						<div class="ql-theme-info">
							<h4><a href="<?php echo esc_url( $theme->url ); ?>" target="_blank"><?php echo esc_html( $theme->name ); ?></a></h4>
							<p><?php if ( property_exists( $theme, 'sub_title' ) ) { echo esc_html( $theme->sub_title ); } ?></p>
							<?php
							if ( property_exists( $theme, 'type' ) ) {
								if( 'premium' == $theme->type ){
									$type = esc_html__( 'Premium', 'ocin-lite' );
								}else{
									$type = esc_html__( 'Free', 'ocin-lite' );
								}
							?>
							<a href="<?php echo esc_url( $theme->url ); ?>" class="ql-theme-button <?php echo esc_attr( $theme->type ); ?>" target="_blank"><?php echo $type; ?></a>
							<?php } ?>
						</div>
					</div>
					<?php
				}

        ?>

				
        	</div><!-- .more-themes -->

        <?php
        	break;
     	}//switch
         ?>


	<?php }//if theme.php ?>

	</div><!-- .getting-started-content -->


	<?php
	echo '</div><!-- .getting-started -->';
}
?>