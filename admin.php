<?php
$xmlFilePath = 'team_details.xml';

// for display team names based on adding team in "Add Team"
if (file_exists($xmlFilePath)) {
	$xml = simplexml_load_file($xmlFilePath);
	$teamNames = [];
	foreach ($xml->teamDetail as $teamDetail) {
		$teamNames[] = (string) $teamDetail->teamname;
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title>Admin Portal</title>
	<style>
		#errormgs_leader,
		#errormgs_empleader,
		#errormgs_name,
		#errormgs_empname,
		#errormgs_date,
		#errormgs_time,
		#errormgs_teamname,
		#errormgs_starttime,
		#errormgs_endtime {
			color: red;
			font-size: 15px;
			display: none;
		}

		#flash-message {
			color: green;
			margin-left: 49%;
			font-size: 20px;
			margin-top: 35px;
			font-weight: 800;
		}

		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}

		.sidebar {
			position: fixed;
			left: 0;
			top: 0;
			height: 100%;
			width: 288px;
			background-color: #333;
			padding-top: 50px;
			font-size: 18px;
			line-height: 50px;
		}

		.sidebar a {
			display: block;
			padding: 10px 20px;
			color: #fff;
			text-decoration: none;
			border-bottom: 1px solid #555;
		}

		.content {
			font-size: 15px;
			font-family: system-ui;
			margin-left: 400px;
			width: 60%;
			text-align: justify;
			margin-top: 65px;
		}

		.form-control {
			height: 31px;
			font-size: 13px;
			width: 295px;
		}

		.addteammenu {
			margin-left: 300px;
			padding: 20px;
			height: 100%;
		}

		.teamdetails,
		.employeedetails {
			color: #000;
			font-family: cursive;
			text-align: center;
			margin-top: 40px;
			font-weight: 800;
			letter-spacing: 2px;
			font-size: 40px;
		}

		.clear {
			height: 30px;
		}

		#addteambtn,
		#addemployeebtn {
			text-align: center;
			font-size: 17px;
			margin-left: 0px;
			border-radius: 5px;
			border: none;
			height: 36px;
			color: #fff;
			background-color: #333;
			margin-top: 5px;
		}

		#go,
		#clear {
			text-align: center;
			font-size: 17px;
			margin-left: 0px;
			height: 25px;
			border-radius: 5px;
			border: none;
			color: #fff;
			background-color: #333;
			margin-top: 5px;
		}


		#searchForm {
			display: flex;
			width: 50%;
			font-size: 16px;
			justify-content: space-between;
		}

		#employeedetailsform {
			left: 10%;
			width: 100%;
			top: 10px;
			position: absolute;
		}

		#teamdetailsform {
			position: absolute;
			top: 70px;
			width: 60%;
		}

		#scheduleTable {
			text-align: center;
			width: 100%;
		}

		#scheduleTable th {
			font-size: 16px;
			text-align: center;
			border: 1px solid #000;
			padding: 15px;
		}

		#scheduleTable td {
			font-size: 16px;
			text-align: center;
			border: 1px solid #000;
			padding: 15px;
		}

		#scheduleTable tr {
			font-size: 16px;
			text-align: center;
			border: 1px solid #000;
			padding: 15px;
		}
	</style>
</head>

