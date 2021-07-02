<div class="row">
    <div class="col-md-1">
        <div class="form-group">
            <label>{{__('thutu')}}</label>
            {!! Form::number('stt_view[]', 1, ['class' => 'form-control', 'required' => true]) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>{{__('nam')}}</label>
            {!! Form::number('time_event[]', null, ['class' => 'form-control', 'required' => true]) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>{{__('tieude')}}</label>
            {!! Form::text('title[]', null, ['class' => 'form-control', 'required' => true]) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{__('noidung')}}</label>
            {!! Form::text('content[]', null, ['class' => 'form-control', 'required' => true]) !!}
        </div>
    </div>
</div>
