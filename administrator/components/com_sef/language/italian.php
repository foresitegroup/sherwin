<?php
/**
 * SEF module for Joomla!
 *
 * @author      $Author: michal $
 * @copyright   ARTIO s.r.o., http://www.artio.cz
 * @package     JoomSEF
 * @version     $Name$, ($Revision: 4994 $, $Date: 2005-11-03 20:50:05 +0100 (??t, 03 XI 2005) $)
 * 
 * Translation provided by: Marco Napolitano, AllOne.it Consulting [info@allone.it]
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

// admin interface
define('_COM_SEF_CONFIG', 'Configurazione<br/> di ARTIO JoomSEF');
define('_COM_SEF_CONFIGDESC', 'Configura  tutte le funzionalit� di ARTIO JoomSEF');
define('_COM_SEF_HELP', 'Supporto <br/>di ARTIO JoomSEF');
define('_COM_SEF_HELPDESC', 'Serve aiuto con ARTIO JoomSEF?');
define('_COM_SEF_INFO', 'Documentazione<br/>di ARTIO JoomSEF');
define('_COM_SEF_INFODESC', 'Vedi Sommario e Documentazione del progetto ARTIO JoomSEF');
define('_COM_SEF_VIEWURL', 'Vedi/Modifica<br/>SEF Urls');
define('_COM_SEF_VIEWURLDESC', 'Vedi/Modifica SEF Urls');
define('_COM_SEF_VIEW404', 'Vedi/Modifica<br/>404 Logs');
define('_COM_SEF_VIEW404DESC', 'Vedi/Modifica 404 Logs');
define('_COM_SEF_VIEWCUSTOM', 'Vedi/Modifica<br/>Reindirizzamenti personalizzati');
define('_COM_SEF_VIEWCUSTOMDESC', 'Vedi/Modifica Reindirizzamenti personalizzati');
define('_COM_SEF_SUPPORT', 'Sito<br/>di supporto');
define('_COM_SEF_SUPPORTDESC', 'Apri il sito ufficiale di ARTIO JoomSEF (in una nuova finestra)');
define('_COM_SEF_BACK', 'Torna al pannello di controllo di ARTIO JoomSEF');
define('_COM_SEF_PURGEURL', 'Sfoltisci<br/>SEF Urls');
define('_COM_SEF_PURGEURLDESC', 'Sfoltisci SEF Urls');
define('_COM_SEF_PURGE404', 'Sfoltisci<br/>404 Logs');
define('_COM_SEF_PURGE404DESC', 'Sfoltisci 404 Logs');
define('_COM_SEF_PURGECUSTOM', 'Sfoltisci<br/>Reindirizzamenti personalizzati');
define('_COM_SEF_PURGECUSTOMDESC', 'Sfoltisci Reindirizzamenti personalizzati');
define('_COM_SEF_WARNDELETE', 'ATTENZIONE!!!<br/>stai per  cancellare ');
define('_COM_SEF_RECORD', ' record');
define('_COM_SEF_RECORDS', ' records');
define('_COM_SEF_NORECORDS', 'Nessun record trovato.');
define('_COM_SEF_PROCEED', ' Procedi ');
define('_COM_SEF_OK', ' OK ');
define('_COM_SEF_SUCCESSPURGE', 'I records sono stati sfoltiti');
define('_PREVIEW_CLOSE', 'Chiudi questa finestra');
define('_COM_SEF_EMPTYURL', 'Devi inserire una URL, per il reindirizzamento.');
define('_COM_SEF_NOLEADSLASH', 'La nuova SEF URL non deve avere la barra (slash) all\'inizio');
define('_COM_SEF_BADURL', 'La vecchia URL non-SEF deve iniziare con index.php');
define('_COM_SEF_URLEXIST', 'Questa URL � gi� esistente nel database!');
define('_COM_SEF_SHOW0', 'Mostra SEF Urls');
define('_COM_SEF_SHOW1', 'Mostra 404 Log');
define('_COM_SEF_SHOW2', 'Mostra Reindirizzamenti personalizzati');
define('_COM_SEF_INVALID_URL', 'URL NON VALIDA: questo link richiede un Itemid valido, ma non � stato trovato.<br/>SOLUZIONE: Crea un menu per questo articolo. Se non ce ne sono da pubblicare, basta crearlo.');
define('_COM_SEF_DEF_404_MSG', '<h1>404: Non Trovato</h1><h4>Spiacente, ma il contenuto che stai cercando non � presente in questo server</h4>');
define('_COM_SEF_SELECT_DELETE', 'Seleziona un articolo da cancellare');
define('_COM_SEF_ASC', ' (asc) ');
define('_COM_SEF_DESC', ' (disc) ');
define('_COM_SEF_WRITEABLE', ' <b><font color="green">Scrivibile</font></b>');
define('_COM_SEF_UNWRITEABLE', ' <b><font color="red">Non scrivibile</font></b>');
define('_COM_SEF_USING_DEFAULT', ' <b><font color="red">Usa i valori predefiniti</font></b>');
define('_COM_SEF_DISABLED',"<p class='error'>NOTA: Il supporto SEF in Joomla/Mambo � attualmente disabilitato. Per usare SEF, attivalo da <a href='"
.$GLOBALS['mosConfig_live_site']."/administrator/index2.php?option=com_config'>Configurazione Globale</a> pagina SEO.</p>");
define('_COM_SEF_TITLE_CONFIG', ' Configurazione ARTIO JoomSEF');
define('_COM_SEF_TITLE_BASIC', 'Configurazione base');
define('_COM_SEF_ENABLED', 'Attivato');
define('_COM_SEF_TT_ENABLED', 'Se settata su No sar� usato il SEF di Joomla/Mambo');
define('_COM_SEF_DEF_404_PAGE', '<b>Pagina 404 standard</b><br>');
define('_COM_SEF_REPLACE_CHAR', 'Sostituzione carattere');
define('_COM_SEF_PAGEREP_CHAR', 'Separatore pagina');
define('_COM_SEF_TT_PAGEREP_CHAR', 'Carattere da usare per separare il numero della pagina dal resto della URL');
define('_COM_SEF_STRIP_CHAR', 'Caratteri da filtrare');
define('_COM_SEF_TT_STRIP_CHAR', 'Caratteri da eliminare dalla URL, separati da |');
define('_COM_SEF_FRIENDTRIM_CHAR', 'Caratteri da tagliare');
define('_COM_SEF_TT_FRIENDTRIM_CHAR', 'Caratteri da tagliare dalle estremit� della URL, separati da |');
define('_COM_SEF_TT_REPLACE_CHAR', 'Carattere da usare per sostituire un carattere sconosciuto nella URL');
define('_COM_SEF_USE_ALIAS', 'Usa Alias del Titolo');
define('_COM_SEF_TT_USE_ALIAS', 'Setta su S� per usare alias del titolo al posto del titolo nella URL');
define('_COM_SEF_FULL_TITLE', 'No');
define('_COM_SEF_TITLE_ALIAS', 'S�');
define('_COM_SEF_SUFFIX', 'Suffisso del file');
define('_COM_SEF_TT_SUFFIX', 'Estensione da usare per \\\'files\\\'. Lascia in bianco  per disabilitare. Una scelta comune sarebbe \\\'html\\\'.');
define('_COM_SEF_ADDFILE', 'File index predefinito');
define('_COM_SEF_TT_ADDFILE', 'Nome del file da inserire nella URL dopo / quando non esiste alcun file. Utile per i bots ed i crawler che visitano il sito alla ricerca di un file specifico, che restituirebbero un errore 404');
define('_COM_SEF_PAGETEXT', 'Testo della pagina');
define('_COM_SEF_TT_PAGETEXT', 'Testo da aggiungere alla URL per pagine multiple. Usa %s per inserire un numero di pagina, per default sar� inserito alla fine. Se � definito un suffisso, sar� aggiunto alla fine della stringa.');
define('_COM_SEF_LOWER', 'Tutto minuscolo');
define('_COM_SEF_TT_LOWER', 'Converte in minuscolo tutti i caratteri della URL', 'Tutto minuscolo');
define('_COM_SEF_SHOW_SECT', 'Mostra sezione');
define('_COM_SEF_TT_SHOW_SECT', 'Setta S� per includere il nome della sezione nella URL');
define('_COM_SEF_SHOW_CAT', 'Mostra la Categoria');
define('_COM_SEF_TT_HIDE_CAT', 'Setta S� per includere il nome della categoria nella URL');
define('_COM_SEF_404PAGE', 'Pagina 404');
define('_COM_SEF_TT_404PAGE', 'Pagina di contenuto statico da usare come pagina 404 Errore Non Trovato (lo stato di pubblicazione non ha importanza)');
// Removed in 1.2.5: define('_COM_SEF_TITLE_ADV', 'Configurazione avanzata del componente');
define('_COM_SEF_TT_ADV', '<b>Gestione normale</b><br/>elabora normalmente, se � presente una estensione avanzata, sar� usata quella. <br/><b>Non modificare</b><br/>non memorizzare nel DB e crea le URL SEF nel vecchio stile<br/><b>Salta</b><br/>non usare le URL SEF per questo componente<br/>');
define('_COM_SEF_TT_ADV4', 'Opzioni avanzate per ');
define('_COM_SEF_TITLE_MANAGER', 'JoomSEF URL Manager');
define('_COM_SEF_VIEWMODE', 'Modo vista:');
define('_COM_SEF_SORTBY', 'Ordina per:');
define('_COM_SEF_HITS', 'Viste');
define('_COM_SEF_DATEADD', 'Data aggiunta');
define('_COM_SEF_SEFURL', 'Url SEF');
define('_COM_SEF_URL', 'Url');
define('_COM_SEF_REALURL', 'Url Reale');
define('_COM_SEF_EDIT', 'Modifica');
define('_COM_SEF_ADD', 'Aggiungi');
define('_COM_SEF_NEWURL', 'Nuova URL SEF');
define('_COM_SEF_TT_NEWURL', 'Solo reindirizzamenti relativi dalla root di Joomla/Mambo <i>senza</i> la barra (slash) iniziale');
define('_COM_SEF_OLDURL', 'Vecchia URL Non-SEF');
define('_COM_SEF_TT_OLDURL', 'Questa URL deve iniziare con index.php');
define('_COM_SEF_SAVEAS', 'Salva il reindirizzamento personalizzato');
define('_COM_SEF_TITLE_SUPPORT', 'Supporto JoomSEF');
define('_COM_SEF_HELPVIA', '<b>L\'aiuto � disponibile nei seguenti forums:</b>');
define('_COM_SEF_PAGES', 'Pagina ufficiale del prodotto');
define('_COM_SEF_FORUM', 'ARTIO forum di supporto');
define('_COM_SEF_HELPDESK', 'ARTIO Helpdesk (a pagamento)');
define('_COM_SEF_TITLE_PURGE', 'Sfoltisci il database di JoomSEF');
define('_COM_SEF_USE_DEFAULT', '(Gestione normale)');
define('_COM_SEF_NOCACHE', 'Non modificare');
define('_COM_SEF_SKIP', 'Salta');
define('_COM_SEF_INSTALLED_VERS', 'Versione installata:');
define('_COM_SEF_COPYRIGHT', 'Copyright');
define('_COM_SEF_LICENSE', 'Licenza');
define('_COM_SEF_SUPPORT_JOOMSEF', 'Supporto di JoomSEF');
define('_COM_SEF_CONFIG_UPDATED', 'Configurazione aggiornata');
define('_COM_SEF_WRITE_ERROR', 'Errore scrivendo la configurazione');
define('_COM_SEF_NOACCESS', 'Impossibile accedere');
define('_COM_SEF_FATAL_ERROR_HEADERS', 'FATAL ERROR: HEADER ALREADY SENT');
define('_COM_SEF_UPLOAD_OK', 'Il file � stato uploadato con successo');
define('_COM_SEF_ERROR_IMPORT', 'Errore durante l\'importazione:');
define('_COM_SEF_INVALID_SQL', 'DATI NON VALIDI NEL FILE SQL :');
define('_COM_SEF_NO_UNLINK', 'Impossibile eliminare il file uploadato dalla cartella media');
define('_COM_SEF_IMPORT_OK', 'URL personalizzate importate con successo!');
define('_COM_SEF_WRITE_FAILED', 'Impossibile inserire il file uploadato nella cartella media');
define('_COM_SEF_EXPORT_FAILED', 'ESPORTAZIONE FALLITA!!!');
define('_COM_SEF_IMPORT_EXPORT', 'Importa/Esporta URL personalizzate');
define('_COM_SEF_SELECT_FILE', 'Selezionare prima un file');
define('_COM_SEF_IMPORT', 'Importa URL personalizzate');
define('_COM_SEF_EXPORT', 'Backup URL personalizzate');

// component interface
define('_COM_SEF_NOREAD', 'FATAL ERROR: impossibile leggere il file ');
define('_COM_SEF_CHK_PERMS', 'Per favore, controlla i permessi del file e assicurati che questo file sia leggibile.');
define('_COM_SEF_DEBUG_DATA_DUMP', 'DEBUG DATA DUMP COMPLETE: Caricamento pagina terminato');
define('_COM_SEF_STRANGE', 'Qualcosa di strano � successo. Questo non dovrebbe accadere<br />');

// new 1.2.5
// Advanced configuration
define('_COM_SEF_TITLE_ADV_CONF', 'Configurazione avanzata');
define('_COM_SEF_REPLACEMENTS', 'Sostituzione caratteri Non-ASCII');
define('_COM_SEF_TT_REPLACEMENTS', 'Stabilisce come sostituire i caratteri (o le stringhe) non-ascii.<br />Il formato � srcChar1|rplChar1, srcChar2|rplChar2, ...<br />Nota: gli spazi bianchi intorno a &quot;,&quot; e &quot;|&quot; saranno rimossi.');
// JoomFish configuration
define('_COM_SEF_JOOMFISH_CONF', 'Configurazione Joom!Fish');
define('_COM_SEF_JF_LANG_TO_PATH', 'Lingua come path?');
define('_COM_SEF_TT_JF_LANG_TO_PATH', 'Imposta se versioni differenti delle lingue differiscono per il path o per il suffisso della pagina.');
define('_COM_SEF_JF_ALWAYS_USE_LANG', 'Usa sempre la lingua?');
define('_COM_SEF_TT_JF_ALWAYS_USE_LANG', 'Includi sempre il codice della lingua nella URL generata.');
define('_COM_SEF_JF_TRANSLATE', 'Traduci URL?');
define('_COM_SEF_TT_JF_TRANSLATE', 'Utilizza Joom!Fish per tradurre i titoli delle URL SEF.');
// Component configuration
define('_COM_SEF_TITLE_COM_CONF', 'Configurazione componente');

// new 1.3.0
// Admin section URL filters
define('_COM_SEF_FILTERSEF', 'Filtra URL SEF:');
define('_COM_SEF_FILTERSEF_HLP', 'Per filtrare le URL mostrate con le URL SEF, inserire parte di essa in questo campo e premere INVIO.');
define('_COM_SEF_FILTER404', 'Filtra URL:');
define('_COM_SEF_FILTERREAL', 'Filtra URL reali:');
define('_COM_SEF_FILTERREAL_HLP', 'Per filtrare le URL mostrate con le URL originali, inserire parte di essa in questo campo e premere INVIO.');
define('_COM_SEF_FILTERCOMPONENT', 'Componente:');
define('_COM_SEF_FILTERCOMPONENTALL', '(Tutti)');

// Upgrade texts
define('_COM_SEF_TITLE_UPGRADE', 'ARTIO JoomSEF Gestore Aggiornamenti');
define('_COM_SEF_TITLE_NEWVERSION', 'Ultima versione:');
define('_COM_SEF_UPGRADEPACKAGE_HEADER', 'Carica file del pacchetto');
define('_COM_SEF_UPGRADEPACKAGE_LABEL', 'File del pacchetto:');
define('_COM_SEF_UPGRADEPACKAGE_SUBMIT', 'Carica file e aggiorna');
define('_COM_SEF_UPGRADESERVER_HEADER', 'Aggiorna dal server ARTIO');
define('_COM_SEF_UPGRADESERVER_LINKTEXT', 'Aggiorna dal server ARTIO');
define('_COM_SEF_UPGRADESERVER_LINKTITLE', 'Aggiorna dal server ARTIO');
define('_COM_SEF_UPGRADE_BADPACKAGE', 'Questo pacchetto non contiene alcuna informazione di aggiornamento.');
define('_COM_SEF_UPGRADE_BADSOURCE', 'Sorgente non riconosciuta.');
define('_COM_SEF_UPGRADE_CONNECTIONFAILED', 'Impossibile connetersi al server.');
define('_COM_SEF_UPGRADE_SERVERUNAVAILABLE', 'Server non disponibile.');

define('_COM_SEF_CANT_UPGRADE', 'Impossibile aggiornare.<br />La tua versione di JoomSEF � gi� aggiornata oppure il suo aggiornamento non � pi� supportato.');
define('_COM_SEF_UPGRADE_INVALIDOPERATION', 'Operazione di aggiornamento non valida: ');
define('_COM_SEF_UPGRADE_INVALIDFILE', 'File di aggiornamento non valido: ');
define('_COM_SEF_UPGRADE_SQLERROR', 'Impossibile eseguire query SQL: ');

define('_COM_SEF_URL_TTL', 'URL');
define('_COM_SEF_META_TTL', 'Meta Tags (opzionale)');
define('_COM_SEF_METATITLE', 'Titolo:');
define('_COM_SEF_META_INFO', 'Nota: JoomSEF Mambot deve essere installato e pubblicato affinch� i meta tag funzionino correttamente.<br />'
.'Per abilitare la generazione del titolo mediante JoomSEF, assicurarsi che "Titoli pagina dinamici" sia settata su "S�" nella configurazione globale.<br />'
.'Opzionalmente, � possibile disabilitare la generazione standard delle keyword di Joomla! oppure configurare il comportamento del JoomSEF MetaBot modificando i suoi settaggi. Per maggiori dettagli, consulta la documentazione.');
define('_COM_SEF_META_TIP', 'JoomSEF MetaBot Notice');
define('_COM_SEF_METADESCRIPTION', 'Meta Description:');
define('_COM_SEF_METAKEYWORDS', 'Meta Keywords:');
define('_COM_SEF_METALANG', 'Meta Content-Language:');
define('_COM_SEF_METAROBOTS', 'Meta Robots:');
define('_COM_SEF_METAGOOGLE', 'Meta Googlebot:');
define('_COM_SEF_TITLE_INFO', 'Documentazione ARTIO JoomSEF');

define('_COM_SEF_INSTALL_EXT', 'Installa');
define('_COM_SEF_UNINSTALL_EXT', 'Rimuovi');
define('_COM_SEF_UPGRADE', 'Aggiorna');
define('_COM_SEF_TITLE_INSTALL_EXT', 'Installa estensione SEF');
define('_COM_SEF_TITLE_UNINSTALL_EXT', 'Rimuovi estensione SEF');
define('_COM_SEF_TITLE_INSTALL_NEW_EXT', 'Installa nuove estensioni SEF');
define('_COM_SEF_INSTALLED_EXTS', 'Estensioni SEF installate');
define('_COM_SEF_EXTS_INFO', 'Sono visualizzate solamente le estensioni SEF che possono essere rimosse - alcune estensioni del core non possono essere rimosse.');
define('_COM_SEF_EXT', 'Estensione SEF');
define('_COM_SEF_AUTHOR', 'Autore');
define('_COM_SEF_VERSION', 'Versione');
define('_COM_SEF_DATE', 'Data');
define('_COM_SEF_AUTHOR_EMAIL', 'Email autore');
define('_COM_SEF_AUHTOR_URL', 'URL autore');
define('_COM_SEF_NONE_EXTS', 'Non ci sono estensioni SEF non rimovibili.');

// new 1.3.3
define('_COM_SEF_SHOW3', 'Mostra tutte le redirezioni');
define('_COM_SEF_PURGE_URLS', 'Vuoi rimuovere automaticamente le URL generate?\n\n'
.'Nota: dovrebbero essere rimosse nel caso in cui sia stato modificato il modo con cui vengono visualizzate. NON verr� rimossa alcuna URL personalizzata.');

// new 1.4.0
define('_COM_SEF_EXCLUDE_SOURCE', 'Esclude informazioni sorgente (Itemid)');
define('_COM_SEF_TT_EXCLUDE_SOURCE', 'Esclude le infomrazioni relative alla variabile Itemid dalla URL.<br />Questo pu� impedire la creazione di URL duplicate, ma probabilmente limiter� le funzionalit� di Joomla! (soprattutto il pathway).');
define('_COM_SEF_REAPPEND_SOURCE', 'Riaggiungi sorgente (Itemid)');
define('_COM_SEF_TT_REAPPEND_SOURCE', 'Questa impostazione riaggiunge la variabile Itemid alla URL SEF come parametro.');
define('_COM_SEF_APPEND_NONSEF', 'Aggiungi variabili non-SEF alla URL');
define('_COM_SEF_TT_APPEND_NONSEF', 'Esclude variabili che variano spesso dalle URL SEF e le aggiunge come parametri non-SEF.<br />Questo diminuisce l\'uso del database e previene anche la creazione di URL duplicate in alcune estensioni.');

define('_COM_SEF_JF_LANG_PLACEMENT', 'Integrazione lingua');
define('_COM_SEF_TT_JF_LANG_PLACEMENT', 'Dove aggiungere il codice della lingua nella URL generata. L\'opzione "non aggiungere" dovrebbe essere usata solamente quando la traduzione del path � attivata.');
define('_COM_SEF_LANG_PATH_TXT', 'includi nel path');
define('_COM_SEF_LANG_SUFFIX_TXT', 'aggiungi come suffisso');
define('_COM_SEF_LANG_NONE_TXT', 'non aggiungere');

define('_COM_SEF_UPLOAD_ERROR', 'ERRORE NEL CARICAMENTO DEL FILE');
define('_COM_SEF_UPTODATE', 'La tua copia di JoomSEF � aggiornata.');

// new 1.5.0
define('_COM_SEF_RECORD_404', 'Registrare pagine 404?');
define('_COM_SEF_TT_RECORD_404', 'Registrare le pagine di errore 404 nel DB? Disabilitandolo diminuiranno le query SQL eseguite da JoomSEF, tuttavia non si sar� in grado di vedere le visite a pagine inesistenti del sito.');
define('_COM_SEF_TRANSIT_SLASH', 'Tollerante con il trailing slash?');
define('_COM_SEF_TT_TRANSIT_SLASH', 'Accettare sia indirizzi URL che finiscono con /, sia indirizzi che non finiscono con /?');

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
