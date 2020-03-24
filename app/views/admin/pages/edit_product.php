


    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Edit a product</h4>
            <form class="form-sample">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <input id="hidden_product_id" type="hidden" name="" value="<?= $product -> product_ID?>">
                    <div class="col-sm-9">
                      <input type="text" autofocus id="edit_name_prod" value="<?= $product -> name?>" class=" add_space_between form-control" />
                      <span class="input-group-append" id="regErrorEditProductName"></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Price</label>
                    <div class="col-sm-9">
                      <input type="text" id="edit_price_prod" class="add_space_between form-control" value="<?= $product -> price?>"/>
                      <span  class="input-group-append" id="regErrorEditProductPrice"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                      <select disabled id="dropdown_categories_edit" class="add_space_between text-capitalize form-control">
                        <option   selected="selected" value="<?= $product -> category_ID?>"><?= $product -> categoryName?></option>


                      </select>
                      <span  class="input-group-append" id="regErrorEditProductCat"></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                      <input type="text" id="edit_descr_prod" class="add_space_between form-control" value="<?= $product -> info?>"/>
                      <span  class="input-group-append" id="regErrorEditProductDescr"></span>

                    </div>

                  </div>

                </div>

              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">

                    <label class="col-sm-3 col-form-label">Image</label>

                    <div class="col-sm-9">

                      <input  type="file" id="image_edit_product" name="" value="<?= $product -> image?>">
                      <img id="img_db" class="img-responsive center-block" width="100vh" src="/o_bakery/assets/images/<?= $product -> image?>" alt="">
                      <div class="add_space_between input-group col-xs-9">

                        <input type="text" id="img_path_edit" class="form-control file-upload-info"  value="" disabled placeholder="Max 2MB">
                        <span class=" input-group-append">
                          <button id = "btn_edit_image" class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>


                        </span>

                      </div>

                        <span class="input-group-append" id="regErrorEditProductImg"></span>


                    </div>

                  </div>
                  <button type="button" id="btn_edit_a_product" class="btn btn-gradient-primary mb-2">Save</button>
                </div>

              </div>



              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
