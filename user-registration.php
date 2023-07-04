<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
            <h1 class="uppercase font-bold text-2xl text-center">Please fill out the following form to create a new account</h1>
            <div class='min-h-[40px] mt-4 text-red tracking-wider'>
                <?php 
                if( isset($_SESSION['errorMessages']) ) {
                    foreach($_SESSION['errorMessages'] as $error) {
                        echo "<p>$error</p>";
                    }
                }
                ?>
            </div>
            <form action="user-registration-processing.php" method="post">
                <fieldset>

                    <label for="userFirstName" class="sr-only">First Name:</label>
                    <input type="text" name="userFirstName" id="userFirstName" 
                            value="<?php 
                                        if( isset($_SESSION['errorMessages']) && isset($_SESSION['enteredFirstName']) ) {
                                            echo $_SESSION['enteredFirstName'];
                                            $_SESSION['enteredFirstName'] ="";
                                        }; 
                                    ?>"
                            placeholder="First Name"
                            class="w-full mb-10 p-2 bg-transparent border-b-2 tracking-wider placeholder:text-primary-black placeholder:tracking-widest focus:outline-none sm:w-[49%]" />

                    <label for="userLastName" class="sr-only">Last Name:</label>
                    <input type="text" name="userLastName" id="userLastName" 
                            value="<?php 
                                        if( isset($_SESSION['errorMessages']) && isset($_SESSION['enteredLastName']) ) {
                                            echo $_SESSION['enteredLastName'];
                                            $_SESSION['enteredLastName'] ="";
                                        }; 
                                    ?>"
                            placeholder="Last Name"
                            class="w-full mb-10 p-2 bg-transparent border-b-2 tracking-wider placeholder:text-primary-black placeholder:tracking-widest focus:outline-none sm:w-[49%]" />

                    <label for="username" class="sr-only">Username:</label>
                    <input type="text" name="username" id="username" 
                    value="<?php 
                                if( isset($_SESSION['errorMessages']) && isset($_SESSION['enteredUsername']) ) {
                                    echo $_SESSION['enteredUsername'];
                                    $_SESSION['enteredUsername'] = "";
                                }; 
                            ?>"
                    placeholder="Username"
                    class="w-full mb-10 p-2 bg-transparent border-b-2 tracking-wider placeholder:text-primary-black placeholder:tracking-widest focus:outline-none sm:w-[49%]" />

                    <label for="email" class="sr-only">Email:</label>
                    <input type="email" name="email" id="email" 
                            value=" <?php 
                                        if( isset($_SESSION['errorMessages']) && isset($_SESSION['enteredEmail']) ) {
                                            echo $_SESSION['enteredEmail'];
                                            $_SESSION['enteredEmail'] ="";
                                        }; 
                                        unset($_SESSION['errorMessages']);
                                    ?>"
                            placeholder="Email"
                            class="w-full mb-10 p-2 bg-transparent border-b-2 tracking-wider placeholder:text-primary-black placeholder:tracking-widest focus:outline-none sm:w-[49%]" />

                    <label for="password" class="sr-only">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="w-full mb-10 p-2 bg-transparent border-b-2 tracking-wider placeholder:text-primary-black placeholder:tracking-widest focus:outline-none sm:w-[49%]" />

                    <label for="passwordRetyped" class="sr-only">Re-type password:</label>
                    <input type="password" name="passwordRetyped" id="passwordRetyped" placeholder="Re-type Password" class="w-full mb-10 p-2 bg-transparent border-b-2 tracking-wider placeholder:text-primary-black placeholder:tracking-widest focus:outline-none sm:w-[49%]" />

                    <div class="mb-10 flex flex-col gap-4 items-center justify-center min-[500px]:flex-row">
                        <a href="index.php" class="w-[230px] p-button rounded-lg bg-black text-center uppercase text-white"><p>Cancel</p></a>
                        <input type="submit" value="Submit" class="btn-blue w-[230px] tracking-widest uppercase"/>
                    </div>
                </fieldset>
            </form>
            <p class="tracking-wider text-center">Already have an account? Click <a href="user-login.php" class="border-b-[3px] border-solid border-accent">here</a> to login</p>
        </section>
    </main>
</body>
</html>