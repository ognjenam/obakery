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

                <?php


                if($user_role == 1){


                ?>
                <img src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/o_bakery/assets/admin/assets/images/profile.jpg" alt="profile">

                <?php
              }

              else {

                ?>

                  <img src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/o_bakery/assets/admin/assets/images/user.jpg" alt="profile">
                <?php

              }
                ?>
              </div>
              <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2"><?= $username?></span>
                <span class="text-secondary text-small">
                  <?php
                  if($user_role == 1){

                  ?>
                  <span class="font-weight-bold mb-2">admin</span>

                  <?php
                }
                else {



                  ?>

                  <span class="font-weight-bold mb-2">user</span>

                  <?php

                }?>
                </span>
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











        </ul>
      </nav>

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title"> Dashboard </h3>

          </div>
