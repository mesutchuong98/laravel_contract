<div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                  <h4 class="modal-title"><b>Add Contract</b></h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <!-- Modal body -->
               <div class="modal-body">
<form action="{{Route('store')}}" method="post">
<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
<!-- {{session('data')['username']}} -->
  <label for="fname">Name:</label><br>
  <input type="text" id="" name="Name" value=""><br>
 
  <label for="fname">Status:</label><br>
  <input type="text" id="" name="Status" value=""><br>
  <input type="hidden" id="" name="User_Id" value="{{$result[0]->Id}}"><br><br>
  <input type="submit" class="btn btn-success" value="Submit">
</form> 

</div>
               <!-- Modal footer -->
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <!-- <?php dd($result);?> -->