// Get references to the clock hands
const hourHand = document.getElementById('hour-hand');
const minuteHand = document.getElementById('minute-hand');
const secondHand = document.getElementById('second-hand');

function rotateClockHands() {
    // Get the current time
    const now = new Date();

    // Calculate the degrees for each hand
    const hours = now.getHours();
    const minutes = now.getMinutes();
    const seconds = now.getSeconds();

    const hourDegrees = (hours * 30) + (minutes * 0.5); // Each hour is 30 degrees, each minute is 0.5 degrees
    const minuteDegrees = (minutes * 6) + (seconds * 0.1); // Each minute is 6 degrees, each second is 0.1 degrees
    const secondDegrees = seconds * 6; // Each second is 6 degrees

    // Apply the rotation to each hand
    hourHand.style.transform = `rotate(${hourDegrees}deg)`;
    minuteHand.style.transform = `rotate(${minuteDegrees}deg)`;
    secondHand.style.transform = `rotate(${secondDegrees}deg)`;
}

// Update the clock every second
setInterval(rotateClockHands, 1000);
