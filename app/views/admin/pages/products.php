


    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Products</h4>
            <div class="table-responsive">
            <table class="  table table-bordered">
              <thead>
                <tr>
                  <th> <b>#</b> </th>
                  <th><b> Product name</b> </th>
                  <th><b> Price </b></th>
                  <th><b> Image </b></th>
                  <th><b> Description</b> </th>
                </tr>
              </thead>
              <tbody id="products_admin">

                <?php

                foreach($products as $product) {

                  ?>


                  <tr>
                    <td data-id=<?=$product -> product_ID ?>><?=$product -> product_ID ?></td>
                    <td class="text-capitalize "><?=$product -> name ?></td>
                    <td><?=$product -> price ?></td>
                    <td><img src="/o_bakery/assets/images/<?=$product -> image ?>" alt="<?=$product -> name ?>"></td>
                    <td><?=$product -> info ?></td>
                    <td><button data-id="<?=$product -> product_ID ?>" class="edit_product btn btn-block btn-lg btn-gradient-primary mt-4"><a href='/o_bakery/admin?product_id=<?=$product -> product_ID ?>'>Edit</a></button></td>

                    <?php if($product -> categoryAvailable == 1 ) {

                      ?>

                      <td>
                        <?php
                        if($product -> available == 1 ) { ?>

                        <button data-id="<?=$product -> product_ID ?>" class="delete_product btn btn-block btn-lg btn-gradient-primary mt-4"><a> Available </a> </button>
                      <?php
                    }

                    else {
                    ?>
                    <button data-id="<?=$product -> product_ID ?>" class="delete_product btn btn-block btn-lg btn-gradient-red mt-4"><a> Unavailable </a> </button>

                    <?php
                  }
                    ?>
                  </td>
                <?php }?>
                </tr>




                <?php }?>





              </tbody>

            </table>

            <div id="pagination_list">
              <ul>
              <?php

              $number =   $numberOfProducts -> countAll;
              $links = ceil($number / 5);


              for($i = 1; $i <= $links; $i++)
              {
                ?>
                <li class='list-inline-item'><a  href="/o_bakery/admin/products?page=<?=$i?>"><?= $i ?></a></li>

                <?php
              }



              ?>

            </ul>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
