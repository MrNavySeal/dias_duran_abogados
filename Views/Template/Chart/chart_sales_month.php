<?php $ingresos = $data['dataingresos'];?>
<script>
    Highcharts.chart('monthChart', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Ventas del mes de <?=$ingresos['month']." ".$ingresos['year']?>'
        },
        subtitle: {
            text: `Ventas: <?=formatNum($ingresos['total'])?>`
        },
        xAxis: {
            categories: [
                <?php
                    
                    for ($i=0; $i < count($ingresos['sales']) ; $i++) { 
                        echo $ingresos['sales'][$i]['day'].",";
                    }
                ?>
            ]
        },
        yAxis: {
            title: {
                text: ''
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Ventas',
            data: [
                <?php
                    
                    for ($i=0; $i < count($ingresos['sales']) ; $i++) { 
                        echo $ingresos['sales'][$i]['total'].",";
                    }
                ?>
            ]
        },]
    });
</script>