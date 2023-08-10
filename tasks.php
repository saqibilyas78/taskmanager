<?php include_once 'head.php';?>
<?php include_once 'controllers/Project.php';?>
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
			<?php
if ($flag == "success") {
        ?>
            	<div class="alert fade in alert-success">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Task Added.
				</div>
            	<?php
} else if ($flag == "failed") {
        ?>
            	<div class="alert fade in alert-danger">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Task Couldnot Added.
				</div>
                <?php
} else if ($flag == "update_success") {
        ?>
            	<div class="alert fade in alert-success">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Task Updated.
				</div>
            	<?php
} else if ($flag == "update_failed") {
        ?>
            	<div class="alert fade in alert-danger">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Task Couldnot Updated.
				</div>
                <?php
}
    ?>
				<!--=== Page Content ===-->
				<div class="row">
					<!--=== General Buttons ===-->
					<div class="col-md-12">
						<div class="widget box">
						<a class="btn btn-primary" href="#add-qu">Add Task</a>
						</div>
					</div>
				</div>

				<!--=== Normal ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Manage Task</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<table class="table table-striped table-bordered table-hover table-checkable datatable-task">
									<thead>
										<tr>
											<th>No</th>
											<th>Project Name</th>
											<th>Task</th>
											<th>Status</th>
											<th>Created On</th>
											<th>Action</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- /Normal -->

				<!--=== Form ===-->
				<div id="add-qu" class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Add Task</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
                               <form class="form-horizontal row-border" id="validate-2" action="action/add_task.php"  method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label class="col-md-2 control-label" for="input17">Project:<span class="required">*</span></label>
										<div class="col-md-4">
										 <?php
$projectObj = new Project();
    $projects = $projectObj->getAllProjects();
    if ($projects) {
        ?>
											<select name="project_id" class="select2-select-00 col-md-12 full-width-fix">
                                               <?php
foreach ($projects as $project) {
            ?>
                                                	<option value="<?php echo $project->id; ?>"><?php echo $project->name; ?></option>
                                                	<?php
}
        ?>
                                                </select>
                                               <?php
} else {
        ?>
                                                	<b>Please Add Atleast One Project.</b>
                                                	<?php
}
    ?>

										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Task:<span class="required">*</span></label>
										<div class="col-md-4"><input type="text" name="name" required class="form-control required"></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Description:<span class="required">*</span></label>
										<div class="col-md-6"><input type="text" name="description" required class="form-control required"></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label" for="input17">Status:<span class="required">*</span></label>
										<div class="col-md-4">
											<select name="status" class="select2-select-00 col-md-12 full-width-fix">
                                                	<option value="Backlog">Backlog</option>
                                                	<option value="In Progress">In Progress</option>
                                                	<option value="Testing">Testing</option>
                                                	<option value="Done">Done</option>
                                                </select>
										</div>
									</div>
									<div class="form-actions">
										<input type="submit" value="Submit" class="btn btn-primary pull-right">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Form -->
                </div>
				<!-- /Page Content -->

				  <div id="task-edit">
                        		<div class="mws-dialog-inner-task-edit">
                                </div>
                            </div>

				  <div id="task-delete">
                        		<div class="mws-dialog-inner-task-delete" style="display: none;">
                        		Do you really want to delete this task?
                                </div>
                            </div>

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