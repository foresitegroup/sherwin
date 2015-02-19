<?php
/**
* swmenupro v4.5
* http://swonline.biz
* Copyright 2006 Sean White
* Translated to Hungarian by Viktor Szucs with the kind permission of Sean White
* Contact: szviktor@bibl.u-szeged.hu
* Special thanks to LocaLiCeR for the spell-checking and advising to the Hungarian translation
* Contact: info@soft-trans.hu
**/

// no direct access
defined( '_VALID_MOS' ) or die( 'A hozz�f�r�s korl�tozva' );

//swMenuPro 5.0 new terms - �jdons�gok az swMenuPro 5.0-ban

define( '_SW_SLIDECLICK_MENU', 'Harmonika men�' );
define( '_SW_AUTO_CLOSE_LABEL', 'Nyitott almen�pontok automatikus �sszecsuk�sa' );
define( '_SW_UPGRADE_VERSIONS', 'Jelenleg telep�tett swMenuPro verzi�ja' );
define( '_SW_SELECTED_LANGUAGE_HEADING', 'Aktu�lis nyelvi f�jl' );
define( '_SW_LANGUAGE_FILES', '�j nyelvi f�jl kiv�laszt�sa' );
define( '_SW_LANGUAGE_CHANGE_BUTTON', 'Nyelv �tv�lt�sa' );
define( '_SW_UPLOAD_LANGUAGE_HEADING', '�j nyelvi f�jl felt�lt�se' );
define( '_SW_LANGUAGE_UPLOAD_BUTTON', 'Nyelvi f�jl felt�lt�se' );
define( '_SW_FILE_PERMISSIONS', 'Jelenlegi f�jljogosults�gok' );
define( '_SW_LANGUAGE_SUCCESS', 'Az �j nyelvi f�jl hozz�ad�sa siker�lt' );
define( '_SW_LANGUAGE_FAIL', 'A nyelvi f�jl felt�lt�se nem siker�lt, gy�z�dj�n meg arr�l, hogy �rhat�ak-e az al�bbi list�ban szerepl� mapp�k' );

// �jdons�gok v�ge

//Menu Names
define( '_SW_TIGRA_MENU', 'Tigra men�' );
define( '_SW_TRANS_MENU', 'Trans men�' );
define( '_SW_MYGOSU_MENU', 'MyGosu men�' );
define( '_SW_CLICK_MENU', 'Kattint�sos men�' );
define( '_SW_SLIDECLICK_MENU', 'Harmonika men�' ); //ez az 1 sor v�ltozott itt
define( '_SW_TAB_MENU', 'CSS f�l men�' );
define( '_SW_DYN_TAB_MENU', 'Dinamikus f�l men�' );
define( '_SW_TREE_MENU', 'Fa men�' );

//Page Names
define( '_SW_MENU_MODULE_MANAGER', 'Men�modul kezel�' );
define( '_SW_MANUAL_CSS_EDITOR', 'K�zi CSS szerkeszt�' );
define( '_SW_INDIVIDUAL_ITEM_EDITOR', 'Egyedi men�pont szerkeszt�' );
define( '_SW_MODULE_EDITOR', 'Men�modul szerkeszt�' );
define( '_SW_UPGRADE_FACILITY', 'Friss�t�s' );


//Common Terms
define( '_SW_WRITABLE', '�rhat�' );
define( '_SW_UNWRITABLE', 'Nem �rhat�' );
define( '_SW_YES', 'Igen' );
define( '_SW_NO', 'Nem' );
define( '_SW_HYBRID', 'Hibrid' );


//Menu Module Manager Page (list menu modules)
define( '_SW_MENU_MODULES', 'Men�modulok' );
define( '_SW_DISPLAY', 'Megjelen�t�s' );
define( '_SW_USE_DEFAULT_MODULE', 'Alap�rtelmezett men�st�lus haszn�lata' );
define( '_SW_COPY_MODULE', 'Megl�v� men�st�lus haszn�lata' );
define( '_SW_CREATE_MODULE', '�j men�modul l�trehoz�sa' );
define( '_SW_MODULE_NAME', 'Modul neve' );
define( '_SW_SELECT_MENU', 'V�lasszon men�rendszert' );
define( '_SW_SELECT_STYLE', 'V�lassza ki a m�solni k�v�nt men�st�lust' );


