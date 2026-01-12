<?php
require_once('../tools/conn.php');

// Fetch users for dropdown
$usersQuery = "select u.id,u.username from users u where u.state='Active' order by u.username";
$usersResult = mysqli_query($conn, $usersQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Select User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
	<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-section-title {
        font-size: 1.8rem;
        font-weight: bold;
        color: #343a40;
        margin-bottom: 30px;
        text-align: center;
    }

    .permission-card {
        border: 1px solid #dee2e6;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        padding: 20px 25px;
        margin-bottom: 15px;
        transition: all 0.3s ease-in-out;
    }

    .permission-card:hover {
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .permission-title {
        font-size: 1.15rem;
        font-weight: 600;
        color: #343a40;
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .permission-title input[type="checkbox"] {
        margin-right: 10px;
        transform: scale(1.3);
        accent-color: #007bff;
    }

    .sub-permission {
        padding-left: 30px;
        margin-top: 10px;
    }

    .sub-permission div {
        margin-bottom: 8px;
    }

    .sub-permission input[type="checkbox"] {
        margin-right: 8px;
        transform: scale(1.2);
        accent-color: #17a2b8;
    }

    .sub-permission label {
        font-size: 0.95rem;
        color: #495057;
    }

    .btn {
        padding: 8px 18px;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
    }

   

    @media (max-width: 767px) {
        .permission-card {
            padding: 15px;
        }

        .form-section-title {
            font-size: 1.4rem;
        }
    }
</style>

</head>
<body>
<div class="container-fluid py-5">
   
    <form id="user-selection-form">
        <div class="form-group row">
            <div class="col-sm-3">
                <select id="user_id" name="user_id" class="form-control" required>
                    <option value="" selected="" disabled="" >Select User</option>
                    <?php while ($user = mysqli_fetch_assoc($usersResult)): ?>
                        <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['username']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Show</button>
            </div>
        </div>
    </form>

    <div class="data_found mt-4"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
    $('#user-selection-form').submit(function(e){
        e.preventDefault();
        var userId = $('#user_id').val();
        if (!userId) {
            alert('Please select a user');
            return;
        }
        $.ajax({
            url: 'forms/user_privillage.php',  // the separate data page below
            method: 'POST',
            data: {user_id: userId},
            success: function(res){
                $('.data_found').html(res);
            },
            error: function(){
                $('.data_found').html('<div class="alert alert-danger">Failed to load permissions.</div>');
            }
        });
    });

    // We will attach event handlers dynamically on loaded content, see below
    // Delegated event handling for dynamically loaded permission form
    $('.data_found').on('change', '.main-checkbox', function () {
        var prId = $(this).data('pr-id');
        var checked = $(this).prop('checked');
        $('.sub-checkbox[data-pr-id="' + prId + '"]').prop('checked', checked);
    });

    $('.data_found').on('change', '.sub-checkbox', function () {
        var prId = $(this).data('pr-id');
        var allSubs = $('.sub-checkbox[data-pr-id="' + prId + '"]');
        var allChecked = allSubs.length === allSubs.filter(':checked').length;
        $('.main-checkbox[data-pr-id="' + prId + '"]').prop('checked', allChecked);
    });

    $('.data_found').on('click', '#check-all', function () {
        $('.main-checkbox, .sub-checkbox').prop('checked', true);
    });

    $('.data_found').on('click', '#uncheck-all', function () {
        $('.main-checkbox, .sub-checkbox').prop('checked', false);
    });
});

// Handle permission form submit
$('.data_found').on('submit', '#permission-form', function(e) {
    e.preventDefault();
    var u_br_id = $('input[name="user_id"]').val();

    // Get only checked sub-permissions
    var permissions = [];
    $('.sub-checkbox:checked').each(function () {
        permissions.push($(this).val());
    });

    $.ajax({
        url: 'tools/inser_permissions.php', // save endpoint
        type: 'POST',
        data: {
            u_br_id: u_br_id,
            permissions: permissions
        },
        success: function(response) {
            swal("", response, "success"); // show success or error
        },
        error: function() {
           swal("", "Failed to save permissions", "error");
        }
    });
});



</script>
</body>
</html>
