<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $table='clients';
     public function getAlldata(){
        return $this->leftjoin('business_vertical','business_vertical.id','=','clients.business_vertical_id')
                    ->leftjoin('sub_vertical','clients.sub_vertical_id','=','sub_vertical.id')
                    ->leftjoin('users','clients.user_id','=','users.id')
                    ->leftjoin('user_team','users.id','=','user_team.user_id')
                    ->leftjoin('teams','user_team.team_id','=','teams.id')
                    ->leftjoin('users_groups','users.id','=','users_groups.user_id')
                    ->leftjoin('groups','groups.id','=','users_groups.group_id')
                    ->where(
                        [
                            'groups.deleted' => 0,
                            'groups.status' => 1
                        ]
                    )
                    ->select('groups.name as groups_name','clients.id as clients_id','clients.tax_code','clients.status as clients_status','users.status as users_status','business_vertical.name as business_vertical_name','sub_vertical.name as sub_vertical_name','clients.name as clients_name','teams.name as teams_name','users.name as users_name')
                    ->get();    
                                                                                                                             
    }
}
