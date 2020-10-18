<div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title"><b>Delete Contract</b></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <div class="container">
      
      <p>Are you sure you want to delete your contract?</p>
    
      <form action="{{route('destroy',$id)}} " method="post">
      <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </form>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>