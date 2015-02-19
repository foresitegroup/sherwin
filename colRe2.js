
window.onload=function()
{


tester=document.getElementById("productsCom");
tester.style.height = 'auto';
var x = tester.offsetHeight;


tester2=document.getElementById("contentProduct");
tester2.style.height = 'auto';
var xx = tester2.offsetHeight;

if(x>xx){tester2.style.height=x+"px";}
if(x<xx){tester.style.height=xx+"px";}


/* end Resize */

/*  Add ProductTitle  */
/*  Remove Form */

changeTheTitle();

removeForm();


}


function changeTheTitle()
{
if(document.getElementById('active_menu')){goodText=document.getElementById('active_menu').innerHTML;}

if(document.getElementById('productTitle')){document.getElementById('productTitle').innerHTML=goodText;}

if(document.getElementById('charlesHead')){document.getElementById('charlesHead').innerHTML=goodText+" Products";}




}


function removeForm()
{
if(document.getElementById('theOrderForm')){document.getElementById('theOrderForm').innerHTML="";}


}