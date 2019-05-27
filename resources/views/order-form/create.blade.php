@extends('layouts.master')

@section('page-style')

	<style type="text/css">
		.form-top {
		    display: flex;
		    justify-content: space-between;
		    align-items: center;
		    background: #08c;
		    padding: 10px;
		    border-radius: 5px;
		    margin-bottom: 20px;
		}

		.form-top h4{
			color: #fff;
		}
	</style>


@endsection

@section('breadcrumb')
    <h2>Add form</h2>
    <div class="right-wrapper text-right">
        <ol class="breadcrumbs">
            <li><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
            <li><span>Add form</span></li>
        </ol>
		<a class="sidebar-right-toggle"><i class="fas fa-chevron-left"></i></a>
    </div>
@endsection

@section('page-content')
	<div class="row">
		
		<div class="col-lg-8 col-xl-8 offset-lg-2">
			
			@include('includes.alert')
			
			<section class="card card-horizontal mb-4">
				
		
				<div class="card-body">

					<form class="p-3" action="{{ route('client.store') }}" method="post" enctype="multipart/form-data">
						
						@csrf

						<div class="form-top gradient-bg">
							<h4 class="mb-3">Add form</h4>
							<a href="#" class="btn btn-default" style="border: inset 2px #000000;color: #000;">View Form</a>
						</div>
						<div class="form-group">

							<label for="clientName">Form name <span class="required">*</span></label>
							<input type="text" id="clientName" name="clientName"  class="form-control {{ $errors->has('clientName') ? ' is-invalid' : '' }}" required placeholder="John Einarson" value="{{ old('clientName') }}">

							@if ($errors->has('clientName'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('clientName') }}</strong>
		                        </span>
		                    @endif
						</div>

						<div class="form-group">

							<label for="password">Form information(Optional)</label>
							<textarea name="form_info" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"></textarea>
						</div>

						<div class="form-group">
							<div class="checkbox-custom checkbox-primary">
								<input type="checkbox" checked="" id="sendNotification" value="1" name="sendNotification">
								<label for="sendNotification">Send Notification in Email</label>
							</div>
							@if ($errors->has('sendNotification'))
		                        <span class="invalid-feedback" role="alert">
		                            <strong>{{ $errors->first('sendNotification') }}</strong>
		                        </span>
		                    @endif
						</div>

						<div class="form-devider">
							Drag and drop fields from the right column onto your form here...
						</div>
						<div class="dragabble-form">
							<div class="form-group">

								<label for="clientName">Form name <span class="required">*</span></label>
								<input type="text" id="clientName" name="clientName"  class="form-control {{ $errors->has('clientName') ? ' is-invalid' : '' }}" required placeholder="John Einarson" value="{{ old('clientName') }}">

								@if ($errors->has('clientName'))
			                        <span class="invalid-feedback" role="alert">
			                            <strong>{{ $errors->first('clientName') }}</strong>
			                        </span>
			                    @endif
							</div>
						</div>

						<br/>
						<button type="submit" class="mb-1 mt-1 mr-1 btn btn-primary"><i class="fas fa-user"></i> Add Client</button>
					</form>

				</div>
			</section>
			

		</div>

	</div>

@endsection



@section('page-script')
<script>


</script>
@endsection