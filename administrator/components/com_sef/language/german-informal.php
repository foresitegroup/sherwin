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
define('_COM_SEF_CONFIG', 'ARTIO JoomSEF<br/>Konfiguration');
define('_COM_SEF_CONFIGDESC', 'Konfiguriere alle ARTIO JoomSEF Einstellungen');
define('_COM_SEF_HELP', 'ARTIO JoomSEF<br/>Hilfe');
define('_COM_SEF_HELPDESC', 'Brauchst du Hilfe mit ARTIO JoomSEF?');
define('_COM_SEF_INFO', 'ARTIO JoomSEF<br/>Dokumentation');
define('_COM_SEF_INFODESC', 'Betrachte JOOMSEF Projekt Zusammenfassung und Dokumentation');
define('_COM_SEF_VIEWURL', 'Ansehen/Bearbeiten<br/> der SEF Urls');
define('_COM_SEF_VIEWURLDESC', 'Ansehen/Bearbeiten der SEF Urls');
define('_COM_SEF_VIEW404', 'Ansehen/Bearbeiten<br/>der 404 Logs');
define('_COM_SEF_VIEW404DESC', 'Ansehen/Bearbeiten der 404 Logs');
define('_COM_SEF_VIEWCUSTOM', 'Ansehen/Bearbeiten<br/>Eigener Umleitungen(Redirects)');
define('_COM_SEF_VIEWCUSTOMDESC', 'Ansehen/Bearbeiten Eigener Umleitungen(Redirects)');
define('_COM_SEF_SUPPORT', 'Support<br/>Homepage');
define('_COM_SEF_SUPPORTDESC', 'Verbinde dich zur ARTIO JoomSEF Homepage (neues Fenster)');
define('_COM_SEF_BACK', 'Zur&uuml;ck zur ARTIO JoomSEF Konfigurations&uuml;bersicht');
define('_COM_SEF_PURGEURL', 'SEF Urls<br/>l&ouml;schen');
define('_COM_SEF_PURGEURLDESC', 'SEF Urls l&ouml;schen');
define('_COM_SEF_PURGE404', '404 Logs <br/>l&ouml;schen');
define('_COM_SEF_PURGE404DESC', '404 Logs l&ouml;schen');
define('_COM_SEF_PURGECUSTOM', 'Eigene Umleitungen<br/>l&ouml;schen');
define('_COM_SEF_PURGECUSTOMDESC', 'Eigene Umleitungen l&ouml;schen');
define('_COM_SEF_WARNDELETE', 'Achtung!!!<br/>Du bist dabei etwas zu l&ouml;schen: ');
define('_COM_SEF_RECORD', ' Eintrag');
define('_COM_SEF_RECORDS', ' Eintr&auml;ge');
define('_COM_SEF_NORECORDS', 'Keine Eintr&auml;ge gefunden.');
define('_COM_SEF_PROCEED', ' Vorgang Starten ');
define('_COM_SEF_OK', ' OK ');
define('_COM_SEF_SUCCESSPURGE', 'Eintr&auml;ge erfolgreich gel&ouml;scht');
define('_PREVIEW_CLOSE', 'Fenster Schliessen');
define('_COM_SEF_EMPTYURL', 'Du musst eine URL f&uuml;er die Umleitung angeben.');
define('_COM_SEF_NOLEADSLASH', 'Da sollte kein vorangehender "SLASH" an der neuen SEF URL sein');
define('_COM_SEF_BADURL', 'Die alte Nicht-SEF Url muss mit index.php beginnen');
define('_COM_SEF_URLEXIST', 'Diese URL existiert bereits in der Datenbank!');
define('_COM_SEF_SHOW0', 'Zeige SEF Urls');
define('_COM_SEF_SHOW1', 'Zeige 404 Logs');
define('_COM_SEF_SHOW2', 'Zeige Eigene Umleitungen');
define('_COM_SEF_INVALID_URL', 'INVALIDE URL: dieser Link ben&ouml;tigt ein valides Itemid,aber es wurde keins gefunden.<br/>L&ouml;sung: Erstelle einen Men&uuml;eintrag f&uuml; diesen Artikel. Du brauchst ihn nicht zu ver&ouml;ffentlichen, es reicht dass der Eintrag existiert.');
define('_COM_SEF_DEF_404_MSG', '<h1>404: Nicht gefunden</h1><h4>Entschuldigung, aber die angeforderte Seite konnte nicht gefunden werden.</h4>');
define('_COM_SEF_SELECT_DELETE', 'Bitte etwas zum l&ouml;schen ausw&auml;hlen');
define('_COM_SEF_ASC', ' (aufsteigend) ');
define('_COM_SEF_DESC', ' (absteigend) ');
define('_COM_SEF_WRITEABLE', ' <b><font color="green">Beschreibbar</font></b>');
define('_COM_SEF_UNWRITEABLE', ' <b><font color="red">Nicht beschreibbar</font></b>');
define('_COM_SEF_USING_DEFAULT', ' <b><font color="red">Benutze Standard Werte</font></b>');
define('_COM_SEF_DISABLED',"<p class='error'>NOTIZ: Die SEF Unterst&uuml;tzung in Joomla/Mambo ist momentan deaktiviert. Um SEF zu benutzen, aktiviere es bitte in der <a href='"
.$GLOBALS['mosConfig_live_site']."/administrator/index2.php?option=com_config'>Globalen Konfiguration</a> auf der SEO Seite.</p>");
define('_COM_SEF_TITLE_CONFIG', 'ARTIO JoomSEF Konfiguration');
define('_COM_SEF_TITLE_BASIC', 'Standard Konfiguration');
define('_COM_SEF_ENABLED', 'Aktiviert');
define('_COM_SEF_TT_ENABLED', 'Wenn auf NEIN wird Standard Joomla/Mambo SEF benutzt');
define('_COM_SEF_DEF_404_PAGE', '<b>Standard 404 Seite</b><br>');
define('_COM_SEF_REPLACE_CHAR', 'Ersetzungs Zeichen');
define('_COM_SEF_TT_REPLACE_CHAR', 'Zeichen um unbekannte Zeichen in der URL zu ersetzen');
define('_COM_SEF_PAGEREP_CHAR', 'Page spacer character');
define('_COM_SEF_TT_PAGEREP_CHAR', 'Character to use to space page numbers away from the rest of the URL');
define('_COM_SEF_STRIP_CHAR', 'Strip characters');
define('_COM_SEF_TT_STRIP_CHAR', 'Characters to strip from the URL, separate with |');
define('_COM_SEF_FRIENDTRIM_CHAR', 'Trim friendly characters');
define('_COM_SEF_TT_FRIENDTRIM_CHAR', 'Characters to trim from around the URL, separate with |');
define('_COM_SEF_USE_ALIAS', 'Benutze Titel Alias');
define('_COM_SEF_TT_USE_ALIAS', 'Auf Ja stellen, um den Titel-Alias anstatt des richtigen Titels in der URL zu verwenden');
define('_COM_SEF_SUFFIX', 'Dateiendung');
define('_COM_SEF_TT_SUFFIX', 'Erweiterung f&uuml;r \\\'Dateien\\\'. Leer lassen um es zu deaktivieren. Ein h&auml;ufiger Eintrag ist z.B. \\\'.html\\\'.');
define('_COM_SEF_ADDFILE', 'Default index file');
define('_COM_SEF_TT_ADDFILE', 'File name to place after a blank url / when no file exists.  Useful for bots that crawl your site looking for a specific file in that place but returns a 404 because there is none there.');
define('_COM_SEF_PAGETEXT', 'Seiten Text');
define('_COM_SEF_TT_PAGETEXT', 'Text der an die URL angehangen wird bei mehrseitigen Dokumenten. Die Seitennummer wird duch %s dargestellt.');
define('_COM_SEF_LOWER', 'Nur Kleinbuchstaben');
define('_COM_SEF_TT_LOWER', 'Konvertiert alle Zeichen zu Kleinbuchstaben in der URL', 'Nur Kleinbuchstaben');
define('_COM_SEF_SHOW_SECT', 'Zeige Sektion');
define('_COM_SEF_TT_SHOW_SECT', 'Auf Ja stellen um den Sektions-Namen in die URL mit aufzunehmen');
define('_COM_SEF_HIDE_CAT', 'Kategorie verbergen');
define('_COM_SEF_TT_HIDE_CAT', 'Auf Ja stellen um den Kategorie-Namen aus der URL zu entfernen');
define('_COM_SEF_404PAGE', '404 Seite');
define('_COM_SEF_TT_404PAGE', 'Statische Content Seite die beim Fehler 404 Nicht gefunden angezeigt wird (published Status ist egal)');
// Removed in 1.2.5: define('_COM_SEF_TITLE_ADV', 'Erweiterte Komponenten Konfiguration');
define('_COM_SEF_TT_ADV', '<b>use default handler</b><br/>Die Seite wird normal bearbeitet. <br/><b>nocache</b><br/>Wird nicht in der DB gesichert, verwendet Joomla/Mambos Standard SEF<br/><b>Skip</b><br/>Keine SEF Urls f&uuml;r diese Komponente<br/>');
define('_COM_SEF_TT_ADV4', 'Erweiterte Optionen f&uuml;r ');
define('_COM_SEF_TITLE_MANAGER', 'JoomSEF URL Manager');
define('_COM_SEF_VIEWMODE', 'Ansichtsmodus:');
define('_COM_SEF_SORTBY', 'Sortieren nach:');
define('_COM_SEF_HITS', 'Zugriffe');
define('_COM_SEF_DATEADD', 'Datum hinzugef&uuml;gt');
define('_COM_SEF_SEFURL', 'SEF Url');
define('_COM_SEF_URL', 'Url');
define('_COM_SEF_REALURL', 'Reale Url');
define('_COM_SEF_EDIT', 'Bearbeiten');
define('_COM_SEF_ADD', 'Hinzuf&uuml;gen');
define('_COM_SEF_NEWURL', 'Neue SEF URL');
define('_COM_SEF_TT_NEWURL', 'Nur Relative Umleitung vom Joomla/Mambo Root Verzeichnis <i>ohne</i> vorangehenden SLASH');
define('_COM_SEF_OLDURL', 'Alte Nicht-SEF Url');
define('_COM_SEF_TT_OLDURL', 'Diese URL muss mit index.php beginnen');
define('_COM_SEF_SAVEAS', 'als Eigene Umleitung speichern');
define('_COM_SEF_TITLE_SUPPORT', 'JoomSEF Hilfe');
define('_COM_SEF_PAGES', 'Official Product Page');
define('_COM_SEF_FORUM', 'ARTIO Support Forums');
define('_COM_SEF_HELPDESK', 'ARTIO Helpdesk (payed)');
define('_COM_SEF_TITLE_PURGE', 'ARTIO JoomSEF Purge Database');
define('_COM_SEF_USE_DEFAULT', '(use default handler)');
define('_COM_SEF_NOCACHE', 'nocache');
define('_COM_SEF_SKIP', 'skip');
define('_COM_SEF_INSTALLED_VERS', 'Installed version:');
define('_COM_SEF_COPYRIGHT', 'Copyright');
define('_COM_SEF_LICENSE', 'License');
define('_COM_SEF_SUPPORT_JOOMSEF', 'Support us');
define('_COM_SEF_CONFIG_UPDATED', 'Configuration updated');
define('_COM_SEF_WRITE_ERROR', 'Error writing config');
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
define('_COM_SEF_NOREAD', 'FATALER FEHLER: Datei kann nicht gelesen werden ');
define('_COM_SEF_CHK_PERMS', 'Bitte &uuml;berpruefe die Datei Berechtigungen und stelle sicher, dass auf die Datei zugegriffen werden kann.');
define('_COM_SEF_DEBUG_DATA_DUMP', 'DEBUG DATA DUMP COMPLETE: Laden der Seite abgebrochen');
define('_COM_SEF_STRANGE', 'Etwas seltsames ist passiert. Das sollte nicht vorkommen<br />');

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
