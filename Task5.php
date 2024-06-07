<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Game Selection Menu</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        text-align: center;
        }

        #game-selection button {
        margin: 20px;
        padding: 10px 20px;
        font-size: 16px;
        }

        #tic-tac-toe {
        display: grid;
        grid-template-columns: repeat(3, 100px);
        grid-template-rows: repeat(3, 100px);
        gap: 5px;
        margin: 20px auto;
        width: 310px;
        }

        .cell {
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #000;
        font-size: 24px;
        cursor: pointer;
        }

        canvas {
        border: 1px solid #000;
        margin: 20px auto;
        display: block;
        }

    </style>
</head>

<body>
    <h1>Game Selection Menu</h1>
    <div id="game-selection">
        <button onclick="location.href='snake.html'">Play Snake</button>
        <button onclick="location.href='tictactoe.html'">Play Tic-Tac-Toe</button>
    </div>
</body>

</html>
