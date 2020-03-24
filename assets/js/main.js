
window.onload = function() {

  window.name_add_img = '';
  window.full_path = '';
  let button_all_products = $("#products_wrapper button");

  for(let i = 0; i < button_all_products.length; i++)
  {
    if(button_all_products[i].dataset.id == 0)
    {
      button_all_products[i].click();
    }

  }




};

// CHART
$(document).ready(function(){
$(document).on("click", "#add_to_chart_btn" ,function(){


  let product_id = $(this).data('id');

  console.log(product_id);


  $.ajax({
    // url : "/o_bakery/app/models/chart/chart.php",
    url : "/o_bakery/user_chart",

    dataType : 'json',
    method : 'post',
    data : {
      _product_id : product_id
    },
    success : function(data)
    {


      if(data.inserted == true)
      {
        window.location.href = '/o_bakery/chart';
      }

    },
    error : function(xhr, status, responseText)
    {
      console.log(status);
    }


  });






});



// CHART REMOVE

$(document).on("click", "#remove_from_chart_btn" ,function(){


  let product_user_id = $(this).data('id');






  $.ajax({
    url : "/o_bakery/remove_from_chart",
    // url : "/o_bakery/app/models/chart/remove_from_chart.php",
    dataType : 'json',
    method : 'post',
    data : {
      _product_id : product_user_id
    },
    success : function(data)
    {


      if(data.chart.length != 0)
      {
        displayChart(data.chart);
      }

      else {
        displayChart();
      }




    },
    error : function(xhr, status, responseText)
    {
      console.log(status)
    }


  });






});

function displayChart(data){
  let x = ``;

  for(let d in data)
  {
    x += `
    <tr>

      <td class="text-capitalize ">${data[d].productName}</td>
      <td>${data[d].productPrice}</td>
      <td><img src="/o_bakery/assets/images/${data[d].productImage}" alt="${data[d].productName}"></td>
      <td>${data[d].date}</td>




        <td>

      <button id='remove_from_chart_btn' type='button' data-id="${data[d].product_user_ID}" class=" btn btn-block btn-lg btn-gradient-primary mt-4"><a> Remove </a> </button>


    </td>

  </tr>
    `;
  }

  $("#chart_user").html(x);


}

});





$(document).ready(function(){












// CONTACT

$("#btn_contact").click(function(){


  let name = $("#contact_name_surname").val();
  let e_mail = $("#contact_email").val();
  let message = $("#contact_message").val();

  let reName = /^[a-zA-Z]{2,}(\s[a-zA-Z]{2,})*$/;
  let reEmail = /^[A-z\d]{2,}(\.?(\W\D)?[A-z\d]{2,})*\@\w{2,}(\.\w{2,})(\.\w{2,})*$/;
  let reMessage = /([a-zA-Z]){5,}(\s)*[0-9]*/;

  let flag = true;

  if(!reName.test(name))
  {
    flag = false;
    $("#errorContactName").text('Incorrect name!');
  }

  else {
    $("#errorContactName").text('');
  }

  if(!reEmail.test(e_mail))
  {
    flag = false;
    $("#errorContactEmail").text('Incorrect e-mail!');
  }

  else {
      $("#errorContactEmail").text('');
  }

  if(!reMessage.test(message))
  {
    flag = false;
    $("#errorContactMessage").text('Incorrect message!');
  }

  else {
      $("#errorContactMessage").text('');
  }

  if(flag )
  {
    $.ajax({
      // url : "/o_bakery/app/models/contact/contact.php",
      url : "/o_bakery/contact_form",

      dataType : 'json',
      method : 'post',
      data : {
        _name : name,
        _email : e_mail,
        _message : message

      },
      success : function(data)
      {



        // if(data.mailer)
        // {

          $("#responseMailer").text(data.mailer).fadeOut(2000);

          $("#contact_name_surname").val('');
          $("#contact_email").val('');
          $("#contact_message").val('');
        // }

        if(data.errorName != '')
        {
          $("#errorContactName").text(data.errorName);
        }

        else {
          $("#errorContactName").text('');
        }

        if(data.errorEmail != '')
        {
          $("#errorContactEmail").text(data.errorEmail);
        }

        else {
          $("#errorContactEmail").text('');
        }

        if(data.errorMessage != '')
        {
          $("#errorContactMessage").text(data.errorMessage);
        }

        else {
          $("#errorContactMessage").text('');
        }

      },
      error : function(xhr, status, responseText)
      {
        console.log(status);
      }


    });
  }



});

// SEARCH A PRODUCT

$("#search_products").click(function(){


  let value = $("#products_input").val();


  $.ajax({

    url : "/o_bakery/product_search",
    dataType : 'json',
    method : 'post',
    data : {
      _product_name : value
    },
    success : function(data)
    {


      if(data.product)
      {
        window.location.href='/o_bakery/home?product=' + data.product.product_ID;
      }

      else if(data.product == false){
        window.location.href='/o_bakery/products';
      }



    },
    error : function(xhr, status, responseText)
    {
      console.log(status);
    }


  });

});

});



// EDIT CATEGORY



