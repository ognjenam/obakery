

	<!-- Welcome -->
	<section id="about_us" class="sec-welcome bg0 p-t-145 p-b-95">
		<div class="container">
			<div class="size-a-1 flex-col-c-m p-b-90">
				<div class="txt-center txt-m-201 cl10 how-pos1-parent m-b-14">
					Made fresh daily

					<div class="how-pos1">
						<img src="assets/images/cookie.png" alt="IMG">
					</div>
				</div>

				<h3 class="txt-center txt-l-101 cl3 respon1">
					welcome to o' bakery
				</h3>
			</div>

			<div class="wrap-pic-max-w flex-c-t flex-w p-t-255 item-welcome-parent">
				<img class="size-w-1" src="assets/images/intro_bg.png" alt="IMG">
				<!-- <img class="size-w-1" src="assets/images/intro_bg.png" alt="IMG"> -->

				<!-- item welcome -->
				<div class="item-welcome one">
					<div class="item-welcome-pic pos-relative">
						<div class="wrap-pic-max-w flex-c-m item-welcome-pic-dark trans-04">
							<img src="assets/images/icons/icon_02_shipping.png" alt="IMG">
						</div>

						<div class="wrap-pic-max-w flex-c-m s-full ab-t-l item-welcome-pic-light trans-04">
							<img src="assets/images/icons/icon_01_shipping.png" alt="IMG">
						</div>
					</div>

					<div class="item-welcome-txt p-t-27">
						<h4 class="txt-m-101 cl3 txt-center p-b-11">
							nationwide shipping
						</h4>


					</div>
				</div>

				<!-- item welcome -->
				<div class="item-welcome two">
					<div class="item-welcome-pic pos-relative">
						<div class="wrap-pic-max-w flex-c-m item-welcome-pic-dark trans-04">
							<img src="assets/images/icons/icon_02_healthy.png" alt="IMG">
						</div>

						<div class="wrap-pic-max-w flex-c-m s-full ab-t-l item-welcome-pic-light trans-04">
							<img src="assets/images/icons/icon_01_healthy.png" alt="IMG">
						</div>
					</div>

					<div class="item-welcome-txt p-t-27">
						<h4 class="txt-m-101 cl3 txt-center p-b-11">
							family healthy
						</h4>

					
					</div>
				</div>

				<!-- item welcome -->
				<div class="item-welcome three">
					<div class="item-welcome-pic pos-relative">
						<div class="wrap-pic-max-w flex-c-m item-welcome-pic-dark trans-04">
							<img src="assets/images/icons/icon_02_fresh.png" alt="IMG">
						</div>

						<div class="wrap-pic-max-w flex-c-m s-full ab-t-l item-welcome-pic-light trans-04">
							<img src="assets/images/icons/icon_01_fresh.png" alt="IMG">
						</div>
					</div>

					<div class="item-welcome-txt p-t-27">
						<h4 class="txt-m-101 cl3 txt-center p-b-11">
							Always Fresh
						</h4>


					</div>
				</div>

				<!-- item welcome -->
				<div class="item-welcome four">
					<div class="item-welcome-pic pos-relative">
						<div class="wrap-pic-max-w flex-c-m item-welcome-pic-dark trans-04">
							<img src="assets/images/icons/icon_02_safety.png" alt="IMG">
						</div>

						<div class="wrap-pic-max-w flex-c-m s-full ab-t-l item-welcome-pic-light trans-04">
							<img src="assets/images/icons/icon_01_safety.png" alt="IMG">
						</div>
					</div>

					<div class="item-welcome-txt p-t-27">
						<h4 class="txt-m-101 cl3 txt-center p-b-11">
							Food safety
						</h4>


					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- Item -->
	<div id="intro_categories" class="sec-item flex-w">