//Tool Tips
define( '_SW_SELECT_ITEM_TIP', 'A men�pont kiv�laszt�s�hoz kattintson a men�pont nev�re.' );
define( '_SW_EDIT_MODULE_TIP', 'Kattintson ide a(z) %s men�modul be�ll�t�sainak �s st�lus�nak m�dos�t�s�hoz' );
define( '_SW_COPY_STYLE_TIP', 'V�lasszon ki egy, m�r megl�v� men�modult, hogy annak st�lusbe�ll�t�sait hozz�adja egy �j men�modulhoz' );
define( '_SW_EDIT_CSS_TIP', 'A(z) %s men�modulhoz tartoz� k�ls� st�luslap szerkeszt�s�hez kattintson ide ' );
define( '_SW_EXPORT_MODULE_TIP', 'A(z) %s men�modulhoz tartoz�, jelenleg haszn�lt st�lusbe�ll�t�sok k�ls� st�luslapba t�rt�n� kiment�s�hez, kattintson ide' );
define( '_SW_EDIT_IMAGES_TIP', 'A(z) %s men�modulhoz tartoz� egyedi men�pontok k�peinek, CSS f�jljainak �s tulajdons�gainak szerkeszt�s�hez kattintson ide' );
define( '_SW_PREVIEW_MODULE_TIP', 'A(z) %s men�modul el�bukkan� ablakban megjelen�, el�n�zeti k�p�nek megtekint�s�hez kattintson ide' );
define( '_SW_DELETE_MODULE_TIP', 'A(z) %s men�modul t�rl�s�hez kattintson ide' );
define( '_SW_MENU_SYSTEM_INFO_TIP', 'A rendelkez�sre �ll� men�rendszerekhez kapcsol�d� tov�bbi inform�ci�k�rt <b>kattintson ide</b>' );
define( '_SW_MODULE_TIP', '<b>A men� st�lusa:</b> %s<br /><b>Forr�smen�:</b> %s<br /><b>Poz�ci�:</b> %s<br /><b>Hozz�f�r�s:</b> %s<br /><b>K�zz�t�ve:</b> %s');
define( '_SW_CREATE_MENU_TIP', '�j men�modul l�trehoz�s�hoz kattintson ide.');

define( '_SW_SAVE_TIP', 'A st�luson �s a modulon v�gzett �sszes v�ltoztat�s elment�s�hez kattintson ide' );
define( '_SW_APPLY_TIP', 'A st�luson �s a modulon v�gzett �sszes v�ltoztat�s alkalmaz�s�hoz kattintson ide' );
define( '_SW_CANCEL_TIP', 'A v�ltoztat�sok �rv�nytelen�t�s�hez �s a men�kezel�be val� visszat�r�shez kattintson ide' );
define( '_SW_PREVIEW_TIP', 'Az el�bukkan� ablakban megjelen� el�n�zeti k�p megtekint�s�hez kattintson ide' );
define( '_SW_EXPORT_TIP', 'A jelenleg haszn�lt st�lusbe�ll�t�sok k�ls� st�luslapba t�rt�n� kiment�s�hez kattintson ide' );

//Buttons text
define( '_SW_SAVE_BUTTON', 'Ment�s' );
define( '_SW_APPLY_BUTTON', 'Alkalmaz' );
define( '_SW_CANCEL_BUTTON', 'M�gse' );
define( '_SW_PREVIEW_BUTTON', 'El�n�zet' );
define( '_SW_EXPORT_BUTTON', 'Export�l�s' );
define( '_SW_CREATE_BUTTON', 'L�trehoz�s most' );
define( '_SW_EDIT_BUTTON', 'Szerkeszt�s' );
define( '_SW_DELETE_BUTTON', 'T�rl�s' );
define( '_SW_EDITCSS_BUTTON', 'CSS szerkeszt�se' );
define( '_SW_GET_IMAGE_BUTTON', 'K�p be�ll�t�sa' );
define( '_SW_UPDATE_CSS_BUTTON', 'CSS friss�t�se' );
define( '_SW_UPLOAD_BUTTON', 'F�jl felt�lt�se');
define( '_SW_UPDATE_OVER_CSS_BUTTON', 'Eg�rr�viteli CSS friss�t�se' );


//Internal program links
define( '_SW_UPGRADE_LINK', 'swMenuPro friss�t�se/helyre�ll�t�sa.' );
define( '_SW_MANAGER_LINK', 'Men�modul tulajdons�gainak szerkeszt�se' );
define( '_SW_CSS_LINK', 'K�ls� CSS f�jl k�zi szerkeszt�se' );
define( '_SW_EXPORT_LINK', 'Export�l�s k�ls� CSS f�jlba' );
define( '_SW_RETURN_MANAGER_LINK', 'Visszat�r�s az swMenuPro men�modul kezel�j�hez' );


