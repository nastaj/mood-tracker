// DOM Elements
const userGreeting = document.querySelector("#user-greeting");
const currentDate = document.querySelector("#current-date");
const moodEmoji = document.querySelector("#mood-emoji");
const moodCategory = document.querySelector("#mood-category");
const sleepHours = document.querySelector("#sleep-hours");
const insight = document.querySelector("#insight");
// const note = document.querySelector("#note");

// Fetch user data and today's mood entry
document.addEventListener("DOMContentLoaded", async () => {
    try {
        // Fetch user info
        const userRes = await fetch("./api/get_user.php");
        const userData = await userRes.json();

        if (userData.success && userData.user) {
            const username = userData.user.username;
            userGreeting.textContent = `Hello, ${username}!`;

            // Fetch latest mood data for this user
            const moodRes = await fetch(`./api/get_latest_mood.php?user_id=${userData.user.user_id}`);
            const moodData = await moodRes.json();

            // Display mood info (if any)
            if (moodData.success && moodData.data) {
                const mood = moodData.data;

                moodCategory.textContent = mood.category_name || "No category";
                sleepHours.textContent = `${mood.hours_of_sleep} hours` || "N/A";
                insight.textContent = mood.insight || "No insight";
                // note.textContent = mood.notes || "No notes";
                moodEmoji.textContent = mood.image || "😐"; // Default emoji if none
            } else {
                console.warn("No mood entry for today");
            }

        } else {
            console.warn("User not logged in");
        }
    } catch (err) {
        console.error("Error fetching data:", err);
    }
});

// Set current date
const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
const today = new Date();
currentDate.textContent = today.toLocaleDateString('en-GB', options);