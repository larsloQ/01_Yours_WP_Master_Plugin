// populatequickedit-num_in_map.js
// watch out, there is a "edit_row" and a "Post_row" (29,30)
 
var yours_admin_colums = yours_admin_colums ? yours_admin_colums : {};
yours_admin_colums.casestudy_number = "casestudy_number";

jQuery(function($){
 
	// it is a copy of the inline edit function
	var wp_inline_edit_function = inlineEditPost.edit;
 
	// we overwrite the it with our own
	inlineEditPost.edit = function( post_id ) {
 
		// let's merge arguments of the original function
		wp_inline_edit_function.apply( this, arguments );
 
		// get the post ID from the argument
		var id = 0;
		if ( typeof( post_id ) == 'object' ) { // if it is object, get the ID number
			id = parseInt( this.getId( post_id ) );
		}
 
		//if post id exists
		if ( id > 0 ) {
 
			// add rows to variables
			var specific_post_edit_row = $( '#edit-' + id ),
			    specific_post_row = $( '#post-' + id ),
			    aval = $( "."+yours_admin_colums.casestudy_number, specific_post_row ).text(); //  remove $ sign
				// populate the inputs with column data
				$( ':input[name="'+yours_admin_colums.casestudy_number+'"]', specific_post_edit_row ).val( aval );
		
		}
	}
});