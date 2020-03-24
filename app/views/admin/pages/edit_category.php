


    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Edit a category</h4>
            <form class="form-sample">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <input id="hidden_category_id" type="hidden" name="" value="<?= $category -> category_ID?>">
                    <div class="col-sm-9">
                      <input type="text" autofocus id="edit_name_cat" value="<?= $category -> name?>" class=" add_space_between form-control" />
                      <span class="input-group-append" id="regErrorEditCategoryName"></span>
                    </div>
                  </div>
                </div>

              </div>


              <div class="row">
                <div class="col-md-6">

                <button type="button" id="btn_edit_a_category" class="btn btn-gradient-primary mb-2">Save</button>
              
            </div>
          </div>





              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
