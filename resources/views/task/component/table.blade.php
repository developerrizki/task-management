<table class="table table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Project</th>
        <th>Task Name</th>
        <th>Priority</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($tasks as $key => $task)
        <tr>
            <td>{{ ($tasks->currentpage()-1) * $tasks->perpage() + $key + 1 }}</td>
            <td>{{ optional($task->project)->name }}</td>
            <td>{{ $task->name }}</td>
            <td>{{ Str::ucfirst($task->priority) }}</td>
            <td>{{ $task->created_at->format('d M Y H:i:s') }}</td>
            <td>{{ $task->updated_at->format('d M Y H:i:s') }}</td>
            <td>
                <div class="flex">
                    <div style="float: left">
                        <a href="{{ route('task.edit', $task->id) }}" class="btn btn-warning btn-sm text-white">
                            Edit
                        </a>
                    </div>
                    <div style="float: left; margin-left: 5px">
                        <form method="post" action="{{ route('task.destroy', $task->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm text-white"
                                    onclick="return confirm('Do you want to delete this data?')"> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            @if(Request::has('project') && count($tasks) === 0)
                <td colspan="7" class="text-center">Data not available.</td>
            @else
                <td colspan="7" class="text-center">Please choose project first.</td>
            @endif
        </tr>
    @endforelse
    </tbody>
</table>
{{ $tasks->links() }}
