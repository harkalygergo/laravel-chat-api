@extends('layouts.base')

@section('content')
<div class="py-4">
    <h2 class="mb-4">Send message</h2>

    <div class="row">
        <div class="col-12 col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header">Your connections</div>
                <ul class="list-group list-group-flush" id="friendsList">
                    @forelse(auth()->user()->friends as $friend)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $friend->name }}</span>
                            <button class="btn btn-sm btn-outline-primary" onclick="openChat({{ $friend->id }}, '{{ $friend->name }}')">Chat</button>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">No connections yet</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="col-12 col-md-8">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span id="chatWith">Select a friend to chat</span>
                </div>
                <div class="card-body d-flex flex-column" style="min-height: 400px;">
                    <div id="messages" class="flex-grow-1 overflow-auto border rounded p-3 bg-light"></div>
                    <form id="sendForm" class="mt-3" onsubmit="event.preventDefault(); sendMessage();" style="display:none;">
                        @csrf
                        <input type="hidden" id="recipientId" value="">
                        <div class="mb-2">
                            <textarea id="messageContent" class="form-control" rows="3" placeholder="Type your message..."></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openChat(userId, userName) {
            document.getElementById('recipientId').value = userId;
            document.getElementById('sendForm').style.display = '';
            document.getElementById('chatWith').innerText = 'Chat with ' + userName;
            const messagesEl = document.getElementById('messages');
            messagesEl.innerHTML = '<div class="text-muted">Loading...</div>';

            fetch('/messages/' + userId)
                .then(r => r.json())
                .then(data => {
                    messagesEl.innerHTML = '';
                    const items = data.data || [];
                    if (!items.length) {
                        messagesEl.innerHTML = '<div class="text-muted">No messages yet</div>';
                        return;
                    }
                    // API returns newest first; show newest at bottom
                    items.reverse().forEach(msg => {
                        const isMine = msg.sender_id === {{ auth()->id() ?? 'null' }};
                        const row = document.createElement('div');
                        row.className = 'd-flex mb-2';
                        row.innerHTML = `
                            <div class="${isMine ? 'ms-auto bg-primary text-white' : 'me-auto bg-white border'} rounded px-3 py-2" style="max-width: 80%;">
                                <div class="small ${isMine ? 'text-white-50' : 'text-muted'}">${isMine ? 'You' : userName}</div>
                                <div>${escapeHtml(msg.content)}</div>
                            </div>`;
                        messagesEl.appendChild(row);
                    });
                    messagesEl.scrollTop = messagesEl.scrollHeight;
                })
                .catch(() => {
                    messagesEl.innerHTML = '<div class="text-danger">Failed to load messages</div>';
                });
        }

        function sendMessage() {
            const userId = document.getElementById('recipientId').value;
            const content = document.getElementById('messageContent').value.trim();
            if (!content) return;

            fetch('/message/' + userId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ content })
            })
            .then(r => r.json())
            .then(() => {
                document.getElementById('messageContent').value = '';
                openChat(userId, document.getElementById('chatWith').innerText.replace('Chat with ', ''));
            })
            .catch(() => alert('Failed to send message'));
        }

        function escapeHtml(unsafe) {
            return unsafe
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }
    </script>
</div>
@endsection


