@include('includes.header')
<style>
.container{
    display:flex;
    height: 90vh;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}
.question-card{
    background-color: #2B2929;
    height: 50vh;
    width: 50vw;
    border-radius: 10px;
    padding: 17px;
    box-shadow: 0 0 15px rgba(255,0,0,0.15);
}
.box{
    background: #2B2929;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
    height: 80px;
    width:550px;
    border:none;
    color:aliceblue;
    font-size: 18px;
}
</style>
<div class="container">
        <div class="question-card">
            <h3>Add Question</h3>

            <form action="{{ route('questions.store') }}" method="POST">
                @csrf

                <input type="text"
                       name="title"
                       placeholder="Question title"
                       required
                       class="box">

                <textarea name="details"
                          placeholder="Describe your question"
                          required
                          class="box"></textarea>

                <br><br>

                <button type="submit" class="add-btn">
                    Submit
                </button>
            </form>
        </div>
        
</div>

</body>
</html>
