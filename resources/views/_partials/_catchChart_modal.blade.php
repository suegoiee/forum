<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog printModal">
        <div class="modal-content">
            {{ Form::open(['method' => 'PUT','class'=>'ruleForm']) }}
                <div class="modal-header">
                    <h4 class="modal-title">預覽</h4>
                </div>
                <div class="modal-body" style="height: 70vh;">
                    <canvas id="myCanvas"></canvas>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">取消</button>
                    <a id="download" class="btn" download="myImage.jpg" href="" onclick="download_img(this);">下載</a>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
