<?php 
/* setting costum color inside of editor
 more see 
 https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/
 */
add_action( 'after_setup_theme', 'setup_theme_supported_features' );
/**
 * Remove unused Gutenberg features.
 */
function setup_theme_supported_features() {
	add_theme_support( 'editor-color-palette',
		array (
			[
				'name' => 'Puerto Rico',
				'slug' => 'puerto-rico',
				'color' => '#53c4ab',
			],
			[
				'name' => 'Tundora',
				'slug' => 'tundora',
				'color' => '#454545',
			],
			[
				'name' => 'Butterfly Bush',
				'slug' => 'butterfly-bush',
				'color' => '#5151a0',
			],
			[
				'name' => 'White',
				'slug' => 'white',
				'color' => '#ffffff',
			]
		)
	);

	add_theme_support( 'disable-custom-colors' );
}
