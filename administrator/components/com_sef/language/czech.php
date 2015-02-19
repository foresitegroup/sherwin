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
if (!defined('_VALID_MOS')) die('Přímý přístup na toto místo není povolen.');

// admin interface
define('_COM_SEF_CONFIG', 'Konfigurace<br />ARTIO JoomSEF');
define('_COM_SEF_CONFIGDESC', 'Konfigurace nastavení ARTIO JoomSEF');
define('_COM_SEF_HELP', 'Podpora<br />ARTIO JoomSEF');
define('_COM_SEF_HELPDESC', 'Potřebujete poradit s ARTIO JoomSEF?');
define('_COM_SEF_INFO', 'Dokumentace<br />ARTIO JoomSEF');
define('_COM_SEF_INFODESC', 'Zobrazit dokumentaci ARTIO JoomSEF');
define('_COM_SEF_VIEWURL', 'Zobrazit/upravit<br />JoomSEF URL');
define('_COM_SEF_VIEWURLDESC', 'Zobrazit/upravit URL adresy JoomSEFu');
define('_COM_SEF_VIEW404', 'Zobrazit/upravit<br/>404 logy');
define('_COM_SEF_VIEW404DESC', 'Zobrazit/upravit záznamy o chybě 404');
define('_COM_SEF_VIEWCUSTOM', 'Zobrazit/upravit<br/>Vlastní směrování');
define('_COM_SEF_VIEWCUSTOMDESC', 'Zobrazit/upravit vlastní směrovací pravidla');
define('_COM_SEF_SUPPORT', 'Podpora<br/>on-line');
define('_COM_SEF_SUPPORTDESC', 'Připojit se na web ARTIO JoomSEF (nové okno)');
define('_COM_SEF_BACK', 'Zpět na ovládací panel ARTIO JoomSEF');
define('_COM_SEF_PURGEURL', 'Vymazat<br/>SEF URLs');
define('_COM_SEF_PURGEURLDESC', 'Vymazat URL adresy JoomSEFu');
define('_COM_SEF_PURGE404', 'Vyvmazaz<br/>404 záznamy');
define('_COM_SEF_PURGE404DESC', 'Vymazat záznamy o chybě 404');
define('_COM_SEF_PURGECUSTOM', 'Vymazat<br/>vlastní směrování');
define('_COM_SEF_PURGECUSTOMDESC', 'Vymazat vlastní směrovací pravidla');
define('_COM_SEF_WARNDELETE', 'UPOZORNĚNÍ!!!<br/>Chystáte se odstranit ');
define('_COM_SEF_RECORD', ' záznam');
define('_COM_SEF_RECORDS', ' záznamů');
define('_COM_SEF_NORECORDS', 'Nebyly nalezeny žádné záznamy.');
define('_COM_SEF_PROCEED', ' Pokračovat ');
define('_COM_SEF_OK', ' OK ');
define('_COM_SEF_SUCCESSPURGE', 'Záznamy byly úspěšně vymazány');
define('_PREVIEW_CLOSE', 'Zavřít toto okno');
define('_COM_SEF_EMPTYURL', 'Musíte uvést URL adresu pro přesměrování.');
define('_COM_SEF_NOLEADSLASH', 'Nová URL adresa by neměla začínat lomítkem.');
define('_COM_SEF_BADURL', 'Původní nepřepsaná adresa musí začínat index.php.');
define('_COM_SEF_URLEXIST', 'Tato URL adresa již v databázi existuje!');
define('_COM_SEF_SHOW0', 'Zobrazit URL JoomSEFu');
define('_COM_SEF_SHOW1', 'Zobrazit záznam 404');
define('_COM_SEF_SHOW2', 'Zobrazit vlastní změrování');
define('_COM_SEF_INVALID_URL', 'NEPLATNÁ URL: tento odkaz vyžaduje platné ID položky, ale žádné není obsaženo.<br/>ŘEŠENÍ: Vytvořte pro tuto položku položku v menu. Nemusíte ji publikovat, stačí ji vytvořit.');
define('_COM_SEF_DEF_404_MSG', '<h1>404: Nenalezeno</h1><h4>Vámi vyžádaný obsah se bohužel nepodařilo nalézt</h4>');
define('_COM_SEF_SELECT_DELETE', 'Vyberte položku k odstranění');
define('_COM_SEF_ASC', ' (vzestupně) ');
define('_COM_SEF_DESC', ' (sestupně) ');
define('_COM_SEF_WRITEABLE', ' <b><font color="green">Zápis povolen</font></b>');
define('_COM_SEF_UNWRITEABLE', ' <b><font color="red">Zápis nepovolen</font></b>');
define('_COM_SEF_USING_DEFAULT', ' <b><font color="red">Použít Výchozí Hodnoty</font></b>');
define('_COM_SEF_DISABLED',"<p class='error'>UPOZORNĚNÍ: SEF support v Joomla/Mambo je aktuálně neaktivní. Pro použití SEF jej prosím aktivujte v <a href='".$GLOBALS['mosConfig_live_site']."/administrator/index2.php?option=com_config'>Globálním Nastavení</a> na záložce SEO.</p>");
define('_COM_SEF_TITLE_CONFIG', 'Konfigurace ARTIO JoomSEF');
define('_COM_SEF_TITLE_BASIC', 'Základní nastavení');
define('_COM_SEF_ENABLED', 'Aktivní');
define('_COM_SEF_TT_ENABLED', 'Je-li nastaveno na ne, je používán interní Joomla/Mambo SEF modul');
define('_COM_SEF_DEF_404_PAGE', 'Výchozí stránka 404');
define('_COM_SEF_REPLACE_CHAR', 'Náhrazovací znak');
define('_COM_SEF_TT_REPLACE_CHAR', 'Znak kterým budou nahrazeny neznámé znaky v URL');
define('_COM_SEF_PAGEREP_CHAR', 'Znak pro oddělování stránek');
define('_COM_SEF_TT_PAGEREP_CHAR', 'Znak pro oddělení čísla stránky od zbytku URL');
define('_COM_SEF_STRIP_CHAR', 'Ořezávat znaky');
define('_COM_SEF_TT_STRIP_CHAR', 'Znaky pro vynechání z URL, oddělujte |');
define('_COM_SEF_FRIENDTRIM_CHAR', 'Ořezávat přátelské znaky');
define('_COM_SEF_TT_FRIENDTRIM_CHAR', 'Znaky oříznuté z URL, oddělené |');
define('_COM_SEF_USE_ALIAS', 'Používat alias názvu');
define('_COM_SEF_TT_USE_ALIAS', 'Nastavte hodnotu na ano, chcete-li místo plného názvu ke generování URL použít alias');
define('_COM_SEF_SUFFIX', 'Přípona souborů');
define('_COM_SEF_TT_SUFFIX', 'Přípona pro použité se \\\'soubory\\\'. Pro deaktivaci přípon ponechte pole prázdné. Výchozí hodnota je \\\'html\\\'.');
define('_COM_SEF_ADDFILE', 'Výchozí index soubor.');
define('_COM_SEF_TT_ADDFILE', 'Název souboru umisťovaného za prázdnou URL / neexistuje-li žádný soubor. Výhodné pro boty které procházejí vaše stránky a snaží se načítat chybějící soubory.');
define('_COM_SEF_PAGETEXT', 'Text pro stránky');
define('_COM_SEF_TT_PAGETEXT', 'Text připojovaný k URL pro vícenásobné stránky. Použijte %s pro vložení čísla stránky, výchozí je přidání na konec stránky. Je-li definována přípona, bude přidána za tento řetězec.');
define('_COM_SEF_LOWER', 'Vše malými písmeny');
define('_COM_SEF_TT_LOWER', 'Všechny znaky v URL převést na malá písmena');
define('_COM_SEF_SHOW_SECT', 'Zobrazovat sekci');
define('_COM_SEF_TT_SHOW_SECT', 'Nastavte na ano, chcete-li aby název sekce byl součástí URL');
define('_COM_SEF_HIDE_CAT', 'Skrýt kategorii');
define('_COM_SEF_TT_HIDE_CAT', 'Nastave na ano chcete-li skrýt název kategorie v URL');
define('_COM_SEF_404PAGE', 'Stránka 404');
define('_COM_SEF_TT_404PAGE', 'Statická stránka zobrazovaná při chybě 404 stránka nebyla nalezena (stav publikace nerozhoduje)');
define('_COM_SEF_TITLE_ADV', 'Pokročilá Konfigurace Komponent');
define('_COM_SEF_TT_ADV', '<b>použít výchozí ovladač</b><br/>zpracovat běžným postupem, je-li k dispozici rozšíření, bude použito<br/><b>bez mezipaměti</b><br/>neukládat SEF URL do databáze<br/><b>přeskočit</b><br/>pro tuto komponentu SEF adresy nevytvářet<br/>');
define('_COM_SEF_TT_ADV4', 'Pokročilá nastavení pro ');
define('_COM_SEF_TITLE_MANAGER', 'Správce URL ARTIO JoomSEF');
define('_COM_SEF_VIEWMODE', 'Mód prohlížení:');
define('_COM_SEF_SORTBY', 'Řadit podle:');
define('_COM_SEF_HITS', 'Návštěv');
define('_COM_SEF_DATEADD', 'Datum vložení');
define('_COM_SEF_SEFURL', 'SEF Url');
define('_COM_SEF_URL', 'URL');
define('_COM_SEF_REALURL', 'Původní URL');
define('_COM_SEF_EDIT', 'Upravit');
define('_COM_SEF_ADD', 'Přidat');
define('_COM_SEF_NEWURL', 'Nová SEF URL');
define('_COM_SEF_TT_NEWURL', 'Pouze relativní přesměrování z kořenu Joomla/Mambo <i>bez</i> úvodního lomítka');
define('_COM_SEF_OLDURL', 'Původní Non-SEF URL');
define('_COM_SEF_TT_OLDURL', 'Tato URL musí začínat s index.php');
define('_COM_SEF_SAVEAS', 'Uložit jako uživaleskou URL');
define('_COM_SEF_TITLE_SUPPORT', 'Podpora ARTIO JoomSEF');
define('_COM_SEF_HELPVIA', '<b>Pomoc je dostupná prostřednictvím následujících kanálů:</b>');
define('_COM_SEF_PAGES', 'Oficiální stránka produktu');
define('_COM_SEF_FORUM', 'Diskuzní fóra ARTIO');
define('_COM_SEF_HELPDESK', 'ARTIO Helpdesk (placený)');
define('_COM_SEF_TITLE_PURGE', 'Vyčištění databáze ARTIO JoomSEF');
define('_COM_SEF_USE_DEFAULT', '(použít obvyklý ovladač)');
define('_COM_SEF_NOCACHE', 'bez mezipaměti');
define('_COM_SEF_SKIP', 'přeskočit');
define('_COM_SEF_INSTALLED_VERS', 'Nainstalovaná verze:');
define('_COM_SEF_COPYRIGHT', 'Copyright');
define('_COM_SEF_LICENSE', 'Licence');
define('_COM_SEF_SUPPORT_JOOMSEF', 'Podpořte nás');
define('_COM_SEF_CONFIG_UPDATED', 'Konfigurace uložena');
define('_COM_SEF_WRITE_ERROR', 'Chyba při ukládání konfigurace');
define('_COM_SEF_NOACCESS', 'Přístup odepřen');
define('_COM_SEF_FATAL_ERROR_HEADERS', 'KRITICKÁ CHYBA: HLAVIČKY JIŽ BYLY ODESLÁNY');
define('_COM_SEF_UPLOAD_OK', 'Soubor byl nahrán úspěšně');
define('_COM_SEF_ERROR_IMPORT', 'Chyba při importování:');
define('_COM_SEF_INVALID_SQL', 'NEPLATNÁ DATA V SQL SOUBORU:');
define('_COM_SEF_NO_UNLINK', 'Nelze odstranit nahraný soubor z adresáře médií');
define('_COM_SEF_IMPORT_OK', 'Uživatelské URL byly naiportovány úspěšně!');
define('_COM_SEF_WRITE_FAILED', 'Nelze uložit nahraný soubor do adresáře mediií');
define('_COM_SEF_EXPORT_FAILED', 'EXPORT SE NEZDAŘIL!!!');
define('_COM_SEF_IMPORT_EXPORT', 'Importovat/Exportovat Uživatelské URL');
define('_COM_SEF_SELECT_FILE', 'Prosím, nejprve zvolte soubor');
define('_COM_SEF_IMPORT', 'Importovat vlastní URL');
define('_COM_SEF_EXPORT', 'Zálohovat vlastní URL');

