<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="./public/styles.css" rel="stylesheet">
</head>
<body>
    <header>
        <a id="logo" href="index.php">
            Schedule
            <svg 
                width="35"
                height="35"
                viewBox="0 0 30 30"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M12 4C11.4477 4 11 4.44772 11 5V11H5C4.44772 11 4 11.4477 4 12C4 12.5523 4.44772 13 5 13H11V19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19V13H19C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11H13V5C13 4.44772 12.5523 4 12 4Z"
                    fill="currentColor"
                />
            </svg>
        </a>
    </header>
    <main class="min-h-[90vh] mx-auto p-4 flex justify-center items-center">
        <section class="max-w-[600px] min-h-[630px] pt-20 pb-6 px-4 bg-light-gray rounded-lg min-[500px]:px-10 min-[500px]:pt-20">
            <h1 class="mb-10 uppercase font-bold text-3xl text-center">Log in as an admin</h1>
            <div class='min-h-[64px] text-red tracking-wider'>
                <?php 
                if( isset($_SESSION['errorMessages']) ) {
                    foreach($_SESSION['errorMessages'] as $error) {
                        echo "<p>$error</p>";
                    }
                }
                unset($_SESSION['errorMessages']);
                ?>
            </div>
            <form action="admin-login-processing.php" method="post">
                <div>
                    <label  for="username" class="sr-only">Username</label> 
                    <input	type="text" 
                            id="username" 
                            value=""
                            name="username"
                            placeholder="Username"
                            class="w-full mb-10 p-2 bg-transparent border-b-2 tracking-wider placeholder:text-primary-black placeholder:tracking-widest focus:outline-none" />
                </div>
                <div>
                    <label  for="password" class="sr-only">Password</label> 
                    <input	type="password" 
                            id="password" 
                            value="" 
                            name="password"
                            placeholder="Password"
                            class="w-full mb-10 p-2 bg-transparent border-b-2 tracking-wider placeholder:text-primary-black placeholder:tracking-widest focus:outline-none" />
                </div>
                    <div class="mb-10 flex flex-col gap-4 items-center justify-center min-[500px]:flex-row">
                    <a href="index.php" class="w-[230px] p-button rounded-lg bg-black text-center text-white uppercase hover:bg-[#4a4a4a]"><p>Go back</p></a>
                    <input type="submit" value="Submit" class="btn-blue w-[230px] tracking-widest uppercase"/>	
                </div>
            </form>
            <p class='tracking-wider'>If you don't have an account yet, please talk to one of your current admins.</p>
        </section>
    </main>
    
</body>
</html>