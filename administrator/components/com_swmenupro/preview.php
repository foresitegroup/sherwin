<?php
/**
* swmenupro v5.0
* http://swonline.biz
* Copyright 2006 Sean White
**/

//error_reporting (E_ERROR | E_WARNING | E_PARSE | E_NOTICE); 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once($mosConfig_absolute_path ."/modules/mod_swmenupro/styles.php");
require_once($mosConfig_absolute_path ."/modules/mod_swmenupro/functions.php");

$css_load=0;
$preview=0;
$id=0;
$q = explode("&",$_SERVER["QUERY_STRING"]);
foreach ($q as $qi)
{
  if ($qi != "")
  {
    $qa = explode("=",$qi);
    list ($key, $val) = $qa;
    if ($val)
      $$key = urldecode($val);
  }
}
 
reset ($_POST);
while (list ($key, $val) = each ($_POST))
{
  if ($val)
    $$key = $val;
    $swmenupro[$key]=$val;
}

$database->setQuery( "SELECT * FROM #__modules WHERE id='$id'" );
$row = null;
$database->loadObject( $row );


if($preview==1){
	$id=mosGetParam( $_POST, 'mid', 0 );
	$database->setQuery( "SELECT * FROM #__modules WHERE id='$id'" );
$row = null;
$database->loadObject( $row );
	//echo $id;
	$query = "SELECT * FROM #__swmenu_config WHERE id = ".$id;
	$database->setQuery( $query );
	$new_data = $database->query();
	$swmenupro= mysql_fetch_assoc($new_data);

    $params = mosParseParams( $row->params );
    $menu = @$params->menutype ? $params->menutype : 'mainmenu';
    $moduleID = @$params->moduleID;
    $menustyle = @$params->menustyle;
    $parent_id = @$params->parentid ? $params->parentid : 0;
    $hybrid = @$params->hybrid ? $params->hybrid : 0;
    $active_menu = @$params->active_menu ? $params->active_menu : 0;
    $parent_level = @$params->parent_level ? $params->parent_level: 0;
    $levels = @$params->levels ? $params->levels: 0;
    $sub_indicator = @$params->sub_indicator ?  $params->sub_indicator :  0;
    $show_shadow = @$params->show_shadow ?  $params->show_shadow :  0;
    $selectbox_hack=@$params->selectbox_hack?$params->selectbox_hack:0;
	//$css_load = mosGetParam( $_POST, 'cssload', 0 );


}else if($preview==2){
	$query = "SELECT * FROM #__swmenu_config WHERE id = ".$id;
$database->setQuery( $query );
$new_data = $database->query();
$swmenupro= mysql_fetch_assoc($new_data);

    $params = mosParseParams( $row->params );
    $menu = @$params->menutype ? $params->menutype : 'mainmenu';
    $moduleID = @$params->moduleID;
    $menustyle = @$params->menustyle;
    $parent_id = @$params->parentid ? $params->parentid : 0;
    $hybrid = @$params->hybrid ? $params->hybrid : 0;
    $active_menu = @$params->active_menu ? $params->active_menu : 0;
    $parent_level = @$params->parent_level ? $params->parent_level: 0;
    $levels = @$params->levels ? $params->levels: 0;
    $sub_indicator = @$params->sub_indicator ?  $params->sub_indicator :  0;
    $show_shadow = @$params->show_shadow ?  $params->show_shadow :  0;
	$css_load = @$params->cssload ?  $params->cssload :  0;
	$selectbox_hack=@$params->selectbox_hack?$params->selectbox_hack:0;

}else{

	$menu=mosGetParam( $_POST, 'menutype', "mainmenu" );
	$parent_id=mosGetParam( $_POST, 'parentid', 0 );
	$levels=mosGetParam( $_POST, 'levels', 0 );
   
    $moduleID = mosGetParam( $_POST, 'id', 0 );
    $hybrid = mosGetParam( $_POST, 'hybrid', 0 );
    $active_menu = mosGetParam( $_POST, 'active_menu', 0 );
    $parent_level = mosGetParam( $_POST, 'parent_level', 0 );
    $tables = mosGetParam( $_POST, 'tables', 0 );
	$selectbox_hack=mosGetParam( $_POST, 'selectbox_hack', 0 );
   $id=$id?$id:1000000;
     $sub_indicator = mosGetParam( $_POST, 'sub_indicator', 0 );
      $show_shadow = mosGetParam( $_POST, 'show_shadow', 0 );
	$swmenupro['id']=$swmenupro['id']?$swmenupro['id']:0;
	
}