// component interface
define('_COM_SEF_NOREAD', 'KRITICKÁ CHYBA: Nelze načíst soubor');
define('_COM_SEF_CHK_PERMS', 'Prosím zkontrolujte nastavení zabezpečení souborů a ujistěte se že soubor je čitelný.');
define('_COM_SEF_DEBUG_DATA_DUMP', 'DEBUG DATA DUMP KOMPLETNÍ: Nahrávání stránky přerušeno');
define('_COM_SEF_STRANGE', 'Nastala neočekávaná chyba.');

// temporary
define('_COM_SEF_FULL_TITLE', 'Plný název');
define('_COM_SEF_TITLE_ALIAS', 'Alias názvu');
define('_COM_SEF_SHOW_CAT', 'Zobrazovat kategorii');

// new 1.2.5
// Advanced configuration
define('_COM_SEF_TITLE_ADV_CONF', 'Pokročilé nastavení');
define('_COM_SEF_REPLACEMENTS', 'Náhrada ne-ascii znaků');
define('_COM_SEF_TT_REPLACEMENTS', 'Určuje jak mají bých nahrazovány ne-ascii znaky (popř. řetězce) v URL adresách.<br />Formát je srcChar1|rplChar1, srcChar2|rplChar2, ...<br />Prázdné znaky kolem oddělovačů &quot;,&quot; a &quot;|&quot; budou ořezány.');
// JoomFish configuration
define('_COM_SEF_JOOMFISH_CONF', 'Konfigurace JoomFish');
//define('_COM_SEF_JF_LANG_TO_PATH', 'Jazyk jako součást cesty?');
//define('_COM_SEF_TT_JF_LANG_TO_PATH', 'Použít jazyk v URL jako součást cesty místo přípony stránky.');
define('_COM_SEF_JF_ALWAYS_USE_LANG', 'Použít vždy jazyk?');
define('_COM_SEF_TT_JF_ALWAYS_USE_LANG', 'Do vygenerované URL vždy začlenit kód jazyka.');
define('_COM_SEF_JF_TRANSLATE', 'Překládat URLs?');
define('_COM_SEF_TT_JF_TRANSLATE', 'Použít JoomFish k překladu názvů v SEF URL.');
// Component configuration
define('_COM_SEF_TITLE_COM_CONF', 'Konfigurace komponenty');

