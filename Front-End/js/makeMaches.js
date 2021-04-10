var matches = 0;
var elevation = 0;
function resetFirstButton() {
    if (document.getElementById("firstButton").disabled === false && document.getElementById("secondButton").disabled === false) {
        document.getElementById('inc').value = ++matches;
        elevation += parseFloat(document.getElementById('secondButton').value);
        document.getElementById('elev').value = elevation;
    } else {
        elevation -= parseFloat(document.getElementById('firstButton').value);
        elevation += parseFloat(document.getElementById('secondButton').value);
        document.getElementById('elev').value = elevation;
    }
    document.getElementById("firstButton").disabled = false;
    document.getElementById("secondButton").disabled = true;
}

function resetSecondButton() {
    if (document.getElementById("firstButton").disabled === false && document.getElementById("secondButton").disabled === false) {
        document.getElementById('inc').value = ++matches;
        elevation += parseFloat(document.getElementById('firstButton').value);
        document.getElementById('elev').value = elevation;
    } else {
        elevation -= parseFloat(document.getElementById('secondButton').value);
        elevation += parseFloat(document.getElementById('firstButton').value);
        document.getElementById('elev').value = elevation;
    }
    document.getElementById("secondButton").disabled = false;
    document.getElementById("firstButton").disabled = true;
}

function resetThirdButton() {
    if (document.getElementById("thirdButton").disabled === false && document.getElementById("forthButton").disabled === false) {
        document.getElementById('inc').value = ++matches;
        elevation += parseFloat(document.getElementById('forthButton').value);
        document.getElementById('elev').value = elevation;
    } else {
        elevation -= parseFloat(document.getElementById('thirdButton').value);
        elevation += parseFloat(document.getElementById('forthButton').value);
        document.getElementById('elev').value = elevation;
    }
    document.getElementById("thirdButton").disabled = false;
    document.getElementById("forthButton").disabled = true;
}

function resetForthButton() {
    if (document.getElementById("thirdButton").disabled === false && document.getElementById("forthButton").disabled === false) {
        document.getElementById('inc').value = ++matches;
        elevation += parseFloat(document.getElementById('thirdButton').value);
        document.getElementById('elev').value = elevation;
    } else {
        elevation -= parseFloat(document.getElementById('forthButton').value);
        elevation += parseFloat(document.getElementById('thirdButton').value);
        document.getElementById('elev').value = elevation;
    }
    document.getElementById("forthButton").disabled = false;
    document.getElementById("thirdButton").disabled = true;
}

function resetFifthButton() {
    if (document.getElementById("sixthButton").disabled === false && document.getElementById("fifthButton").disabled === false) {
        document.getElementById('inc').value = ++matches;
        elevation += parseFloat(document.getElementById('sixthButton').value);
        document.getElementById('elev').value = elevation;
    } else {
        elevation -= parseFloat(document.getElementById('fifthButton').value);
        elevation += parseFloat(document.getElementById('sixthButton').value);
        document.getElementById('elev').value = elevation;
    }
    document.getElementById("fifthButton").disabled = false;
    document.getElementById("sixthButton").disabled = true;
}

function resetSixthButton() {
    if (document.getElementById("sixthButton").disabled === false && document.getElementById("fifthButton").disabled === false) {
        document.getElementById('inc').value = ++matches;
        elevation += parseFloat(document.getElementById('fifthButton').value);
        document.getElementById('elev').value = elevation;
    } else {
        elevation -= parseFloat(document.getElementById('sixthButton').value);
        elevation += parseFloat(document.getElementById('fifthButton').value);
        document.getElementById('elev').value = elevation;
    }
    document.getElementById("sixthButton").disabled = false;
    document.getElementById("fifthButton").disabled = true;
}

function resetSeventhButton() {
    if (document.getElementById("eighthButton").disabled === false && document.getElementById("seventhButton").disabled === false) {
        document.getElementById('inc').value = ++matches;
        elevation += parseFloat(document.getElementById('eighthButton').value);
        document.getElementById('elev').value = elevation;
    } else {
        elevation -= parseFloat(document.getElementById('seventhButton').value);
        elevation += parseFloat(document.getElementById('eighthButton').value);
        document.getElementById('elev').value = elevation;
    }
    document.getElementById("seventhButton").disabled = false;
    document.getElementById("eighthButton").disabled = true;
}

function resetEighthButton() {
    if (document.getElementById("eighthButton").disabled === false && document.getElementById("seventhButton").disabled === false) {
        document.getElementById('inc').value = ++matches;
        elevation += parseFloat(document.getElementById('seventhButton').value);
        document.getElementById('elev').value = elevation;
    } else {
        elevation -= parseFloat(document.getElementById('eighthButton').value);
        elevation += parseFloat(document.getElementById('seventhButton').value);
        document.getElementById('elev').value = elevation;
    }
    document.getElementById("eighthButton").disabled = false;
    document.getElementById("seventhButton").disabled = true;
}

function resetNinthButton() {
    if (document.getElementById("tenthButton").disabled === false && document.getElementById("ninthButton").disabled === false) {
        document.getElementById('inc').value = ++matches;
        elevation += parseFloat(document.getElementById('tenthButton').value);
        document.getElementById('elev').value = elevation;
    } else {
        elevation -= parseFloat(document.getElementById('ninthButton').value);
        elevation += parseFloat(document.getElementById('tenthButton').value);
        document.getElementById('elev').value = elevation;
    }
    document.getElementById("ninthButton").disabled = false;
    document.getElementById("tenthButton").disabled = true;
}

function resetTenthButton() {
    if (document.getElementById("tenthButton").disabled === false && document.getElementById("ninthButton").disabled === false) {
        document.getElementById('inc').value = ++matches;
        elevation += parseFloat(document.getElementById('ninthButton').value);
        document.getElementById('elev').value = elevation;
    } else {
        elevation -= parseFloat(document.getElementById('tenthButton').value);
        elevation += parseFloat(document.getElementById('ninthButton').value);
        document.getElementById('elev').value = elevation;
    }
    document.getElementById("tenthButton").disabled = false;
    document.getElementById("ninthButton").disabled = true;
}

function resetEleventhButton() {
    if (document.getElementById("twelfthButton").disabled === false && document.getElementById("eleventhButton").disabled === false) {
        document.getElementById('inc').value = ++matches;
        elevation += parseFloat(document.getElementById('twelfthButton').value);
        document.getElementById('elev').value = elevation;
    } else {
        elevation -= parseFloat(document.getElementById('eleventhButton').value);
        elevation += parseFloat(document.getElementById('twelfthButton').value);
        document.getElementById('elev').value = elevation;
    }
    document.getElementById("eleventhButton").disabled = false;
    document.getElementById("twelfthButton").disabled = true;
}

function resetTwelfthButton() {
    if (document.getElementById("twelfthButton").disabled === false && document.getElementById("eleventhButton").disabled === false) {
        document.getElementById('inc').value = ++matches;
        elevation += parseFloat(document.getElementById('eleventhButton').value);
        document.getElementById('elev').value = elevation;
    } else {
        elevation -= parseFloat(document.getElementById('twelfthButton').value);
        elevation += parseFloat(document.getElementById('eleventhButton').value);
        document.getElementById('elev').value = elevation;
    }
    document.getElementById("twelfthButton").disabled = false;
    document.getElementById("eleventhButton").disabled = true;
}


function calculateMoney() {
    var sum = Math.round(elevation * parseFloat(document.getElementById('ticketValue').value) * 100) / 100;
    document.getElementById("totalMoney").value = sum;
}