//Program Notices
define( '_SW_NO_MODULE_NOTICE', 'A megfelel� m�k�d�shez az SWmenuPro modult is telep�tse.' );
define( '_SW_NO_MENU_NOTICE', 'V�lasszon men�rendszert az al�bbi leny�l� list�b�l.' );
define( '_SW_DELETE_MODULE_NOTICE', 'Biztos benne, hogy t�r�lni akarja a k�vetkez�t: ' );
define( '_SW_MAKE_MODULE_NOTICE', 'Hozzon l�tre �j men�modult a jobb oldalon tal�lhat� "�j men�modul l�trehoz�sa" seg�ts�g�vel .' );
define( '_SW_UPLOAD_FILE_NOTICE', 'V�lassza ki a felt�lteni k�v�nt f�jlt.' );
define( '_SW_MENU_CHANGE_NOTICE', 'Megv�ltoztatta a men�modulhoz tartoz� men�forr�st. Ez az oldal nem jelen�thet� meg, am�g nem �rv�nyes�ti a v�ltoztat�sokat, vagy nem �ll�tja vissza az eredeti men�forr�st.' );


//Program Messages
define( '_SW_DELETE_MODULE_MESSAGE', 'A men�modul t�rl�se siker�lt' );
define( '_SW_SAVE_MENU_MESSAGE', 'A be�ll�t�sok ment�se siker�lt' );
define( '_SW_SAVE_MENU_CSS_MESSAGE', 'A be�ll�t�sok ment�se �s a k�ls� CSS f�jl l�trehoz�sa siker�lt' );
define( '_SW_SAVE_CSS_MESSAGE', 'A k�ls� CSS f�jl ment�se siker�lt' );
define( '_SW_NO_SAVE_MENU_CSS_MESSAGE', 'A k�ls� CSS f�jlt nem siker�lt l�trehozni. Gy�z�dj�n meg arr�l, hogy �rhat�-e a modules/mod_swmenupro/styles mappa.' );


//////////////////////////
//Upgrade page
/////////////////////////
define( '_SW_OK', 'Minden rendben' );
define( '_SW_MESSAGES', '�zenetek' );
define( '_SW_MODULE_SUCCESS', 'A modul friss�t�se siker�lt.' );
define( '_SW_MODULE_FAIL', 'A modult nem siker�lt friss�teni. Gy�z�dj�n meg arr�l, hogy �rhat�-e a /modules mappa.' );
define( '_SW_TABLE_UPGRADE', 'A(z) %s t�bla friss�t�se k�sz' );
define( '_SW_TABLE_CREATE', 'A(z) %s t�bla l�trehoz�sa k�sz' );
define( '_SW_UPDATE_LINKS', 'Az admin men� hivatkoz�sainak friss�t�se megt�rt�nt' );

define( '_SW_MODULE_VERSION', 'Jelenlegi swMenuPro modul verzi�' );
define( '_SW_COMPONENT_VERSION', 'Jelenlegi swMenuPro komponens verzi�' );
define( '_SW_UPLOAD_UPGRADE', 'swMenuPro friss�t�s/�j verzi� felt�lt�se' );
define( '_SW_UPLOAD_UPGRADE_BUTTON', 'F�jl felt�lt�se �s telep�t�se' );

define( '_SW_COMPONENT_SUCCESS', 'Az swMenuPro komponens friss�t�se siker�lt.' );
define( '_SW_COMPONENT_FAIL', 'A friss�t�s nem siker�lt, gy�z�dj�n meg arr�l, hogy �rhat�ak-e az al�bbi list�ban szerepl� mapp�k.' );
define( '_SW_INVALID_FILE', '�rv�nytelen swMenuPro friss�t�s/�j verzi� f�jl.' );



//////////////////////////
//Item images and CSS page
/////////////////////////
define( '_SW_AUTO_MULTIPLE_LABEL', 'Men�pontok csoportos szerkeszt�se automatikusan.' );
define( '_SW_AUTO_CSS_CREATOR_LABEL', 'Automatikus CSS-k�sz�t�' );
define( '_SW_PROPERTIES_LABEL', 'Men�pont tulajdons�gai' );

//top tabs
define( '_SW_ITEM_PROPERTIES_TAB', 'Tulajdons�gok<br /> K�pek' );
define( '_SW_ITEM_CSS_TAB', 'Norm�l / Eg�rr�vitel<br /> st�lusa' );
define( '_SW_MULTIPLE_TAB', 'Csoportos <br />men�pontbe�ll�t�s' );

