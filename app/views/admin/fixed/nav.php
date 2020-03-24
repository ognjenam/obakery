<body>
  <div class="container-scroller">
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>

    <div class="container-fluid page-body-wrapper">

      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a  class="nav-link">
              <div class="nav-profile-image">
                <img src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/o_bakery/assets/admin/assets/images/profile.jpg" alt="profile">
                <span class="login-status online"></span>

              </div>

              <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2"><?= $_SESSION['user'] -> username?></span>

                  <?php
                  if($_SESSION['user_role'] == 1) {


                  ?>
                  <span class="text-secondary text-small">admin</span>


                <?php }

                else {

                ?>
                <span class="text-secondary text-small">user</span>
                <?php
              }
                ?>

              </div>
              <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/../o_bakery/home">
              <span class="menu-title">Home</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/o_bakery/admin/categories">
              <span class="menu-title">Categories</span>
              <i class="mdi mdi-apps menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/o_bakery/admin/products">
              <span class="menu-title">Products</span>
              <i class="mdi mdi-apps menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/o_bakery/admin/users">
              <span class="menu-title">Users</span>
              <i class="mdi mdi-account menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              <span class="menu-title">Documentation</span>
              <i class="mdi mdi-file-document menu-icon"></i>
            </a>
          </li>





          <li class="nav-item sidebar-actions">
            <span class="nav-link">
              <div class="border-bottom">

              </div>
              <button id="btn_big_add_a_category" class="btn btn-block btn-lg btn-gradient-primary mt-4"><a href="/o_bakery/admin/add/category">+ Add a category</a></button>
              <button id="btn_big_add_a_product" class="btn btn-block btn-lg btn-gradient-primary mt-4"><a href="/o_bakery/admin/add/product">+ Add a product</a></button


            </span>
          </li>


        </ul>
      </nav>

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title"> Dashboard </h3>

          </div>
