<?php
			$dbc=mysql_connect('localhost','remediho_sherwin','Pleasant100')OR die('could not connect'.mysql_error());

			mysql_select_db('remediho_sherwin') OR die('sorry');


			$myQuery="SELECT introtext,id FROM jos_content";

			$result=mysql_query($myQuery)or die('sorry kid');

			while ($row2 = mysql_fetch_array($result,MYSQL_ASSOC))
			{
				
			 	if($row2['id']==20){$display=$row2['introtext'];}



			}
?>