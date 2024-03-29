/**
* Primary Nested Pages Initialization
* @package Nested Pages
* @author Kyle Phillips - https://github.com/kylephillips/wp-nested-pages
*/

jQuery(document).ready(function(){
	new NestedPages.Factory;
});

var NestedPages = NestedPages || {};


// DOM Selectors
NestedPages.selectors = {
	childToggle : '.child-toggle', // Child Toggle Buttons
	childToggleLink : '.child-toggle a', // Actual link in button
	toggleAll : '.nestedpages-toggleall', // Toggle All Button
	toggleHidden : '.np-toggle-hidden', // Toggle Hidden Pages
	toggleStatus : '.np-toggle-publish', // Toggle Published Pages
	lists : '.nplist', // OL elements
	rows : '.page-row', // Page Row,
	row : '.row', // Inner row div element
	sortable : '.sortable', // Sortable List
	notSortable : '.no-sort', // Unsortable List
	handle : '.handle', // Sortable Handle
	published : '.published', // Published Rows
	hiddenRows : '.np-hide', // Hidden Rows
	errorDiv : '#np-error', // Error Alert
	loadingIndicator : '#nested-loading', // Loading Indicator,
	syncCheckbox : '.np-sync-menu', // Sync menu checkbox

	// Responsive Toggle
	toggleEditButtons : '.np-toggle-edit', // Button that toggles responsive buttons

	// Quick Edit
	quickEditOverlay : '.np-inline-overlay', // The inline modal
	quickEditLoadingIndicator : '.np-qe-loading', // Loading indicator in Quick Edit
	quickEditErrorDiv : '.np-quickedit-error', // Error Div in Quick Edit
	quickEditCancel : '.np-cancel-quickedit', // Cancel button in quick edit
	quickEditToggleTaxonomies : '.np-toggle-taxonomies', // Toggle Taxonomies in Quick Edit
	quickEditToggleMenuOptions : '.np-toggle-menuoptions', // Toggle Menu Options in Quick Edit

	// Quick Edit - Links
	quickEditButtonLink : '.np-quick-edit-redirect', // Button to open link quick edit
	quickEditLinkForm : '.quick-edit-form-redirect', // Form for link quick edits
	quickEditLinkSaveButton : '.np-save-quickedit-redirect', // Save button in link quick edit form

	// Quick Edit - Posts
	quickEditOpen : '.np-quick-edit', // Button to open post quick edit
	quickEditPostForm : '.quick-edit-form', // Form container
	quickEditSaveButton : '.np-save-quickedit', // Save button in quick edit (posts)

	// Link Items
	openLinkModal : '.open-redirect-modal', // Opens new link modal
	linkModal : '#np-link-modal', // The add a link modal
	saveLink : '.np-save-link', // Save Link Button
	linkLoadingIndicator : '.np-link-loading', // Loading Indicator in Link Modal
	linkErrorDiv : '.np-new-link-error', // Error Div in Link Modal
	linkForm : '.np-new-link-form', // The form element for a new link

	// New Page Items
	openPageModal : '.open-bulk-modal', // Opens the new page(s) modal
	newPageModal : '#np-bulk-modal', // The modal with the new page form
	newPageFormContainer : '.new-child-form', // The new page form container
	newPageForm : '.np-new-child-form', // The form element
	newPageSubmitButton : '.np-save-newchild', // Submit button in new page form
	newPageTitle : '.add-new-child-row', // Button to add a new page title field to the form
	newPageRemoveTitle : '.np-remove-child', // Button to remove a title field in the form
	addChildButton : '.add-new-child', // Button to add child page(s)
	newChildError : '.np-newchild-error', // Error div in new child quick edit
	cancelNewChildButton : '.np-cancel-newchild', // Cancel button in new child quick edit

	// Clone
	cloneButton : '.clone-post', // Button to clone a post
	confirmClone : '[data-confirm-clone]', // Button in modal to confirm clone
	cloneModal : '#np-clone-modal', // Modal with clone options
	cloneQuantity : '[data-clone-quantity]', // Quantity to Clone
	cloneStatus : '[data-clone-status]', // Clone Status
	cloneAuthor : '[data-clone-author]', // Clone Author
}


