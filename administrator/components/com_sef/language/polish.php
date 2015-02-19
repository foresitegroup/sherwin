<?php
/**
 * ARTIO SEF module for Joomla! Polish ISO-8859-2
 *
 * @author      Krzysztof Pop�awski
 * @copyright   jooml.b-3.pl
 * @package     ARTIO JoomSEF
 * @version     1.1
 * 
 * Translation provided by: Krzysztof Poplawski
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

//ico added
define('_COM_SEF_VIEWURL', 'Przegl�daj adresy');
define('_COM_SEF_VIEW404', 'Przegl�daj b��dy 404');
define('_COM_SEF_VIEWCUSTOM', 'Przegl�daj w�asne');
define('_COM_SEF_VIEW301', 'Przegl�daj b��dy 301');
define('_COM_SEF_EDIT_EXT', 'Edytuj');

// admin interface
define('_COM_SEF_CONFIG', 'Konfiguracja');
define('_COM_SEF_CONFIGDESC', 'Konfiguracja wszystkich ustawie� ARTIO JoomSEF');
define('_COM_SEF_HELP', 'Pomoc');
define('_COM_SEF_HELPDESC', 'Potrzebujesz pomocy z ARTIO JoomSEF?');
define('_COM_SEF_INFO', 'Dokumentacja');
define('_COM_SEF_INFODESC', 'Podsumowanie Projektu oraz Dokumentacja ARTIO JoomSEF');
define('_COM_SEF_Przegl�dajURL', 'Przegl�daj/Edytuj<br/>Adresy URL SEF');
define('_COM_SEF_Przegl�dajURLDESC', 'Przegl�daj/Edytuj Adresy URL SEF');
define('_COM_SEF_Przegl�daj404', 'Przegl�daj/Edytuj<br/>Rejestr B��d�w typu 404');
define('_COM_SEF_Przegl�daj404DESC', 'Przegl�daj/Rejestr b��d�w typu 404');
define('_COM_SEF_Przegl�dajCUSTOM', 'Przegl�daj/Edytuj<br/>Twoje Przekierowania');
define('_COM_SEF_Przegl�dajCUSTOMDESC', 'Przegl�daj/Edytuj Twoje Przekierowania');
define('_COM_SEF_SUPPORT', 'Strona<br/>Wsparcia');
define('_COM_SEF_SUPPORTDESC', 'Po��cz ze stron� www ARTIO JoomSEF (nowe okno)');
define('_COM_SEF_BACK', 'Powr�t do Panelu Sterowania ARTIO JoomSEF');
define('_COM_SEF_PURGEURL', 'Usu�<br/>Adresy URL SEF');
define('_COM_SEF_PURGEURLDESC', 'Adresy URL SEF');
define('_COM_SEF_PURGE404', 'Usu� <br/>Rejestr b��d�w typu 404');
define('_COM_SEF_PURGE404DESC', 'Usu� Rejestr b��d�w typu 404');
define('_COM_SEF_PURGECUSTOM', 'Usu� Swoje<br/>Przekierowania');
define('_COM_SEF_PURGECUSTOMDESC', 'Usu� Przekierowania');
define('_COM_SEF_WARNDELETE', 'UWAGA!!!<br/>kasujesz wpisy');
define('_COM_SEF_RECORD', ' wpis');
define('_COM_SEF_RECORDS', ' wpisy');
define('_COM_SEF_NORECORDS', 'Brak wpis�w.');
define('_COM_SEF_PROCEED', ' Kontynuuj ');
define('_COM_SEF_OK', ' OK ');
define('_COM_SEF_SUCCESSPURGE', 'Wpisy zosta�y pomy�lnie usuni�te');
define('_PREPrzegl�daj_CLOSE', 'Zamknij to okno');
define('_COM_SEF_EMPTYURL', 'Musisz poda� URL dla tego przekierowania.');
define('_COM_SEF_NOLEADSLASH', 'Nowy adres URL nie powinien rozpoczyna� si� od SLASHA');
define('_COM_SEF_BADURL', 'Przekierowywany adres URL musi rozpoczyna� si� od index.php');
define('_COM_SEF_URLEXIST', 'Ten URL istnieje ju� w bazie danych!');
define('_COM_SEF_SHOW0', 'Przyjazne Adresy URL');
define('_COM_SEF_SHOW1', 'Rejestr b��d�w typu 404');
define('_COM_SEF_SHOW2', 'Przekierowania');
define('_COM_SEF_INVALID_URL', 'B��dnY URL: ten link wymaga wa?nego Itemid, ale �adne Itemid nie zosta�o znalezione.<br/>ROZwi�zANIE: Utw?rz wpis w menu dla tej pozycji. Nie musisz tego wpisu w menu publikowa?. Mo?e on by� niewidoczny ale wa?ne jest aby istnia?.');
define('_COM_SEF_DEF_404_MSG', '<center><h1>404: Nie znaleziono</h1><h4>Przykro nam ale ten adres nie istnieje</h4></center>');
define('_COM_SEF_SELECT_DELETE', 'Wybierz pozycj? do usuni�cia');
define('_COM_SEF_ASC', ' (rosn�co) ');
define('_COM_SEF_DESC', ' (malej�co) ');
define('_COM_SEF_WRITEABLE', ' <b><font color="green">(zapis - mo�liwy)</font></b>');
define('_COM_SEF_UNWRITEABLE', ' <b><font color="red">(zapis - niemo�liwy)</font></b>');
define('_COM_SEF_USING_DEFAULT', ' <b><font color="red">U�ywa standardowych ustawie�</font></b>');
define('_COM_SEF_DISABLED',"<p class='error'>UWAGA: SEF support w Joomla/Mambo jest w tej chwili Wy��czone. Aby aktywowa? SEF, nale?y zmieni� ustawienia w <a href='"
.$GLOBALS['mosConfig_live_site']."/administrator/index2.php?option=com_config'>Konfiguracji witryny</a> (zak?adka wyszukiwarki).</p>");
define('_COM_SEF_TITLE_CONFIG', 'Konfiguracja ARTIO JoomSEF');
define('_COM_SEF_TITLE_BASIC', 'Konfiguracja podstawowa');
define('_COM_SEF_ENABLED', 'w��czone');
define('_COM_SEF_TT_ENABLED', 'Je�eli ustawisz NIE, b�dzie U�ywane standardowe SEF dla Joomla/Mambo');
define('_COM_SEF_DEF_404_PAGE', 'Twoja strona B��du 404');
define('_COM_SEF_REPLACE_CHAR', 'Zamiennik znak�w specjalnych');
define('_COM_SEF_TT_REPLACE_CHAR', 'Znak kt�ry zast�puje nierozpoznawalne znaki specjalne');
define('_COM_SEF_PAGEREP_CHAR', 'Zamiennik spacji');
define('_COM_SEF_TT_PAGEREP_CHAR', 'Znak kt�rym maj� by� zast�pione spacje w adresach');
define('_COM_SEF_STRIP_CHAR', 'Usu� znaki');
define('_COM_SEF_TT_STRIP_CHAR', 'Znaki specjalne, kt�re zostan� usuni�te z adresu. Rozdzielone przez |');
define('_COM_SEF_FRIENDTRIM_CHAR', 'Obcinaj znaki');
define('_COM_SEF_TT_FRIENDTRIM_CHAR', 'Znaki do obCi�cia na pocz?tku i ko?cu adresu. Rozdzielone przez |');
define('_COM_SEF_USE_ALIAS', 'U�ywaj aliasu');
define('_COM_SEF_TT_USE_ALIAS', 'Ustaw na TAK aby u�ywa� title_alias zamiast title w adresie');
define('_COM_SEF_SUFFIX', 'rozsze�enie adresu');
define('_COM_SEF_TT_SUFFIX', 'Rozszerzenie stosowane przez przyjazne adresy url. Zostaw puste aby Wy��czy�. Standardowo stosuje si� \\\'html\\\'.');
define('_COM_SEF_ADDFILE', 'Podstawowy plik index');
define('_COM_SEF_TT_ADDFILE', 'Nazwa U�ywana w przypadku pustego adresu url (np: index.html). Wa?ne dla robot?w kt�re szukaj�c okre?lonych plik?w nie natrafiaj� na nie i zwracaj� kod B��du 404.');
define('_COM_SEF_PAGETEXT', 'Nazwa stron');
define('_COM_SEF_TT_PAGETEXT', 'Jak maj� by� nazywane artyku�y/dzia�y sk�adaj�ce si� z wi�cej ni� jednej strony. Wpisz %s aby doda� numer strony do adresu. Je�eli rozsze�enie jest niedost�pne, wtedy zostanie dodany na koniec u�ytego ci�gu znak�w.');
define('_COM_SEF_LOWER', 'Ma�e litery');
define('_COM_SEF_TT_LOWER', 'Zmie� wszystkie litery w adresie na Ma�e litery', 'Ma�e litery');
define('_COM_SEF_SHOW_SECT', 'Poka� sekcje');
define('_COM_SEF_TT_SHOW_SECT', 'Ustaw na tak aby Do��czy� nazw� sekcji do adresu URL');
define('_COM_SEF_HIDE_CAT', 'Ukryj kategori�');
define('_COM_SEF_TT_HIDE_CAT', 'Ustaw na TAK aby Wy��czy� dodawanie nazwy kategorii do adresu URL');
define('_COM_SEF_404PAGE', 'Strona B��du 404');
define('_COM_SEF_TT_404PAGE', 'Wybierz stron� kt�ra ma byc wy�wietlana podczas wyst�pienia B��du typu 404 (strona nie musi by� opublikowana)');
//Removed 1.2.5: define('_COM_SEF_TITLE_ADV', 'Zaawansowane opcje konfiguracyjne');
define('_COM_SEF_TT_ADV', '<b>U�yj JoomSEF</b><br/>Je�eli dost�pne jest rozszerzenie dla danego komponentu, adresy b�d� tworzone przez JoomSEF <br/><b>U�yj Joomla! SEF</b><br/>Adresy b�d� tworzone przez standardow? funkcj? Joomla - SEO<br/><b>Pomi�</b><br/>nie U�ywaj �adnej funkcji SEF<br/>');
define('_COM_SEF_TT_ADV4', 'Zaawansowane opcje dla: ');
define('_COM_SEF_TITLE_MANAGER', 'Mened�er ARTIO JoomSEF URL');
define('_COM_SEF_Przegl�dajMODE', 'Opcje wy�wietlania:');
define('_COM_SEF_SORTBY', 'Sortuj wed�ug:');
define('_COM_SEF_HITS', 'Wej��');
define('_COM_SEF_DATEADD', 'Daty dodania');
define('_COM_SEF_SEFURL', 'SEF URL');
define('_COM_SEF_URL', 'URL');
define('_COM_SEF_REALURL', 'Rzeczywistego URL');
define('_COM_SEF_Edytuj', 'Edytuj');
define('_COM_SEF_ADD', 'Dodaj');
define('_COM_SEF_NEWURL', 'Nowy przyjazny URL');
define('_COM_SEF_TT_NEWURL', 'Tylko relatywne przekierowania z Joomla/Mambo root <i>bez</i> poprzedzaj�cych /');
define('_COM_SEF_OLDURL', 'Rzeczywisty adres URL');
define('_COM_SEF_TT_OLDURL', 'URL musi rozpoczyna� si� od index.php');
define('_COM_SEF_SAVEAS', 'Zachowaj przekierowanie ');
define('_COM_SEF_TITLE_SUPPORT', 'POMOC ARTIO JoomSEF');
define('_COM_SEF_HELPVIA', '<b>Dost�pne adresy pomocy:</b>');
define('_COM_SEF_PAGES', 'Oficjalna Strona Produktu');
define('_COM_SEF_FORUM', 'Forum Dyskusyjne ARTIO');
define('_COM_SEF_HELPDESK', 'Helpdesk ARTIO (us?uga p?atna)');
define('_COM_SEF_TITLE_PURGE', 'Czyszczenie bazy danych ARTIO JoomSEF');
define('_COM_SEF_USE_DEFAULT', 'U�yj JoomSEF');
define('_COM_SEF_NOCACHE', 'U�yj Joomla! SEF/SEO');
define('_COM_SEF_SKIP', 'Pomi� ten komponent');
define('_COM_SEF_INSTALLED_VERS', 'zainstalowana wersja:');
define('_COM_SEF_COPYRIGHT', 'Copyright');
define('_COM_SEF_LICENSE', 'Licencja');
define('_COM_SEF_SUPPORT_JOOMSEF', 'Wspom? nas');
define('_COM_SEF_CONFIG_UPDATED', 'Konfiguracja zachowana');
define('_COM_SEF_WRITE_ERROR', 'B��d podczas zapisu konfiguracji');
define('_COM_SEF_NOACCESS', 'Odmowa dost�pu');
define('_COM_SEF_FATAL_ERROR_HEADERS', 'B��d: Nag��wek by� ju� wys?any');
define('_COM_SEF_UPLOAD_OK', 'Plik zosta� pomy�lnie za�adowany');
define('_COM_SEF_ERROR_IMPORT', 'B��d importu:');
define('_COM_SEF_INVALID_SQL', 'B��dnE DANE W PLIKU SQL:');
define('_COM_SEF_NO_UNLINK', 'Nie mo�na przenie�� za�adowanego pliku do katalogu media');
define('_COM_SEF_IMPORT_OK', 'Przekierowania zosta�y pomy�lnie zaimportowane!');
define('_COM_SEF_WRITE_FAILED', 'Nie mo�na przenie�� za�adowanego pliku do katalogu media');
define('_COM_SEF_EXPORT_FAILED', 'EXPORT NIEUDANY!');
define('_COM_SEF_IMPORT_EXPORT', 'Importuj/Eksportuj przekierowania');
define('_COM_SEF_SELECT_FILE', 'Wybierz najpierw plik');
define('_COM_SEF_IMPORT', 'Importuj przekierowania');
define('_COM_SEF_EXPORT', 'Eksportuj przekierowania');

// component interface
define('_COM_SEF_NOREAD', 'B��d KRYTYCZNY: Nie mo�na wczyta? pliku');
define('_COM_SEF_CHK_PERMS', 'Sprawd� pozwolenia do odczytu pliku.');
define('_COM_SEF_DEBUG_DATA_DUMP', 'Zako�czono usuwanie usterek danych');
define('_COM_SEF_STRANGE', 'Sta�o si� co� bardzo dziwnego. To nie powinno si� zdarzy�.<br />');

// temporary
define('_COM_SEF_FULL_TITLE', 'Pe�ny Tytu�');
define('_COM_SEF_TITLE_ALIAS', 'Alias Tytu�u');
define('_COM_SEF_SHOW_CAT', 'Poka� Kategori�');

// new 1.2.5
// Advanced configuration
define('_COM_SEF_TITLE_ADV_CONF', 'Konfiguracja Zaawansowana');
define('_COM_SEF_REPLACEMENTS', 'zast�pienia znak�w Non-ASCII');
define('_COM_SEF_TT_REPLACEMENTS', 'Definiuje czym maj� by� zast�pione okre?lone znaki (�a�cuchy znak�w) non-ascii.<br />Obowi�zuje nast�puj?cy format: znakChar1|zast�pChar1, znakChar2|zast�pChar2, ...<br />UWAGA: znaki w pobli?u &quot;,&quot; i &quot;|&quot; zostan� obCi�te.');
// JoomFish configuration
define('_COM_SEF_JOOMFISH_CONF', 'Konfiguracja zwi�zana z JoomFish');
//define('_COM_SEF_JF_LANG_TO_PATH', 'J?zyk jako �ciezka?');
//define('_COM_SEF_TT_JF_LANG_TO_PATH', 'Ustaw r?ne wersje tre?ci w zale?no?ci od �cie?ki czy rozsze?enia.');
				      // Sets whether different versions of language contents differ by path or page suffix.
define('_COM_SEF_JF_ALWAYS_USE_LANG', 'Zawsze korzystaj z kodu J�zyka?');
define('_COM_SEF_TT_JF_ALWAYS_USE_LANG', 'Zdecyduj czy kod J�zyka ma zawsze zosta� Do��czony do adresu URL.');
define('_COM_SEF_JF_TRANSLATE', 'T�umacz adresy URL?');
define('_COM_SEF_TT_JF_TRANSLATE', 'Wykorzystaj JoomFish do T�umaczenia adres�w.');
// Component configuration
define('_COM_SEF_TITLE_COM_CONF', 'Konfiguracja Komponent�w');

// new 1.3.0
// Admin section URL filters
define('_COM_SEF_FILTERSEF', 'Filtruj przyjazne adresy URL:');
define('_COM_SEF_FILTERSEF_HLP', 'Aby skorzysta� z filtra, wpisz fraz� i naci�nij Enter.');
define('_COM_SEF_FILTER404', 'Filtruj adresy URL:');
define('_COM_SEF_FILTERREAL', 'Filtruje rzeczywiste adresy URL:');
define('_COM_SEF_FILTERREAL_HLP', 'Aby skorzysta� z filtra, wpisz fraz� i naci�nij Enter.');
define('_COM_SEF_FILTERCOMPONENT', 'Komponenty:');
define('_COM_SEF_FILTERCOMPONENTALL', '(wszystkie)');

// Upgrade texts
define('_COM_SEF_TITLE_UPGRADE', 'Mened�er Aktualizacji ARTIO JoomSEF');
define('_COM_SEF_UPGRADE', 'Upgrade');
define('_COM_SEF_TITLE_NEWVERSION', 'Najnowsza wersja:');
define('_COM_SEF_UPGRADEPACKAGE_HEADER', 'Za�aduj Plik Pakietu');
define('_COM_SEF_UPGRADEPACKAGE_LABEL', 'Plik z Pakietem:');
define('_COM_SEF_UPGRADEPACKAGE_SUBMIT', 'Za�aduj Plik &amp; dokonaj aktualizacji');
define('_COM_SEF_UPGRADESERVER_HEADER', 'Aktualizacja z Serwera ARTIO');
define('_COM_SEF_UPGRADESERVER_LINKTEXT', 'Aktualizacja z Serwera ARTIO');
define('_COM_SEF_UPGRADESERVER_LINKTITLE', 'Aktualizacja z Serwera ARTIO');
define('_COM_SEF_UPGRADE_BADPACKAGE', 'Ten pakiet nie zawiera �adnych informacji na temat aktualizacji.');
define('_COM_SEF_UPGRADE_BADSOURCE', '�r�d�o nie zosta�o rozpoznane.');
define('_COM_SEF_UPGRADE_CONNECTIONFAILED', 'Problem z pod��czeniem do serwera.');
define('_COM_SEF_UPGRADE_SERVERUNAVAILABLE', 'Serwer jest niedost�pny.');

define('_COM_SEF_CANT_UPGRADE', 'Nie mo�na dokona� aktualizacji.<br />Twoja wersja JoomSEF jest aktualna albo aktualizacja nie jest ju� wspomagana.');
define('_COM_SEF_UPGRADE_INVALIDOPERATION', 'B��dna operacja: ');
define('_COM_SEF_UPGRADE_INVALIDFILE', 'B��dny plik: ');
define('_COM_SEF_UPGRADE_SQLERROR', 'Nie mo�na wyegzekwowa� instrukcji SQL: ');

define('_COM_SEF_URL_TTL', 'URL');
define('_COM_SEF_META_TTL', 'Meta Tagi (opcjonalnie)');
define('_COM_SEF_METATITLE', 'Tytu�:');
define('_COM_SEF_META_INFO', 'JoomSEF Mambot musi by� zainstalowany i opublikowany.<br />Mo?esz deaktywaowa? standardowe meta tagi Twojej witryny w globalnych ustawienich konfigracyjnych.'); 
									  	         // You may also wish to deactivate Joomla! standard meta tag generation in your site global configuration
define('_COM_SEF_META_TIP', 'JoomSEF MetaBot Notice');
define('_COM_SEF_METAOpis', 'Meta Descrition:');
define('_COM_SEF_METAKEYWORDS', 'Meta Keywords:');
define('_COM_SEF_METALANG', 'Meta Content-Language:');
define('_COM_SEF_METAROBOTS', 'Meta Robots:');
define('_COM_SEF_METAGOOGLE', 'Meta Googlebot:');
define('_COM_SEF_TITLE_INFO', 'Dokumentacja ARTIO JoomSEF');

define('_COM_SEF_INSTALL_EXT', 'Instaluj');
define('_COM_SEF_UNINSTALL_EXT', 'Odinstaluj');
define('_COM_SEF_TITLE_INSTALL_EXT', 'Zainstaluj rozszerzenie SEF');
define('_COM_SEF_TITLE_UNINSTALL_EXT', ' Odinstaluj rozszerzenie SEF');
define('_COM_SEF_TITLE_INSTALL_NEW_EXT', 'Zainstaluj nowe rozszerzenie SEF');
define('_COM_SEF_INSTALLED_EXTS', 'Zainstalowane rozszerzenia SEF');
define('_COM_SEF_EXTS_INFO', 'Poni�ej wy�wietlane s? tylko rozszerzenia kt�re mo�na usun??');
define('_COM_SEF_EXT', 'Rozszerzenie SEF');
define('_COM_SEF_AUTHOR', 'Autor');
define('_COM_SEF_VERSION', 'Wersja');
define('_COM_SEF_DATE', 'Data');
define('_COM_SEF_AUTHOR_EMAIL', ' Email Autora');
define('_COM_SEF_AUHTOR_URL', 'URL Autora');
define('_COM_SEF_NONE_EXTS', 'Brak zainstalowanych rozszerze? SEF.');

// new 1.3.3
define('_COM_SEF_SHOW3', 'Wszystkie Przekierowania');
define('_COM_SEF_PURGE_URLS', 'Na pewno chcesz skasowa? wszystkie automatycznie utworzone adresy?\n\nUWAGA: Ta opcja nie usunie przekierowa? stworzonych przez Ciebie.');

// new 1.4.0
define('_COM_SEF_EXCLUDE_SOURCE', 'Wy��cz info o Itemid');
define('_COM_SEF_TT_EXCLUDE_SOURCE', 'Ta opcja usuwa informacj� o Itemid z adresu URL.<br />Mo?e uchroni� Ci� przed duplikowaniem adres�w, najprawdopodobniej jednak ograniczy Twoje dzia�ania.');
define('_COM_SEF_REAPPEND_SOURCE', 'Do��cz Itemid');
define('_COM_SEF_TT_REAPPEND_SOURCE', 'To ustawienie ponownie Do��cza Itemid do przyjaznych URL.');
define('_COM_SEF_APPEND_NONSEF', 'Do��cz zmienne non-SEF do URL');
define('_COM_SEF_TT_APPEND_NONSEF', 'Wy��cza cz�sto zmieniaj�ce si� zmienne z adres�w i dodaje zapytania non-SEF. Zmniejsza u�ycie bazy danych i zapobiega przed duplikatami.');

define('_COM_SEF_JF_LANG_PLACEMENT', 'Integracja j�zyka');
define('_COM_SEF_TT_JF_LANG_PLACEMENT', 'Gdzie doda� sta�� j�zyka w generowanym adresie. Wyb�r "nie dodawaj" powinien by� u�yty tylko gdy �cie�ka t�umaczenia jest aktywna.');
define('_COM_SEF_LANG_PATH_TXT', 'w��cz w �cie�k�');
define('_COM_SEF_LANG_SUFFIX_TXT', 'dodaj jako rozsze�enie');
define('_COM_SEF_LANG_NONE_TXT', 'nie dodawaj');

define('_COM_SEF_UPLOAD_ERROR', 'B��d �adowania pliku');
define('_COM_SEF_UPTODATE', 'Twoja wersja JoomSEF jest aktualna.');

// new 1.5.0
define('_COM_SEF_RECORD_404', 'Rejestrowa� wy�wietlenia strony 404?');
define('_COM_SEF_TT_RECORD_404', 'Should we store 404 page hits to DB? Disabling this will descrease the number of SQL queries performed by JoomSEF, however you will not be able to see hits to noexisting pages at your site.');
define('_COM_SEF_TRANSIT_SLASH', 'By� tolerancyjnym dla slashy w adresie?');
define('_COM_SEF_TT_TRANSIT_SLASH', 'Czy akceptowa� oba rodzaje adres�w URL, z poprawnymi i niepoprawnymi slashami?');

// new 2.0.0
define('_COM_SEF_LANG_DOMAIN_TXT', 'u�yj innej domeny');
define('_COM_SEF_JF_DOMAIN', 'Konfigruacja domeny');
define('_COM_SEF_TT_JF_DOMAIN', 'Zdefiniuj stron� dla ka�dego j�zyka ( bez slashy z adresu ).');
define('_COM_SEF_ALT_DOMAIN', 'Strona alternatywna');
define('_COM_SEF_TT_ALT_DOMAIN', 'List of alternative live site domains (and paths) (different than your site domain in configuration), that JoomSEF should also accept (use e.g. when your SSL-secured domain is different than the original one or on special configurations). More entries need to be separated by comma.');

define('_COM_SEF_INSTALLED_PATCHES', 'Zainstalowane SEF Patche');
define('_COM_SEF_PATCHES_INFO', "Mo�esz zarz�dza� Patchami SEF u�ywaj�c standardowych bot�w Joomli!. Nie zapomnij opublikowa� tych patch�w kt�rych chcesz u�y�.");
define('_COM_SEF_PATCH', 'SEF Patch');
define('_COM_SEF_NONE_PATCHES', 'Nie ma �adnych patchy SEF zainstalowanych.');

define('_COM_SEF_Edytuj_EXT', 'Edytuj');
define('_COM_SEF_TITLE_Edytuj_EXT', 'Edytuj rozszerzenia SEF');
define('_COM_SEF_ADV_HANDLING', 'Handling');
define('_COM_SEF_ADV_TITLE', 'W�asny tytu�');
define('_COM_SEF_TT_ADV_TITLE', 'Nadpisuje tytu� domy�lny z menu w adresie URL. Pozostaw puste dla u�ycia opcji domy�lnej.');
define('_COM_SEF_DELETE_FILTER', 'Skasuj odfiltrowane');
define('_COM_SEF_TITLE_DELETE_FILTER', 'Skasuj wszystkie adresy URL odpowiadaj�ce warunkowi filtra.');
define('_COM_SEF_DELETE_FILTER_QUESTION', 'Czy jeste� pewny/pewna �e chesz skasowa� wszystkie adresy URL odpowiadajace warunkowi filtra? (Wszystkie te strony zostan� usuni�te.)');
define('_COM_SEF_IGNORE_SOURCE', 'Ignore multiple sources (Itemids)');
define('_COM_SEF_TT_IGNORE_SOURCE', 'When selected, only one URL will be generated for every page, even when there is more than one Itemid pointing to it.');
define('_COM_SEF_USE_CACHE', 'U�y� pami�ci podr�cznej?');
define('_COM_SEF_TT_USE_CACHE', 'Je�eli zostanie ustawione na TAK, adresy URL b�d� zapisywane to pami�ci podr�cznej ( CACHE ) przez co zmniejszy si� obci��enie bazy danych.');
define('_COM_SEF_CACHE_SIZE', 'Maksymalny romzmiar pami�ci podr�cznej ( CACHE ):');
define('_COM_SEF_TT_CACHE_SIZE', 'Jak wiele adres�w URL mo�e by� zapisanych w pami�ci podr�cznej ( CACHE )?.');
define('_COM_SEF_CACHE_MINHITS', 'Minimum cache hits count:');
define('_COM_SEF_TT_CACHE_MINHITS', 'How many hits must URL have to be saved in cache.');
define('_COM_SEF_CLEAN_CACHE', 'Wyczy�� CACHE ');
define('_COM_SEF_TITLE_CLEAN_CACHE', 'Wyczy�� zapami�tane adresy URL ( wyczy�� CACHE ).');
define('_COM_SEF_CLEAN_CACHE_QUESTION', 'Cleaning the cache is recommended every time you change the setting of the cache or you Edytuj any of your custom URLs. Are you sure you want to clean the cache?');

define('_COM_SEF_EXTUPGRADE_TITLE', 'Rozszerzenia SEF');
define('_COM_SEF_NOTAVAILABLE', 'Niedost�pne');
define('_COM_SEF_PARAMETERS', 'Parametry');
define('_COM_SEF_Opis', 'Opis');
define('_COM_SEF_Nazwa', 'Nazwa');
define('_COM_SEF_CACHE_CONF', 'Konfigruacja pami�ci podr�cznej ( CACHE )');
define('_COM_SEF_ITEMID', 'Itemid');
define('_COM_SEF_TT_ITEMID', 'Pozycja menu powi�zana z tym adresem URL.');

define('_COM_SEF_NONSEFREDIRECT', 'Przekieruj adresy nieSEF na SEF?');
define('_COM_SEF_TT_NONSEFREDIRECT', 'When someone types nonSEF URL in his browser he will be redirected to its SEF equivalent with Moved Permanently header.');

define('_COM_SEF_USEMOVED', 'Use Moved Permanently redirection table?');
define('_COM_SEF_TT_USEMOVED', 'When you change the SEF url, it can be saved to redirection table and will remain working with Moved Permanently header.');
define('_COM_SEF_USEMOVEDASK', 'Ask before saving URL to Moved Permanently table?');
define('_COM_SEF_TT_USEMOVEDASK', 'If set to No, URL will be saved automatically anytime you change it.');
define('_COM_SEF_Przegl�daj301DESC', 'Przegl�daj/Edytuj Moved Permanently Redirects');
define('_COM_SEF_Przegl�daj301', 'Przegl�daj/Edytuj 301 Urls');
define('_COM_SEF_PURGE301DESC', 'Purge Moved Permanently Redirects');
define('_COM_SEF_PURGE301', 'Wyczy�� adresy 301');

define('_COM_SEF_301OLDURL', 'Przekierowany z adresu URL');
define('_COM_SEF_301NEWURL', 'Przekierowany do adresu URL');
define('_COM_SEF_TT_301OLDURL', 'To jest adres URL do przekierowania z.');
define('_COM_SEF_TT_301NEWURL', 'To jest adres URL do przekierowania do.');

define('_COM_SEF_DAYS', 'Ostatnio u�ywane');
define('_COM_SEF_FILTEROLD_HLP', 'To filter shown URLs by Moved from URL, enter part of it into this field and hit ENTER.');
define('_COM_SEF_FILTERNEW_HLP', 'To filter shown URLs by Moved to URL, enter part of it into this field and hit ENTER.');
define('_COM_SEF_FILTEROLD', 'Filter Moved from URL:');
define('_COM_SEF_FILTERNEW', 'Filter Moved to URL:');
define('_COM_SEF_FILTERDAY', 'Not used for (days):');
define('_COM_SEF_NEVER', 'Nigdy');

define('_COM_SEF_CACHECLEANED', 'Pami�� podr�czna wyczyszczona');
define('_COM_SEF_CONFIRM301', 'Your SEF link has changed. Do you wish to save the old one to Moved Permanently redirection table so it will be still working?');

define('_COM_SEF_DESCRIPTION', 'Opis');
define('_COM_SEF_NAME', 'Nazwa');
define('_COM_SEF_VIEWMODE', 'Tryb przegladania');
define('_COM_SEF_VIEWCUSTOMDESC', 'Przegladanie adres�w');
define('_COM_SEF_VIEW404DESC', 'Przegladanie bled�w 404');

define('_COM_SEF_DISABLENEWSEF', 'Disable creation of new SEF URLs?');
define('_COM_SEF_TT_DISABLENEWSEF', 'If set to yes, no new URLs will be generated and only those already in database will be used.');
define('_COM_SEF_DONTSHOWTITLE', 'Do not show menu title in URL');
define('_COM_SEF_TT_DONTSHOWTITLE', 'If checked, the menu title will not be present in URL at all (except the direct link to component).');
define('_COM_SEF_SHOW4', 'Show Links to Homepage');
define('_COM_SEF_REINSTALL', 'You have uploaded the package with same version as your current JoomSEF, reinstall instead of upgrade has been initiated.');

define('_COM_SEF_DONTREMOVESID', 'Do not remove SID from SEF URL?');
define('_COM_SEF_TT_DONTREMOVESID', 'If set to yes, the sid variable will not be removed from SEF URL. This may help some components to work properly, but also can create duplicates with some others.');
?>
