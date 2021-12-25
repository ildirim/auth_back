<div class="modal fade" id="modal-create-card">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
				<h2>New card no</h2>
				<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
					<span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
								<rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
								<rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
							</g>
						</svg>
					</span>
				</div>
			</div>
			<div class="modal-body">
				<form class="form" action="{{ route('storeCard') }}" method="post">
					@csrf
					<div class="form-group">
						<label class="d-flex align-items-center fs-5 fw-bold mb-2">
							<span class="required">Card no</span>
						</label>
						<input type="text" class="form-control custom-req" name="card_no" />
					</div>
					<div class="form-group">
						<button id="btn-store-probe" class="btn btn-sm btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>