<form action="{{route('postFile')}}" method="post" enctype="multipart/form-data">
	<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
	<input type="file" name="myFile">
	<input type="submit">
</form>