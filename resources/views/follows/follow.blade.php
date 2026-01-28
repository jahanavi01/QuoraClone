@extends('includes.header')

<style>
/* ===== Layout ===== */
.page {
    display: flex;
    max-width: 1200px;
    margin: 20px auto;
    gap: 20px;
    padding: 0 15px;
}

/* ===== Sidebar ===== */
.sidebar {
    width: 260px;
    background: #111;
    border-radius: 14px;
    border: 1px solid #1f1f1f;
    padding: 15px;
    height: fit-content;
    position: sticky;
    top: 80px;
}

.sidebar-title {
    color: #ff4d4d;
    font-size: 16px;
    margin-bottom: 12px;
}

.sidebar-user {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.sidebar-user img {
    width: 34px;
    height: 34px;
    border-radius: 50%;
}

.sidebar-user span {
    color: #ddd;
    font-size: 14px;
}

/* ===== Main Content ===== */
.container {
    flex: 1;
}

/* ===== Cards ===== */
.question-card {
    background: radial-gradient(circle at top, #111, #0b0b0b);
    padding: 10px;
    border-radius: 18px;
    border: 1px solid #1f1f1f;
    margin-bottom: 20px;
}

/* ===== User Row ===== */
.user-row {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.profile-pic {
    width: 38px;
    height: 38px;
    border-radius: 50%;
}

.name {
    font-weight: 600;
    color: #ddd;
    text-decoration: none;
}
.name:hover{
    text-decoration: underline;
}

/* ===== Question ===== */
.title {
    color: #ff4d4d;
    text-decoration: none;
    font-weight: bold;
    font-size: 18px;
    margin: 10px 0;
    display: inline-block;
}

.title:hover {
    text-decoration: underline;
}

.replies {
    color: grey;
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
    margin-bottom: 12px;
}

/* ===== Actions ===== */
.pill-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}
.actions a.btn {
    line-height: 1;
}

.pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 999px;
    background: #1a1a1a;
    color: #ddd;
    border: none;
    font-size: 14px;
    cursor: pointer;
}

.pill:hover {
    background: #ff2d2d;
    color: #fff;
}

/* ===== Section Title ===== */
.section-title {
    color: #ff4d4d;
    margin: 30px 0 15px;
    font-size: 18px;
}

/* ===== Discover Card ===== */
.discover-card {
    background: #111;
    width: 100%;
    padding: 14px;
    width:30vw;
    border-radius: 14px;
    border: 1px solid #1f1f1f;
    margin-bottom: 12px;
}

.push-right {
    margin-left: auto;
}
</style>

@section('content')
<div class="page">

    {{-- ================= SIDEBAR ================= --}}
    <div class="sidebar">
        <div class="sidebar-title">Following</div>

        @forelse($followingUsers as $user)
            <div class="sidebar-user">
                <img src="{{ asset('images/default-user.png') }}">
                <a href="{{ route('users.show', $user->id) }}" class="name">
    {{ $user->name }}
</a>

            </div>
        @empty
            <p style="color:#777;">You are not following anyone.</p>
        @endforelse
    </div>

    {{-- ================= MAIN CONTENT ================= --}}
    <div class="container">

        {{-- FOLLOWING QUESTIONS --}}
        @forelse($questions as $question)
        <div class="question-card">

            <div class="user-row">
                <img src="{{ asset('images/default-user.png') }}" class="profile-pic">
                <div class="name">{{ $question->user->name }}</div>
            </div>

            <a href="{{ route('questions.answers', $question->id) }}" class="title">
                {{ $question->title }}
            </a>
            <br>

            <a href="{{ route('questions.answers', $question->id) }}" class="replies">
                · {{ $question->answers->count() }} replies
            </a>

            <div class="pill-actions">

                <a href="{{ route('answers.create', $question->id) }}" class="btn">
                    💬 Answer
                </a>


            </div>
        </div>
        @empty
            <p style="color:#777;">No questions yet from followed users.</p>
        @endforelse

        {{-- DISCOVER PEOPLE --}}
        <h3 class="section-title">Discover People</h3>

        @foreach($discoverUsers as $user)
        @if(!$authUser->isFollowing($user) && $authUser->id !== $user->id)
        <div class="discover-card">
            <div class="user-row">
                <img src="{{ asset('images/default-user.png') }}" class="profile-pic">
                <a href="{{ route('users.show', $user->id) }}" class="name">
    {{ $user->name }}
</a>


                <form method="POST"
                      action="{{ route('follow.toggle', ['user', $user->id]) }}"
                      class="push-right">
                    @csrf
                    <button class="pill">Follow</button>
                </form>
            </div>
        </div>
        @endif
        @endforeach

    </div>
</div>
@endsection
</body>
</html>
