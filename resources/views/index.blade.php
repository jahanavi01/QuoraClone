@include('includes.header')

<!-- ================= MAIN ================= -->
<div class="main">

    <!-- FEED -->
    <div class="feed">

        <!-- ===== Ask Box ===== -->
        <div class="ask-card">
            <input 
                type="text" 
                id="questionSearch"
                placeholder="What do you want to ask or share?"
            >

            <div class="ask-actions">
                <a href="{{ route('questions.create') }}" class="btn">Ask</a>
                <a href="{{ route('questions.index') }}" class="btn">Answer</a>
            </div>
        </div>

        <!-- ===== Questions List ===== -->
        @forelse($questions as $question)
            <div class="question-card searchable-question">

                <!-- Question Title -->
                <h3 class="question-title">
                    {{ $question->title }}
                </h3>
                <hr>

                <!-- Answers -->
                @forelse($question->answers as $answer)

                    <!-- 🔹 Anchor wrapper -->
                    <div id="answer-{{ $answer->id }}">

                        <!-- Answer User Info -->
                        <div class="user-row">
                            <img src="{{ asset('images/default-user.png') }}" class="profile-pic">

                            <div class="user-info">
                                <span class="name">{{ $answer->user->name }}</span>
                                <span class="time">· {{ $answer->created_at->diffForHumans() }}</span>
                            </div>

                            {{-- FOLLOW --}}
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

                        <!-- Answer Body -->
                        <div class="answer">
                            <p>{{ $answer->body }}</p>
                        </div>

                        <!-- Actions -->
                        <div class="actions">

                            <!-- UPVOTE -->
                            <form method="POST" action="{{ route('answers.vote', $answer->id) }}">
                                @csrf
                                <input type="hidden" name="direction" value="1">
                                <input type="hidden" name="anchor" value="answer-{{ $answer->id }}">
                                <button type="submit" class="btn">
                                    ⬆ {{ $answer->votes()->where('direction', 1)->count() }}
                                </button>
                            </form>

                            <!-- DOWNVOTE -->
                            <form method="POST" action="{{ route('answers.vote', $answer->id) }}">
                                @csrf
                                <input type="hidden" name="direction" value="-1">
                                <input type="hidden" name="anchor" value="answer-{{ $answer->id }}">
                                <button type="submit" class="btn">
                                    ⬇ {{ $answer->votes()->where('direction', -1)->count() }}
                                </button>
                            </form>

                        </div>

                    </div>

                    <hr>

                @empty
                    <p class="no-answer">No answers yet</p>
                @endforelse

            </div>
        @empty
            <p>No questions found.</p>
        @endforelse

    </div>
</div>

<!-- ===== SEARCH SCRIPT ===== -->
<script>
    const searchInput = document.getElementById('questionSearch');
    const questions = document.querySelectorAll('.searchable-question');

    searchInput.addEventListener('keyup', function () {
        const searchText = this.value.toLowerCase();

        questions.forEach(question => {
            const title = question
                .querySelector('.question-title')
                .innerText
                .toLowerCase();

            if (title.includes(searchText)) {
                question.style.display = 'block';
            } else {
                question.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>