// CSS Classes
NestedPages.cssClasses = {
	iconToggleDown : 'np-icon-arrow-down',
	iconToggleRight : 'np-icon-arrow-right',
	noborder : 'no-border'
}


// JS Data
NestedPages.jsData = {
	ajaxurl : ajaxurl,
	nonce : nestedpages.np_nonce,
	allPostTypes : nestedpages.post_types, // Localized data with all post types
	posttype : '', // current Screen's post type
	nestable : true, // boolean - whether post type is nestable
	hierarchical : true, // boolean - whether post type is hierarchical
	expandText : nestedpages.expand_text, // Expand all button text
	collapseText : nestedpages.collapse_text, // Collapse all button text
	showHiddenText : nestedpages.show_hidden, // Show Hidden Pages Link Text
	hideHiddenText : nestedpages.hide_hidden, // Hide Hidden Pages Link Text
	quickEditText : nestedpages.quick_edit, // Quick Edit Button Text
	hiddenText : nestedpages.hidden, // Localized "Hidden"
	titleText : nestedpages.title, // Localized "Title"
}


// Form Actions
NestedPages.formActions = {
	syncToggles : 'npnestToggle',
	syncNesting : 'npsort',
	syncMenu : 'npsyncMenu',
	newLink : 'npnewLink',
	newPage : 'npnewChild',
	quickEditLink : 'npquickEditLink',
	getTaxonomies : 'npgetTaxonomies',
	quickEditPost : 'npquickEdit',
	clonePost : 'npclonePost'
}


/**
* Primary Nested Pages Class
*/
NestedPages.Factory = function()
{
	var plugin = this;
	var $ = jQuery;

	plugin.formatter = new NestedPages.Formatter;
	plugin.responsive = new NestedPages.Responsive;
	plugin.menuToggle = new NestedPages.MenuToggle;
	plugin.pageToggle = new NestedPages.PageToggle;
	plugin.nesting = new NestedPages.Nesting;
	plugin.syncMenuSetting = new NestedPages.SyncMenuSetting;
	plugin.newLink = new NestedPages.NewLink;
	plugin.newPage = new NestedPages.NewPage;
	plugin.quickEditLink = new NestedPages.QuickEditLink;
	plugin.quickEditPost = new NestedPages.QuickEditPost;
	plugin.clone = new NestedPages.Clone;

	plugin.init = function()
	{
		plugin.bindEvents();
		plugin.setPostType();
		plugin.setNestable();
		plugin.formatter.updateSubMenuToggle();
		plugin.formatter.setBorders();
		plugin.formatter.setNestedMargins();
		plugin.nesting.initializeSortable();
	}


	plugin.bindEvents = function()
	{
		$(document).on('click', NestedPages.selectors.quickEditOverlay, function(e){
			plugin.formatter.removeQuickEdit();
			plugin.newPage.cancelNewPage();
		});
	}


	// Set whether or not post type is nestable
	plugin.setNestable = function()
	{
		var nestable = true;
		$.each(NestedPages.jsData.allPostTypes, function(i, v){
			if ( v.name !== NestedPages.jsData.posttype ) return;
			if ( v.hierarchical === true ) nestable = true;
			if ( v.disable_nesting === true ) nestable = false;
		});
		NestedPages.jsData.nestable = nestable;
	}


	// Set the Screen's Post Type
	plugin.setPostType = function()
	{
		NestedPages.jsData.posttype = $(NestedPages.selectors.sortable).attr('id').substring(3);
		NestedPages.jsData.hierarchical = NestedPages.jsData.allPostTypes[NestedPages.jsData.posttype].hierarchical;
	}


	return plugin.init();
}