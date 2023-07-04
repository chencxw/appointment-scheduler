<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an Appointment</title>
    <link href="./public/styles.css" rel="stylesheet">
</head>
<body class='tracking-widest'>
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
    <main>
        <div class="px-4 flex flex-col justify-center items-center min-h-[90vh] text-center">
            <h1 class='uppercase font-bold text-3xl min-[400px]:text-4xl'>Appointment Scheduler</h1>
            <section>
                <h2 class='uppercase font-bold text-2xl min-[400px]:text-3xl'>Log In</h2>
                <div class="mt-10 mb-10 flex flex-col justify-center gap-12 min-[500px]:flex-row">
                    <p><a class="btn-blue" href="user-login.php">User Login</a></p>
                    <p><a class="btn-blue" href="admin-login.php">Admin Login</a></p>
                </div>
                <p class="uppercase">Don't have an account? Click <a class="border-b-[3px] border-solid border-accent hover:text-hover-gray hover:border-accent-light" href="user-registration.php">here</a> to create an account</p>
            </section>
        </div>
    </main>
</body>
</html>