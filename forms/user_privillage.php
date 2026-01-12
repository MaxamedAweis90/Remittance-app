<?php
require_once('../tools/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = (int)$_POST['user_id'];
    ?>

    <form id="permission-form" method="POST">
        <input type="hidden" name="user_id" value="<?= $user_id ?>">

        <div class="row mt-2">
            <?php 
            $sql = "SELECT c.cat_id, c.cat_name 
                    FROM categories c 
                    JOIN forms f ON c.cat_id = f.cat_id 
                    GROUP BY c.cat_id 
                    ORDER BY c.cat_id;";
            $cat = $conn->query($sql);
            while ($row = $cat->fetch_array()) {
                $cat_id = (int)$row[0];
                ?>
                <div class="col-md-3">
                    <div class="permission-card">
                        <div class="permission-title checkbox-lg">
                            <input type="checkbox" class="main-checkbox" id="cat-<?= $cat_id ?>" data-cat-id="<?= $cat_id ?>">
                            <label for="cat-<?= $cat_id ?>" class="text-primary"><?= htmlspecialchars($row[1]) ?></label>
                        </div>
                        <div class="sub-permission checkbox-lg">
                            <?php 
                            $sql1 = "SELECT f.form_id, f.form_name, up.user_id 
                                     FROM forms f 
                                     JOIN categories c ON c.cat_id = f.cat_id AND f.cat_id = $cat_id 
                                     LEFT JOIN user_privillage up ON up.form_id = f.form_id AND up.user_id = $user_id 
                                     ORDER BY f.form_id";
                            $form = $conn->query($sql1);
                            while ($row1 = $form->fetch_array(MYSQLI_ASSOC)) {
                                $checked = $row1['user_id'] ? 'checked' : '';
                                $form_id = (int)$row1['form_id'];
                                $input_id = "form-{$cat_id}-{$form_id}";
                                ?>
                                <div>
                                    <input type="checkbox"
                                           class="sub-checkbox"
                                           id="<?= $input_id ?>"
                                           name="permissions[]"
                                           value="<?= $form_id ?>"
                                           <?= $checked ?>>
                                    <label for="<?= $input_id ?>" class="text-secondary"><?= htmlspecialchars($row1['form_name']) ?></label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="text-start mt-2">
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" id="check-all" class="btn btn-primary">Check All</button>
            <button type="button" id="uncheck-all" class="btn btn-secondary">Uncheck All</button>
        </div>
    </form>

    <script>
        // Check all checkboxes
        document.getElementById('check-all').addEventListener('click', () => {
            document.querySelectorAll('#permission-form input[type="checkbox"]').forEach(cb => cb.checked = true);
        });

        // Uncheck all checkboxes
        document.getElementById('uncheck-all').addEventListener('click', () => {
            document.querySelectorAll('#permission-form input[type="checkbox"]').forEach(cb => cb.checked = false);
        });

        // When main checkbox toggled, toggle all sub-checkboxes in the same card
        document.querySelectorAll('.main-checkbox').forEach(mainCheckbox => {
            mainCheckbox.addEventListener('change', e => {
                const container = e.target.closest('.permission-card');
                if (!container) return;
                const subCheckboxes = container.querySelectorAll('.sub-checkbox');
                subCheckboxes.forEach(cb => cb.checked = e.target.checked);
            });

            // On page load, set main checkbox checked if all sub-checkboxes are checked
            const container = mainCheckbox.closest('.permission-card');
            if (container) {
                const subCheckboxes = container.querySelectorAll('.sub-checkbox');
                mainCheckbox.checked = Array.from(subCheckboxes).every(cb => cb.checked);
            }
        });

        // When any sub-checkbox is toggled, update main checkbox accordingly
        document.querySelectorAll('.sub-checkbox').forEach(subCheckbox => {
            subCheckbox.addEventListener('change', e => {
                const container = e.target.closest('.permission-card');
                if (!container) return;
                const mainCheckbox = container.querySelector('.main-checkbox');
                const subCheckboxes = container.querySelectorAll('.sub-checkbox');
                mainCheckbox.checked = Array.from(subCheckboxes).every(cb => cb.checked);
            });
        });
    </script>

<?php
} else {
    echo '<div class="alert alert-danger">Invalid Request: user_id is required.</div>';
}
?>
