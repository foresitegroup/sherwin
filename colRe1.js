window.onload=function()
{


tester=document.getElementById("nothing");
tester.style.height = 'auto';
var x = tester.offsetHeight;
//alert(x);




tester2=document.getElementById("content");
tester2.style.height = 'auto';
var xx = tester2.offsetHeight;
//alert(xx);

if(x<xx){tester.style.height=(xx-413)+"px";tester.style.visibility="visible"}

if(xx<=413){tester.style.height=0+"px";tester.style.visibility="hidden";}



  changeDate();



}//END ONLOAD






function changeDate()
{
 var January=1;
 var February=2;
 var March=3;
 var April=4;
 var May=5;
 var June=6;
 var July=7;
 var August=8;
 var September=9;
 var October=10;
 var November=11;
 var December=12;
 var theMonth;
 var theMonth2; 
 var fixDate2;
 var theDay;
 var theDay2;
 var half1 = new Array();
 var half2 = new Array();
 sDates="-";

 var dateLine=getElementsByClass('eventDate');
 dateLength=dateLine.length;


/*#######################################*/
/*
testHalf=dateLine[1].innerHTML.split(sDates);


	fixDate1=testHalf[0].split(" ");
	theMonth=fixDate1[0];
	theDay=fixDate1[1];theDay=theDay.split(",");theDay=theDay[0];

	fixDate2=testHalf[1].split(" ");
	theMonth2=fixDate2[1];

	theDay2=fixDate2[2];theDay2=theDay2.split(",");theDay2=theDay2[0];
	
	alert(theMonth);
	alert(theMonth2);
	alert(theDay);
	alert(theDay2);
*/
/*#######################################*/

  
 	for(var incx=0; incx<dateLength; incx++)
 	{
 
  	testHalf = dateLine[incx].innerHTML.split(sDates);
	var fixDate1=testHalf[0].split(" ");
	var theMonth=eval(fixDate1[0]);
	var theDay=fixDate1[1];theDay=theDay.split(",");theDay=theDay[0];
		
		if(testHalf[1])
		{
		 fixDate2=testHalf[1].split(" ");
		 theMonth2=eval(fixDate2[1]);
		 theDay2=fixDate2[2];theDay2=theDay2.split(",");theDay2=theDay2[0];
		}

		

  	var newFormat=theMonth+"/"+theDay;
		if(testHalf[1]){newFormat+=" - "+theMonth2+"/"+theDay2}


 	dateLine[incx].innerHTML=newFormat
	}
 


}





function getElementsByClass(searchClass,node,tag)
{
	var classElements = new Array();
	if ( node == null )
		node = document;
	if ( tag == null )
		tag = '*';
	var els = node.getElementsByTagName(tag);
	var elsLen = els.length;
	var pattern = new RegExp("(^|\\s)"+searchClass+"(\\s|$)");
	for (i = 0, j = 0; i < elsLen; i++) {
		if ( pattern.test(els[i].className) ) {
			classElements[j] = els[i];
			j++;
		}
	}
	return classElements;

}
