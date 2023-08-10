<?php
session_start();
include_once '../controllers/Project.php';
include_once '../controllers/Task.php';
$id = $_POST['id'];

$taskObj = new Task();
$row_edit = $taskObj->getTaskDetail($id);
?>

   <form class="form-horizontal row-border" id="validate-3" action="edit_action/edit_task.php"  method="post" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?=$row_edit->id;?>" />
							<div class="form-group">
										<label class="col-md-4 control-label">Project:<span class="required">*</span></label>
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
                                                	<option value="<?php echo $project->id; ?>" <?php if ($row_edit->project_id == $project->id) {echo "selected='selected'";}?>><?php echo $project->name; ?></option>
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
										<label class="col-md-4 control-label">Task:<span class="required">*</span></label>
										<div class="col-md-4"><input type="text" name="name" required class="form-control required" value="<?=$row_edit->name;?>"></div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Description:<span class="required">*</span></label>
										<div class="col-md-8"><input type="text" name="description" class="form-control required" value="<?=$row_edit->description;?>"></div>
									</div>

									<div class="form-group">
										<label class="col-md-4 control-label" for="input17">Status </label>
										<div class="col-md-4">
											<select name="status" class="select2-select-00 col-md-12 full-width-fix">
                                                	<option value="Backlog" <?php if ($row_edit->status == "Backlog") {echo "selected='selected'";}?> >Backlog</option>
                                                	<option value="In Progress" <?php if ($row_edit->status == "In Progress") {echo "selected='selected'";}?>  >In Progress</option>
                                                	<option value="Testing" <?php if ($row_edit->status == "Testing") {echo "selected='selected'";}?> >Testing</option>
                                                	<option value="Done" <?php if ($row_edit->status == "Done") {echo "selected='selected'";}?> >Done</option>
                                            </select>
										</div>
										</div>
		</form>

	<script type="text/javascript" src="plugins/validation/jquery.validate.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins.form-components.js"></script>
	<script type="text/javascript" src="assets/js/demo/form_components.js"></script>
	<script type="text/javascript" src="plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
	<script type="text/javascript" src="assets/js/demo/form_validation.js"></script>

