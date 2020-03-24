<section class="sec-product-detail bg0 p-t-105 p-b-70">
  <div class="container">
    <div class="row">
      <div class="col-md-7 col-lg-6">
        <div class="m-r--30 m-r-0-lg">
          <!-- Slide 100 -->
          <div id="slide100-01">
            
            <div class="wrap-main-pic-100 bo-all-1 bocl12 pos-relative">
              <div class="main-frame">
                <div class="wrap-main-pic">
                  <div class="main-pic">
                    <img src="assets/images/<?= $product -> image?>" alt="<?= $product -> name?>">
                  </div>
                </div>
              </div>


            </div>

          </div>
        </div>
      </div>

      <div class="col-md-5 col-lg-6">
        <div class="p-l-70 p-t-35 p-l-0-lg">
          <h4 class="capitalizeProductName js-name1 txt-l-104 cl3 p-b-16">
            <?= $product -> name?>
          </h4>

          <span class="txt-m-117 cl9">
            <?= $product -> price?>$
          </span>

          <div class="flex-w flex-m p-t-30 p-b-27">
            <span class="fs-16 cl11 lh-15 txt-center m-r-15">
              <i class="fa fa-star m-rl-1"></i>
              <i class="fa fa-star m-rl-1"></i>
              <i class="fa fa-star m-rl-1"></i>
              <i class="fa fa-star m-rl-1"></i>
              <i class="fa fa-star m-rl-1"></i>
            </span>


          </div>

          <p class=" capitalizeProductName txt-s-101 cl6">
            <?= $product -> info?>
            <?php if(isset($_SESSION['user'])){?>
          <div class="flex-w flex-m p-t-55 p-b-30">

            <?php if($product -> categoryAvailable == 1) {
                  if($product -> available == 1) {

              ?>



              <button type='button' id='add_to_chart_btn' data-id='<?= $product -> product_ID?>' class=" button_available flex-c-m txt-s-103 cl0 bg10 size-a-2 hov-btn2 trans-04 m-b-30">
                Add to chart
              </button>


            <?php }


            else {
              ?>
              <button type='button' class="button_available flex-c-m txt-s-103 cl0 bg10 size-a-2 hov-btn2 trans-04 m-b-30">
                Not available
              </button>
              <?php


            }






          }



            else {

           ?>

              <button class="not-available flex-c-m txt-s-103 cl0 bg10 size-a-2 hov-btn2 trans-04 m-b-30">
                Not available
              </button>



        <?php }?>

          </div>
        <?php } ?>


          <div id="wrapper_category_p" class="txt-s-107 p-b-6">
            <span class="cl6">
              Category:
            </span>

            <span class="cl9">
              <?= $product -> categoryName?>
            </span>
          </div>

          <div class="txt-s-107 p-b-6">
            <!-- <span class="cl6">
              Additional:
            </span> -->

            <!-- <a href="#" class="txt-s-107 cl9 hov-cl10 trans-04">
              Healthy,
            </a>

            <a href="#" class="txt-s-107 cl9 hov-cl10 trans-04">
              Organic
            </a> -->
          </div>
        </div>
      </div>
    </div>

</section>
