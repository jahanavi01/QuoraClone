@include('includes.header')

<!-- ================= MAIN ================= -->
<div class="main">

    <!-- FEED -->
    <div class="feed">

        <!-- ===== Ask Box ===== -->
        <div class="ask-card">
            <input type="text" placeholder="What do you want to ask or share?">

            <div class="ask-actions">
                <a href="{{ route('questions.create') }}" class="btn">Ask</a>
                <a href="{{ route('questions.index') }}" class="btn">Answer</a>
            </div>
        </div>

        <!-- ===== Questions List ===== -->
        @forelse($questions as $question)
            <div class="question-card">

                <!-- Question Title -->
                <h3 class="question-title">
                    {{ $question->title }}
                </h3>
                <hr>

                <!-- User Info -->
                <div class="user-row">
                    <img src="{{ asset('images/default-user.png') }}" class="profile-pic">

                    <div class="user-info">
                        <span class="name">
                            {{ $question->answers->first()?->user?->name ?? 'No answers yet' }}
                        </span>
                        <span class="time">· {{ $question->created_at->diffForHumans() }}</span>
                    </div>

                    <a href="#" class="follow">Follow</a>
                </div>

                <!-- Answers -->
                @forelse($question->answers as $answer)
                    <div class="answer">
                        <p>{{ $answer->body }}</p>
                    </div>
                @empty
                    <p class="no-answer">No answers yet</p>
                @endforelse

                <!-- Actions -->
                <div class="actions">
                    <button class="action-btn">⬆ Upvote</button>
                    <button class="action-btn">⬇ Downvote</button>
                </div>

            </div>
        @empty
            <p>No questions found.</p>
        @endforelse

    </div>

</div>

</body>
</html>