//general text
define( '_SW_STEP_1', '1. l�p�s' );
define( '_SW_STEP_2', '2. l�p�s' );
define( '_SW_STEP_3', '3. l�p�s' );
define( '_SW_SELECTED_ITEM', 'Kiv�lasztott men�pont' );
define( '_SW_NONE_SELECTED', 'Nincs kiv�lasztva' );
define( '_SW_ITEM_PROPERTIES', 'Men�pont tulajdons�gai' );
define( '_SW_SHOW_ITEM', 'Men�pont megjelen�t�se' );
define( '_SW_SHOW_ITEM_NAME', 'Men�pont nev�nek megjelen�t�se' );
define( '_SW_IS_LINK', 'A men�pont egyben hivatkoz�s is' );
define( '_SW_IMAGE_ALIGN', 'K�p igaz�t�sa' );

//Select box text
define( '_SW_CSS_SELECT', 'V�lassza ki a szerkeszteni k�v�nt CSS �rt�ket' );
define( '_SW_COMPLETE_BORDER_SELECT', '�sszes szeg�ly' );
define( '_SW_BORDER_TOP_SELECT', 'Fels� szeg�ly' );
define( '_SW_BORDER_RIGHT_SELECT', 'Jobb oldali szeg�ly' );
define( '_SW_BORDER_BOTTOM_SELECT', 'Als� szeg�ly' );
define( '_SW_BORDER_LEFT_SELECT', 'Bal oldali szeg�ly' );
define( '_SW_PADDING_SELECT', 'Sz�vegt�vols�g' );
define( '_SW_MARGIN_SELECT', 'Marg�' );
define( '_SW_BACKGROUND_SELECT', 'H�tt�r' );
define( '_SW_TEXT_SELECT', 'Sz�veg' );
define( '_SW_FONT_SELECT', 'Bet�' );
define( '_SW_OFFSET_SELECT', 'Eltol�s' );
define( '_SW_DIMENSION_SELECT', 'M�ret' );
define( '_SW_EFFECT_SELECT', 'K�l�nleges effektusok' );

define( '_SW_AUTO_SELECT', 'Kiv�lasztott men�pontok ' );
define( '_SW_AUTO_ALL_SELECT', '�sszes men�pont' );
define( '_SW_AUTO_TOP_SELECT', 'F�men�pontok' );
define( '_SW_AUTO_SUB_SELECT', 'Almen�pontok' );
define( '_SW_AUTO_FOLDER_SELECT', 'Szekci�/kateg�ria men�pontok' );
define( '_SW_AUTO_DOCUMENT_SELECT', 'Tartalmi elemek' );

define( '_SW_ATTRIBUTE_SELECT', 'Szerkeszteni k�v�nt attrib�tum kiv�laszt�sa' );
define( '_SW_ATTRIBUTE_IMAGE_SELECT', 'Norm�l k�p' );
define( '_SW_ATTRIBUTE_OVER_IMAGE_SELECT', 'Eg�rr�viteli k�p' );
define( '_SW_ATTRIBUTE_SHOW_NAME_SELECT', 'Men�pont nev�nek megjelen�t�se' );
define( '_SW_ATTRIBUTE_DONT_SHOW_NAME_SELECT', 'Men�pont nev�nek elrejt�se' );
define( '_SW_ATTRIBUTE_IS_LINK_SELECT', 'A men�pont hivatkoz�s is egyben' );
define( '_SW_ATTRIBUTE_IS_NOT_LINK_SELECT', 'A men�pont nem hivatkoz�s' );
define( '_SW_ATTRIBUTE_SHOW_ITEM_SELECT', 'Men�pont megjelen�t�se' );
define( '_SW_ATTRIBUTE_DONT_SHOW_ITEM_SELECT', 'Men�pont elrejt�se' );
define( '_SW_ATTRIBUTE_IMAGE_LEFT_SELECT', 'K�p igaz�t�sa balra' );
define( '_SW_ATTRIBUTE_IMAGE_RIGHT_SELECT', 'K�p igaz�t�sa jobbra' );
define( '_SW_ATTRIBUTE_CSS_SELECT', 'Norm�l st�lus' );
define( '_SW_ATTRIBUTE_OVER_CSS_SELECT', 'Eg�rr�vitel st�lusa' );


//Extra CSS text
define( '_SW_CSS', 'CSS' );
define( '_SW_CSS_OVER', 'Eg�rr�vitel st�lusa' );
define( '_SW_IMAGE', 'K�p' );
define( '_SW_IMAGE_OVER', 'Eg�rr�viteli k�p' );
define( '_SW_PREVIEW', 'El�n�zet' );
define( '_SW_IMAGE_URL', 'K�p el�r�si �tvonala' );
define( '_SW_HSPACE', 'V�zszintes t�rk�z' );
define( '_SW_VSPACE', 'F�gg�leges t�rk�z' );




