<?php
/*
  add page custom field
/*-------------------------------------------*/

require_once( dirname( __FILE__ ) . '/class-veu-metabox.php' );

/**
 * Add Content meta box use for "Child Page List" , "Sitemap" , "Contact section" and more fields
 */
function veu_add_parent_metabox() {
	if ( apply_filters( 'veu_parent_metabox_activation', false ) ) {

		$meta_box_name = veu_get_name();

		/*
		Original Brand Unit で 名前を未入力にされた時にメタボックスが表示されなくなってしまうので、
		とりあえずスペースを代入
		 */
		if ( ! $meta_box_name ) {
			$meta_box_name = ' ';
		}

		$args       = array(
			'public' => true,
		);
		$post_types = get_post_types( $args );
		foreach ( $post_types as $key => $post_type ) {
			add_meta_box( 'veu_parent_post_metabox', $meta_box_name, 'veu_parent_metabox_body', $post_type, 'normal', 'high' );
		}
	}
	/*
	VEU_Metabox 内の get_post_type が実行タイミングによっては
	カスタム投稿タイプマネージャーで作成した投稿タイプが取得できないために
	admin_menu のタイミングで読み込んでいる
	 */
	require_once( dirname( __FILE__ ) . '/class-veu-metabox-insert-items.php' );
}
add_action( 'admin_menu', 'veu_add_parent_metabox' );

/**
 * Insert ExUnit Settings.
 */
function veu_parent_metabox_body() {
	echo '<div class="veu_metabox_nav">';
	echo '<p class="veu_metabox_all_section_toggle close">';
	echo '<button class="button button-default veu_metabox_all_section_toggle_btn_open">' . __( 'Open all', 'vk-all-in-one-expansion-unit' ) . ' <i class="fas fa-caret-down"></i></button> ';
	echo '<button class="button button-default veu_metabox_all_section_toggle_btn_close">' . __( 'Close all', 'vk-all-in-one-expansion-unit' ) . ' <i class="fas fa-caret-up"></i></button>';
	echo '</p>';
	echo '</div>';
	do_action( 'veu_post_metabox_body' );
	echo '<div class="veu_metabox_footer">';
	echo veu_get_systemlogo_html();
	echo '</div>';
}
