<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Contracts;
use App\Business;
use App\Clients;
use App\Cs_User;
use App\Sub;
use App\Team;
use App\User_Team;
use App\User_Ct;
use App\LogContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
// use App\Http\Controllers\Response;
use Response;
use Illuminate\Support\Facades\Session;


class ContractController extends Controller
{

    public function index(Request $rq)
    {

        $session = Auth::user();
        // $session=Session('data');
        // dd($session);
        $level = $session['level'];
        $id = $session['Id'];
        $nameSearch = $rq->table_search;
        $condition = "contract.name LIKE '%" . $nameSearch . "%' ";
        $data = Contracts::join('users', 'contract.user_id', '=', 'users.Id')
            ->select('contract.Id', 'contract.name', 'contract.status', 'contract.user_id', 'users.level');
        if ($level == 3) {
            $data->where('contract.user_id', $id);
        }
        if ($level == 2) {
            $data->where(function ($query) use ($id) {
                $query->where('contract.user_id', $id)
                    ->orWhere('users.level', 3);
            });
        } else if ($level == 1) {
            $data->where(function ($query) use ($id) {
                $query->where('contract.user_id', $id)
                    ->orWhereIn('users.level', [2, 3]);
            });
        }
        if (!empty($nameSearch)) {
            $data->whereRaw($condition);
        }
        // dd($data->toSql());die;
        $data = $data->paginate(8);
        // dd($data);

        return view('indexContracts', compact('data', 'id', 'nameSearch', 'session'));
    }
    public function create()
    {
        $username = Auth::user()['username'];
        $result = User_Ct::where('username', $username)->get();
        return view('addContractModal', compact('result'));
        //
    }

    public function store(Request $request)
    {
        $contract = new Contracts;
        $contract->name = $request->Name;

        $contract->status = $request->Status;
        $contract->user_id = $request->User_Id;
        $contract->save();
        return redirect()->route('index');
    }

    public function edit($id)
    {

        $contracts = Contracts::find($id);
        // dd($contracts);
        $pageName = "Contracts - Update";
        return view('updateContractModal', compact('contracts', 'pageName'));
    }

    public function sua(Request $request)
    {
        $contracts = Contracts::find($request->Id);
        $contracts->name = $request->Name;
        $contracts->contractId = $request->ContractId;
        $contracts->status = $request->Status;
        $contracts->save();

        //dd($contracts);

        // dd($contracts->save()); die;
        return redirect()->route('index');
    }

    public function deleteContract($id)
    {

        return view('deleteContractModal', compact('id'));
    }
    public function destroy($id)
    {

        Contracts::find($id)->delete();


        // dd($contracts);die;
        // dd($contracts);

        return redirect()->route('index');
    }

    public function chuyen($user_id, $id)
    {
        // $username=session('data')['username'];
        // $result = User_Ct::where('username', $username)->get();
        // $name= $result[0]->name;
        $UserOther = User_Ct::where('Id', '!=', $user_id)->get();
        // dd($UserOther);
        return view('chuyenModal', compact('id', 'UserOther'));
    }
    public function change(Request $rq, $id)
    {
        $selectValue = $rq->input('subscription');
        // dd($selectValue);
        $user = User_Ct::where('name', $selectValue)->get();
        $id_user = $user[0]->Id;

        $contracts = Contracts::find($id);
        $contracts->user_id = $id_user;
        $contracts->save();
        return redirect()->route('index');
    }

    public function dangnhap()
    {
        return view('dangnhap');
    }
    public function dangxuat()
    {
        Auth::logout();
        return redirect()->route('dangnhap');
    }



    public function dangky()
    {
        return view('dangky');
    }

    public function xulydangky(Request $rq)
    {
        $user = new User_Ct;
        $message = "Bạn vui lòng nhập đầy đủ thông tin!!!";
        if (!empty($rq->username) && !empty($rq->password) && !empty($rq->name) && !empty($rq->status) && !empty($rq->status)) {
            $user->username = $rq->username;
            $user->password = Hash::make($rq->password);
            $user->name = $rq->name;
            $user->status = $rq->status;
            $user->Id = $rq->Id;
            $user->level = '3';
            $user->save();
        } else {
            return view('dangky', compact('message'));
        }

        return view('dangnhap');
    }



