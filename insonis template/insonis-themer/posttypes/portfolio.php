<?php
if(!function_exists('gavias_post_type_portfolio')){
	function gavias_post_type_portfolio(){
		$labels = array(
			'name'               => __( 'Portfolio', "insonis-themer" ),
			'singular_name'      => __( 'Portfolio', "insonis-themer" ),
			'add_new'            => __( 'Add New Portfolio', "insonis-themer" ),
			'add_new_item'       => __( 'Add New Portfolio', "insonis-themer" ),
			'edit_item'          => __( 'Edit Portfolio', "insonis-themer" ),
			'new_item'           => __( 'New Portfolio', "insonis-themer" ),
			'view_item'          => __( 'View Portfolio', "insonis-themer" ),
			'search_items'       => __( 'Search Portfolio', "insonis-themer" ),
			'not_found'          => __( 'No Portfolio found', "insonis-themer" ),
			'not_found_in_trash' => __( 'No Portfolio found in Trash', "insonis-themer" ),
			'parent_item_colon'  => __( 'Parent Portfolio:', "insonis-themer" ),
			'menu_name'          => __( 'Portfolios', "insonis-themer" ),
		);

		$args = array(
			'labels'              => $labels,
			'hierarchical'        => true,
			'description'         => 'List Portfolio',
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail','excerpt', 'post-formats'  ), 
			'taxonomies'          => array( 'portfolio_category','post_tag' ),
			'post-formats'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => array(
				'slug'  => 'case'
			),
			'capability_type'     => 'post'
		);

		$slug = apply_filters('gavias-post-type/slug-portfolio', '');
		if($slug){
		  $args['rewrite']['slug'] = $slug;
		}
		register_post_type( 'portfolio', $args );

		$labels = array(
		  'name'              => __( 'Categories', "insonis-themer" ),
		  'singular_name'     => __( 'Category', "insonis-themer" ),
		  'search_items'      => __( 'Search Category', "insonis-themer" ),
		  'all_items'         => __( 'All Categories', "insonis-themer" ),
		  'parent_item'       => __( 'Parent Category', "insonis-themer" ),
		  'parent_item_colon' => __( 'Parent Category:', "insonis-themer" ),
		  'edit_item'         => __( 'Edit Category', "insonis-themer" ),
		  'update_item'       => __( 'Update Category', "insonis-themer" ),
		  'add_new_item'      => __( 'Add New Category', "insonis-themer" ),
		  'new_item_name'     => __( 'New Category Name', "insonis-themer" ),
		  'menu_name'         => __( 'Categories', "insonis-themer" ),
		);
		// Now register the taxonomy
		register_taxonomy('category_portfolio',array('portfolio'),
			array(
			  	'hierarchical'      => true,
			  	'labels'            => $labels,
			  	'show_ui'           => true,
			  	'show_admin_column' => true,
			  	'query_var'         => true,
			  	'show_in_nav_menus' => false,
			  	'rewrite'           => array( 'slug' => 'category-portfolio'
			),
		));
  	}
  add_action( 'init','gavias_post_type_portfolio' );

  	add_action( 'init', 'gavias_portfolio_remove_post_type_support', 10 );
  	function gavias_portfolio_remove_post_type_support() {
	 	remove_post_type_support( 'portfolio', 'post-formats' );
  	}
}

function gaviasthemer_portfolio_query( $args ){
 	$ds = array(
		'post_type'   => 'portfolio',
		'posts_per_page'  =>  12
 	);
 	$args = array_merge( $ds , $args );
 	$loop = new WP_Query($args);
 	return $loop;
	}

function gaviasthemer_profolio_terms(){
 	return get_terms( 'category_portfolio', array('orderby'=>'id') );
}

