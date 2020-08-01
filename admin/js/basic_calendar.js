var themonths=['Ianuarie','Februarue','Martie','Aprilie','Mai','Iunie', 'Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie']

var todaydate=new Date()
var curmonth=todaydate.getMonth()+1 //get current month (1-12)
var curyear=todaydate.getFullYear() //get current year

function updatecalendar(theselection){
var themonth=parseInt(theselection[theselection.selectedIndex].value)+1
var calendarstr=buildCal(themonth, curyear, "main", "month", "daysofweek", "days", 0)
if (document.getElementById)
document.getElementById("calendarspace").innerHTML=calendarstr
}

document.write('<option value="'+(curmonth-1)+'" selected="yes">Luna Curentă</option>')
for (i=0; i<12; i++) //display option for 12 months of the year
document.write('<option value="'+i+'">'+themonths[i]+' '+curyear+'</option>')



function buildCal(m, y, cM, cH, cDW, cD, brdr){
  var mn=['Ianuarie','Februarue','Martie','Aprilie','Mai','Iunie', 'Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie'];
  var dim=[31,0,31,30,31,30,31,31,30,31,30,31];

  var oD = new Date(y, m-1, 1); //DD replaced line to fix date bug when current day is 31st
  oD.od=oD.getDay()+1; //DD replaced line to fix date bug when current day is 31st

  var todaydate=new Date() //DD added
  var scanfortoday=(y==todaydate.getFullYear() && m==todaydate.getMonth()+1)? todaydate.getDate() : 0 //DD added

  zile=['Duminică', 'Luni', 'Marti', 'Miercuri', 'Joi', 'Vineri', 'Sâmbătă'];
  dim[1]=(((oD.getFullYear()%100!=0)&&(oD.getFullYear()%4==0))||(oD.getFullYear()%400==0))?29:28;
  var t='<div class="'+cM+'"><table class="'+cM+'" cols="7" cellpadding="0" border="'+brdr+'" cellspacing="0"><tr align="center">';
  t+='<td colspan="7" align="center" class="'+cH+'">'+mn[m-1]+' - '+y+'</td></tr><tr align="center">';
  for(s=0;s<7;s++)t+='<td class="'+cDW+'">'+zile[s]+'</td>';
  t+='</tr><tr align="center">';
  for(i=1;i<=42;i++){
  var x=((i-oD.od>=0)&&(i-oD.od<dim[m-1]))? i-oD.od+1 : '&nbsp;';
  if (x==scanfortoday) //DD added
  x='<span id="today">'+x+'</span>' //DD added
  t+='<td class="'+cD+'">'+x+'</td>';
  if(((i)%7==0)&&(i<36))t+='</tr><tr align="center">';
  }
  return t+='</tr></table></div>';
  }




//Current time

	// Set the clock's font face:
	var myfont_face = "Verdana";

	// Set the clock's font size (in point):
	var myfont_size = "10";

	// Set the clock's font color:
	var myfont_color = "#000000";

	// Set the clock's background color:
	var myback_color = "#FFFFFF";

	// Set the text to display before the clock:
	var mypre_text = "The time is: ";

	// Set the width of the clock (in pixels):
	var mywidth = 300;

	// Display the time in 24 or 12 hour time?
	// 0 = 24, 1 = 12
	var my12_hour = 1;

	// How often do you want the clock updated?
	// 0 = Never, 1 = Every Second, 2 = Every Minute
	// If you pick 0 or 2, the seconds will not be displayed
	var myupdate = 1;

	// Display the date?
	// 0 = No, 1 = Yes
	var DisplayDate = 0;

/////////////// END CONFIGURATION /////////////////////////
///////////////////////////////////////////////////////////

// Browser detect code
        var ie4=document.all
        var ns4=document.layers
        var ns6=document.getElementById&&!document.all

// Global varibale definitions:

	var dn = "";
	var mn = "th";
	var old = "";