define( '_SW_REPEAT', 'T�bbsz�r�z�s' );
define( '_SW_TEXT_DECORATION', 'Sz�vegst�lus' );
define( '_SW_TEXT_TRANSFORM', 'Bet�v�ltozat' );
define( '_SW_TEXT_INDENT', 'Beh�z�s' );
define( '_SW_WHITE_SPACE', 'Helyk�z' );
define( '_SW_FONT_STYLE', 'Bet�st�lus' );

//tool tips
define( '_SW_STEP_1_TIP', 'V�lassza ki azt a men�pont csoportot, amelyen alkalmazni szeretn� a v�ltoztat�sokat.' );
define( '_SW_STEP_2_TIP', 'V�lassza ki a m�dos�tani k�v�nt attrib�tumot.' );
define( '_SW_STEP_3_TIP', 'Nyomja meg az Alkalmaz gombot, hogy a men�pontokhoz rendelje a kiv�lasztott attrib�tumokat.' );



//////////////////////////////
//Size Position & Offsets Page
/////////////////////////////
define( '_SW_POSITION_LABEL', 'Men� helye �s ir�nya' );
define( '_SW_SIZES_LABEL', 'Men�pont m�retei' );
define( '_SW_TOP_OFFSETS_LABEL', 'F�men� ir�nya' );
define( '_SW_SUB_OFFSETS_LABEL', 'Almen� ir�nya' );
define( '_SW_CLICK_DIMENSIONS_LABEL', 'Kattint�sos men� m�rete' );
define( '_SW_ALIGNMENT_LABEL', 'Men� igaz�t�sa' );
define( '_SW_WIDTHS_LABEL', 'Men�pont sz�less�ge' );
define( '_SW_HEIGHTS_LABEL', 'Men�pont magass�ga' );
define( '_SW_COMPLETE_PADDING_LABEL', 'Az eg�sz men� sz�vegt�vols�ga' );

	//tree menus
define( '_SW_OTHER_SETTINGS_LABEL', 'Egy�b be�ll�t�sok' );
define( '_SW_TREE_WIDTH_LABEL', 'Men� sz�less�ge' );
define( '_SW_FOLDER_LINKS', 'A mapp�k hivatkoz�sok' );
define( '_SW_USE_LINES', 'Vonalak haszn�lata' );
define( '_SW_USE_ICONS', 'Ikonok haszn�lata' );

define( '_SW_TOP_MENU', 'F�men�' );
define( '_SW_SUB_MENU', 'Almen�' );
define( '_SW_ALIGNMENT', 'sz�vegigaz�t�s' );
define( '_SW_POSITION', 'poz�ci�ja' );
define( '_SW_ORIENTATION', 'ir�nya' );
define( '_SW_ITEM_WIDTH', 'men�pont sz�less�ge' );
define( '_SW_ITEM_HEIGHT', 'men�pont magass�ga' );
define( '_SW_TOP_OFFSET', 'eltol�s fentr�l' );
define( '_SW_LEFT_OFFSET', 'eltol�s balr�l' );
define( '_SW_LEVEL', 'Szint' );
define( '_SW_AUTOSIZE', '0 �rt�k eset�n automatikus m�retez�s' );
define( '_SW_TAB_MARGIN', 'Men�pontok k�zti t�vols�g' );


//////////////////////
//Fonts & Padding Page
/////////////////////
define( '_SW_FONT_FAMILY_LABEL', 'Bet�csal�d' );
define( '_SW_FONT_SIZE_LABEL', 'Bet�m�ret' );
define( '_SW_FONT_ALIGNMENT_LABEL', 'Sz�vegigaz�t�s' );
define( '_SW_FONT_WEIGHT_LABEL', 'Bet�vastags�g' );
define( '_SW_PADDING_LABEL', 'Sz�vegt�vols�g' );


define( '_SW_TOP', 'Fentr�l' );
define( '_SW_RIGHT', 'Jobbr�l' );
define( '_SW_BOTTOM', 'Alulr�l' );
define( '_SW_LEFT', 'Balr�l' );
define( '_SW_FONT_SIZE', 'bet�m�rete' );
define( '_SW_FONT_ALIGNMENT', 'sz�vegigaz�t�s' );
define( '_SW_FONT_WEIGHT', 'bet�vastags�ga' );
define( '_SW_PADDING', 'sz�vegt�vols�ga' );
define( '_SW_FONT_TIP', 'Minden b�ng�sz� elt�r� m�don jelen�ti meg az egyes bet�ket, ill. bet�m�reteket. Az al�bbi lista megmutatja, hogy az �n b�ng�sz�je hogyan jelen�ti meg a k�l�nb�z� bet�ket �s bet�m�reteket.' );

