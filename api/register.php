<?php
include("connect.php");

$name = $_POST['name'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$password = $_POST['password'];
$c_password = $_POST['confirm_password'];
$address = $_POST['address'];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];

if ($password == $c_password) {
    move_uploaded_file($tmp_name, "../uploads/$image");
    $insert = mysqli_query($connect, "INSERT INTO user (name, mobile, email, password, address, photo, role, status, votes) VALUES ('$name','$mobile','$email','$password','$address','$image','$role',0,0)");
    if ($insert) {
        echo '
        <script>
           alert("Registration Successful!");
           window.location = "../";
        </script>
        ';
    } else {
        echo '
        <script>
           alert("Some error occurred!");
           window.location = "../views/register.html";
        </script>
        ';
    }
} else {
    echo '
    <script>
        alert("Password and Confirm Password do not match!");
        window.location = "../views/registration.html";
    </script>
    ';
}
?>
