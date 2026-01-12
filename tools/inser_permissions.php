<?php
session_start();
require_once('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['u_br_id']) && isset($_SESSION['secure'])) {
    $u_br_id = (int) $_POST['u_br_id'];
    $permissions = isset($_POST['permissions']) ? $_POST['permissions'] : [];
    $granted_user = $_SESSION['secure'];

    // 1. Delete previous permissions
    mysqli_query($conn, "DELETE FROM user_privillage WHERE user_id = $u_br_id");

    // 2. Insert new permissions
    foreach ($permissions as $li_pr_id) {
        $li_pr_id = (int) $li_pr_id;
        $query = "INSERT INTO user_privillage (form_id, user_id, granted_user) 
                  VALUES ($li_pr_id, $u_br_id,'$granted_user')";
        mysqli_query($conn, $query);
    }

    echo 'Permissions successfully updated';
} else {
    echo 'Invalid data or session expired';
}
?>
