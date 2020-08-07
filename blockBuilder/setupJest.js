/// jest.init.js

import Enzyme from 'enzyme';
import Adapter from 'enzyme-adapter-react-16';
// import 'regenerator-runtime/runtime' 


global.wp = {
	shortcode: {

	},
	apiRequest: {

	},
};

Object.defineProperty( global.wp, 'element', {
	get: () => require( 'React' ),
} );

/* having window object in tests*/
const open = jest.fn()
Object.defineProperty(window, 'open', open);
