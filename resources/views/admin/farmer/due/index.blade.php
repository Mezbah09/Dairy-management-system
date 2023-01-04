@extends('admin.layouts.app')
@section('title','Farmer-Dues')
@section('css')
<link rel="stylesheet" href="{{ asset('calender/nepali.datepicker.v3.2.min.css') }}" />
@endsection
@section('head-title','Farmer Dues')
@section('toobar')
@endsection
@section('content')
<div class="row">
    <div class="col-md-3">
        <div id="_farmers">
            Select Collection center for load farmers !
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <select name="center_id" id="center_id" class="form-control show-tick ms next" data-next="session">
                        <option></option>
                        @foreach(\App\Models\Center::all() as $c)
                        <option value="{{$c->id}}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                    <small>Center Collection</small>
                </div>
            </div>
            <div class="col-md-6">
                <input type="text" id="u_no" class="form-control checkfarmer" placeholder="Enter farmer no.">
            </div>
            <div class="col-md-2">
                <span class="btn btn-primary" onclick="loadData()"> Load </span>
            </div>
            <div class="col-md-12">
                <div id="allData">

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{ asset('calender/nepali.datepicker.v3.2.min.js') }}"></script>
<script>
    function farmerId(id){
        $('#u_no').val(id);
    }

    function loadData(){
        var user_no = $('#u_no').val();
        var center_id = $('#center_id').val();
        axios({
                method: 'post',
                url: '{{ route("admin.farmer.due.load") }}',
                data: {'no':user_no,'center_id':center_id}
        })
        .then(function(response) {
            $('#allData').html(response.data);
            var mainInput = document.getElementById("nepali-datepicker");
                mainInput.nepaliDatePicker();
                var month = ('0'+ NepaliFunctions.GetCurrentBsDate().month).slice(-2);
                var day = ('0' + NepaliFunctions.GetCurrentBsDate().day).slice(-2);
                $('#nepali-datepicker').val(NepaliFunctions.GetCurrentBsYear() + '-' + month + '-' + day);
        })
        .catch(function(response) {
            //handle error
            // showNotification('bg-danger', 'Please enter farmer number!');
            console.log(response);
        });
    }

    window.onload = function(){
      loadData();
    }

    // load farmer data by center id
    $('#center_id').change(function(){
        var center_id = $('#center_id').val();
        axios({
            method: 'post',
            url: '{{ route("load.farmer.data")}}',
            data:{'center':center_id}
        })
        .then(function(response) {
            $('#_farmers').html(response.data);
            initTableSearch('sid', 'farmerData', ['name']);
        })
        .catch(function(response) {
            //handle error
            console.log(response);
        });
    })

// due payment
    function duePayment(){
        if( $('#p_amt').val() == 0 || $('#p_detail').val() == ''){
            alert('please enter valid data!');
            return false;
        }else{
            var date = $('#nepali-datepicker').val();
            var amt = $('#p_amt').val();
            var detail = $('#p_detail').val();
            var user_no = $('#u_no').val();
            var center_id = $('#center_id').val();
            var data = {
                'date':date,
                'pay':amt,
                'detail':detail,
                'no':user_no,
                'center_id':center_id
            }

            axios({
                    method: 'post',
                    url: '{{ route("admin.farmer.pay.save") }}',
                    data: data
            })
            .then(function(response) {
                showNotification('bg-success', 'Payment has been successed!');
                $('#p_amt').val(0);
                loadData();
            })
            .catch(function(response) {
                //handle error
                // showNotification('bg-danger', 'Please enter farmer number!');
                console.log(response);
            });
        }

    }


</script>
@endsection
