<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<form action="index.php" method="POST">
    <div class="container">
        <h1>The Virtual Slot Machine!</h1>
        <div class="slotBox">
            <div class="Box imgBox"><img src="img/apple.png"></div>
            <div class="Box imgBox"><img src="img/apple.png"></div>
            <div class="Box imgBox"><img src="img/apple.png"></div>
            <div class="Box spin"><h1>SPIN</h1></div>
        </div> 
        <div id="txt">
            <label for="name" >Name:</label>
            <input type="text" name="Name" id="name"><br>
            <label for="bet">Your Bet:</label>
            <input type="text" name="bet"  id="bet" required>
            <label for="credit">Credit:</label>
            <input type="text" name="credit" id="credit" value="100" readonly="true" min="1"><br>
            <div id="addText"></div>
        </div>
    </div>
</form>
<script>   
    function randomNum(){
        return Math.floor(Math.random() * 7 + 1);
    }
    function getPath(num){
    let path = "";
    if (num == 1){
        path = "img/apple.png";
    }else if (num == 2){
        path = "img/cherry.png";
    }else if (num == 3){
        path = "img/grapes.png";
    }else if (num == 4){
        path = "img/lemon.png";
    }else if (num == 5){
        path = "img/orange.png";
    }else if (num == 6){
        path = "img/pear.png";
    }else{
        path = "img/watermelon.png";
    }
    return path;
}

let spin = document.querySelector(".spin");
let img = document.querySelectorAll(".imgBox img");

let bet;
let credit;
let first;
let second;
let third;
let personName;

spin.addEventListener("click", function(){
    bet = parseInt(document.querySelector("#bet").value);
    credit = parseInt(document.querySelector("#credit").value);
    personName = String(document.querySelector("#name").value);

    if(bet > 0) {
        if(credit < bet){
        document.querySelector("#addText").innerHTML = personName + " Your credit is not enough for betting";
        personName = "";
        }else{
            first = randomNum();
            second = randomNum();
            third = randomNum();
            let arr = [first, second, third];
            for (var i = 0; i < arr.length; i++){
                img[i].setAttribute("src", getPath(arr[i]));
            }
        }
        if(first == second && second == third){
            credit += bet * 4;
            document.querySelector("#addText").innerHTML = personName + " Congratulation! you win!";
        }else if(first == second || first == third || second == third){
            credit += bet * 2;
            document.querySelector("#addText").innerHTML = personName + " Good job! keep going it.";
        }else{  
            if(credit > 0) {
                credit -= bet;
                document.querySelector("#addText").innerHTML = personName + " Sorry, you lost.";
            }else{
                document.querySelector("#addText").innerHTML = "You don't have enough money.";
            }      
        }

    } else{
        document.querySelector("#addText").innerHTML = "The bet should be positive number";
    }
   
    document.querySelector("#credit").value = credit;
});
      
</script>   
</body>
</html>
