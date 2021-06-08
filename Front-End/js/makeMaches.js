var matches = 0;
var elevation = 0;
var matchesArray = new Array();
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
    var found = false;
    for(var i = 0; i < matchesArray.length;i++){
        if(matchesArray[i] === button1){
            matchesArray[i] = button2;
            found = true;
        }
    }
    if(found === false){
        matchesArray.push(button2);
    }
    console.log("HERE");
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
    var found = false;
    for(var i = 0; i < matchesArray.length;i++){
        if(matchesArray[i] === button2){
            matchesArray[i] = button1;
            found = true;
        }
       
    }
    if(found === false){
        matchesArray.push(button1);
    }
    document.getElementById(button2).disabled = false;
    document.getElementById(button1).disabled = true;
}




function calculateMoney() {
    var sum = Math.round(elevation * parseFloat(document.getElementById('ticketValue').value) * 100) / 100 ;
    document.getElementById("totalMoney").value = sum;
    document.getElementById("submit").value = matchesArray;
}