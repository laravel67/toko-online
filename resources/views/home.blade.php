@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @livewire('counter')
                </div>
            </div>
        </div>
    </div>
@endsection