// new 1.3.0
// Admin section URL filters
define('_COM_SEF_FILTERSEF', 'Filtr SEF URL:');
define('_COM_SEF_FILTERSEF_HLP', 'Chcete-li filtrovat zobrazené URL podle SEF adresy, zadejte její část sem a stisknete ENTER.');
define('_COM_SEF_FILTER404', 'Filtr Url:');
define('_COM_SEF_FILTERREAL', 'Filtr zdrojových URL:');
define('_COM_SEF_FILTERREAL_HLP', 'Chcete-li filtrovat zobrazené URL podle zdrojové adresy, zadejte její cást sem a stisknete ENTER.');
define('_COM_SEF_FILTERCOMPONENT', 'Komponenta:');
define('_COM_SEF_FILTERCOMPONENTALL', '(Vše)');

// Upgrade texts
define('_COM_SEF_TITLE_UPGRADE', 'ARTIO JoomSEF Správce Aktualizací');
define('_COM_SEF_UPGRADE', 'Aktualizace');
define('_COM_SEF_TITLE_NEWVERSION', 'Nejnovější verze:');
define('_COM_SEF_UPGRADEPACKAGE_HEADER', 'Nahrát soubor balíku');
define('_COM_SEF_UPGRADEPACKAGE_LABEL', 'Instalační balík:');
define('_COM_SEF_UPGRADEPACKAGE_SUBMIT', 'Nahrát soubor &amp; Aktualizovat');
define('_COM_SEF_UPGRADESERVER_HEADER', 'Aktualizace ze serveru ARTIO');
define('_COM_SEF_UPGRADESERVER_LINKTEXT', 'Aktualizace ze serveru ARTIO');
define('_COM_SEF_UPGRADESERVER_LINKTITLE', 'Aktualizace ze serveru ARTIO');
define('_COM_SEF_UPGRADE_BADPACKAGE', 'Tento balíček neobsahuje žádné aktualizační informace.');
define('_COM_SEF_UPGRADE_BADSOURCE', 'Zdroj nelze rozeznat.');
define('_COM_SEF_UPGRADE_CONNECTIONFAILED', 'Nelze se připojit k serveru.');
define('_COM_SEF_UPGRADE_SERVERUNAVAILABLE', 'Server není dostupný.');

