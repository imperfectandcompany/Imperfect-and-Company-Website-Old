<?php
    require_once('../../config/db.php');
include 'functions.php';

$pdo = pdo_connect_mysql();
	
$stmt = $pdo->prepare("SELECT * FROM tickets WHERE username=:username ORDER BY created DESC");
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$username = $_SESSION['username'];
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
contact_header("Contact");
?>
<script src="https://use.fontawesome.com/ab1b4bc570.js"></script>

<div class="min-h-screen">
  <div class="antialiased bg-gray-100 dark-mode:bg-gray-900">
  <div class="w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800">
	<?php include_once('nav.php');?>

	


<div class="container mx-auto p-10 pb-20">

	<h2 class="m-0 text-xl text-gray-700 border-b-2 pt-20 pb-5 font-bold">Contact</h2>

	<p class="pt-5 pb-5">Welcome to the contact page, you can view the list of messages below.</p>

	<div class="flex p-1 pb-4">
		<a href="create.php" class="inline-block no-underline bg-green-500 font-bold text-sm rounded text-white hover:bg-green-600 p-2 mt-15 mr-10 mb-15 ml-0 transition">New Message</a>
	</div>

	<div class="flex flex-col pt-2 pb-2 ">
		<?php foreach ($messages as $message): ?>
		<a href="view.php?id=<?=md5($message['id'])?>" class="w-full flex no-underline hover:bg-gray-100 rounded-lg transition p-1">
			<div class="flex justify-center">
				<?php if ($message['status'] == 'open'): ?>
				<i class="fa fa-clock-o fa-2x text-center w-20 text-gray-500"></i>
				<?php elseif ($message['status'] == 'resolved'): ?>
				<i class="fa fa-check fa-2x text-center w-20 text-gray-500"></i>
				<?php elseif ($message['status'] == 'closed'): ?>
				<i class="fa fa-times fa-2x text-center w-20 text-gray-500"></i>
				<?php endif; ?>
			</div>
			<div class="container  mx-auto">
				<span class="font-semibold text-gray-700"><?=htmlspecialchars($message['title'], ENT_QUOTES)?></span>
				<div class="overflow-hidden overflow-ellipsis whitespace-no-wrap text-gray-500 text-sm"><?=htmlspecialchars($message['msg'], ENT_QUOTES)?></div>
			</div>
			<div class="flex-grow items-end text-gray-500 text-sm"><?=date('F dS, G:ia', strtotime($message['created']))?></div>
		</a>
		<?php endforeach; ?>
	</div>

</div>
<?php contact_footer(); ?>