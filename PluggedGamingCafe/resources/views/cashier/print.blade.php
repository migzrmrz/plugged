<!--<center>
    <img src="{{asset('images/logo.png')}}" height=80px" width="150px"/>
    <h2 style="font-size:16px;margin:0">Plugged Board Cafe and Gaming Lounge</h2>
    <i style="font-size:11px;width:90%;display:block">Address: 16 Legarda Road, Baguio City
        Contact Number: (+63) (917) 853-1817 </i>
    <h3 style="padding: 0px;margin: 0px"></h3>
</center>-->
<hr style="size:2px;border:inset;margin-top: 0px;padding-top: 0px">
<table style="width:100%;font-size:12px">
    <tr>
        <td width="80px" style="text-align:right">Id #:</td>
        <td style="text-align:left">{{str_pad($order->id,6,0,0)}}</td>
        <td style="width:60px;text-align:right">Date:</td>
        <td style="text-align:left;width:100px">{{date("d-M-Y",strtotime($order->updated_at))}}</td>
    </tr>
    <tr>
        <td width="80px" style="text-align:right">Table No:</td>
        <td style="text-align:left">{{$order->table->name}}</td>
        <td style="width:60px;text-align:right">Cashier:</td>
        <td style="text-align:left;width:100px">{{ucwords(Auth::user()->username)}}</td>
    </tr>
    <tr>
        <td width="80px" style="text-align:right">Customer:</td>
        <td style="text-align:left">{{!empty($order->customer_id)&&$order->customer_id!='-1'?$order->customer->name:'General'}}</td>
    </tr>
</table>
<table style="width:100%;margin-top:10px" border="0" cellspacing="0" cellpadding="2px">
    <tr style="font-size:13px">
        <th width="20px">No</th>
        <th>Description</th>
        <th style="width:8%;text-align: center;">Qty</th>
        
        {{--<th style="width:12%">D.C</th>--}}
        
    </tr>
    <tr style="font-size:14px">
        <th colspan="6" align="left">
            <hr>
        </th>
    </tr>
    <?php $total = 0;$i = 1 ?>
    @foreach($order->order_details()->select(DB::raw("description,sum(quantity) as quantity,price,discount"))->groupBy('product_id')->groupBy('price')->groupBy('description')->groupBy('discount')->orderBy('description')->get() as $orderDetail)
        <tr style="font-size:11px;@if(!empty($orderDetail->deleted_at)) text-decoration: line-through; @endif">
            <td align="center">{{$i++}}</td>
            <td align="center">{{$orderDetail->description}}</td>
            <td align="center">{{$orderDetail->quantity}}</td>
            
            {{--<td align="center">{{$orderDetail->discount}}%</td>--}}
            <td align="right">
               
            
        </tr>
    @endforeach
</table>
<hr>
<table width="100%">
    <tr>
        <td align="right">
            <table width="100%" style="font-size: 12px">
                @if($order->discount>0)
                    
                    
                @endif
                <tr>
                   
                </tr>
            </table>
        </td>
    </tr>
</table>
<hr>

<script>
    //    window.print();
    //    window.close();
</script>