<body>
	<div class="sidebar">
		<a href="#" onclick="showContent('addteam')">Add Team</a>
		<a href="#" onclick="showContent('addemployee')">Add Employee Details</a>
		<a href="#" onclick="showContent('viewtable')">View Timetable</a>
	</div>

	<!-- Default contents loaded -->
	<div class="content"><span style="font-size:30px;"><b>Pre Weekly Schedule</b></span>
		<div style="margin-top:20px" ;>Welcome to the Pre Weekly Schedule section! Here, you can plan and organize your
			tasks, appointments, and goals for the upcoming week. Take advantage of this space to stay productive and on
			track with your commitments.
			<br><br>
			<b>
				What You Can Do:</b>
			<br><br>
			<b>Set Goals:</b> Define your objectives for the week. What do you want to achieve? Setting clear goals will
			help you stay focused and motivated.
			<br><br>
			<b>Plan Your Schedule:</b> Use a calendar or planner to schedule your tasks and appointments for each day of
			the week. Allocate time for important activities and prioritize your workload.
			<br><br>
			<b>Review Your Progress:</b> Reflect on the previous week's accomplishments and challenges. Identify areas
			for improvement and make adjustments to your plans accordingly.
			<br><br>
			<b>Stay Organized: </b>Keep track of important deadlines, meetings, and events. Use tools such as to-do
			lists, reminders, and notes to stay organized and efficient.
			<br><br>
			<b>Balance Work and Life:</b> Remember to include time for relaxation, hobbies, and self-care in your
			schedule. Maintaining a healthy work-life balance is essential for overall well-being.
			<br>
			<br>
		</div>
	</div>
	<!-- Default contents ended  -->

	<!-- Team form started  -->
	<div id="addteam" class="content" style="display: none;">
        <div class="teamdetails">Team Details</div>
            <form id="teamdetailsform">
                <table style="width: 80%;display: inline-table;font-size: 20px;margin-left: 25%;margin-top: 45px;">
                    <tr>
                        <td><b><label for="teamleader">Team Leader</label></b></td>
                        <td><input type="text" class="form-control" id="teamleader" placeholder="Enter Team Leader"
                        name="teamleader"></td>
                    </tr>
                    <tr>
                        <td><label id="errormgs_leader" for="error">* Please Enter Team Leader</label></td>
                    </tr><br>
                    <tr>
                        <td><div class="clear"></div></td>
                    </tr>
                    <tr>
                        <td><b><label for="teamname">Team Name</label></b></td>
                        <td><input type="text" class="form-control" id="teamname" placeholder="Enter Team Name" name="teamname"></td>
                    </tr><br>
                    <tr>
                        <td><label id="errormgs_name" for="error">* Please Enter Team Leader</label></td>
                    </tr><br>
                    <tr>
                        <td><div class="clear"></div></td>
                    </tr>
                    <tr>
                        <td><input type="button" id="addteambtn" value="Add Team" class="btn btn-primary"></td>
                    </tr>
                </table>
            </form>
	</div>
    <!-- team contents ended -->

    <!-- Employee form started  -->
	<div id="addemployee" class="content" style="display: none;">
		<div class="employeedetails">Employee Details</div>
		    <form id="employeedetailsform">
			    <table style="width: 80%;display: inline-table;font-size: 20px;margin-left: 25%;margin-top: 45px;">
				    <tr>
                        <td><b><label for="employeename">Employee Name</label></b></td>
                        <td><input type="text" class="form-control" id="employeename" placeholder="Enter Employee Name" name="employeename"></td>
				    </tr>
				    <tr>
					    <td><label id="errormgs_empname" for="error">* Please Enter Employee Name</label></td>
				    </tr><br>
				    <tr><td><div class="clear"></div></td></tr>
	                <tr>
                        <td><b><label for="teamempleader">Team Leader</label></b></td>
                        <td><input type="text" class="form-control" id="teamempleader" placeholder="Enter Team Leader" name="teamempleader"></td>
	                </tr><br>
	                <tr>
                        <td><label id="errormgs_empleader" for="error">* Please Enter Team Leader</label></td>
	                </tr><br>
	                <tr>
		                <td><div class="clear"></div></td>
	                </tr>
	                <tr>
		                <td><b><label for="teamNameDropdown">Team Name</label></b></td>
		                <td> 
                            <select class="form-control" id="teamNameDropdown" name="teamNameDropdown">
                                <option value="">Select Team Name</option>
                                    <?php foreach ($teamNames as $teamName): ?>
                                        <option value="<?php echo $teamName; ?>">
                                            <?php echo $teamName; ?>
                                        </option>
                                    <?php endforeach; ?>
                            </select>
                        </td>
	                </tr><br>
	                <tr>
                        <td><label id="errormgs_teamname" for="error">* Please Choose Team Name</label></td>
	                </tr>
	                <tr>
		                <td><div class="clear"></div></td>
	                </tr>
	                <tr>
                        <td><b><label for="exampleFormControlInput1">Schedule Date</label></b></td>
                        <td> <input type="date" name="fromstart" class="form-control" id="fromstart"></td>
	                </tr><br>
                    <tr>
                        <td><label id="errormgs_date" for="error">* Please Choose Schdeule Date </label></td>
                    </tr>
	                <tr>
		                <td><div class="clear"></div></td>
	                </tr>
	                <tr>
                        <td><b><label for="exampleFormControlInput1">Start Time</label></b></td>
                        <td> <input type="time" name="starttime" class="form-control" id="starttime"></td>
	                </tr><br>
                    <tr>
                        <td><label id="errormgs_starttime" for="error">* Please Choose Start time </label></td>
                    </tr>
	                <tr>
		                <td><div class="clear"></div></td>
	                </tr>
	                <tr>
                        <td><b><label for="exampleFormControlInput1">End Time</label></b></td>
                        <td> <input type="time" name="endtime" class="form-control" id="endtime"></td>
	                </tr><br>
                    <tr>
                        <td><label id="errormgs_endtime" for="error">* Please Choose End time </label></td>
                    </tr>
	                <tr>
                        <td><div class="clear"></div></td>
	                </tr>
	                <tr>
		                <td><input type="button" id="addemployeebtn" value="Add Employee" class="btn btn-primary"></td>
	                </tr>
	            </table>
	        </form>
	</div>
    <!-- Employee form ended -->

    <!-- Display Schedule dates starts -->
    <div id="viewtable" class="content" style="display: none;">
		<div style="font-size: 36px;font-family: cursive;font-weight: 700;">Schedule Timetable For Employees</div>
		<div class="clear"></div>

		<form id="searchForm">
			<b><label for="searchDate">Schedule Date</label></b>
			<input type="date" id="searchDate" name="searchDate">
			<button type="submit" id="go">Go</button> <button type="submit" id="clear">Clear</button>
		</form>

		<div class="clear"></div>

		<table id="scheduleTable" style="text-align: left;" cellspacing="0">
			<thead>
				<tr>
					<th>S.No</th>
					<th>Schedule Date</th>
					<th>Start Time</th>
					<th>End Time</th>
					<th>Employee Name</th>
					<th>Team Leader</th>
					<th>Team Name</th>
				</tr>
			</thead>
			<tbody id="scheduleBody">
			</tbody>
		</table>
	</div>
    <!-- Display Schedule dates ends -->


	<!-- JavaScript code to show/hide content -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script>
		$(document).ready(function () {
			$("#addteambtn").click(function (e) {
				e.preventDefault(); // Prevent default form submission behavior

				var form = $('#teamdetailsform');
				var formData = form.serialize();
				var teamleader = $('#teamleader').val();
				var teamname = $('#teamname').val();

				// Reset error messages
				$('#errormgs_leader').css("display", "none");
				$('#errormgs_name').css("display", "none");

				if (teamleader == '') {
					$('#errormgs_leader').css("display", "block");
					return false;
				} else if (teamname == '') {
					$('#errormgs_name').css("display", "block");
					return false;
				} else {
					$.ajax({
						url: 'team_details.php',
						type: 'POST',
						data: formData,
						dataType: 'json', 
						success: function (response) {
							if (response.success) {
								console.log(response.message);
								showContent('addteam');
						        form.trigger('reset');
								if (response.message) {
									alert(response.message);
									location.reload(); //refresh page
								}
							} else {
								console.error(response.message);
								alert(response.message);
							}
						},
						error: function (xhr, status, error) {
							console.error(xhr.responseText);
							alert("An error occurred while processing your request.");
						}
					});
				}
			});

            //  Script for Employee form 
			$("#addemployeebtn").click(function (e) {
				e.preventDefault(); 

				var form = $('#employeedetailsform');
				var formData = form.serialize();
				var employeename = $('#employeename').val();
				var teamempleader = $('#teamempleader').val();
				var teamNameDropdown = $('#teamNameDropdown').val();
				var fromstart = $('#fromstart').val();
				var starttime = $('#starttime').val();
				var endtime = $('#endtime').val();

				// Reset error messages
				$('#errormgs_empleader').css("display", "none");
				$('#errormgs_starttime').css("display", "none");
				$('#errormgs_endtime').css("display", "none");
				$('#errormgs_empname').css("display", "none");
				$('#errormgs_date').css("display", "none");
				$('#errormgs_teamname').css("display", "none");

				if (employeename == '') {
					$('#errormgs_empname').css("display", "block");
					return false;
				} else if (teamempleader == '') {
					$('#errormgs_empleader').css("display", "block");
					return false;
				} else if (teamNameDropdown === '') {
					$('#errormgs_teamname').css("display", "block");
					return false;
				} else if (fromstart == '') {
					$('#errormgs_date').css("display", "block");
					return false;
				} else if (starttime == '') {
					$('#errormgs_starttime').css("display", "block");
					return false;
				} else if (endtime == '') {
					$('#errormgs_endtime').css("display", "block");
					return false;
				} else {
					$.ajax({
						url: 'employee_form.php', 
						type: 'POST',
						data: formData,
						dataType: 'json', 
						success: function (response) {
							if (response.success) {
								showContent('addemployee');
								form.trigger('reset');
								if (response.message) {
									alert(response.message);
									location.reload();
								}
							} else {
								console.error(response.message);
								alert(response.message);
							}
						},
						error: function (xhr, status, error) {
							console.error(xhr.responseText);
							alert("An error occurred while processing your request.");
						}
					});
				}
			});
		});

		function showContent(contentId) {
			var contents = document.getElementsByClassName('content');
			for (var i = 0; i < contents.length; i++) {
				contents[i].style.display = 'none';
			}
			document.getElementById(contentId).style.display = 'block';
		}
	</script>

	<script>
		// Load all data by default
		window.addEventListener('DOMContentLoaded', function () {
			loadAllData();
		});

		function loadAllData() {
			var xhr = new XMLHttpRequest();
			xhr.open('GET', 'employee_details.xml', true);
			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4) {
					if (xhr.status === 200) {
						var xmlDoc = xhr.responseXML;
						if (xmlDoc) {
							displaySchedule(xmlDoc);
						} else {
							displayNoRecordsMessage();
						}
					} else {
						displayNoRecordsMessage();
					}
				}
			};
			xhr.send();
		}

		// Function to display no records found message
		function displayNoRecordsMessage() {
			var scheduleBody = document.getElementById('scheduleBody');
			scheduleBody.innerHTML = ''; 

			var noRecordsRow = scheduleBody.insertRow();
			var noRecordsCell = noRecordsRow.insertCell(0);
			noRecordsCell.colSpan = 7;
			noRecordsCell.textContent = 'No records available';
			noRecordsCell.style.color = 'red';
			noRecordsCell.style.fontWeight = '700';
			noRecordsCell.style.textAlign = 'center';
			noRecordsCell.style.paddingTop = '55px';
			noRecordsCell.style.fontSize = '20px';
		}

		document.getElementById('searchForm').addEventListener('submit', function (event) {
			event.preventDefault(); 
			var searchDate = document.getElementById('searchDate').value;
			loadScheduleByDate(searchDate);
		});

		// Event listener for Clear button
		document.getElementById('clear').addEventListener('click', function (event) {
			event.preventDefault();
			document.getElementById('searchDate').value = '';
			loadAllData(); 
		});

		// Function to load schedule by date
		function loadScheduleByDate(searchDate) {
			var xhr = new XMLHttpRequest();
			xhr.open('GET', 'employee_details.xml', true);
			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4 && xhr.status === 200) {
					var xmlDoc = xhr.responseXML;
					displaySchedule(xmlDoc, searchDate);
				}
			};
			xhr.send();
		}

		// Function to display schedule
		function displaySchedule(xmlDoc, searchDate) {
			var scheduleBody = document.getElementById('scheduleBody');
			scheduleBody.innerHTML = '';

			if (!xmlDoc || xmlDoc.getElementsByTagName('employeedetail').length === 0) {
				var noRecordsRow = scheduleBody.insertRow();
				var noRecordsCell = noRecordsRow.insertCell(0);
				noRecordsCell.colSpan = 7;
				noRecordsCell.textContent = 'No records available';
				noRecordsCell.style.color = 'red';
				noRecordsCell.style.fontWeight = '700';
				noRecordsCell.style.textAlign = 'center';
				noRecordsCell.style.paddingTop = '55px';
				noRecordsCell.style.fontSize = '20px';
				return;
			}

			var schedules = xmlDoc.getElementsByTagName('employeedetail');
			var recordsFound = false;

			for (var i = 0; i < schedules.length; i++) {
				var schedule = schedules[i];

				var dateNode = schedule.getElementsByTagName('fromstart')[0];
				if (dateNode) {
					var date = dateNode.textContent;

					// Check if the schedule matches the search criteria
					if (!searchDate || date === searchDate) {
						var sno = i + 1;
						recordsFound = true;

						var starttimeNode = schedule.getElementsByTagName('starttime')[0];
						var endtimeNode = schedule.getElementsByTagName('endtime')[0];
						var employeeNameNode = schedule.getElementsByTagName('employeename')[0];
						var teamLeaderNode = schedule.getElementsByTagName('teamempleader')[0];
						var teamNameNode = schedule.getElementsByTagName('teamNameDropdown')[0];

						var starttime = starttimeNode ? starttimeNode.textContent : '';
						var endtime = endtimeNode ? endtimeNode.textContent : '';
						var employeeName = employeeNameNode ? employeeNameNode.textContent : '';
						var teamLeader = teamLeaderNode ? teamLeaderNode.textContent : '';
						var teamName = teamNameNode ? teamNameNode.textContent : '';

						var row = scheduleBody.insertRow();
						var cells = [sno, date, starttime, endtime, employeeName, teamLeader, teamName];
						cells.forEach(function (cellData) {
							var cell = row.insertCell();
							cell.textContent = cellData;
						});
					}
				}
			}

			if (!recordsFound) {
				var noRecordsRow = scheduleBody.insertRow();
				var noRecordsCell = noRecordsRow.insertCell(0);
				noRecordsCell.colSpan = 7;
				noRecordsCell.textContent = 'No schedule for the selected date';
				noRecordsCell.style.color = 'red';
				noRecordsCell.style.fontWeight = '700';
				noRecordsCell.style.textAlign = 'center';
				noRecordsCell.style.paddingTop = '55px';
				noRecordsCell.style.fontSize = '20px';
			}
		}
	</script>

</body>
</html>