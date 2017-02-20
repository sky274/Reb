<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['state_id'])){
	redirect_to('index.php');
}
$errors = array();
$territory = array(
	'name' =>  '',
	'position' => ''
	);

if (is_post_request()) {
	if(isset($_POST['name'])) { $territory['name'] = h($_POST['name']); }
	if(isset($_POST['position'])) { $territory['position'] = h($_POST['position']); }
	
	$result = insert_territory($territory, $_GET['state_id']);
	
	if ($result === True) {
		redirect_to('show.php?id=' . u(db_insert_id($db)));
	} else {
		$errors = $result;
	}
}
?>
<?php $page_title = 'Staff: New Territory'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="../states/index.php"> Back to State Details</a><br />

  <h1>New Territory</h1>
  <?php echo display_errors($errors); ?>

  <!-- TODO add form -->
  <form action="new.php?state_id=<?php echo h($_GET['state_id']); ?>" method="post">
		Name:<br />
		<input type="text" name="name" value="<?php echo h($territory['name']); ?>" /><br />
		Position:<br />
		<input type="text" name="position" value="<?php echo h($territory['position']); ?>" /><br /><br />	
		<input type="submit" name="submit" value="Create" />	
	</form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
