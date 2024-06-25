@props(['users', 'loggedInUsername'])

<div class="w-1/4 px-4">
    <h2 class="section-title">LEADERBOARD</h2>
    @foreach ($users as $user)
        <div class="leaderboard-item {{ $loop->first ? 'leader' : ($loop->iteration == 2 ? 'runner-up' : '') }}">
            <span class="rank">
                @if($loop->first)
                    Leader
                @elseif($loop->iteration == 2)
                    Runner-up
                @else
                    {{ $loop->iteration . '.' }}
                @endif
            </span>
            <span class="username">
                @if ($user->username === $loggedInUsername)
                    {{ $user->username }} (You)
                @else
                    {{ $user->username }}
                @endif
            </span>
            @if($loop->first)
                <div class="stars">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="star"></div>
                    @endfor
                </div>
            @endif
        </div>
    @endforeach
</div>

<style>
    .section-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
        color: #f6e05e;
    }

    .leaderboard-item {
        margin-bottom: 1rem;
        padding: 1rem;
        background-color: #1f1f1f;
        border: 1px solid #666;
        border-radius: 0.5rem;
        transition: background-color 0.3s ease-in-out;
    }

    .leaderboard-item:hover {
        background-color: #333;
    }

    .rank {
        font-weight: bold;
        color: #f6e05e;
        margin-right: 0.5rem;
    }

    .username {
        color: #e2e8f0;
    }

    .stars {
        margin-top: 0.5rem;
    }

    .star {
        width: 1rem;
        height: 1rem;
        background-color: #f6e05e;
        border-radius: 50%;
        display: inline-block;
        margin-right: 0.25rem;
    }
</style>
