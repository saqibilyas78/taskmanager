<?php include_once 'head.php';?>
<body>
	<?php include_once 'header.php';?>
<?php
$flag = "";
if (isset($_GET['action'])) {
    if ($_GET['action'] == "success") {
        $flag = "success";
    } else if ($_GET['action'] == "failed") {
        $flag = "failed";
    } else if ($_GET['action'] == "duplicate") {
        $flag = "duplicate";
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
					Project Added.
				</div>
            	<?php
} else if ($flag == "failed") {
        ?>
            	<div class="alert fade in alert-danger">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Project Couldnot Added.
				</div>
                <?php
} else if ($flag == "duplicate") {
        ?>
            	<div class="alert fade in alert-danger">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Project already exsists with this name.
				</div>
                <?php
} else if ($flag == "update_success") {
        ?>
            	<div class="alert fade in alert-success">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Project Updated.
				</div>
            	<?php
} else if ($flag == "update_failed") {
        ?>
            	<div class="alert fade in alert-danger">
					<i class="icon-remove close" data-dismiss="alert"></i>
					Project Couldnot Updated.
				</div>
                <?php
}
    ?>
				<!--=== Page Content ===-->
				<div class="row">
					<!--=== General Buttons ===-->
					<div class="col-md-12">
						<div class="widget box">
						<a class="btn btn-primary" href="#add-cat">Add Project</a>
						</div>
					</div>
				</div>

				<!--=== Normal ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Manage Projects</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<table class="table table-striped table-bordered table-hover table-checkable datatable-project">
									<thead>
										<tr>
											<th>No</th>
											<th>Project Name</th>
											<th>Image</th>
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
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Add Project</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div id="add-cat" class="widget-content">
                               <form class="form-horizontal row-border" id="validate-2" action="action/add_project.php"  method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label class="col-md-2 control-label">Project Name:<span class="required">*</span></label>
										<div class="col-md-4"><input type="text" name="name" required class="form-control required"></div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Project Description:<span class="required">*</span></label>
										<div class="col-md-6"><input type="text" name="description" required class="form-control required"></div>
									</div>
									<div class="form-group">
									<label class="col-md-2 control-label">Image:<span class="required">*</span></label>
										<div class="col-md-8">
											<input type="file" name="image" class="required" accept="image/*" data-style="fileinput" data-inputsize="medium">
											<label for="file1" class="has-error help-block" generated="true" style="display:none;"></label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Status</label>
										<div class="col-md-8">
											<div class="make-switch" data-on="info" data-off="success">
												<input name="status" type="checkbox" checked class="toggle">
											</div>
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

				 <div id="project-edit">
                        		<div class="mws-dialog-inner-project-edit">
                                </div>
                            </div>

				  <div id="project-delete">
                        		<div class="mws-dialog-inner-project-delete" style="display: none;">
                        		Do you really want to delete this project?
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