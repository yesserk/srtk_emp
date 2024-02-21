
@extends('layouts.master')
@section('title')

@endsection

@section('content')
<style>
.bg-fool {
    background: -webkit-gradient(linear, left top, right top, from(#ffb6c1), to(#ff69b4)) !important;
    background: linear-gradient(to right, #ffb6c1, #ff69b4) !important;
}
.bg-fool1 {
    background: -webkit-gradient(linear, left top, right top, from(#a1f4db), to(#13547a)) !important;
    background: linear-gradient(to right, #a1f4db, #13547a) !important;
}
.bg-fool2 {
    background: -webkit-gradient(linear, left top, right top, from(#add8e6), to(#001f3f)) !important;
    background: linear-gradient(to right, #add8e6, #001f3f) !important;
}
#pieChartContainer {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 250px;
        }

        #pieChart {
            width: 80%; /* Adjust the width as needed */
        }

</style>


<h1 style="color:dodgerblue">إحصائيات</h1><br/>

<div class="col-md-6 form-group">
    <div class="card-body">
        <form class="form-inline" method="GET" action="{{ route('filtre') }}">
            <div class="row">
                <div class="col-md-5" style="margin-bottom:5px">
                <label for="filterOption" class="mr-2">التصفية حسب التاريخ</label>
            <select name="filterOption" id="filterOption" onchange="toggleDateFields()" class="form-control form-control-sm mr-2 ">
                <option value="today">اليوم</option>
                <option value="ce_mois">الشهر الحالي</option>
                <option value="personnaliser">اختيار المدة</option>
            </select>
                </div>
                <div class="col-md-5" id="dateFields" style="display:none;">
    <div class="row">
        <div class="col-md-6">
            <label for="startDate">تاريخ البداية</label>
            <input type="date" id="startDate" name="startDate" class="form-control form-control-sm">
        </div>
        <div class="col-md-6">
            <label for="endDate">تاريخ النهاية</label>
            <input type="date" id="endDate" name="endDate" class="form-control form-control-sm">
        </div>
    </div>
</div>
<div class="col-md-2">
<button type="submit" class="btn btn-primary btn-sm" style="margin-top:20%"><i class="mdi mdi-magnify"></i></button>
</div>

            </div>
           
           

           
        </form>
    </div>
</div>

<div class="row">
<h2>احصائيات النقل</h2>


              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h2 class="font-weight-normal mb-3">مداخيل النقل الحضري    <i class="mdi mdi-cash-multiple mdi-24px float-right"></i>
                    </h2>
                    <h2 class="mb-5"><?php echo number_format($totalMontantU, 0, '.', '.');
?></h2>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h2 class="font-weight-normal mb-3">مداخيل النقل البلدي <i class="mdi mdi-cash-multiple mdi-24px float-right"></i>
</h2>
                    <h2 class="mb-5"><?php echo number_format($totalMontantB, 0, '.', '.')?></h2>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h2 class="font-weight-normal mb-3"> مداخيل النقل بين المدن <i class="mdi mdi-cash-multiple mdi-24px float-right"></i>
                    </h2>
                    <h2 class="mb-5"><?php echo number_format($totalMontantV, 0, '.', '.') ?></h2>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h2 class="font-weight-normal mb-3">مجموع مداخيل السفرات <i class="mdi mdi-cash-multiple mdi-24px float-right"></i>
                    </h2>
                    <h2 class="mb-5"><?php echo number_format($Totale, 0, '.', '.')  ?></h2>
                  </div>
                </div>
              </div>
            </div><br/>
<h2 style="margin-right:5px">احصائيات الرحلات</h2>

<div class="row">
    <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">عدد الرحلات حسب طريقة الدفع</h4>
                <div id="pieChartContainer">
                <canvas id="barChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-fool card-img-holder text-white">
            <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h2 class="font-weight-normal mb-3">مداخيل الرحلات المدفوعة نقدا   <i class="mdi mdi-cash-multiple mdi-24px float-right"></i>
                </h2>
                <h2 class="mb-5"><?php echo number_format($cashT, 0, '.', '.')?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-fool2 card-img-holder text-white">
            <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h2 class="font-weight-normal mb-3">مداخيل الرحلات المدفوعة بالشيك    <i class="mdi mdi-cash-multiple mdi-24px float-right"></i>
                </h2>
                <h2 class="mb-5"><?php echo number_format($chequeT, 0, '.', '.') ?></h2>
            </div>
        </div>
    </div>
</div>

<script>
   document.addEventListener("DOMContentLoaded", function () {
    var canvas = document.getElementById("barChart");
    var ctxB = canvas.getContext('2d');

    var myBarChart = new Chart(ctxB, {
        type: 'bar', // Change the chart type to 'bar'
        data: {
            labels: ["الدفع نقدا", "الدفع بالشيك"],
            datasets: [{
                data: [<?php echo $cashCount ?>, <?php echo $chequeCount?>],
                backgroundColor: ["#FD8787", "#7AE9FD"],
                hoverBackgroundColor: ["#FD8787", "#7AE9FD"]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            plugins: {
                datalabels: {
                    formatter: (value, context) => {
                        return context.chart.data.labels[context.dataIndex] + ': ' + value;
                    },
                    color: 'white',
                    align: 'end',
                    anchor: 'end',
                    offset: -10,
                    font: {
                        size: '12',
                        weight: 'bold'
                    }
                }
            }
        }
    });
});


    function toggleDateFields() {
    var filterOption = document.getElementById("filterOption");
    var dateFields = document.getElementById("dateFields");

    if (filterOption.value === "personnaliser") {
        dateFields.style.display = "block";
    } else {
        dateFields.style.display = "none";
    }
}

</script>
        


            

@endsection