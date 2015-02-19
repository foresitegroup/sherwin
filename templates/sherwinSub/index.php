<html>
<head>

<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<link href="<?php echo $mosConfig_live_site; ?>/templates/sherwin/css/template_css.css" rel="stylesheet" type="text/css" />
<!--
<script type="text/javascript" src="colRe2.js"></script>
<script type="text/javascript" src="swfobject.js"></script> 
-->
<script type="text/javascript" src="http://www.sherwinindustriesinc.com/sherwin/colRe2.js"></script> 
<script type="text/javascript" src="http://www.sherwinindustriesinc.com/sherwin/swfobject.js"></script> 





<?php mosShowHead(); ?>
</head>

</head>
<body>
<div id="wrapper" align="center">

	<div id="top">

	<div id="top">

	 	<div id="float2">
			
			<?php mosLoadModules ( 'user1',-2); ?>
		 	
		

		</div> <!-- END FLOAT2 -->

	 	<div id="float3">
			
			<?php mosLoadModules ( 'user9',-2); ?>
		 	
		

		</div> <!-- END FLOAT3 -->


		<div id="float4">
			
			<?php mosLoadModules ( 'user6',-2); ?>
		 	
		

		</div> <!-- END FLOAT4 -->
	
	
	<div class="clear"></div>

	</div><!-- END TOP -->
	</div><!-- END TOP -->


	<div id="bannerBack">
		<div id="banner">


			<div id="flashBanner">

			</div>


				<script type="text/javascript">

 				 var fBanner = new SWFObject("templates/sherwin/images/banner.swf", "logo", "705", "202", "6", "#ffffff"); 
  				 fBanner.addVariable("variable", "varvalue"); 
				 fBanner.addParam("wmode", "transparent");
  				 fBanner.write("flashBanner");
	  			 
				 </script> 



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


		
		</div> <!-- END BANNER -->
	</div><!--  END BANNERBACK -->
	


	<div id="mainBack">
		<div id="main">

			<div id="theMenu">
			 <?php mosLoadModules ( 'top',-2); ?>
			</div>
		
			<div id="productsCom">

			<img src="./templates/sherwin/images/productsLMenu.jpg" id="lMenuHead"/>
			 	
			<?php mosLoadModules ( 'user2',-2); ?>
	
					
			
				<div class="clear"></div>
			<div id="searchBox"> 
			
	 	<?php mosLoadModules ( 'user4',-2); ?>

			</div>

				
			</div> <!-- END  productsCom -->
		       

			
	
			
			


<!-- ***********************************CONTENT*************************************** -->

			<div id="contentProduct">
			<!-- <div id="strecher"></div> -->
			

			<?php mosPathWay(); ?>
			


<p>
<?php mosMainBody(); ?>

</p>
										

		
				





			</div><!-- END CONTENT  -->
			<div class="clear"></div>

<!-- **********************************END CONTENT*********************************** -->



			<div id="footer">

				<div id="bbb" style="float:left;padding:5px;">
				  <a target="_BLANK" title="Sherwin Industries, Inc. BBB Business Review" href="http://www.bbb.org/wisconsin/business-reviews/asphalt/sherwin-industries-inc-in-milwaukee-wi-14003956/#bbbonlineclick"><img alt="Sherwin Industries, Inc. BBB Business Review" border="0" src="http://ourbbbonline2.bbb.org/Milwaukee/BBBOnlineSeal/14003956/H2/0/seal.png" /></a>
					
					<!--
				  <a target="_blank" href="http://www.bbbonline.org/cks.asp?id=1071226133413270">
				  <img src="templates/sherwin/images/bbb.gif" />
				  </a>
          -->
				</div>
				
				<div style="float:right;width:450px">
				<?php mosLoadModules ( 'footer',-2); ?>
				&copy; <?php echo date("Y"); ?> Sherwin Industries, Inc.  All Rights Reserved
				</div>
<div style="clear:both"></div>

			</div>

		</div> <!--  END MAIN  -->
	</div> <!--  END MAINBACK  -->

</div><!-- END WRAPPER -->
</body>
</html>



