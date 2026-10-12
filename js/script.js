let past = document.getElementsByClassName('past')[0];
let present = document.getElementsByClassName('present')[0];
let future = document.getElementsByClassName('future')[0];
let btnPast = document.getElementById("btn-past");
let btnPresent = document.getElementById("btn-present");
let btnFuture = document.getElementById("btn-future");

function changeTime(time) {
    let position;
    if (time == "past") {
        position = "0";
    } else if (time == "present") {
        position = "-105%";
    } else {
        position = "-210%";
    }

    past.style.left = position;
    present.style.left = position;
    future.style.left = position;

    console.log(position);
    
}

btnPast.addEventListener("click", (e) => {
    changeTime("past");
});

btnPresent.addEventListener("click", (e) => {
    changeTime("present");
});

btnFuture.addEventListener("click", (e) => {
    changeTime("future");
});