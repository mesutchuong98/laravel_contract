@extends('layouts.admin_template')
@section('name_user')
{{$session['name']}}
@endsection  
@section('sign_out')
{{route('dangxuat')}}
@endsection  
@section('profile_user')
{{route('profile',$session['Id'])}}
@endsection  

    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
    @section('content')
    <div align="center">
    <form action="{{route('index')}}" method="get">
        
          <div class="box-tools" >
            <div class="input-group input-group-sm" style="width: 350px;">
              <input type="text" value="<?php if(isset($nameSearch)) echo $nameSearch ?>" name="table_search" class="form-control pull-right" placeholder="Search">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div> 
    </form>
    </div>
    <button  onclick="viewAddContract()" class="btn btn-success" data-target="#myModal" data-toggle="modal">Thêm</button>
    <table class="table table-striped ">
        <tr>
            <th>Contract Id</th>
            <th>Contract Name </th>
            <th>Status</th>
            <th>User_Id</th>
            <th>Level_User</th>
            <th>Sửa/Xóa/Chuyển/Log</th>
        </tr>
        <?php foreach ($data as $row) { ?>

            <tr>
                <td> <?php echo $row->Id; ?></td>

                <td><?php echo $row->name; ?></td>

                <td><?php echo $row->status; ?></td>

                <td><?php echo $row->user_id; ?></td>
                <td><?php echo $row->level; ?></td>

                <td>
                    <?php if ($id == $row->user_id) { ?>
                        <button class="btn btn-primary" onclick="viewEdit({{$row->Id}})" data-toggle="modal" data-target="#myModal">Sửa</button>
                        <button class="btn btn-danger" onclick="deleteContract({{$row->Id}})" data-toggle="modal" data-target="#myModal">Xóa</button>
                        <button class="btn btn-warning" onclick="chuyenContract({{$row->user_id}},{{$row->Id}})" data-toggle="modal" data-target="#myModal">Chuyển</a>
                    <?php } ?>
                    <button class="btn btn-info" onclick="viewLog({{$row->Id}})" data-toggle="modal" data-target="#myModal1">Log</button>
                </td>

            </tr>
        <?php } ?>
    </table>
        {{$data->links()}}
    <div class="modal fade" id="myModal1" role="dialog">
        <div class="modal-dialog modal-lg" style="width:80%;">

            <!-- Modal content-->
            <div class="modal-content" id="model_log_contract1">

            </div>

        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg" style="width:40%;">

            <!-- Modal content-->
            <div class="modal-content" id="model_log_contract">

            </div>

        </div>
    </div>
    
    <script>
        function chuyenContract(user_id, id) {
            var url = "{{url('contract')}}/chuyen/" + user_id + "/" + id;
            $('#model_log_contract').load(url);
        }

        function viewAddContract() {
            var url = "{{url('contract')}}/create/";
            $('#model_log_contract').load(url);
        }

        function viewEdit(id) {
            var url = "{{url('contract')}}/edit/" + id;
            $('#model_log_contract').load(url);

        }

        function viewLog(id) {
            var url = "{{url('contract')}}/logcontract/" + id;
            $('#model_log_contract1').load(url);
        }

        function deleteContract(id) {
            var url = "{{url('contract')}}/delete/" + id;
            $('#model_log_contract').load(url);
        }
    </script>
@endsection
