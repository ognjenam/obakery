
$(document).ready(function(){


  $.ajax({
    url : "/o_bakery/visits",
    // url : "/o_bakery/app/models/visits/visits.php",
    dataType : 'json',
    success : function(data)
    {

      let visits = data.visits.number;
      fillChart(visits);



    },
    error : function(xhr, status, responseText)
    {
      console.log(status);
    }


  });

  function fillChart(visits)
  {

    let current_time = new Date();




    var doughnutPieData = {
      datasets: [{
        data: [visits],
        backgroundColor: [

          'rgba(255, 206, 86, 0.5)',


        ],
        borderColor: [

          'rgba(255, 159, 64, 1)'
        ],
      }],

      // These labels appear in the legend and in the tooltips when hovering different arcs
      labels: [
        `${current_time.getFullYear()}`
      ]
    };
    var doughnutPieOptions = {
      responsive: true,
      animation: {
        animateScale: true,
        animateRotate: true
      }
    };

    // Get context with jQuery - using jQuery's .get() method.



    if ($("#pieChart").length) {
      var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
      var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: doughnutPieData,
        options: doughnutPieOptions
      });
    }

  }



})
