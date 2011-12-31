<?php
require_once("includes/load.php");
include("theme/header.php");
?>

<div id="content">
<table id="overview">
	<tr>
		<th id="service"></th>
		<th id="date">Current</th>
		<?php $past_dates = get_past_dates(date("d/m"), 6); ?>
		<th id="date"><?php echo $past_dates['0']; ?></th>
		<th id="date"><?php echo $past_dates['1']; ?></th>
		<th id="date"><?php echo $past_dates['2']; ?></th>
		<th id="date"><?php echo $past_dates['3']; ?></th>
		<th id="date"><?php echo $past_dates['4']; ?></th>
		<th id="date"><?php echo $past_dates['5']; ?></th>
		<th id="full-history"></th>
	</tr>
	<?php 
		$get_servers_result = get_servers();
		while($server = mysql_fetch_array($get_servers_result)) {
			$current_status = get_current_status($server["id"]);
			if($current_status['id'] == 0) {
				//if current status is normal
				$curr_output = '<img src="'. $current_status['icon'] . '" title="'. $current_status['name'] . '" />';
			} else {
				// if current status is not normal
				$curr_output = '<a href=details.php?id="' . $current_status['id'] . '"><img src="'. $current_status['icon'] . '" title="'. $current_status['name'] . '" /></a>';
				
			}
			echo '
				<tr>
					<th>' . $server['name'] . '</th>
					<td>' . $curr_output . '</td>';
			// get past statuses from the last 6 days
			foreach ($past_dates as $date) {
				$prev_status = get_prev_status_overview($server["id"], $date);
				if($prev_status['id'] == 0) {
					//if status is normal
					$prev_output = '<img src="'. $prev_status['icon'] . '" title="'. $prev_status['name'] . '" />';
				} else {
					// if status is not normal
					$prev_output = '<a href=details.php?id="' . $prev_status['id'] . '"><img src="'. $prev_status['icon'] . '" title="'. $prev_status['name'] . '" /></a>';
					
				}
				echo '<td>' . $prev_output . '</td>';
				
			}
				echo '<td><a href="history.php?id='. $server['id'] . '">Full History</a></td>
				</tr>';
		}
	 ?>
</table>
</div>

<?php
include("theme/footer.php");
require_once("includes/unload.php");
?>