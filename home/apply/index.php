<?php
    require_once('../../config/db.php');
include 'functions.php';

$pdo = pdo_connect_mysql();
$stmt = $pdo->prepare("SELECT * FROM application_jobs ORDER BY Date_Posted DESC");
$username = $_SESSION['username'];
$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
apply_header("Apply");
?>
<script src="https://use.fontawesome.com/ab1b4bc570.js"></script>

<div class="min-h-screen">
  <div class="antialiased bg-gray-100 dark-mode:bg-gray-900">
  <div class="w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800">
  <?php include_once('nav.php'); ?>

<div class="container mx-auto pl-10 pr-10 pb-20">

	<h2 class="m-0 text-xl text-gray-700 border-b-2 pt-20 pb-5 font-bold">Applications</h2>
	<p class="pt-5 pb-5">Welcome to the applications page, you can view the list of opportunities below.</p>

	<div class="flex flex-col pt-2 pb-2 ">
		<?php foreach ($jobs as $job): ?>
		<a href="view.php?id=<?=md5($job['ID'])?>" class="w-full flex no-underline hover:bg-gray-100 rounded-lg transition p-1">
			<div class="flex justify-center">
				<i class="fa fa-times fa-2x text-center w-20 text-gray-500"></i>
			</div>
			<div class="container  mx-auto">
				<span class="font-semibold text-gray-700"><?=htmlspecialchars($job['Title'], ENT_QUOTES)?></span>
				<div class="overflow-hidden overflow-ellipsis whitespace-no-wrap text-gray-500 text-sm">
				<?=htmlspecialchars(substr($job['Description'], 0, 100), ENT_QUOTES)?>...</div>
			</div>
			<div class="flex-grow items-end text-gray-500 text-sm"><?=date('F dS', strtotime($job['Date_Posted']))?></div>
		</a>
		<?php endforeach; ?>
	</div>
	
	<h2 class="m-0 text-xl text-gray-700 border-b-2 pt-20 pb-5 font-bold">Applied</h2>
	<p class="pt-5 pb-5">You have not yet applied to any application(s).</p>

</div>
</div></div></div>

<?php include_once('bottom.php'); ?>
