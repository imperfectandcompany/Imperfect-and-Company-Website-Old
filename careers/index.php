<?php
include('../config/db.php');
if (isset($_SESSION['username'])) {
header("location: ../home");
}		
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Imperfect and Company - Opportunities</title>
		<!-- CSS -->
		<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
		<!-- Desired link -->
		<link rel="canonical" href="https://imperfectandcompany.com/">
		<!-- Favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
		<link rel="manifest" href="site.webmanifest">
		<link rel="mask-icon" href="../safari-pinned-tab.svg" color="#5bbad5">
		<!-- SEO METADATA -->
		<meta name="description" content="Imperfect and Company. In a world of people trying to be perfect, sometimes you gotta own that you're imperfect but not alone, you got company." />
		<meta name="keywords" content="imperfectandcompany, imperfect and company, imperfectgamers, postogon, imperfect gamers, imperfectsounds, imperfect sounds, internships" />
		<meta name="msapplication-TileColor" content="#2d89ef">
		<meta property="og:title" content="Imperfect and Company - Internships Available" />
		<meta property="og:description" content="Imperfect but not alone, you got company. Imperfect and Company is accepting internship applications." />
		<!-- switch to 'https' oncet the new cdn subdomain ssl cert is mitigated -->
		<meta property="og:image" content="http://cdn.imperfectandcompany.com/assets/22543831959.png" />
		<meta property="og:image:width" content="1200" />
		<meta property="og:image:height" content="630" />
		<meta name="theme-color" content="#ffffff">
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
	

<body>
<div class="m-auto max-w-6xl p-12">
   <div class="flex flex-col md:flex-row">
      <div class="md:w-1/2 max-w-md flex flex-col justify-center">
         <div class="md:text-5xl text-2xl uppercase font-black">Work with us!</div>
         <div class="text-xl mt-4">We are always looking for new members to be a part of Imperfect and Company. Please log in through the button below or view our openings to get started!</div>
         <div class="my-5 h-16">
            <div class="shadow-md font-medium py-2 px-4 text-yellow-100
               cursor-pointer bg-yellow-600 hover:bg-yellow-500 rounded text-lg text-center w-48"><a href="				<?php
						if (!isset($_SESSION['username'])) {
						echo '../login';
						}
						else{
						echo '../apply';
						}
				?>">
			   				<?php
						if (!isset($_SESSION['username'])) {
						echo 'Log in';
						}
						else{
						echo 'Apply';
						}
				?></a>
			   </div>
         </div>
      </div>
      <div class="flex md:justify-end w-full md:w-1/2 -mt-5">
         <div class="bg-dots">
            <div class="shadow-2xl max-w-md z-10 rounded-lg mt-6 ml-4">
               <img alt="card img" class="rounded-t" src="http://cdn.imperfectandcompany.com/assets/483193522.png"> 
               <div class="text-2xl p-10 bg-white"><img alt="quote" class="float-left mr-1" src="https://assets-global.website-files.com/5b5a66e9f3166b36708705fa/5cf8fb1f994fb7168d0d66fb_quote-intro.svg">In a world of people trying to be perfect, sometimes you gotta own that you're imperfect but not alone, you got company</div>
            </div>
         </div>
      </div>
   </div>
</div>


<div class="w-full h-screen">



        <section class="bg-white py-10">
		
		          <div class="text-center mb-10">
            <h1 class="sm:text-3xl text-2xl font-medium text-center title-font text-gray-900 mb-4">
              Work at Imperfect and Company

            </h1>
            <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto">
              Don't see an available position yet still see a way to add value?<br> Contact us below.
            </p>
          </div>
            <div class="max-w-5xl px-6 mx-auto text-center">


                <div class="flex flex-col items-center justify-center mt-6">
                    <a class="max-w-2xl w-full block bg-white shadow-md rounded-md border-t-4 border-indigo-600 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110" href="../careers/winter-2021-internship">
                        <div class="flex items-center justify-between px-4 py-2">
                            <h3 class="text-lg font-medium text-gray-700">Winter 2021 Internship</h3>
                            <span class="block text-gray-600 font-light text-sm">Posted on 1/3/2021</span>
                        </div>
                    </a>
            </div>
			
                <div class="flex flex-col items-center justify-center mt-6">
                    <a class="max-w-2xl w-full block bg-white shadow-md rounded-md border-t-4 border-indigo-600 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110" href="../careers/front-end-developer">
                        <div class="flex items-center justify-between px-4 py-2">
                            <h3 class="text-lg font-medium text-gray-700">Front-end Developer</h3>
                            <span class="block text-gray-600 font-light text-sm">Posted on 1/3/2021</span>
                        </div>
                    </a>
            </div>
			
			                <div class="flex items-center justify-center mt-12">
                    <a class="flex items-center text-gray-600 hover:underline hover:text-gray-500" href="../../careers">
                        <span>View More</span>

                        <svg class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>

        </section>      

<div class="flex bg-gray-100 py-24 justify-center">
    <div class="p-12 text-center max-w-2xl">
        <div class="md:text-3xl text-3xl font-bold">Want us to reach out?</div>
        <div class="text-xl font-normal mt-4">Click below to leave your details and we will get in touch within the next 24 hours.
        </div>
        <div class="mt-6 flex justify-center h-12 relative">
            <div class="flex shadow-md font-medium absolute py-2 px-4 text-green-100
        cursor-pointer bg-green-600 rounded text-lg tr-mt  svelte-jqwywd"><a href="">Contact us</a></div>
        </div>
    </div>
</div>
		

<div>
      <section class="text-gray-700">
        <div class="container px-5 py-12 mx-auto">

		      <div class="grid col-span-1 md:flex items-center mt-10 justify-center">

        <div class="md:mr-4">
            <img class="md:w-40" src="http://cdn.imperfectandcompany.com/assets/483193522.png" alt="">
        </div>
        <div class="md:border-l-2 pl-4 p-2 col-span-2 md:w-1/2 mt-10 md:mt-0">
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
        </div>
		
      </section>
    </div>
	
	


	<section id="bottom-navigation" class="block fixed inset-x-0 bottom-0 z-10 bg-white shadow">
		<div id="tabs" class="flex justify-between">
			<a href="../index.php" class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">
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
			<a href="<?php
						if (!isset($_SESSION['username'])) {
						echo '../login';
						}
						else{
						echo '../logout/';
						}
				?>" class="w-full focus:text-teal-500 hover:text-teal-500 justify-center inline-block text-center pt-2 pb-1">
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
				<?php
						if (!isset($_SESSION['username'])) {
						echo '<span class="tab tab-account block text-xs">Log In</span>';
						}
						else{
						echo '<span class="tab tab-account block text-xs">Log out</span>';
						}
				?>

			</a>
		</div>
	</section>
	
	
	
</div>
</body>






</html>