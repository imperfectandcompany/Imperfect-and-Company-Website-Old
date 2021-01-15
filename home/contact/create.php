<?php
include 'functions.php';
$pdo = pdo_connect_mysql();


//for errors
$msg = '';
//make sure user posts
if (isset($_POST['title'], $_POST['username'], $_POST['msg'])) {
  // make sure inputs not empty
    if (empty($_POST['title']) || empty($_POST['msg'])) {
        $msg = 'Please complete the form!';
    } else {
        // Insert new record into the table
        $stmt = $pdo->prepare('INSERT INTO tickets (title, username, msg) VALUES (?, ?, ?)');
        $stmt->execute([ $_POST['title'], $_POST['username'], $_POST['msg'] ]);
        // bring them to the view for that ticket
        header('Location: view.php?id=' . md5($pdo->lastInsertId()));
    }
}
?>
<?=contact_header('Create Message')?>
  <div class="antialiased bg-gray-100 dark-mode:bg-gray-900">
  <div class="w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800">
	<?php include_once('nav.php');?>

	
<div class="container mx-auto p-10 pb-20">
	<h2 class="m-0 text-xl text-gray-700 border-b-2 pt-20 pb-5 font-bold">Contact</h2>
	<p class="pt-5 pb-5">Please fill in the details below.</p>
    <form action="create.php" class="flex flex-col pt-15 pr-0" method="post">
        <label for="title" class="inline-flex w-full mr-6">Title</label>
        <input class="p-2 border border-gray-200 w-full mr-6 mb-4" type="text" name="title" placeholder="Title" id="title" required>
        <input class="p-2 border border-gray-200 w-full mr-6 mb-4" type="hidden" name="username" value="<?php echo $_SESSION['username']?>" id="username" readonly>
        <label class="inline-flex w-full mr-6" for="msg">Message</label>
        <textarea class="p-2 border border-gray-200 h-48" name="msg" placeholder="Enter your message here..." id="msg" required></textarea>



<div class="flex mx-auto pb-20">
        <a href="./"  class="bg-green-500 font-bold text-sm text-white cursor-pointer  mt-4 p-4 transition rounded hover:bg-green-600">Go back</a>
		<div class="p-2"></div>
        <input type="submit" value="Send" class="block bg-green-500 font-bold text-sm text-white cursor-pointer w-48 mt-4 p-4 transition rounded hover:bg-green-600">
</div>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>


</div>
</div>
<?php contact_footer(); ?>