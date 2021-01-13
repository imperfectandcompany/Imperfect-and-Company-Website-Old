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
    <div x-data="{ open: true }" class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
      <div class="flex flex-row items-center justify-between p-4">
        <a href="#" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">Imperfect and Company</a>
        <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
          <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
            <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
      <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow hidden pb-4 md:pb-0 md:flex md:justify-end md:flex-row">
        <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../index.php">News</a>
        <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../index.php">Apply</a>
		<?php echo contact_menu(); ?>
        <div @click.away="open = false" class="relative" x-data="{ open: false }">
          <button @click="open = !open" class="flex flex-row text-gray-900 bg-gray-200 items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
            <span>Profile</span>
            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          </button>
          <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full md:max-w-screen-sm md:w-screen mt-2 origin-top-right">
            <div class="px-2 pt-2 pb-4 bg-white rounded-md shadow-lg dark-mode:bg-gray-700">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a class="flex flex row items-start rounded-lg bg-transparent p-2 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="../index.php">
                  <div class="bg-teal-500 text-white rounded-lg p-3">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4"><path d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                  </div>
                  <div class="ml-3">
                    <p class="font-semibold">Appearance</p>
                    <p class="text-sm">Easy customization</p>
                  </div>
                </a>

                <a class="flex flex row items-start rounded-lg bg-transparent p-2 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">
                  <div class="bg-teal-500 text-white rounded-lg p-3">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                  </div>
                  <div class="ml-3">
                    <p class="font-semibold">Comments</p>
                    <p class="text-sm">Check your latest comments</p>
                  </div>
                </a>

                <a class="flex flex row items-start rounded-lg bg-transparent p-2 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">
                  <div class="bg-teal-500 text-white rounded-lg p-3">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4"><path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                  </div>
                  <div class="ml-3">
                    <p class="font-semibold">Analytics</p>
                    <p class="text-sm">Take a look at your statistics</p>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>    
      </nav>
    </div>

<div class="container p-20 mx-auto">

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