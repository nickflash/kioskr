<? include("functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="http://cdn.jtsage.com/datebox/latest/jqm-datebox.min.css">
<script type="text/javascript" src="http://cdn.jtsage.com/datebox/latest/jqm-datebox.core.min.js"></script>
<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.calbox.min.js"></script>
<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.datebox.min.js"></script>
<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.flipbox.min.js"></script>
<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.slidebox.min.js"></script>
<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.customflip.min.js"></script>
 <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!-- (Start) Add the features of jQuery UI sortable -->
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
  <script>
  $(document).bind('pageinit', function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
    <!-- Refresh list to the end of sort to have a correct display -->
    $( "#sortable" ).bind( "sortstop", function(event, ui) {
      $('#sortable').listview('refresh');
    });
  });
  </script>
  <!-- (End) Add the features of jQuery UI sortable -->

</head>

<body>

<!-- ADD SCREEN -->
<? if(!isset($_GET["pg"])) { ?>
<div data-role="page" id="addscreen">
  <div data-role="header">
    <h1> <i class="fa fa-television" aria-hidden="true"></i> Screens</h1>
  </div>

  <div data-role="main" class="ui-content">

   	<div data-role="controlgroup" data-type="horizontal" data-mini="true">
	<a href="admin.php"  data-transition="slidedown" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-back ui-btn-w" data-ajax="false">Go back</a>
			<a href="?id=<? echo $_GET["id"]; ?>&pg=addscreen"  data-transition="slidedown"  class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-plus ui-btn-b" data-ajax="false">Add screen</a>
			
	</div>
		<p />
		
		
		
		
		
	
  <div style="width: 100%; display:block;" >
  <? 		
  if (isset($_GET["id"])) {
	  
		$event_id = $_GET["id"];
  $result = connectDB()->query("SELECT * FROM screens WHERE event_id='$event_id' ORDER by seq_num DESC");
				while($row = $result->fetch_assoc()) {  

				?>
  
  
  <div style="width:200px; height:350px; display: inline-block;" >
  <div style="width:200px; height:290px; border: 1px solid; justify-content: center;
  flex-direction: column; display: flex;" ><center> <? echo $row["type"] ?></center> </div>
  <span style="color:#FFFFFF; background:#000000;"><? echo $row["title"] ?></span> <br/>
  <span style="color:#FFFFFF; background:#000000;"><? echo $row["from_date"] ?> - <? echo $row["to_date"] ?> / <? echo $row["time_interval"] ?></span>
  </div>
  

  
  <? }
  
  if ($result->num_rows == 0) {
	  echo "<center><h1>No screens for this event yet</h1></center>";
  }


  }?>
		
		</div>
		
		
  </div>

  <div data-role="footer">
    <h1><? echo $GLOBALS['footer_text']; ?></h1>
  </div>
</div> 

<? } ?>

<? 
if(isset($_GET["pg"])) {
	$pg = $_GET["pg"];
	if ($pg == "addscreen") {
		
		
		?>

		
		<div data-role="page" id="addscreenform">
  <div data-role="header">
    <h1> <i class="fa fa-television" aria-hidden="true"></i> Add Screen</h1>
  </div>

  <div data-role="main" class="ui-content">

   	<div data-role="controlgroup" data-type="horizontal" data-mini="true">
			<a href="addscreen.php?id=<? echo $_GET["id"]; ?>"  data-transition="slidedown" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-back ui-btn-w">Go back</a>
	</div>
		<p />
		<center>
		<div style="width: 100%;  margin-right: 10px;" >
		 <div style="width:400px; float: left; margin-right: 20%;" >

		<form>

    <label for="screen_type">Select screen type:</label>
    <select name="screen_type" id="screen_type">
 		<option value="shedule" selected="selected">Type</option>
        <option value="shedule" >Shedule</option>
        <option value="image">Image</option>
        <option value="video" >Video</option>
        <option value="custom">Custom</option>
    </select>


	    <label for="select-native-17">Select screen language:</label>
    <select name="select-native-17" id="select-native-17">
        <option value="en" selected="selected">English</option>
        <option value="es">Spanish</option>
        <option value="bg" >Bulgarian</option>
        <option value="ru">Russian</option>
    </select>

<!-- form for shedule screen -->

		<div id="form_types"></div>
		</form>
	</div>
	<div style="width:600px; float: left; border:1px solid; margin-right: 5px;" >
	<p />
	<div style="width:90%; height:250px; background:#000000;">
			<div id="shedule_title_prev" style="color:#FFFFFF; position:relative; top:30px; left:280;">TITLE</div>
	</div>
	Screen preview
	<p />
	
	<div>
			<div>
       
        <a href="javascript:void(0);" class="add_button ui-btn" title="Add field">Add timer item</a>
    </div>
	

	
	
	<p />
	<table  data-role="table" class="ui-responsive">
		<thead style=" font-weight: bold;">
		<tr>
			<td><center>Item Title</center></td>
			
			<td>	 
				<center>From</center>
			</td>
			<td>	 
					<center>To</center>
			</td>
			
			<td></td>
		</tr>
		
		
		</thead>
				<tbody class="shed_wrapper">
		
		        </tbody>
	</table>
	
	
	</div>
	</div>
	</div>
	</center>	
	
		
  </div>

  <div data-role="footer">
    <h1><? echo $GLOBALS['footer_text']; ?></h1>
  </div>
</div> 

		<script>

						$('.screen_title').keypress(function() {
						
						$( "#shedule_title_prev" ).text( $( ".screen_title" ).val() );
				});
		
		$( "#screen_type" ).change(function() {
		       var choise = $( "#screen_type" ).val();
			   
			   if (choise == "shedule") {  
				 $( "#form_types" ).empty();
				 $("#form_types").load('add_shedule.html', function () {
					$(this).trigger('create');
				});
			   }
			   
			      if (choise == "image") {  
				 $( "#form_types" ).empty();
				 $("#form_types").load('add_image.html', function () {
					$(this).trigger('create');
				});
			   }
			   
			   
		});
		
		
		//FIELD ADDER
		
				$(document).ready(function(){
			var maxField = 10; //Input fields increment limitation
			var addButton = $('.add_button'); //Add button selector
			var wrapper = $('.shed_wrapper'); //Input field wrapper
			/*var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext" title="Remove field">Delete</a></div>'; //New input field html 
			*/
			var fieldHTML = '<tr id="fild"><td style="width:300px;"><input type="text" name="field_name[]" value=""/></td><td><input type="time" name="timePicker1" id="fromTime[]" value="10:00"></td><td><input type="time" name="toTime[]" id="timePicker1" value="11:00"></td><td><a href="javascript:void(0);" class="remove_button ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext" title="Remove field">Delete</a></td></tr>';
			
			var x = 1; //Initial field counter is 1
			$(addButton).click(function(){ //Once add button is clicked
				if(x < maxField){ //Check maximum number of input fields
					x++; //Increment field counter
					$(wrapper).append(fieldHTML).trigger('create'); // Add field html
					
				}
			});
			$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
				e.preventDefault();
				$(this).parent().parent().remove();//Remove field html
				x--; //Decrement field counter
			});
		});
		
		
		var hours = ["10","12","15"]; //10:30, 12:20 , 15:40
		var mins = ["30","20","40"];
		
		

		
		var diff = Math.abs(new Date('2011/10/09 00:00') - new Date('2011/10/09 01:00')); //in miliseconds
		var minutes = Math.floor((diff/1000)/60); //in minutes
		
		
		
		 console.log("minutes:" + minutes)
		
		
		</script>
		
		<?
		
	
		
	}
	
	
	
}

?>

</body>
</html>