/////////////////////////
//Borders & Effects Page
////////////////////////
define( '_SW_BORDER_WIDTHS_LABEL', 'Szeg�ly vastags�ga' );
define( '_SW_BORDER_STYLES_LABEL', 'Szeg�ly st�lusa' );
define( '_SW_SPECIAL_EFFECTS_LABEL', 'K�l�nleges effektusok' );

define( '_SW_OUTSIDE_BORDER', 'k�ls� szeg�ly�nek' );
define( '_SW_INSIDE_BORDER', 'bels� szeg�ly�nek' );
define( '_SW_NORMAL_BORDER', 'szeg�ly�nek' );
define( '_SW_OVER_BORDER', 'eg�rr�viteli szeg�ly�nek' );
define( '_SW_WIDTH', 'sz�less�ge' );
define( '_SW_HEIGHT', 'magass�ga' );
define( '_SW_DIVIDER', 'Elv�laszt�' );
define( '_SW_STYLE', 'st�lusa' );
define( '_SW_DELAY', 'Almen� nyit�s�nak k�sleltet�se' );
define( '_SW_OPACITY', '�tl�tsz�s�ga' );

///////////////////////////
//Colors & Backgrounds Page
///////////////////////////
define( '_SW_BACKGROUND_IMAGE_LABEL', 'H�tt�rk�p' );
define( '_SW_BACKGROUND_COLOR_LABEL', 'H�tt�r sz�ne' );
define( '_SW_FONT_COLOR_LABEL', 'Bet�sz�n' );
define( '_SW_BORDER_COLOR_LABEL', 'Szeg�ly sz�ne' );

//tab menus
define( '_SW_TAB_ACTIVE', 'Akt�v men�pont' );
define( '_SW_TAB_TOP', 'F�men�pont' );
define( '_SW_DIVIDER_COLOR', 'Elv�laszt� sz�ne' );

//tree menu
define( '_SW_ICONS_LABEL', 'Men� ikonok' );
define( '_SW_ICON_TOP', 'F�ikon' );
define( '_SW_ICON_FOLDER', 'Mappa ikonja' );
define( '_SW_ICON_FOLDER_OPEN', 'Nyitott mappa ikonja' );
define( '_SW_ICON_DOCUMENT', 'Tartalmi elem ikonja' );


define( '_SW_BACKGROUND', 'h�ttere' );
define( '_SW_OVER_BACKGROUND', 'eg�rr�viteli h�ttere' );
define( '_SW_COLOR', 'sz�ne' );
define( '_SW_OVER_COLOR', 'eg�rr�viteli sz�ne' );
define( '_SW_FONT', 'bet�sz�ne' );
define( '_SW_OVER_FONT', 'eg�rr�viteli bet�sz�ne' );
define( '_SW_OUTSIDE_BORDER_COLOR', 'k�ls� szeg�ly�nek sz�ne' );
define( '_SW_INSIDE_BORDER_COLOR', 'bels� szeg�ly�nek sz�ne' );
define( '_SW_NORMAL_BORDER_COLOR', 'szeg�ly�nek sz�ne' );
define( '_SW_OVER_BORDER_COLOR', 'eg�rr�viteli szeg�lysz�ne' );
define( '_SW_GET', 'Be�ll�t' );
define( '_SW_COLOR_TIP', 'V�lassza ki a sz�nt a palett�r�l, majd kattintson a paletta melletti %s gombra a kiv�lasztott sz�n alkalmaz�s�hoz.');
define( '_SW_PRESENT_COLOR', 'Jelenlegi sz�n' );
define( '_SW_SELECTED_COLOR', 'Kiv�lasztott sz�n' );


///////////////////////////
//Menu Module Settings Page
///////////////////////////
define( '_SW_MENU_SOURCE_LABEL', 'Men�forr�s be�ll�t�sa' );
define( '_SW_STYLE_SHEET_LABEL', 'St�luslap be�ll�t�sa' );
define( '_SW_AUTO_ITEM_LABEL', 'Automatikus men�pontok be�ll�t�sa' );
define( '_SW_CACHE_LABEL', 'Gyors�t�t�r be�ll�t�sa' );
define( '_SW_GENERAL_LABEL', '�ltal�nos modulbe�ll�t�sok' );
define( '_SW_POSITION_ACCESS_LABEL', 'Poz�ci� �s hozz�f�r�s' );
define( '_SW_PAGES_LABEL', 'Men�modul megjelen�t�se a kiv�lasztott oldalakon' );
define( '_SW_CONDITIONS_LABEL', 'Felt�telek' );

