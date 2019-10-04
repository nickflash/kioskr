<? include("functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
<? if (!isset($_GET["submit"])) {  ?>

<? include ("events.php"); ?>


<div data-role="page" id="add_event">

  <div data-role="header">
   
    <h1> <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp; Adding Event</h1>
	
  </div>

  <div data-role="main" class="ui-content">
  
		<center>  
		  
		<div data-role="fieldcontain" style="max-width:700px;">
		<form action="admin.php?submit=true&type=addevent" method="POST" data-ajax="false" enctype="multipart/form-data" id="addevent_form">
			<label for="event_title">Event title</label>
			<input type="text" name="event_title" id="event_title" value="" placeholder="e.g. Pro conf 2017"/> 
			<p>&nbsp;</p>
			<label for="start_date">Start Date</label>
			<input type="date" name="start_date" id="start_date" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
			<p>&nbsp;</p>
			<label for="end_date">End Date</label>
			<input type="date" name="end_date" id="end_date" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
			<p>&nbsp;</p>
			
			
			<label for="select-choice-9" class="select">Choose Languages:</label>
				<select name="select_lang[]" id="select-choice-9" multiple="multiple" data-native-menu="false">
				<option>Choose Language</option>
				<option value="en">English</option>
				<option value="bg">Bulgarian</option>
				<option value="es">Espaniol</option>
				<option value="ru">Russian</option>
				</select>
			<p>&nbsp;</p> 
			
					<label for="file">Logo Image:</label>
					<input type="file" name="logo_file" id="file" value="">
			<p>&nbsp;</p> 
			
			
			<a  href="#events_page" class="ui-btn ui-btn-inline ui-corner-all ui-btn-icon-left ui-icon-back">Go back</a>
			<button class="ui-btn ui-btn-inline ui-btn-b ui-corner-all   ui-btn-icon-right ui-icon-check"  type="submit" form="addevent_form">Save</button>
		
		</form>	
			
		</div>
		
		</center>

  </div>

  <div data-role="footer">
    <h1><? echo $GLOBALS['footer_text']; ?></h1>
  </div>
</div> 

<!-- SYSTEM SETTINGS -->

<div data-role="page" id="systemsettings_page">
  <div data-role="header">
    <h1>System Settings</h1>
  </div>

  <div data-role="main" class="ui-content">

    <p>Click on the link to go back. <b>Note</b>: fade is default.</p>
    <a href="#pageone">Go to Page One</a>
  </div>

  <div data-role="footer">
    <h1><? echo $GLOBALS['footer_text']; ?></h1>
  </div>
</div> 




<? } ?>
<? if (isset($_GET["submit"])) {  ?>

<div data-role="page" id="event_added">
  <div data-role="header">
    <h1>Add Event</h1>
  </div>

  <div data-role="main" class="ui-content">


<? 

if($_GET["type"]=="addevent") {

$event_title = $_POST["event_title"];	
$start_date = $_POST["start_date"];	
$end_date = $_POST["end_date"];	
$select_lang = $_POST["select_lang"];	

	   
if (isset($_FILES["logo_file"]["name"])) {

    $name = $_FILES["logo_file"]["name"];
    $tmp_name = $_FILES['logo_file']['tmp_name'];
    $error = $_FILES['logo_file']['error'];

    if (!empty($name)) {
        $location = 'upload/event_logos/';

        if  (move_uploaded_file($tmp_name, $location.$name)){
           // echo 'Uploaded';
			 $real_file_name = $name;
        }

    } else {
        //echo 'please choose a file';
		$real_file_name = "none";
    }
}
else {
	
	$real_file_name = "none";
}


//getting all selected languages
$langs="";
$i=0;
foreach ($select_lang as $lang)
{
	$i+=1;
	
	if ($i>1) {
	$langs.=",".$lang;
	}
	else {
		
		$langs.=$lang;
	}
}


$all_languages =  $langs;

//uploading file




	   
	   


//asf///////////

$query = connectDB()->query("INSERT INTO `events` (title,start_date,end_date,logo_img,languages) VALUES ('$event_title','$start_date','$end_date','$real_file_name','$all_languages')");
if (!$query) {
	
	die ("<center><h1>Error:".mysql_error()." </h1></center>");
}

else {
	
	echo "<center><h1>Event added successfully!</h1></center>";
	?>
	
	<script>
	 // go back to admin
	 window.setTimeout(function(){  window.location.href = "admin.php"; }, 2000);
	</script>
	<?
	
}

	
}

//delete event


if($_GET["type"]=="delevent") {
	
$delete_id_event = $_GET["id"];	
	
$query = connectDB()->query("DELETE FROM events WHERE ID='$delete_id_event'");
if (!$query) {
	
	die ("<center><h1>Error:".mysql_error()." </h1></center>");
}

else {
	
	echo "<center><h1>Event deleted successfully!</h1></center>";
	?>
	
	<script>
	 // go back to admin
	 window.setTimeout(function(){  window.location.href = "admin.php"; }, 1000);
	</script>
	<?
	
	}		
}




?>

 <div data-role="footer">
    <h1><? echo $GLOBALS['footer_text']; ?></h1>
  </div>
</div> 

<? } ?>

</body>
</html>
