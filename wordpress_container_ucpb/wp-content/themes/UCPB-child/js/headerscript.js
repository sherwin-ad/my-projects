document.getElementById("toggleButton").addEventListener("click", function() {
        let div = document.getElementById("helpertools");
        if (div.style.display === "none" || div.style.display === "") {
            div.style.display = "block";
        } else {
            div.style.display = "none";
        }
    });
    
// 
document.addEventListener("DOMContentLoaded", function () {
	const hamburger = document.getElementById("hamburger-menu");
	const backButton = document.getElementById("back-button");
	const siteNavigation = document.getElementById("site-navigation");

	// Open menu
	hamburger.addEventListener("click", function () {
		siteNavigation.classList.add("is-active");
	});

	// Close menu (Back button)
	backButton.addEventListener("click", function () {
		siteNavigation.classList.remove("is-active");
	});
});


	function updateTime() {
        var currentTime = new Date();
        var day = currentTime.toLocaleString('en-US', { weekday: 'long' });
        var month = currentTime.toLocaleString('en-US', { month: 'long' });
        var date = currentTime.getDate();
        var year = currentTime.getFullYear();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();
        var ampm = hours >= 12 ? 'PM' : 'AM';

        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        var timeString = day + ', ' + month + ' ' + date + ', ' + year + ' ' + hours + ':' + minutes + ':' + seconds + ' ' + ampm;
        document.getElementById('time').innerHTML = timeString;
    }
        setInterval(updateTime, 1000);	