<h2 class="page-header">Daily Summary Report</h2>
<div class="row">
    <div class="col-sm-3 form-group">
        <div class='input-group date'>
<span class="input-group-addon">
<i class="glyphicon glyphicon-calendar"></i>
</span>
            <input type='text' class="form-control" value="{{date('d-M-Y',strtotime(Session::get('report_from')))}}"
                   id="report_from"/>
        </div>
    </div>
    <!--<div class="form-group col-sm-3">
        <a href="javascript:window.open('report/print-daily-summary?report_from='+$('#report_from').val(),'_blank');"
           class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Print</a>
    </div>-->
</div>
<h2 style="text-align: center;padding: 10px;background: whitesmoke">
    ₱ {{number_format($orders['Total']['total'],2)}}</h2>
<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="text-align: center">Category</th>
                <th style="text-align: center">Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sale as $key=>$value)
                @if($key!='Total')
                    <tr style="font-size: 14px">
                        <td>{{$key}}</td>
                        <td align="right">₱ {{number_format($value['total'],2)}}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        
    </div>
</div>
<script>
    var old_date = $('#report_from').val();
    $('#report_from').pickadate({
        format: "dd-mmm-yyyy",
        selectMonths: true,
        selectYears: true,
        onOpen: function () {
            old_date = $('#report_from').val();
        },
        onClose: function () {
            if (this.get('select', 'dd-mmm-yyyy') != old_date)
                ajaxLoad('report/daily-summary?report_from=' + this.get('select', 'yyyy-mm-dd'));
        }
    });
</script>
<h2 class="page-header">Sale Discount Report </h2>
<table class="table" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th style="text-align: center" width="100px"> No</th>
        <th> Customer</th>
        <th style="text-align: right"> Total</th>
    </tr>
    </thead>
    <tbody>
    <?php $total = 0; $i = 1;?>
    @foreach($discount as $s)
        <tr>
            <td align="center">{{$i++}}</td>
            <td>{{$s->customer_id==0?'Customer':$s->customer->name}}</td>
            <td align="right">₱{{number_format($s->total,2)}}</td>
        </tr>
        <?php $total += $s->total; ?>
    @endforeach
    </tbody>
</table>
<div style="text-align: right;float: right;border-top: solid 1px whitesmoke;margin-top: 10px;">
    <table width="100%" style="margin-top: 10px;margin-bottom: 10px">
        <tr>
            <th style="text-align: right;padding-right: 20px">Total:</th>
            <th style="text-align: right">₱ {{number_format($total,2)}}</th>
        </tr>
    </table>