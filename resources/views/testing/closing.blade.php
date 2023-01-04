@extends('admin.layouts.app')
@section('content')
<form action="{{ route('test.box')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="date">Collection Center</label>
        <select name="center_id" id="center_id" class="form-control show-tick ms next">
            <option></option>
            @foreach(\App\Models\Center::all() as $c)
            <option value="{{$c->id}}" @if ($center_name != null)
                {{ $center_name->id == $c->id?'selected':''}}
            @endif >{{ $c->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button class="btn btn-primary">Load</button>
    </div>
</form>
<br>
<br>
<table class="table">
    <tr>
        <th>Name</th>
        <th>Prev</th>
        <th>Net Total</th>
        <th>Balance</th>
    </tr>
    @foreach ($data as $item)
    @php
        $red = false;
        if($item['prev']<0){
           if($item['balance'] !=(-1* $item['prev'])){
               $red = true;
           }
        }else{
            if($item['nettotal'] != $item['prev']){
               $red = true;
           }
        }
    @endphp
        <tr style="{{$red?"background:red;color:white;":""}}">
            <td>
                {{$item['name']}}
            </td>
            <td>
                {{$item['prev']}}
            </td>
            <td>
                {{$item['nettotal']}}
            </td>
            <td>
                {{$item['balance']}}
            </td>
        </tr>
    @endforeach
</table>
@endsection
