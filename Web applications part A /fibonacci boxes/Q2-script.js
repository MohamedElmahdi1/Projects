
document.getElementById("display").addEventListener("click", draw);


function changeColor(event) {
    this.style.backgroundColor = randomColor();
}

function draw() {
    if (document.getElementById("number").value >= 1 && document.getElementById("number").value <= 6){
    var container = document.getElementById("container");
    container.innerHTML = " ";
    var number = parseInt(document.getElementById("number").value)
    var margin = 5;

    for (var i = 0; i < number; i++) {
        var box = document.createElement("div");
        container.appendChild(box);
        var color = randomColor();
        box.innerHTML = i + 1;
        box.style.backgroundColor = color;
        box.style.marginLeft = margin + "px";
        margin *= 2;

    }
}
else{
    alert("the input has to be between 1 and 6 please.");
    document.getElementById('number').value = '';
}

}

function randomColor() {
    var randomRed = Math.floor(Math.random() * 255);
    var randomGreen = Math.floor(Math.random() * 255);
    var randomBlue = Math.floor(Math.random() * 255);
    //create the string that is the ‘random color’
    var randomColor = "rgb(" + randomRed + "," + randomGreen + "," + randomBlue + ")";

    return randomColor;
}