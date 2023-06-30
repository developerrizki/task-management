<form action="{{ route('task.index') }}" method="GET" class="form-horizontal">
    @csrf
    <div class="row">
        <div class="col-md-9">
            <select name="project" id="project" class="form-control" required>
                <option value="">Choose project</option>
                @foreach($projects as $project)
                    <option {{ Request::get('project') == $project->id ? 'selected' : '' }} value="{{ $project->id }}">
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary d-print-block">{{ __('Search') }}</button>
            <a href="{{ route('task.index') }}" class="btn btn-secondary">
                {{ __('Reset Filter') }}
            </a>
        </div>
    </div>
</form>
