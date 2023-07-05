<?php
session_start();
if (!isset($_SESSION['userdata'])) {
  header("location:../");
  exit(); // Add an exit statement to stop further execution
}

$userdata = $_SESSION['userdata']; // Assign the session data to $userdata
$groupsdata = $_SESSION['groupsdata']; // Assign the session data to $groupsdata

$status = isset($_SESSION['userdata']['status']) && $_SESSION['userdata']['status'] == 0 ? '<b style="color:red">Not Voted</b>' : '<b style="color:green">Voted</b>';

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
</head>
<body>
  <center>
    <div id="mainSection">
      <div id="header-section">
        <a href="../"><button id="backbtn">Back</button></a>
        <a href="logout.php"><button id="logoutbtn">Logout</button></a>
        <h1>Online voting system</h1>
      </div>
    </div>
  </center>
  <hr>
  <div id="profileSection">
    <?php if ($userdata && isset($userdata['photo'])) : ?>
      <center><img src="../uploads/<?php echo $userdata['photo']; ?>" height="100" width="100"></center><br>
    <?php endif; ?>
    <b>NAME:</b> <?php echo $userdata['name'] ?? ''; ?> <br><br>
    <b>Email:</b> <?php echo $userdata['email'] ?? ''; ?> <br><br>
    <b>Mobile:</b> <?php echo $userdata['mobile'] ?? ''; ?> <br><br>
    <b>Address:</b> <?php echo $userdata['address'] ?? ''; ?> <br><br>
    <b>Status:</b> <?php echo $status ?> <br><br>
  </div>
  <div id="Group">
    <?php
    if ($_SESSION['groupsdata']) {
      for ($i = 0; $i < count($groupsdata); $i++) {
        ?>
        <div style="border-bottom: 1px solid #bdc3c7; margin-bottom: 10px">
          <img src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100px" width="100px">
          <b>Group Name <?php echo $groupsdata[$i]['name'] ?></b><br>
          <b>Votes <?php echo $groupsdata[$i]['votes'] ?></b><br>
          <form action="../api/vote.php" method="POST">
            <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
            <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
            <?php if (isset($_SESSION['userdata']['status']) && $_SESSION['userdata']['status'] == 1): ?>
              <button disabled style="padding: 5px; font-size: 15px; background-color: #27ae60; color: white; border-radius: 5px;" type="button">Voted</button>
            <?php else: ?>
              <button style="padding: 5px; font-size: 15px; background-color: #3498db; color: white; border-radius: 5px;" type="submit">Vote</button>
            <?php endif; ?>
          </form>
        </div>
      <?php
      }

    } else {
      ?>
      <div style="border-bottom: 1px solid #bdc3c7; margin-bottom: 10px">
        <b>No groups available right now.</b>
      </div>
    <?php

    }
    ?>
  </div>
</body>
</html>
