/* run it like so:
  npm  test  hero.test.js
 */
const fs = require('fs');
const {isPortrait,isLandscape,isSquare} = require("../imageCalc");

/* mock data (as it comes from MediaUpload component) */
const landscape = require("./__mockData__/media_landscape_2000.json");
const portrait = require("./__mockData__/media_portrait_1001.json");

// import React from 'react';
// import renderer from 'react-test-renderer';
// 

test( 'landscape is not portrait', ()=> {
	let v = isPortrait(landscape);
	expect(v).toBe(false);
} );

test( 'portrat is not landscape', ()=> {
	let v = isLandscape(portrait);
	expect(v).toBe(false);
} );

test( 'landscape is landscape', ()=> {
	let v = isLandscape(landscape);
	expect(v).toBe(true);
} );

test( 'both are not square', ()=> {
	let v = isSquare(landscape);
	expect(v).toBe(false);
	v = isSquare(portrait);
	expect(v).toBe(false);
} );
