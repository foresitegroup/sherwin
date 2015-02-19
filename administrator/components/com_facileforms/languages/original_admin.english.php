<?php
/**
* FacileForms - A Joomla Forms Application
* @version 1.4.5
* @package FacileForms
* @copyright (C) 2004-2006 by Peter Koch
* @license Released under the terms of the GNU General Public License
* @translator
**/
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/*1.4.1*/define('_FACILEFORMS_INCOMPATIBLE', 'FacileForms requires Joomla 1.0.0 at least!');

/*1.4.1*/define('_FACILEFORMS_TOOLBAR_NEW', 'New');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_SAVE', 'Save');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_EDIT', 'Edit');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_COPY', 'Copy');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_MOVE', 'Move');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_DELETE', 'Delete');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_CANCEL', 'Cancel');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_CONTINUE', 'Continue');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_VIEWED', 'Viewed');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_EXPORTED', 'Exported');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_ARCHIVED', 'Archived');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_PUBLISH', 'Publish');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_UNPUBLISH', 'Unpublish');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_EXPXML', 'Export&nbsp;XML');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_DLDPKG', 'Download&nbsp;Package');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_ASKDEL', 'Do you really want to delete the selected items?');
/*1.4.5*/define('_FACILEFORMS_TOOLBAR_INSTPKG', 'Install Package');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_PKGINSTLR', 'Package&nbsp;Installer');
/*1.4.5*/define('_FACILEFORMS_TOOLBAR_UINSTPKGS', 'Uninstall Packages');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_CREAPKG', 'Create&nbsp;Package');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_EDITFORM', 'Edit&nbsp;Form');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_MANAGERECS', 'Manage&nbsp;Records');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_MANAGEMENUS', 'Manage&nbsp;Menus');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_MANAGEFORMS', 'Manage&nbsp;Forms');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_MANAGESCRIPTS', 'Manage&nbsp;Scripts');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_MANAGEPIECES', 'Manage&nbsp;Pieces');
/*1.4.1*/define('_FACILEFORMS_TOOLBAR_CONFIGURATION', 'Configuration');

/*1.4.1*/define('_FACILEFORMS_CONFIG', 'Configuration');
/*1.4.1*/define('_FACILEFORMS_CONFIG_SAVED', 'Configuration saved');
/*1.4.1*/define('_FACILEFORMS_CONFIG_USELIVESITE', 'Use live site in configuration.php');
/*1.4.1*/define('_FACILEFORMS_CONFIG_TIPLIVESITE', 'Select NO for relative, YES for absolute url addressing');
/*1.4.1*/define('_FACILEFORMS_CONFIG_GETPROVIDER', 'Get provider with GetHostByAddr');
/*1.4.1*/define('_FACILEFORMS_CONFIG_TIPPROVIDER', 'YES may result in delays when loading and submitting the form');
/*1.4.1*/define('_FACILEFORMS_CONFIG_GRIDSIZE', 'Preview window grid size');
/*1.4.1*/define('_FACILEFORMS_CONFIG_COLOR', 'Color');
/*1.4.5*/define('_FACILEFORMS_CONFIG_PREVIEWFRAME', 'Run backend preview in a iframe');
/*1.4.1*/define('_FACILEFORMS_CONFIG_TIPPREVIEW', 'This enables true WYSIWYG with the frontend stylesheet');
/*1.4.1*/define('_FACILEFORMS_CONFIG_USEWYSIWYG', 'Use WYSIWYG editor for text elements');
/*1.4.1*/define('_FACILEFORMS_CONFIG_TIPWYSIWYG', 'WYSIWYG editor is selectable in mambo global configuration');
/*1.4.1*/define('_FACILEFORMS_CONFIG_COMPRESS', 'Compress JavaScript and HTML');
/*1.4.1*/define('_FACILEFORMS_CONFIG_TIPCOMPRESS', 'Reduces traffic from server to browser. Turn this off to debug the page code');
/*1.4.1*/define('_FACILEFORMS_CONFIG_TEXTAREA', 'Number of lines for textareas');
/*1.4.1*/define('_FACILEFORMS_CONFIG_SMALL', 'Small');
/*1.4.1*/define('_FACILEFORMS_CONFIG_MEDIUM', 'Medium');
/*1.4.1*/define('_FACILEFORMS_CONFIG_LARGE', 'Large');
/*1.4.1*/define('_FACILEFORMS_CONFIG_LIMITDESC', 'Limit descriptions in listviews to');
/*1.4.1*/define('_FACILEFORMS_CONFIG_CHARS', 'chars');
/*1.4.1*/define('_FACILEFORMS_CONFIG_DEFAULTEMAIL', 'Default email notification address');
/*1.4.1*/define('_FACILEFORMS_CONFIG_FFIMAGES', 'Path for {ff_images} substitute');
/*1.4.1*/define('_FACILEFORMS_CONFIG_FFUPLOADS', 'Path for {ff_uploads} substitute');