global $database, $my, $Itemid;
global $mosConfig_shownoauth, $mosConfig_dbprefix;

if($menu && $id && $menustyle){

$content= "\n<!--SWmenuPro4.5 ".$menustyle." by http://www.swonline.biz-->\n";   

if($menu && $id && $menustyle){
	
	 $final_menu =array();
	 $swmenupro_array=swGetMenuLinks($menu,$id,$hybrid,1);
	 $ordered = chain('ID', 'PARENT', 'ORDER', $swmenupro_array, $parent_id, $levels);
	 $moduleid = mosGetParam( $_POST, 'moduleID', array(0) );
     $menutype = mosGetParam( $_POST, 'menutype', '' );
	 $images_preview = mosGetParam( $_POST, 'images_preview', 0 );
	if ($images_preview){
    		
			
           
            for($i=0;$i<count($ordered);$i++){
            	$swmenu=$ordered[$i];
            	$normal_css="";
            	$swmenu['URL'] = "javascript:void(0)";
                $image = mosGetParam( $_POST,'tree-'.($i+1).'-image', "" );
                $imageover = mosGetParam( $_POST, 'tree-'.($i+1).'-image_over', "" );
                $image_hspace = mosGetParam( $_POST,'tree-'.($i+1).'_hspace', 0 );
                $imageover_hspace = mosGetParam( $_POST, 'tree-'.($i+1).'_over_hspace', 0 );
                $image_vspace = mosGetParam( $_POST,'tree-'.($i+1).'_vspace', 0 );
                $imageover_vspace = mosGetParam( $_POST, 'tree-'.($i+1).'_over_vspace', 0 );
                $image_width = mosGetParam( $_POST,'tree-'.($i+1).'_width', 0 );
                $imageover_width = mosGetParam( $_POST, 'tree-'.($i+1).'_over_width', 0 );
                $image_height = mosGetParam( $_POST,'tree-'.($i+1).'_height', 0 );
                $imageover_height = mosGetParam( $_POST, 'tree-'.($i+1).'_over_height', 0 );
                $image_align = mosGetParam( $_POST,'tree-'.($i+1).'_image_align', "left" );
                $showname = mosGetParam( $_POST, 'tree-'.($i+1).'_showname', 0 );
                $showitem = mosGetParam( $_POST, 'tree-'.($i+1).'_showitem', "0" );
                $normal_css = mosGetParam( $_POST,'tree-'.($i+1).'_normal_css', "" );
                $over_css = mosGetParam( $_POST, 'tree-'.($i+1).'_over_css', "" );
	
                if ($image){
               
                   $swmenu['IMAGE']=substr($image,3).",".$image_width.",".$image_height.",".$image_vspace.",".$image_hspace;
                }
                if ($imageover){
                   $swmenu['IMAGEOVER']=substr($imageover,3).",".$imageover_width.",".$imageover_height.",".$imageover_vspace.",".$imageover_hspace;
                }
                if ($image_align){
                   $swmenu['IMAGEALIGN']=$image_align;
                }
               
               $swmenu['NCSS']=$normal_css;
               $swmenu['OCSS']=$over_css;
               $swmenu['SHOWITEM']=$showitem;
          	   $swmenu['SHOWNAME']=$showname;
              
              if($swmenu['SHOWITEM']) { 
            	$final_menu[] =array("TITLE" => $swmenu['TITLE'], "URL" =>  $swmenu['URL'] , "ID" => $swmenu['ID']  , "PARENT" => $swmenu['PARENT'] ,  "ORDER" => $swmenu['ORDER'], "IMAGE" => $swmenu['IMAGE'], "IMAGEOVER" => $swmenu['IMAGEOVER'], "SHOWNAME" => $swmenu['SHOWNAME'], "IMAGEALIGN" => $swmenu['IMAGEALIGN'], "TARGETLEVEL" => $swmenu['TARGETLEVEL'], "TARGET" => 0,"ACCESS" => $swmenu['ACCESS'],"NCSS" => $swmenu['NCSS'],"OCSS" => $swmenu['OCSS'],"SHOWITEM" => $swmenu['SHOWITEM']   );
              }
        }
       
    }else{
    	
    	 for($i=0;$i<count($ordered);$i++){
            	$swmenu=$ordered[$i];
            	$swmenu['URL'] = "javascript:void(0)";
            	if($swmenu['SHOWITEM']==null || $swmenu['SHOWITEM']==1 ){
				$swmenu['SHOWITEM']=1;
				}else{
				$swmenu['SHOWITEM']=0;
				}
				if($swmenu['SHOWITEM']) { 
            		$final_menu[] =array("TITLE" => $swmenu['TITLE'], "URL" =>  $swmenu['URL'] , "ID" => $swmenu['ID']  , "PARENT" => $swmenu['PARENT'] ,  "ORDER" => $swmenu['ORDER'], "IMAGE" => $swmenu['IMAGE'], "IMAGEOVER" => $swmenu['IMAGEOVER'], "SHOWNAME" => $swmenu['SHOWNAME'], "IMAGEALIGN" => $swmenu['IMAGEALIGN'], "TARGETLEVEL" => $swmenu['TARGETLEVEL'], "TARGET" => 0,"ACCESS" => $swmenu['ACCESS'],"NCSS" => $swmenu['NCSS'],"OCSS" => $swmenu['OCSS'],"SHOWITEM" => $swmenu['SHOWITEM']   );
             	}
    	 }
    }

	if(count($final_menu)){
	$swmenupro['position']="center";
		$ordered = chain('ID', 'PARENT', 'ORDER', $final_menu, $parent_id, $levels);
		if ($menustyle == "clickmenu"){$content.= doClickMenuPreview($ordered, $swmenupro, $css_load,$active_menu);}
		if ($menustyle == "slideclick"){$content.= doSlideClickPreview($ordered, $swmenupro, $css_load,$active_menu,$selectbox_hack);}
		
		if ($menustyle == "treemenu"){$content.= doTreeMenuPreview($ordered, $swmenupro, $css_load,$active_menu);}
		if ($menustyle == "popoutmenu"){$content.= doPopoutMenuPreview($ordered, $swmenupro, $css_load, $active_menu);}
		if ($menustyle == "gosumenu" ){$content.= doGosuMenuPreview($ordered, $swmenupro, $active_menu, $css_load,$selectbox_hack);}
		if ($menustyle == "transmenu"){$content.= doTransMenuPreview($ordered, $swmenupro, $active_menu, $sub_indicator, $parent_id, $css_load,0,$show_shadow);}
		if ($menustyle == "tabmenu"){$content.= doTabMenuPreview($ordered, $swmenupro, $parent_id, $css_load,$active_menu);}
		if ($menustyle == "dynamictabmenu"){$content.= doDynamicTabMenuPreview($ordered, $swmenupro, $parent_id, $css_load,$active_menu);}
	}
}
$content.="\n<!--End SWmenuPro menu module-->\n";

}



