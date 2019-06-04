@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Report</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                        <form  method="post" action="{{ url('report') }}" >
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-4">
                                <h5>Start Date1 <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <input type="date" name="start_date" id="start_date" value ="{{$start}}" class="form-control datepicker-autoclose" placeholder="Please select start date"> <div class="help-block"></div></div>
                                </div>
                                <div class="form-group col-md-4">
                                <h5>End Date <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <input type="date" name="end_date" id="end_date" value ="{{$end}}" class="form-control datepicker-autoclose" placeholder="Please select end date"> <div class="help-block"></div></div>
                                </div>
                                <div class="text-left" style="margin-left: 15px;" class="form-group col-md-4">
                                    <h5>   <span class="text-danger"></span></h5>
                                <button type="submit" id="btnFiterSubmitSearch" class="btn btn-info">Filter</button>
                                </div>

                            </div>
                        </form>   
                    <table style="border: 1px solid black;">
                        <tr style="border: 1px solid black;">
                            <th style="border: 1px solid black;">User</th>
                            @foreach($attandance_dates as $attandance_date)
                            <th style="border: 1px solid black;">{{ \Carbon\Carbon::parse($attandance_date['date'])->format('d-m-Y')}}</th>
                            @endforeach
                        </tr>
                        @foreach($user_attandances as $user_attandance)
                            <tr>
                                <td style="border: 1px solid black;">{{$user_attandance['name']}}</td>
                                
                                @foreach($user_attandance['attandance'] as $attandance)
                                    <td  style="border: 1px solid black;">{{ \Carbon\Carbon::parse($attandance['created_at'])->format('h:i A')}}</td>
                                    <!--<th>{{--date('h:i A',strtotime($attandance['created_at'])--}}</th>-->
                                @endforeach
                            </tr>    
                        @endforeach
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
