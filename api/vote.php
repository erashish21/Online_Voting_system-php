<?php
session_start();
include('connect.php');

// Validate and sanitize user input
$votes = isset($_POST['gvotes']) ? intval($_POST['gvotes']) : 0;
$total_votes = $votes + 1;
$gid = isset($_POST['gid']) ? intval($_POST['gid']) : 0;
$uid = isset($_SESSION['userdata']['id']) ? $_SESSION['userdata']['id'] : 0;

// Update votes and user status
$update_votes = mysqli_query($connect, "UPDATE user SET votes = '$total_votes' WHERE id = '$gid'");
$update_user_status = mysqli_query($connect, "UPDATE user SET status =  1 WHERE id = '$uid'");

// Check for update success and proceed accordingly
if ($update_votes && $update_user_status) {
    $groups = mysqli_query($connect, "SELECT * FROM user WHERE role = '2'");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupsdata'] = $groupsdata;

    echo '
    <script>
           alert("Voting successful!");
           window.location = "../views/dashboard.php";
    </script>
    ';
} else {
    echo '
    <script>
           alert("An error occurred!");
           window.location = "../views/dashboard.php";
    </script>
    ';
}
?>
