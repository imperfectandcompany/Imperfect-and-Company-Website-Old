<!doctype html>
<html lang="en">
    <head>
        <title>Imperfect and Company - Register</title>
		<!-- CSS -->
		<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
		<!-- JS -->
		<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
		<!-- Desired link -->
		<link rel="canonical" href="https://imperfectandcompany.com/register">
		<!-- Favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
		<link rel="manifest" href="../site.webmanifest">
		<link rel="mask-icon" href="../safari-pinned-tab.svg" color="#5bbad5">
		<!-- SEO METADATA -->
		<meta name="description" content="Imperfect and Company. Registration page." />
		<meta name="keywords" content="imperfectandcompany, registration, join now, signup, imperfect and company, imperfectgamers, postogon, imperfect gamers, imperfectsounds, imperfect sounds, internships" />
		<meta name="msapplication-TileColor" content="#2d89ef">
		<meta property="og:title" content="Imperfect and Company - Internships Available" />
		<meta property="og:description" content="Imperfect but not alone, you got company. Imperfect and Company is accepting internship applications." />
		<meta property="og:image" content="https://cdn.imperfectandcompany.com/assets/22543831959.png" />
		<meta property="og:image:width" content="1200" />
		<meta property="og:image:height" content="630" />
		<meta name="theme-color" content="#ffffff">
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
	

<body>

    <!-- Header -->
    <?php include('../header.php'); ?>

    <!-- Login script -->
    <?php include('../controllers/register.php'); ?>

    <div class="flex justify-center text-xl font-bold tracking-widest text-gray-300">
<h1>Imperfect and Company</h1>

    </div>






<div class="w-full h-screen">

<div class="container max-w-full mx-auto md:py-6 px-6">
  <div class="max-w-sm mx-auto px-6">
        <div class="relative flex flex-wrap">
            <div class="w-full relative">
                <div class="md:mt-6">
                    <div class="text-center font-semibold text-black">
                        Register
                    </div>
                    <div class="text-center font-base text-black">
					<?php echo $success_msg; ?>
                    <?php echo $email_exist; ?>
                    <?php echo $user_exist; ?>
					<?php echo $tos_err; ?>
                    <?php echo $email_verify_err; ?>
                    <?php echo $email_verify_success; ?>
                    </div>
                    <form class="mt-8" x-data="{password: '',password_confirm: ''}" method="post">
                        <div class="mx-auto max-w-lg ">
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">Username</span>
									<?php echo $uNameEmptyErr; ?>
    <?php echo $u_NameErr; ?>
                                <input placeholder="" type="text" name="username" 
                                       class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                            </div>
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">Email</span>
								                        <?php echo $_emailErr; ?>
                        <?php echo $emailEmptyErr; ?>
                                <input placeholder="" type="email" name="email" id="email_signin"
                                       class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                            </div>
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">Password</span>
								                        <?php echo $_passwordErr; ?>
                        <?php echo $passwordEmptyErr; ?>
                                <input placeholder="" name="password"  type="password" x-model="password"
                                       class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                            </div>
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">Confirm Password</span>
								                        <?php echo $cpasswordEmptyErr; ?>
                        <?php echo $passMatchErr; ?>
                                <input placeholder="" name="confirmpass" type="password" x-model="password_confirm"
                                       class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                            </div>
                            <div class="flex justify-start mt-3 ml-4 p-1">
                                <ul>
                                    <li class="flex items-center py-1">
                                        <div :class="{'bg-green-200 text-green-700': password == password_confirm && password.length > 0, 'bg-red-200 text-red-700':password != password_confirm || password.length == 0}"
                                             class=" rounded-full p-1 fill-current ">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path x-show="password == password_confirm && password.length > 0" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="2"
                                                      d="M5 13l4 4L19 7"/>
                                                <path x-show="password != password_confirm || password.length == 0" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="2"
                                                      d="M6 18L18 6M6 6l12 12"/>

                                            </svg>
                                        </div>
                                        <span :class="{'text-green-700': password == password_confirm && password.length > 0, 'text-red-700':password != password_confirm || password.length == 0}"
                                              class="font-medium text-sm ml-3"
                                              x-text="password == password_confirm && password.length > 0 ? 'Passwords match' : 'Passwords do not match' "></span>
                                    </li>
                                    <li class="flex items-center py-1">
                                        <div :class="{'bg-green-200 text-green-700': password.length > 7, 'bg-red-200 text-red-700':password.length < 7 }"
                                             class=" rounded-full p-1 fill-current ">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path x-show="password.length > 7" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="2"
                                                      d="M5 13l4 4L19 7"/>
                                                <path x-show="password.length < 7" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="2"
                                                      d="M6 18L18 6M6 6l12 12"/>

                                            </svg>
                                        </div>
                                        <span :class="{'text-green-700': password.length > 7, 'text-red-700':password.length < 7 }"
                                              class="font-medium text-sm ml-3"
                                              x-text="password.length > 7 ? 'The minimum length is reached' : 'At least 8 characters required' "></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="flex justify-start">
                                <label class="block text-gray-500 font-bold my-4 flex items-center">
                                    <input class="leading-loose text-pink-600 top-0" name="checkbox" type="checkbox"/>
                                    <span class="ml-2 text-sm py-2 text-gray-600 text-left">I accept the
                                          <a href="#"
                                             class="font-semibold text-black border-b-2 border-gray-200 hover:border-gray-500">
                                           Terms and Conditions
                                          </a>and
                                          <a href="#"
                                             class="font-semibold text-black border-b-2 border-gray-200 hover:border-gray-500">
                                            information data policy.</a>
                                    </span>
                                </label>
                            </div>
                            <button type="submit" name="submit" id="submit"  class="mt-3 text-lg font-semibold
            bg-gray-800 w-full text-white rounded-lg
            px-6 py-3 block shadow-xl hover:text-white hover:bg-black">
                                Register
                            </button>
                        </div>
                    </form>

				
				
                    <div class="text-sm font-semibold block py-6 flex justify-center">
                        <a href="../login/"
                           class="text-black font-normal border-b-2 border-gray-200 hover:border-teal-500">Go to 
                            <span class="text-black font-semibold">
            Login
          </span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>                      



		      <div class="grid col-span-1 md:flex pb-20 items-center mt-10 justify-center">

        <div class="md:mr-4">
            <img class="md:w-40" src="https://cdn.imperfectandcompany.com/assets/483193522.png" alt="">
        </div>
        <div class="md:border-l-2 pl-4 p-2 col-span-2 text-justify md:w-1/2 mt-10 md:mt-0">
            <p class="mt-4">
             Responsible for one of the most major, incremental, community projects combining gamers to music.
			 <br>
