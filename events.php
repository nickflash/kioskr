<div data-role="page" id="events_page">
  <div data-role="header">
    <h1>Events</h1>
  </div>

  <div data-role="main" class="ui-content">
			<div data-role="controlgroup" data-type="horizontal" data-mini="true">
			<a  href="#add_event"  data-transition="slidedown"  data-ajax="false" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-plus ui-btn-b">Add new event</a>
			<a href="#systemsettings_page"  data-transition="slidedown" class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-gear ui-btn-b">Systen Settings</a>
		
		</div>
	<center>	
	<table data-role="table" data-mode="columntoggle" class="ui-responsive" id="events_table">
      <thead>
        <tr>
          <th data-priority="1">Event Title</th>
          <th data-priority="3">Start Date</th>
          <th data-priority="4">End Date</th>
          <th data-priority="5">Screens</th>
          <th data-priority="6">Language</th>
          <th data-priority="1">Actions</th>
        </tr>
      </thead>
      <tbody>
	  <? 		$result = connectDB()->query("SELECT * FROM events ORDER by start_date DESC");
				while($row = $result->fetch_assoc()) {   ?>
	  
        <tr>
          <td><? echo $row["title"]; ?></td>
          <td><? echo $row["start_date"]; ?></td>
          <td><? echo $row["end_date"]; ?></td>
          <td><? echo getScreensNum($row["ID"]);?> </td>
          <td><? echo $row["languages"]; ?></td>
          <td>
		  
		 <a alt="Delete Event" href="?submit=true&type=delevent&id=<? echo $row["ID"]; ?>" class="ui-btn ui-btn-inline" ><i class="fa fa-trash" aria-hidden="true"></i> </a> 
		 <a alt="Edit Event" href="#" class="ui-btn ui-btn-inline" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a> 
		 <a alt="Add Screens" href="addscreen.php?id=<? echo $row["ID"]; ?>" class="ui-btn ui-btn-inline" ><i class="fa fa-television" aria-hidden="true"></i></a> 
		 
		 </td>
        </tr>
		
		<? } ?>
		
      </tbody>
    </table>
	</center>
	

  </div>

  <div data-role="footer">
    <h1><? echo $GLOBALS['footer_text']; ?></h1>
  </div>
</div> 