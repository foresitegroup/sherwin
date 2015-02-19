<?php
/**
 * SEF module for Joomla!
 *
 * @author      $Author: michal $
 * @copyright   ARTIO s.r.o., http://www.artio.cz
 * @package     JoomSEF
 * @version     $Name$, ($Revision: 4994 $, $Date: 2005-11-03 20:50:05 +0100 (??t, 03 XI 2005) $)
 * 
 * Translation provided by: J-F Bohémier [jf@bohemier.com]
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

// admin interface
define('_COM_SEF_CONFIG', 'Configuration<br />d\'ARTIO JoomSEF');
define('_COM_SEF_CONFIGDESC', 'Configurer toutes les fonctionnalit�s d\'ARTIO JoomSEF');
define('_COM_SEF_HELP', 'ARTIO JoomSEF<br />Aide');
define('_COM_SEF_HELPDESC', 'Avez vous besoin d\'aide avec ARTIO JoomSEF?');
define('_COM_SEF_INFO', 'ARTIO JoomSEF<br />Documentation');
define('_COM_SEF_INFODESC', 'Afficher le sommaire et la documentation du projet ARTIO JoomSEF');
define('_COM_SEF_VIEWURL', 'Afficher/Editer<br />Les Urls SEF');
define('_COM_SEF_VIEWURLDESC', 'Afficher/Editer les Urls SEF');
define('_COM_SEF_VIEW404', 'Afficher/Editer<br />Le Logs des erreurs 404');
define('_COM_SEF_VIEW404DESC', 'Afficher/Editer le Logs des erreurs 404');
define('_COM_SEF_VIEWCUSTOM', 'Afficher/Editer<br />Les redirections personalis�es');
define('_COM_SEF_VIEWCUSTOMDESC', 'Afficher/Editer les redirections personalis�es');
define('_COM_SEF_SUPPORT', 'Site Web<br />de support');
define('_COM_SEF_SUPPORTDESC', 'Connectez-vous au site Web d\'ARTIO JoomSEF (dans une nouvelle fen�tre)');
define('_COM_SEF_BACK', 'Retourner au panneau de configuration d\'ARTIO JoomSEF');
define('_COM_SEF_PURGEURL', 'Purger<br />les Urls SEF');
define('_COM_SEF_PURGEURLDESC', 'Purger les Urls SEF');
define('_COM_SEF_PURGE404', 'Purger<br />les Logs 404');
define('_COM_SEF_PURGE404DESC', 'Purger les Logs 404');
define('_COM_SEF_PURGECUSTOM', 'Purger<br />Les redirections personalis�es');
define('_COM_SEF_PURGECUSTOMDESC', 'Purger les redirections personalis�es');
define('_COM_SEF_WARNDELETE', 'ATTENTION!!!<br />Vous �tes sur le point de supprimer ');
define('_COM_SEF_RECORD', ' une entr�e');
define('_COM_SEF_RECORDS', ' des entr�es');
define('_COM_SEF_NORECORDS', 'Aucune entr�e trouv�e.');
define('_COM_SEF_PROCEED', ' D�marrer le processus ');
define('_COM_SEF_OK', ' OK ');
define('_COM_SEF_SUCCESSPURGE', 'Entr�es supprim�es avec succ�s');
define('_PREVIEW_CLOSE', 'Fermer cette fen�tre');
define('_COM_SEF_EMPTYURL', 'Vous devez fournir une URL pour la redirection.');
define('_COM_SEF_NOLEADSLASH', 'La nouvelle URL SEF ne devrait pas commencer par un "SLASH"');
define('_COM_SEF_BADURL', 'Une ancienne Url Non-SEF doit commencer par index.php');
define('_COM_SEF_URLEXIST', 'Cette URL existe d�j� dans la base de donn�e!');
define('_COM_SEF_SHOW0', 'Afficher les Urls SEF');
define('_COM_SEF_SHOW1', 'Afficher le fichier log 404');
define('_COM_SEF_SHOW2', 'Afficher les redirections personnalis�es');
define('_COM_SEF_INVALID_URL', 'URL INVALIDE : ce lien exige un Itemid valide non trouv�.<br />SOLUTION : Cr�er un menuitem pour cet article. Vous ne devez pas le publier, juste le cr�er.');
define('_COM_SEF_DEF_404_MSG', '<h1>Erreur 404: adresse non trouv�</h1><h4>D�sol�, mais le contenu que vous avez demand� n\'a pas pu �tre trouv�</h4>');
define('_COM_SEF_SELECT_DELETE', 'Choisir un article � supprimer');
define('_COM_SEF_ASC', ' (asc) ');
define('_COM_SEF_DESC', ' (desc) ');
define('_COM_SEF_WRITEABLE', ' <b><font color="green">Writeable</font></b>');
define('_COM_SEF_UNWRITEABLE', ' <b><font color="red">Unwriteable</font></b>');
define('_COM_SEF_USING_DEFAULT', ' <b><font color="red">Utliser les param�tres par d�fauts</font></b>');
define('_COM_SEF_DISABLED',"<p class='error'>NOTE: Le support SEF dans Joomla/Mambo est actuellement d�activ�. Pour l\'utiliser , il faut l'activer dans la page SEO de la <a href='"
.$GLOBALS['mosConfig_live_site']."/administrator/index2.php?option=com_config'>Configuration Globale</a>.</p>");
define('_COM_SEF_TITLE_CONFIG', 'Configuration d\'ARTIO JoomSEF Configuration');
define('_COM_SEF_TITLE_BASIC', 'Configuration de Base');
define('_COM_SEF_ENABLED', 'Activer');
define('_COM_SEF_TT_ENABLED', 'Si vous r�pondez non le gestionnaire par d�faut de SEF de Joomla/Mambo sera utilis�');
define('_COM_SEF_DEF_404_PAGE', 'Page d\'erreur 404 par d�faut');
define('_COM_SEF_REPLACE_CHAR', 'Caract�re de remplacement');
define('_COM_SEF_TT_REPLACE_CHAR', 'Caract�re � utiliser pour remplacer les caract�res inconnus dans l\\\'URL');
define('_COM_SEF_PAGEREP_CHAR', 'Caract�re de sp�ration de page');
define('_COM_SEF_TT_PAGEREP_CHAR', 'Caract�re � utiliser pour s�parer le num�ro de la page du reste de l\\\'URL');
define('_COM_SEF_STRIP_CHAR', 'Caract�res � supprimer');
define('_COM_SEF_TT_STRIP_CHAR', 'Caract�res � supprimer de l\\\'URL, les s�parer par |');
define('_COM_SEF_FRIENDTRIM_CHAR', 'Caract�res � �quilibrer logiquement');
define('_COM_SEF_TT_FRIENDTRIM_CHAR', 'Caract�res � �quilibrer logiquement dans l\\\'URL (ex: pas deux -- cons�cutifs, les s�parer par |');
define('_COM_SEF_USE_ALIAS', 'Utiliser l\\\'alias du titre');
define('_COM_SEF_TT_USE_ALIAS', 'R�pondre oui si vous d�sirez utiliser l\\\'alias du titre dans l\\\'URL');
define('_COM_SEF_SUFFIX', 'Extension des fichiers');
define('_COM_SEF_TT_SUFFIX', 'Extension � utiliser pour les \\\'fichiers\\\'. Laissez-le vide pour le d�sactiver. La configuration classique ici est \\\'html\\\'.');
define('_COM_SEF_ADDFILE', 'Fichier index par d�faut.');
define('_COM_SEF_TT_ADDFILE', 'Nom de fichier � placer apr�s une URL vide / quand le fichier n\\\'existe pas. Utile pour les plugins qui recherchent un fichier � un endroit sp�cifique mais qui renvoient des erreurs 404 parce qu\\\'il n\\\'y en a aucun l�.');
define('_COM_SEF_PAGETEXT', 'Texte de page');
define('_COM_SEF_TT_PAGETEXT', 'Texte � d�finir pour l\\\'URL pour les pages multiples. Utiliser %s pour ins�rer le num�ro de page, par d�faut il est � la fin. Si un suffixe est d�fini, il peut �tre ajout� � la fin du texte.');
define('_COM_SEF_LOWER', 'Tout en minuscule');
define('_COM_SEF_TT_LOWER', 'Convertir tous les caract�res en minuscule dans l\\\'Url', 'Tout en minuscule');
define('_COM_SEF_SHOW_SECT', 'Afficher la section');
define('_COM_SEF_TT_SHOW_SECT', 'R�pondre oui pour inclure la section dans l\\\'Url');
define('_COM_SEF_HIDE_CAT', 'Cacher la cat�gorie');
define('_COM_SEF_TT_HIDE_CAT', 'R�pondre oui pour exclure le nom de la cat�gorie dans l\\\'Url');
define('_COM_SEF_404PAGE', 'Page d\'erreur 404');
define('_COM_SEF_TT_404PAGE', 'Page statique � utiliser pour les erreurs 404, page non trouv� (Peut-�tre publi� � tout moment)');
//Removed 1.2.5: define('_COM_SEF_TITLE_ADV', 'Advanced Component Configuration');
define('_COM_SEF_TT_ADV', '<b>Utiliser le gestionnaire par d�faut</b><br/>Proc�d� normal, si une extension avanc�e de SEF est pr�sente elle sera utilis�e. <br/><b>sans cache</b><br/>n\\\'ai pas enregistr� dans la BD et utilise le mod�le de standard d\\\'URLS SEF de Joomla/Mambot<br/><b>ne rien faire</b><br/>ne pas faire d\\\'urls SEF pour ce composant<br/>');
define('_COM_SEF_TT_ADV4', 'Options avanc�es pour ');
define('_COM_SEF_TITLE_MANAGER', 'Gestionnaire d\'URL d\'ARTIO JoomSEF');
define('_COM_SEF_VIEWMODE', 'ViewMode:');
define('_COM_SEF_SORTBY', 'Trier par:');
define('_COM_SEF_HITS', 'Hits');
define('_COM_SEF_DATEADD', 'Date d\'ajout');
define('_COM_SEF_SEFURL', 'Url SEF');
define('_COM_SEF_URL', 'Url');
define('_COM_SEF_REALURL', 'Url R�elle ');
define('_COM_SEF_EDIT', 'Editer');
define('_COM_SEF_ADD', 'Ajouter');
define('_COM_SEF_NEWURL', 'Nouvelle URL SEF');
define('_COM_SEF_TT_NEWURL', 'Seules les redirections relatives � partir du r�pertoire racine de Joomla/mambo <i>sans</i> slash sont possibles');
define('_COM_SEF_OLDURL', 'Ancienne Url Non-SEF');
define('_COM_SEF_TT_OLDURL', 'Cette URL doit commencer par index.php');
define('_COM_SEF_SAVEAS', 'Sauvegarder les redirections adapt�es');
define('_COM_SEF_TITLE_SUPPORT', 'Support d\'ARTIO JoomSEF');
define('_COM_SEF_HELPVIA', '<b>L\'aide est utilisable par le Forum suivant :</b>');
define('_COM_SEF_PAGES', 'Official Product Page');
define('_COM_SEF_FORUM', 'ARTIO Support Forums');
define('_COM_SEF_HELPDESK', 'ARTIO Helpdesk (payed)');
define('_COM_SEF_TITLE_PURGE', 'Purger la base de donn�e d\'ARTIO JoomSEF');
define('_COM_SEF_USE_DEFAULT', '(utiliser le gestionnaire par d�faut)');
define('_COM_SEF_NOCACHE', 'sans cache');
define('_COM_SEF_SKIP', 'ne rien faire');
define('_COM_SEF_INSTALLED_VERS', 'Version install�:');
define('_COM_SEF_COPYRIGHT', 'Copyright');
define('_COM_SEF_LICENSE', 'License');
define('_COM_SEF_SUPPORT_JOOMSEF', 'Support us');
define('_COM_SEF_CONFIG_UPDATED', 'Configuration mise � jour');
define('_COM_SEF_WRITE_ERROR', 'Erreur d\'�criture, de configuration');
define('_COM_SEF_NOACCESS', 'Impossible d\'acc�der');
define('_COM_SEF_FATAL_ERROR_HEADERS', 'ERREUR FATALE: L\'EN-T�TE A D�J� �T� ENVOY�E');
define('_COM_SEF_UPLOAD_OK', 'Le fichier a �t� t�l�charg� avec succ�s');
define('_COM_SEF_ERROR_IMPORT', 'Erreur d\'importationtout :');
define('_COM_SEF_INVALID_SQL', 'DONNEES INVALIDE DANS LE FICHIER SQL :');
define('_COM_SEF_NO_UNLINK', 'Impossible de supprimer le fichier du dossier media');
define('_COM_SEF_IMPORT_OK', 'Les URLS adapt�es ont �t� import�es avec succ�s!');
define('_COM_SEF_WRITE_FAILED', 'Impossible d\'�crire le fichier t�l�charg� dans le dossier media');
define('_COM_SEF_EXPORT_FAILED', 'ERREUR D\'EXPORTATION !!!');
define('_COM_SEF_IMPORT_EXPORT', 'Import/Export des URLS adapt�es');
define('_COM_SEF_SELECT_FILE', 'Veuillez choisir un fichier d\'abord');
define('_COM_SEF_IMPORT', 'Import des URLS adapt�es');
define('_COM_SEF_EXPORT', 'Backup des URLS adapt�es');

// component interface
define('_COM_SEF_NOREAD', 'ERREUR FATALE: Impossible de lire le fichier ');
define('_COM_SEF_CHK_PERMS', 'S.V.P., controllez vos permissions sur les fichiers et assurez-vous que le fichier peut-�tre lu.');
define('_COM_SEF_DEBUG_DATA_DUMP', 'DEBUG DATA DUMP COMPLETE: Le chargement de la page est termin�');
define('_COM_SEF_STRANGE', 'Quelque chose d\'�trange est arriv�. Ceci ne devrait pas se reproduire<br />');

// temporary
define('_COM_SEF_FULL_TITLE', 'Titre complet');
define('_COM_SEF_TITLE_ALIAS', 'Alias du titre');
define('_COM_SEF_SHOW_CAT', 'Afficher la cat�gorie');

// new 1.2.5
// Advanced configuration
define('_COM_SEF_TITLE_ADV_CONF', 'Configuration avanc�e');
define('_COM_SEF_REPLACEMENTS', 'Remplacement des caract�res NON-ASCII');
define('_COM_SEF_TT_REPLACEMENTS', 'D�finir comment les caract�res non-ascii (ou du texte) doivent �tre remplac�s.<br />Le Format est srcChar1|rplChar1, srcChar2|rplChar2, ...<br />Noter que les caract�res espaces autour des s�prateurs suivant &quot;,&quot; et &quot;|&quot; seront supprim�s.');
// JoomFish configuration
define('_COM_SEF_JOOMFISH_CONF', 'Configuration relative � JoomFish');
define('_COM_SEF_JF_LANG_TO_PATH', 'Utilisation de la langue comme chemin?');
define('_COM_SEF_TT_JF_LANG_TO_PATH', 'Activ� si les versions de langues ont un suffixe de page ou un chemin diff�rent.');
define('_COM_SEF_JF_ALWAYS_USE_LANG', 'Toujours utiliser la langue?');
define('_COM_SEF_TT_JF_ALWAYS_USE_LANG', 'Toujours inclure le code de langue dans l\'URL g�n�r�e.');
define('_COM_SEF_JF_TRANSLATE', 'Traduire les URLs?');
define('_COM_SEF_TT_JF_TRANSLATE', 'Utiliser JoomFish pour traduire le titre des URLs SEF.');
// Component configuration
define('_COM_SEF_TITLE_COM_CONF', 'Configuration des composants');

// new 1.3.0
// Admin section URL filters
define('_COM_SEF_FILTERSEF', 'Filter SEF Urls:');
define('_COM_SEF_FILTERSEF_HLP', 'To filter shown URLs by SEF URL, enter part of it into this field and hit ENTER.');
define('_COM_SEF_FILTER404', 'Filter Urls:');
define('_COM_SEF_FILTERREAL', 'Filter Real Urls:');
define('_COM_SEF_FILTERREAL_HLP', 'To filter shown URLs by original URL, enter part of it into this field and hit ENTER.');
define('_COM_SEF_FILTERCOMPONENT', 'Component:');
define('_COM_SEF_FILTERCOMPONENTALL', '(All)');;

// Upgrade texts
define('_COM_SEF_UPGRADE', 'Mise � jour');
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
