<h2 class="page-header">{{isset($product_category)?'Edit':'New'}} Product Category</h2>
@if(isset($product_category))
    {!! Form::model($product_category,["id"=>"frm","class"=>"form-horizontal","method"=>"put"]) !!}
@else
    {!! Form::open(["id"=>"frm","class"=>"form-horizontal"]) !!}
@endif
<div class="form-group required" id="form-name-error">
    {!! Form::label("name","Name",["class"=>"control-label col-md-2"]) !!}
    <div class="col-md-5">
        {!! Form::text("name",null,["class"=>"form-control required","id"=>"focus"]) !!}
        <span id="name-error" class="help-block"></span>
    </div>
</div>
<div class="form-group" id="form-ordering-error">
    {!! Form::label("ordering","Ordering",["class"=>"control-label col-md-2"]) !!}
    <div class="col-md-5">
        {!! Form::text("ordering",null,["class"=>"form-control required"]) !!}
        <span id="ordering-error" class="help-block"></span>
    </div>
</div>
<div class="form-group">
    <div class="col-md-5 col-md-push-2">
        <a href="javascript:ajaxLoad('product_category')" class="btn btn-danger"><i
                    class="glyphicon glyphicon-backward"></i>
            Back</a>
        {!! Form::button("<i class='glyphicon glyphicon-floppy-disk'></i> Save",["type" => "submit","class"=>"btn
    btn-primary","id"=>"btn_save"])!!}
    </div>
</div>
{!! Form::close() !!}