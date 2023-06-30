<table class="table table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Created At</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($projects as $key => $project)
        <tr>
            <td>{{ ($projects->currentpage()-1) * $projects->perpage() + $key + 1 }}</td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->created_at->format('d M Y H:i:s') }}</td>
            <td>
                <div class="flex">
                    <div style="float: left">
                        <a href="{{ route('project.edit', $project->id) }}" class="btn btn-warning btn-sm text-white">
                            Edit
                        </a>
                    </div>
                    <div style="float: left; margin-left: 5px">
                        <form method="post" action="{{ route('project.destroy', $project->id) }}">
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
            <td colspan="4" class="text-center">Data not available.</td>
        </tr>
    @endforelse
    </tbody>
</table>
{{ $projects->links() }}
