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
                        <form action="{{ route('task.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="project_id">Project <span class="text-danger">*</span></label>
                                <select class="form-control" name="project_id" id="project_id" required>
                                    <option value="">Choose Project</option>
                                    @foreach($projects as $project)
                                        <option {{ $task->project_id === $project->id ? 'selected' : '' }}
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
                                       name="name" value="{{ $task->name }}" required>

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
                                    <option value="highest" {{ $task->priority === "highest" ? 'selected' : '' }}>
                                        Highest
                                    </option>
                                    <option value="high" {{ $task->priority === "high" ? 'selected' : '' }}>
                                        High
                                    </option>
                                    <option value="medium" {{ $task->priority === "medium" ? 'selected' : '' }}>
                                        Medium
                                    </option>
                                    <option value="low" {{ $task->priority === "low" ? 'selected' : '' }}>
                                        Low
                                    </option>
                                    <option value="lowest" {{ $task->priority === "lowest" ? 'selected' : '' }}>
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
