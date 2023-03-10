<style>
    .d-print-show{
        display:none !important;
    }

</style>
<div class="row">
    {{-- <div class="col-md-12 mt-3">
        <div style="border: 1px solid rgb(136, 126, 126); padding:1rem;">
            <strong>Sold Items</strong>
            <hr>
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tr>
                    <th>Date</th>
                    <th>Rate</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Due</th>
                </tr>
                   @php
                       $total = 0;
                       $paid = 0;
                       $due = 0;
                   @endphp
                   @foreach ($sell as $item)
                   <tr>
                       <td>{{ _nepalidate($item->date)}}</td>
                       <td>{{ $item->rate }}</td>
                       <td>{{ $item->qty }}</td>
                       <td>{{ $item->total }}</td>
                       <td>{{ $item->paid }}</td>
                       <td>{{ $item->deu }}</td>
                   </tr>
                       @php
                           $total += $item->total;
                           $paid += $item->paid;
                           $due += $item->deu;
                       @endphp
                   @endforeach
                    <tr>
                        <td colspan="5" class="text-right">Grand Total</td>
                        <td>{{ $total }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">Total Paid</td>
                        <td> {{ $paid }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">Total Due</td>
                        <td>{{ $due }}</td>
                    </tr>
            </table>
        </div>
    </div> --}}

    <div class="col-md-12 mt-3">
        <div style="border: 1px solid rgb(136, 126, 126); padding:1rem;">
            <strong>Ledger</strong> <span class="btn btn-success" onclick="printDiv('ledger');">Print</span>
            <hr>

            <div id="ledger">
                <div class="d-print-show">
                    <style>
                        @media print {
                            td{
                                font-size: 1.2rem !important;
                                font-weight: 600 !important;
                            }


                            th:last-child, td:last-child {
                                display: none;
                            }

                        }
                        td,th{
                            border:1px solid black !important;
                            padding:2px !important;
                            font-weight: 600 !important;
                        }

                        table{
                            width:100%;
                            border-collapse: collapse;
                        }
                        thead {display: table-header-group;}
                        tfoot {display: table-header-group;}
                        .d-show-rate{

                            @if(env('showdisrate',0)==1)
                                display:inline;
                            @else
                                display:none !important;
                            @endif
                        }
                    </style>
                    <h2 style="text-align: center;margin-bottom:0px;font-weight:800;font-size:2rem;">
                        {{env('APP_NAME','Dairy')}} <br>

                    </h2>

                    <div style="font-weight:800;text-align:center;">
                        <span class="mx-3">  Ledger For : {{$user->name}} , </span>
                        {!!$title!!}
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >
                    <tr>
                        <th>Date</th>
                        <th>Particular</th>
                        <th>Cr. (Rs.)</th>
                        <th>Dr. (Rs.)</th>
                        <th>Balance (Rs.)</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>
                            --
                        </td>
                        <td>
                            Previous Balance
                        </td>
                        @if ($prev>0)

                        <td>

                        </td>
                        <td>
                         {{$prev}}
                        </td>
                            <td>
                                Dr.{{$prev}}
                            </td>
                            @elseif ($prev<0)
                            <td>
                                {{-1*$prev}}
                               </td>
                            <td>

                            </td>
                               <td>
                                   Cr.{{-1*$prev}}
                               </td>
                               @else
                               <td>
                                --
                               </td>
                               <td>
                                  --
                               </td>
                               <td>
                                   --
                               </td>
                        @endif
                        <td></td>
                    </tr>
                    @foreach ($arr as $l)
                        <tr>
                            <td>{{ _nepalidate($l->date) }}</td>
                            <td>{!! $l->title !!}</td>

                            <td>
                                @if ($l->type==1)
                                    {{ (float)$l->amount }}
                                @endif
                            </td>
                            <td>
                                @if($l->type==2)
                                {{ (float)$l->amount }}
                                @endif
                            </td>
                            <td>
                                @if ($l->amt>0)

                                    Dr. {{(float)$l->amt}}
                                @elseif ($l->amt<0)
                                    Cr. {{(float)(-1*$l->amt)}}
                                @else
                                    --
                                @endif


                                {{($l->cr==0 || $l->cr==null) && ($l->dr==0 || $l->dr==null)?"--":""}}
                            </td>
                            <td class="d-print-none">
                                @if ( $l->identifire==119)
                                    <button onclick="initLedgerChange(this);"  data-ledger="{{$l->toJson()}}">Edit</button>
                                @elseif($l->identifire==105)
                                    @if ($l->getForeign()!=null)
                                        <button onclick="sellLedgerChange(this);" data-foreign="{{$l->getForeign()->toJson()}}"  data-ledger="{{$l->toJson()}}">Edit</button>
                                    @endif
                                @elseif($l->identifire==114)
                                    @if($l->getForeign()!=null)
                                        <button onclick="payLedgerChange(this);" data-foreign="{{$l->getForeign()->toJson()}}"  data-ledger="{{$l->toJson()}}">Edit</button>
                                    @endif
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    {{-- <tr>
                        <td>
                            --
                        </td>
                        <td>
                            Closing Balance
                        </td>
                        @if ($closing<0)

                        <td>

                        </td>
                        <td>
                         {{-1*$closing}}
                        </td>

                            @elseif ($closing>0)
                            <td>
                                {{$closing}}
                               </td>
                            <td>

                            </td>

                               @else
                               <td>
                                --
                               </td>
                               <td>
                                  --
                               </td>
                               @endif
                               <td>
                                   --
                               </td>
                        <td></td>
                    </tr> --}}
                    {{-- @foreach ($ledgers as $l)
                        <tr data-id="ledger{{$l->id}}">
                            <td>{{ _nepalidate($l->date) }}</td>
                            <td>{!! $l->title !!}</td>

                            <td>
                                @if ($l->type==1)
                                    {{ rupee((float)$l->amount) }}
                                @endif
                            </td>
                            <td>
                                @if($l->type==2)
                                {{ rupee((float)$l->amount) }}
                                @endif
                            </td>
                            <td>
                                {{ (($l->dr == null)|| ($l->dr<=0))?"":"Dr. ".rupee((float)$l->dr) }}
                                {{(($l->cr == null)|| ($l->cr<=0))?"":"Cr. ".rupee((float)$l->cr )}}
                            </td>
                            <td>
                                @if ( $l->identifire==119)
                                    <button onclick="initLedgerChange(this);"  data-ledger="{{$l->toJson()}}">Edit</button>
                                @elseif($l->identifire==105)
                                    @if ($l->getForeign()!=null)
                                        <button onclick="sellLedgerChange(this);" data-foreign="{{$l->getForeign()->toJson()}}"  data-ledger="{{$l->toJson()}}">Edit</button>
                                    @endif
                                @elseif($l->identifire==114)
                                    @if($l->getForeign()!=null)
                                        <button onclick="payLedgerChange(this);" data-foreign="{{$l->getForeign()->toJson()}}"  data-ledger="{{$l->toJson()}}">Edit</button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach --}}
                </table>
            </div>
        </div>
    </div>
</div>

