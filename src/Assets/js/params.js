function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

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
        document.cookie = 'menu_expansion_level=1';
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
        document.cookie = 'menu_expansion_level=0';
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
        document.cookie = 'menu_expansion_level=2';
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
        document.cookie = 'menu_expansion_level=1';
    }
}

const menuExpansionLevel = getCookie("menu_expansion_level");
switch (menuExpansionLevel)
{
    case "0":
        var level2Menus = document.getElementsByClassName('level2-menu');
        for (i = 0; i < level2Menus.length; i++) {
            level2Menus[i].classList.remove("show");
        };
        var level3Menus = document.getElementsByClassName('level3-menu');
        for (i = 0; i < level3Menus.length; i++) {
            level3Menus[i].classList.remove("show");
        };
    break;
    case "1":
        var level2Menus = document.getElementsByClassName('level2-menu');
        for (i = 0; i < level2Menus.length; i++) {
            level2Menus[i].classList.add("show");
        };
        var level3Menus = document.getElementsByClassName('level3-menu');
        for (i = 0; i < level3Menus.length; i++) {
            level3Menus[i].classList.remove("show");
        };
        var expandBtn = document.getElementById("expand-btn");
        ToggleExpendMenu(expandBtn);
    break;
    case "2":
        var level2Menus = document.getElementsByClassName('level2-menu');
        for (i = 0; i < level2Menus.length; i++) {
            level2Menus[i].classList.add("show");
        };
        var level3Menus = document.getElementsByClassName('level3-menu');
        for (i = 0; i < level3Menus.length; i++) {
            level3Menus[i].classList.add("show");
        };
        var expandBtn = document.getElementById("expand-btn");
        ToggleExpendMenu(expandBtn);
        var moreExpandBtn = document.getElementById("more-expand-btn");
        ToggleMoreExpendMenu(moreExpandBtn);
    break;
}