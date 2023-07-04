<?php 
require_once("user-security-guard.php");
include 'appointment-library.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an appointment</title>
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
    <main class="p-8">
        <section class="overflow-auto p-6 bg-[#e3e3e3] rounded-xl">
            <h1 class="mb-2 font-bold text-4xl">Select a date</h1>
            <div class="min-h-[30px]">
            <?php 
                if( isset($_SESSION['errorMessages']) ) {
                    foreach($_SESSION['errorMessages'] as $error) {
                        echo "<p class='text-red'>$error</p>";
                    }
                }
                unset($_SESSION['errorMessages']);
            ?>
            </div>
            <table class="border-separate border-spacing-1">
                <tr>
                    <th></th>
                    <?php 
                    // Get the appointment times and display it has the table header.
                    foreach( $display_app_slots as $slot ) {
                        echo "<th>$slot</th>";
                    }
                    ?>
                </tr>
                <?php
                // Get the appointment dates and store it in the x axis.
                for ( $unix = $start; $unix <= $end; $unix += 86400) {
                    $thisDate = date("Y-m-d", $unix);
                    echo "<tr><th class='inline-block w-[180px] py-1'>$thisDate</th>";

                    foreach( $app_slots as $slot ) {
                        if ( isset($allAppointments[$thisDate][strval($slot)]) ) {
                            echo "<td class='py-0 text-center bg-primary-black text-white'>Booked</td>";
                        }else {
                            echo "<td onclick=\"select(this, '$thisDate', '$slot')\" class='cursor-pointer bg-[#a8a8a8]'></td>";
                        }
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </section>
        <section class="p-6 rounded-xl ">
        <h2 class="text-2xl font-bold mb-6">Confirm</h2>
        <form method="post" action="user-add-slot.php" class="sm:flex sm:gap-4 sm:items-start">
            <input type="text" name="date" id="date" readonly placeholder="Select a time slot above" class="w-full max-w-[325px] inline-block mb-10 p-2 bg-transparent border-b-2 tracking-wider placeholder:text-primary-black placeholder:tracking-widest focus:outline-none min-[450px]:w-[48%] sm:w-[33%]">
            <input type="text" name="time" id="time" readonly class="w-full max-w-[325px] inline-block mb-10 p-2 bg-transparent border-b-2 tracking-wider placeholder:text-primary-black placeholder:tracking-widest focus:outline-none min-[450px]:w-[48%] sm:w-[33%]">
            <div class="sm:h-[45px] sm:flex items-end gap-3">
                <input type="submit" id="confirm-slot" value="Submit" disabled class="btn-blue w-[230px] block mx-auto mb-4 tracking-widest uppercase cursor-pointer sm:w-[130px] sm:px-0 sm:py-1 sm:mb-0">
                <a href="logout.php" class="block w-[230px] mx-auto p-button rounded-lg bg-black text-center uppercase text-white hover:bg-[#4a4a4a] sm:w-[130px] sm:px-0 sm:py-1">Cancel</a>
            </div>
        </form>
        </section>
    </main>

<script src="scripts/user-booking.js"></script>
</body>
</html>