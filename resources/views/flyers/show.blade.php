@extends('layout')

@section('content')
	<div class="row">
		<div class="col-sm-4">
			<h1>{{ $flyer->street }}</h1>
			<h2>{{ $flyer->price }}</h2>
			<hr/>
			<div class="description">{{ nl2br($flyer->description) }}</div>
		</div>

		<div class="col-sm-8 gallery">
			@foreach($flyer->photos->chunk(4) as $set)	
				<div class="row">
					@foreach($set as $photo)	
						<div class="col-sm-3 gallery__image">
							<img src="/{{ $photo->tumbnail_path }}" alt="">
						</div>
					@endforeach
				</div>
			@endforeach
		</div>
	</div>

	<hr/>

	<h2>Add Your Photos</h2>
	

	<form id="addPhotosFrom" action="{{ route('store_photo_path', [$flyer->zip, $flyer->street]) }}" method="POST" class="dropzone">
	{{ csrf_field() }}
	</form>
@stop

@section('scripts.footer')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>
	<script>
		Dropzone.options.addPhotosFrom = {
			paramName: 'photo',
			maxFileSizie: 3,
			acceptedFiles: '.jpg, .jpeg, .png , .bmp',
			
		}
	</script>
@stop