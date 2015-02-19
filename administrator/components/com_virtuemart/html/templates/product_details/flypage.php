<!-- {navigation_pathway} -->


<table border="0" style="width: 100%;">
  <tbody>
	<tr><td colspan="2" style="text-align:right;">
	<a href="javascript:void printView();"><span style="font-size:9px;text-weight:bold">Print View</span> </a>
	 </td></tr><tr>
<td>

	<div  id="printPage">


	<table  border="0" style="width: 100%;">
	<tr>



	  <td colspan="2" valign="bottom"><div style="float:left; border-bottom:2px dotted #000;width:95%"><h1 style="display:inline;color:#048ECF;font-weight:normal;">{product_name} {edit_link}</h1><div id="pdfText" style="display:inline;"></div></div></td>
	</tr>
	<tr>

	  	 
	
	 <td valign="top"><div style="float:left; width:200px;padding:10px;">{product_image}</div><span style="font-size:9pt;"> {product_description}<br/></span><span style="font-style: italic">{file_list}</span></td>
	</tr>


	</tr>
	</table>
	
	</div>







</td></tr> 
</tbody>
</table>

<br style="clear:both"/>



<script>
 noExtra=document.getElementsByTagName('noscript');
 //noExtra[0].innerHTML="";

function printView()
{
 var theStyle='<link href="http://www.sherwinindustriesinc.com/sherwin/templates/sherwin/css/template_css.css" rel="stylesheet" type="text/css" />\r\n'
 theStyle+="<style>body{background-color:#fff;}</style>";
pageToPrint="";
 xscript="script";
 xxscript="SCRIPT";
 strTarget='<script type="text/javascript">';
 var pageToPrint=document.getElementById('printPage').innerHTML;

 	strTarget='<'+xscript+' type="text/javascript">';
	pageToPrint = pageToPrint.replace(strTarget,"<!--");

 	strTarget='<'+xxscript+' type=text/javascript>';
	pageToPrint = pageToPrint.replace(strTarget,"<!--");

 	strTarget='</'+xscript+'>';
	pageToPrint = pageToPrint.replace(strTarget," -->");

 	strTarget='</'+xxscript+'>';
	pageToPrint = pageToPrint.replace(strTarget," -->");

//alert(pageToPrint);
 pWindow=window.open('','mywin',' status=no,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,resizable=yes,width=600,height=700,directories=no,location=no');


	pWindow.document.open();

	pWindow.document.write(pageToPrint+"<"+xscript+">window.focus();window.onclick=function(){window.stop()};</"+xscript+">\r\n"+theStyle);
	pWindow.document.close();

}

	 
	if(typeof pdfName!="undefined")
	{

	 //var thePdfText="additional details";
		
	 	var thePdfText=pdfName;
		var lowercasePdf=pdfName.toLowerCase();
		pdfName=lowercasePdf;
	 var theImageSrc="<img src='images/stories/sherwin/pdf-logo.gif' height='20'/>";

	document.getElementById('pdfText').innerHTML=thePdfText+"<a 				href='images/PDFS/"+pdfName+".pdf'>"+theImageSrc+"</a>";
	 

	}


</script>
