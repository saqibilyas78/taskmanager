<?php
session_start();
include_once '../controllers/Project.php';
$id = $_POST['id'];

$projectObj = new Project();
$row_edit = $projectObj->getProjectDetail($id);
?>

   <form class="form-horizontal row-border" id="validate-3" action="edit_action/edit_project.php"  method="post" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?=$row_edit->id;?>" />
							<input type="hidden" name="image_old" value="<?=$row_edit->image;?>" />
							<div class="form-group">
										<label class="col-md-4 control-label">Project Name:<span class="required">*</span></label>
										<div class="col-md-4"><input type="text" name="name" class="form-control required" value="<?=$row_edit->name;?>"></div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Project Description:<span class="required">*</span></label>
										<div class="col-md-8"><input type="text" name="description" class="form-control required" value="<?=$row_edit->description;?>"></div>
									</div>
									<div class="form-group">
									<label class="col-md-4 control-label">Image:<span class="required">*</span></label>
										<div class="col-md-4">
											<input type="file" name="image" accept="image/*" data-style="fileinput" data-inputsize="medium">
											<label for="file1" class="has-error help-block" generated="true" style="display:none;"></label>
											<?php echo '<a href="images/projects/' . $row_edit->image . '" target="_blank"><img alt="' . $row_edit->image . '" src="images/projects/' . $row_edit->image . '" width="100px" height="100px"></a>'; ?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label" for="input17">Status </label>
										<div class="col-md-4">
											<select name="status" class="form-control">

                                                	<option value="Y" <?php if ($row_edit->status == "Y") {echo "selected='selected'";}?>>Enable</option>
                                                	<option value="N" <?php if ($row_edit->status == "N") {echo "selected='selected'";}?>>Disable</option>

											</select>
										</div>
										</div>



		</form>

	<script type="text/javascript" src="plugins/validation/jquery.validate.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins.form-components.js"></script>
	<script type="text/javascript" src="assets/js/demo/form_components.js"></script>
	<script type="text/javascript" src="plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
	<script type="text/javascript" src="assets/js/demo/form_validation.js"></script>