function doClickMenuPreview($ordered, $swmenupro, $css_load, $active_menu){
global $mosConfig_live_site;
echo previewHead();
echo '<script type="text/javascript" src="'.$mosConfig_live_site.'/modules/mod_swmenupro/ClickShowHideMenu_Packed.js"></script>';

$manual=mosGetParam($_POST,"preview",0);
if($manual==1){
	$css=mosGetParam($_POST,"filecontent",'');
	echo "\n<style type='text/css'>\n";
	echo "<!--\n";
	echo	str_replace("\\","",$css);
	echo "\n-->\n";
	echo "</style>\n";
}else if($css_load){
	
echo "<link type='text/css' href='".$mosConfig_live_site."/modules/mod_swmenupro/styles/menu".$swmenupro['id'].".css' rel='stylesheet' />\n";

}else{

$swmenupro = fixPadding($swmenupro);
	echo "\n<style type='text/css'>\n";
	echo "<!--\n";
echo ClickMenuStyle($swmenupro,$ordered);
echo "\n-->\n";
	echo "</style>\n";
}
echo "</head><body>";
echo ClickMenu($ordered, $swmenupro, $active_menu);
echo changeBgColor();
echo "</body></html>";
}

function doSlideClickPreview($ordered, $swmenupro, $css_load, $active_menu,$expand){
global $mosConfig_live_site;
echo previewHead();
echo '<script type="text/javascript" src="'.$mosConfig_live_site.'/modules/mod_swmenupro/prototype.lite.js"></script>';
echo '<script type="text/javascript" src="'.$mosConfig_live_site.'/modules/mod_swmenupro/moo.fx.js"></script>';
echo '<script type="text/javascript" src="'.$mosConfig_live_site.'/modules/mod_swmenupro/moo.fx.pack.js"></script>';


$manual=mosGetParam($_POST,"preview",0);
if($manual==1){
	$css=mosGetParam($_POST,"filecontent",'');
	echo "\n<style type='text/css'>\n";
	echo "<!--\n";
	echo	str_replace("\\","",$css);
	echo "\n-->\n";
	echo "</style>\n";
}else if($css_load){
	
echo "<link type='text/css' href='".$mosConfig_live_site."/modules/mod_swmenupro/styles/menu".$swmenupro['id'].".css' rel='stylesheet' />\n";

}else{

$swmenupro = fixPadding($swmenupro);
	echo "\n<style type='text/css'>\n";
	echo "<!--\n";
echo SlideClickStyle($swmenupro,$ordered);
echo "\n-->\n";
	echo "</style>\n";
}
echo "</head><body>";
if($swmenupro['orientation']!="vertical"){
	echo "<div align='left'>";
}else{
	echo "<div align='center'>";
}
echo SlideClick($ordered, $swmenupro, $active_menu,$expand);
echo "</div>".changeBgColor();
echo "</body></html>";
}

