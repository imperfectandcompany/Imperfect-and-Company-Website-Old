<?php
include 'functions.php';
// Connect to MySQL using the below function
$pdo = pdo_connect_mysql();
// Check if the ID value is set
if (!isset($_GET['id'])) {
    exit('Message not found!');
}


// selects the message
$stmt = $pdo->prepare('SELECT * FROM tickets WHERE md5(id) = ?');
$stmt->execute([ $_GET['id'] ]);
$message = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if ticket exists
if (!$message) {
exit('Message not found!');
}

//check to see if the user viewing the message owns it
$username = $message['username'];

if ($username == $_SESSION['username']) {
	$valid = 1;
}
else{
$valid=0;	
}
if (!$valid) {
	exit ('This message does not belong to you!');
}

// Update status
if (isset($_GET['status']) && in_array($_GET['status'], array('open', 'closed', 'resolved'))) {
    $stmt = $pdo->prepare('UPDATE tickets SET status = ? WHERE md5(id) = ?');
    $stmt->execute([ $_GET['status'], $_GET['id'] ]);
    header('Location: view.php?id=' . $_GET['id']);
    exit;
}

// Check if the comment form has been submitted
if (isset($_POST['msg']) && !empty($_POST['msg'])) {
    // Insert the new comment into the "tickets_comments" table
    $stmt = $pdo->prepare('INSERT INTO tickets_comments (username, ticket_id, msg) VALUES (:username, :message, :msg)');
	$stmt->bindValue(':username',$username);
	$stmt->bindValue(':message', $message['id']);
	$stmt->bindValue(':msg', $_POST['msg']);
	$stmt->execute();
    header('Location: view.php?id=' . $_GET['id']);	
	exit;
}

$stmt = $pdo->prepare('SELECT * FROM tickets_comments WHERE md5(ticket_id) = ? ORDER BY created DESC');
$stmt->execute([ $_GET['id'] ]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=contact_header(htmlspecialchars($message['title'], ENT_QUOTES))?>
  <div class="antialiased bg-gray-100 dark-mode:bg-gray-900">
  <div class="w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800">
	<?php include_once('nav.php');?>


<div class="container p-20 mx-auto pb-20">

	<h2 class="m-0 text-xl text-gray-700"><?=htmlspecialchars($message['title'], ENT_QUOTES)?> <span class="
		<?php 
		if($message['status'] == "closed"){
		echo 'text-red-700';
		}
		elseif($message['status'] == "resolved"){
		echo 'text-green-500';			
		}
		else {
		echo 'text-green-500';
		}
		?>
		">(<?=$message['status']?>)</span></h2>
				<div class="p-2"></div>
    <div class="flex flex-row-reverse">
		
        <a href="view.php?id=<?=$_GET['id']?>&status=closed" class="inline-block transition no-underline p-2 transitions bg-red-500 font-bold text-sm rounded text-white red hover:bg-red-600">Close</a>
		<div class="p-2"></div>
        <a href="view.php?id=<?=$_GET['id']?>&status=resolved" class="inline-block transition no-underline p-2 transitions bg-green-500 font-bold text-sm rounded text-white hover:bg-green-600">Resolved</a>
    </div>
	
    <div class="pt-4 ">
	<div class="mx-auto container hover:bg-gray-100 rounded-lg transition p-1">
        <p class="text-gray-600"><?=date('F dS, G:ia', strtotime($message['created']))?></p>
        <p class="msg"><?=nl2br(htmlspecialchars($message['msg'], ENT_QUOTES))?></p>
	</div>
    </div>



    <div class="comments ">
        <?php foreach($comments as $comment): ?>
        <div class="flex pb-1 hover:bg-gray-100 rounded-lg transition">
            <div class="flex items-start justify-center w-16 text-gray-300">
                <i class="fas fa-comment fa-2x"></i>
            </div>
            <p>
                <span class="flex text-sm pb-1 text-gray-600"><?=date('F dS, G:ia', strtotime($comment['created']))?></span>
                <?=nl2br(htmlspecialchars($comment['msg'], ENT_QUOTES))?>
            </p>
        </div>
        <?php endforeach; ?>
        <form action="" method="post" class="container pt-4">
            <textarea name="msg" id="msg" placeholder="Enter your comment..." class="p-2 border border-gray-200 h-12 w-full"></textarea>
			<div class="flex">
        <a href="./"  class="bg-green-500 font-bold text-sm text-white cursor-pointer  mt-4 p-4 transition rounded hover:bg-green-600">Go back</a>			
				<div class="p-2"></div>
			<input type="submit" value="Post Comment" class="block bg-green-500 font-bold text-sm text-white cursor-pointer w-48 mt-4 p-4 transition rounded hover:bg-green-600">
			</div>
        </form>
    </div>

</div>
<?php contact_footer(); ?>