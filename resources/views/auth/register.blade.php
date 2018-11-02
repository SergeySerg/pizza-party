@extends('app')

@section('content')
<!--<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>-->
@if (count($errors) > 0)
<div class="alert alert-danger">
	<strong>{{ trans('passwords.error') }}</strong> {{ trans('passwords.problem_input') }}<br><br>
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<div id="signup-box" class="signup-box no-border">
	<div class="widget-body">
		<div class="widget-main">
			<h4 class="header green lighter bigger">
				<i class="icon-group blue"></i>
				{{ trans('passwords.reg_new_user') }}
			</h4>

			<div class="space-6"></div>
			<p> {{ trans('passwords.put_data') }} </p>

			<form role="form" method="POST" action="{{ url('/register') }}" />
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<fieldset>
				<label>
					<span class="block input-icon input-icon-right">
						<input type="email" class="span12" placeholder="Email" name="email" value="{{ old('email') }}" />
						<i class="icon-envelope"></i>
					</span>
				</label>

				<label>
					<span class="block input-icon input-icon-right">
						<input type="text" class="span12" placeholder="Username" name="name" value="{{ old('name') }}" />
						<i class="icon-user"></i>
					</span>
				</label>

				<label>
					<span class="block input-icon input-icon-right">
						<input type="password" class="span12" placeholder="Password" name="password" />
						<i class="icon-lock"></i>
					</span>
				</label>

				<label>
					<span class="block input-icon input-icon-right">
						<input type="password" class="span12" placeholder="Repeat password" name="password_confirmation" />
						<i class="icon-retweet"></i>
					</span>
				</label>

				<!--<label>
					<input type="checkbox" />
						<span class="lbl">
							I accept the
							<a href="#">User Agreement</a>
						</span>
				</label>-->

				<div class="space-24"></div>

				<div class="clearfix">
					<button type="reset" class="width-30 pull-left btn btn-small">
						<i class="icon-refresh"></i>
						{{ trans('passwords.reset_data') }}
					</button>

					<button class="width-65 pull-right btn btn-small btn-success">
						{{ trans('passwords.registration') }}
						<i class="icon-arrow-right icon-on-right"></i>
					</button>
				</div>
			</fieldset>
			</form>
		</div>

		<div class="toolbar center">
			<a href="{{ url(getSetting('admin.prefix') . '/login') }}"  class="back-to-login-link">
				<i class="icon-arrow-left"></i>
				{{ trans('passwords.back_login') }}
			</a>
		</div>
	</div><!--/widget-body-->
</div><!--/signup-box-->

@endsection
