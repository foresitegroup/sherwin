<html>
<head>

<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<link href="<?php echo $mosConfig_live_site; ?>/templates/sherwin/css/template_css.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="colRe1.js"></script> 
<script type="text/javascript" src="swfobject.js"></script> 
<!--<link rel="stylesheet" type="text/css" href="images/css.css" /> -->

<?php mosShowHead(); ?>
</head>
<body>
<div id="wrapper" align="center">

	<div id="top">

	 	<div id="float2">
			
			<?php mosLoadModules ( 'user1',-2); ?>
		 	
		

		</div> <!-- END FLOAT2 -->
	
	<div class="clear"></div>

	</div><!-- END TOP -->


	<div id="bannerBack">
		<div id="banner">

		<div id="bannerImage">

			<div id="float1">

				<div id="flashThing">
				
				</div>

				<script type="text/javascript">

 				 var so = new SWFObject("templates/sherwin/images/logoButton.swf", "logo", "316", "55", "6", "#ffffff"); 
  				 so.addVariable("variable", "varvalue"); 
				 so.addParam("wmode", "transparent");
  				 so.write("flashThing"); 
	  			 
				 </script> 
	
			</div> <!-- END FLOAT1 -->

		</div>
		
		</div> <!-- END BANNER -->
	</div><!--  END BANNERBACK -->
	


	<div id="mainBack">
		<div id="main">

			<div id="theMenu">
			 <?php mosLoadModules ( 'top',-2); ?>

			


			</div>
			<div id="wrapLeft">

			 	<div id="lImage1">
					<div id="image1Text">
					  <strong style="font-size:10pt">Golight</strong>
					  <br />
					  Golight Remote Control Portable Search Light
	 				  <p>
					  <a href="index.php?option=com_content&task=view&id=14&Itemid=35" class="redText">Learn More >></a>
	 				  </p>
					</div>
				</div>
				<div class="clear"></div>
				

			 	<div id="lImage2">
				`	<div id="image2Text">
					 See all the locations that Sherwin Industries will be  making appearances to.
					</div>
					<div class="clear"></div>

					<div id="image2EventText"><strong>

					<?php mosLoadModules ( 'inset',-2); ?>

					  <!-- event Mod<br />
					  inserted<br />
					  here<br />
					  --> </strong>
	 				  <p>
					  <a href="#" class="redText">Learn More >></a>
	 				  </p>

					</div>

					
				</div>
				<div class="clear"></div>
				<div id="nothing"></div>
			
			</div> <!--  END WRAPLEFT -->
			


<!-- ***********************************CONTENT*************************************** -->

			<div id="content">
			<div id="strecher"></div>
			<?php mosPathWay(); ?>
			


<p>
<!--<?php mosMainBody(); ?>-->

<div style="float:left; width:150px""><h1 style="display:inline">Contact Us</h1></div>
<div style="float:left"><img src="templates/sherwin/images/mapLedgend.gif" /></div>

<div><img src="templates/sherwin/images/map.gif" width="430" /></div>

</p>
<p>


<form name="States"  >
<select name="States" style="width:200px;" onChange="testSelect()" id="States">
<option value="allState">All States</option>
<option value="westernSales">Arizona</option>
<option value="westernSales">California</option>
<option value="westernSales">Oregon</option>
<option value="westernSales">Washington</option>
<option value="wisconsin">Wisconsin</option>
<option value="virginia ">Virginia </option>
<option value="inmi ">Indiana</option>
<option value="inmi">Michigan</option>
<option value="illinois">Illinois</option>
<option value="southOffice">North Carolina</option>
<option value="southOffice">South Carolina</option>
<option value="southOffice">Georgia</option>
<option value="southOffice">Tennessee</option>
<option value="southOffice">Kentucky</option>
<option value="southOffice">Alabama</option>
<option value="pacific">Alaska</option>
<option value="pacific">Hawaii</option>
<option value="europe">Europe</option>

</select>

</form>


 <script type="text/javascript" src="state.js"></script>






<div id="contactInfo">
</div>

			</div>
			<div class="clear"></div>

<!-- **********************************END CONTENT*********************************** -->



			<div id="footer">

			<?php mosLoadModules ( 'footer',-2); ?>
			©2007 Sherwin Industries, Inc.  All Rights Reserved


			</div>

		</div> <!--  END MAIN  -->
	</div> <!--  END MAINBACK  -->

</div><!-- END WRAPPER -->
</body>
</html>



