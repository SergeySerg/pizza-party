/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
CKEDITOR.config.autoParagraph = false;

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.filebrowserBrowseUrl = '/js/backend/kcfinder/browse.php?type=files&config=default';
    config.filebrowserImageBrowseUrl = '/js/backend/kcfinder/browse.php?type=images&config=default';
    config.filebrowserFlashBrowseUrl = '/js/backend/kcfinder/browse.php?type=flash&config=default';
    config.filebrowserUploadUrl = '/js/backend/kcfinder/upload.php?type=files&config=default';
    config.filebrowserImageUploadUrl = '/js/backend/kcfinder/upload.php?type=images&config=default';
    config.filebrowserFlashUploadUrl = '/js/backend/kcfinder/upload.php?type=flash&config=default';
};
