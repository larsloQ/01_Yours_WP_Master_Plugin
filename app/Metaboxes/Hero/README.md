# CMB2 Metabox first done for neuro_steiner

requires:
lazysizes js script
wordpress image sizes are hard coded

image size like "sky_600","sky_1000" are defined in theme (assets/functions/images...)

/*LFK 2018-12-25_17.09.35:
was looking for a way to extract the event when browser changes/reload/load a image (source in picture) based on media attr.
without success. It seems like browsers (chrome) does not expose this event to scripts

the following lazysizes events are NOT firing
  */ 
// import $ from 'jquery';
// /* adjust some */
// document.addEventListener( 'lazyloaded', function( e ) {
//  console.log( 'lazyloaded', e.target );
//  const el = e.target.parentNode;
//  // el.style = "";
//  el.classList.remove( 'unloaded' );
// } );

//add simple support for background images:
// document.addEventListener('lazybeforeunveil', function(e){
//     console.log('lazybeforeunveil',e)
//     var bg = e.target.getAttribute('data-bg');
//     if(bg){
//         e.target.style.backgroundImage = 'url(' + bg + ')';
//     }
// });

