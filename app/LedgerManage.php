<?php

namespace App;

use App\Models\Advance;
use App\Models\Center;
use App\Models\Distributorsell;
use App\Models\Ledger;
use App\Models\Milkdata;
use App\Models\Sellitem;
use App\Models\Snffat;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LedgerManage
{
    public  $user;

    public function  __construct($user_id)
    {
        $this->user = User::find($user_id);
    }

    /*
    *amounttype[1="CR",2="DR"]
    * "101"= Aalya
    * "102"= "farmer opening balance/advance"
    * "103" = "item sell"
    * "104" = "Farmer Advance"
    * "106" = "Farmer amount paid at Selling item"
    * "107" = "Due amount paid by farmer"
    * "108" = "Famer milk Money Adjustment"
    * "109" = "Money given to farmer"
    * "110" = "farmer closing Balance"
    * "116" = "Farmer item return"
    * "117" = "Farmer item return paid cancel"
    * "121" = "Farmer paid"

    * "105" = "Sold to distributer"
    * "114" = "distributer Payment"
    * "115" = "distributer sell cancel"
    * "118" = "Account Adjustment"
    * "119" = "Distributor opening balance"
    * "120" = ""

    * "111" = "Distributor Payment"
    * "112" = "Employee Advaance payment"
    * "113" = "Employee Advaance payment cancel"
    * "140" = "Employee Advaance payment Retrn"
    * "124" = "Employee Salary payment"
    * "122" = "paid amount while billing"
    * "123" = "purchase in billing items"



    * "125" = "purchase from suppliers"
    * "126" = "paid to suppliers through billing entry"
    * "127" = "Payment to supplier"
    * "128" = "Previous balance of supplier"

    */
    public function addLedger($particular, $type, $amount, $date, $identifier, $foreign_id = null)
    {
        $nepalidate = new AppDate($date);
        $_amount = $this->user->amount;
        $amounttype = $this->user->amounttype ?? 1;

        if ($amounttype == 1) {
            $_amount = -1 * $_amount;
        }

        if ($type == 1) {
            $_amount -= $amount;
        } else {
            $_amount += $amount;
        }

        $l = new \App\Models\Ledger();
        $l->amount = $amount;
        $l->title = $particular;
        $l->date = $date;
        $l->identifire = $identifier;
        $l->foreign_key = $foreign_id;
        $l->user_id = $this->user->id;
        $l->year = $nepalidate->year;
        $l->month = $nepalidate->month;
        $l->session = $nepalidate->session;
        $l->type = $type;
        $t = 1;

        if ($_amount > 0) {
            $t = 2;
            $l->dr = $_amount;
        } else if ($_amount < 0) {
            $t = 1;
            $_amount = -1 * $_amount;
            $l->cr = $_amount;
        }
        $this->user->amount = $_amount;
        $this->user->amounttype = $t;
        $this->user->save();
        $l->save();
        return $l;
    }



    public static  function delLedger($ledgers)
    {
        foreach ($ledgers as $ledger) {
            $user = User::find($ledger->user_id);
            $ledgers = Ledger::where('id', '>', $ledger->id)->where('user_id', $ledger->user_id)->orderBy('id', 'asc')->get();
            $track = 0;
            //find first point
            if ($ledger->cr > 0) {
                $track = (-1) * $ledger->cr;
            }
            if ($ledger->dr > 0) {
                $track = $ledger->dr;
            }
            echo 'first' . $track . "<br>";

            //find old data

            if ($ledger->type == 1) {
                $track += $ledger->amount;
            } else {
                $track -= $ledger->amount;
            }


            $ledger->delete();

            foreach ($ledgers as $l) {

                if ($l->type == 1) {
                    $track -= $l->amount;
                } else {
                    $track += $l->amount;
                }

                if ($track < 0) {
                    $l->cr = (-1) * $track;
                    $l->dr = 0;
                } else {
                    $l->dr = $track;
                    $l->cr = 0;
                }
                $l->save();
            }

            $t = 0;
            if ($track > 0) {
                $t = 2;
            } else if ($track < 0) {
                $t = 1;
                $track = (-1) * $track;
            }


            $user->amount = $track;
            $user->amounttype = $t;
            $user->save();
        }
    }


    public static function farmerReport($user_id, $range, $needledger = false, $center = null)
    {
        $farmer1 = User::find($user_id);
        $farmer = $farmer1->farmer();

        $snfAvg = truncate_decimals(Snffat::where('user_id', $user_id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->avg('snf'), 2);
        $fatAvg = truncate_decimals(Snffat::where('user_id', $user_id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->avg('fat'), 2);
        if ($center == null) {
            $center = DB::table('centers')->where('id', $farmer->center_id)->first();
        }

        $fatAmount = ($fatAvg * $center->fat_rate);
        $snfAmount = ($snfAvg * $center->snf_rate);

        $farmer1->snf = $snfAvg;
        $farmer1->fat = $fatAvg;
        if ($farmer->userate == 1) {

            $farmer1->rate = $farmer->rate;
        } else {

            $farmer1->rate = truncate_decimals($fatAmount + $snfAmount);
        }

        $farmer1->milk = Milkdata::where('user_id', $user_id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->sum('e_amount') + Milkdata::where('user_id', $user_id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->sum('m_amount');

        $farmer1->totalamount = truncate_decimals(($farmer1->rate * $farmer1->milk), 2);

        $farmer1->tc = 0;
        $farmer1->cc = 0;


        if ($farmer->usetc == 1 && $farmer1->totalamount > 0) {
            $farmer1->tc = truncate_decimals((($center->tc * ($snfAvg + $fatAvg) / 100) * $farmer1->milk), 2);
        }
        if ($farmer->usecc == 1 && $farmer1->totalamount > 0) {
            $farmer1->cc = truncate_decimals($center->cc * $farmer1->milk, 2);
        }


        $farmer1->grandtotal = (int)($farmer1->totalamount + $farmer1->tc + $farmer1->cc);
        $farmer1->bonus = 0;
        if (env('hasextra', 0) == 1) {
            $farmer1->bonus = (int)($farmer1->grandtotal * $center->bonus / 100);
        }
        $farmer1->fpaid = (Ledger::where('user_id', $user_id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->where('identifire', '106')->sum('amount') + Ledger::where('user_id', $user_id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->where('identifire', '107')->sum('amount'));
        $farmer1->due = Ledger::where('user_id', $user_id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->where('identifire', '103')->sum('amount');;
        $previousMonth = Ledger::where('user_id', $user_id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->where('identifire', '101')->sum('amount');
        // $previousMonth1 = Ledger::where('user_id', $user_id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->where('identifire', '120')->where('type', 1)->sum('amount');
        // $ledgers= Ledger::where('user_id',$user_id)->where('date','<',$range[1])->where('identifire','!=',109)->where('identifire','!=',120)->orderBy('date','asc')->orderBy('id','asc')->get();
        $previousMonth1 = 0;
        $previousBalance = 0;
        // $n1=Ledger::where('user_id',$user_id)->where('date','<',$range[1])->where('identifire','!=',109)->where('identifire','!=',120)->where('type',1)->sum('amount');
        // $n2=Ledger::where('user_id',$user_id)->where('date','<',$range[1])->where('identifire','!=',109)->where('identifire','!=',120)->where('type',2)->sum('amount');
        // $n1 = Ledger::where('user_id', $user_id)->where('date', '<', $range[1])->where('type', 1)->sum('amount');
        // $n2 = Ledger::where('user_id', $user_id)->where('date', '<', $range[1])->where('type', 2)->sum('amount');

        // $n3 = Ledger::where('user_id', $user_id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->where('identifire', '120')->get();
        // $prev = $n2 - $n1;
        // foreach ($n3 as  $value) {
        //     if ($value->type == 1) {
        //         $prev -= $value->amount;
        //     } else {
        //         $prev += $value->amount;
        //     }
        // }

        $prev_query = " select (
            (select sum(amount) from ledgers where user_id={$user_id} and type=2 and date<{$range[1]} )
            +(select ifnull(sum(amount),0) from ledgers where user_id={$user_id} and type=2 and date>={$range[1]} and date<={$range[2]} and identifire=120 )
             -(select sum(amount) from ledgers where user_id={$user_id} and type=1 and date<{$range[1]} )
            -(select ifnull(sum(amount),0) from ledgers where user_id={$user_id} and type=1 and date>={$range[1]} and date<={$range[2]} and identifire=120 )
        )  as sum";
        $prev = DB::selectOne($prev_query)->sum;
        // dd($prev1,$prev);

        if ($prev < 0) {
            $previousMonth1 = -1 * $prev;
        } else {
            $previousBalance = $prev;
        }

        // $previousBalance = Ledger::where('user_id', $user_id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->where('identifire', '120')->where('type', 2)->sum('amount');
        $adjustment = Ledger::where('user_id', $user_id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->where('identifire', '500')->sum('amount');
        $farmer1->advance = (float)(Advance::where('user_id', $user_id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->sum('amount'));
        $farmer1->prevdue = (float)$previousMonth + (float)$previousMonth1;
        $farmer1->prevbalance = (float)$previousBalance - $adjustment;
        $farmer1->paidamount = (float)Ledger::where('user_id', $user_id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->where('identifire', '121')->where('type', 1)->sum('amount');
        $balance = $farmer1->grandtotal + $farmer1->balance - $farmer1->prevdue - $farmer1->advance - $farmer1->due - $farmer1->paidamount + $farmer1->prevbalance - $farmer1->bonus + $farmer1->fpaid;
        $farmer1->balance = 0;
        $farmer1->nettotal = 0;
        if ($balance < 0) {
            $farmer1->balance = (-1) * $balance;
        }
        if ($balance > 0) {
            $farmer1->nettotal = $balance;
        }

        if ($needledger) {

            $farmer1->ledger = Ledger::where('user_id', $user_id)->where('date', '>=', $range[1])->where('date', '<=', $range[2])->orderBy('id', 'asc')->get();
        } else {
            $farmer1->ledger = [];
        }

        file_put_contents(public_path('test.json'), $farmer1->no);
        return $farmer1;
    }
}