/*1.4.1*/define('_FACILEFORMS_INSTALL_INSTALLATION', 'Installation');
/*1.4.1*/define('_FACILEFORMS_INSTALL_STEP2', 'Installation Step 2');
/*1.4.1*/define('_FACILEFORMS_INSTALL_STEP2MSG',
	'<p>The program has been installed sucessfully now. '.
    'Next step is creating or updating the database tables respectively.</p>'.

	'<p>The installation automaticly detects if you are upgrading from a previous '.
    'version und proposes the correct mode. However you should still check if '.
    'this really is ok for your configuration.</p>'.

	'<p>You can also choose to install optional packages. It is recommended to '.
    'install the standard samples since they are a major source of information.</p>'.

	'<p>Please check the matching options and then click on <em>Continue</em> to proceed:</p>'
);
/*1.4.1*/define('_FACILEFORMS_INSTALL_SELECTDBMODE', 'Select database install/update mode');
/*1.4.1*/define('_FACILEFORMS_INSTALL_SELECTMODE', 'Please select a database install/update mode.');
/*1.4.1*/define('_FACILEFORMS_INSTALL_NEWINSTALL', 'New install: Create tables (drops existing tables)');
/*1.4.1*/define('_FACILEFORMS_INSTALL_REINSTALL', 'Reinstalling');
/*1.4.1*/define('_FACILEFORMS_INSTALL_UPTODATE', 'Table structures are up-to-date');
/*1.4.1*/define('_FACILEFORMS_INSTALL_UPGRADE', 'Upgrading from');
/*1.4.1*/define('_FACILEFORMS_INSTALL_SELECTOPTIONS', 'Select optional packages');
/*1.4.1*/define('_FACILEFORMS_INSTALL_INSTSAMPLES', 'Sample forms (Samples)');
/*1.4.1*/define('_FACILEFORMS_INSTALL_INSTOLDLIB', 'Library for backward-compatibility (FFOLD)');
/*1.4.1*/define('_FACILEFORMS_INSTALL_COMPLETE', 'Installation Complete');
/*1.4.1*/define('_FACILEFORMS_INSTALL_COMPLETEMSG',
	'<p>The database operations have now been performed according to your settings. '.
	'Below you see a list of the messages returned from the database.</p>'.

	'<p>The next step is to check the program configuration. '.
	'Finally first timers should go to Manage Forms and check out the samples to '.
	'get into business.</p>'.

	'<p>Click <em>Continue</em> to proceed with the configuration now.</p>'
);
/*1.4.1*/define('_FACILEFORMS_INSTALL_NOMESSAGES', 'No messages have been generated.');

/*1.4.1*/define('_FACILEFORMS_INSTALLER', 'Package Installer');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_INSTALLPKG', 'Install Package');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_CREATEPKG', 'Create Package');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_SELECTMODE', 'Please select package installation mode.');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_CLIENTUPLOAD', 'Upload package file from client &amp; install');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_SERVERINSTALL', 'Install package from file on server');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_ENTPACKAGENAME', 'Please enter package name');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_ENTIDENTIFIER', 'Please enter a valid identifier as package name');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_ENTVERSION', 'Please enter package version');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_ENTTITLE', 'Please enter package title');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_ENTAUTHORNM', 'Please enter author name');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_ENTAUTHORMAIL', 'Please enter author email');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_ENTAUTHORURL', 'Please enter author url');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_ENTDESCR', 'Please enter package description');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_ENTCOPYRT', 'Please enter package copyright');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_SELECTAPKG', 'Please select at least one item for the package');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_PACKAGE', 'Package');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_ID', 'ID');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_NAME', 'Name');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_VERS', 'Version');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_TITLE', 'Title');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_AUTHOR', 'Author');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_EMAIL', 'Email');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_URL', 'URL');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_DESC', 'Description');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_CPYRT', 'Copyright');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_FORMSEL', 'Form Selection');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_MENUSEL', 'Backend Menuitem Selection');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_SCRIPTSEL', 'Script Selection');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_PIECESEL', 'Piece Selection');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_SELECTALL', 'Select all');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_CLRSELECTION', 'Clear selection');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_PKGREPORT', 'Package Installation Report');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_INSTTYPE', 'Installation Type');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_FFVERSION', 'FacileForms Version');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_CREATEDATE', 'Created');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_SCRIPTSIMP', 'Scripts Imported');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_PIECESIMP', 'Pieces Imported');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_FORMSIMP', 'Forms Imported');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_MENUSIMP', 'Backend Menuitems Imported');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_ELEMSIMP', 'Elements Imported');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_WARNINGS', 'These warnings were emitted during installation');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_NOUPLOADFILE', 'No upload file was selected');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_UPLOADNODIR', 'Upload failed as <code>/packages</code> directory does not exist.');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_UPLOADDIRNOTWRT', 'Upload failed as <code>/packages</code> directory is not writable.');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_MOVEFAILED', 'Failed to move uploaded file to <code>/packages</code> directory.');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_CHMODFAILED', 'Failed to change the permissions of the uploaded file.');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_TAGNOTFOUND', 'not found at package install.');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_UNKNOWN', 'unknown');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_NOFILENAME', 'No filename was provided');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_XMLLOADERR', 'Error loading XML document');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_XMLNOTPACKAGE', 'XML file is not a FacileForms package');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_UNEXPXMLELEM', 'Unexpected XML element');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_UNEXPXMLATTR', 'Unexpected XML attribute');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_UNEXPCLOSETAG', 'Unexpected closing tag');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_UNEXPDATA', 'Unexpected data');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_INXMLELEMENT', 'in XML element');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_ATLINE', 'at line');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_SELPKGSFIRST', 'Please select packages first');
/*1.4.1*/define('_FACILEFORMS_INSTALLER_ASKUNINST',
    'Uninstalling packages in use by other forms will render those forms broken! \\n\\n'.
    'So if you want to upgrade the packages, just install the new version WITHOUT \\n'.
    'uninstalling the old version first; then forms using that packages will get \\n'.
    'relinked to the new version. \\n\\n'.
	'So are you *REALLY* sure to to uninstall the selected packages now?'

);
/*1.4.1*/define('_FACILEFORMS_INSTALLER_PKGSUNINST', 'packages uninstalled');