function doTreeMenuPreview($ordered, $swmenupro, $css_load,$active_menu){
global $mosConfig_live_site;
echo previewHead();
echo '<script type="text/javascript" src="'.$mosConfig_live_site.'/modules/mod_swmenupro/dtree.js"></script>';

$manual=mosGetParam($_POST,"preview",0);
if($manual==1){
	$css=mosGetParam($_POST,"filecontent",'');
	echo "\n<style type='text/css'>\n";
	echo "<!--\n";
	echo	str_replace("\\","",$css);
	echo "\n-->\n";
	echo "</style>\n";
}else if($css_load){
	
echo "<link type='text/css' href='".$mosConfig_live_site."/modules/mod_swmenupro/styles/menu".$swmenupro['id'].".css' rel='stylesheet' />\n";

}else{
echo "\n<style type='text/css'>\n";
	echo "<!--\n";
echo TreeMenuStyle($swmenupro,$ordered);
echo "\n-->\n";
	echo "</style>\n";
}
echo "</head><body>";
echo TreeMenu($ordered, $swmenupro, $active_menu);
echo changeBgColor();
echo "</body></html>";
}


function doPopoutMenuPreview($ordered, $swmenupro, $css_load, $active_menu){
global $mosConfig_live_site;
echo previewHead();
echo '<script type="text/javascript" src="'.$mosConfig_live_site.'/modules/mod_swmenupro/menu.js"></script>';

$manual=mosGetParam($_POST,"preview",0);
if($manual==1){
	$css=mosGetParam($_POST,"filecontent",'');
	echo "\n<style type='text/css'>\n";
	echo "<!--\n";
	echo	str_replace("\\","",$css);
	echo "\n-->\n";
	echo "</style>\n";
}else if($css_load){
	
echo "<link type='text/css' href='".$mosConfig_live_site."/modules/mod_swmenupro/styles/menu".$swmenupro['id'].".css' rel='stylesheet' />\n";

}else{
echo "\n<style type='text/css'>\n";
	echo "<!--\n";
echo TigraMenuStyle($swmenupro,$ordered);
echo "\n-->\n";
	echo "</style>\n";
}
echo "</head><body>";
echo TigraMenu($ordered, $swmenupro, $active_menu);
echo changeBgColor();
echo "</body></html>";
}


