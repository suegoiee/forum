<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog printModal">
        <div class="modal-content">
            {{ Form::open(['method' => 'PUT','class'=>'ruleForm']) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">預覽</h4>
                </div>
                <div class="modal-body" style="height: auto;">
                    <canvas id="myCanvas" style="max-width:100%; height: auto;"></canvas>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <a id="download" download="myImage.jpg" href="" onclick="download_img(this);">下載</a>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
