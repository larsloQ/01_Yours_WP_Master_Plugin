const webpack = require('webpack');
const path = require('path');
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );


module.exports = {
	mode: 'production',
		entry: {
		'editor.blocks.js': [
				'./blocks/liaison/teamtemplate.js',
			'./blocks/liaison/green-opener.js',
			'./blocks/liaison/mixin-post.js',
			'./blocks/liaison/mixin-post-kachel.js',
			'./blocks/liaison/mixin-post-kachel-3.js',
			'./blocks/liaison/liaison-columns.js',
			'./blocks/liaison/addFieldsToImageBlock.js',
	  ],
		'editor.blocks.css': 	'./blocks/liaison/editor.scss',
		// 'frontend.blocks.css': './blocks/hero/frontend.scss',
	},
	output: {
		path: path.resolve( __dirname, '../app/Blocks' ),
		// path: path.resolve( __dirname, 'assets' ),
		filename: 'js/[name]',
		// filename: 'js/editor.blocks.js',
	},
	// entry: ['./blocks/author-box/index.js', './blocks/author-box/editor.scss', './blocks/author-box/frontend.scss'],
	// output: {
	// 	path: path.resolve(__dirname, 'assets'),
	// },
	module: {
		rules: [
			/**
			 * Running Babel on JS files.
			 */
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['@wordpress/default']
					}
				}
			},
			{
				test: /\.scss$/,
				exclude: /node_modules/,
				use: [
					// MiniCssExtractPlugin.loader,
						 {
						loader: MiniCssExtractPlugin.loader,
							 options: {
							sourceMap: true,
						},
					},
					{
						loader: 'css-loader',
						options: {
							sourceMap: true,
						},
					},
					{
						loader: 'resolve-url-loader',
						options: {
							sourceMap: true,

							 },
					},
					{
						loader: 'postcss-loader',
						options: {
							sourceMap: true,
								 minimize: false,
						},
					},

					{
						loader: 'sass-loader',
						options: {
							sourceMap: true,
						},
					},

				],
			},
		],
	},
	plugins: [
		new MiniCssExtractPlugin( {
			 filename: './css/[name]',
		} ),
	],
};
