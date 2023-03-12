@extends('layouts.app')


@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			
			Users
		</div>

		<div class="panel-body">
			

			<table class="table table-hover">
		

		<thead>
			
			<th>
				
				Image
			</th>

			<th>
				
				Name
			</th>

			<th>
				
				Permission
			</th>

			<th>
				
				Delete
			</th>
		</thead>

		<tbody>
			@if($users->count() > 0)

			@foreach($users as $user)

			<tr>
				<td><img src="{{ asset($user->profile->avatar )}}" alt="" height="50px" width="60px" style="border-radius: 50%;">

				</td>

				<td>
					{{$user->name}}

				</td>

				<td>
					
					@if($user->admin)

						<a class="btn btn-danger btn-xs" href="{{route('user.not.admin',$user->id)}}">Remove Permissions</a>

					@else

					<a class="btn btn-success btn-xs" href="{{route('user.admin',$user->id)}}">Make Admin</a>

					@endif
				</td>

				<td>
					
					Delete
				</td>


			</tr>


			@endforeach

			@else


			<tr>
				
				<th colspan="5" class="text-center"> No Users</th>
			</tr>


			@endif


		</tbody>
	</table>
		</div>
	</div>


@endsection