/*1.4.1*/define('_FACILEFORMS_MENUS_PACKAGE', 'Package');
/*1.4.1*/define('_FACILEFORMS_MENUS_SAVED', 'Menuitem saved');
/*1.4.1*/define('_FACILEFORMS_MENUS_MANAGEMENUS', 'Manage Backend Menuitems');
/*1.4.1*/define('_FACILEFORMS_MENUS_SUCOPIED', 'Menuitem(s) successfully copied');
/*1.4.1*/define('_FACILEFORMS_MENUS_NOFORM', 'No Form');
/*1.4.1*/define('_FACILEFORMS_MENUS_EDIT', 'Edit Menuitem');
/*1.4.1*/define('_FACILEFORMS_MENUS_ADD', 'Add Menuitem');
/*1.4.1*/define('_FACILEFORMS_MENUS_TOP', 'Top');
/*1.4.1*/define('_FACILEFORMS_MENUS_TITLEEMPTY', 'Please enter menuitem title.');
/*1.4.1*/define('_FACILEFORMS_MENUS_NAMEIDENT', 'Please enter a valid identifier as form name.');
/*1.4.1*/define('_FACILEFORMS_MENUS_PARENT', 'Parent Item');
/*1.4.1*/define('_FACILEFORMS_MENUS_TITLE', 'Title');
/*1.4.1*/define('_FACILEFORMS_MENUS_TIPTITLE', 'Displayed as menuitem text');
/*1.4.1*/define('_FACILEFORMS_MENUS_IMAGE', 'Image');
/*1.4.1*/define('_FACILEFORMS_MENUS_NONE', 'None');
/*1.4.1*/define('_FACILEFORMS_MENUS_ORDERING', 'Ordering');
/*1.4.1*/define('_FACILEFORMS_MENUS_PUBLISHED', 'Published');
/*1.4.1*/define('_FACILEFORMS_MENUS_NAME', 'Form Name');
/*1.4.1*/define('_FACILEFORMS_MENUS_TIPNAME', 'Enter the name of the form to run here');
/*1.4.1*/define('_FACILEFORMS_MENUS_PAGE', 'Starting Page');
/*1.4.1*/define('_FACILEFORMS_MENUS_PAGEEMPTY', 'Please enter starting page.');
/*1.4.1*/define('_FACILEFORMS_MENUS_PAGENUMBER', 'Please enter a number for the starting page.');
/*1.4.1*/define('_FACILEFORMS_MENUS_FRAME', 'Run in IFRAME');
/*1.4.1*/define('_FACILEFORMS_MENUS_BORDER', 'Show Border');
/*1.4.1*/define('_FACILEFORMS_MENUS_PARAMS', 'Additional Parameters');
/*1.4.1*/define('_FACILEFORMS_MENUS_TIPPARAMS', 'Enter for example as <em>&ff_param_aaa=AAA&ff_param_bbb=BBB</em>');
/*1.4.1*/define('_FACILEFORMS_MENUS_SELMENUSFIRST', 'Please select menuitems first');
/*1.4.1*/define('_FACILEFORMS_MENUS_ASKDEL', 'Do you really want to delete the selected menuitems?');
/*1.4.1*/define('_FACILEFORMS_MENUS_MENUITEM', 'Menu Item');
/*1.4.1*/define('_FACILEFORMS_MENUS_REORDER', 'Reorder');

