


    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card wrapper-categories">
        <div class="card ">
          <div class="card-body ">
            <h4 class="card-title">Categories</h4>
            <!-- <p class="card-description"> Add class <code>.table-bordered</code>
            </p> -->
            <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th><b> # </b></th>
                  <th><b> Category name</b> </th>
                  <th><b> Total products </b></th>
                </tr>
              </thead>
              <tbody id="categories_admin">

                <?php

                foreach($allCategories as $category){?>
                <tr>
                  <td data-id="<?= $category -> category_ID ?>"><?= $category -> category_ID ?></td>
                  <td class="text-capitalize"><?= $category -> categoryName ?></td>
                  <td><?= $category -> productsNumber ?></td>
                  <td><button data-id="<?= $category -> category_ID ?>"  class="edit_category btn btn-block btn-lg btn-gradient-primary mt-4"><a href="/o_bakery/admin?category_id=<?= $category -> category_ID ?>">Edit</a></button></td><td>
                <?php
                  if($category -> available  == 1)
                  {
                    ?>
                  <button data-id="<?= $category -> category_ID ?>" class="delete_category btn btn-block btn-lg btn-gradient-primary mt-4"><a> Available </a> </button>
                  <?php }

                  else {?>


                  <button data-id="<?= $category -> category_ID ?>" class="delete_category btn btn-block btn-lg btn-gradient-red mt-4"><a> Unavailable </a> </button>
                  <?php }?>


                  </td>
                </tr>


              <?php }?>


              </tbody>
            </table>
          </div>
        </div>
        </div>
      </div>
    </div>
