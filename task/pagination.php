<?php 
session_start(); 
include('nav.php');
include('connect_db.php');
$num_per_page =5;

if (isset($_GET["page"])) {
    $page = (int)$_GET["page"]; // Ensure that $page is an integer
} else {
    $page = 1;
}

$start_from = ($page - 1) * $num_per_page;

$sql = "SELECT * FROM users LIMIT $start_from, $num_per_page";
$rs_result = mysqli_query($con, $sql);
?>

<html>

<style>
.pagination-link {
  color: blueviolet;
  text-decoration: none;
  background-color: blue;
  margin: 5px;
}

.pagination-link:hover {
  text-decoration: underline;
}
</style>

<table align="center" border="1px">
    <tr>
        <th> First Name</th>
        <th> Last Name</th>
    </tr>

    <?php 
    while($rows=mysqli_fetch_assoc($rs_result))
    {?>
        <tr>
            <td><?= $rows['FirstName']?></td>
            <td><?= $rows['LastName']?></td>

        </tr>

    <?php } ?>
  
</table>


<?php
    $sql = "SELECT COUNT(*) as count FROM users";
    $rs_result = mysqli_query($con, $sql);

    if ($rs_result) {
        $row = mysqli_fetch_assoc($rs_result);
        $total_records = $row['count'];
    
    } else {
        echo "Error executing the query: " . mysqli_error($con);
    }
    $total_pages = ceil($total_records/$num_per_page);

    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<span class='pagination-link'><a href='contact.php?page=".$i."'>".$i."</a></span>";
    }

?>
</html>