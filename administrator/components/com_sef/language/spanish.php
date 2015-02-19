<?php
/**
 * SEF module for Joomla!
 *
 * @author      $Author: michal $
 * @copyright   ARTIO s.r.o., http://www.artio.cz
 * @package     JoomSEF
 * @version     $Name$, ($Revision: 4994 $, $Date: 2005-11-03 20:50:05 +0100 (??t, 03 XI 2005) $)
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

// admin interface
define('_COM_SEF_CONFIG', 'Configuraci�n de <br/>ARTIO JoomSEF');
define('_COM_SEF_CONFIGDESC', 'Configurar ARTIO JoomSEF');
define('_COM_SEF_HELP', 'Soporte para<br/>ARTIO JoomSEF');
define('_COM_SEF_HELPDESC', 'Necesitas ayuda con ARTIO JoomSEF?');
define('_COM_SEF_INFO', 'Documentaci�n de <br/>JoomSEF');
define('_COM_SEF_INFODESC', 'Ver sumario y documentaci�n de ARTIO JoomSEF');
define('_COM_SEF_VIEWURL', 'Ver/Editar<br/>SEF Urls');
define('_COM_SEF_VIEWURLDESC', 'Ver/Editar SEF Urls');
define('_COM_SEF_VIEW404', 'Ver/Editar<br/>404 Logs');
define('_COM_SEF_VIEW404DESC', 'Ver/Editar 404 Logs');
define('_COM_SEF_VIEWCUSTOM', 'Ver/Editar<br/>Redirecciones personalizadas');
define('_COM_SEF_VIEWCUSTOMDESC', 'Ver/Editar Redirecciones personalizadas');
define('_COM_SEF_SUPPORT', 'Sitio Web de<br/>Support');
define('_COM_SEF_SUPPORTDESC', 'Visitar el sitio de soporte para ARTIO JoomSEF (nueva ventana)');
define('_COM_SEF_BACK', 'Regresar al panel de Control de ARTIO JoomSEF');
define('_COM_SEF_PURGEURL', 'Purgar<br/>SEF Urls');
define('_COM_SEF_PURGEURLDESC', 'Purgar SEF Urls');
define('_COM_SEF_PURGE404', 'Purgar<br/>404 Logs');
define('_COM_SEF_PURGE404DESC', 'Purgar 404 Logs');
define('_COM_SEF_PURGECUSTOM', 'Purgar<br/>Redirecciones personalizadas');
define('_COM_SEF_PURGECUSTOMDESC', 'Purgar Redirecciones personalizadas');
define('_COM_SEF_WARNDELETE', 'ADVERTENCIA!!!<br/>Vas a borrar ');
define('_COM_SEF_RECORD', ' record');
define('_COM_SEF_RECORDS', ' records');
define('_COM_SEF_NORECORDS', 'No se encontraron records.');
define('_COM_SEF_PROCEED', ' Proceder ');
define('_COM_SEF_OK', ' OK ');
define('_COM_SEF_SUCCESSPURGE', 'Se purgaron los records exit�samente');
define('_PREVIEW_CLOSE', 'Cerrar esta ventana');
define('_COM_SEF_EMPTYURL', 'Debes especificar una URL para la redirecci�n.');
define('_COM_SEF_NOLEADSLASH', 'No debes incluir ningun slash al princio de la nueva');
define('_COM_SEF_BADURL', 'La vieja y no SEF URL debe comenzar con inde.php');
define('_COM_SEF_URLEXIST', 'Esta URL ya existe en la base de datos!');
define('_COM_SEF_SHOW0', 'Mostrar SEF Urls');
define('_COM_SEF_SHOW1', 'Mostrar 404 Log');
define('_COM_SEF_SHOW2', 'Mostrar Redirecciones Personalizadas');
define('_COM_SEF_INVALID_URL', 'URL INVALIDA: este enlace requiere de un Itemid v�lido, pero no fue encontrado.<br/>SOLUCION: Crear un item en el men�. No necesitas publicarlo, s�lo crearlo.');
define('_COM_SEF_DEF_404_MSG', '<h1>Error 404: P�gina No Encontrada</h1><h4>Lo sentimos, pero la p�gina que busca no existe o no se pudo encontrar</h4>');
define('_COM_SEF_SELECT_DELETE', 'Selecciona un item para borrar');
define('_COM_SEF_ASC', ' (asc) ');
define('_COM_SEF_DESC', ' (desc) ');
define('_COM_SEF_WRITEABLE', ' <b><font color="green">Permite escritura</font></b>');
define('_COM_SEF_UNWRITEABLE', ' <b><font color="red">No permite escritura</font></b>');
define('_COM_SEF_USING_DEFAULT', ' <b><font color="red">Usando los valores por defecto</font></b>');
define('_COM_SEF_DISABLED',"<p class='error'>NOTA: Soporte para SEF en Joomla/Mambo est� actualmente desabilitado. Para usar SEF, habl�telo desde la<a href='"
.$GLOBALS['mosConfig_live_site']."/administrator/index2.php?option=com_config'>Configuraci�n Global</a> p�gina SEO.</p>");
define('_COM_SEF_TITLE_CONFIG', 'Configuraci�n ARTIO JoomSEF');
define('_COM_SEF_TITLE_BASIC', 'Configuraci�n B�sica');
define('_COM_SEF_ENABLED', 'habilitado');
define('_COM_SEF_TT_ENABLED', 'Si lo defines como No, se usar�n las URLs SEF por defecto');
define('_COM_SEF_DEF_404_PAGE', '<b>P�gina 404 por defecto</b><br>');
define('_COM_SEF_REPLACE_CHAR', 'Caracter de reemplazo');
define('_COM_SEF_TT_REPLACE_CHAR', 'Caracter usado para reemplazar caracteres desconocidos en la URL');
define('_COM_SEF_PAGEREP_CHAR', 'Page spacer character');
define('_COM_SEF_TT_PAGEREP_CHAR', 'Character to use to space page numbers away from the rest of the URL');
define('_COM_SEF_STRIP_CHAR', 'Strip characters');
define('_COM_SEF_TT_STRIP_CHAR', 'Characters to strip from the URL, separate with |');
define('_COM_SEF_FRIENDTRIM_CHAR', 'Trim friendly characters');
define('_COM_SEF_TT_FRIENDTRIM_CHAR', 'Characters to trim from around the URL, separate with |');
define('_COM_SEF_USE_ALIAS', 'Usar T�tulo Alias');
define('_COM_SEF_TT_USE_ALIAS', 'Usar titlos_alias y no el t�tulo en la URL');
define('_COM_SEF_SUFFIX', 'Sufijo');
define('_COM_SEF_TT_SUFFIX', 'Extensi�n para usar en los \\\'archivos\\\'. Para desabilitar dejarlo en blanco. Comunmente es \\\'html\\\'.');
define('_COM_SEF_ADDFILE', 'Default index file');
define('_COM_SEF_TT_ADDFILE', 'File name to place after a blank url / when no file exists.  Useful for bots that crawl your site looking for a specific file in that place but returns a 404 because there is none there.');
define('_COM_SEF_PAGETEXT', 'Texto P�gina');
define('_COM_SEF_TT_PAGETEXT', 'Texto para serparar p�ginas multiples. Usar %s para insertar el n�mero, por defecto ir� al final de la URL. Si alg�n sufijo est� definido ser� agregado al final de la URL.');
define('_COM_SEF_LOWER', 'Todo en min�sculas');
define('_COM_SEF_TT_LOWER', 'Convierte todos los caracteres a min�scilas en la URL', 'Todo en min�sculas');
define('_COM_SEF_SHOW_SECT', 'Mostrar secci�n');
define('_COM_SEF_TT_SHOW_SECT', 'Def�nelo como S� para incluir el nombre de la secci�n en la URL');
define('_COM_SEF_HIDE_CAT', 'Ocultar Categor�a');
define('_COM_SEF_TT_HIDE_CAT', 'Def�nelo como Si para excluir el nombre de la categor�a en la URL');
define('_COM_SEF_404PAGE', 'P�gina 404');
define('_COM_SEF_TT_404PAGE', 'P�gina de contenido est�tico para uasr con 404 no encontr� errores (si est� publicado o no, no importa)');
// Removed in 1.2.5: define('_COM_SEF_TITLE_ADV', 'Configuraci�n Avanzada del Componente');
define('_COM_SEF_TT_ADV', '<b>manejador por defecto</b><br/>proceso normal, si alguna extensi�n de SEF Advance est� presente se usar�. <br/><b>nocache</b><br/>no gurdar las urls en la base de datos ni crear el estilo antiguo de URLs-SEF<br/><b>skip</b><br/>no usar SEF para este componente<br/>');
define('_COM_SEF_TT_ADV4', 'Opciones avanzadas para ');
define('_COM_SEF_TITLE_MANAGER', 'Administrador de JoomSEF');
define('_COM_SEF_VIEWMODE', 'Modo:');
define('_COM_SEF_SORTBY', 'Ordenar por:');
define('_COM_SEF_HITS', 'Hits');
define('_COM_SEF_DATEADD', 'Fecha');
define('_COM_SEF_SEFURL', 'Url SEF');
define('_COM_SEF_URL', 'Url');
define('_COM_SEF_REALURL', 'Url Real');
define('_COM_SEF_EDIT', 'Editar');
define('_COM_SEF_ADD', 'Agregar');
define('_COM_SEF_NEWURL', 'Nueva URL SEF');
define('_COM_SEF_TT_NEWURL', 'S�lo redirecci�n relativa a la carpeta raiz de Joomla/Mambo <i>sin</i> slash al princio');
define('_COM_SEF_OLDURL', 'Antigua URL no-SEF');
define('_COM_SEF_TT_OLDURL', 'Esta URL debe comezar con index.php');
define('_COM_SEF_SAVEAS', 'Guardar una redirecci�n personalizada');
define('_COM_SEF_TITLE_SUPPORT', 'Soporte para JoomSEF');
define('_COM_SEF_HELPVIA', '<b>La ayuda esta diponisble en los siguientes foros:</b>');
define('_COM_SEF_PAGES', 'Official Product Page');
define('_COM_SEF_FORUM', 'ARTIO Support Forums');
define('_COM_SEF_HELPDESK', 'ARTIO Helpdesk (payed)');
define('_COM_SEF_TITLE_PURGE', 'Purgar base de datos de JoomSEF');
define('_COM_SEF_USE_DEFAULT', '(usar manejador por defecto)');
define('_COM_SEF_NOCACHE', 'sin cach�');
define('_COM_SEF_SKIP', 'Saltar');
define('_COM_SEF_INSTALLED_VERS', 'Versi�n Instalada:');
define('_COM_SEF_COPYRIGHT', 'Derechos de Autor');
define('_COM_SEF_LICENSE', 'Licencia');
define('_COM_SEF_SUPPORT_JOOMSEF', 'Soporta a JoomSEF');
define('_COM_SEF_CONFIG_UPDATED', 'Configuraci�n actualizada');
define('_COM_SEF_WRITE_ERROR', 'Error al escribir la configuraci�n');
define('_COM_SEF_NOACCESS', 'Unable to access');
define('_COM_SEF_FATAL_ERROR_HEADERS', 'FATAL ERRPR: HEADER ALREADY SENT');
define('_COM_SEF_UPLOAD_OK', 'File was successfully uploaded');
define('_COM_SEF_ERROR_IMPORT', 'Error while importing:');
define('_COM_SEF_INVALID_SQL', 'INVALID DATA IN SQL FILE :');
define('_COM_SEF_NO_UNLINK', 'Unable to remove uploaded file from media directory');
define('_COM_SEF_IMPORT_OK', 'Custom URLS were successfully imported!');
define('_COM_SEF_WRITE_FAILED', 'Unable to write uploaded file to media directory');
define('_COM_SEF_EXPORT_FAILED', 'EXPORT FAILED!!!');
define('_COM_SEF_IMPORT_EXPORT', 'Import/Export Custom URLS');
define('_COM_SEF_SELECT_FILE', 'Please select a file first');
define('_COM_SEF_IMPORT', 'Import Custom URLS');
define('_COM_SEF_EXPORT', 'Backup Custom URLS');

// component interface
define('_COM_SEF_NOREAD', 'ERROR FATAL: No se puede leer el archivo ');
define('_COM_SEF_CHK_PERMS', 'Por favor, revisa y aseg�rate de que tu archivo tenga permisos de lectura.');
define('_COM_SEF_DEBUG_DATA_DUMP', 'DEBUG DATA DUMP COMPLETO: Carga de la p�gina terminada');
define('_COM_SEF_STRANGE', 'Algo extra�o ocurri�. Esto no debe ocurrir.<br />');

// new 1.2.5
// Advanced configuration
define('_COM_SEF_TITLE_ADV_CONF', 'Advanced Configuration');
define('_COM_SEF_REPLACEMENTS', 'Non-ascii char replacements');
define('_COM_SEF_TT_REPLACEMENTS', 'define how should non-ascii characters (or strings) be replaced.<br />Format is srcChar1|rplChar1, srcChar2|rplChar2, ...<br />Note that whitespace characters around &quot;,&quot; and &quot;|&quot; separators will be trimmed.');
// JoomFish configuration
define('_COM_SEF_JOOMFISH_CONF', 'JoomFish Related Configuration');
//define('_COM_SEF_JF_LANG_TO_PATH', 'Language as path?');
//define('_COM_SEF_TT_JF_LANG_TO_PATH', 'Sets whether different versions of language contents differ by path or page suffix.');
define('_COM_SEF_JF_ALWAYS_USE_LANG', 'Always use language?');
define('_COM_SEF_TT_JF_ALWAYS_USE_LANG', 'Always include language code in the generated URL.');
define('_COM_SEF_JF_TRANSLATE', 'Translate URLs?');
define('_COM_SEF_TT_JF_TRANSLATE', 'Use JoomFish to translate SEF URLs titles.');
// Component configuration
define('_COM_SEF_TITLE_COM_CONF', 'Component Configuration');

// new 1.3.0
// Admin section URL filters
define('_COM_SEF_FILTERSEF', 'Filter SEF Urls:');
define('_COM_SEF_FILTERSEF_HLP', 'To filter shown URLs by SEF URL, enter part of it into this field and hit ENTER.');
define('_COM_SEF_FILTER404', 'Filter Urls:');
define('_COM_SEF_FILTERREAL', 'Filter Real Urls:');
define('_COM_SEF_FILTERREAL_HLP', 'To filter shown URLs by original URL, enter part of it into this field and hit ENTER.');
define('_COM_SEF_FILTERCOMPONENT', 'Component:');
define('_COM_SEF_FILTERCOMPONENTALL', '(All)');

// Upgrade texts
define('_COM_SEF_TITLE_UPGRADE', 'ARTIO JoomSEF Upgrade Manager');
define('_COM_SEF_TITLE_NEWVERSION', 'Newest version:');
define('_COM_SEF_UPGRADEPACKAGE_HEADER', 'Upload Package File');
define('_COM_SEF_UPGRADEPACKAGE_LABEL', 'Package File:');
define('_COM_SEF_UPGRADEPACKAGE_SUBMIT', 'Upload File &amp; Upgrade');
define('_COM_SEF_UPGRADESERVER_HEADER', 'Upgrade From ARTIO Server');
define('_COM_SEF_UPGRADESERVER_LINKTEXT', 'Upgrade From ARTIO Server');
define('_COM_SEF_UPGRADESERVER_LINKTITLE', 'Upgrade From ARTIO Server');
define('_COM_SEF_UPGRADE_BADPACKAGE', 'This package does not contain any upgrade informations.');
define('_COM_SEF_UPGRADE_BADSOURCE', 'Source not recognized.');
define('_COM_SEF_UPGRADE_CONNECTIONFAILED', 'Could not connect to the server.');
define('_COM_SEF_UPGRADE_SERVERUNAVAILABLE', 'Server not available.');

define('_COM_SEF_CANT_UPGRADE', 'Cannot upgrade.<br />Either your JoomSEF version is up to date or its upgrade is no longer supported.');
define('_COM_SEF_UPGRADE_INVALIDOPERATION', 'Invalid upgrade operation: ');
define('_COM_SEF_UPGRADE_INVALIDFILE', 'Invalid upgrade file: ');
define('_COM_SEF_UPGRADE_SQLERROR', 'Unable to execute SQL query: ');

define('_COM_SEF_URL_TTL', 'URL');
define('_COM_SEF_META_TTL', 'Meta Tags (optional)');
define('_COM_SEF_METATITLE', 'Title:');
define('_COM_SEF_META_INFO', 'Please note that JoomSEF Mambot must be installed and published for meta tag functionality to be working.<br />'
.'To enable generating of the title tag using JoomSEF, make sure "Dynamic Page Title" is set to "Yes" in your Global configuration.<br />'
.'Optionally, you may wish to disable Joomla! standard keyword generation or configure behaviour of JoomSEF MetaBot by editing its settings. For more details, please see help.');
define('_COM_SEF_META_TIP', 'JoomSEF MetaBot Notice');
define('_COM_SEF_METADESCRIPTION', 'Meta Descrition:');
define('_COM_SEF_METAKEYWORDS', 'Meta Keywords:');
define('_COM_SEF_METALANG', 'Meta Content-Language:');
define('_COM_SEF_METAROBOTS', 'Meta Robots:');
define('_COM_SEF_METAGOOGLE', 'Meta Googlebot:');
define('_COM_SEF_TITLE_INFO', 'ARTIO JoomSEF Documentation');

define('_COM_SEF_INSTALL_EXT', 'Install');
define('_COM_SEF_UNINSTALL_EXT', 'Uninstall');
define('_COM_SEF_TITLE_INSTALL_EXT', 'Install SEF Extension');
define('_COM_SEF_TITLE_UNINSTALL_EXT', 'Uninstall SEF Extension');
define('_COM_SEF_TITLE_INSTALL_NEW_EXT', 'Install new SEF Extensions');
define('_COM_SEF_INSTALLED_EXTS', 'Installed SEF Extensions');
define('_COM_SEF_EXTS_INFO', 'Only those SEF extensions that can be uninstalled are displayed - some core extensions cannot be removed.');
define('_COM_SEF_EXT', 'SEF Extension');
define('_COM_SEF_AUTHOR', 'Author');
define('_COM_SEF_VERSION', 'Version');
define('_COM_SEF_DATE', 'Date');
define('_COM_SEF_AUTHOR_EMAIL', 'Author Email');
define('_COM_SEF_AUHTOR_URL', 'Author URL');
define('_COM_SEF_NONE_EXTS', 'There are no uninstallable SEF extensions installed.');

// new 1.3.3
define('_COM_SEF_SHOW3', 'Show All Redirects');
define('_COM_SEF_PURGE_URLS', 'Do you wish to purge automatically created URLs?\n\nNote: You may wish to delete existing auto-created URLs if you have reconfigured the way they should look. This will NOT delete any URLs stored as Custom.');

// new 1.4.0
define('_COM_SEF_EXCLUDE_SOURCE', 'Exclude source info (Itemid)');
define('_COM_SEF_TT_EXCLUDE_SOURCE', 'This will exclude information about link source (Itemid) from URL.<br />This may prevent duplicate URLs, but probably will limit your Joomla! functionality.');
define('_COM_SEF_REAPPEND_SOURCE', 'Reappend source (Itemid)');
define('_COM_SEF_TT_REAPPEND_SOURCE', 'This setting reappends the Itemid to the SEF URL as query parameter.');
define('_COM_SEF_APPEND_NONSEF', 'Append non-SEF variables to URL');
define('_COM_SEF_TT_APPEND_NONSEF', 'Excludes often changing variables from SEF URL and appends them as non-SEF query.<br />This will decrease database usage and also prevent duplicate URLs in some extensions.');

define('_COM_SEF_JF_LANG_PLACEMENT', 'Language integration');
define('_COM_SEF_TT_JF_LANG_PLACEMENT', 'Where to add language constant in the generated URLs. Case "do not add" should be used only when path translation is active.');
define('_COM_SEF_LANG_PATH_TXT', 'include in path');
define('_COM_SEF_LANG_SUFFIX_TXT', 'add as suffix');
define('_COM_SEF_LANG_NONE_TXT', 'do not add');

define('_COM_SEF_UPLOAD_ERROR', 'ERROR UPLOADING FILE');
define('_COM_SEF_UPTODATE', 'Your JoomSEF is up to date.');

// new 1.5.0
define('_COM_SEF_RECORD_404', 'Record 404 page hits?');
define('_COM_SEF_TT_RECORD_404', 'Should we store 404 page hits to DB? Disabling this will descrease the number of SQL queries performed by JoomSEF, however you will not be able to see hits to noexisting pages at your site.');
define('_COM_SEF_TRANSIT_SLASH', 'Be tolerant to trailing slash?');
define('_COM_SEF_TT_TRANSIT_SLASH', 'Do we accept both URLs that do or do not end with trainling slash valid?');

// new 2.0.0
define('_COM_SEF_LANG_DOMAIN_TXT', 'use different domains');
define('_COM_SEF_JF_DOMAIN', 'Domain configuration');
define('_COM_SEF_TT_JF_DOMAIN', 'Define the live site for each language (without the trailing slash).');
define('_COM_SEF_ALT_DOMAIN', 'Alternative live sites');
define('_COM_SEF_TT_ALT_DOMAIN', 'List of alternative live site domains (and paths) (different than your site domain in configuration), that JoomSEF should also accept (use e.g. when your SSL-secured domain is different than the original one or on special configurations). More entries need to be separated by comma.');

define('_COM_SEF_INSTALLED_PATCHES', 'Installed SEF Patches');
define('_COM_SEF_PATCHES_INFO', "You can manage SEF Patches using standard Joomla! Mambot system. Don't forget to publish those patches you want to use.");
define('_COM_SEF_PATCH', 'SEF Patch');
define('_COM_SEF_NONE_PATCHES', 'There are no SEF Patches installed.');

define('_COM_SEF_EDIT_EXT', 'Edit');
define('_COM_SEF_TITLE_EDIT_EXT', 'Edit SEF Extension');
define('_COM_SEF_ADV_HANDLING', 'Handling');
define('_COM_SEF_ADV_TITLE', 'Custom title');
define('_COM_SEF_TT_ADV_TITLE', 'Overrides the default menu title in URL. Leave blank for default behaviour.');
define('_COM_SEF_DELETE_FILTER', 'Delete All Filtered');
define('_COM_SEF_TITLE_DELETE_FILTER', 'Deletes all URLs matching the filters.');
define('_COM_SEF_DELETE_FILTER_QUESTION', 'Are you sure you want to delete all the URLs matching selected filters? (All pages will be deleted.)');
define('_COM_SEF_IGNORE_SOURCE', 'Ignore multiple sources (Itemids)');
define('_COM_SEF_TT_IGNORE_SOURCE', 'When selected, only one URL will be generated for every page, even when there is more than one Itemid pointing to it.');
define('_COM_SEF_USE_CACHE', 'Use cache?');
define('_COM_SEF_TT_USE_CACHE', 'If set to Yes, URLs will be saved to cache so less queries will be made to database.');
define('_COM_SEF_CACHE_SIZE', 'Maximum cache size:');
define('_COM_SEF_TT_CACHE_SIZE', 'How many URLs can be saved in cache.');
define('_COM_SEF_CACHE_MINHITS', 'Minimum cache hits count:');
define('_COM_SEF_TT_CACHE_MINHITS', 'How many hits must URL have to be saved in cache.');
define('_COM_SEF_CLEAN_CACHE', 'Clean Cache');
define('_COM_SEF_TITLE_CLEAN_CACHE', 'Cleans the cache of URLs.');
define('_COM_SEF_CLEAN_CACHE_QUESTION', 'Cleaning the cache is recommended every time you change the setting of the cache or you edit any of your custom URLs. Are you sure you want to clean the cache?');

define('_COM_SEF_EXTUPGRADE_TITLE', 'SEF Extensions');
define('_COM_SEF_NOTAVAILABLE', 'Not available');
define('_COM_SEF_PARAMETERS', 'Parameters');
define('_COM_SEF_DESCRIPTION', 'Description');
define('_COM_SEF_NAME', 'Name');
define('_COM_SEF_CACHE_CONF', 'Cache Configuration');
define('_COM_SEF_ITEMID', 'Itemid');
define('_COM_SEF_TT_ITEMID', 'Menu item associated with this URL.');

define('_COM_SEF_NONSEFREDIRECT', 'Redirect nonSEF URLs to SEF?');
define('_COM_SEF_TT_NONSEFREDIRECT', 'When someone types nonSEF URL in his browser he will be redirected to its SEF equivalent with Moved Permanently header.');

define('_COM_SEF_USEMOVED', 'Use Moved Permanently redirection table?');
define('_COM_SEF_TT_USEMOVED', 'When you change the SEF url, it can be saved to redirection table and will remain working with Moved Permanently header.');
define('_COM_SEF_USEMOVEDASK', 'Ask before saving URL to Moved Permanently table?');
define('_COM_SEF_TT_USEMOVEDASK', 'If set to No, URL will be saved automatically anytime you change it.');
define('_COM_SEF_VIEW301DESC', 'View/Edit Moved Permanently Redirects');
define('_COM_SEF_VIEW301', 'View/Edit 301 Urls');
define('_COM_SEF_PURGE301DESC', 'Purge Moved Permanently Redirects');
define('_COM_SEF_PURGE301', 'Purge 301 Urls');

define('_COM_SEF_301OLDURL', 'Moved from URL');
define('_COM_SEF_301NEWURL', 'Moved to URL');
define('_COM_SEF_TT_301OLDURL', 'This is URL to redirect from.');
define('_COM_SEF_TT_301NEWURL', 'This is URL to redirect to.');

define('_COM_SEF_DAYS', 'Last used');
define('_COM_SEF_FILTEROLD_HLP', 'To filter shown URLs by Moved from URL, enter part of it into this field and hit ENTER.');
define('_COM_SEF_FILTERNEW_HLP', 'To filter shown URLs by Moved to URL, enter part of it into this field and hit ENTER.');
define('_COM_SEF_FILTEROLD', 'Filter Moved from URL:');
define('_COM_SEF_FILTERNEW', 'Filter Moved to URL:');
define('_COM_SEF_FILTERDAY', 'Not used for (days):');
define('_COM_SEF_NEVER', 'Never');

define('_COM_SEF_CACHECLEANED', 'Cache Cleaned');
define('_COM_SEF_CONFIRM301', 'Your SEF link has changed. Do you wish to save the old one to Moved Permanently redirection table so it will be still working?');

define('_COM_SEF_DISABLENEWSEF', 'Disable creation of new SEF URLs?');
define('_COM_SEF_TT_DISABLENEWSEF', 'If set to yes, no new URLs will be generated and only those already in database will be used.');
define('_COM_SEF_DONTSHOWTITLE', 'Do not show menu title in URL');
define('_COM_SEF_TT_DONTSHOWTITLE', 'If checked, the menu title will not be present in URL at all (except the direct link to component).');
define('_COM_SEF_SHOW4', 'Show Links to Homepage');
define('_COM_SEF_REINSTALL', 'You have uploaded the package with same version as your current JoomSEF, reinstall instead of upgrade has been initiated.');

define('_COM_SEF_DONTREMOVESID', 'Do not remove SID from SEF URL?');
define('_COM_SEF_TT_DONTREMOVESID', 'If set to yes, the sid variable will not be removed from SEF URL. This may help some components to work properly, but also can create duplicates with some others.');
?>
