<?php
include 'functions.php';
// Connect to MySQL using the below function
$pdo = pdo_connect_mysql();
// Check if the ID value is set
if (!isset($_GET['id'])) {
exit(  header("location: ../invalid/index.php?error=1"));
}
	
// selects the message
$stmt = $pdo->prepare('SELECT * FROM application_jobs WHERE md5(id) = ?');
$stmt->execute([ $_GET['id'] ]);
$job = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if job exists
if (!$job) {
exit(  header("location: ../invalid/index.php?error=2"));
}

$stmt = $pdo->prepare('SELECT * FROM application_applicants WHERE md5(applicationid) = ?');
$stmt->execute([ $_GET['id'] ]);
$applicants = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<?=apply_header(htmlspecialchars($job['Title'], ENT_QUOTES))?>
  <div class="antialiased bg-gray-100 dark-mode:bg-gray-900">
  <div class="w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800">
<?php include_once('nav.php'); ?>

<div class="container p-20 mx-auto pb-20">

	<h2 class="m-0 text-xl text-gray-700"><?=htmlspecialchars($job['Title'], ENT_QUOTES)?>         
<span class="<?php
		if($applicants['status'] == "denied"){
		echo 'text-red-700';
		}
		elseif($applicants['status'] == "pending"){
		echo 'text-green-500';			
		}
		else {
		echo 'text-green-500';
		}?>">(<?=(htmlspecialchars($applicants['status'], ENT_QUOTES)) ?>)</span></h2>
			<div class="p-2"></div>
    <div class="flex flex-row-reverse">
        <a href="apply.php?id=<?=$_GET['id']?>" class="inline-block transition no-underline p-2 transitions bg-green-500 font-bold text-sm rounded text-white hover:bg-green-600">Apply</a>
    </div>
	
    <div class="pt-4 ">
	<div class="mx-auto container hover:bg-gray-100 rounded-lg transition p-1">
        <p class="text-gray-600">Posted on <?=date('F dS', strtotime($job['Date_Posted']))?></p>
        <p class="msg"><?=nl2br(htmlspecialchars($job['Description'], ENT_QUOTES))?></p>
	</div>
    </div>

</div>
<?php apply_footer(); ?>