define('_COM_SEF_CANT_UPGRADE', 'Nelze aktualizovat.<br />Vaše verze JoomSEFu je buď aktualní nebo její aktualizace není již podporována.');
define('_COM_SEF_UPGRADE_INVALIDOPERATION', 'Neplatná aktualizační operace: ');
define('_COM_SEF_UPGRADE_INVALIDFILE', 'Neplatný aktualizační soubor: ');
define('_COM_SEF_UPGRADE_SQLERROR', 'Nelze provést SQL dotaz: ');

define('_COM_SEF_URL_TTL', 'URL');
define('_COM_SEF_META_TTL', 'Meta Tagy (nepovinné)');
define('_COM_SEF_METATITLE', 'Titulek:');
define('_COM_SEF_META_INFO', 'Aby bylo generování metatagu funkční, musí být nainstalován a publikován JoomSEF MetaBot.<br />'.'Pro generování titulku musí být volba "Dynamic Page Title" v Globálním nastavením Jommly! nastavena na "Ano"!.<br />'.'Volitelne lze vypnout generování ostatních meta tagu v Globální konfiguraci ci konfigurovat chování JoomSEF MetaBotu. Více podrobností naleznete v nápovede.');
define('_COM_SEF_META_TIP', 'Informace o JoomSEF MetaBot');
define('_COM_SEF_METADESCRIPTION', 'Meta popis:');
define('_COM_SEF_METAKEYWORDS', 'Meta klíčová slova:');
define('_COM_SEF_METALANG', 'Meta jazyk obsahu:');
define('_COM_SEF_METAROBOTS', 'Meta roboti:');
define('_COM_SEF_METAGOOGLE', 'Meta Googlebot:');
define('_COM_SEF_TITLE_INFO', 'Dokumentace ARTIO JoomSEF');

