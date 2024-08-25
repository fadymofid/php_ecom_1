<?php
include_once '../includes/header.php';


session_start();
include_once('../includes/header.php');
include_once('../includes/db.php');
include('../models/UserModel.php');


$sortOrder = isset($_POST['sort']) ? $_POST['sort'] : 'ASC';


$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';


if ($searchTerm) {
    $data = search_users($searchTerm);
} else {
    $data = get_users($sortOrder);
}


echo '<form method="POST" action="" class="mb-3">';
echo '<input type="text" name="search" value="' . $searchTerm . '" placeholder="Search by name" class="form-control" style="width: 300px; display: inline-block; margin-right: 10px;">';
echo '<button type="submit" class="btn btn-primary">Search</button>';
echo '</form>';


echo '<form method="POST" action="" class="mb-3">';
echo '<input type="hidden" name="search" value="' . $searchTerm . '">'; // Maintain the search term if present
echo '<button type="submit" name="sort" value="ASC" class="btn btn-primary">Ascending</button> ';
echo '<button type="submit" name="sort" value="DESC" class="btn btn-secondary">Descending</button>';
echo '</form>';

if (!empty($data)) {
    echo '<table class="table table-striped">';
    echo '<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Password</th><th>Address</th></tr></thead><tbody>';
    foreach ($data as $row) {
        echo '<tr><td>'.$row['id'].'</td><td>'.$row['Name'].'</td><td>'.$row['email'].'</td><td>'.$row['password'].'</td><td>'.$row['address'].'</td></tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<p>No users found</p>';
}

include('../includes/footer.php');
?>
