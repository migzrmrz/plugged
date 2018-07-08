<div class="row-fluid">
    <h2 class="page-header">Sale Graph Report (15 days)
        <div style="border: 1px double gray;background: whitesmoke;padding: 10px;margin: 0px;text-align: right;float: right">
            ₱ {{number_format($order['Total']['total'],2)}}
        </div>
    </h2>

    <div id="line"></div>
</div>
<div class="row-fluid">
    <div class="col-md-7">
        <h4 class="page-header">Top Products</h4>
        <table class="table">
            <thead>
            <tr>
                <th> No</th>
                <th> Description</th>
                <th style="text-align: center"> Net Amount</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1;?>
            @foreach($orderDetails as $orderDetail)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{!! $orderDetail->product_id?$orderDetail->description:'<b>'.$orderDetail->description.'</b>'!!}</td>
                    <td align="center">₱ {{number_format($orderDetail->total)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-5">
        <h4 class="page-header">Daily Sale Summary</h4>
        <table class="table">
            <thead>
            <th>Category</th>
            <th style="text-align: right">Net Amount</th>
            </thead>
            <tbody>
            @foreach($sale as $key=>$value)
                <tr>
                    <td>{{$key}}</td>
                    <td align="right">₱ {{number_format($value['total'],2)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        
    </div>
</div>
</div>
<br/><br/><br/><br/>
<script>
    $('#line').highcharts({
        colors: ['#562f56'],
        title: {
            text: 'Sale Summary Report',
            x: -20 //center
        },
        subtitle: {
            text: '{{date("M d, Y",strtotime(Session::get('to')))}} <br> by: {{ucwords(Auth::user()->username)}}',
            x: -20
        },
        xAxis: {
            categories: <?php echo json_encode($iv); ?>
        },
        yAxis: {
            title: {
                text: 'Cash in hand (₱)'
            },
            labels: {
                format: '{value:.2f}'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true,
                    formatter: function () {
                        return Highcharts.numberFormat(this.y, 2);
                    }
                },
                enableMouseTracking: false
            }
        },
        tooltip: {
            headerFormat: '',
            valuePrefix: '$'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [
            {
                name: 'Daily',
                marker: {symbol: "circle"},
                data:<?php echo json_encode($daily); ?>
            }
        ]
    });
</script>