


    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Add a product</h4>
            <form class="form-sample">
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                      <input type="text" id="add_name_prod" class=" add_space_between form-control" />
                      <span class="input-group-append" id="regErrorAddProductName"></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Price</label>
                    <div class="col-sm-9">
                      <input type="text" id="add_price_prod" class="add_space_between form-control" />
                      <span  class="input-group-append" id="regErrorAddProductPrice"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                      <select id="dropdown_categories" class="add_space_between text-capitalize form-control">
                        <option>Choose...</option>

                        <?php


                        foreach($allCategories as $category){?>

                          <option value='<?= $category -> category_ID?>'><?= $category -> name?></option>
                        <?php }?>


                      </select>
                      <span  class="input-group-append" id="regErrorAddProductCat"></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                      <input type="text" id="add_descr_prod" class="add_space_between form-control" />
                      <span  class="input-group-append" id="regErrorAddProductDescr"></span>

                    </div>

                  </div>

                </div>

              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Image</label>
                    <div class="col-sm-9">
                      <input type="file" id="image_add_product" name="" value="">
                      <div class="add_space_between input-group col-xs-9">
                        <input type="text" id="img_path" class="form-control file-upload-info" disabled placeholder="Max 2MB">
                        <span class=" input-group-append">
                          <button id = "btn_add_image" class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>


                        </span>

                      </div>

                        <span class="input-group-append" id="regErrorAddProductImg"></span>


                    </div>

                  </div>
                  <button type="button" id="btn_add_a_product" class="btn btn-gradient-primary mb-2">Add</button>
                </div>

              </div>



              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
