// Set the date we're counting down to
var countDownDate = new Date("Mar 9, 2019 20:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function () {

    // Get todays date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="countdown"
    document.getElementById("countdown").style.color = "white";
    text = document.getElementById("countdown").innerHTML = days + " jour" + ((days > 1) ? 's ' : '') + hours + " heure" + ((hours > 1) ? 's ' : '')
        + minutes + " minute" + ((minutes > 1) ? 's ' : '') + seconds + " seconde" + ((seconds > 1) ? 's' : '');

    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);