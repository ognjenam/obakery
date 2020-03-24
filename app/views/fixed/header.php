<body class="animsition">

	<!-- Header -->
	<header id="home" class="header-v1">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop">
					<div class="left-header">
						<!-- Menu desktop -->
						<div class="menu-desktop">
							<ul class="main-menu">
								<li class="active-menu">
									<a href="home">Home</a>

								</li>



								<li>
									<a href="products">Products</a>
								</li>




								<li>
									<a href="contact">Contact</a>

								</li>
							</ul>
						</div>
					</div>

					<div class="center-header">
						<!-- Logo desktop -->
						<div class="logo">
						<a href="home"><img src="assets/images/o_bakery_logo.png" alt="IMG-LOGO"></a>
						</div>
					</div>

					<div class="right-header">
						<!-- Icon header -->
						<div class="wrap-icon-header flex-w flex-r-m h-full wrap-menu-click p-t-8">
							<div class="h-full flex-m">
								<div class="icon-header-item flex-c-m trans-04 js-show-modal-search">
									<i class="fa fa-search" aria-hidden="true"></i>
								</div>
							</div>
							<?php
							if(!isset($_SESSION['user'])){
								?>
								<div class="h-full flex-m">
									<div class="icon-header-item flex-c-m trans-04 js-show-modal-user">
										<div class="username">
										<i class="fa fa-user" aria-hidden="true"></i>
									</div>
									</div>
								</div>

								<?php
							}

							else{
													if($_SESSION['user_role'] == 1){



											?>
											<div class="h-full flex-m">
												<div class="icon-header-item flex-c-m trans-04">
													<div class="username">
														<a href="admin">panel</a>

												</div>

											</div>
											</div>
											<div class="h-full flex-m">
												<div class="icon-header-item flex-c-m trans-04">

														<a href="/o_bakery/chart"><i id='user-chart' class="fa fa-shopping-cart" aria-hidden="true"></i></a>



											</div>
											</div>



											<?php
										}
													else{

														?>

														<div class="h-full flex-m">
															<div class="icon-header-item flex-c-m trans-04">
																<div class="username">
																<?= $_SESSION['user'] -> username?>
															</div>


														</div>
														</div>
														<div class="h-full flex-m">
															<div class="icon-header-item flex-c-m trans-04">

																	<a href="/o_bakery/chart"><i id='user-chart' class="fa fa-shopping-cart" aria-hidden="true"></i></a>



														</div>
														</div>

														<?php


													};
													?>
													<div class="h-full flex-m">
														<div class="icon-header-item flex-c-m trans-04">
														<i id="btn_sign_out" class="fa fa-sign-out" aria-hidden="true"></i>
													</div>
													</div>
													<?php
					};

								?>











							</div>
						</div>
					</div>
				</nav>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->
			<div class="logo-mobile">
				<a href="home"><img src="assets/images/o_bakery_logo.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m h-full wrap-menu-click m-r-15">
				<div class="h-full flex-m">
					<div class="icon-header-item flex-c-m trans-04 js-show-modal-search">
						<i class="fa fa-search" aria-hidden="true"></i>
					</div>
				</div>
				<?php
				if(!isset($_SESSION['user'])){
					?>
					<div class="h-full flex-m">
						<div class="icon-header-item flex-c-m trans-04 js-show-modal-user">
							<div class="username">
							<i class="fa fa-user" aria-hidden="true"></i>
						</div>
						</div>
					</div>

					<?php
				}

				else{
										if($_SESSION['user_role'] == 1){



								?>
								<div class="h-full flex-m">
									<div class="icon-header-item flex-c-m trans-04">
										<div class="username">
											<a href="admin">panel</a>

									</div>

								</div>
								</div>

								<div class="h-full flex-m">
									<div class="icon-header-item flex-c-m trans-04">

											<a href="/o_bakery/chart"><i id='user-chart' class="fa fa-shopping-cart" aria-hidden="true"></i></a>



								</div>
								</div>



								<?php
							}
										else{

											?>

											<div class="h-full flex-m">
												<div class="icon-header-item flex-c-m trans-04">
													<div class="username">
													<?= $_SESSION['user'] -> username?>
												</div>


											</div>
											</div>

											<div class="h-full flex-m">
												<div class="icon-header-item flex-c-m trans-04">

													<a href="/o_bakery/chart"><i id='user-chart' class="fa fa-shopping-cart" aria-hidden="true"></i></a>



											</div>
											</div>

											<?php


										};
										?>
										<div class="h-full flex-m">
											<div class="icon-header-item flex-c-m trans-04">
											<i id="btn_sign_out" class="fa fa-sign-out" aria-hidden="true"></i>
										</div>
										</div>


										<?php
		};

					?>


				<!-- cart goes here -->
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="main-menu-m">
				<li>
					<a href="home">Home</a>
				</li>



				<li>
					<a href="products">Products</a>
				</li>



				<li>
					<a href="contact">Contact</a>

					<?php ?>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
				<span class="lnr lnr-cross"></span>
			</button>

			<div class="container-search-header">


				<form  class="wrap-search-header flex-w">
					<button type="button" id="search_products" class="flex-c-m trans-04">
						<span class="lnr lnr-magnifier"><i  class="fa fa-search" aria-hidden="true"></i></span>
					</button>
					<input id='products_input' class="plh1" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>


		<div class="modal-user-header flex-c-m trans-04 js-hide-modal-user">
			<!-- <button class="flex-c-m btn-hide-modal-user trans-04 js-hide-modal-user">
				<span class="lnr lnr-cross"></span>
			</button> -->

			<div class="container-user-header">
				<form class="wrap-user-header flex-w">
					<div class="row">
						<div class="col-md-6 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Sign in</h4>
									<form class="forms-sample">

										<div class="form-group">
											<label for="sign_in_email">Email address</label>
											<input type="email" class="form-control" id="sign_in_email" placeholder="">
											<span class="cd-error-message" id="signInErrorEmail"></span>
										</div>
										<div class="form-group">
											<label for="sign_in_password">Password</label>
											<input type="password" class="form-control" id="sign_in_password" placeholder="">
											<span class="cd-error-message" id="signInErrorPassword"></span>
										</div>


										<button type="button" id="btn_sign_in" class="btn btn-gradient-primary mr-2">Submit</button>

									</form>
								</div>
							</div>
						</div>

						<div class="col-md-6 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Register</h4>
									<form class="forms-sample">
										<div class="form-group">
											<label for="register_username">Username</label>
											<input type="text" class="form-control" id="register_username" placeholder="">
											<span class="cd-error-message" id="regErrorUsername"></span>
										</div>


										<div class="form-group">
											<label for="register_email">Email address</label>
											<input type="email" class="form-control" id="register_email" placeholder="">
											<span class="cd-error-message" id="regErrorEmail"></span>
										</div>
										<div class="form-group">
											<label for="register_password">Password</label>
											<input type="password" class="form-control" id="register_password" placeholder="">
											<span class="cd-error-message" id="regErrorPassword"></span>
										</div>

										<button type="button" id="btn_register" class="btn btn-gradient-primarsy mr-2">Submit</button>


									</form>
								</div>
							</div>
						</div>


					</div>

				</form>
			</div>
		</div>

	</header>
