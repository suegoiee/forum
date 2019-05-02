<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="width:65%;">
        <div class="modal-content">
            {{ Form::open(['method' => 'PUT']) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">列印</h4>
                </div>
                <div class="modal-body">
                    <canvas id="myCanvas"></canvas>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    {{ Form::submit($submit ?? $title, ['class' => 'btn']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