$(document).on("click", "#btn_edit_a_category", function(){

let name = $("#edit_name_cat").val();
let cat_id = $("#hidden_category_id").val();

let reCategoryName = /^[A-z]{2,}(\s([A-z]{2,}))*$/;

let flag = true;

if(!reCategoryName.test(name))

{
  flag = false;
  $("#regErrorEditCategoryName").html("Incorrect name!")
}
else {
  $("#regErrorEditCategoryName").html("")
}


if(flag)

{
  $.ajax({
    // url : "/o_bakery/app/models/categories/edit_a_category.php",
    url : "/o_bakery/edit_a_category",
    dataType : 'json',
    method : 'post',
    data : {
      _category_name : name,
      _category_id : cat_id
    },
    success : function(data)
    {

      if(data != undefined)
      {
        $("#regErrorEditCategory").html(data);
      }

      else {
        window.location.href = '/o_bakery/admin';
      }







    },
    error : function(xhr, status, responseText)
    {
      console.log(status);
    }


  });
}


})

// EDIT PRODUCT
$(document).on("click", "#btn_edit_a_product", function(){

let name = $("#edit_name_prod").val();
let price = $("#edit_price_prod").val();
let description = $("#edit_descr_prod").val();
let image = $("#image_edit_product").val();
let product_id = $("#hidden_product_id").val();



let reProdName = /^[A-z]{2,}((\s[A-z]{2,}))*$/;
let reProdDescr = /[A-z]{3,}\s*/;
let rePrice = /^\d?\d{1}\.\d{2}$/;
let flag = true;

let new_image = $("#img_path_edit").val();




if(!reProdName.test(name))
{
  flag = false;
  $("#regErrorEditProductName").html("Incorrect name!")

}

else {
  $("#regErrorEditProductName").html("")
}

if(!reProdDescr.test(description))
{
  flag = false;
  $("#regErrorEditProductDescr").html("Incorrect description!")

}

else {
  $("#regErrorEditProductDescr").html("")
}

if(!rePrice.test(price))
{
  flag = false;
  $("#regErrorEditProductPrice").html("Incorrect value!")

}

else {
  $("#regErrorEditProductPrice").html("")
}

if(new_image != "")
{
  let img = $("#image_edit_product");
  let image_size = $("#image_edit_product")[0].files[0].size;

  let file_size_mb = Math.round((image_size / 1024));

  let extension = name_add_img.split('.');

  let allowed_ext = extension[1].toLowerCase();

  let errors = '';




  if(((allowed_ext == 'jpg') || (allowed_ext == 'jpeg') || (allowed_ext == 'png')) && file_size_mb < 2048)
  {

      $("#regErrorEditProductImg").html('');

  }

  else {
    flag = false;
    $("#regErrorEditProductImg").html('jpeg / jpg / png & not above 2MB');
  }
}

if(flag)
{

  let request = new XMLHttpRequest();
  let formData = new FormData();
  let img = $("#image_edit_product");


  formData.append('image', img[0].files[0]);
  formData.append('product_name', name);
  formData.append('product_id', product_id);
  formData.append('product_price', price);
  formData.append('product_descr', description);

  // request.open('post', '/o_bakery/app/models/products/edit_a_product.php');
  request.open('post', '/o_bakery/edit_a_product');
  request.responseType = 'json';
  request.send(formData);

  request.onload = function(e)
  {

    window.location.href = '/o_bakery/admin';
  }
}

});

$(document).ready(function(){


$(document).on("click", "#products_admin  .delete_product", function(){



  let product_id = $(this).data("id");

  if($(this).hasClass('btn-gradient-red'))
  {
    $.ajax({
      // url : "/o_bakery/app/models/products/get_back_a_product.php",
      url : "/o_bakery/get_back_a_product",
      dataType : 'json',
      method : 'post',
      data : {
        _product_id : product_id
      },
      success : function(data)
      {
        if(data.backed)
        {
          window.location.href = '/o_bakery/admin/products';
        }

      },
      error : function(xhr, status, responseText)
      {
        console.log(status);
      }


    });
  }

  else {
    $.ajax({
      // url : "/o_bakery/app/models/products/remove_a_product.php",
      url : "/o_bakery/remove_a_product",
      dataType : 'json',
      method : 'post',
      data : {
        _product_id : product_id
      },
      success : function(data)
      {

        if(data.removed)
        {
          window.location.href = '/o_bakery/admin/products';
        }

      },
      error : function(xhr, status, responseText)
      {
        console.log(status);
      }


    });
  }

  // updateAndDisplayProducts();
});



// AVAILABLE / UNAVAILABLE A CATEGORY

$(document).on("click", "#categories_admin .delete_category", function(){


  console.log($(this).data('id'))
  let category_id = $(this).data("id");


  if($(this).hasClass('btn-gradient-red'))
  {
    $.ajax({
      url : "/o_bakery/get_back_a_category",
      // url : "/o_bakery/app/models/categories/get_back_a_category.php",
      dataType : 'json',
      method : 'post',
      data : {
        _category_id : category_id
      },
      success: function (data)
      {
        if(data.backed)
        {
          window.location.href = '/o_bakery/admin/categories';
        }
      },
      error : function(xhr, status, responseText)
      {
        console.log(status);
      }


    });
  }

  else {
    $.ajax({
      url : "/o_bakery/remove_a_category",
      // url : "/o_bakery/app/models/categories/remove_a_category.php",
      dataType : 'json',
      method : 'post',
      data : {
        _category_id : category_id
      },
      success: function(data)
      {
        if(data.removed)
        {
          window.location.href = '/o_bakery/admin/categories';
        }
      },
      error : function(xhr, status, responseText)
      {
        console.log(status);
      }


    });
  }

  // updateAndDisplayCategories();










});

// EDIT CATEGORY
$(document).on("click", "#categories_admin .edit_category", function(){

let category_id = $(this).data('id');




});



  var all_products = $("#products_wrapper button");


  for(let i of all_products)
  {
    if($(i).data("id") !== 0)
    {
        $(i).removeClass("how-active1");
    }

  }




});