/*1.4.1*/define('_FACILEFORMS_FORMS_PACKAGE', 'Package');
/*1.4.1*/define('_FACILEFORMS_FORMS_EDIT', 'Edit Form');
/*1.4.1*/define('_FACILEFORMS_FORMS_SAVED', 'Form saved');
/*1.4.1*/define('_FACILEFORMS_FORMS_ADD', 'Add Form');
/*1.4.1*/define('_FACILEFORMS_FORMS_SUCOPIED', 'Forms(s) successfully copied');
/*1.4.1*/define('_FACILEFORMS_FORMS_TITLEEMPTY', 'Please enter title.');
/*1.4.1*/define('_FACILEFORMS_FORMS_NAMEEMPTY', 'Please enter name.');
/*1.4.1*/define('_FACILEFORMS_FORMS_NAMEIDENT', 'Please enter a valid identifier for name.');
/*1.4.1*/define('_FACILEFORMS_FORMS_WIDTHEMPTY', 'Please enter width.');
/*1.4.1*/define('_FACILEFORMS_FORMS_WIDTHNUMBER', 'Please enter a number for width.');
/*1.4.1*/define('_FACILEFORMS_FORMS_HEIGHTEMPTY', 'Please enter height.');
/*1.4.1*/define('_FACILEFORMS_FORMS_HEIGHTNUMBER', 'Please enter a number for height.');
/*1.4.1*/define('_FACILEFORMS_FORMS_ENTNAMEFIRST', 'Please enter form name first.');
/*1.4.1*/define('_FACILEFORMS_FORMS_CREATEINITNOW', 'Create code framework for init now?');
/*1.4.1*/define('_FACILEFORMS_FORMS_EXISTINGAPPENDED', '(Existing code will be appended)');
/*1.4.1*/define('_FACILEFORMS_FORMS_OLDCODEBELOW', 'old code below');
/*1.4.1*/define('_FACILEFORMS_FORMS_CREATESUBMITTEDNOW', 'Create code framework for submitted now?');
/*1.4.1*/define('_FACILEFORMS_FORMS_SETTINGS', 'Settings');
/*1.4.1*/define('_FACILEFORMS_FORMS_SCRIPTS', 'Scripts');
/*1.4.1*/define('_FACILEFORMS_FORMS_PIECES', 'Pieces');
/*1.4.1*/define('_FACILEFORMS_FORMS_FORMPIECES', 'Form pieces');
/*1.4.1*/define('_FACILEFORMS_FORMS_SUBMPIECES', 'Submit pieces');
/*1.4.1*/define('_FACILEFORMS_FORMS_TIPTITLE', 'Display as form title in backend');
/*1.4.1*/define('_FACILEFORMS_FORMS_TIPNAME', 'Used as identifier for component, module and mambot frontends');
/*1.4.1*/define('_FACILEFORMS_FORMS_TIPINITCODE', 'One function in the code must be ff_{form_name}_init().');
/*1.4.1*/define('_FACILEFORMS_FORMS_TIPSUBMITTEDCODE', 'One function in the code must be ff_{form_name}_submitted(status).');
/*1.4.1*/define('_FACILEFORMS_FORMS_TITLE', 'Title');
/*1.4.1*/define('_FACILEFORMS_FORMS_NAME', 'Name');
/*1.4.1*/define('_FACILEFORMS_FORMS_ORDERING', 'Ordering');
/*1.4.1*/define('_FACILEFORMS_FORMS_PUBLISHED', 'Published');
/*1.4.1*/define('_FACILEFORMS_FORMS_WIDTH', 'Width');
/*1.4.1*/define('_FACILEFORMS_FORMS_HEIGHT', 'Height');
/*1.4.1*/define('_FACILEFORMS_FORMS_CLASSFOR', 'CSS class for');
/*1.4.1*/define('_FACILEFORMS_FORMS_FIXED', 'Fixed');
/*1.4.1*/define('_FACILEFORMS_FORMS_AUTO', 'Auto' );
/*1.4.1*/define('_FACILEFORMS_FORMS_AUTOMAX', 'Automax' );
/*1.4.1*/define('_FACILEFORMS_FORMS_BOTTOMMARGIN', 'Bottom margin' );
/*1.4.1*/define('_FACILEFORMS_FORMS_LOGTODB', 'Log To Database');
/*1.4.1*/define('_FACILEFORMS_FORMS_NO', 'No');
/*1.4.1*/define('_FACILEFORMS_FORMS_NONEMPTY', 'Nonempty values');
/*1.4.1*/define('_FACILEFORMS_FORMS_ALLVALS', 'All values');
/*1.4.1*/define('_FACILEFORMS_FORMS_EMAILNOTIFY', 'Email Notification');
/*1.4.1*/define('_FACILEFORMS_FORMS_EMAILXML', 'XML Attachment');
/*1.4.1*/define('_FACILEFORMS_FORMS_TYPE', 'Type');
/*1.4.1*/define('_FACILEFORMS_FORMS_NONE', 'None');
/*1.4.1*/define('_FACILEFORMS_FORMS_DEFADDR', 'To Default Address');
/*1.4.1*/define('_FACILEFORMS_FORMS_CUSTADDR', 'To Custom Address');
/*1.4.1*/define('_FACILEFORMS_FORMS_REPORT', 'Report');
/*1.4.1*/define('_FACILEFORMS_FORMS_HDRONLY', 'Header only');
/*1.4.1*/define('_FACILEFORMS_FORMS_EMAIL', 'Email to');
/*1.4.1*/define('_FACILEFORMS_FORMS_PREVMODE', 'Preview Mode');
/*1.4.1*/define('_FACILEFORMS_FORMS_BELOW', 'Below');
/*1.4.1*/define('_FACILEFORMS_FORMS_OVERLAYED', 'Overlayed');
/*1.4.1*/define('_FACILEFORMS_FORMS_INITSCRIPT', 'Initialization Script');
/*1.4.1*/define('_FACILEFORMS_FORMS_LIBRARY', 'Library');
/*1.4.1*/define('_FACILEFORMS_FORMS_CUSTOM', 'Custom');
/*1.4.1*/define('_FACILEFORMS_FORMS_SCRIPT', 'Script');
/*1.4.1*/define('_FACILEFORMS_FORMS_CREATEFRAME', 'Create code framework');
/*1.4.1*/define('_FACILEFORMS_FORMS_SUBMITTEDSCRIPT', 'Submitted Script');
/*1.4.1*/define('_FACILEFORMS_FORMS_BEFOREFORM', 'Before Form');
/*1.4.1*/define('_FACILEFORMS_FORMS_PIECE', 'Piece');
/*1.4.1*/define('_FACILEFORMS_FORMS_AFTERFORM', 'After Form');
/*1.4.1*/define('_FACILEFORMS_FORMS_BEGINSUBMIT', 'Begin Submit');
/*1.4.1*/define('_FACILEFORMS_FORMS_ENDSUBMIT', 'End Submit');
/*1.4.1*/define('_FACILEFORMS_FORMS_SELFORMSFIRST', 'Please select forms first');
/*1.4.1*/define('_FACILEFORMS_FORMS_ASKDEL', 'Do you really want to delete the selected forms?');
/*1.4.1*/define('_FACILEFORMS_FORMS_MANAGEFORMS', 'Manage Forms');
/*1.4.1*/define('_FACILEFORMS_FORMS_PAGES', 'Pages');
/*1.4.1*/define('_FACILEFORMS_FORMS_SCRIPTID', 'Script ID');
/*1.4.1*/define('_FACILEFORMS_FORMS_REORDER', 'Reorder');
/*1.4.1*/define('_FACILEFORMS_FORMS_DESCRIPTION', 'Description');
/*1.4.1*/define('_FACILEFORMS_FORMS_RUNMODE', 'Run Mode' );
/*1.4.1*/define('_FACILEFORMS_FORMS_ANY', 'Any' );
/*1.4.1*/define('_FACILEFORMS_FORMS_FRONTEND', 'Frontend' );
/*1.4.1*/define('_FACILEFORMS_FORMS_BACKEND', 'Backend' );