function doGosuMenuPreview($ordered, $swmenupro, $active_menu, $css_load,$selectbox_hack){
global $mosConfig_live_site;
echo previewHead();
echo '<script type="text/javascript" src="'.$mosConfig_live_site.'/modules/mod_swmenupro/ie5.js"></script>';
echo '<script type="text/javascript" src="'.$mosConfig_live_site.'/modules/mod_swmenupro/DropDownMenuX_Packed.js"></script>';



$manual=mosGetParam($_POST,"preview",0);
if($manual==1){
	$css=mosGetParam($_POST,"filecontent",'');
	echo "\n<style type='text/css'>\n";
	echo "<!--\n";
	echo	str_replace("\\","",$css);
	echo "\n-->\n";
	echo "</style>\n";
}else if($css_load){
	
echo "<link type='text/css' href='".$mosConfig_live_site."/modules/mod_swmenupro/styles/menu".$swmenupro['id'].".css' rel='stylesheet' />\n";

}else{

$swmenupro = fixPadding($swmenupro);
echo "\n<style type='text/css'>\n";
	echo "<!--\n";
echo gosuMenuStyle($swmenupro,$ordered);
echo "\n-->\n";
	echo "</style>\n";
}
echo "</head><body>";
echo GosuMenu($ordered, $swmenupro, $active_menu,$selectbox_hack);
echo changeBgColor();
echo "</body></html>";
}

function doTabMenuPreview($ordered, $swmenupro, $parent_id,$css_load, $active_menu){
global $mosConfig_live_site;
echo previewHead();
echo "<!--SWmenuPro CSS Tab Menu by http://www.swonline.biz-->\n";
$manual=mosGetParam($_POST,"preview",0);
if($manual==1){
	$css=mosGetParam($_POST,"filecontent",'');
	echo "\n<style type='text/css'>\n";
	echo "<!--\n";
	echo	str_replace("\\","",$css);
	echo "\n-->\n";
	echo "</style>\n";
}else if($css_load){
	
echo "<link type='text/css' href='".$mosConfig_live_site."/modules/mod_swmenupro/styles/menu".$swmenupro['id'].".css' rel='stylesheet' />\n";

}else{
	echo "\n<style type='text/css'>\n";
	echo "<!--\n";
echo cssTabMenuStyle($swmenupro,$ordered);
echo "\n-->\n";
	echo "</style>\n";

}
echo "</head><body>";
echo TabMenu($ordered, $swmenupro, $parent_id, $active_menu);
echo changeBgColor();
echo "</body></html>";

}


