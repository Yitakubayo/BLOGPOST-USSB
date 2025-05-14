📱 Blog USSD App (Menu)
RegNumber: 22RP02850
Names: Samuel Yitakubayo

This is a PHP-based USSD application that allows users to interact with a blog-like service through a simple and interactive menu system. It is built using Africa’s Talking USSD gateway to allow users to subscribe to blog updates, rate blog content, send suggestions or feedback, and manage subscriptions directly from their mobile phones without needing internet access.

🧩 Features
Users can:

✅ Subscribe to receive blog updates.

❌ Unsubscribe from updates.

⭐ Rate the blog (1 to 5 stars).

💡 Suggest blog topics.

🗣️ Send feedback to improve content.

🛠️ What I Did
As part of this project, I personally worked on:

🔄 Menu.php – the core file that handles the logic of the USSD menu, step-by-step user input tracking, and what content to show based on user selections.

🗃️ Database Design and Implementation – I created the necessary MySQL database and tables to handle:

Subscriptions

Ratings

Topic Suggestions

Feedback

🛠️ I also contributed to connecting the USSD logic with the backend using PDO in a secure and reusable way.

This work enabled the app to:

Store user interactions.

Navigate across multiple menu levels.

Save and retrieve user feedback, ratings, and subscription data.

🤝 Collaborator’s Contribution
My colleague Uwimpuhwe Ezebie was responsible for implementing the SMS sending functionality. Specifically, she:

Developed sms.php to send messages using Africa’s Talking SMS API.

Integrated SMS confirmation after user actions (e.g., subscribe/unsubscribe).

Handled API authentication using sandbox credentials.

⚙️ Project Files

├── config.php          # PDO database connection
├── index.php           # Entry point for incoming USSD requests
├── Menu.php            # Contains USSD menu logic (handled by me)
├── sms.php             # Sends SMS messages (handled by Uwimpuhwe Ezebie)
├── util.php            # Global variables and credentials
└── README.md           # Project documentation
🗃️ Database Structure
You must create the following tables:

CREATE TABLE subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phone_number VARCHAR(20) UNIQUE,
    status VARCHAR(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phone_number VARCHAR(20),
    rating INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE topics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phone_number VARCHAR(20),
    suggestion TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    phone_number VARCHAR(20),
    feedback TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
🌐 How to Test the Application
Deploy the project on a web server (e.g., XAMPP or live host).

Use Africa’s Talking sandbox to register your USSD callback URL.

Dial the sandbox code (e.g., *384*000#) to start using the menu.

Navigate the menu and test each option (subscribe, rate, suggest, feedback).

Confirm SMS messages are received.
