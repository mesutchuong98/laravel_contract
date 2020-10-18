<div class="modal-content">
  <!-- Modal Header -->
  <div class="modal-header">
    <h4 class="modal-title"><b>Contract Transfer</b></h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
  </div>
  <!-- Modal body -->
  <div class="modal-body">
    <form action="{{Route('change',$id)}}" method="post">
      <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />

      <label for="cars">Choose a name:</label>
      <select id="user" name="subscription">
        <?php foreach ($UserOther as $user) { ?>
          <option><?php echo $user->name ?></option>
        <?php } ?>
      </select>
        </br>
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