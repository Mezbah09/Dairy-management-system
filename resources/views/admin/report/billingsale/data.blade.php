
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#data-1" role="tab" aria-controls="home" aria-selected="true">Bills Wise</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#data-2" role="tab" aria-controls="profile" aria-selected="false">Item Wise</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="data-1" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>S.n</th>
                    <th>Date</th>
                    <th>Particular</th>
                    <th>Gross Total</th>
                    <th>Discount</th>
                    <th>Net Total</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($bill as $k=>$b)
                <tr>
                    <td>{{ $k+1 }}</td>
                    <td>{{ _nepalidate($b->date) }}</td>
                    <td>{{ $b->name }}</td>
                    <td>{{ $b->grandtotal }}</td>
                    <td>{{ $b->dis }}</td>
                    <td>{{ $b->net_total }}</td>
                </tr>

                @endforeach
                <tr>

                    <td colspan="3" class="text-right">Total</td>
                    <td>
                        {{$bill->sum('grandtotal')}}
                    </td>
                    <td>
                        {{$bill->sum('dis')}}
                    </td>
                    <td>
                        {{$bill->sum('net_total')}}
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="tab-pane fade" id="data-2" role="data-2" aria-labelledby="profile-tab">
        <table class="table table-bordered mt-2">
            <thead>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $tot=0;
                @endphp
                @foreach ($billitems as $item)

                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['qty'] }}</td>
                            <td>{{ $item['rate'] }}</td>
                            <td>{{ $item['total'] }}</td>
                            @php
                                $tot+=$item['total'];
                            @endphp
                        </tr>

                @endforeach
            </tbody>
        </table>

    </div>


  </div>

