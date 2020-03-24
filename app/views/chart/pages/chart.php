


    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Chart</h4>
            <div class="table-responsive">
            <table class="  table table-bordered">
              <thead>
                <tr>
                  
                  <th><b> Product name</b> </th>
                  <th><b> Price </b></th>
                  <th><b> User </b></th>
                  <th><b> Date</b> </th>
                </tr>
              </thead>
              <tbody id="chart_user">


                <?php foreach($chart as $c){?>

                  <tr>

                    <td class="text-capitalize "><?= $c -> productName?></td>
                    <td><?= $c -> productPrice?></td>
                    <td><img src="/o_bakery/assets/images/<?=$c -> productImage?>" alt="<?= $c -> productName?>"></td>
                    <td><?= $c -> date?></td>




                      <td>

                    <button id='remove_from_chart_btn' type='button' data-id="<?= $c -> product_user_ID ?>" class=" btn btn-block btn-lg btn-gradient-primary mt-4"><a> Remove </a> </button>


                  </td>

                </tr>

                <?php
              }

                ?>






              </tbody>

            </table>


            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
