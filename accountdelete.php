<?php
include('header.php');
include('db.php');

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle account deletion logic
    $confirm_password = $_POST['confirm_password'];

    // Perform database check (you should use prepared statements and password hashing)
    $sql = "SELECT * FROM tbluser WHERE id='$user_id' AND password='$confirm_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Delete user details from the database
        $delete_sql = "DELETE FROM tbluser WHERE id='$user_id'";
        if ($conn->query($delete_sql) === TRUE) {
            // Logout the user and redirect to the homepage
            session_destroy();
            header("Location: index.php");
            exit();
        } else {
            $error = "Error deleting password: " . $conn->error;
        }
    } else {
        $error = "Account deletion failed. Please check your password.";
    }
}
?>


<body>

    <!-- Sign Up Start -->
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-25 mx-auto flex flex-wrap items-center">
            <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
                <h1 class="title-font font-medium text-3xl text-gray-900">Slow-carb next level shoindcgoitch ethical
                    authentic, poko scenester</h1>
                <p class="leading-relaxed mt-4">Poke slow-carb mixtape knausgaard, typewriter street art gentrify
                    hammock starladder roathse. Craies vegan tousled etsy austin.</p>
            </div>
            <div class="lg:w-2/6 md:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
                <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Sign Up</h2>
                <?php
    // Display error message if registration fails
    if (isset($error)) {
        echo '<p style="color: red;">' . $error . '</p>';
    }
?>
                <form method="post" action="accountdelete.php">
                <div class="relative mb-4">
                    <label for="confirm_password" class="leading-7 text-sm text-gray-600">Confirm Password</label>
                    <input type="password" id="full-name" name="confirm_password" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                </div>
                <button type="submit" value="Delete Account" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Sign Up</button>
                </form>
                <p class="text-xs text-gray-500 mt-3">Literally you probably haven't heard of them jean shorts.</p>
            </div>
        </div>
    </section>
    <!-- Sign Up End -->

    <!-- Footer Start  -->
    <?php
    include 'footer.php';
?>
    <!-- Footer End  -->
</body>