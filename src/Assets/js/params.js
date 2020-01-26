function ToggleExpendMenu(sender) {
    if (sender.innerHTML == "+")
    {
        var level2Buttons = document.getElementsByClassName("level2-button");
        for (i = 0; i < level2Buttons.length; i++) {
            level2Buttons[i].classList.remove("d-none");
        }
        var level1Buttons = document.getElementsByClassName("level1-button");
        for (i = 0; i < level1Buttons.length; i++) {
            level1Buttons[i].innerHTML = "-";
        }
    }
    else
    {
        var level2Buttons = document.getElementsByClassName("level2-button");
        for (i = 0; i < level2Buttons.length; i++) {
            level2Buttons[i].classList.add("d-none");
        }
        var level1Buttons = document.getElementsByClassName("level1-button");
        for (i = 0; i < level1Buttons.length; i++) {
            level1Buttons[i].innerHTML = "+";
        }
    }
}

function ToggleMoreExpendMenu(sender) {
    if (sender.innerHTML == "++")
    {
        var level2Buttons = document.getElementsByClassName("level2-button");
        for (i = 0; i < level2Buttons.length; i++) {
            level2Buttons[i].innerHTML = "--";
        }
        var level1Buttons = document.getElementsByClassName("level1-button");
        for (i = 0; i < level1Buttons.length; i++) {
            level1Buttons[i].classList.add("d-none");
        }
    }
    else
    {
        var level2Buttons = document.getElementsByClassName("level2-button");
        for (i = 0; i < level2Buttons.length; i++) {
            level2Buttons[i].innerHTML = "++";
        }
        var level1Buttons = document.getElementsByClassName("level1-button");
        for (i = 0; i < level1Buttons.length; i++) {
            level1Buttons[i].classList.remove("d-none");
        }
    }
}