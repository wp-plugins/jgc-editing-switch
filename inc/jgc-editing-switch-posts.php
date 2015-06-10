<?php

// Crear metabox
add_action( 'add_meta_boxes', 'jgc_switch_posts_meta_box_init' );
function jgc_switch_posts_meta_box_init() {
    
    add_meta_box( 'jgc-switch-posts-meta-box', "JGC Editing Switch (" . __( 'Posts', 'jgcedsw-plugin' ) . ")", 'jgc_switch_posts_meta_box', 'post', 'side', 'high' );
    
}

function jgc_switch_posts_meta_box( $post, $box ) {
	global $post;
	
	$args = array(
			'post_type' => 'post',
			'post_status' => 'future, draft, pending, private',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
			);
			
	$entradas = new WP_Query ($args);
    
    ?>
	
	<select name="post_list" onchange='document.location.href=this.options[this.selectedIndex].value;'> 
		<option value=""><?php echo esc_attr( __( 'Select post to edit', 'jgcedsw-plugin' ) ); ?></option> 
		<?php
		
		while ($entradas->have_posts()):
			$entradas->the_post(); 
			$post_id = $post->ID;
			$post_status = $post->post_status;
			$post_title = $post->post_title;
			
			switch ($post_status){
				case 'future':
					$estado = __( 'Scheduled', 'jgcedsw-plugin' );
					break;
				case 'draft':
					$estado = __( 'Draft', 'jgcedsw-plugin' );
					break;
				case 'pending':
					$estado = __( 'Pending Review', 'jgcedsw-plugin' );
					break;
				case 'private':
					$estado = __( 'Private', 'jgcedsw-plugin' );
					break;
			}
			
			$titulo = ($post_title != '') ? $post_title : __( '(No title)', 'jgcedsw-plugin' );
			
		?>
			<option value="<?php echo admin_url().'post.php?post=' . $post_id . '&action=edit'; ?>"><?php echo esc_attr( $titulo ) . ' &nbsp;[' . $estado . ']'; ?></option>
			
		<?php
			
		endwhile;
		
		wp_reset_postdata;
		
		?>
		
	</select>
	
<?php
}
?>