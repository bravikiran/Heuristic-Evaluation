@extends('layouts.managerlayout')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-hover">
				<h2 class="text-center">View user status</h2>
				<thead>
					<tr>
						<th>Email</th>
						<th>Role</th>
						<th>User Status</th>
					</tr>
				</thead>
				<tbody>
					@if(!empty($userstatus))
					@foreach($userstatus as $status)
					<tr>
						<td>{{$status->user_email}}</td>
						<td>{{$status->user_role}}</td>
						@if( $status->confirmed == 1)
						<td class="btn btn-block btn-success">{{ "Registered" }}</td>
						@else
						<td class="btn btn-block btn-info">{{ "Not registered" }}</td>
						@endif
					</tr>
					@endforeach
				</tbody>
					@else
					{{ "No invited users :(" }}
					@endif					
			</table>
      		<div class="text-center">
				{!! $userstatus->render(); !!}
			</div>
			<div>
        		<a href="{{ redirect()->back()->getTargetUrl() }}"><button class="btn btn-lg btn-default">Back</button>
      		</div>
		</div>
	</div>
</div>

@endsection