<?php foreach($productsByCategory as $p):?>
		<div class=" of-hidden size-w-2 respon2">
			<div class="hov-img1 pos-relative">
				<div class="category_holder">

				</div>

				<a  class="disabled category_box s-full ab-t-l flex-col-c-m  p-all-15 hov1-parent">
					<div class="wrap-pic-max-w">
						<img class="product_category" src="assets/images/cookie.png" alt="IMG">
					</div>

					<span class="category_name txt-l-102 cl0 txt-center p-t-30 p-b-13">
						<?= $p -> categoryName?>
					</span>

					<div class="category_items hov1 trans-04">
						<div class="txt-m-102 cl0 txt-center hov1-child trans-04">
							- <?= $p -> productsNumber?> Products -
						</div>
					</div>
				</a>
			</div>
		</div>
	<?php endforeach;?>
	</div>


	<section id="about_us" class="sec-welcome bg0 p-t-145 p-b-95">
		<div class="container">
			<div class="size-a-1 flex-col-c-m p-b-90">
				<div class="txt-center txt-m-201 cl10 how-pos1-parent m-b-14">
					COMMUNITY AWARDS AND ACCOLADES

					<div class="how-pos1">
						<img src="assets/images/cookie.png" alt="IMG">
					</div>
				</div>

				<div class="wrapper_awards">
					<div class="child_wrapper">
						<p class="year_awards text-left">2019</p>
						<p class="text_awards"><span class="fa_awards"><i class="fa fa-birthday-cake" aria-hidden="true"></i></span> Encore Magazine, Best of 2019 Winner: Bakery & Desserts</p>

					</div>

					<div class="child_wrapper">
						<p class="year_awards text-left">2017</p>
						<p class="text_awards"><span class="fa_awards"><i class="fa fa-birthday-cake" aria-hidden="true"></i></span> Wilmington Magazine, Best of 2017 Winner: Bakery</p>
						<p class="text_awards"><span class="fa_awards"><i class="fa fa-birthday-cake" aria-hidden="true"></i></span> Encore Magazine, Best of 2017 Winner: Bakery & Desserts</p>

					</div>

					<div class="child_wrapper">
						<p class="year_awards text-left">2016</p>
						<p class="text_awards"><span class="fa_awards"><i class="fa fa-birthday-cake" aria-hidden="true"></i></span> Encore Magazine, Best of 2016 Winner: Bakery & Desserts</p>
						<p class="text_awards"><span class="fa_awards"><i class="fa fa-birthday-cake" aria-hidden="true"></i></span> Star News Media, Shorepicks 2016 Best of the Cape Fear Region Winner: Bakery</p>

					</div>

					<div class="child_wrapper">
						<p class="year_awards text-left">2014</p>
						<p class="text_awards"><span class="fa_awards"><i class="fa fa-birthday-cake" aria-hidden="true"></i></span> Encore Magazine, Best of 2014 Winner: Bakery & Desserts</p>


					</div>


				</div>
			</div>

<!--
			<div class="wrap-pic-max-w flex-c-t flex-w p-t-255 item-welcome-parent">



			</div> -->
		</div>
	</section>









































	<!-- Deal -->
	<!-- <section class="sec-deal bg-img1" style="background-image: url('assets/images/bg-01.jpg');">
	  <div class="flex-w flex-m how-pos2-parent">
	    <img class="how-pos2 respon4 dis-none-xl" src="assets/images/other-03.png" alt="IMG">

	    <div class="size-w-3 txt-center wrap-pic-max-s w-full-lg">
	      <img src="assets/images/other-02.png" alt="IMG">
	    </div>

	    <div class="size-w-4 p-t-105 p-b-90 p-r-15 respon3">
	      <div class="size-a-1 flex-col-l-m p-b-35">
	        <div class="txt-m-201 cl10 how-pos1-parent m-b-14">
	          Best Price For You

	          <div class="how-pos1">
	            <img src="assets/images/cookie.png" alt="IMG">
	          </div>
	        </div>

	        <h3 class="txt-l-101 cl3 respon1">
	          deal of the day
	        </h3>
	      </div>

	      <div class="p-b-32">
	        <a href="#" class="txt-m-105 cl6 hov-cl10 trans-04">
	          Roasted corn
	        </a>

	        <div class="txt-m-105 p-t-15 p-b-22">
	          <span class="cl9">
	            20$
	          </span>

	          <span class="cl10">
	            Now Only 15$
	          </span>
	        </div>

	        <p class="txt-s-102 cl9">
	          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.
	        </p>
	      </div>



	      <div class="flex-w">
	        <a href="shop-sidebar-grid.html" class="flex-c-m txt-s-103 cl6 size-a-2 how-btn1 bo-all-1 bocl11 hov-btn1 trans-04">
	          Shop now
	          <span class="lnr lnr-chevron-right m-l-7"></span>
	          <span class="lnr lnr-chevron-right"></span>
	        </a>
	      </div>

	    </div>
	  </div>
	</section> -->
