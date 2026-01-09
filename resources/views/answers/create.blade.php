@extends('includes.header')
<style>
.container{
    display:flex;
    height: 90vh;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}
.answer-card{
    background-color: #2B2929;
    height: 50vh;
    width: 50vw;
    border-radius: 10px;
    padding: 18px;
    box-shadow: 0 0 15px rgba(255,0,0,0.15);
}
.answer-card h3{
    color: #ff3b3b;
    font-size: 25px;
    margin: 0 0 6px;
    
}
.box{
    background: #2B2929;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
    height: 200px;
    width:550px;
    border:none;
    color:aliceblue;
    font-size: 18px;
}
.btn{
    background: #ff2d2d;
    color: #fff;
    padding: 8px 14px;
    border-radius: 20px;
    font-size: 14px;
    text-decoration: none; 
}
</style>
@section('content')
<div class="container">

    <div class="answer-card">
        <h3>{{ $question->title }}</h3>
    

    <form method="POST" action="{{ route('answers.store', $question->id) }}">
        @csrf

        <textarea class="box" name="body" rows="6" placeholder="Write your answer..." required></textarea>

        <br><br>

        <button class="btn">Post Answer</button>
    </form>
</div>
</div>
@endsection
