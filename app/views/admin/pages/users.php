


    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Users</h4>
            <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th> # </th>
                  <th> Role </th>
                  <th> Username </th>
                  <th> E-mail </th>
                  <th> Date of registration </th>
                  <th> Last visit </th>
                  <th> Active </th>
                </tr>
              </thead>
              <tbody id="users_admin">

                <?php

                $counter = 1;
                foreach($users as $user) {

                  ?>

                  <tr>
                    <td data-id=<?=$user -> user_ID?>> <?= $counter++?>  </td>
                    <td><?=$user -> role?></td>
                    <td><?=$user -> username?></td>
                    <td><?=$user -> e_mail?></td>
                    <td>

                      <?php
                      if($user -> role == 'admin') {

                      ?>

                      -
                    <?php }

                    else {
                      $register_date =  explode(' ',$user -> register_date);
                      echo $register_date[0] . ' ' . $register_date[1];

                      ?>


                      <?php
                    }


                    ?>

                    </td>
                    <td>
                      <?php
                      $last_visit = explode(' ', $user -> last_visit);
                      echo $last_visit[0] . ' ' . $last_visit[1];


                      ?>



                    </td>
                    <td>

                      <?php
                      if($user -> active == 0)
                      {
                        ?>
                        <i class="fa fa-red fa-circle"></i>
                        <?php
                      }
                      else {

                      ?>
                      <i class="fa fa-green fa-circle"></i>

                      <?php
                    }

                      ?>

                    </td>


                <?php }?>

              </tr>



              </tbody>
            </table>
          </div>
          </div>
        </div>
      </div>
    </div>
