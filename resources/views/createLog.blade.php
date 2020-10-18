<!DOCTYPE html>
<html>
<body>

<h2>Add Log Contract</h2>

<form action="{{route('insert')}}" method="post">
<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
  <label for="fname">Name LogContract:</label><br>
  <input type="text" id="" name="name" value=""><br>
  <label for="fname">Dealsize:</label><br>
  <input type="text" id="" name="dealsize" value=""><br>
  <label for="fname">Cost:</label><br>
  <input type="text" id="" name="cost" value=""><br>
  <input type="hidden" id="" name="id" value="{{$id}}"><br><br>
  <input type="submit" value="Submit">
</form> 
<a href="{{route('logcontract',$id)}}">Về danh sách</a>
</body>
</html>