define('_COM_SEF_INSTALL_EXT', 'Nainstalovat');
define('_COM_SEF_UNINSTALL_EXT', 'Odinstalovat');
define('_COM_SEF_TITLE_INSTALL_EXT', 'Instaluj rozšíření SEF');
define('_COM_SEF_TITLE_UNINSTALL_EXT', 'Odinstaluj rozšíření SEF');
define('_COM_SEF_TITLE_INSTALL_NEW_EXT', 'Instaluj nové rozšíření SEF');
define('_COM_SEF_INSTALLED_EXTS', 'Nainstalovaná SEF rozšíření');
define('_COM_SEF_EXTS_INFO', 'Jsou zobrazeny pouze rozšíření, které je možno odinstalovat - některá základní rozšíření nelze odebrat.');
define('_COM_SEF_EXT', 'Rozšíření SEF');
define('_COM_SEF_AUTHOR', 'Autor');
define('_COM_SEF_VERSION', 'Verze');
define('_COM_SEF_DATE', 'Datum');
define('_COM_SEF_AUTHOR_EMAIL', 'Email autora');
define('_COM_SEF_AUHTOR_URL', 'URL autora');
define('_COM_SEF_NONE_EXTS', 'Nejsou nainstalovány žádné modulární rozšíření SEF.');

