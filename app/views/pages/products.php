






</div>

	<!-- Product -->
	<div id="shop_products" class="sec-product bg0 p-t-145 p-b-25">
		<div class="container">
			<div class="size-a-1 flex-col-c-m p-b-48">
				<div class="txt-center txt-m-201 cl10 how-pos1-parent m-b-14">
					Featured Products

					<div class="how-pos1">
						<img src="assets/images/cookie.png" alt="IMG">
					</div>
				</div>

				<h3 class="txt-center txt-l-101 cl3 respon1">
					Our products
				</h3>
			</div>

			<div class="p-b-46">
				<div id="products_wrapper" class="flex-w flex-c-m filter-tope-group">
					<button data-id="0" class="txt-m-104 cl9 hov2 trans-04 p-rl-27 p-b-10 how-active1">
						All Products

					</button>


					<?php foreach($allCategories as $category):?>
					<button data-id="<?= $category -> category_ID?>" class="text-capitalize txt-m-104 cl9 hov2 trans-04 p-rl-27 p-b-10 how-active1">

							<?= $category -> name?>



					</button>

				<?php endforeach; ?>







				</div>
			</div>

			<div  id="products_grid" class="row isotope-grid">

				<?php

								foreach($allProducts as $product):
									?>

									<div  class="col-sm-6 col-md-4 col-lg-3 p-b-75 isotope-item">

										<div class="block1">
											<div class="block1-bg wrap-pic-w bo-all-1 bocl12 hov3 trans-04">
												<img src="assets/images/<?= $product -> image?>" alt="<?= $product -> name ?>">

												<div class="block1-content flex-col-c-m p-b-46">
													<a href="product" class="text-capitalize txt-m-103 cl3 txt-center hov-cl10 trans-04 js-name-b1">
														<?= $product -> name?>
													</a>



													<div class="block1-wrap-icon flex-c-m flex-w trans-05">
														<a target="_blank" data-id="<?= $product -> product_ID ?>" href="/o_bakery/home?product=<?= $product -> product_ID ?>" class="block1-icon flex-c-m wrap-pic-max-w">
															<i class="fa fa-search-plus" aria-hidden="true"></i>
														</a>




													</div>
												</div>
											</div>
										</div>
									</div>



									<?php
								endforeach;

								?>




			</div>
		</div>
	</div>
