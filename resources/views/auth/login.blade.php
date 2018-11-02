@extends('app')

@section('content')

	@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>{{ trans('passwords.error') }}</strong> {{ trans('passwords.not_enter') }}<br><br>
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif

<div id="login-box" class="login-box visible widget-box no-border">
	<div class="widget-body">
		<div class="widget-main">
			<h4 class="header blue lighter bigger">
				<i class="icon-coffee green"></i>
				{{ trans('passwords.login') }}
			</h4>

			<div class="space-6"></div>

			<form class="form-horizontal" role="form" method="POST" action="{{ url(getSetting('admin.prefix') . '/login') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<fieldset>
				<label>
					<span class="block input-icon input-icon-right">
						<input type="text" class="span12" name="email" value="{{ old('email') }}" placeholder="Login" />
						<i class="icon-user"></i>
					</span>
				</label>

				<label>
					<span class="block input-icon input-icon-right">
						<input type="password" class="span12" name="password" placeholder="Password" />
						<i class="icon-lock"></i>
					</span>
				</label>

				<div class="space"></div>

				<div class="clearfix">
					<label class="inline">
						<input type="checkbox" name="remember" />
						<span class="lbl"> {{ trans('passwords.remember') }}</span>
					</label>

					<button class="width-35 pull-right btn btn-small btn-primary">
						<i class="icon-key"></i>
						Login
					</button>
				</div>

				<div class="space-4"></div>
			</fieldset>
			</form>

		</div><!--/widget-main-->

		<div class="toolbar clearfix">
			<div>
                <a href="{{ url('/password/email') }}"  class="forgot-password-link">
                    <i class="icon-arrow-left"></i>
					{{ trans('passwords.remember_password') }}
                </a>
            </div>

			<!--<div>
				<a href="{{ url('/auth/register') }}"  class="user-signup-link">
					Зараєструватися
					<i class="icon-arrow-right"></i>
				</a>
			</div>-->
		</div>
	</div><!--/widget-body-->
</div><!--/login-box-->
<!--<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

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
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Login</button>

								<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>-->
@endsection