// new 1.3.3
define('_COM_SEF_SHOW3', 'Zobrazit všechna přesměrování');
define('_COM_SEF_PURGE_URLS', 'Přejete si vymazat všechny automaticky vytvářené URLs?\n\nPoznámka: Vymazat automaticky vytvářené URL může být žádoucí v případě, že jste změnili způsob jak mají být vytvářeny. Tento krok nevymaže žádné vaše \"vlastní\" přesměrování.');

// new 1.4.0
define('_COM_SEF_EXCLUDE_SOURCE', 'Vyjmout informace o zdroji (Itemid)');
define('_COM_SEF_TT_EXCLUDE_SOURCE', 'Toto vyjme informace o zdroji odkazu (Itemid) z URL.<br />Toto může zabránit duplicitě URL, ale pravděpodobně to omezí funkčnost vaší Joomly.');
define('_COM_SEF_REAPPEND_SOURCE', 'Znovupřipojit zdroj (Itemid)');
define('_COM_SEF_TT_REAPPEND_SOURCE', 'Toto nastavení znovupřipojí Itemid k SEF URL jako parametr dotazu.');
define('_COM_SEF_APPEND_NONSEF', 'Připojit ne-SEF proměnné k URL');
define('_COM_SEF_TT_APPEND_NONSEF', 'Vyjme často se měnící proměnné ze SEF URL a připojí je jako ne-SEF dotaz.<br />Toto sníží zatížení databáze a také zabrání duplicitě URL u některých rozšíření.');

define('_COM_SEF_JF_LANG_PLACEMENT', 'Integrace jazyka');
define('_COM_SEF_TT_JF_LANG_PLACEMENT', 'Kam přidat konstantu jazyka do generovaných URL. Možnost "nepřidávat" by měla být použita pouze když je překlad cesty aktivní.');
define('_COM_SEF_LANG_PATH_TXT', 'zahrnuto v cestě');
define('_COM_SEF_LANG_SUFFIX_TXT', 'přidat jako suffix');
define('_COM_SEF_LANG_NONE_TXT', 'nepřidávat');

define('_COM_SEF_UPLOAD_ERROR', 'CHYBA NAHRÁVÁNÍ SOUBORU');
define('_COM_SEF_UPTODATE', 'Váš JoomSEF je aktuální.');

// new 1.5.0
define('_COM_SEF_RECORD_404', 'Zaznamenávat počet zobrazení stránky 404?');
define('_COM_SEF_TT_RECORD_404', 'Měly by být počet zobrazení stránky 404 zaznamenáván do DB? Vypnutí tohoto sníží počet SQL dotazů uskutečněných JoomSEF, nebudete ale moci zobrazit si počet požadovaných neexistujících stránek na vašem webu.');
define('_COM_SEF_TRANSIT_SLASH', 'Tolerance ke koncovému lomítku?');
define('_COM_SEF_TT_TRANSIT_SLASH', 'Chcete akceptovat obojí URL, které končí nebo nekončí koncovým lomítkem, jako validní?');