//Select box text
define( '_SW_CSS_DYNAMIC_SELECT', 'St�lusinform�ci�k �r�sa k�zvetlen�l az oldal forr�sk�dj�ba' );
define( '_SW_CSS_LINK_SELECT', 'Hivatkoz�s k�ls� st�luslapra' );
define( '_SW_CSS_IMPORT_SELECT', 'K�ls� st�luslap import�l�sa' );
define( '_SW_CSS_NONE_SELECT', 'Nincs hivatkoz�s st�luslapra' );

define( '_SW_SOURCE_CONTENT_SELECT', 'Csak tartalmi elemek haszn�lata' );
define( '_SW_SOURCE_EXISTING_SELECT', 'V�lasszon az al�bbi men�k k�z�l' );

define( '_SW_SHOW_TABLES_SELECT', 'Megjelen�t�s t�bl�zatk�nt' );
define( '_SW_SHOW_BLOGS_SELECT', 'Megjelen�t�s blogk�nt' );

define( '_SW_10SECOND_SELECT', '10 m�sodperc' );
define( '_SW_1MINUTE_SELECT', '1 perc' );
define( '_SW_30MINUTE_SELECT', '30 perc' );
define( '_SW_1HOUR_SELECT', '1 �ra' );
define( '_SW_6HOUR_SELECT', '6 �ra' );
define( '_SW_12HOUR_SELECT', '12 �ra' );
define( '_SW_1DAY_SELECT', '1 nap' );
define( '_SW_3DAY_SELECT', '3 nap' );
define( '_SW_1WEEK_SELECT', '1 h�t' );

//top tabs text
define( '_SW_MODULE_SETTINGS_TAB', 'Men�modul be�ll�t�sa' );
define( '_SW_SIZE_OFFSETS_TAB', 'M�ret, poz�ci� �s eltol�s' );
define( '_SW_COLOR_BACKGROUNDS_TAB', 'Sz�nek �s h�tt�r' );
define( '_SW_FONTS_PADDING_TAB', 'Bet� �s sz�vegt�vols�g' );
define( '_SW_BORDERS_EFFECTS_TAB', 'Szeg�lyek �s effektusok' );
define( '_SW_IMAGES_CSS_TAB', 'Men�pont k�pei �s CSS' );
define( '_SW_TREE_SIZE_TAB', 'M�ret �s egy�b be�ll�t�sok' );

//general text
define( '_SW_MENU_SOURCE', 'Men� forr�sa' );
define( '_SW_PARENT', 'Sz�l�' );
define( '_SW_STYLE_SHEET', 'St�luslap bet�lt�se' );
define( '_SW_CLASS_SFX', 'Modul st�lusoszt�ly-ut�tag' );
define( '_SW_HYBRID_MENU', 'Hibrid men�' );
define( '_SW_TABLES_BLOGS', 'T�bl�zat/blog haszn�lata' );
define( '_SW_CACHE_ITEMS', 'Men�pontok cach-el�se' );
define( '_SW_CACHE_REFRESH', 'Gyors�t�t�r friss�t�si ideje' );
define( '_SW_SHOW_NAME', 'Moduln�v megjelen�t�se' );
define( '_SW_PUBLISHED', 'K�zz�t�ve');
define( '_SW_ACTIVE_MENU', 'Akt�v men�' );
define( '_SW_MAX_LEVELS', 'Szintek sz�ma' );
define( '_SW_PARENT_LEVEL', 'Sz�l� elem szintje' );
define( '_SW_SELECT_HACK', 'Leg�rd�l� lista hibajav�t�sa' );
define( '_SW_SUB_INDICATOR', 'Almen�jelz� ikon' );
define( '_SW_SHOW_SHADOW', '�rny�k megjelen�t�se' );
define( '_SW_MODULE_POSITION', 'Modulpoz�ci�' );
define( '_SW_MODULE_ORDER', 'Modulok sorrendje' );
define( '_SW_ACCESS_LEVEL', 'Hozz�f�r�si szint' );
define( '_SW_TEMPLATE', 'Sablon' );
define( '_SW_LANGUAGE', 'Nyelv' );
define( '_SW_COMPONENT', 'Komponens' );

