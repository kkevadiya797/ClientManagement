@extends('app')

@section('pageTitle')
    Edit Project
@endsection

@section('content')
	
		<section class="section">
			<div class="section-header">
				<h1>@yield('pageTitle')</h1>
				<div class="section-header-breadcrumb">
					<div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
					<div class="breadcrumb-item active"><a href="{{ route('project') }}">Project</a></div>
					<div class="breadcrumb-item">@yield('pageTitle')</div>
				</div>
			</div>

			<div class="section-body">
				<div class="row">
					<div class="col-md-8 col-12 offset-md-2">
						<div class="card">
							<div class="card-header font-weight-bold text-dark">
								Project Details
							</div>
							<div class="card-body">
								<form action="{{ route('project.update', ['id' => $project->id]) }}" method="POST" enctype="multipart/form-data">
									@csrf
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
													<label for="title">Title <span class="text-danger">*</span></label>
													<input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}" placeholder="Enter Title" required>
													@error('title')
														<div class="invalid-feedback">
															{{ $message }}
														</div>
													@enderror
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
													<label for="description">Description <span class="text-danger">*</span></label>
													<textarea name="description" id="description" class="form-control" required>{{ $project->description }}</textarea>
													@error('description')
														<div class="invalid-feedback">
															{{ $message }}
														</div>
													@enderror
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
													<label for="budget">Budget <span class="text-danger">*</span></label>
													<input type="number" class="form-control" id="budget" name="budget" value="{{ $project->budget }}" placeholder="Budget" required/>
													@error('budget')
														<div class="invalid-feedback">
															{{ $message }}
														</div>
													@enderror
											</div>
										</div>
										<div class="col-md-6">
												<div class="form-group">
														<label for="client">Select Client <span class="text-danger">*</span></label>
														<select class="form-control select2" name="client" id="client" required>
															<option value="" disabled selected>Select Client</option>
															@foreach ($clients as $client)	
																<option value="{{ $client->id }}" @if($project->c_id == $client->id) {{ "selected" }} @endif>{{$client->name}}</option>
															@endforeach
														</select>
														@error('client')
															<div class="invalid-feedback">
																{{ $message }}
															</div>
														@enderror
												</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
													<label for="start_date">Start Date <span class="text-danger">*</span></label>
													<input type="text" class="form-control datepicker" id="start_date" value="{{ $project->start_date }}" name="start_date">
													@error('start_date')
														<div class="invalid-feedback">
															{{ $message }}
														</div>
													@enderror
											</div>
										</div>
										<div class="col-md-6">
												<div class="form-group">
														<label for="end_date">End Date <span class="text-danger">*</span></label>
														<input type="text" class="form-control datepicker" id="end_date" value="{{ $project->end_date }}" name="end_date">
														@error('end_date')
															<div class="invalid-feedback">
																{{ $message }}
															</div>
														@enderror
												</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
													<label for="staff">Staff <span class="text-danger">*</span></label>
													<select class="form-control select2" multiple="" name="staff[]" id="staff" placeholder="Select Staff">
														@foreach ($staffs as $staff)	
															<option value="{{ $staff->id }}" @if(in_array($staff->id, json_decode($project->s_id))) {{ "selected" }} @endif>{{$staff->name}}</option>
														@endforeach
													</select>
													@error('country')
														<div class="invalid-feedback">
															{{ $message }}
														</div>
													@enderror
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
												<div class="form-group float-right">
														<input type="submit" class="btn btn-primary" value="Save">
														<a href="{{ route('project') }}" class="btn btn-danger">Cancel</a>
												</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

@endsection

@section('middleCss')
<link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection


@section('middleJs')
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endsection
