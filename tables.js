var array1 = new Object();
var click = 0;
var val1 = 0;
$(document).ready(function(){
	$('.drag').draggable({revert:true,containment:'document',cursor:'pointer'
		,start:function(){
			val1 = $(this).text();
		}
	});

	$('textarea').droppable({hoverclass:'.border',accept:'.drag',
		drop:function(){
			//alert(val1);
			$(this).val(val1);
			loadAndClick();
		}
	 });

	$('*').css({display:"none"});
	//$('.left-col-captions').fadeIn('fast');
	$('*').fadeIn('slow');

	var arD = generate(click);
	inputdate(arD);
	loadAndClick();
	$('textarea').keyup(loadAndClick);
	//.blur(loadAndClick);
	//$('textarea').blur(loadAndClick);
	$('#pe').change(function()
	{	

		var name = $('#pe').val();
		$('#name').html(name);
		$('#pe2').val(name);
		//alert(name);
		renderBlank();
		$.ajax
		({
			url:'getName-Service.php',
			type:'POST',
			data:'username='+name,
			dataType: 'json',
			success:function(data)
			{
				//alert(Object.keys(data).length);
				array1 = data;
				//alert(array1[0].PE);
				var arD = generate(click);
				renderAll(arD);
				inputdate(arD);
				loadAndClick();
			}

		});
	});


	



});
function loadAndClick()
{	//$('*').css({display:"none"});
	//$('*').fadeIn('slow');
	var total = [0,0,0,0,0];
	for(var i=0;i<5;i++)
	{	var project =  $('#project'+i).val().toString().trim();
		var all = $('#all'+i).val().toString().trim();
		var etc = $('#etc'+i).val().toString().trim();
		var remain = $('#remain'+i).val().toString().trim();
		var meeting = $('#meeting'+i).val().toString().trim();
		var general = $('#general'+i).val().toString().trim();
		var sr = $('#sr'+i).val().toString().trim();
		if(sr!="") total[i]+=parseInt(sr);
		if(project!="") total[i]+=parseInt(project);
		if(all!="") total[i]+=parseInt(all);
		if(etc!="") total[i]+=parseInt(etc);
		if(remain!="") total[i]+=parseInt(remain);
		if(meeting!="") total[i]+=parseInt(meeting);
		if(general!="") total[i]+=parseInt(general);
		//alert(parseInt(project)+parseInt(all)+parseInt(etc)+parseInt(remain)+parseInt(meeting)+parseInt(general));
		$('#total'+i).val(total[i]);
		if((total[i])>8)
		{
			//document.getElementById('total'+i).style.background = "red";
			$('#total'+i).css({'background-color':'red'});
		}
		else
		{
			//document.getElementById('total'+i).style.background = "#e5e5e5";
			$('#total'+i).css({'background-color':"#e5e5e5"});
		}
	}
	showTotalWeek();
}

	function generate(click)
	{	var arDate = [];
		var arDate2 = [];
		for(var i=-2;i<3;i++)
		{	var adddate=[3,2,1,0,-1,-2,-3];
			var strday = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
			var strMonth = ['Jan','Feb','Mar','Apr','May','June','July','Aug','Sep','Oct','Nov','Dec'];
			var datetime = new Date();
			datetime = addDay(datetime,adddate[datetime.getDay()]);
			datetime = addDay(datetime,(click*7)+i);
			var strdate = datetime.getDate().toString()+" "+strday[datetime.getDay()]+" "+strMonth[datetime.getUTCMonth()]+" "+datetime.getUTCFullYear();
			var intmonth = datetime.getUTCMonth()+1;
			var month = intmonth.toString().length==1 ? "0"+intmonth.toString() : intmonth.toString() ;
			var day = datetime.getUTCDate().toString().length==1 ? "0"+datetime.getUTCDate() : datetime.getUTCDate();
			var strdate2 = datetime.getUTCFullYear()+"-"+month+"-"+day;
			arDate.push(strdate);
			arDate2.push(strdate2);
		}
		document.all['date1'].innerHTML = arDate[0];
		document.all['date2'].innerHTML = arDate[1];
		document.all['date3'].innerHTML = arDate[2];
		document.all['date4'].innerHTML = arDate[3];
		document.all['date5'].innerHTML = arDate[4];
		return arDate2;
	}
		function addDay(datetime,day)
	{
		datetime.setDate(datetime.getDate()+day);
		return datetime;
	}
	
	function renderAll(arDate2)
	{
		for(var i=0;i<5;i++)
		{	var j=0;var found=false;
			//alert(Object.keys(array1).length);
			while(j<array1.length&&!found)
			{	//alert(array1[j].date_effort+"1"+arDate2[i]);
				if(array1[j].date_effort==arDate2[i])
				{
					/*document.all["sr"+i].innerHTML = sr[j];
					document.all["project"+i].innerHTML = project[j];
					document.all["all"+i].innerHTML = all_leaves[j];
					document.all["remain"+i].innerHTML = remain[j];
					document.all["meeting"+i].innerHTML = meeting[j];
					document.all["general"+i].innerHTML = general[j];
					document.all["total"+i].innerHTML = total[j];
					document.all["comment"+i].innerHTML = comment[j];
					document.all["etc"+i].innerHTML = etc[j];*/
					document.getElementById("sr"+i).value = array1[j].SR;
					document.getElementById("project"+i).value = array1[j].Project;
					document.getElementById("all"+i).value = array1[j].All_leaves;
					document.getElementById("remain"+i).value = array1[j].Remaining;
					document.getElementById("meeting"+i).value = array1[j].Meeting;
					document.getElementById("general"+i).value = array1[j].General;
					document.getElementById("total"+i).value = array1[j].total;
					document.getElementById("comment"+i).value = array1[j].Comment_effort;
					document.getElementById("etc"+i).value = array1[j].ETC;
					found = true;
				}
				else
				{
					j++;
				}
			}
		}
	}
	function renderBlank()
	{
		for(var i=0;i<5;i++)
		{
			/*document.all["sr"+i].innerHTML = "";
			document.all["project"+i].innerHTML = "";
			document.all["all"+i].innerHTML = "";
			document.all["remain"+i].innerHTML = "";
			document.all["meeting"+i].innerHTML = "";
			document.all["general"+i].innerHTML = "";
			document.all["total"+i].innerHTML = "";
			document.all["comment"+i].innerHTML = "";
			document.all["etc"+i].innerHTML = "";*/
			/*$("sr"+i).value = "";
			$("project"+i).value = "";
			$("all"+i).value = "";
			$("remain"+i).value = "";
			$("meeting"+i).value = "";
			$("general"+i).value = "";
			$("total"+i).value = "";
			$("comment"+i).value = "";
			$("etc"+i).value = "";*/
			$("#total"+i).css('background-color','#e5e5e5');
			document.getElementById("sr"+i).value = "";
			document.getElementById("project"+i).value = "";
			document.getElementById("all"+i).value = "";
			document.getElementById("remain"+i).value = "";
			document.getElementById("meeting"+i).value = "";
			document.getElementById("general"+i).value = "";
			document.getElementById("total"+i).value = "";
			document.getElementById("comment"+i).value = "";
			document.getElementById("etc"+i).value = "";
		}
	}
	function inputdate(arDate)
	{
		for(var i=0;i<5;i++)
		{
			document.getElementById('datepost'+i).value = arDate[i];
		}
	}
	function back(){
		click--;
		renderBlank();
		var arDate2 = generate(click);
		renderAll(arDate2);
		inputdate(arDate2);
		loadAndClick();
		showTotalWeek();
	}
	function forward(){
		click++;
		renderBlank();
		var arDate2 = generate(click);
		renderAll(arDate2);
		inputdate(arDate2);
		loadAndClick();
		showTotalWeek();
	}
	

function showTotalWeek()
{
	var totalweek = 0;
	for(var i=0;i<5;i++)
	{	
		var total = $('#total'+i).val().toString().trim();
		if(total!="") totalweek+=parseInt(total);
	}
	$('#totalweek').html(totalweek);
	if(totalweek>40)
	{
		$('#totalweek').css({'background-color':'red'});
	}
	else 
	{
		$('#totalweek').css({'background-color':'#e5e5e5'})
	}
}
