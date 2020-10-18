<!DOCTYPE html>
<html>
<body>

<h2>Edit Log Contract</h2>

<form action="{{route('updateLog')}}" method="post">
<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
  <label for="fname">Name LogContract:</label><br>
  <input type="text" name="name" value="{{$log[0]->name}}"><br>
  <label for="fname">Dealsize:</label><br>
  <input type="text" name="dealsize" value="{{$log[0]->dealsize}}"><br>
  <label for="fname">Cost:</label><br>
  <input type="text"  name="cost" value="{{$log[0]->cost}}"><br>
  <input type="hidden"  name="id" value="{{$log[0]->id}}"><br><br>
  <input type="submit" value="Submit">
</form> 
</body>
</html>