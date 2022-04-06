<?php
/**
 * Plugin Name: CountDownWithDB Plugin
 * Plugin URI: https://demo.imagint.co/my-first-plugin
 * Description: The very first plugin that I have ever created.
 * Version: 5.3
 * Author: Tan En Qian
 * Author URI: https://demo.imagint.co
 */

add_action('admin_menu','addMenu');

function addMenu(){
    add_menu_page("CountDownplugin","CountDownplugin","manage_options","CountDownplugin","displayPage",null,1);
}

function displayPage(){
echo '<div class="text-center">
<h1>Select a date</h1>
<input type="date" name="dateChosen" id="txtDate" class="form-control" placeholder="May 26, 2017 01:30:00"/>
<br><br>

<h4>Choose which field do you want to show</h4>
</div>

<form method="post">
<label for="checkYear">Year:</label> 
<input type="checkbox" name="cy" id="checkYear" onclick="startTimer()" >

<label for="checkDay">Days:</label> 
<input type="checkbox" name="cd" id="checkDay" onclick="startTimer()" >

<label for="checkHour">Hour:</label> 
<input type="checkbox" name="ch" id="checkHour" onclick="startTimer()" >

<label for="checkMin">Min:</label> 
<input type="checkbox" name="cm" id="checkMin" onclick="startTimer()" >

<label for="checkSec">Second:</label> 
<input type="checkbox" name="cs" id="checkSec" onclick="startTimer()" ><br><br>

<h1><br><br>Preview of your countdown timer</h1><br>
<div >
<p id="demo"></p>
<h1 id="y" style="display:block;"></h1>
<h1 id="d" style="display:block;"></h1>
<h1 id="h" style="display:block;"></h1>
<h1 id="m" style="display:block;"></h1>
<h1 id="s" style="display:block;"></h1>
<br>
<br>
        <input type="submit" name="btnSave"
                value="Save Setting"/>
                </form>

 </div> ';
    ?>
<script>

function startTimer(){
dateEntered = document.getElementById("txtDate").value;

countDownDate = new Date(dateEntered).getTime();

x = setInterval(refreshDate, 1000);
}

function refreshDate() {

var now = new Date().getTime();

var distance = countDownDate - now;

var days = Math.floor(Math.abs(distance / (1000 * 60 * 60 * 24)));
var years = Math.floor(days / 365);
var hours = Math.floor(Math.abs((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
var minutes = Math.floor(Math.abs((distance % (1000 * 60 * 60)) / (1000 * 60)));
var seconds =Math.floor(Math.abs((distance % (1000 * 60)) / 1000));

  if (distance < 0) {
  
        clearInterval(x);
        
        document.getElementById("demo").innerHTML = "Ago: </br></br>";
        var checkBoxY = document.getElementById("checkYear");
  
  if (checkBoxY.checked == true){
   document.getElementById("y").innerHTML  = years+ " Year(s)";
 } 
 else {
 document.getElementById("y").innerHTML  = "";
 }
 
var checkBoxD = document.getElementById("checkDay");
 
if (checkBoxD.checked == true){
   document.getElementById("d").innerHTML  = days + " Day(s)";
} 
else {
 document.getElementById("d").innerHTML  = "";
}
 
var checkBoxH = document.getElementById("checkHour");
 
if (checkBoxH.checked == true){
   document.getElementById("h").innerHTML  = hours+ " Hour(s)";
} 
else {
document.getElementById("h").innerHTML  = "";
}
 
var cbM = document.getElementById("checkMin");
 
if (cbM.checked == true){
  document.getElementById("m").innerHTML  = minutes + " Min(s)";
} 

else {
 document.getElementById("m").innerHTML  = "";
}
 
var checkBoxS = document.getElementById("checkSec");
 
if (checkBoxS.checked == true){
   document.getElementById("s").innerHTML  = seconds + " Second(s)";
} 

else {
 document.getElementById("s").innerHTML  = "";
}
  }
    
else{
      document.getElementById("demo").innerHTML = "To be left: </br></br>";
      var checkBoxY = document.getElementById("checkYear");
  
  if (checkBoxY.checked == true){
    document.getElementById("y").innerHTML  = years+ " Year(s)";
  } 
  else {
  document.getElementById("y").innerHTML  = "";
  }
  
  var checkBoxD = document.getElementById("checkDay");
  
   if (checkBoxD.checked == true){
    document.getElementById("d").innerHTML  = days + " Day(s)";
  } 
  else {
  document.getElementById("d").innerHTML  = "";
  }
  
    var checkBoxH = document.getElementById("checkHour");
  
   if (checkBoxH.checked == true){
    document.getElementById("h").innerHTML  = hours+ " Hour(s)";
  } 
  else {
  document.getElementById("h").innerHTML  = "";
  }
  
    var cbM = document.getElementById("checkMin");
  
   if (cbM.checked == true){
    document.getElementById("m").innerHTML  = minutes + " Min(s)";
  } 
  else {
  document.getElementById("m").innerHTML  = "";
  }
  
  var checkBoxS = document.getElementById("checkSec");
  
   if (checkBoxS.checked == true){
    document.getElementById("s").innerHTML  = seconds + " Second(s)";
  } 
  else {
  document.getElementById("s").innerHTML  = "";
  }
    }   
}
</script>

<?php 
echo '<br><button id="btn1" onclick="gns()"=">Generate shortcode</button>';
echo '<p id="sc"></p>';
?>

<script>
function gns(){ 
 document.getElementById("sc").innerHTML = "[cd date = '" + dateEntered + "']";
}

</script>
<?php
}

add_shortcode('cd','countdowndate_shortcode');

function countdowndate_shortcode($atts){
  $CheckOptionValue = get_option('CountDownDateChoice');
  $coy = $CheckOptionValue['Year'];
  $cod = $CheckOptionValue['Day'];
	$coh = $CheckOptionValue['Hour'];
	$com = $CheckOptionValue['Minute'];
	$cos = $CheckOptionValue['Second'];

  $args = shortcode_atts(array(
    'date' => '#',
 ), $atts);

 $output = '
 <h1 id="d1" style="font-size:32px;font-weight:bold;color:black;text-align:center;"></h1>
 <br><h1 id="year" style="display:none;font-size:32px;font-weight:bold;color:black;text-align:center;"></h3>
 <br><h1 id="day" style="display:none;font-size:32px;font-weight:bold;color:black;text-align:center;"></h3>
 <br><p id="hour" style="display:none;font-size:28px;font-weight:bold;color:black;text-align:center;"></p>
 <br><p id="minute" style="display:none;font-size:28px;font-weight:bold;color:black;text-align:center;"></p>
 <br><p id="sec" style="display:none;font-size:28px;font-weight:bold;color:black;text-align:center;"></p>
 <script>
 x = setInterval(refresh, 1000); 
 function refresh(){
  var now = new Date().getTime();
  var ddd = "'.$args['date'].'";
  date = new Date(ddd).getTime(); 
  var distance = date - now;

var days = Math.floor(Math.abs(distance / (1000 * 60 * 60 * 24)));
var years = Math.floor(days / 365);
var hours = Math.floor(Math.abs((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
var minutes = Math.floor(Math.abs((distance % (1000 * 60 * 60)) / (1000 * 60)));
var seconds =Math.floor(Math.abs((distance % (1000 * 60)) / 1000));

document.getElementById("d1").innerHTML = "To be left: ";
document.getElementById("year").innerHTML = years + "&nbsp;" + "Years";
document.getElementById("day").innerHTML =   days + "&nbsp;" + "Days";
document.getElementById("hour").innerHTML = hours + "&nbsp;" + "Hours&nbsp;";
document.getElementById("minute").innerHTML = minutes + "&nbsp;" + "Minutes&nbsp;";
document.getElementById("sec").innerHTML = seconds + "&nbsp;" + "Seconds";

if (distance < 0) {
      clearInterval(x);
      document.getElementById("d1").innerHTML = "Ago: ";
      document.getElementById("year").innerHTML = years + "&nbsp;" + "Years";
      document.getElementById("day").innerHTML = days + "&nbsp;" + "Days";
      document.getElementById("hour").innerHTML = hours + "&nbsp;" + "Hours&nbsp;";
      document.getElementById("minute").innerHTML =  minutes + "&nbsp;" +"Minutes&nbsp;";
      document.getElementById("sec").innerHTML = seconds + "&nbsp;" + "Seconds";
  }
}

var valueyear = "'.$CheckOptionValue["Year"].'";
var valueday= "'.$CheckOptionValue["Day"].'";
var valuehour = "'.$CheckOptionValue["Hour"].'";
var valueminute = "'.$CheckOptionValue["Minute"].'";
var valuesecond = "'.$CheckOptionValue["Second"].'";

if(valueyear=="Y"){
  document.getElementById("year").style.display = "block";
}

if(valueday=="Y"){
  document.getElementById("day").style.display = "block";
}

if(valuehour=="Y"){
  document.getElementById("hour").style.display = "block";
}

if(valueminute=="Y"){
  document.getElementById("minute").style.display = "block";
}

if(valuesecond=="Y"){
  document.getElementById("sec").style.display = "block";
}
 </script>';
return $output;
}

add_shortcode('checkvalue','checkvalue_shortcode');
function checkvalue_shortcode(){
  $CheckOptionValue = get_option('CountDownDateChoice');
  echo $CheckOptionValue['Year'];
  echo $CheckOptionValue['Day'];
	echo $CheckOptionValue['Hour'];
	echo $CheckOptionValue['Minute'];
	echo $CheckOptionValue['Second'];
}

function createTimeDB(){
  global $wpdb;
  $table_name = $wpdb->prefix.'CountDownSetting';
  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE $table_name(
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    txtdate text NOT NULL,
    PRIMARY KEY  (id)
  )$charset_collate;";
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );
  dbDelta($sql_sms_table);
}

function insertSetting(){
  global $wpdb;
  $table_name = $wpdb->prefix.'CountDownSetting';
  $wpdb->query("INSERT INTO $table_name(`txtdate`) VALUES ('$datesetting')"); 
}

$dateSet = getDateSetting();

if(isset($_POST['btnSave'])) {
  if(isset($_POST['cy'])){
    $dataYear = 'Y';
  }
  else {
    $dataYear = 'N';
  }
    
  if(isset($_POST['cd'])){
    $dataDay = 'Y';
  }
  else{
    $dataDay = 'N';
  }
  
  if(isset($_POST['ch'])){
    $dataHour = 'Y';
  }
  else{
    $dataHour = 'N';
  }
  
  if(isset($_POST['cm'])){
    $dataMinute = 'Y';
  }
  else{
    $dataMinute = 'N';
  }
  
  if(isset($_POST['cs'])){
    $dataSec = 'Y';
  }
  else{
    $dataSec = 'N';
  }

  insertData_db($dataYear,$dataDay,$dataHour,$dataMinute,$dataSec);
  
  register_activation_hook( __FILE__, 'insertData_db' );

  udoption($dataYear,$dataDay,$dataHour,$dataMinute,$dataSec);
 
  echo $dateSet;
  echo '<div style="position:absolute;bottom:0;;left:50%;"><h1>View in your page</h1>'.do_shortcode('[cd '."$dateSet".']').'</div>';
}

function getDateSetting(){
$js = '<script>
var dateEntered = document.getElementById("txtDate").value;
countDownDate = new Date(dateEntered).getTime();
return countDownDate;
</script>';

return $js;
}

function insertData_db($dataYear,$dataDay,$dataHour,$dataMinute,$dataSec){
        global $wpdb;    
          $dy = $dataYear;
          $dd = $dataDay;
          $dh = $dataHour;
          $dm = $dataMinute;
          $ds = $dataSec;     
          $table_name = $wpdb->prefix.'CountDownTimeTable';  
          $wpdb->query("INSERT INTO $table_name(`txtyear`, `txtday`, `txthour`, `txtminute`, `txtsec`) VALUES ('$dy','$dd','$dh','$dm','$ds')");       
}

function udoption ($dataYear,$dataDay,$dataHour,$dataMinute,$dataSec){
  $dataUpdate = array(
    'Year' => $dataYear,
    'Day' => $dataDay,
    'Hour' => $dataHour,
    'Minute' => $dataMinute,
    'Second' =>$dataSec
  );
  update_option('CountDownDateChoice',$dataUpdate);  
}

function myoption($dataYear,$dataDay,$dataHour,$dataMinute,$dataSec){
  $data_date = array(
    'Year' => $dataYear,
    'Day' => $dataDay,
    'Hour' => $dataHour,
    'Minute' => $dataMinute,
    'Second' =>$dataSec
  );
  add_option('CountDownDateChoice',$data_date);
  $option = get_option('CountDownDateChoice');

  echo esc_html($options_r['Year']);
}
register_activation_hook(__FILE__,'createTimeDB');
?>