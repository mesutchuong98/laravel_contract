
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
   function themLog(idCt) {
      var nameL = $("#addName").val();
      var cost = $("#addCost").val();
      var dealsize = $("#addDealsize").val();
      var markup = "<tr><td><label>"+nameL+"</label></td><td><label>" + dealsize +
      "</label></td><td><label>" + cost + 
      "</label></td><td><button class='btn btn-primary' style='margin-right: 3px'>"+'Sửa'+' '+
      "</button><button class='btn btn-danger'>"+'Xóa'+
      "</button></td></tr>";
      $("table tbody").append(markup);
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
               

               }


            },
            error: function() {
               alert("delete error");

            }
         });


   }


   function xoaLog(idContract, idLog) {

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
                  // $(".label-" + idLog).addClass("hidden");
                  // $("#sua" + idLog).addClass("hidden");
                  // $("#xoa" + idLog).addClass("hidden");
                  console.log($('#rowLog' + idLog).remove());

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