$(document).on("click", "#btn_add_image", function(){

  $("#image_add_product").click();

})

$(document).on("click", "#btn_edit_image", function(){

  $("#image_edit_product").click();

})

$(document).on("change", "#image_add_product", function(){

    full_path = $("input[type=file]").val().split("\\");

  name_add_img  = full_path[2];




  $("#img_path").val(full_path[2]);

})

$(document).on("change", "#image_edit_product", function(){

    full_path = $("input[type=file]").val().split("\\");

  name_add_img  = full_path[2];




  $("#img_path_edit").val(full_path[2]);

})
/*[ Smooth scroll ]
===========================================================*/


$(function() {

    $('a[href*=\\#]:not([href=\\#])').on('click', function() {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.substr(1) +']');
        if (target.length) {
            $('html,body').animate({
                scrollTop: target.offset().top
            }, 1000);
            return false;
        }
    });
});

(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    try {
        $(".animsition").animsition({
            inClass: 'fade-in',
            outClass: 'fade-out',
            inDuration: 1500,
            outDuration: 800,
            linkElement: '.animsition-link',
            loading: true,
            loadingParentElement: 'html',
            loadingClass: 'animsition-loading-1',
            loadingInner: '<div class="loader05"></div>',
            timeout: false,
            timeoutCountdown: 5000,
            onLoadEvent: true,
            browser: [ 'animation-duration', '-webkit-animation-duration'],
            overlay : false,
            overlayClass : 'animsition-overlay-slide',
            overlayParentElement : 'html',
            transition: function(url){ window.location.href = url; }
        });
    } catch(er) {console.log(er);}


    /*[ Back to top ]
    ===========================================================*/
    try {
        var windowH = $(window).height()/2;

        $(window).on('scroll',function(){
            if ($(this).scrollTop() > windowH) {
                $("#myBtn").css('display','flex');
            } else {
                $("#myBtn").css('display','none');
            }
        });

        $('#myBtn').on("click", function(){
            $('html, body').animate({scrollTop: 0}, 300);
        });
    } catch(er) {console.log(er);}






    /*==================================================================
    [ Isotope ]*/
    try {
        var $topeContainer = $('.isotope-grid');
        var $filter = $('.filter-tope-group');

        // filter items on button click
        $filter.each(function () {
            $filter.on('click', 'button', function () {
                var filterValue = $(this).attr('data-filter');
                $topeContainer.isotope({filter: filterValue});
            });

        });

        // init Isotope
        $(window).on('load', function () {
            var $grid = $topeContainer.each(function () {
                $(this).isotope({
                    itemSelector: '.isotope-item',
                    layoutMode: 'masonry',
                    percentPosition: true,
                    animationEngine : 'best-available',
                    masonry: {
                        columnWidth: '.isotope-item'
                    }
                });
            });
        });

        var isotopeButton = $('.filter-tope-group button');

        $(isotopeButton).each(function(){
            $(this).on('click', function(){
                for(var i=0; i<isotopeButton.length; i++) {
                    $(isotopeButton[i]).removeClass('how-active1');
                }

                $(this).addClass('how-active1');


                if($(this).data('filter') === "*") {
                    $('.isotope-grid-gallery .isotope-item .js-gallery').addClass('js-show-gallery');

                    $('.gallery-lb.isotope-grid-gallery').each(function() {
                        $(this).find('.js-show-gallery').magnificPopup({
                            type: 'image',
                            gallery: {
                                enabled:true
                            },
                            mainClass: 'mfp-fade'
                        });
                    });
                }
                else {
                    $('.isotope-grid-gallery .isotope-item .js-gallery').removeClass('js-show-gallery');
                    $('.isotope-grid-gallery ' + $(this).data('filter') + ' .js-gallery').addClass('js-show-gallery');

                    $('.gallery-lb.isotope-grid-gallery').each(function() {
                        $(this).find('.js-show-gallery').magnificPopup({
                            type: 'image',
                            gallery: {
                                enabled:true
                            },
                            mainClass: 'mfp-fade'
                        });
                    });
                }
            });
        });
    } catch(er) {console.log(er);}



    /*==================================================================
    [ Fixed Header ]*/
    try {
        var headerDesktop = $('.container-menu-desktop');
        var wrapMenu = $('.wrap-menu-desktop');

        if($('.top-bar').length > 0) {
            var posWrapHeader = $('.top-bar').height();
        }
        else {
            var posWrapHeader = 0;
        }


        if($(window).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top',0);
        }
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop());
        }

        $(window).on('scroll',function(){
            if($(this).scrollTop() > posWrapHeader) {
                $(headerDesktop).addClass('fix-menu-desktop');
                $(wrapMenu).css('top',0);
            }
            else {
                $(headerDesktop).removeClass('fix-menu-desktop');
                $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop());
            }
        });
    } catch(er) {console.log(er);}



    /*==================================================================
    [ Menu mobile ]*/
    try {
        $('.btn-show-menu-mobile').on('click', function(){
            $(this).toggleClass('is-active');
            $('.menu-mobile').slideToggle();
        });

        var arrowMainMenu = $('.arrow-main-menu-m');

        for(var i=0; i<arrowMainMenu.length; i++){
            $(arrowMainMenu[i]).on('click', function(){
                $(this).parent().find('.sub-menu-m').slideToggle();
                $(this).toggleClass('turn-arrow-main-menu-m');
            })
        }

        $(window).on('resize',function(){
            if($(window).width() >= 992){
                if($('.menu-mobile').css('display') === 'block') {
                    $('.menu-mobile').css('display','none');
                    $('.btn-show-menu-mobile').toggleClass('is-active');
                }

                $('.sub-menu-m').each(function(){
                    if($(this).css('display') === 'block') {
                        $(this).css('display','none');
                        $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                    }
                });

            }
        });
    } catch(er) {console.log(er);}



    /*==================================================================
    [ Show / hide modal search ]*/
    try {
        $('.js-show-modal-search').on('click', function(){
            $('.modal-search-header').addClass('show-modal-search');
            // $(this).css('opacity','0');
        });

        $('.js-hide-modal-search').on('click', function(){
            $('.modal-search-header').removeClass('show-modal-search');
            // $('.js-show-modal-search').css('opacity','1');
        });

        $('.container-search-header').on('click', function(e){
            e.stopPropagation();
        });
    } catch(er) {console.log(er);}

    /*==================================================================
    [ Show / hide modal search ]*/
    try {
        $('.js-show-modal-user').on('click', function(){
            $('.modal-user-header').addClass('show-modal-user');
            // $(this).css('opacity','0');
        });

        $('.js-hide-modal-user').on('click', function(){
            $('.modal-user-header').removeClass('show-modal-user');
            // $('.js-show-modal-user').css('opacity','1');
        });

        $('.container-user-header').on('click', function(e){
            e.stopPropagation();
        });
    } catch(er) {console.log(er);}



    /*==================================================================
    [ Cart header ]*/
    try {
        $('.wrap-menu-click').each(function(){
            var wrapMenuClick = $(this);

            $(wrapMenuClick).find('.menu-click').on('click', function(e){
                e.stopPropagation();

                if($(this).hasClass('showed')) {
                    $(wrapMenuClick).find('.menu-click').removeClass('show-menu-click showed');
                }
                else {
                    $(wrapMenuClick).find('.menu-click').removeClass('show-menu-click showed');
                    $(this).addClass('show-menu-click showed');
                }
            });

            $(wrapMenuClick).find('.menu-click-child').on('click', function(e){
                e.stopPropagation();
            });
        });

        $(window).on('click', function(){
            $('.wrap-menu-click').find('.menu-click').removeClass('show-menu-click showed');
        })
    } catch(er) {console.log(er);}


    /*==================================================================
    [ Sweetalert ]*/
    try {
        $('.js-addwish-b1, .js-addwish1').on('click', function(e){
            e.preventDefault();
        });

        $('.js-addwish-b1').each(function(){
            var nameProduct = $(this).parent().parent().find('.js-name-b1').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-b1');
                $(this).removeClass('js-addwish-b1');
                $(this).off('click');
            });
        });

        $('.js-addcart-b1').each(function(){
            var nameProduct = $(this).parent().parent().find('.js-name-b1').html();
            $(this).on('click', function(e){
                e.preventDefault();
                swal(nameProduct, "is added to cart !", "success");
            });
        });


        /*---------------------------------------------*/
        $('.js-addwish1').each(function(){
            var nameProduct = $(this).parent().find('.js-name1').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish1');
                $(this).off('click');
            });
        });

        $('.js-addcart1').each(function(){
            var nameProduct = $(this).parent().parent().find('.js-name1').html();
            $(this).on('click', function(e){
                e.preventDefault();
                swal(nameProduct, "is added to cart !", "success");
            });
        });


    } catch(er) {console.log(er);}

    /*==================================================================
    [ Parallax100 ]*/
    try {
        $('.parallax100').parallax100();
    } catch(er) {console.log(er);}


    /*==================================================================
    [ Perfect scrollbar ]*/
    try {
        $('.js-pscroll').each(function(){
            $(this).css('position','relative');
            $(this).css('overflow','hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function(){
                ps.update();
            })
        });
    } catch(er) {console.log(er);}


    /*==================================================================
    [ Counter up ]*/
    try {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    } catch(er) {console.log(er);}


    /*==================================================================
    [ Countdown ]*/
    try {
        $('.coutdown100').each(function(){
            if($(this).data('year') != null){
                var year = Number($(this).data('year'));
            }
            else {var year = 0;}

            if($(this).data('month') != null){
                var month = Number($(this).data('month'));
            }
            else {var month = 0;}

            if($(this).data('date') != null){
                var date = Number($(this).data('date'));
            }
            else {var date = 0;}

            if($(this).data('hours') != null){
                var hours = Number($(this).data('hours'));
            }
            else {var hours = 0}

            if($(this).data('minutes') != null){
                var minutes = Number($(this).data('minutes'));
            }
            else {var minutes = 0;}

            if($(this).data('seconds') != null){
                var seconds = Number($(this).data('seconds'));
            }
            else {var seconds = 0;}

            if($(this).data('timezone') != null && $(this).data('timezone') != "auto"){
                var timeZ = $(this).data('timezone');
            }
            else {var timeZ = "";}


            $(this).countdown100({
                /*Set Endtime here*/
                /*Endtime must be > current time*/
                endtimeYear: year,
                endtimeMonth: month,
                endtimeDate: date,
                endtimeHours: hours,
                endtimeMinutes: minutes,
                endtimeSeconds: seconds,
                timeZone: timeZ
                // ex:  timeZone: "America/New_York"
                //go to " http://momentjs.com/timezone/ " to get timezone
            });
        });

    } catch(er) {console.log(er);}


    /*==================================================================
    [ Video ]*/
    try {
        $('.btn-play').on('click', function(ev) {
            $('.wrap-iframe-video').children('iframe')[0].src += "rel=0&autoplay=1";

            $('.wrap-iframe-video').addClass('show-video');

            $(this).fadeOut();
            ev.preventDefault();
        });
    } catch(er) {console.log(er);}


    /*==================================================================
    [ Progress bar ]*/
    try {
        var progressItem = $('.progress-item');
        var progressDone = false;

        $(window).on('scroll',function(){
            progressItem.each(function(){
                var per = Number($(this).data('percent'));
                var inner = $(this).children('.progress-inner');

                if($(window).scrollTop() + $(window).height() > $(this).offset().top && per > 0) {
                    $(this).data('percent','0');
                    inner.html(per + "%");
                    inner.animate({width: per + "%"},1500);
                }
            });
        });
    } catch(er) {console.log(er);}


    /*==================================================================
    [ JS height ]*/
    try {
        $(window).on('resize', function(){
            $('.js-height').each(function(){
                $(this).css('height',$(this).find('.js-height-child').height());
            });
        });

        $(window).on('load', function(){
            $('.js-height').each(function(){
                $(this).css('height',$(this).find('.js-height-child').height());
            });
        });
    } catch(er) {console.log(er);}


    /*==================================================================
    [ Magnific-Popup ]*/
    try {
        $('.gallery-lb').each(function() {
            $(this).find('.js-show-gallery').magnificPopup({
                type: 'image',
                gallery: {
                    enabled:true
                },
                mainClass: 'mfp-fade'
            });
        });
    } catch(er) {console.log(er);}

    /*==================================================================
    [ Noui ]*/
    try {
        var filterBar = document.getElementById('filter-bar');
        var fromValue = Number($('#value-lower').html());
        var toValue = Number($('#value-upper').html());

        noUiSlider.create(filterBar, {
            start: [ fromValue, toValue ],
            connect: true,
            range: {
                'min': fromValue,
                'max': toValue
            }
        });

        var skipValues = [
        document.getElementById('value-lower'),
        document.getElementById('value-upper')
        ];

        filterBar.noUiSlider.on('update', function( values, handle ) {
            skipValues[handle].innerHTML = Math.round(values[handle]) ;
        });
    } catch(er) {console.log(er);}


    /*==================================================================
    [ Select2 ]*/
    try {
        $(".js-select2").each(function(){
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        });
    } catch(er) {console.log(er);}


    /*==================================================================
    [ Show grid / list ]*/
    try {
        $('.js-show-grid').on('click', function(){
            $(this).addClass('menu-active');
            $('.js-show-list').removeClass('menu-active');

            $('.shop-grid').fadeIn();
            $('.shop-list').hide();
        });

        $('.js-show-list').on('click', function(){
            $(this).addClass('menu-active');
            $('.js-show-grid').removeClass('menu-active');

            $('.shop-list').fadeIn();
            $('.shop-grid').hide();
        });
    } catch(er) {console.log(er);}

    /*==================================================================
    [ +/- num product ]*/
    try {
        $('.btn-num-product-down').on('click', function(){
            var numProduct = Number($(this).next().val());
            if(numProduct > 0) $(this).next().val(numProduct - 1);
        });

        $('.btn-num-product-up').on('click', function(){
            var numProduct = Number($(this).prev().val());
            $(this).prev().val(numProduct + 1);
        });
    } catch(er) {console.log(er);}

    /*==================================================================
    [ Rating ]*/
    try {
       $('.wrap-rating').each(function(){
            var item = $(this).find('.item-rating');
            var rated = -1;
            var input = $(this).find('input');
            $(input).val(0);

            $(item).on('mouseenter', function(){
                var index = item.index(this);
                var i = 0;
                for(i=0; i<=index; i++) {
                    $(item[i]).removeClass('fa-star-o');
                    $(item[i]).addClass('fa-star');
                }

                for(var j=i; j<item.length; j++) {
                    $(item[j]).addClass('fa-star-o');
                    $(item[j]).removeClass('fa-star');
                }
            });

            $(item).on('click', function(){
                var index = item.index(this);
                rated = index;
                $(input).val(index+1);
            });

            $(this).on('mouseleave', function(){
                var i = 0;
                for(i=0; i<=rated; i++) {
                    $(item[i]).removeClass('fa-star-o');
                    $(item[i]).addClass('fa-star');
                }

                for(var j=i; j<item.length; j++) {
                    $(item[j]).addClass('fa-star-o');
                    $(item[j]).removeClass('fa-star');
                }
            });
        });
    } catch(er) {console.log(er);}

    /*==================================================================
    [ Show/hide panel1 ]*/
    try {
        $('.js-toggle-panel1').on('click', function(){
            $(this).parent().parent().find('.js-panel1').slideToggle();
        });
    } catch(er) {console.log(er);}


    /*==================================================================
    [ Chose pay ]*/
    try {
        $("#radio1").on('change', function(){
            if ($(this).is(":checked")) {
                $('.content-payment').slideDown(300);
                $('.content-paypal').slideUp(300);
            }
        });

        $("#radio2").on('change', function(){
            if ($(this).is(":checked")) {
                $('.content-payment').slideUp(300);
                $('.content-paypal').slideDown(300);
            }
        });
    } catch(er) {console.log(er);}

    /*==================================================================
    [ Show/hide Reply cmt ]*/
    try {
        $('.js-show-reply-cmt').on('click', function(e){
            e.preventDefault();
            $(this).parent().parent().parent().find('.js-reply-cmt').show();
            $(this).addClass('how-active2');
        });

        $('.js-hide-reply-cmt').on('click', function(e){
            e.preventDefault();
            $(this).parent().parent().hide();
            $(this).parent().parent().parent().find('.js-show-reply-cmt').removeClass('how-active2');
        });
    } catch(er) {console.log(er);}


})(jQuery);