/*1.4.1*/define('_FACILEFORMS_ELEMENTS', 'Elements');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SAVED', 'Saved');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_PAGE', 'Page');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ANERROR', 'An error has occurred');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_COPIED', 'Element(s) successfully copied to form: ');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_MOVED', 'Element(s) successfully moved to form: ');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_PAGE2', 'page: ');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_NOTMOVED', 'Nothing moved');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_NEWTYPE', 'New Element Type');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_STATICS', 'Statics');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_STATICTEXT', 'Static Text/HTML');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_RECTANGLE', 'Rectangle');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_IMAGE', 'Image');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TOOLTIP', 'Tooltip');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_QUERY', 'Query');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_QUERYCOLS', 'Columns');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_QUERYLIST', 'Query List');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CREATEQUERY', 'Create code framework');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ASKCREATEQUERY', 'Create code framework for query now?');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TIPQUERY', 'Enter php code here to populate $rows with an array of objects');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ROWSPERPAGE', 'Rows per page');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_BORDERWIDTH', 'Border Width');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CELLSPACING', 'Cell Spacing');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CELLPADDING', 'Cell Padding');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_EDITQUERYCOL', 'Query List Column');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SPAN', 'Span');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_HEADER', 'Header');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SHOWHEADER', 'Show Header');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_DATA', 'Data');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ATTRIBUTES', 'Attributes');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_HORALIGN', 'Horizontal Align');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CENTER', 'Center');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_JUSTIFY', 'Justify');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_VERTALIGN', 'Vertical Align');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TOP', 'Top');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_MIDDLE', 'Middle');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_BOTTOM', 'Bottom');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_BASELINE', 'Baseline');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_WRAPMODE', 'Wrap Mode');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_NOWRAP', 'Nowrap');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_QCOLTIPTITLE', 'Displayed as column title in the list');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_QCOLTIPNAME', 'Used as identifier for the column');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ASKSORT', 'Shall the elements get sorted by position now?');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SORTED', 'Elements sorted');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ASKDELCOLUMNS', 'Do you really want to delete the selected columns?');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SELECTCOLUMNS', 'Please select columns first');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_UPLDTIMESTAMP', 'Add timestamp to filename');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_PAGENAV', 'Page Navigation');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_FIRSTCOLUMN', 'First Column Mode');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_NORMAL', 'Normal');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CHECKBOXES', 'Checkboxes');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_RADIOBUTTONS', 'Radio Buttons');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SAVE', 'Save');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_RESTORE', 'Restore');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_GRID', 'Grid');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_BUTTONS', 'Buttons');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_REGBUTTON', 'Regular Button');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_GRAPHBUTTON', 'Graphic Button');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ICON', 'Icon');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_INPUTS', 'Inputs');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CHECKBOX', 'Checkbox');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_RADIO', 'Radio Button');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SELECT', 'Select List');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TEXT', 'Text');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TEXTAREA', 'Textarea');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_UPLOAD', 'File Upload');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_HIDDEN', 'Hidden Input');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_EDIT', 'Edit Element');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ADD', 'Add Element');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_COPY', 'Copy Elements');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_MOVE', 'Move Elements');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TOFORMPAGE', 'To Form / Page');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TITLEEMPTY', 'Please enter title.');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ENTNAME', 'Please enter a name.');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ENTIDENT', 'Please enter a valid identifier as name.');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CREAINIT', 'Create code framework for init now?');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CREAACTION', 'Create code framework for action now?');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CREAVALID', 'Create code framework for validation now?');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_EXISTAPP', '(Existing code will be appended)');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_OLDBELOW', 'old code below');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_NEWSELOPT', 'Enter new select list option');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_VALUE', 'Value');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SELECTED', 'Selected');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_OKBUTTON', '&nbsp;&nbsp;OK&nbsp;&nbsp;');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ABORTBUTT', 'Abort');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SETTINGS', 'Settings');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TITLE', 'Title');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TIPTITLE', 'Displayed as element title in backend and user for email notification');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_NAME', 'Name');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TIPNAME', 'Used as identifier for the form logging table');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ORDERING', 'Ordering');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_PUBLISHED', 'Published');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_INCINLOG', 'Include in logs');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_POSITION', 'Position');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_COLUMNS', 'Columns');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ROWS', 'Rows');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_FIELDSZ', 'Field Size');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_MAXLENGTH', 'Max.Length');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_MAXFILESIZE', 'Max.Filesize');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_WIDTH', 'Width');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_HEIGHT', 'Height');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_IMAGE0', 'Leave width and height 0 or blank for original picture size');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_OTHER0', 'Leave width and height 0 or blank for maximum available size');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CHECKED', 'Checked');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_MULTIPLE', 'Multiple');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_PASSWORD', 'Password');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_DISABLED', 'Disabled');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ENABLED', 'Enabled');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_READONLY', 'Readonly');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_UPLDIR', 'Upload Directory');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TEXTHTML', 'Text/HTML');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_BORDER', 'Border');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_IMGURL', 'Image URL');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_IMGURLF2', 'Mouseover Image URL');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SIZE', 'Size');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_MIMETYPES', 'Mime Types allowed');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CAPTION', 'Caption');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TYPE', 'Type');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_NONE', 'None');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_BELOW', 'Below');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ABOVE', 'Above');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_LEFT', 'Left');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_RIGHT', 'Right');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_LABEL', 'Label');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_BKGCOLOR', 'Background Color');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ALTTEXT', 'Alternate Text');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_OPTIONS', 'Options');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_OPTINFO', 'Enter one option per line. Syntax: selected;displaytext;value(optional)');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SCRIPTS', 'Scripts');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_INITSCRIPT', 'Init Script');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_LIBRARY', 'Library');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CUSTOM', 'Custom');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CONDITIONS', 'Conditions');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_FORMENTRY', 'Form Entry');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_PAGEENTRY', 'Page Entry');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SCRIPT', 'Script');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CREATECODE', 'Create code framework');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TIPINIT', 'One function in the code must be ff_{element_name}_init(element,condition).');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TIPACTION', 'One function in the code must be ff_{element_name}_action(element,action).');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TIPVALID', 'One function in the code must be ff_{element_name}_validation(element,message).');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ACTIONSCRIPT', 'Action Script');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ACTIONS', 'Actions');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CLICK', 'Click');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_BLUR', 'Blur');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_CHANGE', 'Change');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_FOCUS', 'Focus');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SELECTION', 'Select');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_VALIDSCRIPT', 'Validation Script');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_MESSAGE', 'Message');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_TIPMESSAGE', 'Message displayed when validation fails.');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SELELEMENTS', 'Please select elements first');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ASKDELELEMENTS', 'Do you really want to delete the selected elements?');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ASKDELPAGE', 'Do you really want to delete the current page?');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ENTPIXMOVE', 'Please enter the pixel move amount');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_PIXMOVEINT', 'Pixel move amount must be integer number.');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ELEMENTSON', 'Elements on');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SCRIPTID', 'Script ID');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_REORDER', 'Reorder');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_PAGELAY', 'Page Layout');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_MOVEPIX', 'Move-Pixels');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_BROWSER1', 'Your browser is not capable of displaying embedded frames!');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_BROWSER2', 'Please turn off template preview in FacileForms configuration.');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SELFORMPAGE', 'Please select a form and page to move/copy the elements to');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SELPAGEMOVE', 'Please select a page number to move the page to');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_MOVEPAGE', 'Move Page');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_SELNRPAGE', 'Select new number for current page');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ADDPAGEBEFORE', 'Add Page Before');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ADDPAGEBEHIND', 'Add Page Behind');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_MOVEPG', 'Move Page');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_DELPAGE', 'Delete Page');
/*1.4.1*/define('_FACILEFORMS_ELEMENTS_ADDOPTIONS', 'Add options');

