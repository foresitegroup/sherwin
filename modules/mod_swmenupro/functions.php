<?php
/**
* swmenupro v5
* http://swonline.biz
* Copyright 2006 Sean White
**/



function swGetMenu($menu,$id,$hybrid,$cache,$cache_time,$use_table,$parent_id,$levels){

	global $my,$mosConfig_absolute_path, $mosConfig_lang;

	$swmenupro_array=array();
	$ordered=array();
	$file = $mosConfig_absolute_path."/modules/mod_swmenupro/cache/menu".$mosConfig_lang.$id.".cache";
	$final_menu=array();

	if($cache){
		$data="";
    	 if ( !file_exists($file)){
			touch ($file);
			$handle = fopen ($file, 'w');
			$swmenupro_array=swGetMenuLinks($menu,$id,$hybrid,$use_table);
			$ordered = chain('ID', 'PARENT', 'ORDER', $swmenupro_array, $parent_id, $levels);
			for($i=0;$i<count($ordered);$i++){
				$data.=implode("'..'",$ordered[$i])."\n";
			}
			fwrite ($handle, $data);
			fclose ($handle);
			$final_menu=get_Final_Menu($swmenupro_array, $parent_id, $levels);
		}else if(strtotime($cache_time,filemtime($file))< strtotime("now")&&is_writable($file)){
			$handle = fopen ($file, 'w');
			$swmenupro_array=swGetMenuLinks($menu,$id,$hybrid,$use_table);
			$ordered = chain('ID', 'PARENT', 'ORDER', $swmenupro_array, $parent_id, $levels);
			for($i=0;$i<count($ordered);$i++){
				$data.=implode("'..'",$ordered[$i])."\n";
			}
			fwrite ($handle, $data);
			fclose ($handle);
			$final_menu=get_Final_Menu($swmenupro_array, $parent_id, $levels);
		}else if(file_exists($file)){
			$swmenu=file($file);
			for($i=0;$i<count($swmenu);$i++){
				$swmenupro[]=explode("'..'",$swmenu[$i]);
				$final_menu[] =array("TITLE" => $swmenupro[$i][0], "URL" =>  $swmenupro[$i][1] , "ID" => $swmenupro[$i][2]  , "PARENT" => $swmenupro[$i][3] ,  "ORDER" => $swmenupro[$i][4], "IMAGE" => $swmenupro[$i][5], "IMAGEOVER" => $swmenupro[$i][6], "SHOWNAME" => $swmenupro[$i][7], "IMAGEALIGN" => $swmenupro[$i][8], "TARGETLEVEL" => $swmenupro[$i][9], "TARGET" => $swmenupro[$i][10],"ACCESS" => $swmenupro[$i][11],"NCSS" => $swmenupro[$i][12],"OCSS" => $swmenupro[$i][13],"SHOWITEM" => $swmenupro[$i][14] , "TYPE"=>$swmenupro[$i][15], "indent"=>trim(substr($swmenu[$i],(strlen($swmenu[$i])-2))));
			}
			$final_menu=get_Final_Menu($final_menu, $parent_id, $levels);
		}
	}else{
		$swmenupro_array=swGetMenuLinks($menu,$id,$hybrid,$use_table);
		$final_menu=get_Final_Menu($swmenupro_array, $parent_id, $levels);
	}
	return $final_menu;
}


function get_Final_Menu($swmenupro_array, $parent_id, $levels){
	global $my,$mainframe;
	$valid=0;
	$final_menu=array();
	for($i=0;$i<count($swmenupro_array);$i++){
		$swmenu=$swmenupro_array[$i];
		 if($swmenu['SHOWITEM']==null || $swmenu['SHOWITEM']==1){
		$swmenu['SHOWITEM']=1;
	}else{
		$swmenu['SHOWITEM']=0;
	}
		if(($swmenu['ACCESS']<=$my->gid && $swmenu['SHOWITEM'] ) ){
			if ($swmenu['PARENT']==$parent_id) {
				$valid++;
			}
			if (strcasecmp(substr($swmenu['URL'],0,4),"http")) {
				$swmenu['URL'] = sefRelToAbs($swmenu['URL']);
			}
			$swmenu['URL']=str_replace('&amp;','&',$swmenu['URL']);
			$final_menu[] =array("TITLE" => $swmenu['TITLE'], "URL" =>  $swmenu['URL'] , "ID" => $swmenu['ID']  , "PARENT" => $swmenu['PARENT'] ,  "ORDER" => $swmenu['ORDER'], "IMAGE" => $swmenu['IMAGE'], "IMAGEOVER" => $swmenu['IMAGEOVER'], "SHOWNAME" => $swmenu['SHOWNAME'], "IMAGEALIGN" => $swmenu['IMAGEALIGN'], "TARGETLEVEL" => $swmenu['TARGETLEVEL'], "TARGET" => $swmenu['TARGET'],"ACCESS" => $swmenu['ACCESS'],"NCSS" => $swmenu['NCSS'],"OCSS" => $swmenu['OCSS'],"SHOWITEM" => $swmenu['SHOWITEM']   );
		}
	}
	if(count($final_menu)&&$valid){
		$final_menu = chain('ID', 'PARENT', 'ORDER', $final_menu, $parent_id, 25);
	}else{
		$final_menu=array();
	}
	return $final_menu;
}



