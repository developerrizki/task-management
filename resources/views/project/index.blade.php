@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Project</li>
                    </ol>
                </nav>

                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <a href="{{ route('project.create') }}" class="btn btn-sm btn-primary mb-3">{{ __('Add New Project') }}</a>

                <div class="card">
                    <div class="card-header">{{ __('Data Project') }}</div>

                    <div class="card-body">

                        <div class="table-responsive">
                            @include('project.component.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
