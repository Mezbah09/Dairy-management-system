<?php

namespace App\Http\Controllers;

use App\LedgerManage;
use App\Models\Advance;
use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Center;
use App\Models\DistributorPayment;
use App\Models\Distributer;
use App\Models\Distributorsell;
use App\Models\Employee;
use App\Models\Farmer;
use App\Models\FarmerReport;
use App\Models\Ledger;
use App\Models\Milkdata;
use App\Models\Sellitem;
use App\Models\Product;
use App\Models\Snffat;
use App\Models\SessionWatch;
use App\Models\FarmerSession;
use App\Models\EmployeeAdvance;
use App\Models\EmployeeReport;
use App\Models\Expense;
use App\Models\User;
use App\AppDate;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB as DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.report.index');
    }

    public function farmer(Request $request)
    {
        if ($request->getMethod() == "POST") {
            // dd($request->all());
            if ($request->s_number != null && $request->e_number != null) {
                $farmers = Farmer::join('users', 'users.id', '=', 'farmers.user_id')->where('users.no', '>=', $request->s_number)->where('users.no', '<=', $request->e_number)->where('farmers.center_id', $request->center_id)->select('users.id', 'users.name', 'users.no', 'farmers.center_id')->orderBy('users.no', 'asc')->get();
            } else {
                $farmers = Farmer::join('users', 'users.id', '=', 'farmers.user_id')->where('farmers.center_id', $request->center_id)->select('users.id', 'users.name', 'users.no', 'farmers.center_id')->orderBy('users.no', 'asc')->get();
            }
            $center = Center::find($request->center_id);
            $year = $request->year;
            $month = $request->month;
            $session = $request->session;
            $usetc = (env('usetc', 0) == 1) && ($center->tc > 0);
            $usecc = (env('usecc', 0) == 1) && ($center->cc > 0);
            $range = AppDate::getDate($request->year, $request->month, $request->session);
            $newsession = SessionWatch::where(['year' => $year, 'month' => $month, 'session' => $session, 'center_id' => $center->id])->count() == 0;
            // if(SessionWatch::where(['year'=>$year,'month'=>$month,'session'=>$session,'center_id'=>$center->id])->count()>0){
            //     $data=FarmerReport::where(['year'=>$year,'month'=>$month,'session'=>$session,'center_id'=>$center->id])->get();
            //     return view('admin.report.farmer.data1',compact('usecc','usetc','data','year','month','session','center'));

            // }else{

            $data = [];
            foreach ($farmers as $farmer) {
                if (FarmerReport::where(['year' => $year, 'month' => $month, 'session' => $session, 'user_id' => $farmer->id])->count() > 0) {
                    $_data = FarmerReport::where(['year' => $year, 'month' => $month, 'session' => $session, 'user_id' => $farmer->id])->first();

                    $farmer->old = true;
                } else {
                    $_data = LedgerManage::farmerReport($farmer->id, $range, false, $center);
                    // $m_amount=Milkdata::where('user_id',$farmer->id)->where('date','>=',$range[1])->where('date','<=',$range[2])->sum('m_amount');
                    // $e_amount=Milkdata::where('user_id',$farmer->id)->where('date','>=',$range[1])->where('date','<=',$range[2])->sum('e_amount');

                    // $snfavg=Snffat::where('user_id',$farmer->id)->where('date','>=',$range[1])->where('date','<=',$range[2])->avg('snf');
                    // $fatavg=Snffat::where('user_id',$farmer->id)->where('date','>=',$range[1])->where('date','<=',$range[2])->avg('fat');



                    // $farmer->snf=(float)truncate_decimals( $snfavg);
                    // $farmer->fat=(float)truncate_decimals( $fatavg) ;
                    // $farmer->milk=(float)($m_amount+$e_amount);
                    // $farmer->total=0;
                    // $farmer->rate=0;
                    // $farmer->bonus=0;
                    // $farmer->tc=0;
                    // $farmer->cc=0;
                    // $farmer->grandtotal=0;
                    // if($snfavg!=null || $fatavg!=null){
                    //     $rate=truncate_decimals(($center->snf_rate* $farmer->snf ) + ($center->fat_rate*  $farmer->fat ));
                    //     $farmer->rate=(float)truncate_decimals($rate);
                    //     $farmer->total=(float)truncate_decimals( $rate*($farmer->milk));

                    //     // $farmer->grandtotal=;
                    //     if ($usetc && $farmer->total>0){
                    //         $farmer->tc=truncate_decimals($farmer->milk*($center->tc*($farmer->snf+$farmer->fat)/100));
                    //     }
                    //     if ($usecc && $farmer->total>0){
                    //         $farmer->cc=truncate_decimals($farmer->milk*$center->cc);
                    //     }

                    //     $farmer->grandtotal=(int)($farmer->total+$farmer->cc+$farmer->tc);
                    //     if (env('hasextra',0)==1){
                    //         $farmer->bonus=(int)($farmer->grandtotal*$center->bonus/100);
                    //     }

                    // }
                    // $due=Sellitem::where('user_id',$farmer->id)->where('date','>=',$range[1])->where('date','<=',$range[2])->sum('due');
                    // $farmer->due=(float)$due;
                    // $previousMonth=Ledger::where('user_id',$farmer->id)->where('date','>=',$range[1])->where('date','<=',$range[2])->where('identifire','101')->sum('amount');
                    // $previousMonth1=Ledger::where('user_id',$farmer->id)->where('date','>=',$range[1])->where('date','<=',$range[2])->where('identifire','120')->where('type',1)->sum('amount');
                    // $prevbalance=Ledger::where('user_id',$farmer->id)->where('date','>=',$range[1])->where('date','<=',$range[2])->where('identifire','120')->where('type',2)->sum('amount');
                    // $farmer->prevdue=(float)$previousMonth+(float)$previousMonth;
                    // $farmer->nettotal=(float)($farmer->total-$farmer->due-$farmer->prevdue);
                    // $farmer->prevbalance=(float)($prevbalance??0);
                    // $farmer->advance=(float)(Advance::where('user_id',$farmer->id)->where('date','>=',$range[1])->where('date','<=',$range[2])->sum('amount'));
                    // $farmer->old=false;
                }
                $farmer->milk = $_data->milk;
                $farmer->fpaid = $_data->fpaid;
                $farmer->fat = $_data->fat;
                $farmer->snf = $_data->snf;
                $farmer->rate = $_data->rate;
                $farmer->total = $_data->totalamount;
                $farmer->tc = $_data->tc;
                $farmer->cc = $_data->cc;
                $farmer->grandtotal = $_data->grandtotal;
                $farmer->bonus = $_data->bonus;
                $farmer->prevdue = $_data->prevdue;
                $farmer->due = $_data->due;
                $farmer->advance = $_data->advance;
                $farmer->prevbalance = $_data->prevbalance;
                $farmer->paidamount = $_data->paidamount;
                $farmer->nettotal = $_data->nettotal;
                $farmer->balance = $_data->balance;
                $farmer->advance = $_data->advance;
                array_push($data, $farmer);
            }
            $date1 = AppDate::getDateSessionLast($year, $month, $session);
            // return response()->json(compact('date1','newsession','usetc','usecc','data','year','month','session','center'));
            return view('admin.report.farmer.data', compact('date1', 'newsession', 'usetc', 'usecc', 'data', 'year', 'month', 'session', 'center'));
            // }
        } else {

            return view('admin.report.farmer.index');
        }
    }

    public function farmerSingleSession(Request $request)
    {
        $nextdate = AppDate::getNextDate($request->year, $request->month, $request->session);
        $lastdate = $lastdate = str_replace('-', '', $request->date);;
        $ledger = new LedgerManage($request->id);

        // Sellitem::where('user_id',$request->id)->update([
        //                     'due'=>0,
        //                     'paid'=>DB::raw("`total`")
        // ]);


        // dd($request);
        if ($request->grandtotal > 0) {
            $ledger->addLedger("Payment for milk (" . ($request->milk) . "l)", 2, $request->grandtotal, $lastdate, '108');
        }
        // if($request->nettotal>0 ||$request->balance>0){



        //     if($request->nettotal>0){
        //         if(env('paywhenupdate',0)==1){
        //             $ledger->addLedger("Payment Given To Farmer",1,$request->nettotal,$lastdate,'110');
        //         }else{
        //             $ledger->addLedger("Closing Balance",1,$request->nettotal,$lastdate,'109');
        //             $ledger->addLedger("Previous Balance",2,$request->nettotal,$nextdate,'120');
        //         }
        //     }else{
        //         if($request->balance>0){
        //             $ledger->addLedger("Closing Balance",2,$request->balance,$lastdate,'109');
        //             $ledger->addLedger("Aalya",1,$request->balance,$nextdate,'101');
        //         }
        //     }
        // }
        $farmerreport = new FarmerReport();
        $farmerreport->user_id = $request->id;
        $farmerreport->milk = $request->milk;
        $farmerreport->snf = $request->snf ?? 0;
        $farmerreport->fat = $request->fat ?? 0;
        $farmerreport->rate = $request->rate ?? 0;
        $farmerreport->total = $request->total ?? 0;
        $farmerreport->due = $request->due ?? 0;
        $farmerreport->bonus = $request->bonus ?? 0;
        $farmerreport->prevdue = $request->prevdue ?? 0;
        $farmerreport->advance = $request->advance ?? 0;
        $farmerreport->nettotal = $request->nettotal ?? 0;
        $farmerreport->balance = $request->balance ?? 0;
        $farmerreport->paidamount = $request->paidamount ?? 0;
        $farmerreport->prevbalance = $request->prevbalance ?? 0;
        $farmerreport->tc = $request->tc ?? 0;
        $farmerreport->cc = $request->cc ?? 0;
        $farmerreport->grandtotal = $request->grandtotal ?? $request->total;
        $farmerreport->year = $request->year;
        $farmerreport->month = $request->month;
        $farmerreport->session = $request->session;
        $farmerreport->fpaid = $request->fpaid;
        $farmer = Farmer::where('user_id', $request->id)->first();
        $farmerreport->center_id = $farmer->center_id;
        $farmerreport->save();
        return redirect()->back();
    }

    public function farmerSession(Request $request)
    {
        // dd($request->all());
        $nextdate = AppDate::getNextDate($request->year, $request->month, $request->session);
        $lastdate = str_replace('-', '', $request->date);

        foreach ($request->farmers as $farmer) {
            $data = json_decode($farmer);

            $ledger = new LedgerManage($data->id);
            $grandtotal = $data->grandtotal ?? 0;

            if ($data->grandtotal > 0) {

                $ledger->addLedger("Payment for milk (" . ($data->milk) . "l X " . ($data->rate ?? 0) . ")", 2, $data->grandtotal ?? 0, $lastdate, '108');
            }

            // if($data->nettotal>0 ||$data->balance>0){


            //     if($data->nettotal>0){
            //         if(env('paywhenupdate',0)==1){
            //             $ledger->addLedger("Payment Given To Farmer",1,$data->nettotal,$lastdate,'110');
            //         }else{
            //             $ledger->addLedger("Closing Balance",1,$data->nettotal,$lastdate,'109');
            //             $ledger->addLedger("Previous Balance",2,$data->nettotal,$nextdate,'120');
            //         }
            //     }else{
            //         if($data->balance>0){
            //             $ledger->addLedger("Closing Balance",2,$data->balance,$lastdate,'109');
            //             $ledger->addLedger("Aalya",1,$data->balance,$nextdate,'101');
            //         }
            //     }
            // }
            $farmerreport = new FarmerReport();
            $farmerreport->user_id = $data->id;
            $farmerreport->milk = $data->milk;
            $farmerreport->snf = $data->snf ?? 0;
            $farmerreport->fat = $data->fat ?? 0;
            $farmerreport->rate = $data->rate ?? 0;
            $farmerreport->total = $data->total ?? 0;
            $farmerreport->due = $data->due ?? 0;
            $farmerreport->prevdue = $data->prevdue ?? 0;
            $farmerreport->bonus = $data->bonus ?? 0;
            $farmerreport->advance = $data->advance ?? 0;
            $farmerreport->nettotal = $data->nettotal ?? 0;
            $farmerreport->balance = $data->balance ?? 0;
            $farmerreport->tc = $data->tc ?? 0;
            $farmerreport->fpaid = $data->fpaid ?? 0;
            $farmerreport->cc = $data->cc ?? 0;
            $farmerreport->grandtotal = $data->grandtotal ?? ($data->total ?? 0);
            $farmerreport->paidamount = $data->paidamount ?? 0;
            $farmerreport->prevbalance = $data->prevbalance;
            $farmerreport->year = $request->year;
            $farmerreport->month = $request->month;
            $farmerreport->session = $request->session;
            $farmerreport->center_id = $request->center_id;
            $farmerreport->save();
        }

        $sessionwatch = new SessionWatch();
        $sessionwatch->year = $request->year;
        $sessionwatch->month = $request->month;
        $sessionwatch->session = $request->session;
        $sessionwatch->center_id = $request->center_id;
        $sessionwatch->save();

        //    foreach($request->ids as $user_id){

        //     if($request->input['balance.farmer_'.$user_id]<=0){

        //         Sellitem::where('user_id',$user_id)->update(
        //             [
        //                 'due'=>0,
        //                 'paid'=>DB::raw("`total`")
        //             ]
        //         );
        //     }else{
        //         $due = Sellitem::where('user_id',$user_id)->where('due','>',0)->get();
        //         $paidmaount=$request->input['total.farmer_'.$user_id];
        //         foreach ($due as $key => $value) {
        //             if($paidmaount<=0){
        //                 break;
        //             }
        //             if($paidmaount>=$value->due){
        //                 $paidmaount -= $value->due;
        //                 $value->due =0;
        //                 $value->save();
        //             }else{
        //                 $value->due-=$paidmaount;
        //                 $paidmaount=0;
        //                 $value->save();
        //             }
        //         }
        //     }

        //     $total = $request->input['nettotal.farmer_'.$user_id];
        //     $balance=$request->input['balance.farmer_'.$user_id];
        //     $ledger=new LedgerManage($user_id);
        //     $ledger->addLedger("Payment form milk (".$request->input['milk.farmer_'.$user_id]."l X ".$request->input['milk.farmer_'.$user_id].")",2,$total,$nextdate,'108',);




        //    }

        return redirect()->back();
    }

    public function milk(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $year = $request->year;
            $month = $request->month;
            $week = $request->week;
            $session = $request->session;
            $type = $request->type;
            $range = [];
            $data = [];

            $milkdatas = DB::table('milkdatas')->join('farmers', 'farmers.user_id', '=', 'milkdatas.user_id')
                ->join('centers', 'centers.id', '=', 'farmers.center_id')
                ->join('users', 'users.id', '=', 'milkdatas.user_id');

            if ($type == 0) {
                $range = AppDate::getDate($request->year, $request->month, $request->session);
                $milkdatas = $milkdatas->where('milkdatas.date', '>=', $range[1])->where('milkdatas.date', '<=', $range[2]);
            } elseif ($type == 1) {
                $date = $date = str_replace('-', '', $request->date1);
                $milkdatas = $milkdatas->where('milkdatas.date', '=', $date);
            } elseif ($type == 2) {
                $range = AppDate::getDateWeek($request->year, $request->month, $request->week);
                $milkdatas = $milkdatas->where('milkdatas.date', '>=', $range[1])->where('milkdatas.date', '<=', $range[2]);
            } elseif ($type == 3) {
                $range = AppDate::getDateMonth($request->year, $request->month);
                $milkdatas = $milkdatas->where('milkdatas.date', '>=', $range[1])->where('milkdatas.date', '<=', $range[2]);
            } elseif ($type == 4) {
                $range = AppDate::getDateYear($request->year);
                $milkdatas = $milkdatas->where('milkdatas.date', '>=', $range[1])->where('milkdatas.date', '<=', $range[2]);
            } elseif ($type == 5) {
                $range[1] = str_replace('-', '', $request->date1);;
                $range[2] = str_replace('-', '', $request->date2);;
                $milkdatas = $milkdatas->where('milkdatas.date', '>=', $range[1])->where('milkdatas.date', '<=', $range[2]);
            }

            $hascenter = false;
            if ($request->center_id != -1) {
                $hascenter = true;
                $milkdatas = $milkdatas->where('farmers.center_id', $request->center_id);
            }

            $datas = $milkdatas->select('milkdatas.m_amount', 'milkdatas.e_amount', 'milkdatas.user_id', 'milkdatas.date', 'farmers.center_id', 'users.name', 'users.no')->get();
            $data1 = $milkdatas->select(DB::raw('(sum(milkdatas.m_amount)+sum(milkdatas.e_amount)) as milk ,milkdatas.user_id ,users.name,users.no,farmers.center_id'))->groupBy('milkdatas.user_id', 'users.name', 'users.no', 'farmers.center_id')->get()->groupBy('center_id');

            // dd($datas, $data1);

            return view('admin.report.milk.data', compact('data1'));
        } else {
            return view('admin.report.milk.index');
        }
    }

    public function sales(Request $request)
    {
        if ($request->getMethod() == "POST") {
            // dd($request->all());
            $year = $request->year;
            $month = $request->month;
            $week = $request->week;
            $session = $request->session;
            $type = $request->type;
            $range = [];
            $data = [];
            $sellitem = Sellitem::join('farmers', 'farmers.user_id', '=', 'sellitems.user_id')
                ->join('users', 'users.id', '=', 'farmers.user_id')
                ->join('items', 'items.id', 'sellitems.item_id');

            $sellmilk = Distributorsell::join('distributers', 'distributers.id', '=', 'distributorsells.distributer_id')
                ->join('users', 'users.id', '=', 'distributers.user_id');

            if ($type == 0) {
                $range = AppDate::getDate($request->year, $request->month, $request->session);
                $sellitem = $sellitem->where('sellitems.date', '>=', $range[1])->where('sellitems.date', '<=', $range[2]);
                $sellmilk = $sellmilk->where('distributorsells.date', '>=', $range[1])->where('distributorsells.date', '<=', $range[2]);
            } elseif ($type == 1) {
                $date = $date = str_replace('-', '', $request->date1);
                $sellitem = $sellitem->where('sellitems.date', '=', $date);
                $sellmilk = $sellmilk->where('distributorsells.date', '=', $date);
            } elseif ($type == 2) {
                $range = AppDate::getDateWeek($request->year, $request->month, $request->week);
                $sellitem = $sellitem->where('sellitems.date', '>=', $range[1])->where('sellitems.date', '<=', $range[2]);
                $sellmilk = $sellmilk->where('distributorsells.date', '>=', $range[1])->where('distributorsells.date', '<=', $range[2]);
            } elseif ($type == 3) {
                $range = AppDate::getDateMonth($request->year, $request->month);
                $sellitem = $sellitem->where('sellitems.date', '>=', $range[1])->where('sellitems.date', '<=', $range[2]);
                $sellmilk = $sellmilk->where('distributorsells.date', '>=', $range[1])->where('distributorsells.date', '<=', $range[2]);
            } elseif ($type == 4) {
                $range = AppDate::getDateYear($request->year);
                $sellitem = $sellitem->where('sellitems.date', '>=', $range[1])->where('sellitems.date', '<=', $range[2]);
                $sellmilk = $sellmilk->where('distributorsells.date', '>=', $range[1])->where('distributorsells.date', '<=', $range[2]);
            } elseif ($type == 5) {
                $range[1] = str_replace('-', '', $request->date1);;
                $range[2] = str_replace('-', '', $request->date2);;
                $sellitem = $sellitem->where('sellitems.date', '>=', $range[1])->where('sellitems.date', '<=', $range[2]);
                $sellmilk = $sellmilk->where('distributorsells.date', '>=', $range[1])->where('distributorsells.date', '<=', $range[2]);
            }

            if ($request->center_id != -1) {
                $sellitem = $sellitem->where('farmers.center_id', $request->center_id);
            }

            $data['sellitem'] = $sellitem->select('sellitems.date', 'sellitems.rate', 'sellitems.qty', 'sellitems.total', 'sellitems.due', 'users.name', 'items.title', 'users.no')->orderBy('sellitems.date', 'asc')->get();
            $data['sellitem1'] = $sellitem->select('sellitems.date', 'sellitems.rate', 'sellitems.qty', 'sellitems.total', 'sellitems.due', 'users.name', 'items.title', 'users.no')->orderBy('sellitems.date', 'asc')->get()->groupBy('title');
            // dd( $data['sellitem1']);
            $data['sellmilk'] = $sellmilk->select('distributorsells.*', 'users.name')->get();
            $data['sellmilk1'] = $sellmilk->select('distributorsells.*', 'users.name')->get()->groupBy('distributer_id');

            $maxdatas = [];
            foreach ($data['sellmilk1'] as $key => $d) {
                $dd = [];
                $dd['distributor'] = Distributer::find($key);
                $dt = $d->groupBy('product_id');
                $products = [];
                foreach ($dt as $key1 => $ddd) {
                    $product = [];
                    $product['product'] = Product::find($key1);
                    $product['qty'] = $ddd->sum('qty');
                    $product['rate'] = $ddd->avg('rate');
                    $product['total'] = $ddd->sum('total');
                    array_push($products, (object)$product);
                }
                $dd['products'] = $products;
                array_push($maxdatas, (object)$dd);
            }

            // dd($maxdatas);
            return view('admin.report.sales.data', compact('data', 'maxdatas'));
        } else {
            return view('admin.report.sales.index');
        }
    }


    // billing sale

    public function posSales(Request $request)
    {
        if ($request->isMethod('post')) {
            $year = $request->year;
            $month = $request->month;
            $week = $request->week;
            $type = $request->type;
            $range = [];
            $bill = Bill::orderBy('id', 'desc');

            if ($type == 0) {
            } elseif ($type == 1) {
                $date = $date = str_replace('-', '', $request->date1);
                $bill = $bill->where('date', $date);
            } elseif ($type == 2) {
                $range = AppDate::getDateWeek($request->year, $request->month, $request->week);
                $bill = $bill->where('date', '>=', $range[1])->where('date', '<=', $range[2]);
            } elseif ($type == 3) {
                $range = AppDate::getDateMonth($request->year, $request->month);
                $bill = $bill->where('date', '>=', $range[1])->where('date', '<=', $range[2]);
            } elseif ($type == 4) {
                $range = AppDate::getDateYear($request->year);
                $bill = $bill->where('date', '>=', $range[1])->where('date', '<=', $range[2]);
            } elseif ($type == 5) {
                $range[1] = str_replace('-', '', $request->date1);
                $range[2] = str_replace('-', '', $request->date2);
                $bill = $bill->where('date', '>=', $range[1])->where('date', '<=', $range[2]);
            }

            $bill = $bill->select('id', 'date', 'name', 'grandtotal', 'net_total', 'dis')->orderBy('date', 'asc')->get();
            $billitems = [];
            foreach ($bill as $b) {
                $items = BillItem::where('bill_id', $b->id)->get();
                foreach ($items as $key => $item) {
                    if (isset($billitems['item_' . $item->item_id . "_" . $item->rate])) {
                        $billitems['item_' . $item->item_id . "_" . $item->rate]['qty'] = $billitems['item_' . $item->item_id . "_" . $item->rate]['qty'] + $item->qty;
                        $billitems['item_' . $item->item_id . "_" . $item->rate]['total'] = $billitems['item_' . $item->item_id . "_" . $item->rate]['total'] + $item->total;
                    } else {
                        $billitems['item_' . $item->item_id . "_" . $item->rate] = [
                            "name" => $item->name,
                            'qty' => $item->qty,
                            'rate' => $item->rate,
                            'total' => $item->total
                        ];
                    }
                }
            }
            // dd($billitems);

            return view('admin.report.billingsale.data', compact('bill', 'billitems'));
        } else {
            return view('admin.report.billingsale.index');
        }
    }




    // distributer

    public function distributor(Request $request)
    {

        if ($request->getMethod() == "POST") {
            // dd($request->all());
            $elements = [];
            $year = $request->year;
            $month = $request->month;
            $week = $request->week;
            $session = $request->session;
            $type = $request->type;
            $range = [];
            $data = [];
            $date = -1;

            foreach (Distributer::all() as $key => $dis) {

                $base = Ledger::where('user_id', $dis->user_id);
                $range = [];
                $date = -1;

                if ($type == 0) {
                    $range = AppDate::getDate($request->year, $request->month, $request->session);
                } elseif ($type == 1) {
                    $date = $date = str_replace('-', '', $request->date1);
                } elseif ($type == 2) {
                    $range = AppDate::getDateWeek($request->year, $request->month, $request->week);
                } elseif ($type == 3) {
                    $range = AppDate::getDateMonth($request->year, $request->month);
                } elseif ($type == 4) {
                    $range = AppDate::getDateYear($request->year);
                } elseif ($type == 5) {
                    $range[1] = str_replace('-', '', $request->date1);;
                    $range[2] = str_replace('-', '', $request->date2);;
                }
                if ($type == 1) {
                    $prev = Ledger::where('user_id', $dis->user_id)->where('type', 2)->where('date', '<', $date)->sum('amount') - Ledger::where('user_id', $dis->user_id)->where('type', 1)->where('date', '<', $date)->sum('amount');
                    $buy = Ledger::where('user_id', $dis->user_id)->where('identifire', 105)->where('date', $date)->sum('amount');
                    $pay1 = Ledger::where('user_id', $dis->user_id)->where('identifire', 111)->where('date', $date)->sum('amount');
                    $pay2 = Ledger::where('user_id', $dis->user_id)->where('identifire', 114)->where('date', $date)->sum('amount');
                } else {
                    $prev = Ledger::where('user_id', $dis->user_id)->where('type', 2)->where('date', '<', $range[1])->sum('amount') - Ledger::where('user_id', $dis->user_id)->where('type', 1)->where('date', '<', $range[1])->sum('amount');
                    $buy = Ledger::where('user_id', $dis->user_id)->where('identifire', 105)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->sum('amount');
                    $pay1 = Ledger::where('user_id', $dis->user_id)->where('identifire', 111)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->sum('amount');
                    $pay2 = Ledger::where('user_id', $dis->user_id)->where('identifire', 114)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->sum('amount');
                }
                $user = User::where('id', $dis->user_id)->first();
                array_push($data, [
                    'id' => $dis->id,
                    'name' => $user->name,
                    'prev' => $prev,
                    'buy' => $buy,
                    'pay' => $pay1 + $pay2,
                    'range' => $range,
                    'date' => $date,
                    'uid' => $user->id
                ]);
            }
            // dd($data);



            return view('admin.report.distributor.data', compact('data'));
        } else {
            return view('admin.report.distributor.index');
        }
    }

    public function employee(Request $request)
    {
        if ($request->getMethod() == "POST") {
            // dd($request->all());
            $range = AppDate::getDateMonth($request->year, $request->month);
            $year = $request->year;
            $month = $request->month;
            $employees = Employee::all();
            $data = [];
            foreach ($employees as $employee) {
                if (EmployeeReport::where('employee_id', $employee->id)->where('year', $request->year)->where('month', $request->month)->count() > 0) {
                    $report = EmployeeReport::where('employee_id', $employee->id)->where('year', $request->year)->where('month', $request->month)->first();
                    $employee->prevbalance = $report->prevbalance;
                    $employee->advance = $report->advance;
                    $employee->salary = $report->salary;
                    $employee->old = true;
                } else {
                    $employee->prevbalance = Ledger::where('user_id', $employee->user_id)->where('identifire', '101')->where('date', '>=', $range[1])->where('date', '<=', $range[2])->sum('amount');
                    $employee->advance = EmployeeAdvance::where('employee_id', $employee->id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->sum('amount');
                    $employee->old = false;
                }
                array_push($data, $employee);

                // dd($data);
            }
            // $advance=EmployeeAdvance::where
            return view('admin.report.employee.data', compact('data', 'year', 'month'));
        } else {
            return view('admin.report.employee.index');
        }
    }

    public function employeeSession(Request $request)
    {
        foreach ($request->employees as $employee) {
            $report = new EmployeeReport();
            $report->employee_id = $employee->id;
            $report->prebalance = $employee->prevbalance;
            $report->advance = $employee->advance;
            $report->salary = $employee->salary;
            $report->save();
        }
        return redirect()->back();
    }



    public function credit()
    {
        $farmercredit = \App\Models\User::where('role', 1)->where('amount', '>', 0)->where('amounttype', 1)->get();
        $distributorcredit = \App\Models\User::where('role', 2)->where('amount', '>', 0)->where('amounttype', 1)->get();
        return view('admin.report.credit.index', compact('farmercredit', 'distributorcredit'));
    }


    public function expense(Request $request)
    {
        if ($request->isMethod('post')) {
            $type = $request->type;
            $range = [];
            $data = [];
            $data = Expense::orderBy('id', 'desc');

            if ($type == 0) {
            } elseif ($type == 1) {
                $date = $date = str_replace('-', '', $request->date1);
                $data = $data->where('date', '=', $date);
            } elseif ($type == 2) {
                $range = AppDate::getDateWeek($request->year, $request->month, $request->week);
                $data = $data->where('date', '>=', $range[1])->where('date', '<=', $range[2]);
            } elseif ($type == 3) {
                $range = AppDate::getDateMonth($request->year, $request->month);
                $data = $data->where('date', '>=', $range[1])->where('date', '<=', $range[2]);
            } elseif ($type == 4) {
                $range = AppDate::getDateYear($request->year);
                $data = $data->where('date', '>=', $range[1])->where('date', '<=', $range[2]);
            } elseif ($type == 5) {
                $range[1] = str_replace('-', '', $request->date1);;
                $range[2] = str_replace('-', '', $request->date2);;
                $data = $data->where('date', '>=', $range[1])->where('date', '<=', $range[2]);
            }
            if ($request->category_id == null) {
                $data = $data->get();
            }
            $hascat = false;
            if ($request->category_id != -1) {
                $hascat = true;
                $data = $data->where('expcategory_id', $request->category_id)->get();
            } else {
                $data = $data->get();
            }
            return view('admin.report.expense.data', compact('data'));
        } else {
            return view('admin.report.expense.index');
        }
    }


    public function adjustment()
    {

        $center = Center::find(3);
        $date = [0, 20780501, 20780515];
        $farmers = Farmer::join('users', 'users.id', '=', 'farmers.user_id')->where('farmers.center_id', $center->id)->select('users.id', 'users.name', 'users.no', 'farmers.center_id')->orderBy('users.no', 'asc')->get();
        foreach ($farmers as $farmer) {
            if (FarmerReport::where(['year' => 2078, 'month' => 5, 'session' => 1, 'user_id' => $farmer->id])->count() > 0) {
                $_data = FarmerReport::where(['year' => 2078, 'month' => 5, 'session' => 1, 'user_id' => $farmer->id])->first();
                $farmer->old = true;
            } else {
                $_data = LedgerManage::farmerReport($farmer->id, $date);
            }

            if ($_data->prevbalance > 0) {
                $ledger = new LedgerManage($farmer->id);
                $ledger->addLedger('Adjustment', 1, $_data->prevbalance, 20780501, '500');
            }

            // $date1=AppDate::getDateSessionLast($year,$month,$session);

            // }

        }
    }
}
