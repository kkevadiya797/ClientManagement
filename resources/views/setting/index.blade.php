@extends('app')

@section('pageTitle')
    Settings
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
			<div class="col-md-8 col-12 offset-md-2">
				<div class="card">
					<div class="card-header font-weight-bold text-dark">
						Setting Details
					</div>
					<div class="card-body">
						<form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="col-md-6 col-12">
									<div class="form-group">
											<label for="url">URL <span class="text-danger">*</span></label>
											<input type="text" class="form-control" value="{{ $settings->url }}" id="url" name="url" placeholder="Enter url" required>
											@error('url')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
									</div>
								</div>
								<div class="col-md-6 col-12">
									<div class="form-group">
											<label for="company_name">Company Name <span class="text-danger">*</span></label>
											<input type="text" class="form-control" value="{{ $settings->company_name }}" id="company_name" name="company_name" placeholder="Enter company name" required/>
											@error('company_name')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-12">
									<div class="form-group">
											<label for="system_title">System Title <span class="text-danger">*</span></label>
											<input type="text" class="form-control" value="{{ $settings->system_title }}" id="system_title" name="system_title" placeholder="Enter System Title" required/>
											@error('system_title')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
									</div>
								</div>
								<div class="col-md-6 col-12">
									<div class="form-group">
											<label for="login_page_title">Login Page Title <span class="text-danger">*</span></label>
											<input type="text" class="form-control" value="{{ $settings->login_page_title }}" id="login_page_title" name="login_page_title" placeholder="Enter login page title" required/>
											@error('login_page_title')
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
											<label for="copyrights">Copyrights <span class="text-danger">*</span></label>
											<textarea name="copyrights" id="copyrights" class="form-control">{{ $settings->copyrights }}</textarea>
											@error('copyrights')
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
											<label for="favicon">Favicon Image</label>
											<div class="row">
												<div class="col-9">
													<input type="file" class="form-control"  id="favicon" name="favicon" placeholder="favicon" >
													<input type="hidden" class="form-control" value="{{ $settings->favicon }}" id="old_favicon" name="old_favicon" placeholder="old_favicon" >
													@error('favicon')
														<div class="invalid-feedback">
															{{ $message }}
														</div>
													@enderror
												</div>
												<div class="col-2">
													<img src="{{ asset($settings->favicon) }}" width="42" height="42">
												</div>
											</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
											<label for="logo">Logo Image</label>
											<div class="row">
												<div class="col-12">
													<input type="file" class="form-control"  id="logo" name="logo" placeholder="logo" >
													<input type="hidden" class="form-control" value="{{ $settings->logo }}" id="old_logo" name="old_logo" placeholder="old_logo" >
													@error('logo')
														<div class="invalid-feedback">
															{{ $message }}
														</div>
													@enderror
												</div>
												<div class="col-12 mt-2">
													<img src="{{ asset($settings->logo) }}" height="42">
												</div>
											</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
										<div class="form-group float-right">
												<input type="submit" class="btn btn-primary" value="Save">
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
@endsection


@section('middleJs')
@endsection
