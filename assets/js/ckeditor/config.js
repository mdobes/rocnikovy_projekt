/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
CKEDITOR.plugins.addExternal('base64image', '/assets/js/ckeditor/plugins/base64image/plugin.js');
CKEDITOR.plugins.addExternal('youtube', '/assets/js/ckeditor/plugins/youtube/plugin.js');



CKEDITOR.editorConfig = function( config ) {

	config.language = 'cs';

	config.extraPlugins = ['base64image', 'youtube'];

	config.htmlEncodeOutput = false;
	config.entities = false;
	config.toolbar = 'custom';
	config.toolbar_custom = [
		{ name: 'clipboard', items: [ '-', 'Undo', 'Redo' ] },
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
		{ name: 'insert', items: [ 'base64image', 'Table', 'HorizontalRule', 'SpecialChar', 'youtube' ] },
		{ name: 'tools', items: [ 'Maximize' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
		{ name: 'others', items: [ '-' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', groups: [ 'list', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Blockquote' ] },
		{ name: 'styles', items: [ 'Styles' ] },
	];

	config.removeButtons = 'Underline,Subscript,Superscript';

	config.format_tags = 'p;h1;h2;h3;pre';

	config.removeDialogTabs = 'image:advanced;link:advanced';
};
