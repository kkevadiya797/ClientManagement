@extends('app')

@section('pageTitle')
    Edit Staff
@endsection

@section('content')
	
		<section class="section">
			<div class="section-header">
				<h1>@yield('pageTitle')</h1>
				<div class="section-header-breadcrumb">
					<div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
					<div class="breadcrumb-item active"><a href="{{ route('staff') }}">Staff</a></div>
					<div class="breadcrumb-item">@yield('pageTitle')</div>
				</div>
			</div>

			<div class="section-body">
				<div class="row">
					<div class="col-md-8 col-12 offset-md-2">
						<div class="card">
							<div class="card-header font-weight-bold text-dark">
								Staff Details
							</div>
							<div class="card-body">
								<form action="{{ route('staff.update', ['id'=> $user->id]) }}" method="POST" enctype="multipart/form-data">
									@csrf
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
													<label for="title">Title<span class="text-danger">*</span></label>
													<input type="text" class="form-control" id="title" name="title" value="{{ $user->title }}" placeholder="Enter Title" required>
													@error('title')
														<div class="invalid-feedback">
															{{ $message }}
														</div>
													@enderror
											</div>
										</div>
										<div class="col-md-6">
												<div class="form-group">
														<label for="name">Full Name <span class="text-danger">*</span></label>
														<input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Enter full name" required>
														@error('name')
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
													<label for="email">Email <span class="text-danger">*</span></label>
													<input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Enter email address" required/>
													@error('email')
														<div class="invalid-feedback">
															{{ $message }}
														</div>
													@enderror
											</div>
										</div>
										<div class="col-md-6">
												<div class="form-group">
														<label for="password">Password <span class="text-danger">*</span></label>
														<input type="password" class="form-control" id="password" name="password" placeholder="Password">
														@error('password')
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
													<label for="phone">Phone No. <span class="text-danger">*</span></label>
													<input type="number" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" placeholder="Enter phone no." required/>
													@error('phone')
														<div class="invalid-feedback">
															{{ $message }}
														</div>
													@enderror
											</div>
									</div>
										<div class="col-md-6">
												<div class="form-group">
														<label for="city">City <span class="text-danger">*</span></label>
														<input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}" placeholder="City" required>
														@error('city')
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
													<label for="state">State <span class="text-danger">*</span></label>
													<input type="text" class="form-control" id="state" name="state" value="{{ $user->state }}" placeholder="State" required/>
													@error('state')
														<div class="invalid-feedback">
															{{ $message }}
														</div>
													@enderror
											</div>
										</div>
										<div class="col-md-6">
												<div class="form-group">
														<label for="postcode">Postcode <span class="text-danger">*</span></label>
														<input type="number" class="form-control" id="postcode" name="postcode" value="{{ $user->postcode }}" placeholder="Postcode" required>
														@error('postcode')
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
													<label for="country">Country <span class="text-danger">*</span></label>
													<input type="text" class="form-control" id="country" name="country" value="{{ $user->country }}" placeholder="Country" required/>
													@error('country')
														<div class="invalid-feedback">
															{{ $message }}
														</div>
													@enderror
											</div>
										</div>
										<div class="col-md-6">
												<div class="form-group">
														<label for="profile">Profile Image</label>
														<input type="file" class="form-control"  id="profile" name="profile" placeholder="profile" >
														<input type="hidden" name="old_profile" value="{{ $user->profile_pic }}" >
														@error('profile')
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
														<a href="{{ route('staff') }}" class="btn btn-danger">Cancel</a>
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
