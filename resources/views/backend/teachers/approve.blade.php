<div id="approve_{{$item->id}}" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
					<i class="fa fa-shield"></i>
				</div>						
				<h4 class="modal-title w-100">Chắc chắn duyệt?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Lưu ý: Kiểm tra kỹ thông tin hồ sơ của giáo viên mới được duyệt và xếp lịch phỏng vấn</p>
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button>
				<a href="{{ route("teachers.Approval", $item->id) }}">				
					<button type="button" class="btn btn-danger">Xét duyệt</button>
				</a>
			</div>
		</div>
	</div>
</div>     
