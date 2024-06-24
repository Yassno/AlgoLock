@extends('admin.layouts.master')
@section('title', 'E-Learning | HOME')
@section('content')
<main id="main" class="main">
    <section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
        <div class="row">
            <!-- Carte de Teachers -->
            <div class="col-md-3">
            <div class="card info-card sales-card">
                <div class="card-body">
                <h5 class="card-title">Teachers <span>| Total</span></h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa fa-chalkboard-user" aria-hidden="true"></i>
                    </div>      
                    <div class="ps-3">
                    <h6>{{ $totalTeachers or 0 }}</h6>
                    </div>
                </div>
                </div>
            </div>
            </div><!-- Fin de la carte de Teachers -->

            <!-- Carte de Students -->
            <div class="col-md-3">
            <div class="card info-card revenue-card">
                <div class="card-body">
                <h5 class="card-title">Students <span>| Total</span></h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa fa-user-graduate" aria-hidden="true"></i>
                    </div>
                    <div class="ps-3">
                    <h6>{{ $totalStudents or 0 }}</h6>
                    </div>
                </div>
                </div>
            </div>
            </div><!-- Fin de la carte de Students -->

            <!-- Carte de Courses -->
            <div class="col-md-3">
            <div class="card info-card customers-card">
                <div class="card-body">
                <h5 class="card-title">Courses <span>| Total</span></h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    </div>
                    <div class="ps-3">
                    <h6>{{ $totalCourses or 0 }}</h6>
                    </div>
                </div>
                </div>
            </div>
            </div><!-- Fin de la carte de Courses -->

            <!-- Carte de Certified Students -->
            <div class="col-md-3">
            <div class="card info-card sales-card">
                <div class="card-body">
                <h5 class="card-title">Certified Students <span>| Total</span></h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="color: black;">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    </div>

                    <div class="ps-3">
                    <h6>{{ $totalCertified or 0 }}</h6>
                    </div>
                </div>
                </div>
            </div>
            </div><!-- Fin de la carte de Certified Students -->
        </div>
        </div>

        <div class="col-lg-12">
        <div class="row">
            <!-- Rapports -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filtre</h6>
                    </li>


                    <li><a class="dropdown-item" href="#">Aujourd'hui</a></li>
                    <li><a class="dropdown-item" href="#">Ce mois-ci</a></li>
                    <li><a class="dropdown-item" href="#">Cette année</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Rapport d'Activité des Utilisateurs <span>/Cette semaine </span></h5>

                  <!-- Graphique en Ligne -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Number of Teachers',
                          data: [0, 3, 5, 15, 12, 20, 34],
                        }, {
                          name: 'Students',
                          data: [0, 32, 45, 55, 49, 60, 64]
                        }, {
                          name: 'Certfied Students',
                          data: [0, 10, 14, 18, 21, 24, 28]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#48FF5C', '#000'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: [ "November 2023", "December 2023", "January 2024", "February 2024", "March 2024", "April 2024", "June 2024"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- Fin du Graphique en Ligne -->

                </div>

              </div>
            </div><!-- Fin des Rapports -->


            <!-- Top 4 Teacher Rank -->
            <div class="col-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Top 4 Teacher Rank</h5>
                <ul class="top-teachers">
                    @foreach($topTeachers as $teacher)
                    <li>
                    <p>{{ $teacher->name }}</p>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $teacher->point }}%;" aria-valuenow="{{ $teacher->point }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    </li>
                    @endforeach
                </ul>
                </div>
            </div>
            </div><!-- Fin de Top4 Teacher Rank -->
        </div>
        </div>
    </div>
    </section>
</main>


@stop