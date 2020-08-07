// import { registerStore, withSelect } from '@wordpress/data';

// import { name, settings } from '../';
// import { blockEditRender } from '../../../packages/block-library/src/test/helpers';
import React from 'react';
import renderer from 'react-test-renderer';

import Link from './Link.react';


	async function a() {
	  console.log("a");
	}
	a();


// import { render } from 'enzyme';
// import { noop } from 'lodash';
// describe( 'async', ()=> {
// 	it( 'Works', ()=> {
// 	async function a() {
// 	  console.log("a");
// 	}
// 	a();

// 		expect( 1 ).toBe( 1 );
// 	} );

	
// } );


// import apiFetch from '@wordpress/api-fetch';

// //     console.log( apiFetch );
// apiFetch( { path: '/wp/v2/posts' } ).then( posts => {
//     console.log( posts );
// } );


// import "@babel/polyfill";

// global.wp = {
//   shortcode: {

//   },
//   apiRequest: {

//   },
// };

// Object.defineProperty( global.wp, 'element', {
//   get: () => require( 'React' ),
// } );


// console.log(global.wp, wp);
// import {getAllBlocks} from "@wordpress/e2e-test-utils";

// console.log(getAllBlocks());

// const {
//   InspectorControls,
//   MediaUpload,
//   RichText,
// } = wp.editor;

describe( 'WHT', ()=> {
	it( 'Works', ()=> {
		const roy = true;
		expect( roy ).toBe( roy );
	} );

	it( 'Can snapshot', ()=> {
		const mike = {
			roy: true,
		};
		expect( JSON.stringify( mike ) ).toMatchSnapshot();
	} );
} );

test( 'Link changes the class when hovered', () => {
	const component = renderer.create(
		<Link page="http://www.facebook.com">Facebook</Link>,
	);
	let tree = component.toJSON();
	expect( tree ).toMatchSnapshot();

	// manually trigger the callback
	tree.props.onMouseEnter();
	// re-rendering
	tree = component.toJSON();
	expect( tree ).toMatchSnapshot();

	// manually trigger the callback
	tree.props.onMouseLeave();
	// re-rendering
	tree = component.toJSON();
	expect( tree ).toMatchSnapshot();
} );

const sum = ( a, b ) => a + b;
const mul = ( a, b ) => a * b;
const sub = ( a, b ) => a - b;
const div = ( a, b ) => a / b;

console.log( sum );

test( 'Adding 1 + 1 equals 2', () => {
	expect( sum( 1, 1 ) ).toBe( 2 );
} );
test( 'Multiplying 1 * 1 equals 1', () => {
	expect( mul( 1, 1 ) ).toBe( 1 );
} );
test( 'Subtracting 1 - 1 equals 0', () => {
	expect( sub( 1, 1 ) ).toBe( 0 );
} );
test( 'Dividing 1 / 1 equals 1', () => {
	expect( div( 1, 1 ) ).toBe( 1 );
} );

