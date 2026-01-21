@extends('includes.header')

<style>
.container {
    max-width: 900px;
    margin: 20px auto;
    padding: 0 15px;
}

/* ===== Profile Card ===== */
.profile-card {
    background: #111;
    padding: 20px;
    border-radius: 16px;
    border: 1px solid #1f1f1f;
    margin-bottom: 25px;
}

.profile-row {
    display: flex;
    align-items: center;
    gap: 15px;
}

.profile-pic {
    width: 70px;
    height: 70px;
    border-radius: 50%;
}

.profile-name {
    font-size: 22px;
    font-weight: bold;
    color: #ff4d4d;
}

/* ===== Question Card ===== */
.question-card {
    background: radial-gradient(circle at top, #111, #0b0b0b);
    padding: 16px;
    border-radius: 16px;
    border: 1px solid #1f1f1f;
    margin-bottom: 20px;
}

.title {
    color: #ff4d4d;
    font-weight: bold;
    font-size: 18px;
    text-decoration: none;
}

.title:hover {
    text-decoration: underline;
}

/* ===== Answer Card ===== */
.answer-card {
    background: #0d0d0d;
    border-left: 3px solid #ff2d2d;
    padding: 12px;
    margin-top: 12px;
    border-radius: 8px;
}

/* ===== Answer Header ===== */
.answer-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 6px;
}

.answer-header img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
}

.answer-name {
    font-weight: 600;
    font-size: 14px;
}

.answer-time {
    font-size: 12px;
    color: #777;
}

/* ===== Actions ===== */
.actions {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.actions form {
    margin: 0;
}

/* ===== Buttons ===== */
.btn,
.pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    border-radius: 999px;
    background: #1a1a1a;
    color: #ddd;
    border: none;
    font-size: 13px;
    cursor: pointer;
    text-decoration: none;
}

.btn:hover,
.pill:hover {
    background: #ff2d2d;
    color: #fff;
}

.following {
    background: #222;
    color: #00ff7f;
}
</style>

@section('content')
<div class="container">

{{-- ================= PROFILE ================= --}}
<div class="profile-card">
    <div class="profile-row">
        <img src="{{ asset('images/default-user.png') }}" class="profile-pic">

        <div class="profile-name">{{ $user->name }}</div>

        {{-- FOLLOW BUTTON --}}
        @if($authUser->id !== $user->id)
        <form method="POST"
              action="{{ route('follow.toggle', ['user', $user->id]) }}"
              style="margin-left:auto;">
            @csrf
            <button class="pill {{ $isFollowing ? 'following' : '' }}">
                {{ $isFollowing ? 'Following' : 'Follow' }}
            </button>
        </form>
        @endif
    </div>
</div>

{{-- ================= QUESTIONS WITH ANSWERS ================= --}}
@forelse($questions as $question)
<div class="question-card">

    {{-- QUESTION TITLE --}}
    <a href="{{ route('questions.answers', $question->id) }}" class="title">
        {{ $question->title }}
    </a>

   

    {{-- ANSWERS --}}
    @forelse($question->answers as $answer)
        <div class="answer-card" id="answer-{{ $answer->id }}">

            <div class="answer-header">
                <img src="{{ asset('images/default-user.png') }}">
                <div>
                    <div class="answer-name">{{ $answer->user->name }}</div>
                    <div class="answer-time">
                        {{ $answer->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>

            <div class="answer-body">
                {{ $answer->body }}
            </div>

            {{-- ANSWER ACTIONS --}}
            <div class="actions">

                {{-- UPVOTE --}}
                <form method="POST" action="{{ route('answers.vote', $answer->id) }}">
                    @csrf
                    <input type="hidden" name="direction" value="1">
                    <button class="btn">
                        ⬆ {{ $answer->votes()->where('direction', 1)->count() }}
                    </button>
                </form>

                {{-- DOWNVOTE --}}
                <form method="POST" action="{{ route('answers.vote', $answer->id) }}">
                    @csrf
                    <input type="hidden" name="direction" value="-1">
                    <button class="btn">
                        ⬇ {{ $answer->votes()->where('direction', -1)->count() }}
                    </button>
                </form>

            </div>

        </div>
    @empty
        <p style="color:#777; margin-top:10px;">No answers yet.</p>
    @endforelse
 {{-- ANSWER BUTTON --}}
    <div class="actions">
        <a href="{{ route('answers.create', $question->id) }}" class="btn">
            💬 Answer
        </a>
    </div>
</div>
@empty
<p style="color:#777;">No questions asked yet.</p>
@endforelse

</div>
@endsection

</body>
</html>
