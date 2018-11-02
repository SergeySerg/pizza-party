@extends('app')

@section('content')
<!--<div class="container-fluid">
	<div class="row">

		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Reset Password</div>
				<div class="panel-body">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Send Password Reset Link
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>-->
	@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
	@endif

	@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>{{ trans('passwords.error') }}</strong> {{ trans('passwords.not_send') }}<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<div id="forgot-box" class="forgot-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<h4 class="header red lighter bigger">
					<i class="icon-key"></i>
					{{ trans('passwords.recovery_pass') }}
				</h4>

				<div class="space-6"></div>
				<p>
					{{ trans('passwords.get_instruction') }}
				</p>

				<form role="form" method="POST" action="{{ url('/password/email') }}"/>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<fieldset>
					<label>
						<span class="block input-icon input-icon-right">
							<input type="email" class="span12" placeholder="Email" name="email" value="{{ old('email') }}" />
							<i class="icon-envelope"></i>
						</span>
					</label>

					<div class="clearfix">
						<button class="width-35 pull-right btn btn-small btn-danger">
							<i class="icon-lightbulb"></i>
							{{ trans('passwords.send') }}
						</button>
					</div>
				</fieldset>
				</form>
			</div><!--/widget-main-->

			<div class="toolbar center">
				<a href="{{ url(getSetting('admin.prefix') . '/login') }}"  class="back-to-login-link">
					{{ trans('passwords.back_login') }}
					<i class="icon-arrow-right"></i>
				</a>
			</div>
		</div><!--/widget-body-->
	</div><!--/forgot-box-->
@endsection
