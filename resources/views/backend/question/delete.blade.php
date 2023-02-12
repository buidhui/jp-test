<div id="delete_{{$item->id}}" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
					<i class="fa fa-remove"></i>
				</div>						
				<h4 class="modal-title w-100">Bạn có chắc chắn xóa?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Lưu ý: Nếu đồng ý xóa sẽ xóa hoàn toàn khỏi dữ liệu của hệ thống và không thể khôi phục lại được</p>
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button>
				<a href="{{ route("question.delete", ['id_test' => $id,'id' =>$item->id]) }}">			
					<button type="button" class="btn btn-danger">Xóa</button>
				</a>
			</div>
		</div>
	</div>
</div>     
