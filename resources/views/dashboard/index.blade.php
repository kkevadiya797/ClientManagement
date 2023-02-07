@extends('app')

@section('pageTitle')
    Dashboard
@endsection

@section('content')

	<section class="section">
		<div class="section-header">
			<h1>@yield('pageTitle')</h1>
		</div>
		<div class="row">
			{{-- Start Project Chart --}}
			<div class="col-12 col-md-6 col-lg-6">
				<div class="card">
					<div class="card-header">
						<h4>TOTAL PROJECTS</h4>
						<a href="{{ route('project') }}" class="btn btn-outline-primary">See All</a>
					</div>
					<div class="card-body">
						<canvas id="project_chart"></canvas>
					</div>
				</div>
			</div>
			{{-- End Project Chart --}}
			<div class="col-12 col-md-6 col-lg-6">
				{{-- Start Client Count --}}
				<div class="col-md-6 col-sm-6 col-12">
					<div class="card card-statistic-1">
						<div class="card-icon bg-primary">
							<i class="far fa-user"></i>
						</div>
						<div class="card-wrap">
							<div class="card-header">
								<h4><a class="font-weight-bold text-muted" style="text-decoration:none;" href="{{ route("client") }}">Total Clients</a></h4>
							</div>
							<div class="card-body">
								{{ $client_counts }}
							</div>
						</div>
					</div>
				</div>
				{{-- End Client Count --}}
				{{-- Start Staff Count --}}
				<div class="col-md-6 col-sm-6 col-12">
					<div class="card card-statistic-1">
						<div class="card-icon bg-primary">
							<i class="far fa-user"></i>
						</div>
						<div class="card-wrap">
							<div class="card-header">
								<h4><a class="font-weight-bold text-muted" style="text-decoration:none;" href="{{ route("staff") }}">Total Staff</a></h4>
							</div>
							<div class="card-body">
								{{ $staff_counts }}
							</div>
						</div>
					</div>
				</div>
				{{-- End Staff Count --}}
			</div>
		</div>
		{{-- Start Project Table --}}
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							{!! $html->table(['class' => 'table table-striped', 'id' => 'project-table'], true) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
		{{-- End Project Table --}}
	</section>

@endsection

@section('middleCss')

<link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

@endsection


@section('middleJs')

<!-- JS Libraies -->
<script src="{{ asset('assets/modules/chart.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>


<script>
	// Chart JS
	$(document).ready(function (){
		var p_counts = {{json_encode($project_counts)}};
		var ctx = document.getElementById("project_chart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: p_counts,
					backgroundColor: [
						'#3abaf4',
						'#ffc107',
						'#63ed7a'
					],
					label: 'Dataset 1'
				}],
				labels: [
					'Not Started',
					'In Progress',
					'Completed'
				],
			},
			options: {
				responsive: true,
				legend: {
					position: 'bottom',
				},
			}
		});
	})
</script>

@endsection

@section('lowerJs')

		{{-- Table JS --}}
    {!! $html->scripts() !!}

@endsection