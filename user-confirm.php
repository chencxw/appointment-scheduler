<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <main class="px-4 flex flex-col justify-center items-center min-h-[90vh] text-center">
        <h1 class="mb-4 uppercase font-bold text-2xl sm:text-4xl">Appointment confirmation</h1>
        <h2 class="mb-2 text-xl tracking-wider">Your appointment has been successfully booked!</h2>
        <p><span class="font-bold">Date:</span> <?php echo $_SESSION['app-date']; ?></p>
        <p class="mb-6"><span class="font-bold">Time:</span> <?php echo $_SESSION['app-time']; ?></p>
        <p class="tracking-wider"><a href="logout.php" class="text-xl border-b-[3px] border-solid border-accent hover:text-hover-gray hover:border-accent-light">Click here to logout</a></p>
    </main>

</body>
</html>
<pre>
</pre>