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

.question-card h3 {
    color: #ff4d4d;
    margin-bottom: 12px;
}


/* ===== Actions ===== */
.actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

/* Remove form spacing difference */
.actions form {
    margin: 0;
}

/* Ensure <a> behaves like <button> */
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
<div class="question-card">

    <!-- Question -->
    <h3>{{ $question->title }}</h3>

    <!-- Actions -->
    <div class="actions">

        {{-- ANSWER --}}
        <a href="{{ route('answers.create', $question->id) }}" class="btn">
            💬 Answer
        </a>

        {{-- FOLLOW --}}
        @php
            $isFollowing = $question->followers()
                ->where('user_id', auth()->id())
                ->exists();
        @endphp

        <form method="POST" action="{{ route('questions.follow', $question->id) }}">
            @csrf
            <button class="btn follow-btn {{ $isFollowing ? 'following' : '' }}">
                {{ $isFollowing ? 'Following' : 'Follow' }}
                ({{ $question->followers()->count() }})
            </button>
        </form>

        {{-- UPVOTE --}}
        <form method="POST" action="{{ route('questions.vote', $question->id) }}">
            @csrf
            <input type="hidden" name="direction" value="1">
            <button class="btn">
                ⬆ {{ $question->votes()->where('direction', 1)->count() }}
            </button>
        </form>

        {{-- DOWNVOTE --}}
        <form method="POST" action="{{ route('questions.vote', $question->id) }}">
            @csrf
            <input type="hidden" name="direction" value="-1">
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
