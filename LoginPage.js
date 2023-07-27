let lock = document.getElementById("lock")
let unlock = document.getElementById("unlock")
lock.style.opacity = 100;
lock.addEventListener("click", () => {
    if (pass.type == "password") {
        pass.setAttribute("type", "text");
        lock.style.opacity = 0;
        unlock.style.opacity = 100;

    }
    else {
        pass.setAttribute("type", "password");
        lock.style.opacity = 100;
        unlock.style.opacity = 0;
    }
})