// REGISTRATION


$(document).ready(function(){

  $("#btn_register").click(function(){

    let reg_username = document.querySelector("#register_username").value;
    let reg_email = document.querySelector("#register_email").value;
    let reg_password = document.querySelector("#register_password").value;

    let reUsername = /^[a-z]{3,8}((\_{0,2})(\d{0,3}))$/;
    let reEmail = /^[A-z\d]{2,}(\.?(\W\D)?[A-z\d]{2,})*\@\w{2,}(\.\w{2,})(\.\w{2,})*$/;
    let rePassword = /([\w\W\D\d]){7,}/;

    let flag = true;


    if(!reUsername.test(reg_username))
    {
      flag = false;
      $("#regErrorUsername").html("Not valid username!");
    }

    else {
      $("#regErrorUsername").html("");

    }


    if(!reEmail.test(reg_email))
    {
      flag = false;
      $("#regErrorEmail").html("Not valid e-mail!");
    }

    else {
      $("#regErrorEmail").html("");

    }

    if(!rePassword.test(reg_password))
    {
      flag = false;
      $("#regErrorPassword").html("At least 7 characters!");
    }

    else {
      $("#regErrorPassword").html("");

    }



    if(flag == true)
    {
      $.ajax({
        url : "/o_bakery/register",
        // url : "app/models/users/register_validation.php",
        dataType : 'json',
        method : 'post',
        data : {
          _username : reg_username,
          _email : reg_email,
          _pass : reg_password

        },
        success : function(data){
          if(data.registered == 1)
          {
            window.location.href = "home";
          }


          if(data.errorUsername)
          {
            $("#regErrorUsername").html(data.errorUsername);
          }
          else {
            $("#regErrorUsername").html("");
          }

          if(data.errorPassword)
          {
            $("#regErrorPassword").html(data.errorPassword);
          }
          else {
            $("#regErrorPassword").html("");
          }

          if(data.errorEmail)
          {
            $("#regErrorEmail").html(data.errorEmail);
          }

          else {
            $("#regErrorEmail").html("");
          }
        },

        error : function(xhr, status, responseText){
          console.log(status);
        }



      });
    }




  });


  // LOGIN

  $("#btn_sign_in").click(function(){

    let sign_in_email = document.querySelector("#sign_in_email").value;
    let sign_in_password = document.querySelector("#sign_in_password").value;

    let reEmail = /^[A-z\d]{2,}(\.?(\W\D)?[A-z\d]{2,})*\@\w{2,}(\.\w{2,})(\.\w{2,})*$/;
    let rePassword = /([\w\W\D\d]){7,}/;

    let flag = true;

    if(!rePassword.test(sign_in_password))
    {
      flag = false;
      $("#signInErrorPassword").html("Not valid password!");
    }

    else {
      $("#signInErrorPassword").html("");

    }


    if(!reEmail.test(sign_in_email))
    {
      flag = false;
      $("#signInErrorEmail").html("Not valid e-mail!");
    }

    else {
      $("#signInErrorEmail").html("");

    }


    if(flag == true)
    {
      $.ajax({
        // url : "app/models/users/login_validation.php",
          url : "/o_bakery/login",
        dataType : 'json',
        method : 'post',
        data : {
          _email : sign_in_email,
          _pass : sign_in_password

        },
        success : function(data)
        {
          if(data.role)
          {
            window.location.href = 'home';
          }


          if(data.errorPassword)
          {
            $("#signInErrorPassword").html(data.errorPassword);
          }
          else {
            $("#signInErrorPassword").html("");
          }

          if(data.errorEmail)
          {
            $("#signInErrorEmail").html(data.errorEmail);
          }
          else {
            $("#signInErrorEmail").html("");
          }
        },
        error : function(xhr, status, responseText)
        {
          console.log(status);
        }



      });
    }


  });



  // SIGN OUT

  $(document).on("click", "#btn_sign_out", function(){
    $.ajax({
      // url : "app/models/users/sign_out.php",
      url : "/o_bakery/logout",
      dataType : 'json',
      success : function(data)
      {

        if(data.logout)
        {
          window.location.href = "home";
        }

      },
      error : function(xhr, status, responseText)
      {
        console.log(status);
      }


    });

  });

  // PRODUCTS BY CATEGORY

  $(document).on("click", "#products_wrapper button", function(){

    let category = this.dataset.id;
    $.ajax({
      // url : "/o_bakery/app/models/products/products_by_category.php",
      url : "/o_bakery/products_by_category",
      dataType : 'json',
      method : 'post',
      data : {
        _category_ID : category
      },
      success : function(data)
      {

          displayProductsByCategory(data.products);

      },
      error : function(xhr, status, responseText)
      {
        console.log(status);
      }


    });


  });


  // ADD A CATEOGRY

  $(document).on("click", "#btn_add_a_category", function(){

    let category_name = $("#add_a_category").val();
    let reCategoryName = /^[A-z]{2,}(\s([A-z]{2,}))*$/;

    if(reCategoryName.test(category_name))
    {
      $("#regErrorAddCategory").html("");
      $.ajax({
        // url : "/o_bakery/app/models/categories/add_a_category.php",
        url : "/o_bakery/add_a_category",
        dataType : 'json',
        method : 'post',
        data : {
          _category_name : category_name
        },
        success : function(data)
        {

          if(data.errAddCategory != "")
          {
            $("#regErrorAddCategory").html(data.errAddCategory);
          }

          else if(data.errAddCategory == "")
          {
            $("#add_a_category").val("");

            // let added_cat = $("#regErrorAddCategory").html("Category added!");
            //
            // $(added_cat).fadeOut(2000);
            window.location.href = '/o_bakery/admin'



          }






        },
        error : function(xhr, status, responseText)
        {
          console.log(status);
        }


      });
    }

    else {
      $("#regErrorAddCategory").html("Incorrect value!");
    }



  });



  // ADD A PRODUCT

  $(document).on("click", "#btn_add_a_product", function(){


    let product_name = $("#add_name_prod").val();
    let product_price = $("#add_price_prod").val();
    let product_description = $("#add_descr_prod").val();


    let product_category = $("#dropdown_categories").val();




    let reProdName = /^[A-z]{2,}((\s[A-z]{2,}))*$/;
    let reProdDescr = /[A-z]{3,}\s*/;
    let rePrice = /^\d?\d{1}\.\d{2}$/;
    let flag = true;


    if(!reProdName.test(product_name))
    {
      flag = false;
      $("#regErrorAddProductName").html("Incorrect name!")

    }

    else {
      $("#regErrorAddProductName").html("")
    }

    if(!reProdDescr.test(product_description))
    {
      flag = false;
      $("#regErrorAddProductDescr").html("Incorrect description!")

    }

    else {
      $("#regErrorAddProductDescr").html("")
    }

    if(!rePrice.test(product_price))
    {
      flag = false;
      $("#regErrorAddProductPrice").html("Incorrect value!")

    }

    else {
      $("#regErrorAddProductPrice").html("")
    }

    if(name_add_img == "")
    {
      flag = false;
      $("#regErrorAddProductImg").html('Please supply image!');

    }
    else {

      let image_size = $("#image_add_product")[0].files[0].size;

      let file_size_mb = Math.round((image_size / 1024));

      let extension = name_add_img.split('.');

      let allowed_ext = extension[1].toLowerCase();

      let errors = '';


      if(((allowed_ext == 'jpg') || (allowed_ext == 'jpeg') || (allowed_ext == 'png')) && file_size_mb < 2048)
      {

          $("#regErrorAddProductImg").html('');

      }

      else {
        flag = false;
        $("#regErrorAddProductImg").html('jpeg / jpg / png & not above 2MB');
      }









      // if((allowed_ext === 'jpg') || (allowed_ext === 'jpeg') || (allowed_ext === 'png'))
      // {
      //   $("#regErrorAddProductImg").html('');
      //
      // }
      //
      // else if((allowed_ext != 'jpg') || (allowed_ext != 'jpeg') || (allowed_ext != 'png')){
      //   flag = false;
      //   $("#regErrorAddProductImg").html('jpg / png / jpeg');
      // }


    }

    if(product_category == "Choose...")
    {
      $("#regErrorAddProductCat").html('Please select category');
    }

    else {
      $("#regErrorAddProductCat").html('');
    }

    if(flag)
    {

      // $.ajax({
      //   url : "/o_bakery/app/models/products/add_a_product.php",
      //   dataType : 'json',
      //   method : 'post',
      //   success : function(data)
      //   {
      //
      //     console.log(data);
      //
      //   },
      //   error : function(xhr, status, responseText)
      //   {
      //     console.log(status);
      //   }
      //
      //
      // });

      let request = new XMLHttpRequest();
      let formData = new FormData();
      let img = $("#image_add_product");


      formData.append('image', img[0].files[0]);
      formData.append('product_name', product_name);
      formData.append('product_price', product_price);
      formData.append('product_descr', product_description);
      formData.append('product_category', product_category);

      // request.open('post', '/o_bakery/app/models/products/add_a_product.php');
      request.open('post', '/o_bakery/add_a_product');
      request.responseType = 'json';
      request.send(formData);

      request.onload = function(e)
      {
        
        window.location.href='/o_bakery/admin';
      //   if(request.response != null)
      //   {
      //
      //
      //   if(request.response.errorName != "")
      //   {
      //     $("#regErrorAddProductName").html("Incorrect name!")
      //   }
      //   else if(request.response.errorName == ""){
      //     $("#regErrorAddProductName").html("")
      //   }
      //
      //
      //   if(request.response.errorDescr != "")
      //   {
      //     $("#regErrorAddProductDescr").html("Incorrect description!")
      //   }
      //   else if(request.response.errorDescr == ""){
      //     $("#regErrorAddProductDescr").html("")
      //   }
      //
      //   if(request.response.errorPrice != "")
      //   {
      //     $("#regErrorAddProductPrice").html("Incorrect value!")
      //   }
      //   else if(request.response.errorPrice == ""){
      //     $("#regErrorAddProductPrice").html("")
      //   }
      //
      //   if(request.response.errorCat != "")
      //   {
      //     $("#regErrorAddProductCat").html('Please select category');
      //   }
      //   else if(request.response.errorCat == ""){
      //     $("#regErrorAddProductCat").html('');
      //   }
      //
      //   if(request.response.errorImg != "")
      //   {
      //     $("#regErrorAddProductImg").html(request.response.errorImg);
      //   }
      //   else if(request.response.errorImg == ""){
      //     $("#regErrorAddProductImg").html("");
      //   }
      // }
      //
      // else {
      //   $("#regErrorAddProductName").html("");
      //   $("#regErrorAddProductDescr").html("");
      //   $("#regErrorAddProductPrice").html("");
      //   $("#regErrorAddProductCat").html('');
      //   $("#regErrorAddProductImg").html("");
      //
      // }
      //
      //
      //
      }



    }





    });








  function displayProductsByCategory(products)
  {
    let x = ``;

    for(let p in products)
    {


        x += `
        <div  class="col-sm-6 col-md-4 col-lg-3 p-b-75 isotope-item">

          <div class="block1">
            <div class="block1-bg wrap-pic-w bo-all-1 bocl12 hov3 trans-04">
              <img src="assets/images/${products[p].image}" alt="${products[p].name}">

              <div class="block1-content flex-col-c-m p-b-46">
                <a href="product" class="capitalizeProductName txt-m-103 cl3 txt-center hov-cl10 trans-04 js-name-b1">
                  ${products[p].name}
                </a>



                <div class="block1-wrap-icon flex-c-m flex-w trans-05">
                  <a target="_blank" data-id = "${products[p].product_ID}" href="/o_bakery/home?product=${products[p].product_ID}" class="block1-icon flex-c-m wrap-pic-max-w">
                    <i class="fa fa-search-plus" aria-hidden="true"></i>
                  </a>




                </div>
              </div>
            </div>
          </div>
        </div>


        `;



    }


    $("#products_grid").html(x);





  }





  // $(document).ready(function(){









      // USERS
  //       $.ajax({
  //
  //         url : "/o_bakery/index.php",
  //         dataType : 'json',
  //         success : function(data)
  //         {
  //
  //           console.log("hi");
  //           displayUsers(data);
  //
  //
  //
  //         },
  //         error : function(xhr, status, responseText)
  //         {
  //           console.log(status);
  //         }
  //
  //
  //       });
  //
  //       function displayUsers(data)
  //       {
  //         let x = ``;
  //         let counter = 1;
  //         for(let i of data)
  //         {
  //           x += `
  //           <tr>
  //             <td data-id=${i.user_ID}>${counter++}</td>
  //             <td>${i.role} </td>
  //             <td>${i.username}</td>
  //             <td>${i.e_mail}</td>
  //             <td>`;
  //
  //             if(i.role == "admin")
  //             {
  //               x += `-`;
  //             }
  //
  //             else {
  //               let register_date_split = i.register_date.split(" ");
  //
  //               let date_register_date_split = register_date_split[0].split("-");
  //               let time_register_date_split = register_date_split[1].split(":");
  //
  //               let time_register_date = time_register_date_split[0] + ":" + time_register_date_split[1];
  //               let date_register_date = date_register_date_split[2] + "/" + date_register_date_split[1] + "/" + date_register_date_split[0];
  //
  //               x += `${date_register_date} ${time_register_date}`;
  //             }
  //
  //
  //
  //
  //              let last_active_split = i.last_visit.split(" ");
  //
  //              let date_last_active_split = last_active_split[0].split("-");
  //              let time_last_active_split = last_active_split[1].split(":");
  //
  //              let date_last_active = date_last_active_split[2] + "/" + date_last_active_split[1] + "/" + date_last_active_split[0];
  //              let time_last_active = time_last_active_split[0] + ":" + time_last_active_split[1];
  //
  //
  //
  //              x += `
  //
  //
  //
  //
  //
  //
  //             </td>
  //             <td>${date_last_active} ${time_last_active}</td>
  //             <td>
  //
  //             `;
  //             if(i.active == 0)
  //             {
  //               x += `<i class="fa fa-red fa-circle"></i>`;
  //             }
  //
  //
  //             else if(i.active == 1){
  //                 x +=  `<i class="fa fa-green fa-circle"></i>`;
  //             }
  //
  //             x += `
  //
  //
  //             </td>
  //
  //           </tr>
  //
  //
  //
  //           `;
  //         }
  //
  //
  //         $("#users_admin").html(x);
  //
  //
  //       }
  //
  // });





});
