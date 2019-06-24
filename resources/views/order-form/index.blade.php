@extends('layouts.master')

@section('page-style')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">

<style type="text/css">
	.table td{
		padding: 10px 10px !important;
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
		
		<div class="col-lg-10 col-xl-10 offset-lg-1">
			
			@include('includes.alert')
			
			<section class="card card-horizontal mb-4">
				
				

				<div class="card-body">
					
					<h3 class="font-weight-semibold mt-3 dark">Order forms</h3>
					<a href="{{ route('order-form.create') }}" class="mb-1 mt-1 mr-1 btn btn-primary pull-right list-add-button">
						<i class="fas fa-user"></i> Add form
					</a>
					
					<br/>
					<table class="table table-no-more table-bordered table-striped mb-0" id="table">
						<thead>
							<tr>
								<th>FORM</th>
								<th>ID</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($orderForms as $orderForm)
							<tr>
								<td>{{ $orderForm->formName }}</td>
								<td>{{ $orderForm->formLink }}</td>
								<td class="actions">
								   <div class="btn-group flex-wrap">
								      <button type="button" class="mb-1 mt-1 mr-1 btn btn-default dropdown-toggle action-btn role-btn" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
								      <div class="dropdown-menu" role="menu" x-placement="bottom-start">
								         
								         <a class="dropdown-item text-1" href="#">
								         	View
								         </a>
								         <a class="dropdown-item text-1" href="#">
								         	Share
								         </a>
								         <a class="dropdown-item text-1" href="#">
								         	Make Private
								         </a>
								         <a class="dropdown-item text-1" href="#">
								         	Edit Rules
								         </a>
								         <a class="dropdown-item text-1" href="#">
								         	Duplicate
								         </a>
								         <a class="dropdown-item text-1" href="#">
								         	Delete
								         </a>
								      </div>
								   </div>
								</td>
							</tr>
							@endforeach
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