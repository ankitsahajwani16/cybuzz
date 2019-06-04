@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form id="attandance_add" method="post" action="{{ url('attandance') }}" >
                    @csrf
                    <button type="text" id="btn" class="btn btn-info">Mark Attandance</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