https://imperfectgamers.org/
<br>
https://imperfectsounds.com/
<br>	
https://shop.imperfectandcompany.com/
            </p>
        </div>
    </div>
	
	



	<section id="bottom-navigation" class="block fixed inset-x-0 bottom-0 z-10 bg-white shadow">
		<div id="tabs" class="flex justify-between">
			<a href="index.php" class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">
				<svg width="25" height="25" viewBox="0 0 42 42" class="inline-block mb-1">
			    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
			        <path d="M21.0847458,3.38674884 C17.8305085,7.08474576 17.8305085,10.7827427 21.0847458,14.4807396 C24.3389831,18.1787365 24.3389831,22.5701079 21.0847458,27.6548536 L21.0847458,42 L8.06779661,41.3066256 L6,38.5331279 L6,26.2681048 L6,17.2542373 L8.88135593,12.4006163 L21.0847458,2 L21.0847458,3.38674884 Z" fill="currentColor" fill-opacity="0.1"></path>
			        <path d="M11,8 L33,8 L11,8 Z M39,17 L39,36 C39,39.3137085 36.3137085,42 33,42 L11,42 C7.6862915,42 5,39.3137085 5,36 L5,17 L7,17 L7,36 C7,38.209139 8.790861,40 11,40 L33,40 C35.209139,40 37,38.209139 37,36 L37,17 L39,17 Z" fill="currentColor"></path>
			        <path d="M22,27 C25.3137085,27 28,29.6862915 28,33 L28,41 L16,41 L16,33 C16,29.6862915 18.6862915,27 22,27 Z" stroke="currentColor" stroke-width="2" fill="currentColor" fill-opacity="0.1"></path>
			        <rect fill="currentColor" transform="translate(32.000000, 11.313708) scale(-1, 1) rotate(-45.000000) translate(-32.000000, -11.313708) " x="17" y="10.3137085" width="30" height="2" rx="1"></rect>
			        <rect fill="currentColor" transform="translate(12.000000, 11.313708) rotate(-45.000000) translate(-12.000000, -11.313708) " x="-3" y="10.3137085" width="30" height="2" rx="1"></rect>
			    </g>
				</svg>
				<span class="tab tab-home block text-xs">Home</span>
			</a>
			<a href="../login" class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">
				<svg width="25" height="25" viewBox="0 0 42 42" class="inline-block mb-1">
			    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
		        <path d="M14.7118754,20.0876892 L8.03575361,20.0876892 C5.82661462,20.0876892 4.03575361,18.2968282 4.03575361,16.0876892 L4.03575361,12.031922 C4.03575361,8.1480343 6.79157254,4.90780265 10.4544842,4.15995321 C8.87553278,8.5612583 8.1226025,14.3600511 10.9452499,15.5413938 C13.710306,16.6986332 14.5947501,18.3118357 14.7118754,20.0876892 Z M14.2420017,23.8186831 C13.515543,27.1052019 12.7414284,30.2811559 18.0438552,31.7330419 L18.0438552,33.4450645 C18.0438552,35.6542035 16.2529942,37.4450645 14.0438552,37.4450645 L9.90612103,37.4450645 C6.14196811,37.4450645 3.09051926,34.3936157 3.09051926,30.6294627 L3.09051926,27.813861 C3.09051926,25.604722 4.88138026,23.813861 7.09051926,23.813861 L14.0438552,23.813861 C14.1102948,23.813861 14.1763561,23.8154808 14.2420017,23.8186831 Z M20.7553776,32.160536 C23.9336213,32.1190063 23.9061943,29.4103976 33.8698747,31.1666916 C34.7935223,31.3295026 35.9925894,31.0627305 37.3154077,30.4407183 C37.09778,34.8980343 33.4149547,38.4450645 28.9036761,38.4450645 C24.9909035,38.4450645 21.701346,35.7767637 20.7553776,32.160536 Z" fill="currentColor" opacity="0.1"></path>
		        <g transform="translate(2.000000, 3.000000)">
		            <path d="M8.5,1 C4.35786438,1 1,4.35786438 1,8.5 L1,13 C1,14.6568542 2.34314575,16 4,16 L13,16 C14.6568542,16 16,14.6568542 16,13 L16,4 C16,2.34314575 14.6568542,1 13,1 L8.5,1 Z" stroke="currentColor" stroke-width="2"></path>
		            <path d="M4,20 C2.34314575,20 1,21.3431458 1,23 L1,27.5 C1,31.6421356 4.35786438,35 8.5,35 L13,35 C14.6568542,35 16,33.6568542 16,32 L16,23 C16,21.3431458 14.6568542,20 13,20 L4,20 Z" stroke="currentColor" stroke-width="2"></path>
		            <path d="M23,1 C21.3431458,1 20,2.34314575 20,4 L20,13 C20,14.6568542 21.3431458,16 23,16 L32,16 C33.6568542,16 35,14.6568542 35,13 L35,8.5 C35,4.35786438 31.6421356,1 27.5,1 L23,1 Z" stroke="currentColor" stroke-width="2"></path>
		            <path d="M34.5825451,33.4769886 L38.3146092,33.4322291 C38.8602707,33.4256848 39.3079219,33.8627257 39.3144662,34.4083873 C39.3145136,34.4123369 39.3145372,34.4162868 39.3145372,34.4202367 L39.3145372,34.432158 C39.3145372,34.9797651 38.8740974,35.425519 38.3265296,35.4320861 L34.5944655,35.4768456 C34.048804,35.4833899 33.6011528,35.046349 33.5946085,34.5006874 C33.5945611,34.4967378 33.5945375,34.4927879 33.5945375,34.488838 L33.5945375,34.4769167 C33.5945375,33.9293096 34.0349773,33.4835557 34.5825451,33.4769886 Z" fill="currentColor" transform="translate(36.454537, 34.454537) rotate(-315.000000) translate(-36.454537, -34.454537) "></path>
		            <circle stroke="currentColor" stroke-width="2" cx="27.5" cy="27.5" r="7.5"></circle>
		        </g>
		    	</g>
				</svg>
				<span class="tab tab-account block text-xs">Log In</span>
			</a>
		</div>
	</section>
	
	
	
</div>
</body>






</html>