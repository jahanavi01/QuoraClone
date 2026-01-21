@extends('includes.header')

<style>
/* ===== Layout ===== */
.container {
    max-width: 720px;
    margin: 20px auto;
    padding: 0 10px;
}

/* ===== Question Card ===== */
.question-card {
    background: #111;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #1f1f1f;
    margin-bottom: 25px;
}

.question-card h3 {
    color: #ff4d4d;
    margin-bottom: 10px;
}

.question-card p {
    color: #ccc;
    line-height: 1.6;
}

/* ===== Answer Card ===== */
.answer-card {
    background: #0d0d0d;
    padding: 16px;
    border-radius: 10px;
    border: 1px solid #1f1f1f;
    margin-bottom: 15px;
}

/* ===== Answer Header ===== */
.answer-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 8px;
}

.answer-user {
    display: flex;
    align-items: center;
}

.answer-user img {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    margin-right: 10px;
}

.answer-user .name {
    color: rgb(245, 246, 245);
    font-weight: 600;
}

.answer-user .time {
    color: #777;
    font-size: 13px;
    margin-left: 6px;
}

/* ===== Answer Body ===== */
.answer-body {
    color: #ddd;
    line-height: 1.6;
    margin-bottom: 10px;
}

/* ===== Actions ===== */
.actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.actions form {
    margin: 0;
}

.following {
    background: #333;
    color: #0f0;
}

/* ===== Empty ===== */
.no-answers {
    text-align: center;
    color: #777;
    margin-top: 30px;
}
</style>

@section('content')
<div class="container">

    <!-- Question -->
    <div class="question-card">
        <h3>{{ $question->title }}</h3>
    

    <!-- Answers -->
    @forelse($question->answers as $answer)
    <div class="answer-card" id="answer-{{ $answer->id }}">

        <!-- Header -->
        <div class="answer-header">

            <div class="answer-user">
                <img src="{{ asset('images/default-user.png') }}">
                <div>
                    <span class="name">{{ $answer->user->name }}</span>
                    <span class="time">· {{ $answer->created_at->diffForHumans() }}</span>
                </div>
            </div>

            {{-- FOLLOW USER --}}
            @php
                $isFollowing = auth()->user()->isFollowing($answer->user);
            @endphp

            @if(auth()->id() !== $answer->user_id)
            <form method="POST" action="{{ route('follow.toggle', ['user', $answer->user_id]) }}">
                @csrf
                <input type="hidden" name="anchor" value="answer-{{ $answer->id }}">
                <button class="btn {{ $isFollowing ? 'following' : '' }}">
                    {{ $isFollowing ? 'Following' : 'Follow' }}
                </button>
            </form>
            @endif

        </div>

        <!-- Body -->
        <div class="answer-body">
            {{ $answer->body }}
        </div>

        <!-- Actions -->
        <div class="actions">

            {{-- UPVOTE --}}
            <form method="POST" action="{{ route('answers.vote', $answer->id) }}">
                @csrf
                <input type="hidden" name="direction" value="1">
                <input type="hidden" name="anchor" value="answer-{{ $answer->id }}">
                <button class="btn">
                    ⬆ {{ $answer->votes()->where('direction', 1)->count() }}
                </button>
            </form>

            {{-- DOWNVOTE --}}
            <form method="POST" action="{{ route('answers.vote', $answer->id) }}">
                @csrf
                <input type="hidden" name="direction" value="-1">
                <input type="hidden" name="anchor" value="answer-{{ $answer->id }}">
                <button class="btn">
                    ⬇ {{ $answer->votes()->where('direction', -1)->count() }}
                </button>
            </form>

        </div>

    </div>
    @empty
        <p class="no-answers">No answers yet.</p>
    @endforelse

</div>
@endsection
</div>
</body>
</html>
