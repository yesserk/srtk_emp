
<style>
    .table{
        font-size:15px;
        text-align: center;
        border-collapse: collapse;
        width: 100%;

    }
    .table thead{
        font-weight: bold;
            }

            body {
        direction: rtl;
        font-family: DejaVu Sans, sans-serif;
    }
      th, td {
        border: 0.5px solid black;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #B9DCFF; /* Optional: Add a background color to the header row */
    }

</style>
<body>
<h3 style="text-align:center;color:#3399FF;margin-bottom:5%"> <?= $employee->nom ?><br> رحلات   <?php 
  if($deb=='' and $fin==''){
    echo $datee;
  }
  else if($deb!='' and $fin==''){
echo $deb . ' - '. $datee;
  }
  else{
    echo $deb . ' - '. $fin;
  }
?></h3>
<table class="table table-bordered">
                <thead>
                    <tr>
                        <th> ساعة الإنطلاق </th>
                        <th> الخط</th>
                        <th> الرمز</th>
                        <th> الحافلة</th>
                    </tr>
                </thead>
                <tbody>
        <?php foreach($voyage as $v){?>
                <tr>
            <td><?= $v->heur_depart ?></td>
            <td><?= $v->ligne ?></td>
            <td><?=  $v->ligne_id ?></td>
            <td><?=  $v->bus_id ?></td>
                   </tr>

  <?php }?>
        
</tbody>


            </table>

   



</body>
    