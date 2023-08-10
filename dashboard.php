<?php include_once 'head.php';?>
<?php include_once 'controllers/Project.php';?>
<?php include_once 'controllers/Task.php';?>

<?php 
$project_id = '';
$tasks = null;
if($_POST){
	$taskObj = new Task();
	$project_id = $_POST['project_id'];
	if($project_id  != 0){
		$tasks = $taskObj->getAllTasksForProject($_POST['project_id']);
	}
}
?>

<body>
	<?php include_once 'header.php';?>
<?php
$flag = "";
if (isset($_GET['action'])) {
    if ($_GET['action'] == "success") {
        $flag = "success";
    } else if ($_GET['action'] == "failed") {
        $flag = "failed";
    } else if ($_GET['action'] == "update_success") {
        $flag = "update_success";
    } else if ($_GET['action'] == "update_failed") {
        $flag = "update_failed";
    }
}
?>
<?php
if (isset($_SESSION['admin_id'])) {
    ?>
	<div id="container">

		<div id="sidebar" class="sidebar-fixed">
			<div id="sidebar-content">
				<?php include_once 'navigation.php';?>
			</div>
		</div>
		<!-- /Sidebar -->

		<div id="content">
			<div class="container">

			<?php include_once 'page_header.php';?>

				<!--=== Page Content ===-->
				<div class="row">
					<!--=== General Buttons ===-->
					<div class="col-md-12">
						<div class="widget">
						<a class="" href="#add-qu">
						<form action="" method="post" id="projectTasks">
						 <?php
$projectObj = new Project();

    $projects = $projectObj->getAllProjects();
    if ($projects) {
        ?>
			<select name="project_id" id="project_id" class="select2-select-00 col-md-12 full-width-fix" onchange="this.form.submit()">
			<option value="0">Select Project</option>
        <?php
foreach ($projects as $project) {
            ?>
    <option value="<?php echo $project->id; ?>" <?php if ($project->id == $project_id) {echo "selected='selected'";}?>><?php echo $project->name; ?></option>
        <?php
}
        ?>
            </select>
			</form>
						</a>
						</div>
					</div>
				</div>

<div class="bs-example">
	<!-- Bootstrap Grid -->
	<div class="row">

		<?php for ($i = 1; $i <= 4; $i++) {
			$column = '';
            ?>
			<div class="col-xs-3 fullheight">
				<h4 class="bold">
				<?php
				switch ($i) {
                case 1:
                    echo "Backlog";
					$column = 'Backlog';
                    break;
                case 2:
                    echo "In Progress";
					$column = 'In Progress';
                    break;
                case 3:
                    echo "Testing";
					$column = 'Testing';
                    break;
                case 4:
                    echo "Done";
					$column = 'Done';
                    break;
            }
            ?></h4>
			<?php 
			if($tasks){
			foreach($tasks as $task){
				if($column == $task->status){
					?>
					<div class="card">
						<h5><?=$task->name ?></h5>
						<select class="select2-select-00 col-md-12 full-width-fix" onchange="updatecardstatus(<?=$task->id?>,event)">
							<option value="Backlog" <?php if($task->status == "Backlog"){echo "selected='selected'";} ?>>Backlog</option>
							<option value="In Progress" <?php if($task->status == "In Progress"){echo "selected='selected'";} ?>>In Progress</option>
							<option value="Testing" <?php if($task->status == "Testing"){echo "selected='selected'";} ?>>Testing</option>
							<option value="Done" <?php if($task->status == "Done"){echo "selected='selected'";} ?>>Done</option>
						</select>
					</div>
					<?php
				}
			?>
			<?php
			} }?>
			</div>
			<?php
			}?>

	  </div>
	</div>


        <?php
} else {
        ?>
	<div class="addone"><h1>Please Add Atleast One Project.</h1></div>
	<?php
}
    ?>

<!-- Styles (so that we can see the grid) -->
<style scoped>
.bs-example  div[class^="col"] {
	border: 1px solid white;
	background: #f5f5f5;
	text-align: center;
	padding-top: 8px;
	padding-bottom: 8px;
	}
.fullheight{
	      height: 600px;
}
.card{
	background-color: #888282;
	color: #fff;
	height: 80px;
	padding: 5px;
	margin-bottom: 5px;
}
.addone{
	height: 600px;
	background-color: #888282;
	color: #fff;
	text-decoration: none;
}
</style>

                </div>
				<!-- /Page Content -->

			</div>
			<!-- /.container -->

		</div>
	</div>
<?php include_once 'js_files.php';?>
<?php } else {
    header("Location: index.php");
}?>
</body>
</html>

<script>
	function updatecardstatus(id,event){
		var selectElement = event.target;
		var status = selectElement.value;
		$.ajax(
		{
			url: "ajax_data/update_action.php",
			type: "POST",
			data: { id: id,value: status, action: 'update-task' },
			success: function (data, textStatus, jqXHR) {
				$('#projectTasks').submit();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				//if fails     
			}
		});
	}
</script>