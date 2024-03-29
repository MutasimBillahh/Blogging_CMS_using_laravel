@extends('layouts.app')


@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">
			
			Categories
		</div>

		<div class="panel-body">
			

			<table class="table table-hover">
		

		<thead>
			
			<th>
				
				Category Name
			</th>

			<th>
				
				Editing
			</th>

			<th>
				
				Deleting
			</th>
		</thead>

		<tbody>
			@if($categories->count() > 0)

				@foreach($categories as $category)

				<tr>
					
					<td>
						
						{{$category->name}}
					</td>

					<td>
						
						<a href="{{route('category.edit',$category->id)}}" class="btn btn-xs btn-info">

							<span class="glyphicon glyphicon-pencil"></span>
						</a>
					</td>


					<td>
						
						<a href="{{route('category.delete',$category->id)}}" class="btn btn-xs btn-danger">

							<span class="glyphicon glyphicon-trash"></span>
						</a>
					</td>
				</tr>

			@endforeach

			@else


			<tr>
				
				<th colspan="5" class="text-center"> No Categories</th>
			</tr>

			@endif



		</tbody>
	</table>
		</div>
	</div>


@endsection