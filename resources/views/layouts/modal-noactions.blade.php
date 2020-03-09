<div class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog @yield('modalclass')" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">@yield('title')</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				@yield('content')
			</div>
		</div>
	</div>
</div>