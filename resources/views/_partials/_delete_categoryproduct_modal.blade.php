<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {{ Form::open(['route' => $route,'method' => 'POST','class'=>'ruleForm']) }}
                <input type="hidden" name="id" value="{{ $delete_id }}">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $title }}</h4>
                </div>
                <div class="modal-body" style="height: auto;">
                    {!! $body !!}
                </div>
                <div class="modal-footer">
                    <button type="cancel" class="cancel" data-dismiss="modal">取消</button>
                    {{ Form::submit($submit ?? $title, ['class' => 'btn']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
