var matches = 0;
var elevation = 0;
function resetButton1(num) {
    var button2 = "button" + num;
    num = num - 1;
    var button1 = "button" + num;
    if (document.getElementById(button1).disabled === false && document.getElementById(button2).disabled === false) {
        document.getElementById('inc').value = ++matches;
        elevation += parseFloat(document.getElementById(button2).value);
        document.getElementById('elev').value = elevation;
    } else {
        elevation -= parseFloat(document.getElementById(button1).value);
        elevation += parseFloat(document.getElementById(button2).value);
        document.getElementById('elev').value = elevation;
    }
    document.getElementById(button1).disabled = false;
    document.getElementById(button2).disabled = true;
}

function resetButton2(num) {
    var button1 = "button" + num;
    num = num + 1;
    var button2 = "button" + num;
    if (document.getElementById(button2).disabled === false && document.getElementById(button1).disabled === false) {
        document.getElementById('inc').value = ++matches;
        elevation += parseFloat(document.getElementById(button1).value);
        document.getElementById('elev').value = elevation;
    } else {
        elevation -= parseFloat(document.getElementById(button2).value);
        elevation += parseFloat(document.getElementById(button1).value);
        document.getElementById('elev').value = elevation;
    }
    document.getElementById(button2).disabled = false;
    document.getElementById(button1).disabled = true;
}




function calculateMoney() {
    var sum = Math.round(elevation * parseFloat(document.getElementById('ticketValue').value) * 100) / 100;
    document.getElementById("totalMoney").value = sum;
}