/*1.4.1*/define('_FACILEFORMS_SCRIPTS_PACKAGE', 'Package');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_SAVED', 'Saved');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_SUCCOPIED', 'Script(s) successfully copied');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_EDITSCRIPT', 'Edit Script');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_ADDSCRIPT', 'Add Script');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_ENTERNAME', 'Please enter name.');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_ENTERIDENT', 'Please enter a valid identifier for name.');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_ENTTITLE', 'Please enter title.');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_TITLE', 'Title');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_TIPTITLE', 'Display as script title');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_PUBLISHED', 'Published');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_NAME', 'Name');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_TIPNAME', 'Must be a unique identifier and match a function name within the code');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_TYPE', 'Type');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_DESCRIPTION', 'Description');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_CODE', 'Code');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_SELSCRIPTSFIRST', 'Please select scripts first');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_ASKDELETE', 'Do you really want to delete the selected scripts?');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_MANAGESCRIPTS', 'Manage Script Library');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_CREATECODE', 'Create code framework');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_CREATEACTCODE', 'Create code framework for element action now?');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_CREATEINICODE', 'Create code framework for element init now?');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_CREATEVALCODE', 'Create code framework for validation now?');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_CREATEFINICODE', 'Create code framework for form init now?');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_CREATESUBCODE', 'Create code framework for form submitted now?');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_CREATEUNTCODE', 'Create code framework for untyped now?');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_UNKNOWNTYPE', 'unknown script type:');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_EXISTAPP', '(Existing code will be appended)');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_OLDBELOW', 'old code below');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_ENTNAMEFIRST', 'Please enter the name first.');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_UNTYPED', 'Untyped');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_ELEMENTINIT', 'Element Init');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_ELEMENTACTION', 'Element Action');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_ELEMENTVALID', 'Element Validation');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_FORMINIT', 'Form Init');
/*1.4.1*/define('_FACILEFORMS_SCRIPTS_FORMSUBMIT', 'Form Submitted');

