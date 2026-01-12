<?php
include("tools/conn.php");
session_start();
if (isset($_SESSION["secure"])) {
?>
  <!DOCTYPE html>
  <html lang="en">
  <?php include("tools/header.php") ?>

  <body>
    <div class="wrapper ">
      <!-- Sidebar -->
      <?php include('tools/sidebar.php') ?>
      <!-- End Sidebar -->

      <div class="main-panel ">
        <!-- End Sidebar -->
        <?php include('tools/navbar.php') ?>
        <!-- End Sidebar -->
        <?php include('tools/home.php') ?>

        <footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
            <nav class="pull-left">
              <ul class="nav">
                <li class="nav-item">
                    Remittance System
                  </a>
                </li>
              </ul>
            </nav>
            <div class="copyright">
              2025, made with Caynanshe
            </div>
            <div>
              Developed by Caynanshe
            </div>
          </div>
        </footer>
      </div>

     
    </div>
    <!--   Core JS Files   -->
    <?php include('tools/modal_report.php') ?>
    <?php include('tools/footer.php') ?>
    <?php include('js/js.php') ?>
  </body>

  </html>
<?php
} else {
  header('location:login.php');
}
?>