    public function kiemtra_user(Request $rq)
    {
        $username = $rq->username;
        $password = $rq->password;
        //Kiểm tra xem có khớp với username và password trong hệ thống không?
        // $result = User_Ct::where('username', $username)->where('password',$password)->first();

        $test = ['username' => $username, 'password' => $password];
        if (Auth::attempt($test)) {

            return redirect()->route('index');
        }
        // if(!empty($result)){
        //     $rq->session()->put('data',$result);
        //     return redirect()->route('index'); 
        // }                                                  

        else {
            return redirect()->route('dangnhap');
        }
    }

    public function logcontract($id)
    {
        $level = Auth::user()['level'];
        $user_id = Auth::user()['Id'];
        if ($level == 1) {

            $data = Contracts::leftjoin('log_contract', 'contract.Id', '=', 'log_contract.contract_id')
                // ->where('contract.user_id',$user_id)
                ->where('contract.Id', $id)
                ->select('log_contract.name as logName', 'contract.name as contractName', 'log_contract.dealsize', 'log_contract.cost', 'log_contract.id', 'contract.user_id')
                ->get();
        }
        if ($level == 2) {
            $data = Contracts::leftjoin('log_contract', 'contract.Id', '=', 'log_contract.contract_id')
                // ->where('contract.user_id',$user_id)
                ->where('contract.Id', $id)
                ->select('log_contract.name as logName', 'contract.name as contractName', 'log_contract.dealsize', 'log_contract.cost', 'log_contract.id', 'contract.user_id')
                ->get();
        }
        if ($level == 3) {
            $data = Contracts::leftjoin('log_contract', 'contract.Id', '=', 'log_contract.contract_id')
                ->where('contract.user_id', $user_id)
                ->where('contract.Id', $id)
                ->select('log_contract.name as logName', 'contract.name as contractName', 'log_contract.dealsize', 'log_contract.cost', 'log_contract.id', 'contract.user_id')
                ->get();
        }
        $nameContract = Contracts::where('Id', $id)->select('contract.name')->get();
        $idContract = Contracts::where('Id', $id)->select('contract.Id')->get();
        $totalDeal = 0;
        $totalCost = 0;
        foreach ($data as $value) {
            $totalDeal += $value->dealsize;
            $totalCost += $value->cost;
        }

        return view('logcontractModal', compact('data', 'nameContract', 'idContract', 'totalDeal', 'totalCost', 'user_id'));
    }

    public function createLog($id)
    {


        return view('createLog', compact('id'));
    }


    public function insert(Request $rq)
    {
        if (!empty($rq->idContract)) {
            $log = new LogContract;
            $log->name = $rq->nameLog;
            $log->dealsize = $rq->dealLog;
            $log->cost = $rq->costLog;
            $log->contract_id = $rq->idContract;
            $log->save();
            return Response()->json(array(
                'success' => true,
                'data'   => $log
            ));
        }
    }

    public function updateLog(Request $rq)
    {
        if (
            $_SERVER['REQUEST_METHOD'] == "POST" && !empty($rq->nameLog)
            && !empty($rq->dealsizeLog) && !empty($rq->costLog) && !empty($rq->idLog)
        ) {
            $log = LogContract::find($rq->idLog);
            $log->name = $rq->nameLog;
            $log->dealsize = $rq->dealsizeLog;
            $log->cost = $rq->costLog;
            $log->save();
            return Response()->json(array(
                'success' => true,
                'data'   => $log
            ));
        } else {
            return Response()->json(array(
                'success' => false,
                'data'   => null
            ));
        }
    }

    public function editLog($idContract, $idLog)
    {

        $log = LogContract::where('id', $idLog)->get();

        return view('editLog', compact('log'));
    }
    public function deleteLog(Request $rq)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($rq->idCt) && !empty($rq->idL)) {
            LogContract::find($rq->idL)->delete();
            return Response()->json(array(
                'success' => true,
                'data'   => null
            ));
        }
    }



    public function profile()
    {
        // $user=Session('data');
        $user = Auth::user();
        return view('profileUser', compact('user'));
    }
    public function updateProfile(Request $rq, $id)
    {
        $user = User_Ct::find($id)->first();
        $user->name = $rq->name;
        $user->username = $rq->username;
        $user->password = Hash::make($rq->password);
        $user->status = $rq->status;
        $user->save();
        // dd($user);
        return redirect()->route('dangnhap');
    }

    public function listData()
    {
        return view('vuejs.data');
    }
    public function dataclients(Request $rq)
    {
        $clients = new Clients();
        $dataAll = $clients->getAlldata();
        // dd($dataAll);
        return Response()->json(array(
            'success' => true,
            'data'   => $dataAll,
        ));
    }
}
