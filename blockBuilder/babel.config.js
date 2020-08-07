 module.exports = api => {
	const isTest = api.env( 'test' );
	const isDev = api.env( 'development' );

	if ( isDev ) {
		return {
			presets: [
				'@babel/preset-env',
				'@wordpress/default',
				'@babel/preset-react',
			],
			plugins: [
				[ 'styled-jsx/babel', { optimizeForSpeed: true } ],
				// "@babel/plugin-syntax-dynamic-import",
				// "@babel/plugin-proposal-class-properties",
				// "@babel/plugin-proposal-export-namespace-from",
				// "@babel/plugin-proposal-throw-expressions"
			],
		};
	}
	if ( isTest ) {
		return {
			presets: [
				[ '@babel/preset-env', {
					// debug: true,
					targets: {
						node: 'current',
					},
				} ],
				'@wordpress/default',
				'@babel/react',
			],
			plugins: [
				'@babel/plugin-transform-runtime',
			], // this is required for having async working in tests
		};
	}
};
