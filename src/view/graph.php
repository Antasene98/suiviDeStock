<?php session_unset();?>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body style="background-image: url(../../public/img/background.jpg);">
<?php require('./header.php');
 ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
            
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Diagramme en barre des produits</h2>
                    </div>
                    <?php
                        if($result->num_rows > 0){
                       
                                while($row = mysqli_fetch_array($result)){
                                    $chart_data="";
                                        $productname[]  = $row['nom']  ;
                                        $stock[] = $row['qtStock'];
                                }
                            
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>Pas de produit trouver.</em></p>";
                        }
                    ?>
                </div>
            </div>        
        </div>
    </div>
<div style="width:30%;text-align:center;margin:auto">
            <canvas  id="chartjs_bar"></canvas> 
        </div>    
        <?php require('./footer.php');?>


</body>

</html>

<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($productname); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($stock); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: false,
                        position: 'bottom',
 
                       
                    },
                   
 
                }
                });
    </script>
