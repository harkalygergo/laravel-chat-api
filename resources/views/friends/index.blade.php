<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat API Login/Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4">Chat API Login / Register</h2>

    <div class="container">
        <h2>Other Verified Users</h2>
        <ul id="users-list">
            @foreach ($users as $user)
                <li>
                    {{ $user->name }} ({{ $user->email }})
                    <button onclick="addFriend({{ $user->id }})">Add as friend</button>
                </li>
            @endforeach
        </ul>
        {{ $users->links() }}
    </div>

    <!-- loop through friends -->
    <div class="container mt-5">
        <h2>Your Friends</h2>
        <ul id="friends-list">
            @foreach ($friends as $friend)
                <li>{{ $friend->name }} ({{ $friend->email }})</li>
            @endforeach
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
                .then(data => alert(data.message))
                .catch(() => alert('Error adding friend'));
        }
    </script>

</div>
</body>
</html>
