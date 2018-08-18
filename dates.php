<?php

/*
$mysqldate = date( 'Y-m-d H:i:s', $phpdate );
$phpdate = strtotime( $mysqldate );



$query = "UPDATE table SET  datetimefield = FROM_UNIXTIME($phpdate)     WHERE...";
$query = "SELECT UNIX_TIMESTAMP(datetimefield)   FROM table WHERE...";


see 

http://www.richardlord.net/blog/php/dates-in-php-and-mysql.html



The followiing computations work on mysqlinpu NO need to $phpdate = strtotime( $mysqldate );
$date1 = new DateTime($timein);
$date2 = new DateTime($timeout);

$diff = $date2->diff($date1);
echo $days = $diff->format('%d');	
echo $hours = $diff->format('%h');		
echo $minutes = $diff->format('%i') / 60;	
$seconds = $diff->format('%s') / 360;


RT
$timestamped = $row['timeanddate'];
$phpdate = strtotime( $timestamped );
$mysqldate = date( 'H:i a', $phpdate );

*/
echo "Hello";
//echo time();
?>


<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/
?>



<p> The download will begin in <span id="countdowntimer">10 </span> Seconds</p>

<script type="text/javascript">
    var timeleft = 10;
    var downloadTimer = setInterval(function(){
    timeleft--;
    document.getElementById("countdowntimer").textContent = timeleft;
    if(timeleft <= 0)
        clearInterval(downloadTimer);
    },1000);
</script>




<progress value="0" max="10" id="progressBar"></progress>
<script type="text/javascript">
var timeleft = 10;
var downloadTimer = setInterval(function(){
  document.getElementById("progressBar").value = 10 - --timeleft;
  if(timeleft <= 0)
    clearInterval(downloadTimer);
},1000);
</script>

<?php

echo "<br/>-----------------------";
echo "<br/>-----------------------";
echo "<br/>-----------------------";
echo "<br/>-----------------------";



//echo $_SERVER['DOCUMENT_ROOT'];
///echo __FILE__;

// *************** Good: https://www.webpagefx.com/blog/web-design/php-dateinterval-class/

echo ini_get('session.gc_maxlifetime');;

echo phpinfo();

if(1==0) // I get previous and next date
{
echo "<h4>hi</h4>";

echo $date = '2017-11-06 00:00:00';
echo "<br/><br/>";

$dateshow = date('Y-m-d',strtotime($date));
$prev_date = date('Y-m-d', strtotime($date .' -1 day'));
$next_date = date('Y-m-d', strtotime($date .' +1 day'));

echo $prev_date;
echo "&nbsp;&nbsp;";
echo "<b>$dateshow </b>";
echo "&nbsp;&nbsp;";
echo  $next_date;
}
?>

<?php

if(1==1) // I get all dates in a range
{

echo "<h4>hi</h4>";

$datemin = '2017-11-05 00:00:00';
$datemax = '2017-11-10 00:00:00';

echo $datemin;
echo "<br/>";
echo "<br/>";
echo $datemax;
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";

$day1 = 86400;

//$startdate = date("Y-m-d",strtotime($datemin))." 00:00:00.000000";
//$enddate_in = date("Y-m-d",strtotime($datemax))." 23:59:59.999999";

$start_u = strtotime($datemin);
$stop_u = strtotime($datemax);

echo "start unix = ".$start_u;
echo "<br/>";
echo "stop unix = ".$stop_u;
echo "<br/>";
echo "<br/>";

$nextday = $start_u + $day1;
echo $nextday;

echo "<br/>";
echo date('Y-m-d h:i:s', $nextday);
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
/*
for ($i = 0; $i <= $stop_u; $i++)
{
    $show_date = strtotime(date('Y-m-d', $start_u+$i)));
	echo "++++".$show_date;

} 
*/

$enddate = date('Y-m-d', strtotime($enddate_in  .' +1 day'));

echo "Start: ".$startdate;
echo "<br/><br/>";
echo "End: ".date('Y-m-d h:i:s',strtotime($enddate));
echo "<br/><br/>";


echo $date = '2017-11-06 00:00:00';
echo "<br/><br/>";

$dateshow = date('Y-m-d',strtotime($date));
$prev_date = date('Y-m-d', strtotime($date .' -1 day'));
$next_date = date('Y-m-d', strtotime($date .' +1 day'));

echo $prev_date;
echo "&nbsp;&nbsp;";
echo "<b>$dateshow </b>";
echo "&nbsp;&nbsp;";
echo  $next_date;
}

?>



































