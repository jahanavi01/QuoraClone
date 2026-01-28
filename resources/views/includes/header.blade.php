<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quora Clone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #0b0b0b;
            color: #e6e6e6;
        }

        /* ================= NAVBAR ================= */
        .navbar {
            height: 60px;
            background: #000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
            border-bottom: 1px solid #1f1f1f;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-left {
            display: flex;
            align-items: center;
        }

        .logo {
            color: #ff2d2d;
            font-size: 26px;
            font-weight: bold;
            margin-right: 25px;
        }

        .nav-icons {
            display: flex;
            gap: 18px;
        }

        .nav-item {
            font-size: 18px;
            color: #aaa;
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 6px;
        }

        .nav-item:hover {
            background: #1a1a1a;
            color: #ff4d4d;
        }

        .nav-item.active {
            color: #ff2d2d;
            border-bottom: 2px solid #ff2d2d;
        }

        .search-box {
            flex: 1;
            max-width: 450px;
            margin: 0 30px;
        }

        .search-box input {
            width: 100%;
            padding: 8px 14px;
            border-radius: 20px;
            border: none;
            background: #1a1a1a;
            color: #fff;
            outline: none;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-name {
            font-size: 14px;
            color: #ccc;
        }

        .add-btn {
           background: #ff2d2d;
            color: #fff;
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 14px;
            text-decoration: none; 
        }

        .add-btn:hover {
            background: #cc0000;
        }

       /* ================= MAIN ================= */
.main {
    display: flex;
    justify-content: center;
    max-width: 1200px;
    margin: 20px auto;
    padding: 0 20px;
}

/* ================= FEED ================= */
.feed {
    width: 100%;
    max-width: 720px;
}

/* ================= ASK BOX ================= */
.ask-card {
    background: #111;
    border-radius: 12px;
    padding: 15px;
    margin-bottom: 20px;
}

.ask-card input {
    width: 100%;
    background: #1a1a1a;
    border: none;
    padding: 12px 15px;
    border-radius: 25px;
    color: #fff;
    outline: none;
}

.ask-actions {
    display: flex;
    gap: 10px;
    margin-top: 12px;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    height: 36px;
    min-width: 90px;

    background: #1a1a1a;
    color: #ccc;
    padding: 0 16px;
    border-radius: 20px;
    font-size: 13px;

    border: none;
    text-decoration: none;
    cursor: pointer;
    white-space: nowrap;
}

.btn:hover {
    background: #ff2d2d;
    color: #fff;
}

/* ================= QUESTION CARD ================= */
.question-card {
    background: #111;
    border-radius: 12px;
    padding: 18px;
    margin-bottom: 20px;
    border: 1px solid #1f1f1f;
}

.question-title {
    color: #ff4d4d;
    font-size: 18px;
    margin-bottom: 10px;
}

.question-card hr {
    border: none;
    border-top: 1px solid #222;
    margin: 12px 0;
}

/* ================= USER ROW ================= */
.user-row {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 12px;
}

.profile-pic {
    width: 38px;
    height: 38px;
    border-radius: 50%;
}

.user-info {
    flex-grow: 1;
}

.name {
    font-size: 14px;
    font-weight: 600;
}

.time {
    font-size: 12px;
    color: #888;
}

.follow {
    font-size: 13px;
    color: #ff4d4d;
    text-decoration: none;
}

/* ================= ANSWER ================= */
.answer {
    background: #0f0f0f;
    border-left: 3px solid #ff2d2d;
    padding: 10px 12px;
    margin: 10px 0;
    border-radius: 6px;
}

/* ================= ACTIONS ================= */
.actions {
    display: flex;
    gap: 12px;
    margin-top: 12px;
}

.action-btn {
    background: #1a1a1a;
    border: none;
    color: #aaa;
    padding: 7px 14px;
    border-radius: 20px;
    cursor: pointer;
}

.action-btn:hover {
    background: #ff2d2d;
    color: #fff;
}

        

    </style>
</head>
<body>

<!-- ================= NAVBAR ================= -->
<div class="navbar">
    <div class="nav-left">
        <div class="logo">Quora</div>

        <div class="nav-icons">
            <a href="{{ route('index') }}" class="nav-item active" title="Home">🏠</a>
            <a href="{{route( 'questions.index') }}" class="nav-item" title="Questions">❓</a>
            <a href="{{ route('follow') }}" class="nav-item" title="Following">👥</a>
        </div>
    </div>
    

    <div class="nav-right">
        <span class="user-name">{{ auth()->user()->name }}</span>
        <a href="{{ route('questions.create') }}" class="add-btn" >Add question</a>
        <a href="{{ route('logout') }}" class="add-btn" >Logout</a>
    </div>
</div>
@yield('content')
