@extends('doctor.layouts.app')
@section('doctor')
<div class="breadcrumbs">
  <div class="col-sm-4">
    <div class="page-header float-left">
      <div class="page-title">
        <h1>Dashboard</h1>
      </div>
    </div>
  </div>
  <div class="col-sm-8">
    <div class="page-header float-right">
      <div class="page-title">
        <ol class="breadcrumb text-right">
          <li class="active">All Patient</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <strong class="card-title">All Patient</strong>
          </div>
          <div class="card-body">

            <div class="col-lg-8">
              <h4 class="mb-3">Patient's Graph </h4>
              <canvas id="myChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- .animated -->
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

  <script>
    var patientDetails;
    $.ajax({
      type: "GET",
      url: "{{ route('doctor-patient-graph-chart') }}",
      cache: false,
      success: function(data) {
        patientDetails = data;
      },
      async: false
    });
    var patientNumber = patientDetails.map((data) => data.views);
    var patientDate = patientDetails.map((data) => data.date);
    var ctx = document.getElementById("myChart");
    ctx.height = 150;
    var ticks = [0, 10, 20, 30, 40, 50, 60, 70, 80, 90];
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: patientDate,
        type: 'line',
        defaultFontFamily: 'Montserrat',
        datasets: [{
          data: patientNumber,
          label: "Patient",
          backgroundColor: 'rgba(0,103,255,.15)',
          borderColor: 'rgba(0,103,255,0.5)',
          borderWidth: 3.5,
          pointStyle: 'circle',
          pointRadius: 5,
          pointBorderColor: 'transparent',
          pointBackgroundColor: 'rgba(0,103,255,0.5)',
        }, ]
      },
      options: {
        responsive: true,
        tooltips: {
          mode: 'index',
          titleFontSize: 12,
          titleFontColor: '#000',
          bodyFontColor: '#000',
          backgroundColor: '#fff',
          titleFontFamily: 'Montserrat',
          bodyFontFamily: 'Montserrat',
          cornerRadius: 3,
          intersect: false,
        },
        legend: {
          display: false,
          position: 'top',
          labels: {
            usePointStyle: true,
            fontFamily: 'Montserrat',
          },


        },
        scales: {
          xAxes: [{
            display: true,
            gridLines: {
              display: true,
              drawBorder: true
            },
            scaleLabel: {
              display: true,
              labelString: 'Date'
            }
          }],
          yAxes: [{
            display: true,
            beginAtZero: true,
            ticks: {
              min: 1,
              beginAtZero: true,
            },

            gridLines: {
              display: true,
              drawBorder: true
            },
            scaleLabel: {
              display: true,
              labelString: 'No. of Patients'
            }
          }]
        },
        title: {
          display: false,
        }
      }
    });
</script>
  @endsection