function swGetMenuLinks($menu,$id,$hybrid,$use_tables){
	global $mosConfig_lang, $database,$my,$mosConfig_absolute_path,$mosConfig_offset;
	$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );
	$swmenupro_array=array();
	if ($menu=="swcontentmenu") {
		$sql =  "SELECT #__sections.* , #__swmenu_extended.*
                FROM #__sections LEFT JOIN #__swmenu_extended ON #__sections.id = #__swmenu_extended.menu_id
                AND (#__swmenu_extended.moduleID = '".$id."' OR #__swmenu_extended.moduleID IS NULL)
                INNER JOIN #__content ON #__content.sectionid = #__sections.id
                AND #__sections.published = 1
                AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  )
                AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' )

                ORDER BY #__content.ordering
                ";
		$database->setQuery( $sql   );
		$result = $database->loadObjectList();

		for($i=0;$i<count($result);$i++) {
			$result2=$result[$i];

			if($use_tables){
				$url="index.php?option=com_content&task=section&id=" . $result2->id ;
			}else{
				$url="index.php?option=com_content&task=blogsection&id=" . $result2->id ;
			}

			$swmenupro_array[] =array("TITLE" => $result2->title, "URL" =>  $url , "ID" => $result2->id  , "PARENT" => 0 ,  "ORDER" => $result2->ordering, "IMAGE" => $result2->image, "IMAGEOVER" => $result2->image_over, "SHOWNAME" => $result2->show_name, "IMAGEALIGN" => $result2->image_align, "TARGETLEVEL" => $result2->target_level, "TARGET" => 0,"ACCESS" => $result2->access,"NCSS" => $result2->normal_css,"OCSS" => $result2->over_css,"SHOWITEM" => $result2->show_item  );
		}

		$sql =  "SELECT #__categories.* , #__swmenu_extended.*
                FROM #__categories LEFT JOIN #__swmenu_extended ON (#__categories.id+1000) = #__swmenu_extended.menu_id
                AND (#__swmenu_extended.moduleID = '".$id."' OR #__swmenu_extended.moduleID IS NULL)
                INNER JOIN #__content ON #__content.catid = #__categories.id
                AND #__categories.published = 1
                AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  )
                AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' )

                ORDER BY #__content.ordering
                ";

		$database->setQuery( $sql   );
		$result = $database->loadObjectList();

		for($i=0;$i<count($result);$i++) {
			$result2=$result[$i];


			if($use_tables){
				$url="index.php?option=com_content&task=category&id=" . $result2->id ;
			}else{
				$url="index.php?option=com_content&task=blogcategory&id=" . $result2->id ;
			}

			$swmenupro_array[] =array("TITLE" => $result2->title, "URL" =>  $url , "ID" => $result2->id+1000  , "PARENT" => $result2->section ,  "ORDER" => $result2->ordering, "IMAGE" => $result2->image, "IMAGEOVER" => $result2->image_over, "SHOWNAME" => $result2->show_name, "IMAGEALIGN" => $result2->image_align, "TARGETLEVEL" => $result2->target_level, "TARGET" => 0,"ACCESS" => $result2->access,"NCSS" => $result2->normal_css,"OCSS" => $result2->over_css,"SHOWITEM" => $result2->show_item  );
		}

		$sql =  "SELECT #__content.* , #__swmenu_extended.*
                FROM #__content LEFT JOIN #__swmenu_extended ON (#__content.id+10000) = #__swmenu_extended.menu_id
                AND (#__swmenu_extended.moduleID = '".$id."' OR #__swmenu_extended.moduleID IS NULL)
                INNER JOIN #__categories ON #__content.catid = #__categories.id
                AND #__content.state = 1
                AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  )
                AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' )

                ORDER BY #__content.ordering
                ";
		$database->setQuery( $sql   );
		$result = $database->loadObjectList();

		for($i=0;$i<count($result);$i++) {
			$result2=$result[$i];

			$url="index.php?option=com_content&task=view&id=" . $result2->id ;
			$swmenupro_array[] =array("TITLE" => $result2->title, "URL" =>  $url , "ID" => $result2->id+10000  , "PARENT" => $result2->catid+1000 ,  "ORDER" => $result2->ordering, "IMAGE" => $result2->image, "IMAGEOVER" => $result2->image_over, "SHOWNAME" => $result2->show_name, "IMAGEALIGN" => $result2->image_align, "TARGETLEVEL" => $result2->target_level, "TARGET" => 0,"ACCESS" => $result2->access,"NCSS" => $result2->normal_css,"OCSS" => $result2->over_css,"SHOWITEM" => $result2->show_item  );
		}
	}else if ($menu=="virtuemart") {
		$sql =  "SELECT #__vm_category.* , #__swmenu_extended.*,#__vm_category_xref.*
                FROM #__vm_category LEFT JOIN #__swmenu_extended ON #__vm_category.category_id = #__swmenu_extended.menu_id
                AND (#__swmenu_extended.moduleID = '".$id."' OR #__swmenu_extended.moduleID IS NULL)
                INNER JOIN #__vm_category_xref ON #__vm_category_xref.category_child_id= #__vm_category.category_id
                AND #__vm_category.category_publish = 'Y'
                ORDER BY #__vm_category.list_order
                ";
		$database->setQuery( $sql   );
		$result = $database->loadObjectList();

		for($i=0;$i<count($result);$i++) {
			$result2=$result[$i];
			$url="index.php?option=com_virtuemart&page=shop.browse&category_id=" . $result2->category_id . "&Itemid=".($result2->category_id+10000) ;
			$swmenupro_array[] =array("TITLE" => $result2->category_name, "URL" =>  $url , "ID" => ($result2->category_id+10000)  , "PARENT" => ($result2->category_parent_id?($result2->category_parent_id+10000):0) ,  "ORDER" => $result2->list_order, "IMAGE" => $result2->image, "IMAGEOVER" => $result2->image_over, "SHOWNAME" => $result2->show_name, "IMAGEALIGN" => $result2->image_align, "TARGETLEVEL" => $result2->target_level, "TARGET" => 0,"ACCESS" => 0,"NCSS" => $result2->normal_css,"OCSS" => $result2->over_css,"SHOWITEM" => $result2->show_item  );
		}
	}else{
		if ($hybrid){
				$sql =  "SELECT #__content.*,#__swmenu_extended.*
                FROM #__content LEFT JOIN #__swmenu_extended ON (#__content.id+100000) = #__swmenu_extended.menu_id
                AND (#__swmenu_extended.moduleID = '".$id."' OR #__swmenu_extended.moduleID IS NULL)
                INNER JOIN #__categories ON #__content.catid = #__categories.id
                AND #__content.state = 1
                AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  )
                AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' )

                ORDER BY #__content.catid,#__content.ordering
                ";
			$database->setQuery( $sql   );
			$hybrid_content = $database->loadObjectList();


			$sql =  "SELECT #__categories.*,#__swmenu_extended.*
                FROM #__categories LEFT JOIN #__swmenu_extended ON (#__categories.id+10000) = #__swmenu_extended.menu_id
                AND (#__swmenu_extended.moduleID = '".$id."'OR #__swmenu_extended.moduleID IS NULL)
                AND #__categories.published = 1

                ORDER BY #__categories.ordering
                ";
			$database->setQuery( $sql   );
			$hybrid_cat = $database->loadObjectList();
		}

		$sql = "SELECT #__menu.* , #__swmenu_extended.*
                FROM #__menu LEFT JOIN #__swmenu_extended ON #__menu.id = #__swmenu_extended.menu_id
                AND (#__swmenu_extended.moduleID = '".$id."' OR #__swmenu_extended.moduleID IS NULL)
                WHERE #__menu.menutype = '".$menu."' AND published = '1'

                ORDER BY parent, ordering
            ";

		$database->setQuery( $sql   );
		$result = $database->loadObjectList();

		$swmenupro_array=array();

		for($i=0;$i<count($result);$i++) {
			$result2=$result[$i];


			switch ($result2->type) {
				case 'separator';
				//$result2->link = "seperator";
				break;

				case 'url':
				if (eregi( "index.php\?", $result2->link )) {
					if (!eregi( "Itemid=", $result2->link )) {
						$result2->link .= "&Itemid=$result2->id";
					}
				}
				break;

				default:
				$result2->link .= "&Itemid=$result2->id";
				break;
			}
			$swmenupro_array[] =array("TITLE" => $result2->name, "URL" =>  $result2->link , "ID" => $result2->id  , "PARENT" => $result2->parent ,  "ORDER" => $result2->ordering, "IMAGE" => $result2->image, "IMAGEOVER" => $result2->image_over, "SHOWNAME" => $result2->show_name, "IMAGEALIGN" => $result2->image_align, "TARGETLEVEL" => $result2->target_level, "TARGET" => $result2->browserNav,"ACCESS" => $result2->access,"NCSS" => $result2->normal_css,"OCSS" => $result2->over_css,"SHOWITEM" => $result2->show_item  );

			if ($hybrid){
				$opt=array();
				parse_str($result2->link, $opt);
				$opt['task'] = @$opt['task'] ? $opt['task']: 0;
				$opt['id'] = @$opt['id'] ? $opt['id']: 0;


				if ($opt['task']=="blogcategory" || $opt['task']=="category" ) {

				for($j=0;$j<count($hybrid_content);$j++){
					$row=$hybrid_content[$j];
					if($row->catid==$opt['id']){

							$url="index.php?option=com_content&task=view&id=" . $row->id ."&Itemid=".$result2->id;
							$swmenupro_array[] =array("TITLE" => $row->title, "URL" =>  $url , "ID" => $row->id+100000  , "PARENT" => $result2->id ,  "ORDER" => $row->ordering, "IMAGE" => $row->image, "IMAGEOVER" => $row->image_over, "SHOWNAME" => $row->show_name, "IMAGEALIGN" => $row->image_align, "TARGETLEVEL" => $row->target_level, "TARGET" => 0,"ACCESS" => $row->access,"NCSS" => $row->normal_css,"OCSS" => $row->over_css,"SHOWITEM" => $row->show_item  );
						}
					}
				}else if ($opt['task']=="blogsection" || $opt['task']=="section" ) {

				for($j=0;$j<count($hybrid_cat);$j++){
				$row=$hybrid_cat[$j];
					if($row->section==$opt['id'] && $opt['id']){
						//$j=count($hybrid_cat);

							if($use_tables){
							$url="index.php?option=com_content&task=category&id=".$row->id."&Itemid=".$result2->id;
							}else{
							$url="index.php?option=com_content&task=blogcategory&id=".$row->id."&Itemid=".$result2->id;
							}
							$swmenupro_array[] =array("TITLE" => $row->title, "URL" =>  $url , "ID" => $row->id+10000  , "PARENT" => $result2->id ,  "ORDER" => $row->ordering, "IMAGE" => $row->image, "IMAGEOVER" => $row->image_over, "SHOWNAME" => $row->show_name, "IMAGEALIGN" => $row->image_align, "TARGETLEVEL" => $row->target_level, "TARGET" => 0,"ACCESS" => $row->access,"NCSS" => $row->normal_css,"OCSS" => $row->over_css,"SHOWITEM" => $row->show_item  );

							for($k=0;$k<count($hybrid_content);$k++){
							$row2=$hybrid_content[$k];
								if($row2->catid==$row->id){

									$url="index.php?option=com_content&task=view&id=" . $row2->id ."&Itemid=".$result2->id;
									$swmenupro_array[] =array("TITLE" => $row2->title, "URL" =>  $url , "ID" => $row2->id+100000  , "PARENT" => $row->id+10000 ,  "ORDER" => $row2->ordering, "IMAGE" => $row2->image, "IMAGEOVER" => $row2->image_over, "SHOWNAME" => $row2->show_name, "IMAGEALIGN" => $row2->image_align, "TARGETLEVEL" => $row2->target_level, "TARGET" => 0,"ACCESS" => $row2->access,"NCSS" => $row2->normal_css,"OCSS" => $row2->over_css,"SHOWITEM" => $row2->show_item  );
									}
								}
							}
						}
					}
				}
			}
		}

	return $swmenupro_array;
}


function ClickMenu($ordered, $swmenupro,$active_menu){
	global $mosConfig_absolute_path,$Itemid;

	$topcounter = 0;
	$counter = 0;
	$doMenu = 1;
	$uniqueID = $swmenupro['id'];
	$number = count($ordered);

	$str= "\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" id=\"click-menu".$uniqueID."\" class=\"click-menu".$uniqueID."\" > \n";
	$act="";

	while ($doMenu){

		if ($ordered[$counter]['indent'] == 0){
			$ordered[$counter]['URL'] = str_replace( '&', '&amp;', $ordered[$counter]['URL'] );
			if($ordered[$counter]['ID']==$active_menu){
				$act=$topcounter;
			}
			$hasSub = 0;
			$topcounter++;
			$name=swmenu_getname($ordered[$counter]);
			$str.= "<tr><td> \n";



			if ($counter+1 == $number){
				$doSubMenu = 0;
				$doMenu = 0;
			}elseif($ordered[$counter+1]['indent'] == 0){
				$doSubMenu = 0;
			}else{$doSubMenu = 1;}


			if (islast($ordered,$counter)){
				$str.= "<div class='box1'>\n";
			}else{
				$str.= "<div class='box1'>\n";
			}

			if ($ordered[$counter]['TARGETLEVEL'] == "0"){
				$str.= "<a  class=\"inbox1\" href=\"javascript:void(0);\" >".$name."</a>\n";
				$str.= "</div> \n";
			}else{

				switch ($ordered[$counter]['TARGET']) {
					// cases are slightly different
					case 1:
					// open in a new window
					$str.= '<a class="inbox1" href="'. $ordered[$counter]['URL'] .'" target="_blank" >'.$name.'</a></div>'."\n";
					break;

					case 2:
					// open in a popup window
					$str.= "<a class=\"inbox1\" href=\"#\" onclick=\"javascript: window.open('". $ordered[$counter]['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" >".$name."</a></div>\n";
					break;

					case 3:
					// don't link it
					$str.= ''.$name.'</div>'."\n";
					break;

					default:	// formerly case 2
					// open in parent window

					$str.= '<a  class="inbox1" href="'. $ordered[$counter]['URL'] .'" >'.$name.'</a></div>'."\n";

					break;
				}
			}

			$counter++;

			while ($doSubMenu){
				if ($ordered[$counter]['indent'] != 0){


					if (($ordered[$counter]['indent'] == 1) && ($ordered[$counter-1]['indent'] == 0)){ $str.= '<div class="section">'."\n";}
					$ordered[$counter]['URL'] = str_replace( '&', '&amp;', $ordered[$counter]['URL'] );
					$name=swmenu_getname($ordered[$counter]);
					if (($counter+1 == $number) || ($ordered[$counter+1]['indent'] == 0) ){
						$doSubMenu = 0;

					}

					if($Itemid==$ordered[$counter]['ID']){$swid='id="click-sub-active'.$swmenupro['id'].'"';}else{$swid="";}

					if ($ordered[$counter]['TARGETLEVEL'] == "0"){
						$str.= "<div class='box2'><a ".$swid." class=\"inbox2\" href=\"javascript:void(0);\" >".$name."</a>\n";
						$str.= "</div> \n";
					}else{

						switch ($ordered[$counter]['TARGET']) {
							// cases are slightly different
							case 1:
							// open in a new window
							$str.= '<div class="box2"><a '.$swid.' class="inbox2" href="'. $ordered[$counter]['URL'] .'" target="_blank" >'.$name.'</a></div>'."\n";
							break;

							case 2:
							// open in a popup window
							$str.= "<div class='box2'><a '.$swid.' class=\"inbox2\" href=\"#\" onclick=\"javascript: window.open('". $ordered[$counter]['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" >".$name."</a></div>\n";
							break;

							case 3:
							// don't link it
							$str.= '<div class="box2">'.$name.'</div>'."\n";
							break;

							default:	// formerly case 2
							// open in parent window
							$str.= '<div class="box2"><a '.$swid.' class="inbox2" href="'. $ordered[$counter]['URL'] .'" >'.$name.'</a></div>'."\n";
							break;
						}
					}


					$counter++;
					$hasSub = 1;
				}
			}

		}
		if ($hasSub == 1){$str.= "</div></td></tr> \n";}else{$str.= "</td></tr> \n";}
		if ($counter == ($number)){ $doMenu = 0;}
	}

	$str.= "</table> \n";
	$str.="<script type=\"text/javascript\">\n";
	$str.="<!--\n";
	$str.="var clickMenu".$uniqueID."= new ClickShowHideMenu('click-menu".$uniqueID."','".$act."');\n";
	$str.="clickMenu".$uniqueID.".init();\n";
	$str.="-->\n";
	$str.="</script>\n";

	return $str;
}


function SlideClick($ordered, $swmenupro,$active_menu,$expand){
	global $mosConfig_absolute_path,$Itemid;

	$topcounter = 0;
	$counter = 0;
	$doMenu = 1;
	$uniqueID = $swmenupro['id'];
	$number = count($ordered);
$topmenu = chain('ID', 'PARENT', 'ORDER', $ordered, 0, 1);

	if($swmenupro['orientation']=="horizontal/h"||$swmenupro['orientation']=="horizontal/d"){
		$str= "\n<table id=\"click-menu".$uniqueID."\"  cellpadding='0' cellspacing='0' class=\"click-menu".$uniqueID."\" ><tr><td valign='top'> \n";

	for($i=0;$i<count($topmenu);$i++) {
			if($topmenu[$i]['ID']==$active_menu){
				$act=$i+1;
			}
		$hasSub = 0;
		$name=swmenu_getname($topmenu[$i]);
		$linktext="id=\"slideclick".$uniqueID.($i+1)."\" class=\"".(($topmenu[$i]['ID']==$active_menu)?"inbox1-active":"inbox1")."\"";
			//$linktext.=$expand?" onclick=\"myAccordion.showThisHideOpen();toggle(".$topcounter.");\"":" onclick=\"myEffect".$topcounter.".toggle();\"";

			$linktext.=$expand?" onclick=\"myAccordion".$uniqueID.".showThisHideOpen();toggle".$uniqueID."(".($i+1).");\"":" onclick=\"myEffect".$uniqueID.($i+1).".toggle();\"";

	if ($topmenu[$i]['TARGETLEVEL'] == "0"){
				$str.= "<div class='box".$uniqueID."' id='topclick".$uniqueID.($i+1)."'><a  ".$linktext." href=\"javascript:void(0);\" >".$name."</a></div>\n";
				//$str.= "</div> \n";
			}else{

				switch ($topmenu[$i]['TARGET']) {
					// cases are slightly different
					case 1:
					// open in a new window
					$str.= '<a class="inbox1" href="'. $topmenu[$i]['URL'] .'" target="_blank" >'.$name.'</a>'."\n";
					break;

					case 2:
					// open in a popup window
					$str.= "<a class=\"inbox1\" href=\"#\" onclick=\"javascript: window.open('". $topmenu[$i]['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" >".$name."</a>\n";
					break;

					case 3:
					// don't link it
					$str.= ''.$name."\n";
					break;

					default:	// formerly case 2
					// open in parent window

					$str.= '<div class="box'.$uniqueID.'" id="topclick'.$uniqueID.($i+1).'"><a '.$linktext.' href="'. $topmenu[$i]['URL'] .'" >'.$name.'</a></div>'."\n";

					break;
				}
			}
			$str.=islast($topmenu,$i)?"</td></tr></table>\n":"</td><td>\n";
	}

	foreach($topmenu as $top){
		$act="";
		$topcounter++;
		$submenu=array();
		$do=0;
		foreach ($ordered as $row){

			if (($row['PARENT']==$top['ID'] )){
				$submenu = chain('ID', 'PARENT', 'ORDER', $ordered, $top['ID']);
				$do=1;
			$act==$topcounter?$topmenu[($topcounter-1)]['hassub']=1:$topmenu[($topcounter-1)]['hassub']=0;
			}else{
				$topmenu[$topcounter]['hassub']=0;
			}
		}
	if($do){
			$str.="<div id='subsection".$uniqueID.$topcounter."' style='height:0px;".(($swmenupro['orientation']=='horizontal/d')?'position:absolute':'').";' class='section".$uniqueID."'>\n";
			if($swmenupro['orientation']=="horizontal/h"){
			$str.="<table cellpadding='0' cellspacing='0' class=\"click-menu".$uniqueID."\" ><tr><td>\n";
			}else{
			$str.="<div class=\"click-menu".$uniqueID."\" >\n";

			}
for($i=0;$i<count($submenu);$i++) {
		if($submenu[$i]['ID']==$active_menu){$act=$i;}
		$name=swmenu_getname($submenu[$i]);
	if ($submenu[$i]['TARGETLEVEL'] == "0"){
				$str.= "<a  id=\"subclick".$uniqueID.$submenu[$i]['ID']."\" class=\"inbox2\" href=\"javascript:void(0);\" >".$name."</a>\n";
				//$str.= "</div> \n";
			}else{

				switch ($submenu[$i]['TARGET']) {
					// cases are slightly different
					case 1:
					// open in a new window
					$str.= '<a id="subclick'.$uniqueID.$submenu[$i]['ID'].'" class="inbox2" href="'. $submenu[$i]['URL'] .'" target="_blank" >'.$name.'</a>'."\n";
					break;

					case 2:
					// open in a popup window
					$str.= "<a  id=\"subclick".$uniqueID.$submenu[$i]['ID']."\" class=\"inbox2\" href=\"#\" onclick=\"javascript: window.open('". $submenu[$i]['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" >".$name."</a>\n";
					break;

					case 3:
					// don't link it
					$str.= ''.$name."\n";
					break;

					default:	// formerly case 2
					// open in parent window

					$str.= '<a  id="subclick'.$uniqueID.$submenu[$i]['ID'].'" class="inbox2" href="'. $submenu[$i]['URL'] .'" >'.$name.'</a>'."\n";

					break;
				}
			}
			if($swmenupro['orientation']=="horizontal/h"){
			$str.=(count($submenu)==($i+1))?"</td></tr></table></div>\n":"</td><td>\n";
			}else{
			$str.=(count($submenu)==($i+1))?"</div></div>\n":"\n";

			}

	}
	}else{
	$str.= "<div id='subsection".$uniqueID.$topcounter."'  style='height:0px;display:none;' class='section".$uniqueID."'></div> \n";

	}
	}
	}else{
	$str= "\n<div id=\"click-menu".$uniqueID."\" class=\"click-menu".$uniqueID."\" > \n";

	$act="";

	while ($doMenu){

		if ($ordered[$counter]['indent'] == 0){
			$topcounter++;
			$ordered[$counter]['URL'] = str_replace( '&', '&amp;', $ordered[$counter]['URL'] );
			if($ordered[$counter]['ID']==$active_menu){
				$act=$topcounter;
			}
			$hasSub = 0;

			$name=swmenu_getname($ordered[$counter]);

			if ($counter+1 == $number){
				$doSubMenu = 0;
				$topmenu[$topcounter]['hassub']=0;
				$doMenu = 0;
			}elseif($ordered[$counter+1]['indent'] == 0){
				$doSubMenu = 0;
				$topmenu[$topcounter]['hassub']=0;
			}else{
			$doSubMenu = 1;
			$act==$topcounter?$topmenu[($topcounter)]['hassub']=1:$topmenu[($topcounter)]['hassub']=0;
			}
			$linktext="id=\"slideclick".$uniqueID.$topcounter."\" class=\"".(($ordered[$counter]['ID']==$active_menu)?"inbox1-active":"inbox1")."\"";
			$linktext.=$expand?" onclick=\"myAccordion".$uniqueID.".showThisHideOpen();toggle".$uniqueID."(".$topcounter.");\"":" onclick=\"myEffect".$uniqueID.$topcounter.".toggle();\"";
			//$linktext.=(($ordered[$counter]['ID']==$active_menu)?"inbox1-active":"inbox1");
			if ($ordered[$counter]['TARGETLEVEL'] == "0"){
				$str.= '<div class="box'.$uniqueID.'" id="topclick'.$uniqueID.($counter+1).'"><a  '.$linktext.' href="javascript:void(0);" >'.$name.'</a></div>'."\n";
				//$str.= "</div> \n";
			}else{

				switch ($ordered[$counter]['TARGET']) {
					// cases are slightly different
					case 1:
					// open in a new window
					$str.= '<a class="inbox1" '.$linktext.' href="'. $ordered[$counter]['URL'] .'" target="_blank" >'.$name.'</a>'."\n";
					break;

					case 2:
					// open in a popup window
					$str.= "<a class=\"inbox1\" href=\"#\" onclick=\"javascript: window.open('". $ordered[$counter]['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" >".$name."</a>\n";
					break;

					case 3:
					// don't link it
					$str.= ''.$name."\n";
					break;

					default:	// formerly case 2
					// open in parent window

					$str.= '<div class="box'.$uniqueID.'" id="topclick'.$uniqueID.($counter+1).'"><a '.$linktext.' href="'. $ordered[$counter]['URL'] .'" >'.$name.'</a></div>'."\n";
					break;
				}
			}
			$counter++;
			if(!$doSubMenu){
				$str.= "<div id='subsection".$uniqueID.$topcounter."'  class='section".$uniqueID."' style='height:0px;display:none;'></div>\n";
			}
			while ($doSubMenu){
				if ($ordered[$counter]['indent'] != 0){
					if (($ordered[$counter]['indent'] == 1) && ($ordered[$counter-1]['indent'] == 0)){ $str.= '<div id="subsection'.$uniqueID.$topcounter.'" style="height:0px;font-size:0px" class="section'.$uniqueID.'">'."\n";}
					$ordered[$counter]['URL'] = str_replace( '&', '&amp;', $ordered[$counter]['URL'] );
					$name=swmenu_getname($ordered[$counter]);
					if (($counter+1 == $number) || ($ordered[$counter+1]['indent'] == 0) ){
						$doSubMenu = 0;
					}
					if ($ordered[$counter]['TARGETLEVEL'] == "0"){
						$str.= "<a id=\"subclick".$uniqueID.$ordered[$counter]['ID']."\" class=\"inbox2\" href=\"javascript:void(0);\" >".$name."</a>\n";
						//$str.= "</div> \n";
					}else{
						switch ($ordered[$counter]['TARGET']) {
							// cases are slightly different
							case 1:
							// open in a new window
							$str.= '<a  id="subclick'.$uniqueID.$ordered[$counter]['ID'].'" class="inbox2" href="'. $ordered[$counter]['URL'] .'" target="_blank" >'.$name.'</a></div>'."\n";
							break;

							case 2:
							// open in a popup window
							$str.= "<a  id=\"subclick".$uniqueID.$ordered[$counter]['ID']."\" class=\"inbox2\" href=\"#\" onclick=\"javascript: window.open('". $ordered[$counter]['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" >".$name."</a></div>\n";
							break;

							case 3:
							// don't link it
							$str.= ''.$name.''."\n";
							break;

							default:	// formerly case 2
							// open in parent window
							$str.= '<a  id="subclick'.$uniqueID.$ordered[$counter]['ID'].'" class="inbox2" href="'. $ordered[$counter]['URL'] .'" >'.$name.'</a>'."\n";
							break;
						}
					}
					$counter++;
					$hasSub = 1;
				}
			}
		}
		if ($hasSub == 1){
			$str.= "</div> \n";
		}else{$str.= " \n";}
		if ($counter == ($number)){ $doMenu = 0;}
	}
		$str.= "</div> \n";
	}

$str.="<script type=\"text/javascript\">\n";
$str.="<!--\n";
$str.="var ua = navigator.userAgent.toLowerCase();\n";
$str.="var myAccordion".$uniqueID.";\n";
$str.="var isOpen".$uniqueID."=new Array(";
for($i=0;$i<$topcounter;$i++){$str.= ($i<($topcounter-1))? "false, ":"false";}
$str.=");\n";

$str.="function toggle".$uniqueID."(index){\n";
$str.="var idx = index-1 ;\n";
$str.="isOpen".$uniqueID."[idx] = !isOpen".$uniqueID."[idx];\n";

$str.="for (var i = 0; i < isOpen".$uniqueID.".length; i++) {\n";
$str.="if (i != idx)\n";
$str.="isOpen".$uniqueID."[i] = false;\n";
$str.="if (isOpen".$uniqueID."[i]){\n";
$str.="document.getElementById('slideclick".$uniqueID."' + (i+1)).className = 'inbox1-active';\n";
$str.="}else{\n";
$str.="document.getElementById('slideclick".$uniqueID."' + (i+1)).className = 'inbox1';\n";
$str.="}\n}\n}\n\n";

$str.="function toggleme".$uniqueID."(index){\n";
$str.="for (var i = 1; i <=isOpen".$uniqueID.".length; i++) {\n";
$str.="var opened=document.getElementById('subsection".$uniqueID."'+(i)).style.height;\n";
$str.="if ((opened.substring(0,1))>0){\n";
$str.="document.getElementById('slideclick".$uniqueID."' + (i)).className= 'inbox1-active';\n";
$str.="}else{\n";
$str.="document.getElementById('slideclick".$uniqueID."' + (i)).className = 'inbox1';\n";
$str.="}\n}\n}\n\n";


if($expand){
	$str.="function loadSlideMenu".$uniqueID."() {\n";
	$str.="var myStretcher".$uniqueID."= document.getElementsByClassName('section".$uniqueID."');\n";
	$str.="var myStretch".$uniqueID."= document.getElementsByClassName('box".$uniqueID."');\n";
    $str.="myAccordion".$uniqueID."= new fx.Accordion(myStretch".$uniqueID.", myStretcher".$uniqueID.", {opacity: true});\n";
	$str.="myAccordion".$uniqueID.".showThisHideOpen(myStretcher".$uniqueID."[ ".($act-1)."]);\n";
    //$str.=");\n";
    if($swmenupro['orientation']=="horizontal/d"){
        $str.="var myLeftOffset".$uniqueID."=document.getElementById('click-menu".$uniqueID."').offsetLeft;\n";
        $str.="var myTopOffset".$uniqueID."=document.getElementById('click-menu".$uniqueID."').offsetTop;\n";
		$str.="myTopOffset".$uniqueID."+=document.getElementById('topclick".$uniqueID."1').offsetHeight;\n";
		$str.="if (ua.indexOf('safari') > -1){\n";
		$str.="myTopOffset".$uniqueID."+=document.body.offsetTop;\n";
		$str.="myLeftOffset".$uniqueID."+=document.body.offsetLeft;\n";
		//$str.="alert(document.body.offsetTop);\n";
		$str.="}\n";
		$str.="myTopOffset".$uniqueID."+=".$swmenupro['level1_sub_top'].";\n";
		$str.="myLeftOffset".$uniqueID."+=".$swmenupro['level1_sub_left'].";\n";
        for($i=1;$i<count($topmenu);$i++){
			$str.="document.getElementById('subsection".$uniqueID."".$i."').style.position='absolute';\n";
			$str.="document.getElementById('subsection".$uniqueID."".$i."').style.top=myTopOffset".$uniqueID."+'px ';\n";
			$str.="document.getElementById('subsection".$uniqueID."".$i."').style.left=myLeftOffset".$uniqueID."+'px';\n";
			$str.="myLeftOffset".$uniqueID."+=document.getElementById('topclick".$uniqueID."".$i."').offsetWidth;\n";
			//$str.="alert(document.getElementById('topclick".$uniqueID."".$i."').offsetWidth);\n";
		}
    }
    $str.="}\n";
  $str.= "if ( typeof window.addEventListener != \"undefined\" )\n";
	$str.= "window.addEventListener( \"load\", loadSlideMenu".$uniqueID.", false );\n";

	$str.= "else if ( typeof window.attachEvent != \"undefined\" ) { \n";
	$str.= "window.attachEvent( \"onload\", loadSlideMenu".$uniqueID." );\n";
	$str.= "}\n";

	$str.= "else {\n";
	$str.= "if ( window.onload != null ) {\n";
	$str.= "var oldOnload = window.onload;\n";
	$str.= "window.onload = function ( e ) { \n";
	$str.= "oldOnload( e ); \n";
	$str.= "loadSlideMenu".$uniqueID."() \n";
	$str.= "} \n";
	$str.= "}  \n";
	$str.= "else  { \n";
	$str.= "window.onload = loadSlideMenu".$uniqueID."();\n";
	$str.= "} }\n";
	$str.= "--> \n";
	$str.= "</script>  \n";

}else{
	for($i=1;$i<count($topmenu);$i++){
		$str.= "var myEffect".$uniqueID."".($i)."=new fx.Height('subsection".$uniqueID."".($i)."',{transition: fx.circIn,opacity: false,onComplete:function(){toggleme".$uniqueID."(".$i.")}});\n";
	}
	$act2=0;
	for($i=0;$i<=count($topmenu);$i++){
	if((@$topmenu[($i)]['hassub'])==1){
		if($swmenupro['orientation']=='vertical'){
			$str.= "setTimeout('myEffect".$uniqueID."".($i).".toggle()',400);\n";
		}else if($swmenupro['orientation']=='horizontal/h'){
			$str.= "setTimeout('myEffect".$uniqueID."".($i+1).".toggle()',400);\n";
		}else{
			$act2=($i+1);
		}
	  }

	}

		if($swmenupro['orientation']=="horizontal/d"){
		$str.="function loadSlideMenu".$uniqueID."() {\n";
        $str.= "var myLeftOffset".$uniqueID."=document.getElementById('click-menu".$uniqueID."').offsetLeft;\n";
        $str.= "var myTopOffset".$uniqueID."=document.getElementById('click-menu".$uniqueID."').offsetTop;\n";
		$str.= "myTopOffset".$uniqueID."+=document.getElementById('topclick".$uniqueID."1').offsetHeight;\n";
		$str.="if (ua.indexOf('safari') > -1){\n";
		$str.="myTopOffset".$uniqueID."+=document.body.offsetTop;\n";
		$str.="myLeftOffset".$uniqueID."+=document.body.offsetLeft;\n";
		//$str.="alert(document.body.offsetTop);\n";
		$str.="}\n";
		$str.= "myTopOffset".$uniqueID."+=".$swmenupro['level1_sub_top'].";\n";
		$str.= "myLeftOffset".$uniqueID."+=".$swmenupro['level1_sub_left'].";\n";
        for($i=1;$i<count($topmenu);$i++){
		$str.= "document.getElementById('subsection".$uniqueID."".$i."').style.position='absolute';\n";
		$str.= "document.getElementById('subsection".$uniqueID."".$i."').style.top=myTopOffset".$uniqueID."+'px';\n";
		$str.= "document.getElementById('subsection".$uniqueID."".$i."').style.left=myLeftOffset".$uniqueID."+'px';\n";
		$str.= "myLeftOffset".$uniqueID."+=document.getElementById('topclick".$uniqueID."".$i."').offsetWidth;\n";
		//echo "alert(myOffset);\n";
		}
	$str.= $act2?"myEffect".$uniqueID.($act2).".toggle();\n":"";
    $str.="}\n";
	$str.= "if ( typeof window.addEventListener != \"undefined\" )\n";
	$str.= "window.addEventListener( \"load\", loadSlideMenu".$uniqueID.", false );\n";

	$str.= "else if ( typeof window.attachEvent != \"undefined\" ) { \n";
	$str.= "window.attachEvent( \"onload\", loadSlideMenu".$uniqueID." );\n";
	$str.= "}\n";

	$str.= "else {\n";
	$str.= "if ( window.onload != null ) {\n";
	$str.= "var oldOnload = window.onload;\n";
	$str.= "window.onload = function ( e ) { \n";
	$str.= "oldOnload( e ); \n";
	$str.= "loadSlideMenu".$uniqueID."() \n";
	$str.= "} \n";
	$str.= "}  \n";
	$str.= "else  { \n";
	$str.= "window.onload = loadSlideMenu".$uniqueID."();\n";
	$str.= "} }\n";

	}
	  $str.="\n//-->\n</script>\n";
}



	return $str;
}


function TreeMenu($ordered, $swmenupro,$active_menu){
	global	$mosConfig_live_site, $Itemid;
	$str="<script type=\"text/javascript\">\n";
	$str.="<!--\n";
	$str.="d".$swmenupro['id']."= new dTree('d".$swmenupro['id']."');\n";
	$str.="d".$swmenupro['id'].".add(0,-1,'');\n";

	for($i=0;$i<count($ordered);$i++) {
		$menu=$ordered[$i];
		if(($menu['TARGET']==1)||($menu['TARGET']==2)){
			$menu['TARGET']="_blank";
		}else{
			$menu['TARGET']="_self";
		}

		if(!$menu["SHOWNAME"]){$menu["TITLE"]="";}
		$image1 = explode(",", $menu['IMAGE']);
		$image2 = explode(",", $menu['IMAGEOVER']);
		$image1= @$image1[0] ?  $mosConfig_live_site."/".$image1[0] : "";
		$image2= @$image2[0] ?  $mosConfig_live_site."/".$image2[0] : "";
		if($menu['indent']==0){$menu['PARENT']=0;}

		$str.= "d".$swmenupro['id'].".add(".$menu['ID'].",".$menu['PARENT'].",'".addslashes($menu['TITLE'])."','".$menu['URL']."','".addslashes($menu['TITLE'])."','".$menu['TARGET']."','".$image1."','".$image2."');\n";
	}
	$str.="d".$swmenupro['id'].".menuid=".$swmenupro['id'].";\n";
	$str.="d".$swmenupro['id'].".config.target=null;\n";
	$str.="d".$swmenupro['id'].".config.folderLinks=".($swmenupro['level1_sub_left']?"true":"false").";\n";
	$str.="d".$swmenupro['id'].".config.useSelection=".($active_menu?"true":"false").";\n";
	$str.="d".$swmenupro['id'].".config.useCookies=false;\n";
	$str.="d".$swmenupro['id'].".config.useLines=".($swmenupro['level2_sub_left']?"true":"false").";\n";
	$str.="d".$swmenupro['id'].".config.useIcons=".($swmenupro['level1_sub_top']?"true":"false").";\n";
	$str.="d".$swmenupro['id'].".config.useStatusText=false;\n";
	$str.="d".$swmenupro['id'].".config.closeSameLevel=false;\n";
	$str.="d".$swmenupro['id'].".config.inOrder=true;\n";


	$str.="d".$swmenupro['id'].".icon.root='".$mosConfig_live_site."/".$swmenupro['main_back_image']."';\n";
	$str.="d".$swmenupro['id'].".icon.folder='".$mosConfig_live_site."/".$swmenupro['main_back_image_over']."';\n";
	$str.="d".$swmenupro['id'].".icon.folderOpen='".$mosConfig_live_site."/".$swmenupro['sub_back_image']."';\n";
	$str.="d".$swmenupro['id'].".icon.node='".$mosConfig_live_site."/".$swmenupro['sub_back_image_over']."';\n";
	$str.="d".$swmenupro['id'].".icon.empty='".$mosConfig_live_site."/modules/mod_swmenupro/images/tree_icons/empty.gif';\n";
	$str.="d".$swmenupro['id'].".icon.line='".$mosConfig_live_site."/modules/mod_swmenupro/images/tree_icons/line.gif';\n";
	$str.="d".$swmenupro['id'].".icon.join='".$mosConfig_live_site."/modules/mod_swmenupro/images/tree_icons/join.gif';\n";
	$str.="d".$swmenupro['id'].".icon.joinBottom='".$mosConfig_live_site."/modules/mod_swmenupro/images/tree_icons/joinbottom.gif';\n";
	$str.="d".$swmenupro['id'].".icon.plus='".$mosConfig_live_site."/modules/mod_swmenupro/images/tree_icons/plus.gif';\n";
	$str.="d".$swmenupro['id'].".icon.plusBottom='".$mosConfig_live_site."/modules/mod_swmenupro/images/tree_icons/plusbottom.gif';\n";
	$str.="d".$swmenupro['id'].".icon.minus='".$mosConfig_live_site."/modules/mod_swmenupro/images/tree_icons/minus.gif';\n";
	$str.="d".$swmenupro['id'].".icon.minusBottom='".$mosConfig_live_site."/modules/mod_swmenupro/images/tree_icons/minusbottom.gif';\n";
	$str.="d".$swmenupro['id'].".icon.nlPlus='".$mosConfig_live_site."/modules/mod_swmenupro/images/tree_icons/nolines_plus.gif';\n";
	$str.="d".$swmenupro['id'].".icon.nlMinus='".$mosConfig_live_site."/modules/mod_swmenupro/images/tree_icons/nolines_minus.gif';\n";

	$str.="document.write(d".$swmenupro['id'].");\n";

	if($active_menu&&($Itemid<99998)){ $str.= "d".$swmenupro['id'].".openTo(".($Itemid?$Itemid:0)." , true);\n";}
	$str.="//-->\n";
	$str.="</script>\n";

	return $str;
}


function TigraMenu($ordered, $swmenupro,$active_menu){
	global $mosConfig_absolute_path, $mosConfig_live_site;
	$topcounter = 0;
	$counter = 0;
	$doMenu = 1;
	$uniqueID = $swmenupro['id'];
	$number = count($ordered);
	$mymenu_content ="\n<script type=\"text/javascript\">\n";
	$mymenu_content.="<!--\n";
	$mymenu_content.="var MENU_ITEMS".$uniqueID." = [";

	while ($doMenu){

		if ($ordered[$counter]['indent'] == 0){

			//$ordered[$counter]['URL'] = str_replace( '&', '&amp;', $ordered[$counter]['URL'] );
			$hasSub = 0;
			$topcounter++;
			$name=addslashes(swmenu_getname($ordered[$counter]));
			//if ($ordered[$counter]['URL']!="seperator"){
			if ($ordered[$counter]['ID']==$active_menu){
				$name="<sw_active>".$name;
			}
			if ($ordered[$counter]['TARGETLEVEL']==1 || $ordered[$counter]['TARGETLEVEL']==null ){$name="'".$name."','".$ordered[$counter]['URL']."',";}else{$name="'".$name."','javascript:void(0);',";}

			switch ($ordered[$counter]['TARGET']) {
				// cases are slightly different
				case 1:
				// open in a new window
				$name.= "{ 'tw' : '_blank' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."'}";
				break;

				case 2:
				// open in a popup window
				$name.= "{ 'tw' : '_blank' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."', 'tl' : '1'}";
				break;

				case 3:
				// don't link it
				$name.= "{ 'tw' : '_self' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."'}";
				break;

				default:	// formerly case 2
				// open in parent window
				$name.= "{ 'tw' : '_self' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."'}";
				break;
			}
			if ($counter+1 == $number){
				$mymenu_content.="\n  [".$name."],";
				$doSubMenu = 0;
				$doMenu = 0;
			}elseif($ordered[$counter+1]['indent'] == 0){
				$mymenu_content.="\n  [".$name."],";
				$doSubMenu = 0;
			}else{
				$mymenu_content.="\n  [".$name.",";
				$doSubMenu = 1;
			}
			$counter++;

			while ($doSubMenu){

				if ($ordered[$counter]['indent'] != 0) {
					//$ordered[$counter]['URL'] = str_replace( '&', '&amp;', $ordered[$counter]['URL'] );
					$name=addslashes(swmenu_getname($ordered[$counter]));

					if ($ordered[$counter]['TARGETLEVEL']==1 || $ordered[$counter]['TARGETLEVEL']==null ){$name.= "','".$ordered[$counter]['URL']."',";}else{$name.= "','',";}

					switch ($ordered[$counter]['TARGET']) {
						// cases are slightly different
						case 1:
						// open in a new window
						$name.= "{ 'tw' : '_blank' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."'}";
						break;

						case 2:
						// open in a popup window
						$name.= "{ 'tw' : '_blank' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."', 'tl' : '1'}";
						break;

						case 3:
						// don't link it
						$name.= "{ 'tw' : '_self' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."'}";
						break;

						default:	// formerly case 2
						// open in parent window
						$name.= "{ 'tw' : '_self' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."'}";
						break;
					}

					if ($counter+1 == $number){
						$mymenu_content.="\n  ['".$name.str_repeat('],',($ordered[$counter]['indent']+1));
						//  $mymenu_content.=")\n";
						$doSubMenu = 0;
						$doMenu = 0;
					}elseif ($ordered[$counter]['indent'] < $ordered[$counter+1]['indent']){
						$mymenu_content.="\n  ['".$name.",";
						if ($ordered[$counter+1]['indent'] == 0){ $doSubMenu = 0;}
					}
					elseif ($ordered[$counter]['indent'] == $ordered[$counter+1]['indent']){
						$mymenu_content.="\n  ['".$name."],";
						if ($ordered[$counter+1]['indent'] == 0){ $doSubMenu = 0;}
					}
					elseif (($ordered[$counter]['indent'] > $ordered[$counter+1]['indent'])){
						$mymenu_content.="\n  ['".$name.str_repeat('],',(($ordered[$counter]['indent'])-($ordered[$counter+1]['indent'])+1));
						//$mymenu_content.="]),\n";
						if ($ordered[$counter+1]['indent'] == 0){ $doSubMenu = 0;}
					}

					$counter++;
					$hasSub++;

				}
			}
		}
	}

	$mymenu_content .= "\n ];";
	$mymenu_content .= "\n -->";
	$mymenu_content .= "\n </SCRIPT> \n";

	//echo $mymenu_content;
	$mymenu_content.= "<script type=\"text/javaScript\">\n";
	$mymenu_content.= "<!-- \n";
	$mymenu_content.= "var MENU_POS".$uniqueID." = [\n";
	$mymenu_content.= "{\n";
	// item sizes
	$mymenu_content.= "'height':";
	if (substr(swmenuGetBrowser(),0,5)=="MSIE6"){
		$border1 = explode(" ", $swmenupro['main_border']);
		$offset=rtrim(trim($border1[0]),'px');
	}else{ $offset=0;}
	$mymenu_content.=($swmenupro['main_height']+$offset);
	$mymenu_content.= ",\n";
	$mymenu_content.= "'width':".($swmenupro['main_width']+$offset);
	$mymenu_content.= ",\n";
	$mymenu_content.= "'block_top': ".$swmenupro['main_top'].",\n";
	$mymenu_content.= "'block_left': ".$swmenupro['main_left'].",\n";
	$mymenu_content.= "'top':";
	if ($swmenupro['orientation']=="vertical"){
		if (substr(swmenuGetBrowser(),0,5)!="MSIE6"){
			$border1 = explode(" ", $swmenupro['main_border']);
			$offset3=rtrim(trim($border1[0]),'px');
		}else{ $offset3=0;}
		$mymenu_content.= ($swmenupro['main_height']+$offset3);
	}else {$mymenu_content.= "0";}
	$mymenu_content.=",\n";
	$mymenu_content.="'left':";
	if ($swmenupro['orientation']=="vertical"){$mymenu_content.= "0";}
	else {$mymenu_content.= $swmenupro['main_width'];}
	$mymenu_content.=",\n";
	$mymenu_content.="'hide_delay':".$swmenupro['specialB'].",\n";
	$mymenu_content.="'expd_delay': ". $swmenupro['specialB'].",\n";
	$mymenu_content.="'css' : {\n";
	$mymenu_content.="'outer': ['m0l0oout".$uniqueID."', 'm0l0oover".$uniqueID."'],\n";
	$mymenu_content.="'inner': ['m0l0iout".$uniqueID."', 'm0l0iover".$uniqueID."']\n";
	$mymenu_content.="}\n";
	$mymenu_content.="}, \n";
	$mymenu_content.="{\n";
	$mymenu_content.="'height': ";
	if (substr(swmenuGetBrowser(),0,5)=="MSIE6"){
		$border2 = explode(" ", $swmenupro['sub_border']);
		$offset2=rtrim(trim($border2[0]),'px');
	}else{ $offset2=0;}
	$mymenu_content.= ($swmenupro['sub_height']+$offset2);
	$mymenu_content.=",\n";
	$mymenu_content.="'width':".($swmenupro['sub_width']+$offset2);
	$mymenu_content.=",\n";
	$mymenu_content.="'block_top': ". $swmenupro['level1_sub_top']." ,\n";
	$mymenu_content.="'block_left':".$swmenupro['level1_sub_left'].",\n";
	$mymenu_content.="'top': ";
	if (substr(swmenuGetBrowser(),0,5)!="MSIE6"){
		$border1 = explode(" ", $swmenupro['sub_border']);
		$offset3=rtrim(trim($border1[0]),'px');
	}else{ $offset3=0;}
	$mymenu_content.= ($swmenupro['sub_height']+$offset3);
	$mymenu_content.=",\n";
	$mymenu_content.="'left': 0, \n";
	$mymenu_content.="'css': {\n";
	$mymenu_content.="'outer' : ['m0l1oout".$uniqueID."', 'm0l1oover". $uniqueID."'],\n";
	$mymenu_content.="'inner' : ['m0l1iout".$uniqueID."', 'm0l1iover".$uniqueID."'] \n";
	$mymenu_content.="}\n";
	$mymenu_content.="}, \n";
	$mymenu_content.="{\n";
	$mymenu_content.="'block_top': ".$swmenupro['level2_sub_top'].",\n";
	$mymenu_content.="'block_left':".$swmenupro['level2_sub_left'].",\n";
	$mymenu_content.="'css': {\n";
	$mymenu_content.="'outer' : ['m0l1oout". $uniqueID."', 'm0l1oover".$uniqueID."'],\n";
	$mymenu_content.="'inner' : ['m0l1iout". $uniqueID."', 'm0l1iover". $uniqueID."'] \n";
	$mymenu_content.="} \n";
	$mymenu_content.="} \n";
	$mymenu_content.="] \n";
	$mymenu_content.="--> \n";
	$mymenu_content.="</script> \n";

	if (substr(swmenuGetBrowser(),0,5)!="MSIE6"){
		$border1 = explode(" ", $swmenupro['main_border']);
		$offset3=rtrim(trim($border1[0]),'px');
		$swmenupro['main_height'] = $swmenupro['main_height'] + $offset3;
		//$swmenupro['main_width'] = $swmenupro['main_width'] + $offset3;
	}
	$mymenu_content.= "<div style=\"position:".$swmenupro['position'].";z-index:1; top:0px; left:0px; width:";

	if ($swmenupro['orientation']=="vertical"){$mymenu_content.= $swmenupro['main_width']."px; height:".(($swmenupro['main_height']*$topcounter))."px \" >";}
	else {$mymenu_content.= (($swmenupro['main_width']*$topcounter))."px; height:".$swmenupro['main_height']."px \">";}
	$mymenu_content.= "\n<script type=\"text/javaScript\">\n";
	$mymenu_content.="<!--\n";
	$mymenu_content.= "new menu (MENU_ITEMS".$uniqueID.", MENU_POS".$uniqueID.");\n";
	$mymenu_content.="--> \n";
	$mymenu_content.="</script>\n";
	$mymenu_content.="</div>\n";
	return $mymenu_content;
}



function chain($primary_field, $parent_field, $sort_field, $rows, $root_id=0, $maxlevel=25)
{
	$c = new chain($primary_field, $parent_field, $sort_field, $rows, $root_id, $maxlevel);
	return $c->chainmenu_table;
}

class chain
{
	var $table;
	var $rows;
	var $chainmenu_table;
	var $primary_field;
	var $parent_field;
	var $sort_field;

	function chain($primary_field, $parent_field, $sort_field, $rows, $root_id, $maxlevel)
	{
		$this->rows = $rows;
		$this->primary_field = $primary_field;
		$this->parent_field = $parent_field;
		$this->sort_field = $sort_field;
		$this->buildchain($root_id,$maxlevel);
	}

	function buildChain($rootcatid,$maxlevel)
   {
       foreach($this->rows as $row)
       {
           $this->table[$row[$this->parent_field]][ $row[$this->primary_field]] = $row;
       }
       $this->makeBranch($rootcatid,0,$maxlevel);
   }

	function makeBranch($parent_id,$level,$maxlevel)
	{
		$rows=$this->table[$parent_id];
		$key_array1 = array_keys($rows);
		$key_array_size1 = sizeOf($key_array1);
		//for ($j=0;$j<$key_array_size1;$j++)
		  foreach($rows as $key=>$value)
		{
			//$key = $key_array1[$j];
			$rows[$key]['key'] = $this->sort_field;
		}

		usort($rows,'chainmenuCMP');
		$row_array = array_values($rows);
		$row_array_size = sizeOf($row_array);
		$i=0;
		 foreach($rows as $item)
		{
			//$item = $row_array[$i];
			$item['ORDER']=($i+1);
			$item['indent'] = $level;
			$i++;
			$this->chainmenu_table[] = $item;
			if((isset($this->table[$item[$this->primary_field]])) && (($maxlevel>$level+1) || ($maxlevel==0)))
			{
				$this->makeBranch($item[$this->primary_field], $level+1, $maxlevel);
			}
		}
	}
}

function chainmenuCMP($a,$b)
{
	if($a[$a['key']] == $b[$b['key']])
	{
		return 0;
	}
	return($a[$a['key']]<$b[$b['key']])?-1:1;
}



function doClickMenu($ordered, $swmenupro, $css_load,$active_menu){
	//echo "<!--SWmenuPro Click Menu by http://www.swonline.biz-->\n";
	$str="";
	include_once( "modules/mod_swmenupro/load_script_click.php" );
	if(!$css_load){
		if ((substr(swmenuGetBrowser(),0,5)!="MSIE6")){$swmenupro = fixPadding($swmenupro);}
		$str.= "\n<style type='text/css'>\n";
		$str.= "<!--\n";
		$str.= ClickMenuStyle($swmenupro,$ordered);
		$str.= "\n-->\n";
		$str.= "</style>\n";
	}
	$str.= ClickMenu($ordered, $swmenupro,$active_menu);
	return $str;
}
function doSlideClick($ordered, $swmenupro, $css_load,$active_menu,$expand){
	//echo "<!--SWmenuPro Click Menu by http://www.swonline.biz-->\n";
	$str="";
	include_once( "modules/mod_swmenupro/load_script_slideclick.php" );
	if(!$css_load){
	if ((substr(swmenuGetBrowser(),0,5)!="MSIE6")){$swmenupro = fixPadding($swmenupro);}
		$str.= "\n<style type='text/css'>\n";
		$str.= "<!--\n";
		$str.= SlideClickStyle($swmenupro,$ordered);
		$str.= "\n-->\n";
		$str.= "</style>\n";
	}
	$str.= SlideClick($ordered, $swmenupro,$active_menu,$expand);
	return $str;
}

function doTreeMenu($ordered, $swmenupro, $css_load,$active_menu){
	//echo "<!--SWmenuPro Tree Menu by http://www.swonline.biz-->\n";
	$str="";
	include_once( "modules/mod_swmenupro/load_script_tree.php" );
	if(!$css_load){
		$str.= "\n<style type='text/css'>\n";
		$str.= "<!--\n";
		$str.= TreeMenuStyle($swmenupro,$ordered);
		$str.= "\n-->\n";
		$str.= "</style>\n";
	}
	$str.= TreeMenu($ordered, $swmenupro,$active_menu);
	return $str;
}


function doPopoutMenu($ordered, $swmenupro, $css_load,$active_menu){
	//echo "<!--SWmenuPro Tigra Menu by http://www.swonline.biz-->\n";
	$str="";
	include_once( "modules/mod_swmenupro/load_script.php" );
	if(!$css_load){
		$str.= "\n<style type='text/css'>\n";
		$str.= "<!--\n";
		$str.= TigraMenuStyle($swmenupro,$ordered);
		$str.= "\n-->\n";
		$str.= "</style>\n";
	}
	$str.= TigraMenu($ordered, $swmenupro,$active_menu);
	return $str;
}

function doTabMenu($ordered, $swmenupro, $parent_id, $css_load,$active_menu){
	//echo "<!--SWmenuPro CSS Tab Menu by http://www.swonline.biz-->\n";
	$str="";
	if(!$css_load){
		$str.= "\n<style type='text/css'>\n";
		$str.= "<!--\n";
		$str.= cssTabMenuStyle($swmenupro,$ordered);
		$str.= "\n-->\n";
		$str.= "</style>\n";
	}

	$str.= TabMenu($ordered, $swmenupro, $parent_id,$active_menu);
	return $str;
}

function doDynamicTabMenu($ordered, $swmenupro, $parent_id, $css_load,$active_menu){
	//echo "<!--SWmenuPro Dynamic Tab Menu by http://www.swonline.biz-->\n";
	$str="";
	if(!$css_load){
		$str.= "\n<style type='text/css'>\n";
		$str.= "<!--\n";
		$str.= dynamicTabMenuStyle($swmenupro,$ordered);
		$str.= "\n-->\n";
		$str.= "</style>\n";
	}
	$str.= DynamicTabMenu($ordered, $swmenupro, $parent_id,$active_menu);
	return $str;
}

function doGosuMenu($ordered, $swmenupro, $active_menu, $css_load,$selectbox_hack){
	//echo "<!--SWmenuPro myGosu Menu by http://www.swonline.biz-->\n";
	include_once( "modules/mod_swmenupro/load_script_gosu.php" );
	$str="";
	if(!$css_load){
	if ((substr(swmenuGetBrowser(),0,5)!="MSIE6")){$swmenupro = fixPadding($swmenupro);}
		$str.= "\n<style type='text/css'>\n";
		$str.= "<!--\n";
		$str.= gosuMenuStyle($swmenupro,$ordered);
		$str.= "\n-->\n";
		$str.= "</style>\n";
	}
	$str.= GosuMenu($ordered, $swmenupro, $active_menu,$selectbox_hack);
	return $str;
}

function doTransMenu($ordered, $swmenupro, $active_menu,  $sub_indicator, $parent_id, $css_load,$selectbox_hack,$show_shadow){
	//echo "<!--SWmenuPro Trans Menu by http://www.swonline.biz-->\n";
	$str="";
	include_once( "modules/mod_swmenupro/load_script_trans.php" );
	if(!$css_load){
		if ((substr(swmenuGetBrowser(),0,5)!="MSIE6")){$swmenupro = fixPadding($swmenupro);}
		$str.= "\n<style type='text/css'>\n";
		$str.= "<!--\n";
		$str.= transMenuStyle($swmenupro,$ordered,$show_shadow);
		$str.= "\n-->\n";
		$str.= "</style>\n";
	}
	$str.= transMenu($ordered, $swmenupro, $active_menu,  $sub_indicator, $parent_id,$selectbox_hack);
	return $str;
}



function transMenu($ordered, $swmenupro, $active_menu,  $sub_indicator, $parent_id,$selectbox_hack){
	global $database, $mosConfig_absolute_path, $my, $mosConfig_live_site;
	$str="";
	$name = "";
	$topcounter = 0;
	$counter = 0;
	$number = count(chain('ID', 'PARENT', 'ORDER', $ordered, $parent_id, 1));
	$str.= "<div id=\"wrap".$swmenupro['id']."\" class=\"menu".$swmenupro['id']."\" align=\"".$swmenupro['position']."\">\n";
	$str.= "<table cellspacing=\"0\" cellpadding=\"0\" id=\"menu".$swmenupro['id']."\" class=\"menu".$swmenupro['id']."\" > \n";
	if (substr($swmenupro['orientation'],0,10)=="horizontal"){$str.= "<tr> \n";}

	foreach($ordered as $top){
		if ($top['indent'] == 0){
			$top['URL'] = str_replace( '&', '&amp;', $top['URL'] );
			$topcounter++;

			$name=swmenu_getname($top);

			if (substr($swmenupro['orientation'],0,8)=="vertical"){
				$str.= "<tr> \n";
			}
			if(($topcounter==$number)&&($top["ID"]==$active_menu)){
				$str.= "<td id=\"trans-active".$swmenupro['id']."\" class='last".$swmenupro['id']."'> \n";
			}else if($top["ID"]==$active_menu){
				$str.= "<td id='trans-active".$swmenupro['id']."'> \n";
			}else if($topcounter==$number){
				$str.= "<td class=\"last".$swmenupro['id']."\"> \n";
			}else{
				$str.= "<td> \n";
			}

			if ($top['TARGETLEVEL'] == "0"){
				$str.= "<a id=\"menu".$swmenupro['id'].$top['ID']."\" href=\"javascript: void(0)\" >".$name."</a> \n";
			}else{

				switch ($top['TARGET']) {
					// cases are slightly different
					case 1:
					// open in a new window
					$str.= '<a id="menu'.$swmenupro['id'].$top['ID'].'" href="'. $top['URL'] .'" target="_blank"  >'. $name .'</a>'."\n";
					break;

					case 2:
					// open in a popup window
					$str.= "<a href=\"#\" id=\"menu".$swmenupro['id'].$top['ID']."\" onclick=\"javascript: window.open('". $top['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" >". $name ."</a>\n";
					break;

					case 3:
					// don't link it
					$str.= '<a id="menu'.$swmenupro['id'].$top['ID'].'" >'. $name .'</a>'."\n";
					break;

					default:	// formerly case 2
					$str.= '<a id="menu'.$swmenupro['id'].$top['ID'].'" href="'.$top['URL'] .'" >';

					$str.= $name .'</a>'."\n";

					break;
				}
			}
			$counter++;
			$str.= "</td> \n";

			if (substr($swmenupro['orientation'],0,8)=="vertical"){
				$str.= "</tr> \n";
			}
		}
	}
	if (substr($swmenupro['orientation'],0,10)=="horizontal"){$str.= "</tr> \n";}
	$str.= "</table></div> \n";
	$str.= "<div id=\"subwrap".$swmenupro['id']."\"> \n";
	$str.="<script type=\"text/javascript\">\n";
	$str.="<!--\n";
	$str.="if (TransMenu.isSupported()) {\n";

	if($swmenupro['orientation']=="horizontal/down"){
		$str.= "var ms = new TransMenuSet(TransMenu.direction.down, ".$swmenupro['level1_sub_left'].",".$swmenupro['level1_sub_top'].", TransMenu.reference.bottomLeft);\n";
	}elseif($swmenupro['orientation']=="horizontal/up"){
		$str.= "var ms = new TransMenuSet(TransMenu.direction.up, ".$swmenupro['level1_sub_left'].", ".$swmenupro['level1_sub_top'].", TransMenu.reference.topLeft);\n";
	}elseif($swmenupro['orientation']=="vertical/right"){
		$str.= "var ms = new TransMenuSet(TransMenu.direction.right, ".$swmenupro['level1_sub_left'].", ".$swmenupro['level1_sub_top'].", TransMenu.reference.topRight);\n";
	}elseif($swmenupro['orientation']=="vertical/left"){
		$str.= "var ms = new TransMenuSet(TransMenu.direction.left, ".$swmenupro['level1_sub_left'].", ".$swmenupro['level1_sub_top'].", TransMenu.reference.topLeft);\n";
	}elseif($swmenupro['orientation']=="vertical"){
		$str.= "var ms = new TransMenuSet(TransMenu.direction.right, ".$swmenupro['level1_sub_left'].", ".$swmenupro['level1_sub_top'].", TransMenu.reference.topRight);\n";
	}elseif($swmenupro['orientation']=="horizontal"){
		$str.= "var ms = new TransMenuSet(TransMenu.direction.down, ".$swmenupro['level1_sub_left'].", ".$swmenupro['level1_sub_top'].", TransMenu.reference.bottomLeft);\n";
	}
	$par=$ordered[0];

	foreach($ordered as $sub){
		$name=swmenu_getname($sub);
		$sub2=next($ordered);
		if ($sub['TARGETLEVEL'] == "0"  || $sub['TARGET']=="3"){
			$sub['TARGET']=0;
			$sub['URL']="javascript:void(0);";
		}
		if(($sub['indent']==0)&&(($sub2['indent'])==1)){
			$str.= "var menu".$swmenupro['id'].$sub['ID']." = ms.addMenu(document.getElementById(\"menu".$swmenupro['id'].$sub['ID']."\"));\n ";
		}else if(($sub['ORDER']==1)&&($sub['indent']>1)){
			$str.= "var menu".$swmenupro['id'].($sub['ID'])." = menu".$swmenupro['id'].findPar($ordered,$par).".addMenu(menu".$swmenupro['id'].findPar($ordered,$par).".items[".($par['ORDER']-1)."],".$swmenupro['level2_sub_left'].",".$swmenupro['level2_sub_top'].");\n";
		}
		if($sub['indent']>0){
			$str.= "menu".$swmenupro['id'].findPar($ordered,$sub).".addItem(\"".addslashes($name)."\", \"".addslashes($sub['URL'])."\", \"".$sub['TARGET']."\");\n";
		}
		$par=$sub;
	}
	$str.="function init".$swmenupro['id']."() {\n";
	$str.="if (TransMenu.isSupported()) {\n";
	$str.="TransMenu.initialize();\n";
	$counter=0;
	for($i=0;$i<count($ordered);$i++){
		if($ordered[$i]['indent']==0) {
			$counter++;
			if(@$ordered[$i+1]['indent']==1) {
				$str.= "menu".$swmenupro['id'].($ordered[$i]['ID']).".onactivate = function() {document.getElementById(\"menu".$swmenupro['id'].$ordered[$i]['ID']."\").className = \"hover\"; };\n ";
				$str.= "menu".$swmenupro['id'].($ordered[$i]['ID']).".ondeactivate = function() {document.getElementById(\"menu".$swmenupro['id'].$ordered[$i]['ID']."\").className = \"\"; };\n ";
			}else{
				$str.= "document.getElementById(\"menu".$swmenupro['id'].$ordered[$i]['ID']."\").onmouseover = function() {\n";
				$str.= "ms.hideCurrent();\n";
				$str.= "this.className = \"hover\";\n";
				$str.= "}\n";
				$str.= "document.getElementById(\"menu".$swmenupro['id'].$ordered[$i]['ID']."\").onmouseout = function() { this.className = \"\"; }\n";
			}
		}
	}

	$str.="}}\n";
	if($sub_indicator){
		$str.="TransMenu.spacerGif = \"".$mosConfig_live_site."/modules/mod_swmenupro/images/transmenu/x.gif\";\n";
		$str.="TransMenu.dingbatOn = \"".$mosConfig_live_site."/modules/mod_swmenupro/images/transmenu/submenu-on.gif\";\n";
		$str.="TransMenu.dingbatOff = \"".$mosConfig_live_site."/modules/mod_swmenupro/images/transmenu/submenu-off.gif\"; \n";
		$str.="TransMenu.sub_indicator = true; \n";
	}else{
		$str.="TransMenu.dingbatSize = 0;\n";
		$str.="TransMenu.spacerGif = \"\";\n";
		$str.="TransMenu.dingbatOn = \"\";\n";
		$str.="TransMenu.dingbatOff = \"\"; \n";
		$str.="TransMenu.sub_indicator = false;\n";
	}
	$str.="TransMenu.menuPadding = 0;\n";
	$str.="TransMenu.itemPadding = 0;\n";
	$str.="TransMenu.shadowSize = 2;\n";
	$str.="TransMenu.shadowOffset = 3;\n";
	$str.="TransMenu.shadowColor = \"#888\";\n";
	$str.="TransMenu.shadowPng = \"".$mosConfig_live_site."/modules/mod_swmenupro/images/transmenu/grey-40.png\";\n";
	$str.="TransMenu.backgroundColor = \"".$swmenupro['sub_back']."\";\n";
	$str.="TransMenu.backgroundPng = \"".$mosConfig_live_site."/modules/mod_swmenupro/images/transmenu/white-90.png\";\n";
	$str.="TransMenu.hideDelay = ".($swmenupro['specialB']*2).";\n";
	$str.="TransMenu.slideTime = ".$swmenupro['specialB'].";\n";
	$str.="TransMenu.modid = ".$swmenupro['id'].";\n";
	$str.="TransMenu.selecthack = ".$selectbox_hack.";\n";
	$str.="TransMenu.renderAll();\n";


	$str.="if ( typeof window.addEventListener != \"undefined\" )\n";
	$str.="window.addEventListener( \"load\", init".$swmenupro['id'].", false );\n";
	$str.="else if ( typeof window.attachEvent != \"undefined\" ) {\n";
	$str.="window.attachEvent( \"onload\", init".$swmenupro['id']." );\n";
	$str.="}else{\n";
	$str.="if ( window.onload != null ) {\n";
	$str.="var oldOnload = window.onload;\n";
	$str.="window.onload = function ( e ) {\n";
	$str.="oldOnload( e );\n";
	$str.="init".$swmenupro['id']."();\n";
	$str.="}\n}else\n";
	$str.="window.onload = init".$swmenupro['id']."();\n";
	$str.="}\n}\n-->\n</script>\n</div>\n";

	return $str;

}


function findPar($ordered,$sub){
	$submenu = chain('ID', 'PARENT', 'ORDER', $ordered, $sub['PARENT'], 1);

	if ($sub['indent']==1){
		return $submenu[0]['PARENT'];
	}else{
		return $submenu[0]['ID'];
	}
}


function DynamicTabMenu($ordered, $swmenupro, $parent_id,$active_menu){
	global $database, $mosConfig_absolute_path, $my, $mosConfig_live_site;

	$current_itemid = trim( mosGetParam( $_REQUEST, 'Itemid', 0 ) );
	$tabid=0;
	$topmenu = chain('ID', 'PARENT', 'ORDER', $ordered, $parent_id, 1);
	for($i=0;$i<count($topmenu);$i++) {
		if($topmenu[$i]['ID']==$active_menu){$tabid=$i;}
	}
	$str="<script type=\"text/javascript\">\n<!--\n";
	$str.="/***********************************************\n";
	$str.="* DD Tab Menu script- � Dynamic Drive DHTML code library (www.dynamicdrive.com)\n";
	$str.="* This notice MUST stay intact for legal use\n";
	$str.="* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code\n";
	$str.="***********************************************/\n";

	$str.="var initialtab=[".$tabid.", \"swtab".$active_menu."\"]\n";
	$str.="var turntosingle=0 //0 for no (default), 1 for yes\n";
	$str.="var disabletablinks=0 //0 for no (default), 1 for yes\n";
	$str.="var previoustab=\"\"\n";

	$str.="function expandcontent(cid, aobject){\n";
	$str.="if (disabletablinks==1)\n";
	$str.="aobject.onclick=new Function(\"return false\")\n";
	$str.="if (document.getElementById){\n";
	$str.="highlighttab(aobject)\n";
	$str.="if (turntosingle==0){\n";
	$str.="if (previoustab!=\"\")\n";
	$str.="document.getElementById(previoustab).style.display=\"none\"\n";
	$str.="document.getElementById(cid).style.display=\"block\"\n";
	$str.="previoustab=cid\n";
	$str.="}}}\n";

	$str.="function highlighttab(aobject){\n";
	$str.="if (typeof tabobjlinks==\"undefined\")\n";
	$str.="collecttablinks()\n";
	$str.="for (i=0; i<tabobjlinks.length; i++)\n";
	$str.="tabobjlinks[i].className=\"\"\n";
	$str.="aobject.className=\"here".$swmenupro['id']."\"\n";
	$str.="}\n";

	$str.="function collecttablinks(){\n";
	$str.="var tabobj=document.getElementById(\"tabtop2".$swmenupro['id']."\")\n";
	$str.="tabobjlinks=tabobj.getElementsByTagName(\"A\")\n";
	$str.="}\n";

	$str.="function do_onload(){\n";
	$str.="collecttablinks()\n";
	$str.=$active_menu?"expandcontent(initialtab[1], tabobjlinks[initialtab[0]])\n":"";
	$str.="}\n";

	$str.="if (window.addEventListener)\n";
	$str.="window.addEventListener(\"load\", do_onload, false)\n";
	$str.="else if (window.attachEvent)\n";
	$str.="window.attachEvent(\"onload\", do_onload)\n";
	$str.="else if (document.getElementById)\n";
	$str.="window.onload=do_onload\n";
	$str.="-->\n</script>\n";


	$str.= "<DIV id=\"tabtop2".$swmenupro['id']."\" align=\"".$swmenupro['position']."\">\n";
	$str.= '<table id="menu'.$swmenupro['id'].'" cellpadding="0" cellspacing="0"><tr>';
	$topcounter=0;
	for($i=0;$i<count($topmenu);$i++) {
		$top=$topmenu[$i];

		$name=swmenu_getname($top);
		$top['URL'] = str_replace( '&', '&amp;', $top['URL'] );
		if($top['ID']==$active_menu){
			$str.= "<td id=\"dyn-tab-top-active".$swmenupro['id']."\" >\n";
		}else{
			$str.= "<td>\n";
		}

		switch ($top['TARGET']) {
			// cases are slightly different
			case 1:
			// open in a new window
			$str.= '<a href="'. $top['URL'] .'" onMouseover="expandcontent(\'swtab'.$top['ID'].'\', this)" target="_blank" id="swdyntab'.$swmenupro['id'].$top['ID'].'" id="swdyntab'.$swmenupro['id'].$top['ID'].'" >';
			break;

			case 2:
			// open in a popup window
			$str.= "<a href=\"#\" onMouseover=\"expandcontent('swtab'".$top['ID']."', this)\" onclick=\"javascript: window.open('". $top['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" id=\"swdyntab".$swmenupro['id'].$top['ID']."\"> \n";
			break;

			case 3:
			// don't link it
			$str.= '<a href="javascript:void(0);" onMouseover="expandcontent(\'swtab'.$top['ID'].'\', this)" id="swdyntab'.$swmenupro['id'].$top['ID'].'" >';
			break;

			default:	// formerly case 2
			// open in parent window
			$str.= '<a href="'. $top['URL'] .'" onMouseover="expandcontent(\'swtab'.$top['ID'].'\', this)" id="swdyntab'.$swmenupro['id'].$top['ID'].'" >';
			break;
		}
		$str.= $name."</a>\n";
		$str.= "</td>\n";
		$topcounter++;
	}

	$str.= "</tr></table></div>\n";

	$str.= "<DIV id=\"tabsub2".$swmenupro['id']."\" align=\"".$swmenupro['position']."\">\n";
	foreach($topmenu as $top){
		$submenu=array();
		$do=0;
		foreach ($ordered as $row){

			if (($row['PARENT']==$top['ID'] )){
				$submenu = chain('ID', 'PARENT', 'ORDER', $ordered, $top['ID']);
				$do=1;
			}
		}

		$str.= "<div id=\"swtab".$top['ID']."\" class=\"swtabcontent".$swmenupro['id']."\">\n";
		if( $do){
			$subcounter=0;
			$str.= '<table class="submenu'.$swmenupro['id'].'" cellpadding="0" cellspacing="0" ><tr>';

			if(!count($submenu)){$str.= "<td></td>"; }
			foreach(@$submenu as $sub){
				$sub['URL'] = str_replace( '&', '&amp;', $sub['URL'] );
				if(($subcounter==count($submenu)-1)){
					if($sub['ID']==$current_itemid){
						$str.= "<td id=\"dyn-tab-sub-active".$swmenupro['id']."\" class=\"last".$swmenupro['id']."\" >\n";
					}else{
						$str.= "<td class=\"last".$swmenupro['id']."\" >\n";
					}

				}else{
					if($sub['ID']==$current_itemid){
						$str.= "<td id=\"dyn-tab-sub-active".$swmenupro['id']."\" >\n";
					}else{
						$str.= "<td>\n";
					}
				}
				$subcounter++;

				$name=swmenu_getname($sub);

				switch ($sub['TARGET']) {
					// cases are slightly different
					case 1:
					// open in a new window
					$str.= '<a href="'. $sub['URL'] .'" target="_blank" id="swdyntab'.$swmenupro['id'].$sub['ID'].'" >';
					break;

					case 2:
					// open in a popup window
					$str.= "<a href=\"#\" id=\"swdyntab".$swmenupro['id'].$sub['ID']."\" onclick=\"javascript: window.open('". $sub['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" > \n";
					break;

					case 3:
					// don't link it
					$str.= '<a href="javascript:void(0);" id="swdyntab'.$swmenupro['id'].$sub['ID'].'">';
					break;

					default:	// formerly case 2
					// open in parent window
					$str.= '<a href="'. $sub['URL'] .'" id="swdyntab'.$swmenupro['id'].$sub['ID'].'" >';
					break;
				}
				//echo "<a href='".$sub['URL']."'> \n";
				$str.= $name."</a></td>";
			}
			//echo "</tr></table>";
			$str.= "</tr></table>\n";
		}
		$str.= "</div>\n";
	}
	$str.= "</div>\n";

	return $str;
}



function TabMenu($ordered, $swmenupro, $parent_id,$active_menu){
	global $database, $mosConfig_absolute_path, $my, $mosConfig_live_site;

	$current_itemid = trim( mosGetParam( $_REQUEST, 'Itemid', 0 ) );
	$submenu=array();
	$topmenu = chain('ID', 'PARENT', 'ORDER', $ordered, $parent_id, 1);

	if (count($ordered) && $active_menu){
		foreach ($ordered as $row){
			if (($row['PARENT']==$active_menu )){
				$submenu = chain('ID', 'PARENT', 'ORDER', $ordered, $active_menu);
			}
		}
	}

	$str= "<DIV id=\"tabtop2".$swmenupro['id']."\" align=\"".$swmenupro['position']."\">";
	$str.= '<ul id="menu'.$swmenupro['id'].'" >';
	$topcounter=0;
	for($i=0;$i<count($topmenu);$i++) {
		$top=$topmenu[$i];
		$top['URL'] = str_replace( '&', '&amp;', $top['URL'] );
		if($topcounter==count($topmenu)){
			$str.= "<li id=\"last\">";
		}elseif(($topcounter==count($topmenu)-1)&&($top['ID']!=$active_menu)){
			$str.= "<li>";
		}elseif($top['ID']==$active_menu){
			$str.= "<li id=\"here".$swmenupro['id']."\" >";
		}else{
			$str.= "<li>";
		}

		switch ($top['TARGET']) {
			// cases are slightly different
			case 1:
			// open in a new window
			$str.= '<a href="'. $top['URL'] .'" target="_blank" id="swdyntab'.$swmenupro['id'].$top['ID'].'" >';
			break;

			case 2:
			// open in a popup window
			$str.= "<a href=\"#\" id=\"swdyntab".$swmenupro['id'].$top['ID']."\" onclick=\"javascript: window.open('". $top['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" > \n";
			break;

			case 3:
			// don't link it
			$str.= '<a href="javascript:void(0);" id="swdyntab'.$swmenupro['id'].$top['ID'].'">';
			break;

			default:	// formerly case 2
			// open in parent window
			$str.= '<a href="'. $top['URL'] .'" id="swdyntab'.$swmenupro['id'].$top['ID'].'" >';
			break;
		}

		$name=swmenu_getname($top);
		$str.= $name."</a>";
		$str.= "</li>";
		$topcounter++;
	}

	$str.= "</ul></div>";

	if( count(@$submenu)){
		$subcounter=0;
		$str.= "<DIV id=\"tabsub2".$swmenupro['id']."\" align=\"".$swmenupro['position']."\">";
		$str.= '<ul id="submenu'.$swmenupro['id'].'"  >';
		foreach($submenu as $sub){

			$name=swmenu_getname($sub);

			$sub['URL'] = str_replace( '&', '&amp;', $sub['URL'] );
			if(($subcounter==count($submenu)-1)){
				if($sub['ID']==$current_itemid){
					$str.= "<li id=\"css-tab-sub-active".$swmenupro['id']."\" class=\"last".$swmenupro['id']."\" >\n";
				}else{
					$str.= "<li class=\"last".$swmenupro['id']."\" >\n";
				}

			}else{
				if($sub['ID']==$current_itemid){
					$str.= "<li id=\"css-tab-sub-active".$swmenupro['id']."\" >\n";
				}else{
					$str.= "<li>\n";
				}
			}
			$subcounter++;

			switch ($sub['TARGET']) {
				// cases are slightly different
				case 1:
				// open in a new window
				$str.= '<a href="'. $sub['URL'] .'" target="_blank" id="swdyntab'.$swmenupro['id'].$sub['ID'].'" >';
				break;

				case 2:
				// open in a popup window
				$str.= "<a href=\"#\" id=\"swdyntab".$swmenupro['id'].$sub['ID']."\" onclick=\"javascript: window.open('". $sub['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" > \n";
				break;

				case 3:
				// don't link it
				$str.= '<a href="javascript:void(0);" id="swdyntab'.$swmenupro['id'].$sub['ID'].'">';
				break;

				default:	// formerly case 2
				// open in parent window
				$str.= '<a href="'. $sub['URL'] .'" id="swdyntab'.$swmenupro['id'].$sub['ID'].'">';
				break;
			}
			//$str.= "<a href='".$sub['URL']."'> \n";
			$str.= $name."</a></li>";
		}
		//$str.= "</tr></table>";
		$str.= "</ul></div>";
	}
	return  $str;
}



function GosuMenu($ordered, $swmenupro, $active_menu,$selectbox_hack){
	global $mosConfig_absolute_path, $mosConfig_live_site;

	$name = "";
	$counter = 0;
	$doMenu = 1;
	$uniqueID = $swmenupro['id'];
	$number = count($ordered);

	$str= "<div align=\"".$swmenupro['position']."\">\n";
	$str.= "<table cellspacing=\"0\" cellpadding=\"0\" id=\"menu".$uniqueID."\" class=\"ddmx".$uniqueID."\"  > \n";
	if ($swmenupro['orientation']=="horizontal"){$str.= "<tr> \n";}

	while ($doMenu){

		if ($ordered[$counter]['indent'] == 0){
			$ordered[$counter]['URL'] = str_replace( '&', '&amp;', $ordered[$counter]['URL'] );
			$name=swmenu_getname($ordered[$counter]);

			if ($swmenupro['orientation']=="vertical"){
				$str.= "<tr> \n";
			}

			if(islast($ordered,$counter)){
				if (($ordered[$counter]['ID']==$active_menu)){$str.= "<td class='item11-acton-last'> \n";}
				else{ $str.= "<td class='item11-last'> \n"; }
			}else{
				if (($ordered[$counter]['ID']==$active_menu)){$str.= "<td class='item11-acton'> \n";}
				else{ $str.= "<td class='item11'> \n"; }
			}

			if ($ordered[$counter]['TARGETLEVEL'] == "0"){
				$str.= "<a class='item1' href=\"javascript: void(0)\" >".$name."</a> \n";
			}else{

				switch ($ordered[$counter]['TARGET']) {
					// cases are slightly different
					case 1:
					// open in a new window
					$str.= '<a href="'. $ordered[$counter]['URL'] .'" target="_blank" class="item1" >'. $name .'</a>';
					break;

					case 2:
					// open in a popup window
					$str.= "<a href=\"#\" onclick=\"javascript: window.open('". $ordered[$counter]['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" class=\"item1\">". $name ."</a>\n";
					break;

					case 3:
					// don't link it
					$str.= '<a class="item1" >'. $name .'</a>';
					break;

					default:	// formerly case 2
					// open in parent window
					$str.= '<a href="'. $ordered[$counter]['URL'] .'" class="item1">'. $name .'</a>';
					break;
				}
			}

			if ($counter+1 == $number){
				$doSubMenu = 0;
				$doMenu = 0;
				$str.= "<div class=\"section\" ></div> \n";
			}elseif($ordered[$counter+1]['indent'] == 0){
				$doSubMenu = 0;
				$str.= "<div class=\"section\" ></div> \n";
			}else{$doSubMenu = 1;}


			$counter++;

			while ($doSubMenu){
				if ($ordered[$counter]['indent'] != 0){
					if ($ordered[$counter]['indent'] > $ordered[$counter-1]['indent']){ $str.= '<div class="section"  >';}
					$ordered[$counter]['URL'] = str_replace( '&', '&amp;', $ordered[$counter]['URL'] );
					$name=swmenu_getname($ordered[$counter]);

					if (($counter+1 == $number) || ($ordered[$counter+1]['indent'] == 0) ){
						$doSubMenu = 0;
					}
					$style="";

					if (($counter+1 == $number) || islast($ordered,$counter)){
						$style=" style=\"border-bottom:".$swmenupro['sub_border_over']."\"";
					}

					if ($ordered[$counter]['TARGETLEVEL'] == "0"){
						$str.= "<a class=\"item2\"".$style." href=\"javascript: void(0)\" >".$name."</a> \n";
					}else{

						switch ($ordered[$counter]['TARGET']) {
							// cases are slightly different
							case 1:
							// open in a new window
							$str.= '<a href="'. $ordered[$counter]['URL'] .'" '.$style.' target="_blank" class="item2" >'. $name .'</a>';
							break;

							case 2:
							// open in a popup window
							$str.= "<a href=\"#\" ".$style." onclick=\"javascript: window.open('". $ordered[$counter]['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" class=\"item2\">". $name ."</a>\n";
							break;

							case 3:
							// don't link it
							$str.= '<a class="item2" '.$style.' >'. $name .'</a>';
							break;

							default:	// formerly case 2
							// open in parent window
							$str.= "<a href=\"". $ordered[$counter]['URL'] ."\" class=\"item2\" ".$style.">". $name ."</a>\n";
							break;
						}
					}

					if (($counter+1 == $number) || ($ordered[$counter+1]['indent'] < $ordered[$counter]['indent'])){

						$str.= str_repeat('</div>',(($ordered[$counter]['indent'])-(@$ordered[$counter+1]['indent'])));

					}
					$counter++;
				}
			}
		}

		$str.= "</td> \n";

		if ($swmenupro['orientation']=="vertical"){
			$str.= "</tr> \n";
		}
		if ($counter == ($number)){ $doMenu = 0;}
	}
	if ($swmenupro['orientation']=="horizontal"){$str.= "</tr> \n";}
	$str.= "</table></div> \n";

	$str.= "<script type=\"text/javascript\">\n";
	$str.= "<!--\n";
	$str.= "function makemenu".$uniqueID."(){\n";


	$str.= "var ddmx".$uniqueID." = new DropDownMenuX('menu".$uniqueID."');\n";
	if ($swmenupro['orientation']=="vertical"){$str.= "ddmx".$uniqueID.".type = \"vertical\"; \n";}
	$str.= "ddmx".$uniqueID.".delay.show = 0;\n";
	$str.= "ddmx".$uniqueID.".iframename = 'ddmx".$uniqueID."';\n";
	$str.= "ddmx".$uniqueID.".delay.hide = ".$swmenupro['specialB'].";\n";
	$str.= "ddmx".$uniqueID.".position.levelX.left = ".$swmenupro['level2_sub_left'].";\n";
	$str.= "ddmx".$uniqueID.".position.levelX.top = ".$swmenupro['level2_sub_top'].";\n";
	$str.= "ddmx".$uniqueID.".position.level1.left = ".$swmenupro['level1_sub_left'].";\n";
	$str.= "ddmx".$uniqueID.".position.level1.top = ".$swmenupro['level1_sub_top']."; \n";
	$str.= "ddmx".$uniqueID.".fixIeSelectBoxBug = ".($selectbox_hack?'true':'false').";\n";
	$str.= "ddmx".$uniqueID.".init(); \n";
	$str.= "}\n";

	$str.= "if ( typeof window.addEventListener != \"undefined\" )\n";
	$str.= "window.addEventListener( \"load\", makemenu".$uniqueID.", false );\n";

	$str.= "else if ( typeof window.attachEvent != \"undefined\" ) { \n";
	$str.= "window.attachEvent( \"onload\", makemenu".$uniqueID." );\n";
	$str.= "}\n";

	$str.= "else {\n";
	$str.= "if ( window.onload != null ) {\n";
	$str.= "var oldOnload = window.onload;\n";
	$str.= "window.onload = function ( e ) { \n";
	$str.= "oldOnload( e ); \n";
	$str.= "makemenu".$uniqueID."() \n";
	$str.= "} \n";
	$str.= "}  \n";
	$str.= "else  { \n";
	$str.= "window.onload = makemenu".$uniqueID."();\n";
	$str.= "} }\n";
	$str.= "--> \n";
	$str.= "</script>  \n";

	return $str;
}


function islast($array, $id){

	$this_level=$array[$id]['indent'];
	$last=0;
	$i=$id+1;
	$do=1;
	while($do){

		if(@$array[$i]['indent']<$this_level || $i==count($array)){$last=1;}
		if(@$array[$i]['indent']<=$this_level){
			$do=0;

		}
		$i++;
	}
	return $last;
}


function swmenuGetBrowser(){

	$br = new Browser;
   // echo substr($br->Name.$br->Version,0,5);


	return($br->Name.$br->Version);
}
function inAgent($agent) {
	global $HTTP_USER_AGENT;
	$notAgent = strpos($HTTP_USER_AGENT,$agent) === false;
	return !$notAgent;
}

function fixPadding(&$swmenupro){

	$padding1 = explode("px", $swmenupro['main_padding']);
	$padding2 = explode("px", $swmenupro['sub_padding']);
	for($i=0;$i<4; $i++){
		$padding1[$i]=trim($padding1[$i]);
		$padding2[$i]=trim($padding2[$i]);
	}
	if($swmenupro['main_width']!=0){$swmenupro['main_width'] = ($swmenupro['main_width'] - ($padding1[1]+$padding1[3]));}
	if($swmenupro['main_height']!=0){$swmenupro['main_height'] = ($swmenupro['main_height'] - ($padding1[0]+$padding1[2]));}
	if($swmenupro['sub_width']!=0){$swmenupro['sub_width'] = ($swmenupro['sub_width'] - ($padding2[1]+$padding2[3]));}
	if(@$swmenupro['sub_width']!=0){$swmenupro['sub_height'] = ($swmenupro['sub_height'] - ($padding2[0]+$padding2[2]));}
	return($swmenupro);


}


function swmenu_getname($ordered){
	global $mosConfig_absolute_path,$mosConfig_live_site;
	$image_url = "";
	$name = "";
	$image1 = explode(",", $ordered['IMAGE']);
	$image2 = explode(",", $ordered['IMAGEOVER']);
	$image1params= @$image1[0] ? " src=\"".$mosConfig_live_site."/".$image1[0]."\"" : "";
	$image1params.= @$image1[3] ? " vspace=\"".$image1[3]."\"" : " vspace=\"0\"";
	$image1params.= @$image1[4] ? " hspace=\"".$image1[4]."\"" : " hspace=\"0\"";
	$image2params= @$image2[0] ? " src=\"".$mosConfig_live_site."/".$image2[0]."\"" : "";
	$image2params.= @$image2[3] ? " vspace=\"".$image2[3]."\"" : " vspace=\"0\"";
	$image2params.= @$image2[4] ? " hspace=\"".$image2[4]."\"" : " hspace=\"0\"";
	$image1params.=@$image1[1] ? " width=\"".$image1[1]."\"" : "";
	$image1params.= @$image1[2] ? " height=\"".$image1[2]."\"" : "";
	$image2params.= @$image2[1] ? " width=\"".$image2[1]."\"" : "";
	$image2params.= @$image2[2] ? " height=\"".$image2[2]."\"" : "";
	$image1params.= $ordered['IMAGEALIGN'] ? " align=\"".$ordered['IMAGEALIGN']."\"" : "";
	$image2params.= $ordered['IMAGEALIGN'] ? " align=\"".$ordered['IMAGEALIGN']."\"" : "";

	if (($ordered['IMAGE']!="")&&(file_exists($mosConfig_absolute_path."/".$image1[0])))
	{
		$image_url = "<img class=\"seq1\" border=\"0\" ".$image1params." alt=\"".$ordered['TITLE']."\" />";
	}
	if (($ordered['IMAGEOVER']!="")&&(file_exists($mosConfig_absolute_path."/".$image2[0])))
	{
		$image_url.= "<img class=\"seq2\" border=\"0\" ".$image2params." alt=\"".$ordered['TITLE']."\" />";
	}

	if ($ordered['SHOWNAME'] || $ordered['SHOWNAME']==null){$name = $image_url.$ordered['TITLE'];}else{$name = $image_url;}

	return $name;
}


function sw_getactive($ordered){
	$current_itemid = trim( mosGetParam( $_REQUEST, 'Itemid', 0 ) );
	$current_id = trim( mosGetParam( $_REQUEST, 'id', 0 ) );
	$current_task = trim( mosGetParam( $_REQUEST, 'task', 0 ) );

	if (!$current_itemid && $current_id){

		if(eregi( "category" , $current_task)){
			$current_itemid = $current_id+1000;
		}elseif(eregi( "section" , $current_task)){
			$current_itemid = $current_id;
		}
		elseif(eregi( "view" , $current_task)){
			$current_itemid = $current_id+10000;
		}
	}
	$indent=0;
	$parent_value = $current_itemid;
	$parent=1;
	$id=0;
	while ($parent){
		for($i=0;$i<count($ordered);$i++) {
			$row=$ordered[$i];
			if ($row['ID']==$parent_value ){
				$parent_value = $row['PARENT'];
				$indent = $row['indent'];
				$id=$row['ID'];
			}
		}
		if (!$indent){
			$parent=0;
		}
	}
	return ($id);
}


function sw_getsubmenu($ordered,$parent_level,$levels,$menu){
	global $Itemid;
	$option2 = trim( mosGetParam( $_REQUEST, 'option', 0 ) );
	$id = trim( mosGetParam( $_REQUEST, 'id', 0 ) );

	$i=0;
	$indent=0;
	$menudisplay=0;
	$parent=1;
	if (($menu=="swcontentmenu") && ($option2=="com_content") && $id){
		$parent_value=$id;

	}elseif ($menu=="swcontentmenu" ){
		$parent=0;
	}else{
		$parent_value=$Itemid;
		$menudisplay=0;
		$parent=1;
	}
	$id=0;
	//echo "parent ".$parent_value;
	while ($parent){
		foreach ($ordered as $row){
			if (($row['ID']==$parent_value || $row['ID']==$parent_value+1000 || $row['ID']==$parent_value+10000)){
				$parent_value = $row['PARENT'];
				$indent = $row['indent'];
				$id=$row['ID'];

			}
		}
		if ($indent == $parent_level){
			$parent=0;
			$id=$parent_value;

		}elseif($indent == $parent_level-1){
			$parent=0;
			//$id=$parent_value;

		}elseif($indent < $parent_level-1){
			$parent=0;


			if ($parent_level==2 ){
				$id = $id;
			}else{$id=0;}
		}

		$i++;
		if ($i > $levels){$parent=0;}


	}
	for($i=0;$i<count($ordered);$i++){
		$row=$ordered[$i];

		if (($row['PARENT']==$id)){
			$menudisplay=1;
		}
		if (($row['PARENT']==$id-1000)){
			$menudisplay=1;
		}
		if (($row['indent']==0)){
			$ordered[$i]['PARENT']=0;
		}

	}

	if ($menudisplay ){
		$ordered = chain('ID', 'PARENT', 'ORDER', $ordered, $id, $levels);
	}else{
		$ordered=array();
	}

	return $ordered;
}






class browser{

    var $Name = "Unknown";
    var $Version = "Unknown";
    var $Platform = "Unknown";
    var $UserAgent = "Not reported";
    var $AOL = false;

    function browser(){
        $agent = $_SERVER['HTTP_USER_AGENT'];

        // initialize properties
        $bd['platform'] = "Unknown";
        $bd['browser'] = "Unknown";
        $bd['version'] = "Unknown";
        $this->UserAgent = $agent;

        // find operating system
        if (preg_match("/win/i", $agent))
            $bd['platform'] = "Windows";
        elseif (preg_match("/mac/i", $agent))
            $bd['platform'] = "MacIntosh";
        elseif (preg_match("/linux/i", $agent))
            $bd['platform'] = "Linux";
        elseif (preg_match("~OS/2~i", $agent))
            $bd['platform'] = "OS/2";
        elseif (preg_match("/BeOS/i", $agent))
            $bd['platform'] = "BeOS";

        // test for Opera
        if (preg_match("/opera/i",$agent)){
            $val = stristr($agent, "opera");
            if (preg_match("~/~i", $val)){
                $val = explode("/",$val);
                $bd['browser'] = $val[0];
                $val = explode(" ",$val[1]);
                $bd['version'] = $val[0];
            }else{
                $val = explode(" ",stristr($val,"opera"));
                $bd['browser'] = $val[0];
                $bd['version'] = $val[1];
            }

        // test for WebTV
        }elseif(preg_match("/webtv/i",$agent)){
            $val = explode("/",stristr($agent,"webtv"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];

        // test for MS Internet Explorer version 1
        }elseif(preg_match("/microsoft internet explorer/i", $agent)){
            $bd['browser'] = "MSIE";
            $bd['version'] = "1.0";
            $var = stristr($agent, "/");
            if (preg_match("/308|425|426|474|0b1/i", $var)){
                $bd['version'] = "1.5";
            }

        // test for NetPositive
        }elseif(preg_match("/NetPositive/i", $agent)){
            $val = explode("/",stristr($agent,"NetPositive"));
            $bd['platform'] = "BeOS";
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];

        // test for MS Internet Explorer
        }elseif(preg_match("/imsie/i",$agent) && !preg_match("/opera/i",$agent)){
            $val = explode(" ",stristr($agent,"msie"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];

        // test for MS Pocket Internet Explorer
        }elseif(preg_match("/mspie/i",$agent) || preg_match('/pocket/i', $agent)){
            $val = explode(" ",stristr($agent,"mspie"));
            $bd['browser'] = "MSPIE";
            $bd['platform'] = "WindowsCE";
            if (preg_match("/mspie/i", $agent))
                $bd['version'] = $val[1];
            else {
                $val = explode("/",$agent);
                $bd['version'] = $val[1];
            }

        // test for Galeon
        }elseif(preg_match("/galeon/i",$agent)){
            $val = explode(" ",stristr($agent,"galeon"));
            $val = explode("/",$val[0]);
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];

        // test for Konqueror
        }elseif(preg_match("/Konqueror/i",$agent)){
            $val = explode(" ",stristr($agent,"Konqueror"));
            $val = explode("/",$val[0]);
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];

        // test for iCab
        }elseif(preg_match("/icab/i",$agent)){
            $val = explode(" ",stristr($agent,"icab"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];

        // test for OmniWeb
        }elseif(preg_match("/omniweb/i",$agent)){
            $val = explode("/",stristr($agent,"omniweb"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];

        // test for Phoenix
        }elseif(preg_match("/Phoenix/i", $agent)){
            $bd['browser'] = "Phoenix";
            $val = explode("/", stristr($agent,"Phoenix/"));
            $bd['version'] = $val[1];

        // test for Firebird
        }elseif(preg_match("/firebird/i", $agent)){
            $bd['browser']="Firebird";
            $val = stristr($agent, "Firebird");
            $val = explode("/",$val);
            $bd['version'] = $val[1];

        // test for Firefox
        }elseif(preg_match("/Firefox/i", $agent)){
            $bd['browser']="Firefox";
            $val = stristr($agent, "Firefox");
            $val = explode("/",$val);
            $bd['version'] = $val[1];

      // test for Mozilla Alpha/Beta Versions
        }elseif(preg_match("/mozilla/i",$agent) &&
            preg_match("/rv:[0-9].[0-9][a-b]/i",$agent) && !preg_match("/netscape/i",$agent)){
            $bd['browser'] = "Mozilla";
            $val = explode(" ",stristr($agent,"rv:"));
            preg_match("/rv:[0-9].[0-9][a-b]/i",$agent,$val);
            $bd['version'] = str_replace("rv:","",$val[0]);

        // test for Mozilla Stable Versions
        }elseif(preg_match("/mozilla/i",$agent) &&
            preg_match("/rv:[0-9]\.[0-9]/i",$agent) && !preg_match("/netscape/i",$agent)){
            $bd['browser'] = "Mozilla";
            $val = explode(" ",stristr($agent,"rv:"));
            preg_match("/rv:[0-9]\.[0-9]\.[0-9]/i",$agent,$val);
            $bd['version'] = str_replace("rv:","",$val[0]);

        // test for Lynx & Amaya
        }elseif(preg_match("/libwww/i", $agent)){
            if (preg_match("/amaya/i", $agent)){
                $val = explode("/",stristr($agent,"amaya"));
                $bd['browser'] = "Amaya";
                $val = explode(" ", $val[1]);
                $bd['version'] = $val[0];
            } else {
                $val = explode("/",$agent);
                $bd['browser'] = "Lynx";
                $bd['version'] = $val[1];
            }

        // test for Safari
        }elseif(preg_match("/safari/i", $agent)){
            $bd['browser'] = "Safari";
            $bd['version'] = "";

        // remaining two tests are for Netscape
        }elseif(preg_match("/netscape/i",$agent)){
            $val = explode(" ",stristr($agent,"netscape"));
            $val = explode("/",$val[0]);
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
        }elseif(preg_match("/mozilla/i",$agent) && !preg_match("/rv:[0-9]\.[0-9]\.[0-9]/i",$agent)){
            $val = explode(" ",stristr($agent,"mozilla"));
            $val = explode("/",$val[0]);
            $bd['browser'] = "Netscape";
            $bd['version'] = $val[1];
        }

        // clean up extraneous garbage that may be in the name
        $bd['browser'] = preg_replace("/[^a-z,A-Z]/i", "", $bd['browser']);
        // clean up extraneous garbage that may be in the version
        $bd['version'] = preg_replace("/[^0-9,.,a-z,A-Z]/i", "", $bd['version']);

        // check for AOL
        if (preg_match("/AOL/i", $agent)){
            $var = stristr($agent, "AOL");
            $var = explode(" ", $var);
            $bd['aol'] = preg_replace("/[^0-9,.,a-z,A-Z]/i", "", $var[1]);
        }

        // finally assign our properties
        $this->Name = $bd['browser'];
        $this->Version = $bd['version'];
        $this->Platform = $bd['platform'];
       // $this->AOL = $bd['aol'];
    }
}

?>