function doDynamicTabMenuPreview($ordered, $swmenupro, $parent_id,$css_load,$active_menu){
global $mosConfig_live_site;
echo previewHead();

$manual=mosGetParam($_POST,"preview",0);
if($manual==1){
	$css=mosGetParam($_POST,"filecontent",'');
	echo "\n<style type='text/css'>\n";
	echo "<!--\n";
	echo	str_replace("\\","",$css);
	echo "\n-->\n";
	echo "</style>\n";
}else if($css_load){
	
echo "<link type='text/css' href='".$mosConfig_live_site."/modules/mod_swmenupro/styles/menu".$swmenupro['id'].".css' rel='stylesheet' />\n";

}else{
	echo "\n<style type='text/css'>\n";
	echo "<!--\n";
echo dynamicTabMenuStyle($swmenupro,$ordered);
echo "\n-->\n";
	echo "</style>\n";

}
echo "</head><body>";
echo DynamicTabMenu($ordered, $swmenupro, $parent_id,$active_menu);
echo changeBgColor();
echo "</body></html>";

}

function doTransMenuPreview($ordered, $swmenupro, $active_menu,  $sub_indicator, $parent_id, $css_load,$selectbox_hack,$show_shadow){
global $mosConfig_live_site;
echo previewHead();
echo '<script type="text/javascript" src="'.$mosConfig_live_site.'/modules/mod_swmenupro/transmenu_Packed.js"></script>';
$manual=mosGetParam($_POST,"preview",0);
if($manual==1){
	$css=mosGetParam($_POST,"filecontent",'');
	echo "\n<style type='text/css'>\n";
	echo "<!--\n";
	echo	str_replace( '\\', '', $css );
	echo "\n-->\n";
	echo "</style>\n";
}else if($css_load){
	
echo "<link type='text/css' href='".$mosConfig_live_site."/modules/mod_swmenupro/styles/menu".$swmenupro['id'].".css' rel='stylesheet' />\n";

}else{
$swmenupro = fixPadding($swmenupro);
echo "\n<style type='text/css'>\n";
	echo "<!--\n";
echo transMenuStyle($swmenupro,$ordered,$show_shadow);
echo "\n-->\n";
	echo "</style>\n";

}
echo "</head><body>";
echo transMenu($ordered, $swmenupro, $active_menu,  $sub_indicator, $parent_id,$selectbox_hack);
echo changeBgColor();
echo "</body></html>";
}

function previewHead(){
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
	echo "<head>\n<title>swMenuPro Menu Module Preview</title>\n";
	echo "\n<style type='text/css'>\n";
	echo "<!--\n";
	echo	"body{\nmargin-top:20px;\n}\n";
	echo	"#bg_table{\nposition:absolute;top:400px;left:150px;\n}\n";
	echo "\n-->\n";
	echo "</style>\n";
	?>
<script type="text/javascript">
<!--
function changeBG(){
document.body.style.backgroundColor = document.getElementById('back_color').value;
//alert(document.getElementById('back_color').value);
}

-->
</script>
<?php
 }

function changeBgColor(){
?>
<br />
<table width="300" style="border:1px solid blue;" bgcolor="yellow" id="bg_table"><tr>
<td align="center">Please Select Preview Background Color</td></tr><tr>
<td align="center">
<select name="back_color" id="back_color" onChange="changeBG();" style ="width:200px">
<option  value="white">white</option>
<option  value="red">red</option>
<option  value="blue">blue</option>
<option  value="green">green</option>
<option  value="aqua">aqua</option>
<option  value="black">black</option>
<option  value="gray">gray</option>
<option  value="lime">lime</option>
<option  value="maroon">maroon</option>
<option  value="navy">navy</option>
<option  value="olive">olive</option>
<option  value="purple">purple</option>
<option  value="silver">silver</option>
<option  value="teal">teal</option>
<option  value="yellow">yellow</option>
</select>
</td></tr>
<tr>
   <td align="center"><a href="#" onClick="window.close()">Close Window</a></td>
</tr>
</table>

    <?php
}
?>
 
    
 
