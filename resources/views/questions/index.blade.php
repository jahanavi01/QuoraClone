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
    padding: 18px;
    margin-bottom: 20px;
    border-radius: 12px;
    border: 1px solid #1f1f1f;
}

.title {
    color: #ff4d4d;
    text-decoration: none;
    margin-bottom: 12px;
    font-weight: bold;
    margin:15px;
    font-size: 18px;
}
.title:hover{
    text-decoration: underline;
}
.replies{
    color:grey;
    text-decoration: none;
    font-weight: bold;
    margin:15px;
    margin-top: 20px;
}
.replies:hover{
    text-decoration: underline;
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

.actions a.btn {
    line-height: 1;
}

/* ===== Follow Button ===== */
.follow-btn.following {
    background: #333;
    color: #0f0;
}
</style>

@section('content')
<div class="container">

@foreach($questions as $question)
<div class="question-card" id="question-{{ $question->id }}">

    <!-- Question -->
    <a href="{{ route('questions.answers', $question->id) }}" class="title">{{ $question->title }}</h3>
    <br>

    <a href="{{ route('questions.answers', $question->id) }}" class="replies">
           · {{ $question->answers->count() }} replies
</a>


    <!-- Actions -->
    <div class="actions">

        {{-- ANSWER --}}
        <a href="{{ route('answers.create', $question->id) }}" class="btn">
            💬 Answer
        </a>

        {{-- FOLLOW QUESTION --}}
        @php
            $isFollowing = $question->followers()
                ->where('user_id', auth()->id())
                ->exists();
        @endphp

        <form method="POST" action="{{ route('questions.follow', $question->id) }}">
            @csrf
            <input type="hidden" name="anchor" value="question-{{ $question->id }}">
            <button class="btn follow-btn {{ $isFollowing ? 'following' : '' }}">
                {{ $isFollowing ? 'Following' : 'Follow' }}
                ({{ $question->followers()->count() }})
            </button>
        </form>

        {{-- UPVOTE --}}
        <form method="POST" action="{{ route('questions.vote', $question->id) }}">
            @csrf
            <input type="hidden" name="direction" value="1">
            <input type="hidden" name="anchor" value="question-{{ $question->id }}">
            <button class="btn">
                ⬆ {{ $question->votes()->where('direction', 1)->count() }}
            </button>
        </form>

        {{-- DOWNVOTE --}}
        <form method="POST" action="{{ route('questions.vote', $question->id) }}">
            @csrf
            <input type="hidden" name="direction" value="-1">
            <input type="hidden" name="anchor" value="question-{{ $question->id }}">
            <button class="btn">
                ⬇ {{ $question->votes()->where('direction', -1)->count() }}
            </button>
        </form>

    </div>

</div>
@endforeach

</div>
@endsection
</body>
</html>
