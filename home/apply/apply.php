<?php
include 'functions.php';
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

//for errors
$msg = 'Please fill in the details below.';
//make sure user posts
if (isset($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['address'], $_POST['school'], $_POST['gender'])) {
  // make sure inputs not empty
    if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['email']) || empty($_POST['address']) || empty($_POST['school']) || empty($_POST['gender'])) {
        $msg = 'Please complete the form!';
    } else {
        // Insert new record into the table
        $stmt = $pdo->prepare('INSERT INTO application_applicants (applicationid, firstName, lastName, email, address, school, gender) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$job['ID'], $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['address'], $_POST['school'], $_POST['gender']]);
        // bring them to the view for that ticket
        header('Location: ./view.php?id=' . $_GET['id']);
    }
}
?>

<?=apply_header('Application')?>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
<style>@import url('https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css')</style>

  <div class="antialiased bg-gray-100 dark-mode:bg-gray-900">
  <div class="w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800">
	<?php include_once('nav.php');?>
	
<div class="container mx-auto p-10 pb-20">
	<h2 class="m-0 text-xl text-gray-700 border-b-2 pt-20 pb-5 font-bold">Apply for <?=htmlspecialchars($job['Title'], ENT_QUOTES)?></h2>
	<p class="pt-5 pb-5"><?php if ($msg): ?><?=$msg?>
    <?php endif; ?></p>
	<form method="post" action="">
                <div>
                    <div class="flex -mx-3">
                        <div class="w-1/2 px-3 mb-5">
                            <label for="" class="text-xs font-semibold px-1">First name</label>
                            <div class="flex">
                                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-account-outline text-gray-400 text-lg"></i></div>
                                <input type="text" name="fname" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="John">
                            </div>
                        </div>
                        <div class="w-1/2 px-3 mb-5">
                            <label for="" class="text-xs font-semibold px-1">Last name</label>
                            <div class="flex">
                                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-account-outline text-gray-400 text-lg"></i></div>
                                <input type="text" name="lname" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="Smith">
                            </div>
                        </div>
                    </div>
                    <div class="flex -mx-3">
                        <div class="w-1/2 px-3 mb-5">
                            <label for="" class="text-xs font-semibold px-1">Email</label>
                            <div class="flex">
                                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                                <input type="email" name="email" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" value="<?php echo $_SESSION['email'];?>" placeholder="joe@mama.com" readonly>
                            </div>
                        </div>
                        <div class="w-1/2 px-3 mb-5">
                            <label for="" class="text-xs font-semibold px-1">Address</label>
                            <div class="flex">
                                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-location-enter text-gray-400 text-lg"></i></div>
                                <input type="text"name="address" id="pac-input" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="123 Seseme Street">
                            </div>
                        </div>
                    </div>					
                    <div class="flex -mx-3">
                        <div class="w-1/2 px-3 mb-5">
                            <label for="" class="text-xs font-semibold px-1">School</label>
                            <div class="flex">
                                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-school-outline text-gray-400 text-lg"></i></div>
                                <input type="text" name="school" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="Harvard University">
                            </div>
                        </div>
                        <div class="w-1/2 px-3 mb-5">
                            <label for="" class="text-xs font-semibold px-1">Gender</label>
                            <div class="flex">
                                <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-gender-male-female-variant text-gray-400 text-lg"></i></div>
                                <input type="text" name="gender" id="pac-input" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="Gender">
                            </div>
                        </div>
                    </div>
                    <div class="flex -mx-3  pb-20">
                        <div class="w-full px-3 mb-5">
						
                            <input type="submit" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 transition focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold"></input>

</div>							
                        </div>
                    </div>
                </div>		
	</form>



</div>
</div>
<?php apply_footer(); ?>