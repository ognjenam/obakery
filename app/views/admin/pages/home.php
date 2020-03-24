


    <div class="row">
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Visits 2020</h4>
            <canvas id="pieChart" style="height:250px"></canvas>



          </div>
        </div>
      </div>

      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Activities</h4>

            <div class="table-responsive">
            <table id="activity_form_data" class="table table-bordered">
              <thead>
                <tr>

                  <th><b> User</b> </th>
                  <th><b> Date </b></th>
                  <th><b> IP address </b></th>
                  <th><b> URL address </b></th>
                </tr>
              </thead>
              <tbody id="user_visits">


                <?php

                foreach($data as $d){
                  ?>
                  <tr>
                  <?php
                  $one_row = explode("\t", $d);
                  foreach($one_row as $o){
                ?>

                <td><?= $o?></td>

              <?php }
              ?>

            </tr>
              <?php


            }?>


              </tbody>
            </table>
          </div>




          </div>
        </div>
      </div>


    </div>
