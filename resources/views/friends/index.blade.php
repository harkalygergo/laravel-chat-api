@extends('layouts.base')

@section('content')
<div class="py-4">
    <h2 class="mb-4">Search friends</h2>

    <div class="card mb-4">
        <div class="card-header">Other verified users</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-end">
                                    <form onsubmit="event.preventDefault(); addFriend({{ $user->id }});" class="d-inline">
                                        <button type="submit" class="btn btn-sm btn-primary">Add as friend</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-muted">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">{{ $users->links() }}</div>
    </div>

    <div class="card">
        <div class="card-header">Your friends</div>
        <ul class="list-group list-group-flush">
            @forelse ($friends as $friend)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $friend->name }} <small class="text-muted">({{ $friend->email }})</small></span>
                </li>
            @empty
                <li class="list-group-item text-muted">You have no friends yet</li>
            @endforelse
        </ul>
    </div>

    <script>
        function addFriend(userId) {
            fetch('/friends/add/' + userId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => { alert(data.message); window.location.reload(); })
            .catch(() => alert('Error adding friend'));
        }
    </script>
</div>
@endsection
