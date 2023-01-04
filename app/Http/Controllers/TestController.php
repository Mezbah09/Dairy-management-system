<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Distributer;
use App\Models\Farmer;
use App\Models\FarmerReport;
use App\Models\Ledger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    public function export()
    {
       file_put_contents(public_path('exports/users.json'),json_encode( DB::table('users')->get()));
       file_put_contents(public_path('exports/farmers.json'),json_encode( DB::table('farmers')->get()));
       $distributers=DB::table('distributers')->get();
       file_put_contents(public_path('exports/distributers.json'),json_encode( $distributers));
        $distributerLedgers=DB::table('ledgers')->whereIn('user_id', $distributers->pluck('user_id'))->orderBy('user_id')->get()->groupBy('user_id');
        $data=[];
        foreach ($distributerLedgers as $key => $ledgers) {
            $balance=$ledgers->where('type',1)->sum('amount')-$ledgers->where('type',2)->sum('amount');
            array_push($data,[
                'user_id'=>$key,
                'amount'=>$balance,
                'type'=>$balance>0?2:1
            ]);
        }
       file_put_contents(public_path('exports/distributers_balance.json'),json_encode( $data));


    }

    public function box(Request $request){
        if ($request->isMethod('post')) {
            # code...
            $farmers=Farmer::join('users','users.id','=','farmers.user_id')->where('farmers.center_id',$request->center_id)->select('users.id','users.name','users.no','farmers.center_id')->orderBy('users.no','asc')->get();
            $center_name = Center::where('id',$request->center_id)->first();
            // dd($farmers);
            $data = [];
            foreach($farmers as $farmer){
                // dd($farmer);
                $user_id = $farmer->id;
                $n3 = Ledger::where('user_id', $user_id)->where('date', '>=', 20780401)->where('date', '<=', 20780415)->where('identifire', '120')->get();
                $n4 = Ledger::where('user_id', $user_id)->where('date', '>=', 20780401)->where('date', '<=', 20780415)->where('identifire', '101')->get();

                $n1=Ledger::where('user_id',$user_id)->where('date','<',20780401)->where('type',1)->sum('amount');
                $n2=Ledger::where('user_id',$user_id)->where('date','<',20780401)->where('type',2)->sum('amount');

            $prev=$n2-$n1;
            foreach ($n3 as  $value) {
               if($value->type ==1){
                   $prev-=$value->amount;
               }else{
                   $prev +=$value->amount;
               }
            }

            foreach ($n4 as  $value) {
                if($value->type ==1){
                    $prev-=$value->amount;
                }else{
                    $prev +=$value->amount;
                }
             }
            $_data=FarmerReport::where(['year'=>2078,'month'=>3,'session'=>2,'user_id'=>$user_id])->first();


            array_push($data,[
                    'name'=>$farmer->name,
                    'prev'=>$prev,
                    'grandtotal'=>$_data->grandtotal,
                    'balance'=>$_data->balance,
                    'nettotal'=>$_data->nettotal
            ]);
        }
          return view('testing.closing',compact('data','center_name'));
        }else{
            $data = [];
            $center_name = null;
            return view('testing.closing',compact('data','center_name'));
        }


    }
    public function index($id){
        $farmers=Farmer::where('center_id',$id)->get();
        $datas=[];
        foreach($farmers as $farmer)
        {

            $user=$farmer->user;
            if($user!=null){
                $data=[];
                $data['name']=$user->name;
                $data['id']=$user->id;
                $data['no']=$user->no;
                $data['amount']=$user->amount;
                $data['type']=$user->amounttype;
                $ledgers=Ledger::where('user_id',$user->id)->orderBy('date', 'ASC') ->orderBy('id', 'ASC')->get();
                if(count($ledgers)>0){
                    $ledger=$user->ledgers->last();
                    $data['date']=_nepalidate($ledger->date);

                    $data['cr']=$ledger->cr;
                    $data['dr']=$ledger->dr;
                }else{
                    $data['date']="----------";
                    $data['cr']=0;
                    $data['dr']=0;

                }

                if($data['type']==1){
                    $data['ok']=$data['amount']==$data['cr'] || ($data['cr']==null && $data['amount']==0);
                }else{
                    $data['ok']=$data['amount']==$data['dr'] || ($data['dr']==null && $data['amount']==0);

                }
                array_push($datas,(object)$data);
            }
        }
        return view('testing.index',compact('datas'));
    }

    public function all($id){
        $user=User::find($id);
        $ledgers=Ledger::where('user_id',$id)->orderBy('date', 'ASC') ->orderBy('id', 'ASC')->get()->toArray();
        return view('testing.all',['user'=>$user->toArray(),'datas'=>$ledgers]);

        // dd($user->toArray(),$ledgers);
    }

    public function distributor(){
        $distributors=Distributer::all();
        $datas=[];
        foreach($distributors as $distributor){
            $distributor->user=User::find($distributor->user_id);
            $ledgers=[];
            $ls=Ledger::where('user_id',$distributor->user_id)->orderBy('id', 'ASC')->get();
            $distributor->wrong=false;
            $first=0;
            foreach($ls as $ledger){
                $amount=0;
                $track=0;
                if($ledger->cr>0){
                    $amount=(-1)*$ledger->cr;
                }elseif($ledger->dr>0){
                    $amount=$ledger->dr;
                }

                if($ledger->type==1){
                    $track=$amount+$ledger->amount;

                }else{
                    $track=$amount-$ledger->amount;

                }

                $ledger->wrong=$first!=$track;
                $ledger->first=$first;
                $ledger->track=$track;
                if($ledger->wrong){
                    $distributor->wrong=true;
                }
                $first=$amount;
                array_push($ledgers,$ledger);
            }
            $distributor->ledgers=$ledgers;
            array_push($datas,$distributor);
        }
        return view('testing.distributor',compact('datas'));
    }


    public function distributorByDate(){
        $distributors=Distributer::all();
        $datas=[];
        foreach($distributors as $distributor){
            $distributor->user=User::find($distributor->user_id);
            $ledgers=[];
            $ls=Ledger::where('user_id',$distributor->user_id)->orderBy('date', 'ASC')->orderBy('id', 'ASC')->get();
            $distributor->wrong=false;
            $first=0;
            foreach($ls as $ledger){
                $amount=0;
                $track=0;
                if($ledger->cr>0){
                    $amount=(-1)*$ledger->cr;
                }elseif($ledger->dr>0){
                    $amount=$ledger->dr;
                }

                if($ledger->type==1){
                    $track=$amount+$ledger->amount;

                }else{
                    $track=$amount-$ledger->amount;

                }

                $ledger->wrong=$first!=$track;
                $ledger->first=$first;
                $ledger->track=$track;
                if($ledger->wrong){
                    $distributor->wrong=true;
                }
                $first=$amount;
                array_push($ledgers,$ledger);
            }
            $distributor->ledgers=$ledgers;
            array_push($datas,$distributor);
        }
        return view('testing.distributor',compact('datas'));
    }
}
