<div class="modal-body">
    <div class="row">
        <div class="col-md-7">
            <table class="table">
                <thead>
                <tr>
                    <th>Description</th>
                    <th>Qty</th>
                    <th align="right">Price</th>
                    <th align="right">Total</th>
                    <th align="right">Discount</th>
                </tr>
                </thead>
                @if(count($order)>0)
                    <tbody>
                    <?php $total = 0; $ntotal = 0; $totDisc=0;$disc=0;?>
                    @foreach($order->order_details()->select(DB::raw("description,sum(quantity) as quantity,price,discount,Owner,PWD,Senior"))->groupBy('product_id')->groupBy('price')->groupBy('description')->groupBy('discount')->groupBy('Owner')->groupBy('PWD')->groupBy('Senior')->orderBy('description')->get() as $orderDetail)
                        <tr @if(!empty($orderDetail->deleted_at)) style="text-decoration: line-through;" @endif>
                            <td>
                                {{$orderDetail->description}}
                            </td>
                            <td>
                                {{$orderDetail->quantity}}
                            </td>
                            <td align="right">₱ {{number_format($orderDetail->price,2)}}</td>
                            <td align="right">
                                ₱ {{number_format($orderDetail->price * $orderDetail->quantity,2)}}</td>
                            <td align="right">
                           <?php
                            $disc=$orderDetail->Owner * $orderDetail->price+$orderDetail->PWD * $orderDetail->price*.2+$orderDetail->Senior * $orderDetail->price*.2;
                            $totDisc+=$disc;
                            ?>
                            
                            ₱ {{number_format($disc,2)}}</td>
                        </tr>
                        
                        <?php if (empty($orderDetail->deleted_at)) $ntotal += ($orderDetail->price * $orderDetail->quantity); ?>
                                         
                    @endforeach
                    </tbody>
                @endif
            </table>
            @if(count($order)>0)
                <div style="text-align: right;float: right;border-top: solid 1px whitesmoke;">
                    <table width="100%">
                         <tr>
                            <th style="text-align: right;padding-right: 20px">Total:</th>
                            <th style="text-align: right">₱ {{number_format($ntotal,2)}}</th>
                        </tr>
                        <tr>
                            <th style="text-align: right;padding-right: 20px">Discount:</th>
            
                            <th style="text-align: right">{{number_format($totDisc,2)}}</th>
                        </tr>
                        <tr>
                            <th style="text-align: right;padding-right: 20px">Total Amount without VAT:</th>
                           <?php $total=$ntotal-$totDisc;$total=$total-($total*.12)?>
                            <th style="text-align: right">₱ {{number_format($total,2)}}</th>
                        </tr>
                        
                        <tr>
                            <th style="text-align: right;padding-right: 20px">VAT:</th>
                            <?php $total=$ntotal-$totDisc;?>
                            <th style="text-align: right">₱ {{number_format($total*.12,2)}}</th>
                        </tr>
                        <tr>
                            <th style="text-align: right;padding-right: 20px">Total Amount DUE:</th>
                           <?php $total=$ntotal-$totDisc;?>
                            <th style="text-align: right">₱ {{number_format($total,2)}}</th>
                        </tr>
                    </table>
                </div>
            @endif
        </div>
        <div class="col-md-5">
            <div class="form-group required" id="form-usd-error">
                {!! Form::label("usd","Cash in Php",["class"=>"control-label"]) !!}
                {!! Form::text("usd",0,["class"=>"form-control required","id"=>"focus","autocomplete"=>"off"]) !!}
                <span id="usd-error" class="help-block"></span>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <p id="msg" style="display: none;color: blue;float: left;">{{env('success_msg')}}</p>
    {!! Form::button("<i class='glyphicon glyphicon-remove'></i> Close",["class"=>"btn
    btn-primary","data-dismiss"=>"modal"])!!}
    {!! Form::button("<i class='glyphicon glyphicon-floppy-disk'></i> Save",["type" => "submit","class"=>"btn
    btn-primary","id"=>"btn_save"])!!}
</div>