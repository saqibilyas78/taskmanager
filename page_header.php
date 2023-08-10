<!--=== Page Header ===-->
 <?php
$full_name = $_SERVER['PHP_SELF'];
$name_array = explode('/', $full_name);
$count = count($name_array);
$page_name = $name_array[$count - 1];
?>
				<div class="page-header">
					<div class="page-title">
						<h3>
						<?php
if ($page_name == 'manage_projects.php') {
    echo "Manage Projects";
}
if ($page_name == 'tasks.php') {
    echo "Manage Tasks";
}
?>
						</h3>
						<span>Welcome, <?=$_SESSION['user_name'];?>!</span>
					</div>

					<?php if (isset($_SESSION['admin_id'])) {?>
					<!-- Page Stats -->
					<ul class="page-stats" id="page-stats-notificationCount">

					</ul>
					<!-- /Page Stats -->
					<?php }?>
				</div>
				<!-- /Page Header -->