// The following arrays contain data which is used in the clock's
// date function. Feel free to change values for Days and Months
// if needed (if you wanted abbreviated names for example).
	var DaysOfWeek = new Array(7);
		DaysOfWeek[0] = "Sunday";
		DaysOfWeek[1] = "Monday";
		DaysOfWeek[2] = "Tuesday";
		DaysOfWeek[3] = "Wednesday";
		DaysOfWeek[4] = "Thursday";
		DaysOfWeek[5] = "Friday";
		DaysOfWeek[6] = "Saturday";

	var MonthsOfYear = new Array(12);
		MonthsOfYear[0] = "January";
		MonthsOfYear[1] = "February";
		MonthsOfYear[2] = "March";
		MonthsOfYear[3] = "April";
		MonthsOfYear[4] = "May";
		MonthsOfYear[5] = "June";
		MonthsOfYear[6] = "July";
		MonthsOfYear[7] = "August";
		MonthsOfYear[8] = "September";
		MonthsOfYear[9] = "October";
		MonthsOfYear[10] = "November";
		MonthsOfYear[11] = "December";

// This array controls how often the clock is updated,
// based on your selection in the configuration.
	var ClockUpdate = new Array(3);
		ClockUpdate[0] = 0;
		ClockUpdate[1] = 1000;
		ClockUpdate[2] = 60000;

// For Version 4+ browsers, write the appropriate HTML to the
// page for the clock, otherwise, attempt to write a static
// date to the page.
	if (ie4||ns6) { document.write('<span id="LiveClockIE" style="width:'+mywidth+'px; background-color:'+myback_color+'"></span>'); }
	else if (document.layers) { document.write('<ilayer bgColor="'+myback_color+'" id="ClockPosNS" visibility="hide"><layer width="'+mywidth+'" id="LiveClockNS"></layer></ilayer>'); }
	else { old = "true"; show_clock(); }

// The main part of the script:
	function show_clock() {
		if (old == "die") { return; }

	//show clock in NS 4
		if (ns4)
                document.ClockPosNS.visibility="show"
	// Get all our date variables:
		var Digital = new Date();
		var day = Digital.getDay();
		var mday = Digital.getDate();
		var month = Digital.getMonth();
		var hours = Digital.getHours();

		var minutes = Digital.getMinutes();
		var seconds = Digital.getSeconds();

	// Fix the "mn" variable if needed:
		if (mday == 1) { mn = "st"; }
		else if (mday == 2) { mn = "nd"; }
		else if (mday == 3) { mn = "rd"; }
		else if (mday == 21) { mn = "st"; }
		else if (mday == 22) { mn = "nd"; }
		else if (mday == 23) { mn = "rd"; }
		else if (mday == 31) { mn = "st"; }

	// Set up the hours for either 24 or 12 hour display:
		if (my12_hour) {
			dn = "AM";
			if (hours > 12) { dn = "PM"; hours = hours - 12; }
			if (hours == 0) { hours = 12; }
		} else {
			dn = "";
		}
		if (minutes <= 9) { minutes = "0"+minutes; }
		if (seconds <= 9) { seconds = "0"+seconds; }

	// This is the actual HTML of the clock. If you're going to play around
	// with this, be careful to keep all your quotations in tact.
		myclock = '';
		myclock += '<font style="color:'+myfont_color+'; font-family:'+myfont_face+'; font-size:'+myfont_size+'pt;">';
		myclock += mypre_text;
		myclock += hours+':'+minutes;
		if ((myupdate < 2) || (myupdate == 0)) { myclock += ':'+seconds; }
		myclock += ' '+dn;
		if (DisplayDate) { myclock += ' on '+DaysOfWeek[day]+', '+mday+mn+' '+MonthsOfYear[month]; }
		myclock += '</font>';

		if (old == "true") {
			document.write(myclock);
			old = "die";
			return;
		}

	// Write the clock to the layer:
		if (ns4) {
			clockpos = document.ClockPosNS;
			liveclock = clockpos.document.LiveClockNS;
			liveclock.document.write(myclock);
			liveclock.document.close();
		} else if (ie4) {
			LiveClockIE.innerHTML = myclock;
		} else if (ns6){
			document.getElementById("LiveClockIE").innerHTML = myclock;
                }

	if (myupdate != 0) { setTimeout("show_clock()",ClockUpdate[myupdate]); }
}