//tool tips
define( '_SW_MENU_SOURCE_TIP', 'V�lassza ki azt az �rv�nyes/l�tez� men�t, amely forr�sk�nt szolg�l a men�modul sz�m�ra.' );
define( '_SW_PARENT_TIP', 'V�lassza ki azt a sz�l� elemet, amely megjelen�ti a forr�smen� egy r�sz�t. Ha mindegyik men�pontot meg akarja jelen�teni, akkor a sz�l� elemet �ll�tsa TOP-ra .' );
define( '_SW_STYLE_SHEET_TIP', '<b>Dinamikus: </b>k�zvetlen�l abba a lapba ker�lnek a st�lusinform�ci�k, amely a modult megjelen�ti.<br /><b>K�ls� hivatkoz�s: </b>egy, m�r kimentett k�ls� st�luslapra hivatkozik.<br /><b>Nincs hivatkoz�s:</b> Saj�tkez�leg illessze be a k�ls� st�luslapra mutat� hivatkoz�st, sablonj�nak fejl�c r�sz�ben. A men�modulja �gy lesz teljesen m�k�d�k�pes.' );
define( '_SW_CLASS_SFX_TIP', 'Az ut�tagot helyezze a sablonj�ban egy .moduletable st�lusoszt�ly el�. Ezzel elker�lheti a t�bbi st�lusoszt�llyal val� �tk�z�st, �s m�g t�bb param�tert tud testreszabni a sablonja seg�ts�g�vel. ' );
define( '_SW_HYBRID_MENU_TIP', 'A kateg�ria, szekci� �s blog t�pus� men�pontokhoz automatikusan hozz�f�zi azok tartalmi elemeit is.' );
define( '_SW_TABLES_BLOGS_TIP', 'Az automatikusan l�trehozott szekci�/kateg�ria elemeket t�bl�zatos vagy blog form�tumban jelen�ti meg.' );
define( '_SW_CACHE_ITEMS_TIP', 'Egy f�jlt haszn�l �tmeneti t�rol�k�nt, hogy abban t�rolja a men�pontokat, �s ez�ltal n�velje a teljes�tm�nyt. K�l�n�sen hasznos a hibrid men�n�l, ahol a nagyobb men�, t�bb SQL k�r�s lefuttat�s�t teszi sz�ks�gess�. Az �tmeneti t�rol� k�t friss�t�s k�z�tt ezt egyetlen sornyi lek�rdez�sre cs�kkenti.' );
define( '_SW_CACHE_REFRESH_TIP', 'Az �tmeneti t�rol� friss�t�s�nek gyakoris�ga.' );
define( '_SW_SHOW_NAME_TIP', 'Megjelen�ti a modul nev�t.' );
define( '_SW_PUBLISHED_TIP', 'K�zz�teszi vagy visszavonja a men�modult.');
define( '_SW_ACTIVE_MENU_TIP', 'Az aktu�lisan haszn�lt f�men�pontot k�l�n sz�nnel emeli ki, mindaddig, m�g az �ltala hivatkozott oldalon tart�zkodunk.' );
define( '_SW_MAX_LEVELS_TIP', 'A megjelen�tend� forr�smen� szintjeinek sz�ma. Az �sszes szint megjelen�t�s�hez �ll�tsa 0-ra.' );
define( '_SW_PARENT_LEVEL_TIP', 'Olyan speci�lis be�ll�t�s, amely a modul men�forr�s�t egy el�re be�ll�tott szintig k�veti vissza.  Az alap�rt�k 0.' );
define( '_SW_SELECT_HACK_TIP', 'Olyan hibajav�t�st alkalmaz a men�n, amely lehet�v� teszi az almen�k sz�m�ra, hogy IE-ben az �rlapokon szerepl� leg�rd�l� lista felett is megfelel�en m�k�djenek.' );
define( '_SW_SUB_INDICATOR_TIP', 'Megjelen�t egy kis ny�l ikont azokban az almen�pontokban, amelyeknek tov�bbi men�pontjaik vannak.' );
define( '_SW_SHOW_SHADOW_TIP', 'Megjelen�ti az �rny�kot az almen�k k�r�l.' );
define( '_SW_MODULE_POSITION_TIP', 'A men�modul poz�ci�ja a sablonban.' );
define( '_SW_MODULE_ORDER_TIP', 'A men�modul sorrendje az adott poz�ci�ban.' );
define( '_SW_ACCESS_LEVEL_TIP', 'A men�modul hozz�f�r�si szintje.' );
define( '_SW_TEMPLATE_TIP', 'A men�modul csak a kiv�lasztott sablonban jelenik meg.' );
define( '_SW_LANGUAGE_TIP', 'A men�modul csak a kiv�lasztott nyelven jelenik meg.' );
define( '_SW_COMPONENT_TIP', 'A men�modul csak a kiv�lasztott komponenssel egy�tt jelenik meg.' );
define( '_SW_PAGES_TIP', 'Oldalak kiv�laszt�sa: <i>(A CTRL gomb nyomva tart�s�val egyszerre t�bb oldalt is kijel�lhet.)</i>' );


?>