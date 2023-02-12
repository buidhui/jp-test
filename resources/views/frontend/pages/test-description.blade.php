<div class="modal fade" id="testDescription_{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="padding: 1rem 1rem;">
                <h5 class="modal-title" id="exampleModalLabel">{{ $item->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="    margin-right: 16px;
                    font-size: 25px;">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 1rem !important; text-align: left;">
                <h5 class="text-danger">
                    {{ $item->cate->name }}
                </h5>
                <p class="mt-2" style="text-align: justify;">
                    {!! $item->cate->description !!}
                </p>
            </div>
            <div class="modal-footer" style="display: block;">
                <button type="button" class="btn btn-primary btn-close" data-dismiss="modal" style="float: left;">Quay lại</button>
                <a href="{{ route('get.exam', ['id'=>$item->id, 'id_question' => $question_first->id]) }}" class="btn btn-danger" style="float: right;">Bắt đầu làm bài thi</a>
            </div>
        </div>
    </div>
</div>
