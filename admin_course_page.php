<?php
	session_start();
?>
<html>
	<head>
	   <title>Admin Course Page</title>
  </head>

  <body style="background-color:crimson;">
      <p style="text-align:right;padding-top:75px;padding-right:50px;"><image src="logo.png" class="img-responsive" alt="centered image"
          height="100", width="300"></p>
			<input type="button" value="Back to Select A Course Page" onclick="history.go(-1);"
							style="margin-left: 80%;font-family:impact;font-size:90%;width:15%;color:black;"><P>

			<style>
					table {
					    font-family:impact;
							font-size:90%;;
					    border-collapse: collapse;
					    width: 100%;
					}

					td, th {
					    border: 1px solid black;
					    text-align: left;
					    padding: 8px;
					}

					tr:nth-child(even) {
					    background-color: #dddddd;
					}
				</style>

<?php
	$course_name  = $_POST['course_name'];
	$course_id  = $_POST['course_id'];

	$servername = "127.0.0.1";
	$databasename = "cpsc471Project";
	$username = "dylan";
	$password = "password";

	$conn = new mysqli($servername, $username, $password, $databasename);

	$sql = "Select title from course where id=".$course_id." AND course_name= '".$course_name."'";

	$query = $conn->query($sql);

	if($query)
	{
		?>
		<p style="text-align:left;margin-left:15%;padding-bottom:5px;font-family:impact;font-size:120%;color:black;">
		<?php
		echo $course_name."&nbsp;";
		echo $course_id."&nbsp;&nbsp;";
		while($row = $query->fetch_assoc())
		{
			echo $row['title'];
		}
	}

	$sql = "Select * from course_content where course_name = '".$course_name."' AND course_id =".$course_id;

	$query = $conn->query($sql);
	// We can make this into a table to look better later...  for now this works
	?>
	<table>
	  <tr>
	    <th>ID</th>
	    <th>Title</th>
			<th>Course ID</th>
			<th>Course Name</th>
	    <th>Report Status</th>
			<th>Approval Status</th>
	  </tr>
	  <tr>
	<?php

	if($query->num_rows > 0)
	{
		while($row = $query->fetch_assoc())
		{
			echo "id: ".$row['id'];
			echo ", title: ".$row['title'];
			echo ", format: ".$row['format'];
			echo ", report status: ".$row['report_status'];
			echo ", user email: ".$row['user_email'];
			echo ", approval status: ".$row['approval_status'];
			echo ", course id: ".$row['course_id'];
			echo ", course name: ".$row['course_name'];
		}
	}

?>
	<P></p>
	<div style="text-align:center;font-family:impact;font-size:120%;color:black;">
		<u>
		Approve Content Upload
		</u>
	</div>
	<form action=admin_approve_content.php method=POST
          style="text-align:center;font-family:impact;font-size:100%;color:black;">
  	   Content ID: <input type=TEXT name="content_id"
          style="display:inline-block;vertical-align:left;border: 1px solid black;padding: 3px 3px;width:15%;"><BR>
  	   Content Title: <input type=TEXT name="content_title"
          style="display:inline-block;vertical-align:left;border: 1px solid black;padding: 3px 3px;width:10%;"><P>
  	  <input type=SUBMIT value="Approve Content" style="font-family:impact;font-size:90%;width:12%;"><P>
	 </form>

	<div style="padding-top:20;text-align:center;font-family:impact;font-size:120%;color:black;">
		<u>
			Remove Content
		</u>
	</div>
	   <form action=admin_remove_content.php method=POST
          style="text-align:center;font-family:impact;font-size:100%;color:black;">
  	   Content ID: <input type=TEXT name="content_id"
          style="display:inline-block;vertical-align:left;border: 1px solid black;padding: 3px 3px;width:15%;"><BR>
  	   Content Title: <input type=TEXT name="content_title"
          style="display:inline-block;vertical-align:left;border: 1px solid black;padding: 3px 3px;width:10%;"><P>
  	  <input type=SUBMIT value="Remove Content" style="font-family:impact;font-size:90%;width:12%;"><P>
	   </form>

</body>
</html>
