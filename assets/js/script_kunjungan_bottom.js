function mydtformatter(date)
{
  //alert('mydtformatter(date) date=['+ date +']');
 
  var y = date.getFullYear();
  var m = date.getMonth()+1;
  var d = date.getDate();
  var s1 = String(y)+ '-' + String(m<10?('0'+m):m) + '-' + String(d<10?('0'+d):d);
 
  var hh = date.getHours();
  var mm = date.getMinutes();
  var ss = date.getSeconds();
  var s2 = String(hh<10?('0'+hh):hh) + ':' + String(mm<10?('0'+mm):mm) + ':' + String(ss<10?('0'+ss):ss);
 
//   alert('mydtformatter(date) return date=['+ s1 + ' ' + s2 +']');

  return s1 + ' ' + s2;
} 
function mydtparser(s)
{
  //alert('mydtparser(s) s=['+ s +']');
  if ( (!s) || ($.trim(s) == '') )
    {return new Date();}
  var dt = s.split(' ');
  var dateFormat = dt[0].split('-');
  var timeFormat = dt[1].split(':');
  var date = new Date( parseInt(dateFormat[0]),parseInt(dateFormat[1])-1,parseInt(dateFormat[2]) );
  if (dt.length>1){
    date.setHours(timeFormat[0]);
    date.setMinutes(timeFormat[1]);
    date.setSeconds(timeFormat[2]);
  }
  //alert('mydtparser(s) return date=['+ date +']');
  return date;
}