/*1.4.1*/define('_FACILEFORMS_PIECES_PACKAGE', 'Package');
/*1.4.1*/define('_FACILEFORMS_PIECES_SAVED', 'Saved');
/*1.4.1*/define('_FACILEFORMS_PIECES_SUCCOPIED', 'Piece(s) successfully copied');
/*1.4.1*/define('_FACILEFORMS_PIECES_EDITPIECE', 'Edit Piece');
/*1.4.1*/define('_FACILEFORMS_PIECES_ADDPIECE', 'Add Piece');
/*1.4.1*/define('_FACILEFORMS_PIECES_ENTERNAME', 'Please enter name.');
/*1.4.1*/define('_FACILEFORMS_PIECES_ENTERIDENT', 'Please enter a valid identifier for name.');
/*1.4.1*/define('_FACILEFORMS_PIECES_ENTTITLE', 'Please enter title.');
/*1.4.1*/define('_FACILEFORMS_PIECES_TITLE', 'Title');
/*1.4.1*/define('_FACILEFORMS_PIECES_TIPTITLE', 'Display as piece title');
/*1.4.1*/define('_FACILEFORMS_PIECES_PUBLISHED', 'Published');
/*1.4.1*/define('_FACILEFORMS_PIECES_NAME', 'Name');
/*1.4.1*/define('_FACILEFORMS_PIECES_TIPNAME', 'Must be a unique identifier');
/*1.4.1*/define('_FACILEFORMS_PIECES_TYPE', 'Type');
/*1.4.1*/define('_FACILEFORMS_PIECES_DESCRIPTION', 'Description');
/*1.4.1*/define('_FACILEFORMS_PIECES_CODE', 'Code');
/*1.4.1*/define('_FACILEFORMS_PIECES_SELPIECESFIRST', 'Please select pieces first');
/*1.4.1*/define('_FACILEFORMS_PIECES_ASKDELETE', 'Do you really want to delete the selected pieces?');
/*1.4.1*/define('_FACILEFORMS_PIECES_MANAGEPIECES', 'Manage Piece Library');
/*1.4.1*/define('_FACILEFORMS_PIECES_UNTYPED', 'Untyped');
/*1.4.1*/define('_FACILEFORMS_PIECES_BEFOREFORM', 'Before Form');
/*1.4.1*/define('_FACILEFORMS_PIECES_AFTERFORM', 'After Form');
/*1.4.1*/define('_FACILEFORMS_PIECES_BEGINSUBMIT', 'Begin Submit');
/*1.4.1*/define('_FACILEFORMS_PIECES_ENDSUBMIT', 'End Submit');

