// Function to generate the calendar
        function generateCalendar() {
            // Get the current date
            var currentDate = new Date();

            // Get the year and month
            var year = currentDate.getFullYear();
            var month = currentDate.getMonth();

            // Get the number of days in the month
            var numDays = new Date(year, month + 1, 0).getDate();

            // Get the first day of the month
            var firstDay = new Date(year, month, 1).getDay();

            // Create an array to hold the day names
            var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

            // Get the container element for the calendar
            var calendarContainer = document.getElementById('calendar');

            // Clear the container
            calendarContainer.innerHTML = '';

            // Set the month and year in the header
            document.getElementById('month-year').innerHTML = new Intl.DateTimeFormat('en-US', { month: 'long', year: 'numeric' }).format(currentDate);

            // Generate the calendar grid
            for (var i = 0; i < days.length; i++) {
                var dayElement = document.createElement('div');
                dayElement.classList.add('day');
                dayElement.textContent = days[i];
                calendarContainer.appendChild(dayElement);
            }

            for (var i = 0; i < firstDay; i++) {
                var emptyDayElement = document.createElement('div');
                calendarContainer.appendChild(emptyDayElement);
            }

            for (var i = 1; i <= numDays; i++) {
                var dayElement = document.createElement('div');
                dayElement.classList.add('day');
                dayElement.textContent = i;
                calendarContainer.appendChild(dayElement);
            }

            // Highlight the current day
            var currentDay = currentDate.getDate();
            var calendarDays = document.getElementsByClassName('day');
            for (var i = 0; i < calendarDays.length; i++) {
                if (parseInt(calendarDays[i].textContent) === currentDay) {
                    calendarDays[i].classList.add('current-day');
                    break;
                }
            }
        }

        // Call the function to generate the calendar
        generateCalendar();