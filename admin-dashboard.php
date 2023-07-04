<?php 
require_once("admin-security-guard.php");
include 'admin-appointments-users.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
    <main class="p-4 grid grid-cols-1 min-[900px]:grid-cols-[300px_1fr] min-[900px]:px-12">
        <section class="rounded-lg min-[900px]:row-start-2 min-[900px]:row-end-3 min-[900px]:min-h-[80vh] min-[900px]:bg-light-gray min-[900px]:mr-4 min-[900px]:p-4">
            <h1 class="my-4 font-bold text-2xl min-[900px]:mb-16 min-[900px]:mt-0">&#128075 Logged in as <span class="inline font-bold text-accent min-[900px]:block "><?php echo $_SESSION['username'] ?></span></h1>
            <nav class="w-[90%] fixed bottom-8 left-0 right-0 mx-auto px-6 py-2 rounded-lg bg-light-gray text-primary-black min-[900px]:static min-[900px]:bg-transparent min-[900px]:px-0 min-[900px]:mx-0">
                <ul class="flex justify-around min-[900px]:block">
                    <li onclick="displayAppointments()" class="cursor-pointer uppercase min-[900px]:mb-8 hover:text-hover-gray">
                        <svg class="inline align-middle fill-accent" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 20h-4v-4h4v4zm-6-10h-4v4h4v-4zm6 0h-4v4h4v-4zm-12 6h-4v4h4v-4zm6 0h-4v4h4v-4zm-6-6h-4v4h4v-4zm16-8v22h-24v-22h3v1c0 1.103.897 2 2 2s2-.897 2-2v-1h10v1c0 1.103.897 2 2 2s2-.897 2-2v-1h3zm-2 6h-20v14h20v-14zm-2-7c0-.552-.447-1-1-1s-1 .448-1 1v2c0 .552.447 1 1 1s1-.448 1-1v-2zm-14 2c0 .552-.447 1-1 1s-1-.448-1-1v-2c0-.552.447-1 1-1s1 .448 1 1v2z"/></svg>
                        <span class="hidden align-middle min-[900px]:inline">Appointments</span>
                    </li>
                    <li onclick="displayAdminAccounts()" class="cursor-pointer uppercase min-[900px]:mb-8 hover:text-hover-gray">
                        <svg class="inline align-middle fill-accent" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 7.001c0 3.865-3.134 7-7 7s-7-3.135-7-7c0-3.867 3.134-7.001 7-7.001s7 3.134 7 7.001zm-1.598 7.18c-1.506 1.137-3.374 1.82-5.402 1.82-2.03 0-3.899-.685-5.407-1.822-4.072 1.793-6.593 7.376-6.593 9.821h24c0-2.423-2.6-8.006-6.598-9.819z"/></svg>
                        <span class="hidden align-middle min-[900px]:inline">Admins</span>
                    </li>
                    <li>
                        <a href="logout.php" class="uppercase align-middle min-[900px]:mb-4 hover:text-hover-gray">
                            <svg class="inline align-middle fill-accent" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8 9v-4l8 7-8 7v-4h-8v-6h8zm2-7v2h12v16h-12v2h14v-20h-14z"/></svg> 
                            <span class="hidden align-middle min-[900px]:inline">Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </section>
        <section class="mb-4 text-red tracking-wider min-[900px]:col-start-2 min-[900px]:col-end-3">
            <?php 
                if( isset($_SESSION['errorMessages']) ) {
                    foreach($_SESSION['errorMessages'] as $error) {
                        echo "<p>$error</p>";
                    }
                }
                unset($_SESSION['errorMessages']);
            ?>
        </section>
        <section class="appointments-tab h-[55vh] p-4 rounded-lg bg-light-gray overflow-auto min-[900px]:col-start-2 min-[900px]:col-end-3 min-[900px]:row-start-2 min-[900px]:row-end-3 min-[900px]:min-h-[80vh]">
            <h2 class="mb-8 uppercase font-bold text-xl" >Scheduled Appointments</h2>
            <table class="text-center">
                <tr class='border-b-2 border-primary-black border-solid tracking-wider'>
                    <th>User ID</th>
                    <th>Patient First Name</th>
                    <th>Patient Last Name</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                </tr>
                <?php 
                if( isset($allAppointments) ) {
                    foreach( $allAppointments as $appointment) {
                        echo "<tr>";
                        echo "<td>".$appointment[2]."</td>";
                        echo "<td>".$appointment[3]."</td>";
                        echo "<td>".$appointment[4]."</td>";
                        echo "<td>".$appointment[0]."</td>";
                        echo "<td>".$appointment[1]."</td>";
                        echo "<td><button onclick=\"confirmAppDelete('$appointment[3]', '$appointment[4]', '$appointment[0]', '$appointment[1]')\"><svg class='fill-primary-black align-middle' width='24' height='24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M19 24h-14c-1.104 0-2-.896-2-2v-16h18v16c0 1.104-.896 2-2 2m-9-14c0-.552-.448-1-1-1s-1 .448-1 1v9c0 .552.448 1 1 1s1-.448 1-1v-9zm6 0c0-.552-.448-1-1-1s-1 .448-1 1v9c0 .552.448 1 1 1s1-.448 1-1v-9zm6-5h-20v-2h6v-1.5c0-.827.673-1.5 1.5-1.5h5c.825 0 1.5.671 1.5 1.5v1.5h6v2zm-12-2h4v-1h-4v1z'/></svg></button></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </section>

        <section class="accounts-tab relative h-[55vh] p-4 rounded-lg bg-light-gray overflow-auto min-[900px]:col-start-2 min-[900px]:col-end-3 min-[900px]:row-start-2 min-[900px]:row-end-3 min-[900px]:min-h-[80vh]">
            <h2 class="mb-8 uppercase font-bold text-xl">Manage Admin Accounts</h2>
            <table class="text-center">
                <tr class='border-b-2 border-primary-black border-solid tracking-wider'>
                    <th>Admin ID</th>
                    <th>Admin Username</th>
                    <th>Admin Email</th>
                </tr>
                <?php 
                if( isset($allAdminUsers) ) {
                    foreach( $allAdminUsers as $admin) {
                        $selectedAdminUsername = $admin['admin_username'];
                        echo "<tr>";
                        echo "<td>".$admin['admin_id']."</td>";
                        echo "<td>".$admin['admin_username']."</td>";
                        echo "<td>".$admin['admin_email']."</td>";
                        echo "<td><button onclick=\"confirmAdminDelete('$selectedAdminUsername')\"><svg class='fill-primary-black align-middle' width='24' height='24' xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' clip-rule='evenodd'><path d='M19 24h-14c-1.104 0-2-.896-2-2v-16h18v16c0 1.104-.896 2-2 2m-9-14c0-.552-.448-1-1-1s-1 .448-1 1v9c0 .552.448 1 1 1s1-.448 1-1v-9zm6 0c0-.552-.448-1-1-1s-1 .448-1 1v9c0 .552.448 1 1 1s1-.448 1-1v-9zm6-5h-20v-2h6v-1.5c0-.827.673-1.5 1.5-1.5h5c.825 0 1.5.671 1.5 1.5v1.5h6v2zm-12-2h4v-1h-4v1z'/></svg></button></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
            <p class="absolute bottom-4 right-4">
                <a href="add-admin-account.php" class="inline-block uppercase w-fit">
                    <svg class="fill-primary-black min-[800px]:inline-block" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" width="40px" height="auto" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z" fill-rule="nonzero"/></svg>
                    <span class="hidden min-[800px]:inline">Add account</span>
                </a>
            </p>
        </section>
    </main>
<script src="scripts/display-section.js"></script>
<script src="scripts/confirm-delete.js"></script>
</body>
</html>