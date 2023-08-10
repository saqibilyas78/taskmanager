<!--=== Navigation ===-->
 <?php
$full_name = $_SERVER['PHP_SELF'];
$name_array = explode('/', $full_name);
$count = count($name_array);
$page_name = $name_array[$count - 1];
?>
    			<?php
if (isset($_SESSION['admin_id'])) {
    ?>
				<ul id="nav">
					<li class="<?php echo ($page_name == 'dashboard.php') ? 'current' : ''; ?>">
						<a href="dashboard.php">
							<i class="icon-desktop"></i>
							Dashboard
						</a>
					</li>
					<li class="<?php echo ($page_name == 'manage_projects.php') ? 'current' : ''; ?>">
						<a href="manage_projects.php">
							<i class="icon-desktop"></i>
							Manage Projects
						</a>
					</li>
					<li class="<?php echo ($page_name == 'tasks.php') ? 'current' : ''; ?>">
						<a href="tasks.php">
							<i class="icon-table"></i>
							Tasks
						</a>
					</li>
					<li>
						<a href="action/logout.php">
							<i class="icon-table"></i>
							Logout
						</a>
					</li>
				</ul>
				<?php
}
?>
				<!-- /Navigation -->