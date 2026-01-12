<?php
session_start();
include('../tools/conn.php');
include('../tools/function.php');
$sql = "SELECT * FROM forms  where form_id=$_GET[form_id]";
$ress = $conn->query($sql);
while ($row = $ress->fetch_array()) {
  extract($row)
?>

  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $form_name ?></h1>
    <p class="mb-4"></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <button class="btn btn-secondary " id="add_new">Add <?php echo $form_name ?></button>
        
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <?php
          viewTable("call " . $view_name . "()");
          ?>
        </div>
      </div>
    </div>

  </div>

  <div class="modal modal-lg" tabindex="-1" role="dialog" id="gen_modal">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-primary fw-bold">Add <?php echo $form_name ?></h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo $form_action ?>" method="post" id="gen_form" enctype="multipart/form-data">
            <input type="hidden" name="sp" class="form-control text-secondary fw-bold sp" value="<?php echo $sp_name ?>">
            <div class="form-group row">
              <?php
              $sql1 = "SELECT * FROM form_input  where form_id=$_GET[form_id]";
              $ress1 = $conn->query($sql1);
              while ($row1 = $ress1->fetch_array()) {
                extract($row1);
                if ($type == "user_id") {
              ?>
                  <input type="hidden" class="form-control text-secondary fw-bold" name="<?php echo $name ?>" value="<?php echo $_SESSION['secure'] ?>">
                <?php
                } elseif ($label == "oper") {
                ?>
                    <input type="hidden" class="form-control text-secondary fw-bold oper" name="oper" value="insert">
                  
                <?php
                } elseif ($label == "num") {
                ?>
                    <input type="hidden" class="form-control text-secondary fw-bold num" name="num" value="0">
                <?php
                } elseif ($label == "u_br_id") {
                ?>
                  <input type="hidden" class="form-control text-secondary fw-bold" name="<?php echo $name ?>" value="<?php echo $_SESSION['secure'] ?>">
                <?php
                } elseif ($label == "state") {
                ?>
                  <input type="hidden" class="form-control text-secondary fw-bold" name="<?php echo $name ?>" value="Active">
                <?php
                } elseif ($label == "otp") {
                ?>
                  <input type="hidden" class="form-control text-secondary fw-bold" name="<?php echo $name ?>" value="null">
                <?php
                } elseif ($type == "dropdown") {
                ?>
                  <div class="col-sm-6 mb-3 mb-sm-0 <?php echo $class ?>">
                    <label class="form-lebal text-primary fw-bold ">Choose <?php echo $label ?></label>
                    <select name="<?php echo $name ?>" id="" class="form-control text-secondary fw-bold <?php echo $class ?>">
                      <option value="0" selected>Choose <?php echo $label ?></option>
                      <?php
                      get_dropdown($action);
                      ?>
                    </select>
                  </div>

                <?php
                } elseif ($type == "get_salary") {
                ?>
                  <div class="col-sm-6 mb-3 mb-sm-0 <?php echo $class ?>">
                    <label class="form-lebal text-primary fw-bold ">Choose <?php echo $label ?></label>
                    <select name="<?php echo $name ?>" id="" class="form-control text-secondary fw-bold get_salary">
                      <option value="0" selected>Choose <?php echo $label ?></option>
                      <?php
                      get_dropdown($action);
                      ?>
                    </select>
                  </div>

                <?php
                }elseif ($type == "search") {
                ?>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="form-lebal text-primary fw-bold"><?php echo $label ?></label>
                    <input type="<?php echo $type ?>"  class="form-control text-secondary fw-bold search"
                       action="<?php echo $action ?>" placeholder="<?php echo $placeholder ?>" >
                      <ul class="list-group ul_pro hide" style="list-style: none"></ul>
                      <input class="sp_class" type="hidden" name="<?php echo $name ?>">
                  </div>

                <?php
                }elseif ($type == "view") {
                ?>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="form-lebal text-primary fw-bold"><?php echo $label ?></label>
                    <input type="<?php echo $type ?>"  class="form-control text-secondary fw-bold view"
                       action="<?php echo $action ?>" placeholder="<?php echo $placeholder ?>" required>
                      <ul class="list-group ul_pro hide" style="list-style: none"></ul>
                      <input class="view_sp" type="hidden" name="<?php echo $name ?>">
                  </div>

                <?php
                }elseif ($type == "file") {
                  ?>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label class="form-lebal text-primary fw-bold"><?php echo $label ?></label>
                    <input class="set_image_path" name="<?php echo $name ?>" type="hidden" value="">
                    <input type="file" name="txt_image" class="form-control get_image_path text-secondary fw-bold" required>
                  </div>
              <?php }elseif ($type == "date") {
                  ?>
                  <div class="col-sm-6 mb-3 mb-sm-0 <?php echo $class ?>">
                    <label class="form-lebal text-primary fw-bold  "><?php echo $label ?></label>
                    <input type="<?php echo $type ?>" name="<?php echo $name ?>" class="form-control text-secondary fw-bold <?php echo $class ?>  "
                      id="exampleFirstName" value="<?php echo date('Y-m-d'); ?>" placeholder="<?php echo $placeholder ?>" >
                  </div>
                <?php  
              }elseif ($type == "time") {
                  ?>
                  <div class="col-sm-6 mb-3 mb-sm-0 <?php echo $class ?>">
                    <label class="form-lebal text-primary fw-bold  "><?php echo $label ?></label>
                    <input type="<?php echo $type ?>" name="<?php echo $name ?>" class="form-control text-secondary fw-bold <?php echo $class ?>  "
                      id="exampleFirstName" value="<?php echo date('H:i'); ?>" placeholder="<?php echo $placeholder ?>" >
                  </div>
                <?php  
              }elseif ($type == "set_salary") {
                  ?>
                  <div class="col-sm-6 mb-3 mb-sm-0 <?php echo $class ?>">
                    <label class="form-lebal text-primary fw-bold  "><?php echo $label ?></label>
                    <input type="number" name="<?php echo $name ?>" class="form-control text-secondary fw-bold set_salary"
                      id="exampleFirstName" value="<?php echo date('H:i'); ?>" placeholder="<?php echo $placeholder ?>" >
                  </div>
                <?php  
              }else {
                ?>
                  <div class="col-sm-6 mb-3 mb-sm-0 <?php echo $class ?>">
                    <label class="form-lebal text-primary fw-bold  "><?php echo $label ?></label>
                    <input type="<?php echo $type ?>" name="<?php echo $name ?>" class="form-control text-secondary fw-bold <?php echo $class ?>  "
                      id="exampleFirstName" value="" placeholder="<?php echo $placeholder ?>" >
                  </div>
              <?php }
              } ?>

            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="btn_save">Save</button>
              <button type="button" class="btn btn-primary hide" id="btn_update">Update</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

<?php } ?>




