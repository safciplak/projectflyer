@extends('layout')

@section('content')
	<div class="row">
		<div class="col-sm-3">
			<h1>{{ $flyer->street }}</h1>
			<h2>{{ $flyer->price }}</h2>
			<hr/>
			<div class="description">{{ nl2br($flyer->description) }}</div>
		</div>

		<div class="col-sm-9">
			@foreach($flyer->photos as $photo)	
				<img src="{{ $photo->path }}" alt="">
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