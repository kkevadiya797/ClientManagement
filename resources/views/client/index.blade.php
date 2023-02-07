@extends('app')

@section('pageTitle')
    Client
@endsection

@section('content')
	
		<section class="section">
			<div class="section-header">
				<h1>@yield('pageTitle')</h1>
				<div class="section-header-breadcrumb">
					<div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
					<div class="breadcrumb-item">@yield('pageTitle')</div>
				</div>
			</div>

			<div class="section-body">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<a href="{{ route('client.create') }}" class="btn btn-primary mb-2">
									<i class="fe-user-plus mr-1"></i>
									Add Client
								</a>
								<div class="table-responsive">
									{!! $html->table(['class' => 'table table-striped', 'id' => 'client-table'], true) !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

@endsection

@section('middleCss')
	<link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection


@section('middleJs')
	<!-- JS Libraies -->
  <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
  <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js') }}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>


	<script>
		function deleteuser(id) {
			var c_id = id;
			swal({
					title: "Are you sure?",
					text: "You won't be able to revert this!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
			}).then((result) => {
					if (result) {
							$.ajaxSetup({
									headers: {
											'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
									}
							});
							$.ajax({
									url: '{{ route('client.delete') }}',
									data: {
											id: c_id
									},
									type: 'post',
									success: function(response) {
											if (response == "success") {
													swal({
															title: "Deleted !",
															text: "Successfull deleted product",
															type: "success",
															timer: 500,
															showConfirmButton: false
													})
													iziToast.success({
														title: "",
														message: "Successfully deleted.",
														position: 'topRight'
													});
													$("#del_" + c_id).closest("tr").fadeOut(1000);
											} else {
													swal({
															title: "Deleted !",
															text: "Error while deleting Client",
															type: "error",
															timer: 500,
															showConfirmButton: false
													})
											}
									}
							});
					}
			});
		}

	</script>
@endsection

@section('lowerJs')

    {!! $html->scripts() !!}

@endsection