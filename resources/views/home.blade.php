@extends('layouts.base')

@section('content')
<div class="row g-4">
    <div class="col-12 col-md-6">
        <div class="card h-100">
            <div class="card-header fw-semibold">New registered users</div>
            <ul class="list-group list-group-flush">
                @forelse($newUsers as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $user->name }}</span>
                        <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No data</li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="card h-100">
            <div class="card-header fw-semibold">Active (validated) users</div>
            <ul class="list-group list-group-flush">
                @forelse($activeUsers as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $user->name }}</span>
                        <small class="text-muted">{{ optional($user->email_verified_at)->diffForHumans() }}</small>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No data</li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="card h-100">
            <div class="card-header fw-semibold">Friendships (connections)</div>
            <ul class="list-group list-group-flush">
                @forelse($latestFriendships as $fr)
                    @php
                        $u1 = \App\Models\User::find($fr->user_id);
                        $u2 = \App\Models\User::find($fr->friend_id);
                    @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ optional($u1)->name }} ↔ {{ optional($u2)->name }}</span>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($fr->created_at)->diffForHumans() }}</small>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No data</li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="card h-100">
            <div class="card-header fw-semibold">Last chat messages</div>
            <ul class="list-group list-group-flush">
                @forelse($latestMessages as $msg)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="fw-semibold">{{ $msg->sender->name }}</span>
                                <span class="text-muted">→</span>
                                <span class="fw-semibold">{{ $msg->receiver->name }}</span>
                            </div>
                            <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="mt-1 text-break">{{ $msg->content }}</div>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No data</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection


