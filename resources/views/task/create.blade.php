@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('task.index') }}">{{ __('Task') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Create') }}</li>
                    </ol>
                </nav>

                <div class="card">
                    <div class="card-header">{{ __('Create Task') }}</div>
                    <div class="card-body">
                        <form action="{{ route('task.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="project_id">Project <span class="text-danger">*</span></label>
                                <select class="form-control" name="project_id" id="project_id" required>
                                    <option value="">Choose Project</option>
                                    @foreach($projects as $project)
                                        <option {{ old('project_id') === $project->id ? 'selected' : '' }}
                                                value="{{ $project->id }}">
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('project_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="priority">Priority <span class="text-danger">*</span></label>
                                <select class="form-control" name="priority" id="priority" required>
                                    <option value="">Choose Priority</option>
                                    <option value="highest" @if(old('priority') === "highest") selected @endif>
                                        Highest
                                    </option>
                                    <option value="high" @if(old('priority') === "high") selected @endif>
                                        High
                                    </option>
                                    <option value="medium" @if(old('priority') === "medium") selected @endif>
                                        Medium
                                    </option>
                                    <option value="low" @if(old('priority') === "low") selected @endif>
                                        Low
                                    </option>
                                    <option value="lowest" @if(old('priority') === "lowest") selected @endif>
                                        Lowest
                                    </option>
                                </select>

                                @error('priority')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                <a href="{{ route('task.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
