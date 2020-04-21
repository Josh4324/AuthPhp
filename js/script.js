let appbutton = document.querySelectorAll(".but");
console.log(appbutton);

const buttons = Array.from(appbutton);

let showDetails = (evt) => {
    evt.preventDefault();
    let element = evt.target.parentElement.nextElementSibling;
    if (element.classList.contains("d-none")) {
        element.classList.remove("d-none");
        evt.target.textContent = "Close Details";
    } else {
        element.classList.add("d-none");
        evt.target.textContent = "Show Details";
    }

}

for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', showDetails);
}