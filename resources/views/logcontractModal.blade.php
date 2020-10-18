<head>

   {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
</head>
<div class="modal-content">
   <!-- Modal Header -->
   <div class="modal-header">
      <h4 class="modal-title"><b>Log Contract</b></h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <!-- Modal body -->
   <div class="modal-body">
      <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
      <!-- <div align="left"><p><h6>Xin chào:  <u>{{session('data')['name']}}</u></h6> <a href="{{route('dangnhap')}}">Logout</a></p>  </div>
        <a href="{{route('index')}}">Về danh sách Contract</a> -->
      <div align="center">
         <h5> Name Contract: {{$nameContract[0]->name}}</h5>
      </div>
      @if($data[0]->user_id==$user_id)
      <form>
         <input type="text" id="addName" placeholder="Name LogContract">
         <input type="text" id="addDealsize" placeholder="Dealsize">
         <input type="text" id="addCost" placeholder="Cost">
         <input type="button" onclick="themLog({{$idContract[0]->Id}})" class="add-row btn btn-success " value="Thêm">
      </form>
      @endif
      <table class="table table-bordered" id="logTable">
         <thead>
            <tr>
               <th>Name LogContract</th>
               <th>Dealsize</th>
               <th>Cost</th>
               @if ($data[0]->user_id==$user_id) <th>Sửa/Xóa</th>
               @endif
            </tr>
         </thead>
         <tbody>
            @if ($data[0]->id!=null)
            @foreach($data as $row)

            <tr id="rowLog{{$row->id}}">

               <td>
                  <label class="label-{{$row->id}}" id="nameLabel-{{$row->id}}">{{$row->logName}}</label>
                  <input class="editable-{{$row->id}} hidden" id="name-{{$row->id}}" type="text" value="{{$row->logName}}">
               </td>

               <td>
                  <label class="label-{{$row->id}}" id="dealsizeLabel-{{$row->id}}">{{$row->dealsize}}</label>
                  <input class="editable-{{$row->id}} hidden" id="dealsize-{{$row->id}}" type="text" value="{{$row->dealsize}}">
               </td>

               <td>
                  <label class="label-{{$row->id}}" id="costLabel-{{$row->id}}">{{$row->cost}}</label>
                  <input class="editable-{{$row->id}} hidden" id="cost-{{$row->id}}" type="text" value="{{$row->cost}}">
               </td>

               <!--     @if ($data[0]->user_id==$user_id) -->
               <td>
                  <!-- href="{{ URL::route('editLog',[$idContract[0]->Id,$row->id]) }}" -->
                  <input type="button" value='Save' onclick="save({{$row->id}})" class="btn btn-success hidden" id="save{{$row->id}}">
                  <button type="button" onclick="editInput({{$row->id}})" class="btn btn-primary" id="sua{{$row->id}}">Sửa</button>
                  <button type="button" class="btn btn-danger" id='xoa{{$row->id}}' onclick="xoaLog({{$idContract[0]->Id}},{{$row->id}})">Xóa</button>
                  <!-- "{{ URL::route('deleteLog',[$idContract[0]->Id,$row->id]) }}" -->
               </td>
               <!--   @endif -->
            </tr>


            @endforeach
            @endif
         </tbody>
      </table>

      <h5>Tổng Dealsize: <span id='totalDeal'>{{$totalDeal}}</span></h5>
      <h5>Tổng Cost: <span id='totalCost'>{{$totalCost}}</span></h5>
   </div>
   <!-- Modal footer -->
   <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
   </div>
</div>
</div>
</div>


<script>
   function themLog(idCt) {
      var nameL = $("#addName").val();
      var cost = $("#addCost").val();
      var dealsize = $("#addDealsize").val();
      data_post = {
         idContract: idCt,
         nameLog: nameL,
         costLog: cost,
         dealLog: dealsize
      }
      $.ajax({
         type: "POST",
         url: 'http://localhost/testLaravel/public/index.php/contract/logcontract/insert',
         data: data_post,
         cache: false,
         headers: {
            'X-CSRF-Token': $('#_token').val()
         },
         success: function(response) {
            if (response.success == true) {
               let data = response.data;
               let html = "";
               html += "<tr id='rowLog"+data.id+"'>";
               
               var markup = "<tr id='rowLog"+response.data.id+"'><td><label class='label-"+response.data.id+"'id='nameLabel-"+response.data.id +"'>"+ nameL 
               +"</label><input type='text' class='editable-"+response.data.id+ " hidden"+"' id='name-"+response.data.id+ "' value="+response.data.name+">"
               +"</input></td>" + 
               "<td><label class='label-"+response.data.id+"'id='dealsizeLabel-"+response.data.id +"'>"+ response.data.dealsize 
               +"</label><input type='text' class='editable-"+response.data.id+ " hidden"+"' id='dealsize-"+response.data.id+ "' value="+response.data.dealsize+">"
               +"</input></td>"
               + "<td><label class='label-"+response.data.id+"'id='costLabel-"+response.data.id +"'>"+ response.data.cost 
               +"</label><input type='text' class='editable-"+response.data.id+ " hidden"+"' id='cost-"+response.data.id+ "' value="+response.data.cost+">"
               +"</input></td>"
               +"<td><input type='button' value='Save' onclick='save("+response.data.id+")' class='btn btn-success hidden' id='save"+response.data.id+"'>"
               +"</input>"
               +"<button id='sua"+response.data.id+"' class='btn btn-primary' onclick='editInput("+response.data.id+")' style='margin-right: 5px' >" + 'Sửa' +
                  "</button>"+"<button id='xoa"+response.data.id+"' onclick='xoaLog("+response.data.contract_id+','+response.data.id+")' class='btn btn-danger' >" + 'Xóa' +
                  "</button></td></tr>";
               $("#logTable").append(markup);
               var totalDel = $('#totalDeal').text();
               var totalCost = $('#totalCost').text();
               var newDel = parseFloat(totalDel) + parseFloat(dealsize);
               var newCost = parseFloat(totalCost) + parseFloat(cost);
               $('#totalDeal').html(newDel);
               $('#totalCost').html(newCost);
            }

         },
         error: function() {
            alert("delete error");

         }
      });
   }


   function xoaLog(idContract, idLog) {
      var totalDel = $('#totalDeal').text();
      var totalCost = $('#totalCost').text();
      var oldCost = $("#costLabel-" + idLog).text();
      var oldDel = $("#dealsizeLabel-" + idLog).text();
      var newDel = parseFloat(totalDel) - parseFloat(oldDel);
      var newCost = parseFloat(totalCost) - parseFloat(oldCost);
      var data_post = {
         idCt: idContract,
         idL: idLog
      }
      if (confirm("Are you sure you want to delete this")) {
         $.ajax({
            type: "POST",
            url: 'http://localhost/testLaravel/public/index.php/contract/logcontract/' + idContract + '/delete/' + idLog,
            data: data_post,
            cache: false,
            headers: {
               'X-CSRF-Token': $('#_token').val()
            },
            success: function(response) {

               if (response.success == true) {


                  $('#totalDeal').html(newDel);
                  $('#totalCost').html(newCost);
                  $('#rowLog' + idLog).remove();
               }


            },
            error: function() {
               alert("delete error");

            }
         });
      }
      return false;

   }



   function editInput(id) {


      $(".editable-" + id).removeClass("hidden");
      $(".label-" + id).addClass("hidden");
      $("#sua" + id).addClass("hidden");
      $("#xoa" + id).addClass("hidden");
      $("#save" + id).removeClass("hidden");
      // document.getElementById('sua'+id).style.visibility = 'hidden';
      // document.getElementById('xoa'+id).style.visibility = 'hidden';
      // document.getElementById('save'+id).style.display = "block";

   }

   function save(id) {
      $(".editable-" + id).addClass("hidden");
      $(".label-" + id).removeClass("hidden");
      $("#sua" + id).removeClass("hidden");
      $("#xoa" + id).removeClass("hidden");
      $("#save" + id).addClass("hidden");

      var name = $("#name-" + id).val();
      var dealsize = $("#dealsize-" + id).val();
      var cost = $("#cost-" + id).val();

      var data_post = {
         nameLog: name,
         dealsizeLog: dealsize,
         costLog: cost,
         idLog: id
      }
      // console.log(data_post);


      $.ajax({
         type: "POST",
         url: 'http://localhost/testLaravel/public/index.php/contract/logcontract/edit',
         data: data_post,
         cache: false,
         //contentType: false,
         //processData: false,
         headers: {
            'X-CSRF-Token': $('#_token').val()
         },
         success: function(response) {

            if (response.success == true) {
               var totalDel = $('#totalDeal').html();
               var totalCost = $('#totalCost').html();
               var oldDel = $("#dealsizeLabel-" + id).html();
               var oldCost = $("#costLabel-" + id).html();
               $("#nameLabel-" + id).text(response.data.name);
               $("#dealsizeLabel-" + id).html(response.data.dealsize);
               $("#costLabel-" + id).html(response.data.cost);
               var dealLable = $("#dealsizeLabel-" + id).html()
               var newDel = parseFloat(totalDel) - parseFloat(oldDel) + parseFloat(dealLable);
               $('#totalDeal').html(newDel);
               var costLable = $("#costLabel-" + id).html()
               var newCost = parseFloat(totalCost) - parseFloat(oldCost) + parseFloat(costLable);
               $('#totalCost').html(newCost);

            } else {
               alert("Vui lòng nhập giá trị :)) ");

            }

         },
         error: function() {
            alert("update error");

         }
      });
   }
</script>