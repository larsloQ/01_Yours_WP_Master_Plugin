!function(e){var t={};function a(n){if(t[n])return t[n].exports;var l=t[n]={i:n,l:!1,exports:{}};return e[n].call(l.exports,l,l.exports,a),l.l=!0,l.exports}a.m=e,a.c=t,a.d=function(e,t,n){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(a.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var l in e)a.d(n,l,function(t){return e[t]}.bind(null,l));return n},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="",a(a.s=3)}([function(e,t){e.exports=function(e){return e&&e.__esModule?e:{default:e}}},function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n=React.createElement("svg",{width:"20px",height:"20px",viewBox:"0 0 100 100",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"m40.621 52h25.891c0.96484 6.3594 6.4258 11.254 13.02 11.254 7.2695 0 13.188-5.9453 13.188-13.254s-5.918-13.254-13.188-13.254c-6.5938 0-12.055 4.8945-13.02 11.254h-25.961c-0.23047-1.6797-0.70312-3.3164-1.4141-4.8516l24.684-14.328c2.4805 3.1055 6.2695 4.9727 10.297 4.9727 2.3047 0 4.582-0.61328 6.5859-1.7773 6.2891-3.6523 8.4531-11.77 4.8242-18.098-2.3555-4.0977-6.7383-6.6367-11.441-6.6367-2.3047 0-4.582 0.61328-6.5859 1.7773-5.707 3.3125-8.0039 10.297-5.6719 16.285l-24.805 14.398c-1.2578-1.5781-2.8086-2.9609-4.6562-4.0312-2.5391-1.4766-5.4297-2.2578-8.3516-2.2578-5.9648 0-11.523 3.2227-14.5 8.4102-4.6055 8.0234-1.8633 18.32 6.1172 22.953 2.543 1.4766 5.4297 2.2578 8.3516 2.2578 5.2578 0 10.195-2.5078 13.336-6.6523l24.508 14.23c-2.3281 5.9922-0.035156 12.973 5.6719 16.285 2.0039 1.1641 4.2812 1.7773 6.5859 1.7773 4.7031 0 9.0859-2.543 11.438-6.6328 3.6328-6.3242 1.4688-14.441-4.8242-18.098-2.0039-1.1641-4.2812-1.7773-6.5859-1.7773-4.0273 0-7.8164 1.8672-10.297 4.9727l-24.488-14.211c0.69922-1.6133 1.1211-3.2852 1.293-4.9688zm38.91-11.254c5.0664 0 9.1875 4.1523 9.1875 9.2539s-4.1211 9.2539-9.1875 9.2539-9.1875-4.1523-9.1875-9.2539 4.1211-9.2539 9.1875-9.2539zm-10.023-28.227c1.3945-0.80859 2.9805-1.2383 4.5781-1.2383 3.2773 0 6.3281 1.7734 7.9688 4.625 2.5352 4.4219 1.0273 10.094-3.3633 12.645-1.3945 0.80859-2.9805 1.2383-4.5781 1.2383-3.2773 0-6.3281-1.7734-7.9688-4.625-2.5391-4.4219-1.0312-10.094 3.3633-12.645zm-34.488 44.156c-2.2695 3.9492-6.4961 6.4023-11.031 6.4023-2.2148 0-4.4102-0.59375-6.3438-1.7148-6.082-3.5312-8.168-11.383-4.6562-17.504 2.2695-3.9492 6.4961-6.4023 11.031-6.4023 2.2148 0 4.4102 0.59375 6.3438 1.7148 6.0781 3.5312 8.168 11.383 4.6562 17.504zm39.09 13.535c1.6016 0 3.1836 0.42969 4.5781 1.2383 4.3945 2.5508 5.8984 8.2227 3.3633 12.645-1.6367 2.8516-4.6914 4.625-7.9688 4.625-1.6016 0-3.1836-0.42969-4.5781-1.2383-4.3945-2.5508-5.9023-8.2227-3.3633-12.645 1.6406-2.8516 4.6953-4.625 7.9688-4.625z"}));t.default=n},function(e,t){e.exports=function(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}},function(e,t,a){a(4),a(5),a(7),a(8),a(9),a(10),e.exports=a(11)},function(e,t,a){"use strict";var n=wp.element.createElement,l=wp.i18n.__,r=wp.blocks.registerBlockType,o=wp.editor.InnerBlocks,c=wp.editor.InspectorControls,i=wp.components,s=i.TextControl,d=i.PanelBody,u=wp.editor.PostFeaturedImage,m=(0,wp.data.withSelect)(function(e){return{title:e("core/editor").getEditedPostAttribute("title")}})(function(e){return React.createElement("div",null,e.title)});r("liaison/teamtemplate",{title:"Liaison Columns (like on Team)",description:l("Choose 2 POSTs or Pages on the right. When POST is not in List (only first 40 Posts are shown) change the Date of post to newer, than it will appear.","yours"),category:"liaison",attributes:{institution:{type:"string",source:"meta",meta:"team_member_institution"},imgdesc:{type:"string"}},edit:function(e){var t=wp.data.select("core/editor").getCurrentPost().title,a=e.attributes,n=a.institution,r=a.imgdesc,i=(e.className,e.setAttributes);return i({title:t}),[React.createElement(c,null,React.createElement(d,null,React.createElement(s,{label:l("Institution / extra Headline","yours"),value:n,onChange:function(e){i({institution:e})}}))),React.createElement("div",{className:"wp-fakeblock wide"},React.createElement("div",{className:"half"},n&&React.createElement("h2",{class:"serif"},n),!n&&React.createElement("p",null,"klick to set insitution in sidebar on the right"),React.createElement("h1",{className:""},React.createElement(m,null)),React.createElement(o,{allowedBlocks:["core/paragraph"]})),React.createElement("div",{className:"half"},React.createElement(u,null),React.createElement(s,{label:"Add a image description",value:r,onChange:function(e){i({imgdesc:e})}})))]},save:function(e){return n(o.Content,{})}})},function(e,t,a){"use strict";var n=a(0)(a(6)),l=(wp.data.withSelect,wp.element.createElement,wp.i18n.__),r=wp.blocks.registerBlockType,o=wp.editor,c=o.InnerBlocks,i=o.MediaUpload,s=wp.components.Button,d=[["core/heading",{level:1,className:"white",content:"Set Headline"}],["core/paragraph",{className:"white",content:"Write entry text"}]];r("liaison/green-opener",{title:"Green Opener",description:"Pick image on the left side. Only the round icons are supposed to be used. Display on page differs from display here. Please keep opening text (paragraph) short and use only 1 Headline (H1)",category:"liaison",icon:"smiley",keywords:[l("Liaison","yours")],attributes:{imageID:{type:"number"},imageAlt:{attribute:"alt",selector:".card__image"},imageURL:{attribute:"src",selector:".card__image"}},edit:function(e){var t=e.attributes,a=t.imageID,l=(t.imageURL,t.imageAlt,e.className,e.setAttributes),r=e.isSelected;return[React.createElement("div",{className:"grid-container"},React.createElement("div",{className:"grid-x grid-padding-x opener_a"},React.createElement("div",{className:"cell small-12 medium-4 "},React.createElement(i,{onSelect:function(e){l({imageID:e.id,imageURL:e.url,imageAlt:e.alt})},type:"image",value:a,render:function(t){var a,n=t.open;return a=n,e.attributes.imageURL?React.createElement("img",{src:e.attributes.imageURL,onClick:a,className:"image"}):React.createElement("div",{className:"button-container"},React.createElement(s,{onClick:a,className:"button button-large"},"Pick an image"))}}),r?React.createElement(s,{className:"remove-image",onClick:function(){l({imageID:null,imageURL:null,imageAlt:null})}},n.default.remove):null),React.createElement("div",{className:"cell small-12 medium-8 text"},React.createElement(c,{template:d,allowedBlocks:["core/paragraph","core/heading"]}))))]},save:function(e){var t,a,n=e.attributes,l=n.imageURL,r=n.imageAlt;n.imageID;return React.createElement("div",{className:"grid-container"},React.createElement("div",{className:"grid-x grid-padding-x opener_a"},React.createElement("div",{className:"cell small-12 medium-5 "},(a=r,(t=l)?a?React.createElement("img",{className:"card__image lazyload",src:t,alt:a}):React.createElement("img",{className:"card__image lazyload",src:t,alt:"","aria-hidden":"true"}):null)),React.createElement("div",{className:"cell small-12 medium-7 text"},React.createElement(c.Content,null))))}})},function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var n={};n.upload=React.createElement("svg",{width:"20px",height:"20px",viewBox:"0 0 100 100",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"m77.945 91.453h-72.371c-3.3711 0-5.5742-2.3633-5.5742-5.2422v-55.719c0-3.457 2.1172-6.0703 5.5742-6.0703h44.453v11.051l-38.98-0.003906v45.008h60.977v-17.133l11.988-0.007812v22.875c0 2.8789-2.7812 5.2422-6.0664 5.2422z"}),React.createElement("path",{d:"m16.543 75.48l23.25-22.324 10.441 9.7773 11.234-14.766 5.5039 10.539 0.039063 16.773z"}),React.createElement("path",{d:"m28.047 52.992c-3.168 0-5.7422-2.5742-5.7422-5.7461 0-3.1758 2.5742-5.75 5.7422-5.75 3.1797 0 5.7539 2.5742 5.7539 5.75 0 3.1719-2.5742 5.7461-5.7539 5.7461z"}),React.createElement("path",{d:"m84.043 30.492v22.02h-12.059l-0.015625-22.02h-15.852l21.941-21.945 21.941 21.945z"})),n.swap=React.createElement("svg",{width:"20px",height:"20px",viewBox:"0 0 100 100",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"m39.66 76.422h36.762v-36.781h-36.762zm4.6211-32.141h27.5v27.5h-27.5z"}),React.createElement("path",{d:"m36.801 55.719h-8.582v-27.5h27.5v9.2031h4.6406v-13.844h-36.781v36.762h13.223z"}),React.createElement("path",{d:"m90.18 42.781c-3-16.801-16.02-29.922-33-32.961-2.3789-0.42187-4.7812-0.64062-7.1797-0.64062v4.6211c2.1211 0 4.2617 0.17969 6.3594 0.55859 14.781 2.6406 26.18 13.898 29.121 28.398l-5.6602 0.003907 8.0781 14 8.0781-14h-5.7969z"}),React.createElement("path",{d:"m14.52 57.219h5.6602l-8.0781-13.98-8.0781 14h5.8008c3 16.801 16.039 29.941 33 32.961 2.375 0.40234 4.7773 0.64062 7.1758 0.64062v-4.6406c-2.1016 0-4.2617-0.19922-6.3594-0.57812-14.781-2.6406-26.18-13.883-29.121-28.402z"})),n.remove=React.createElement("svg",{width:"20px",height:"20px",viewBox:"0 0 100 100",xmlns:"http://www.w3.org/2000/svg"},React.createElement("path",{d:"m50 2.5c-26.199 0-47.5 21.301-47.5 47.5s21.301 47.5 47.5 47.5 47.5-21.301 47.5-47.5-21.301-47.5-47.5-47.5zm24.898 62.301l-10.199 10.199-14.801-14.801-14.801 14.801-10.199-10.199 14.801-14.801-14.801-14.801 10.199-10.199 14.801 14.801 14.801-14.801 10.199 10.199-14.801 14.801z"}));var l=n;t.default=l},function(e,t,a){"use strict";a(0)(a(1));var n=wp.element.createElement,l=wp.i18n.__,r=wp.blocks.registerBlockType,o=wp.components.Spinner,c=wp.data.withSelect,i=wp.editor,s=i.InspectorControls,d=i.InnerBlocks,u=wp.components,m=u.TextControl,p=u.PanelBody,g=u.SelectControl,h=u.ToggleControl;r("liaison/mixin",{title:l("Mixin-Blogpost","yours"),description:l("Choose a POST on the right. When POST is not in List (only first 40 Posts are shown) change the Date of post to newer, than it will appear.","yours"),icon:"smiley",category:"liaison",attributes:{selectedPostId:{type:"string"},extra_line:{type:"string"},flipped:{type:"boolean"}},edit:c(function(e){return{posts:e("core").getEntityRecords("postType","post",{per_page:39,orderby:"date",order:"desc",status:"publish",_embed:!1})}})(function(e){var t=e.attributes,a=t.selectedPostId,n=t.extra_line,r=t.flipped,c=e.posts,i=e.className,u=e.setAttributes,f=(e.isSelected,[]),v=r?"flipped":"";return c?(f.push({value:0,label:"Select something"}),c.forEach(function(e){f.push({value:e.id,label:e.title.rendered})})):f.push({value:0,label:"Loading..."}),c?[React.createElement(s,null,React.createElement(p,null,React.createElement(g,{label:"Select a post",options:f,value:a,onChange:function(e){u({selectedPostId:e})}})),React.createElement(h,{label:l("Flip Sides"),checked:r,onChange:function(e){u({flipped:e})}})),React.createElement("div",null,a&&c.map(function(e){if(e.id==a)return React.createElement("div",{className:"grid-container wide  ".concat(v)},React.createElement("div",{className:"grid-x  grid-padding-x "},React.createElement("div",{className:"cell medium-6 small-12 half"},React.createElement(m,{label:"Add a extra line / can be empty",value:n,onChange:function(e){u({extra_line:e})}}),React.createElement("h2",null,e.title.rendered),React.createElement(d,{allowedBlocks:["core/paragraph"]})),React.createElement("div",{className:"cell medium-6 small-12 half"},0!=e.featured_media&&React.createElement("img",{src:e._embedded["wp:featuredmedia"][0].source_url,alt:e._embedded["wp:featuredmedia"][0].alt_text}),0==e.featured_media&&React.createElement("p",null,l("The post you selected does not contain a 'featured image'. If you want an image here set featured image in the selected Post.","yours")))))}),!a&&React.createElement("p",null,l("No Post selected. Please select one in sidebar.","yours")))]:React.createElement("p",{className:i},React.createElement(o,null),l("Loading Posts","yours"))}),save:function(e){return n(d.Content,{})}})},function(e,t,a){"use strict";a(0)(a(1)),wp.element.createElement;var n=wp.i18n.__,l=wp.blocks.registerBlockType,r=wp.components,o=r.Spinner,c=(r.TextareaControl,wp.data.withSelect),i=wp.editor.InspectorControls,s=wp.components,d=s.TextControl,u=s.PanelBody,m=s.SelectControl,p=s.ToggleControl,g=function(e){var t=e.post;return React.createElement(React.Fragment,null,0!=t.featured_media&&React.createElement("img",{src:t._embedded["wp:featuredmedia"][0].source_url,alt:t._embedded["wp:featuredmedia"][0].alt_text}),0==t.featured_media&&React.createElement("p",null,React.createElement("i",null,n("The post you selected does not contain a 'featured image'. If you want an image here set featured image in the selected Post.","yours"))),React.createElement("h2",{className:"serif"},t.title.rendered),React.createElement(d,{label:"Add a extra line / can be empty",value:e.value,onChange:function(t){e.onChange(t)}}))};l("liaison/mixin-kachel",{title:n("Mixin-2 Blogposts as Tiles ","yours"),description:n("Choose 2 POSTs or Pages on the right. When POST is not in List (only first 40 Posts are shown) change the Date of post to newer, than it will appear.","yours"),icon:"smiley",category:"liaison",attributes:{selectedPostId_1:{type:"string"},selectedPostId_2:{type:"string"},extra_line_1:{type:"string"},extra_line_2:{type:"string"},flipped:{type:"boolean"},content_1:{type:"string"},content_2:{type:"string"}},edit:c(function(e){var t=e("core").getEntityRecords,a={per_page:39,orderby:"date",order:"desc",status:"publish",_embed:!1};return{posts:t("postType","post",a),pages:t("postType","page",a)}})(function(e){var t=e.attributes,a=(t.content_1,t.content_2,t.selectedPostId_1),l=t.selectedPostId_2,r=t.extra_line_1,c=t.extra_line_2,s=t.flipped,d=e.posts,h=e.pages,f=e.className,v=e.setAttributes,E=[],R=[];d&&d.length&&(R=R.concat(d)),h&&h.length&&(R=R.concat(h));var y=s?"flipped":"";return R&&R.length?(E.push({value:0,label:"Select something"}),R.forEach(function(e){E.push({value:e.id,label:e.title.rendered})})):E.push({value:0,label:"Loading..."}),d?[React.createElement(i,null,React.createElement(u,null,React.createElement(m,{label:"Select first post (only 20 of the last posts/pages shown)",options:E,value:a,onChange:function(e){v({selectedPostId_1:e})}}),React.createElement(m,{label:"Select second post",options:E,value:l,onChange:function(e){v({selectedPostId_2:e})}})),React.createElement(p,{label:n("Flip Sides"),checked:s,onChange:function(e){v({flipped:e})}})),React.createElement("div",null,React.createElement("div",{className:"grid-container wide  ".concat(y)},React.createElement("div",{className:"grid-x  grid-padding-x "},a&&l&&R.map(function(e){return e.id==a?React.createElement("div",{className:"cell medium-6 small-12 half"},React.createElement(g,{post:e,value:r||"",onChange:function(e){v({extra_line_1:e}),console.log(index,e)}})):e.id==l?React.createElement("div",{className:"cell medium-6 small-12 half"},React.createElement(g,{post:e,value:c||"",onChange:function(e){v({extra_line_2:e})}})):void 0}))),(!a||!l)&&React.createElement("p",null,n("Please selected 2 Posts on the right in sidebar.","yours")))]:React.createElement("p",{className:f},React.createElement(o,null),n("Loading Posts","yours"))}),save:function(e){}})},function(e,t,a){"use strict";var n,l=a(0),r=l(a(2)),o=(l(a(1)),wp.element.createElement,wp.i18n.__),c=wp.blocks.registerBlockType,i=wp.components,s=i.Spinner,d=(i.TextareaControl,wp.data.withSelect),u=wp.editor.InspectorControls,m=wp.components,p=m.TextControl,g=m.PanelBody,h=m.SelectControl,f=(m.ToggleControl,function(e){var t=e.post;return React.createElement(React.Fragment,null,React.createElement("h2",null,t.title.rendered),0!=t.featured_media&&React.createElement("img",{src:t._embedded["wp:featuredmedia"][0].source_url,alt:t._embedded["wp:featuredmedia"][0].alt_text}),0==t.featured_media&&React.createElement("p",null,o("The post you selected does not contain a 'featured image'. If you want an image here set featured image in the selected Post.","yours")),React.createElement(p,{label:"Add a extra line",value:e.value,onChange:function(t){e.onChange(t)}}))});c("liaison/mixin-kachel-3",(n={title:o("Mixin-3 Pages as Tiles ","yours"),description:o("coming soon","yours")},(0,r.default)(n,"description",o("Choose 3 POSTs or Pages on the right. When POST is not in List (only first 40 Posts are shown) change the Date of post to newer, than it will appear.","yours")),(0,r.default)(n,"icon","smiley"),(0,r.default)(n,"category","liaison"),(0,r.default)(n,"icon","smiley"),(0,r.default)(n,"category","liaison"),(0,r.default)(n,"attributes",{selectedPostId_1:{type:"string"},selectedPostId_2:{type:"string"},selectedPostId_3:{type:"string"},extra_line_1:{type:"string"},extra_line_2:{type:"string"},extra_line_3:{type:"string"}}),(0,r.default)(n,"edit",d(function(e){var t=e("core").getEntityRecords,a={per_page:39,orderby:"date",order:"desc",status:"publish",_embed:!1};return{posts:t("postType","post",a),pages:t("postType","page",a)}})(function(e){var t=e.attributes,a=t.selectedPostId_1,n=t.selectedPostId_2,l=t.selectedPostId_3,r=t.extra_line_1,c=t.extra_line_2,i=t.extra_line_3,d=e.posts,m=e.pages,p=e.className,v=e.setAttributes,E=(e.isSelected,[]),R=[];return d&&d.length&&(R=R.concat(d)),m&&m.length&&(R=R.concat(m)),R&&R.length?(E.push({value:0,label:"Select something"}),R.forEach(function(e){E.push({value:e.id,label:e.title.rendered})})):E.push({value:0,label:"Loading..."}),d?[React.createElement(u,null,React.createElement(g,null,React.createElement(h,{label:"Select first page",options:E,value:a,onChange:function(e){v({selectedPostId_1:e})}}),React.createElement(h,{label:"Select second post",options:E,value:n,onChange:function(e){v({selectedPostId_2:e})}}),React.createElement(h,{label:"Select third post",options:E,value:l,onChange:function(e){v({selectedPostId_3:e})}}))),React.createElement("div",null,React.createElement("div",{className:"grid-container wide"},React.createElement("div",{className:"grid-x  grid-padding-x "},a&&n&&l&&R.map(function(e){return e.id==a?React.createElement("div",{className:"cell medium-4 small-12 half"},React.createElement(f,{post:e,value:r||"",onChange:function(e){v({extra_line_1:e}),console.log(index,e)}}),React.createElement("br",null)):e.id==n?React.createElement("div",{className:"cell medium-4 small-12 half"},React.createElement(f,{post:e,value:c||"",onChange:function(e){v({extra_line_2:e})}}),React.createElement("br",null)):e.id==l?React.createElement("div",{className:"cell medium-4 small-12 half"},React.createElement(f,{post:e,value:i||"",onChange:function(e){v({extra_line_3:e})}}),React.createElement("br",null)):void 0}))),(!a||!n||!l)&&React.createElement("p",null,o("Please selected 3 Pages on the right in sidebar.","yours")))]:React.createElement("p",{className:p},React.createElement(s,null),o("Loading Posts","yours"))})),(0,r.default)(n,"save",function(e){}),n))},function(e,t,a){"use strict";var n=wp.element.createElement,l=wp.blocks.registerBlockType,r=wp.editor.InnerBlocks,o=[["core/columns",{align:"wide",className:"liasion-columns",description:"Please do not change Number of Columns. If you don't want to add a Link, remove the Button-Element"},[["core/column",{},[["core/image"]]],["core/column",{},[["core/heading",{level:"3",className:"serif",placeholder:"Set Sup-Headline"}],["core/heading",{level:"2",className:"white",placeholder:"Set Headline"}],["core/paragraph",{className:"white",placeholder:"Write entry text"}],["core/button",{className:"link",content:"Read More",description:"Read More will not be displayed as long as you do not set URL/LINK. "}]]]]]];l("liaison/columns",{title:"2 Columns Template (LIAISON)",description:"Please do not change Number of Columns. If you don't want to add a Link, remove the Button-Element",category:"liaison",className:"liasion-columns",edit:function(e){return n(r,{template:o,templateLock:"all"})},save:function(e){return n(r.Content,{})}})},function(e,t,a){"use strict";var n=a(0)(a(12)),l=wp.hooks.addFilter,r=wp.compose.createHigherOrderComponent,o=wp.element.Fragment,c=wp.editor.InspectorControls,i=wp.components,s=i.PanelBody,d=i.TextControl;l("blocks.registerBlockType","yours/add-to-image/extra-attribute",function(e){var t=(0,n.default)({},e.attributes);return"core/image"===e.name&&(t.hover_text={type:"string",default:""},t.hover_link={type:"string",default:""}),(0,n.default)({},e,{attributes:t})}),l("editor.BlockEdit","yours/add-to-image/extra-attribute",r(function(e){return function(t){var a=t.attributes,n=t.setAttributes;return React.createElement(o,null,React.createElement(e,t),React.createElement(c,null,"core/image"===t.name&&React.createElement(s,{title:"Add image hover link",initialOpen:!1},React.createElement("label",null,'"Text over"'),React.createElement(d,{value:a.hover_text,onChange:function(e){n({hover_text:e})}}),React.createElement("label",null,'"Link (with url)"'),React.createElement(d,{value:a.hover_link,onChange:function(e){n({hover_link:e})}}))))}},"withInspectorControl"));l("blocks.getSaveContent.extraProps","yours/add-to-image/extra-attribute",function(e,t,a){return"core/image"==t.name&&lodash.assign(e,{"data-hovertext":a.hover_text,"data-hoverlink":a.hover_link}),e})},function(e,t,a){var n=a(2);e.exports=function(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{},l=Object.keys(a);"function"==typeof Object.getOwnPropertySymbols&&(l=l.concat(Object.getOwnPropertySymbols(a).filter(function(e){return Object.getOwnPropertyDescriptor(a,e).enumerable}))),l.forEach(function(t){n(e,t,a[t])})}return e}}]);