/*1.4.1*/define('_FACILEFORMS_RECORDS_VIEWRECORD', 'View Record');
/*1.4.1*/define('_FACILEFORMS_RECORDS_SUBMINFO', 'Submitter information');
/*1.4.1*/define('_FACILEFORMS_RECORDS_SUBMITTED', 'Submitted');
/*1.4.1*/define('_FACILEFORMS_RECORDS_PROVIDER', 'Provider');
/*1.4.1*/define('_FACILEFORMS_RECORDS_BROWSER', 'Browser');
/*1.4.1*/define('_FACILEFORMS_RECORDS_OPSYS', 'System');
/*1.4.1*/define('_FACILEFORMS_RECORDS_RECORDINFO', 'Record information');
/*1.4.1*/define('_FACILEFORMS_RECORDS_VIEWED', 'Viewed');
/*1.4.1*/define('_FACILEFORMS_RECORDS_EXPORTED', 'Exported');
/*1.4.1*/define('_FACILEFORMS_RECORDS_ARCHIVED', 'Archived');
/*1.4.1*/define('_FACILEFORMS_RECORDS_XMLNORWRTBL', 'XML file is not writable!');
/*1.4.1*/define('_FACILEFORMS_RECORDS_YES', 'yes');
/*1.4.1*/define('_FACILEFORMS_RECORDS_NO', 'no');
/*1.4.1*/define('_FACILEFORMS_RECORDS_FORMINFO', 'Form information');
/*1.4.1*/define('_FACILEFORMS_RECORDS_TITLE', 'Title');
/*1.4.1*/define('_FACILEFORMS_RECORDS_NAME', 'Name');
/*1.4.1*/define('_FACILEFORMS_RECORDS_SUBMVALUES', 'Submitted input values');
/*1.4.1*/define('_FACILEFORMS_RECORDS_RECORDID', 'Record ID');
/*1.4.1*/define('_FACILEFORMS_RECORDS_ELEMENTID', 'Element ID');
/*1.4.1*/define('_FACILEFORMS_RECORDS_TYPE', 'Type');
/*1.4.1*/define('_FACILEFORMS_RECORDS_VALUE', 'Value');
/*1.4.1*/define('_FACILEFORMS_RECORDS_PLSSELECTRECS', 'Please select records first');
/*1.4.1*/define('_FACILEFORMS_RECORDS_ASKDELETE', 'Do you really want to delete the selected records?');
/*1.4.1*/define('_FACILEFORMS_RECORDS_MANAGERECS', 'Manage Records');
/*1.4.1*/define('_FACILEFORMS_RECORDS_VIEWSTATUS', 'View Status');
/*1.4.1*/define('_FACILEFORMS_RECORDS_EXPORTSTATUS', 'Export Status');
/*1.4.1*/define('_FACILEFORMS_RECORDS_ARCHSTATUS', 'Archive Status');
/*1.4.1*/define('_FACILEFORMS_RECORDS_UNVIEWEDONLY', 'Unviewed only');
/*1.4.1*/define('_FACILEFORMS_RECORDS_VIEWEDONLY', 'Viewed only');
/*1.4.1*/define('_FACILEFORMS_RECORDS_BOTH', 'Both');
/*1.4.1*/define('_FACILEFORMS_RECORDS_UNEXPORTEDONLY', 'Unexported only');
/*1.4.1*/define('_FACILEFORMS_RECORDS_EXPORTEDONLY', 'Exported only');
/*1.4.1*/define('_FACILEFORMS_RECORDS_UNARCHIVEDONLY', 'Unarchived only');
/*1.4.1*/define('_FACILEFORMS_RECORDS_ARCHIVEDONLY', 'Archived only');
/*1.4.1*/define('_FACILEFORMS_RECORDS_FORMNAME', 'Form name');
/*1.4.1*/define('_FACILEFORMS_RECORDS_SAVERELOAD', 'Save filter + reload');
/*1.4.1*/define('_FACILEFORMS_RECORDS_RELOAD', 'Reload');
?>