<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-white">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
          aria-label="Close">&times;</button>
      </div>
      <div class="modal-body">
        <p class="mb-0 text-primary">Are you sure you want to delete this data? Note: This action cannot be undone.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirmDelete">Delete</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content p-2 border-0" style="background: transparent; box-shadow: none;">
      <div class="border border-3 border-primary rounded-4 shadow-lg bg-white p-1">
        <img id="previewImage" class="modal-img" src="" alt="Image Preview" style="width: 100%; border-radius: 0.75rem; transition: all 0.3s ease;">
      </div>
    </div>
  </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Order Images</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex flex-wrap justify-content-start" id="imageGallery">
        <!-- Images will be inserted here -->
      </div>
    </div>
  </div>
</div>


<style>
  .hide {
    display: none;
  }

  .modal-img {
    transition: all 0.3s ease;
  }

  .preview-trigger:hover {
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
  }

  #imageGallery img:hover {
    transform: scale(1.05);
    transition: 0.3s;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  }
</style>
<script>
  $("#add_new").click(function() {
    $("#gen_form").trigger('reset');
    $("#gen_modal").modal('show');
    $("#btn_update").addClass("hide");
    $("#btn_save").removeClass("hide");
  })

  $(document).on('change', '.get_image_path', function() {
    var path = $(this).val();
    var real_path = 'uploads/'+ path.replace(/C:\\fakepath\\/, '');
    // alert(real_path);
    $(".set_image_path").val(real_path);
  });

  $(document).ready(function() {
    $("#basic-datatables").DataTable({});

    $("#multi-filter-select").DataTable({
      pageLength: 5,
      initComplete: function() {
        this.api()
          .columns()
          .every(function() {
            var column = this;
            var select = $(
                '<select class="form-select"><option value=""></option></select>'
              )
              .appendTo($(column.footer()).empty())
              .on("change", function() {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                column
                  .search(val ? "^" + val + "$" : "", true, false)
                  .draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function(d, j) {
                select.append(
                  '<option value="' + d + '">' + d + "</option>"
                );
              });
          });
      },
    });

    // Add Row
    $("#add-row").DataTable({
      pageLength: 5,
    });

    var action =
      '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

    $("#addRowButton").click(function() {
      $("#add-row")
        .dataTable()
        .fnAddData([
          $("#addName").val(),
          $("#addPosition").val(),
          $("#addOffice").val(),
          action,
        ]);
      $("#addRowModal").modal("hide");
    });
  });
</script>