@extends('admin.layouts.app')
@section('title','MilK Payment')
@section('css')
<link rel="stylesheet" href="{{ asset('calender/nepali.datepicker.v3.2.min.css') }}" />
<style>
    .amount{
        border:none;
        outline: none;
    }

    .amount:hover,.amount:active,.amount:focus{
        border:1px solid #f1f1f1;
    }
    td, th{
        border:1px solid #f1f1f1;
    }
</style>
@endsection
@section('head-title')
     Milk Payment

@endsection
@section('toobar')

@endsection
@section('content')
<div class="row">
    <div class="col-md-2">
        <label for="date">Date</label>
        <input type="date"  id="currentdate" class="form-control" >
    </div>
    <div class="col-md-10"></div>
    <div class="col-md-2">
        <label for="date">Year</label>
        <input type="number" minlength="4" maxlength="4" name="year" id="year" class="form-control" />
    </div>
    <div class="col-md-2">
        <label for="date">Month</label>
        <select name="month" id="month" class="form-control show-tick ms select2">
        </select>
    </div>
    <div class="col-md-2">
        <label for="date">Session</label>
        <select name="session" id="session" class="form-control show-tick ms select2">
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="date">Collection Center</label>
            <select name="center_id" id="center_id" class="form-control show-tick ms next" data-next="session">
                <option></option>
                @foreach(\App\Models\Center::all() as $c)
                <option value="{{$c->id}}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-3 pt-4">
        <span class="btn btn-primary" id="loadData" onclick="loadData()"> Load Data</span>
        <span class="btn btn-danger d-none" id="resetData" onclick="resetData()"> Reset Data</span>
        <span class="btn btn-success" onclick="printDiv('allData');"> Print</span>
    </div>
</div>
<div class="row ">
    <div class="col-md-3" id="_farmers">

    </div>
    <div class="col-md-9 d-none" id="dataField">
        <div class="row">
            <div class="col-md-4">
                <input type="number" id="no" placeholder="Farmer No" class="form-control next checkfarmer"  data-next="amount">
            </div>
            <div class="col-md-4">
                <input type="number" id="amount" placeholder="Payment Amount" class="form-control" min="1">
            </div>
            <div class="col-md-4 ">
                <button class="btn btn-success" onclick="saveDate();">Save</button>
            </div>
            <div class="col-md-12 pt-4">
                <div class="shadow py-4 px-2">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>no</th>
                                <th>name</th>
                                <th>amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="allData">

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{ asset('backend/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('calender/nepali.datepicker.v3.2.min.js') }}"></script>
<script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>

<script>

    loaded=false;
    function Toogle(){
        if(loaded){
            loaded=false;
            $('#loadData').removeClass('d-none');
            $('#resetData').addClass('d-none');
            $('#dataField').addClass('d-none');
            $('.show-tick').css('pointer-events','auto');
        }else{
            loaded=true;
            $('#loadData').addClass('d-none');
            $('#resetData').removeClass('d-none');
            $('#dataField').removeClass('d-none');
            $('.show-tick').css('pointer-events','none');
        }
    }

    function resetData(){
        $('#allData').html('');
        Toogle();
    }
    var month = Array.from(AppDateFunction.GetBsMonths());
    var i =1;
    month.forEach(element => {
        $('#month').append('<option value="'+i+'">'+element+'</option>');
        i++;
    });

    var start_y = 2070;
    var now_yr = AppDateFunction.GetCurrentBsYear();
    var now_yr1 = now_yr;
    for (let index = start_y; index < now_yr; index++) {
        $('#year').append('<option value="'+now_yr1+'">'+now_yr1+'</option>');
        now_yr1--;
    }

    function saveDate(){
        if(exists('#payment-'+$('#no').val())){
            alert('Milk Payment For Farmer no-'+$('#no').val()+" Exists.")
            var p_id=$('#payment-'+$('#no').val()).data('id')
            console.log(p_id);
            $('#amount-'+p_id).focus();
            $('#amount-'+p_id).select();
        }else{

            if($('#no').val()=="" || !CheckFarmer($('#no').val())){
                alert('Please Enter A Valid Farmer No');
                $('#no').focus();
                return ;
            }

            if($('#amount').val()=="" || $('#amount').val()<1){
                alert('Please Enter A Valid Amount');
                $('#amount').focus();
                return ;
            }
            var d={
                'year':$('#year').val(),
                'month':$('#month').val(),
                'session':$('#session').val(),
                'center_id':$('#center_id').val(),
                'no':$('#no').val(),
                'amount':$('#amount').val(),
                'date':$('#currentdate').val()
            };

            axios.post("{{route('milk.payment.add')}}",d)
            .then(function(response){
                $('#allData').prepend(response.data);
                // Toogle();
                $('#no').val('');
                $('#amount').val('');
                $('#no').focus();

            })
            .catch(function(error){
                alert('some error occured');
            });
        }
    }

    function loadData(){

        if($('#center_id').val()==""){
            alert('Please Select Collection ceter');
            return;
        }

        var d={
            'year':$('#year').val(),
            'month':$('#month').val(),
            'session':$('#session').val(),
            'center_id':$('#center_id').val(),
        };
        axios.post("{{route('milk.payment.home')}}",d)
        .then(function(response){
            $('#allData').html(response.data);
            Toogle();
        })
        .catch(function(error){
            alert('some error occured');
        });
    }

    window.onload = function() {

        var month = AppDateFunction.GetCurrentBsDate().month;
        var year = AppDateFunction.GetCurrentBsDate().year;
        var day =  AppDateFunction.GetCurrentBsDate().day;

        $('#year').val(year).change();
        $('#month').val(month).change();
        if(day>15){
            $('#session').val(2).change();
        }else{
            $('#session').val(1).change();
        }

        var month = ('0'+ AppDateFunction.GetCurrentBsDate().month).slice(-2);
        var day = ('0' + AppDateFunction.GetCurrentBsDate().day).slice(-2);

        // $('#currentdate').val(AppDateFunction.GetCurrentBsYear() + '-' + month + '-' + day);

        // var mainInput = document.getElementById("currentdate");
        // mainInput.nepaliDatePicker();
    };



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

    function updateData(id,value){
        console.log(id,value);
        axios.post("{{route('milk.payment.update')}}",{
            'id':id,
            'amount':value,
            'date':$('#currentdate').val()
        })
            .then(function(response){


            })
            .catch(function(error){
                if(error.response){
                    if(error.response.status==401){

                        alert(error.response.data);
                    }else{
                        alert('some error occured');

                    }
                }else{

                    alert('some error occured');
                }
            });
    }
    $('#amount').bind('keydown', 'return', function(e){
       saveDate();
    });

    function farmerId(no){
        $('#no').val(no);
    }
    function amountUpdate(id){
        ele=document.getElementById('amount-'+id);
        if( confirm('Do You Want To Update Data?')){
                updateData(ele.dataset.id,ele.value);
           }else{
                ele.value=ele.dataset.amount;
           }
    }
    function amountEnter(ele,event){
        var key = (event.keyCode ? event.keyCode : event.which);
        // console.log(key);
        if(key=='13'){
           if( confirm('Do You Want To Update Data?')){
                updateData(ele.dataset.id,ele.value);
           }else{
                ele.value=ele.dataset.amount;
           }
        }
    }


</script>
@endsection