// new 2.0.0
define('_COM_SEF_LANG_DOMAIN_TXT', 'použít různé domény');
define('_COM_SEF_JF_DOMAIN', 'Konfigurace domény');
define('_COM_SEF_TT_JF_DOMAIN', 'Definujte živý web pro každý jazyk (bez koncového lomítka).');
define('_COM_SEF_ALT_DOMAIN', 'Alternativní živé weby');
define('_COM_SEF_TT_ALT_DOMAIN', 'Seznam alternativních domén živých webů (a cest) (odlišný od domény vašeho webu v konfiguraci), které může JoomSEF také akceptovat (použijte např. když je vaše doména zabezpečená pomocí SSL jiná než původní nebo při speciálních konfiguracích). Více záznamů je třeba oddělit čárkou.');

define('_COM_SEF_INSTALLED_PATCHES', 'Instalované SEF záplaty');
define('_COM_SEF_PATCHES_INFO', "SEF záplaty můžete spravovat pomocí standardního systému Joomla! mambotů. Nezapomeňte publikovat záplaty, které chcete použít.");
define('_COM_SEF_PATCH', 'SEF záplata');
define('_COM_SEF_NONE_PATCHES', 'Žádné SEF záplaty nejsou nainstalovány.');

define('_COM_SEF_EDIT_EXT', 'Upravit');
define('_COM_SEF_TITLE_EDIT_EXT', 'Upravit SEF rozšíření');
define('_COM_SEF_ADV_HANDLING', 'Obsluha');
define('_COM_SEF_ADV_TITLE', 'Vlastní název');
define('_COM_SEF_TT_ADV_TITLE', 'Přepíše výchozí název menu v URL. Nechte prázdné pro výchozí chování.');
define('_COM_SEF_DELETE_FILTER', 'Vymazat všechny filtrované');
define('_COM_SEF_TITLE_DELETE_FILTER', 'Vymaže všechny URL odpovídající filtrům.');
define('_COM_SEF_DELETE_FILTER_QUESTION', 'Jste si jisti, že chcete odstranit všechna URL odpovídající vybraným filtrům? (Všechny stránky budou odstraněny.)');
define('_COM_SEF_IGNORE_SOURCE', 'Ignorovat vícenásobné zdroje (ID položek)');
define('_COM_SEF_TT_IGNORE_SOURCE', 'Jestliže je vybráno, pro každou stránku bude generována pouze jedna URL, i když je zde více než jedno ID položky na ni ukazující.');
define('_COM_SEF_USE_CACHE', 'Použít cache?');
define('_COM_SEF_TT_USE_CACHE', 'Jestliže je nastaveno Ano, URL budou ukládány do cache, takže do databáze bude směrováno méně dotazů.');
define('_COM_SEF_CACHE_SIZE', 'Maximální velikost cache:');
define('_COM_SEF_TT_CACHE_SIZE', 'Kolik URL může být uchováno v cache.');
define('_COM_SEF_CACHE_MINHITS', 'Minimální počet zobrazení pro cache:');
define('_COM_SEF_TT_CACHE_MINHITS', 'Kolik zobrazení musí URL mít, aby byla uložena do cache.');
define('_COM_SEF_CLEAN_CACHE', 'Vyčistit cache');
define('_COM_SEF_TITLE_CLEAN_CACHE', 'Vyčistí URL cache.');
define('_COM_SEF_CLEAN_CACHE_QUESTION', 'Vyčištění cache je doporučeno pokaždé, když měníte nastavení cache nebo upravujete vaše vlastní URL. Skutečně chcete cache vyčistit?');

define('_COM_SEF_EXTUPGRADE_TITLE', 'SEF rozšíření');
define('_COM_SEF_NOTAVAILABLE', 'Není dostupné');
define('_COM_SEF_PARAMETERS', 'Parametry');
define('_COM_SEF_DESCRIPTION', 'Popis');
define('_COM_SEF_NAME', 'Název');
define('_COM_SEF_CACHE_CONF', 'Konfigurace cache');
define('_COM_SEF_ITEMID', 'ID položky (Itemid)');
define('_COM_SEF_TT_ITEMID', 'Položka menu asociovaná s touto URL.');

