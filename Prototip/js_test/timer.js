var DEFAULT_COUNTDOWN_TIMER = 1000;

var countdown;
var countdown_timer;
var audio = new Audio('beep-07.mp3');

function countdown_trigger() {
    audio.play();
    countdown = setTimeout(countdown_trigger, countdown_timer);
}

function countdown_clear() {
    clearTimeout(countdown);
}

function countdown_init() {
    countdown_timer = document.getElementById('time').value;
    if (countdown_timer.length <= 0)
        countdown_timer = DEFAULT_COUNTDOWN_TIMER;
    countdown_trigger();
}

window.onload = function() {
    document.getElementById('start').onclick = countdown_init;
    document.getElementById('stop').onclick = countdown_clear;
};