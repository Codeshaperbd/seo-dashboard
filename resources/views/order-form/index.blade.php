@extends('layouts.master')

@section('page-style')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
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
					
					<h3 class="font-weight-semibold mt-3 dark">Add form</h3>
					<a href="{{ route('order-form.create') }}" class="mb-1 mt-1 mr-1 btn btn-primary pull-right list-add-button">
						<i class="fas fa-user"></i> Add form
					</a>
					
					<br/>
					<table class="table table-responsive-md  mb-0" id="table">
						<thead>
							<tr>
								<th>Profile Pciture</th>
								<th>Cleint Name</th>
								<th>Cleint Email</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>

					{{-- <div class="pull-right mt-4">
						{{ $users->links() }}
					</div> --}}
				</div>
			</section>
			

		</div>

	</div>

@endsection



@section('page-script')
<script>


</script>
@endsection