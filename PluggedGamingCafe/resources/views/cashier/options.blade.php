<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title">Options</h4>
</div>
<div class="modal-body">
    <div class="row">
        <tr>
        
<table style="width:100%;font-size:12px">
</table>
<table style="width:100%;margin-top:10px" border="0" cellspacing="0" cellpadding="2px">
    <tr style="font-size:13px">
        <th width="20px">No</th>
        <th>Description</th>
        <th style="width:8%;text-align: center;">Takeout</th>
        <th style="width:8%;text-align: center;">Discount</th>
        
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
            <td align="center"><input type="checkbox" onchange="ajaxLoad('cashier/update-description/{{$orderDetail->id}} Takeout/'+this.value,)" style="width: 18px;height: 18px" value="{{$orderDetail->description}} (Takeout)"
                             class="idRow"/></td>
            <td align="center"><input type="checkbox" onchange="ajaxLoad('cashier/update-description/{{$orderDetail->id}} Takeout/'+this.value,)" style="width: 18px;height: 18px" value="{{$orderDetail->description}} (Takeout)"
                             class="idRow"/></td>
            
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
            

        </tr>
    </div>
</div>