define('_COM_SEF_NONSEFREDIRECT', 'Přesměrovat neSEF odkazy na SEF?');
define('_COM_SEF_TT_NONSEFREDIRECT', 'Když někdo do prohlížeče zadá neSEFový odkaz, bude přesměrován na jeho SEFový ekvivalent pomocí hlavičky Moved Permanently.');

define('_COM_SEF_USEMOVED', 'Používat tabultu Trvale přesunutých stránek?');
define('_COM_SEF_TT_USEMOVED', 'Jestliže změníte SEF url, může být uložena do tabulky Trvale přesměrovaných stránek, aby byl odkaz i nadále platný.');
define('_COM_SEF_USEMOVEDASK', 'Ptát se před uložením URL na přesun do tabulky Trvale přesunutých stránek?');
define('_COM_SEF_TT_USEMOVEDASK', 'If set to No, URL will be saved automatically anytime you change it.');
define('_COM_SEF_VIEW301DESC', 'Prohlížet/Editovat Tabulku trvale přesunutých stránek');
define('_COM_SEF_VIEW301', 'Prohlížet/Editovat 301 URL');
define('_COM_SEF_PURGE301DESC', 'Vymazat tabulky Trvale přesunutých stránek');
define('_COM_SEF_PURGE301', 'Vymazat 301 URL');

define('_COM_SEF_301OLDURL', 'Přesunuto z URL');
define('_COM_SEF_301NEWURL', 'Přesunuto na URL');
define('_COM_SEF_TT_301OLDURL', 'Toto je URL, ze které je přesměrováváno.');
define('_COM_SEF_TT_301NEWURL', 'Toto je URL, na kteoru se přesměrovává.');

define('_COM_SEF_DAYS', 'Naposledy použito');
define('_COM_SEF_FILTEROLD_HLP', 'To filter shown URLs by Moved from URL, enter part of it into this field and hit ENTER.');
define('_COM_SEF_FILTERNEW_HLP', 'To filter shown URLs by Moved to URL, enter part of it into this field and hit ENTER.');
define('_COM_SEF_FILTEROLD', 'Filtr přesunut z URL:');
define('_COM_SEF_FILTERNEW', 'Filtr přesunut na URL:');
define('_COM_SEF_FILTERDAY', 'Nepoužito (dní):');
define('_COM_SEF_NEVER', 'Nikdy');

define('_COM_SEF_CACHECLEANED', 'Cache byla vyprázdněna.');
define('_COM_SEF_CONFIRM301', 'Váš SEF odkaz byl změněn. Přejete si uložit předchozí do tabulky Trvale přesunutých stránek (301 redirect), aby původní odkaz zůstal nadále funkční?');

define('_COM_SEF_DISABLENEWSEF', 'Zakázat vytváření nových SEF URL?');
define('_COM_SEF_TT_DISABLENEWSEF', 'Je-li nastaveno na ano, nebudou vytvářeny žádné další URL a budou používany pouze ty, již existující v databázi.');
define('_COM_SEF_DONTSHOWTITLE', 'Nezobrazovat název menu v URL');
define('_COM_SEF_TT_DONTSHOWTITLE', 'Je-li zvoleno, nebude ve výchozí konfiguraci do URL přidávám název menu komponenty (vyjma přímého odkazu na komponentu).');
define('_COM_SEF_SHOW4', 'Zobrazit odkaz na Homepage');
define('_COM_SEF_REINSTALL', 'You have uploaded the package with same version as your current JoomSEF, reinstall instead of upgrade has been initiated.');

define('_COM_SEF_DONTREMOVESID', 'Do not remove SID from SEF URL?');
define('_COM_SEF_TT_DONTREMOVESID', 'If set to yes, the sid variable will not be removed from SEF URL. This may help some components to work properly, but also can create duplicates with some others.');
?>
