<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Himilo Transfer - Your Trusted Remittance Partner</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa; /* Lighter background for a cleaner look */
            color: #343a40; /* Dark gray text */
            line-height: 1.6;
        }
        .container {
            max-width: 1200px;
            padding: 1rem;
        }
        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #e9ecef;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #adb5bd;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #6c757d;
        }

        /* Custom Colors from image */
        :root {
            --primary-purple: #673AB7; /* Main purple from image */
            --secondary-blue: #2196F3; /* Main blue from image */
            --light-blue-bg: #E3F2FD; /* A lighter shade for backgrounds, similar to Bootstrap's light blue */
            --text-dark-blue: #1A237E; /* Darker blue for text, similar to original design */
            --dark-purple-text: #4527A0; /* A darker shade of purple for headings */
        }

        .bg-primary-purple { background-color: var(--primary-purple) !important; }
        .text-primary-purple { color: var(--primary-purple) !important; }
        .bg-secondary-blue { background-color: var(--secondary-blue) !important; }
        .text-secondary-blue { color: var(--secondary-blue) !important; }
        .bg-light-blue-bg { background-color: var(--light-blue-bg) !important; }
        .text-dark-blue { color: var(--text-dark-blue) !important; }
        .text-dark-purple { color: var(--dark-purple-text) !important; }

        /* Gradient for Hero Section */
        .hero-gradient {
            background: linear-gradient(45deg, var(--primary-purple) 0%, var(--secondary-blue) 100%);
        }

        /* Custom button styles */
        .btn-custom-blue {
            background-color: var(--secondary-blue);
            color: white;
            border: none;
            padding: 0.85rem 2.5rem;
            border-radius: 50px; /* More rounded */
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        .btn-custom-blue:hover {
            background-color: #1976D2; /* Slightly darker blue on hover */
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }
        .btn-custom-blue:focus {
            box-shadow: 0 0 0 0.25rem rgba(33, 150, 243, 0.5); /* Focus ring for blue */
            outline: none;
        }

        /* Custom yellow button for hero (adapted to purple text) */
        .btn-hero-yellow {
            background-color: #FFD740; /* Brighter yellow */
            color: var(--dark-purple-text); /* Text color from the purple palette */
            font-weight: 700;
            padding: 0.9rem 3rem;
            border-radius: 50px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        .btn-hero-yellow:hover {
            background-color: #FFC107; /* Slightly darker yellow on hover */
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }
        .btn-hero-yellow:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 215, 64, 0.5); /* Focus ring for yellow */
            outline: none;
        }

        /* Form control focus */
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 0.25rem rgba(33, 150, 243, 0.25);
        }

        /* Card hover effect */
        .card-hover-effect {
            transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
        }
        .card-hover-effect:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.15);
        }

        /* Nav link hover effect */
        .nav-link.hover-light:hover {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        /* Responsive adjustments for headings */
        @media (max-width: 767.98px) {
            .display-3 {
                font-size: 2.5rem !important;
            }
            .fs-2 {
                font-size: 2rem !important;
            }
            .fs-4 {
                font-size: 1.5rem !important;
            }
            .btn-hero-yellow, .btn-custom-blue {
                padding: 0.7rem 2rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="bg-primary-purple text-white py-3 shadow-lg sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="fs-3 fw-bold rounded px-3 py-1" style="background-color: #512DA8;">Himilo Transfer</h1>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary-purple p-0">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link text-white hover-light mx-2" href="#home">Home</a></li>
                        <li class="nav-item"><a class="nav-link text-white hover-light mx-2" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link text-white hover-light mx-2" href="#" id="navSendMoney">Send Money</a></li>
                        <li class="nav-item"><a class="nav-link text-white hover-light mx-2" href="#about">About Us</a></li>
                        <li class="nav-item"><a class="nav-link text-white hover-light mx-2" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero-gradient text-white py-5 text-center shadow-inner rounded-bottom-4">
        <div class="container py-5">
            <h2 class="display-3 fw-bolder mb-3 animate-fade-in-down">Send Money Globally, Instantly!</h2>
            <p class="lead mb-5 opacity-90 animate-fade-in-up">Secure, Fast, and Reliable Remittance Services for Your Peace of Mind.</p>
            <button id="sendMoneyBtn" class="btn btn-hero-yellow animate-fade-in-up" style="animation-delay: 0.2s;">
                Make a Transaction Now
            </button>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5 bg-white rounded-4 shadow-sm mx-4 my-5 animate-fade-in">
        <div class="container">
            <h2 class="fs-2 fw-bold text-center mb-5 text-dark-purple">Our Comprehensive Services</h2>
            <div class="row g-4 justify-content-center">
                <!-- Service Card 1 -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="card p-4 rounded-3 shadow-sm card-hover-effect border border-light text-center h-100">
                        <div class="text-secondary-blue fs-1 mb-3">💸</div>
                        <h3 class="fs-4 fw-semibold mb-2 text-dark-blue">Fast Money Transfer</h3>
                        <p class="text-muted small">Send money to your loved ones quickly and efficiently, no matter where they are in the world. Our advanced network ensures speedy delivery.</p>
                    </div>
                </div>
                <!-- Service Card 2 -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="card p-4 rounded-3 shadow-sm card-hover-effect border border-light text-center h-100">
                        <div class="text-success fs-1 mb-3">🔒</div>
                        <h3 class="fs-4 fw-semibold mb-2 text-dark-blue">Secure Transactions</h3>
                        <p class="text-muted small">Your security is our top priority. We use state-of-the-art encryption and fraud prevention measures to protect your funds and data.</p>
                    </div>
                </div>
                <!-- Service Card 3 -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="card p-4 rounded-3 shadow-sm card-hover-effect border border-light text-center h-100">
                        <div class="text-info fs-1 mb-3">🌐</div>
                        <h3 class="fs-4 fw-semibold mb-2 text-dark-blue">Global Coverage</h3>
                        <p class="text-muted small">With a vast network of partners, we offer remittance services to over 100 countries worldwide. Reach almost any destination.</p>
                    </div>
                </div>
                <!-- Service Card 4 -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="card p-4 rounded-3 shadow-sm card-hover-effect border border-light text-center h-100">
                        <div class="text-danger fs-1 mb-3">📞</div>
                        <h3 class="fs-4 fw-semibold mb-2 text-dark-blue">24/7 Customer Support</h3>
                        <p class="text-muted small">Our dedicated support team is available around the clock to assist you with any queries or issues you may encounter.</p>
                    </div>
                </div>
                <!-- Service Card 5 -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="card p-4 rounded-3 shadow-sm card-hover-effect border border-light text-center h-100">
                        <div class="text-warning fs-1 mb-3">📱</div>
                        <h3 class="fs-4 fw-semibold mb-2 text-dark-blue">Easy Online Platform</h3>
                        <p class="text-muted small">Our user-friendly website allows you to initiate transactions from the comfort of your home, anytime, anywhere.</p>
                    </div>
                </div>
                <!-- Service Card 6 -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="card p-4 rounded-3 shadow-sm card-hover-effect border border-light text-center h-100">
                        <div class="text-info fs-1 mb-3">📈</div> <!-- Changed from cyan to info for better Bootstrap compatibility -->
                        <h3 class="fs-4 fw-semibold mb-2 text-dark-blue">Competitive Exchange Rates</h3>
                        <p class="text-muted small">We offer highly competitive exchange rates, ensuring your recipients get the most value for your money.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Transaction Form Section (Initially Hidden) -->
    <section id="transaction" class="py-5 bg-light-blue-bg rounded-4 shadow-sm mx-4 my-5 d-none animate-fade-in">
        <div class="container">
            <h2 class="fs-2 fw-bold text-center mb-5 text-dark-purple">Make an Online Transaction Request</h2>
            <div class="card p-4 rounded-4 shadow-lg border border-secondary-blue position-relative mx-auto" style="max-width: 700px;">
                <!-- Close Button for the form -->
                <button id="closeTransactionFormBtn" class="btn-close position-absolute top-0 end-0 m-3 fs-4" aria-label="Close"></button>
                <form id="transactionForm" class="row g-3" action="process_transaction.php" method="POST">
                    <!-- Sender Details -->
                    <div class="col-12 mb-3">
                        <h3 class="fs-4 fw-semibold text-primary-purple border-bottom pb-2 mb-3">Sender Information</h3>
                    </div>
                    <div class="col-md-6">
                        <label for="senderName" class="form-label fw-bold">Sender Full Name:</label>
                        <input type="text" id="senderName" name="senderName" class="form-control rounded-3" placeholder="John Doe" required>
                    </div>
                    <div class="col-md-6">
                        <label for="senderPhone" class="form-label fw-bold">Sender Phone Number:</label>
                        <input type="tel" id="senderPhone" name="senderPhone" class="form-control rounded-3" placeholder="+1234567890" required>
                    </div>
                    <div class="col-md-6">
                        <label for="senderEmail" class="form-label fw-bold">Sender Email (Optional):</label>
                        <input type="email" id="senderEmail" name="senderEmail" class="form-control rounded-3" placeholder="john.doe@example.com">
                    </div>
                    <div class="col-md-6">
                        <label for="senderCountry" class="form-label fw-bold">Sender Country:</label>
                        <input type="text" id="senderCountry" name="senderCountry" class="form-control rounded-3" placeholder="USA" required>
                    </div>

                    <!-- Recipient Details -->
                    <div class="col-12 mt-4 mb-3">
                        <h3 class="fs-4 fw-semibold text-primary-purple border-bottom pb-2 mb-3">Recipient Information</h3>
                    </div>
                    <div class="col-md-6">
                        <label for="recipientName" class="form-label fw-bold">Recipient Full Name:</label>
                        <input type="text" id="recipientName" name="recipientName" class="form-control rounded-3" placeholder="Jane Smith" required>
                    </div>
                    <div class="col-md-6">
                        <label for="recipientPhone" class="form-label fw-bold">Recipient Phone Number:</label>
                        <input type="tel" id="recipientPhone" name="recipientPhone" class="form-control rounded-3" placeholder="+25261234567" required>
                    </div>
                    <div class="col-md-6">
                        <label for="recipientCountry" class="form-label fw-bold">Recipient Country:</label>
                        <input type="text" id="recipientCountry" name="recipientCountry" class="form-control rounded-3" placeholder="Somalia" required>
                    </div>
                    <div class="col-md-6">
                        <label for="recipientCity" class="form-label fw-bold">Recipient City:</label>
                        <input type="text" id="recipientCity" name="recipientCity" class="form-control rounded-3" placeholder="Mogadishu" required>
                    </div>

                    <!-- Transaction Details -->
                    <div class="col-12 mt-4 mb-3">
                        <h3 class="fs-4 fw-semibold text-primary-purple border-bottom pb-2 mb-3">Transaction Details</h3>
                    </div>
                    <div class="col-md-6">
                        <label for="amount" class="form-label fw-bold">Amount to Send:</label>
                        <input type="number" id="amount" name="amount" step="0.01" min="0.01" class="form-control rounded-3" placeholder="100.00" required>
                    </div>
                    <div class="col-md-6">
                        <label for="currency" class="form-label fw-bold">Currency:</label>
                        <select id="currency" name="currency" class="form-select rounded-3" required>
                            <option value="">Select Currency</option>
                            <option value="USD">USD - United States Dollar</option>
                            <option value="EUR">EUR - Euro</option>
                            <option value="GBP">GBP - British Pound</option>
                            <option value="CAD">CAD - Canadian Dollar</option>
                            <option value="AUD">AUD - Australian Dollar</option>
                            <option value="KES">KES - Kenyan Shilling</option>
                            <option value="SOS">SOS - Somali Shilling</option>
                            <!-- Add more currencies as needed -->
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="message" class="form-label fw-bold">Message (Optional):</label>
                        <textarea id="message" name="message" rows="4" class="form-control rounded-3" placeholder="E.g., For family support, gift, etc."></textarea>
                    </div>

                    <div class="col-12 d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-custom-blue">
                            Submit Transaction Request
                        </button>
                    </div>
                </form>
                <!-- Message Box for feedback -->
                <div id="transactionMessageBox" class="d-none mt-3 p-3 rounded text-center fs-5 fw-semibold" role="alert"></div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="py-5 bg-white rounded-4 shadow-sm mx-4 my-5 animate-fade-in">
        <div class="container">
            <h2 class="fs-2 fw-bold text-center mb-5 text-dark-purple">About Himilo Transfer</h2>
            <div class="mx-auto text-muted fs-5 text-center" style="max-width: 800px;">
                <p class="mb-4">
                    Himilo Transfer is a leading provider of secure and efficient money transfer services, dedicated to connecting families and businesses across the globe. With years of experience in the remittance industry, we understand the importance of reliable and fast transfers, especially for those supporting loved ones internationally.
                </p>
                <p class="mb-4">
                    Our mission is to simplify the process of sending and receiving money, offering competitive exchange rates and a robust, secure platform. We pride ourselves on our transparency, excellent customer service, and our commitment to ensuring your money reaches its destination safely and on time.
                </p>
                <p>
                    We leverage cutting-edge technology and a vast network of trusted partners to provide seamless transactions, whether you're sending funds for family support, education, or business purposes. Choose Himilo Transfer for peace of mind and unparalleled service.
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Section (Now a Form) -->
    <section id="contact" class="py-5 bg-primary-purple text-white rounded-4 shadow-sm mx-4 my-5 animate-fade-in">
        <div class="container">
            <h2 class="fs-2 fw-bold text-center mb-5">Contact Us</h2>
            <div class="card p-4 rounded-4 shadow-lg border border-white position-relative mx-auto bg-white text-dark" style="max-width: 700px;">
                <form id="contactForm" class="row g-3" action="process_contact.php" method="POST">
                    <div class="col-md-6">
                        <label for="contactName" class="form-label fw-bold text-primary-purple">Your Name:</label>
                        <input type="text" id="contactName" name="contactName" class="form-control rounded-3" placeholder="Your Full Name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="contactEmail" class="form-label fw-bold text-primary-purple">Your Email:</label>
                        <input type="email" id="contactEmail" name="contactEmail" class="form-control rounded-3" placeholder="your.email@example.com" required>
                    </div>
                    <div class="col-12">
                        <label for="contactSubject" class="form-label fw-bold text-primary-purple">Subject:</label>
                        <input type="text" id="contactSubject" name="contactSubject" class="form-control rounded-3" placeholder="Regarding your services..." required>
                    </div>
                    <div class="col-12">
                        <label for="contactMessage" class="form-label fw-bold text-primary-purple">Message:</label>
                        <textarea id="contactMessage" name="contactMessage" rows="5" class="form-control rounded-3" placeholder="Type your message here..." required></textarea>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-custom-blue">
                            Send Message
                        </button>
                    </div>
                </form>
                <!-- Message Box for contact form feedback -->
                <div id="contactMessageBox" class="d-none mt-3 p-3 rounded text-center fs-5 fw-semibold" role="alert"></div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 text-center rounded-top-4 shadow-inner">
        <div class="container">
            <p class="mb-1">&copy; 2025 Himilo Transfer. All rights reserved.</p>
            <p class="small opacity-75">Designed with ❤️ for secure global transfers.</p>
        </div>
    </footer>

    <!-- Bootstrap JS CDN (Bundle with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Get references to DOM elements
        const sendMoneyBtn = document.getElementById('sendMoneyBtn');
        const navSendMoney = document.getElementById('navSendMoney');
        const transactionSection = document.getElementById('transaction');
        const closeTransactionFormBtn = document.getElementById('closeTransactionFormBtn');
        const transactionMessageBox = document.getElementById('transactionMessageBox');
        const transactionForm = document.getElementById('transactionForm');

        const contactForm = document.getElementById('contactForm');
        const contactMessageBox = document.getElementById('contactMessageBox');

        // Function to show messages for transaction form
        function showTransactionMessage(message, type = 'success') {
            transactionMessageBox.textContent = message;
            transactionMessageBox.classList.remove('d-none', 'alert-success', 'alert-danger');
            if (type === 'success') {
                transactionMessageBox.classList.add('alert-success');
            } else if (type === 'error') {
                transactionMessageBox.classList.add('alert-danger');
            }
            setTimeout(() => {
                transactionMessageBox.classList.add('d-none');
            }, 5000); // Hide after 5 seconds
        }

        // Function to show messages for contact form
        function showContactMessage(message, type = 'success') {
            contactMessageBox.textContent = message;
            contactMessageBox.classList.remove('d-none', 'alert-success', 'alert-danger');
            if (type === 'success') {
                contactMessageBox.classList.add('alert-success');
            } else if (type === 'error') {
                contactMessageBox.classList.add('alert-danger');
            }
            setTimeout(() => {
                contactMessageBox.classList.add('d-none');
            }, 5000); // Hide after 5 seconds
        }

        // Function to show the transaction form
        function showTransactionForm() {
            transactionSection.classList.remove('d-none');
            // Smooth scroll to the transaction section
            transactionSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        // Function to hide the transaction form
        function hideTransactionForm() {
            transactionSection.classList.add('d-none');
        }

        // Event listeners for showing/hiding the transaction form
        sendMoneyBtn.addEventListener('click', showTransactionForm);
        navSendMoney.addEventListener('click', showTransactionForm);
        closeTransactionFormBtn.addEventListener('click', hideTransactionForm);

        // Handle transaction form submission
        transactionForm.addEventListener('submit', async function(event) {
            event.preventDefault(); // Prevent default form submission

            // In a real application, you would send this data to your PHP backend
            // using fetch() or XMLHttpRequest.
            // Example (uncomment and adapt for your PHP endpoint):
            /*
            const formData = new FormData(event.target);
            try {
                const response = await fetch('process_transaction.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json(); // Assuming your PHP returns JSON
                if (result.success) {
                    showTransactionMessage("Your transaction request has been submitted successfully! We will contact you shortly.", 'success');
                    event.target.reset(); // Clear the form
                    hideTransactionForm(); // Hide the form after successful submission
                } else {
                    showTransactionMessage("Failed to submit your request: " + result.message, 'error');
                }
            } catch (e) {
                console.error("Error submitting transaction:", e);
                showTransactionMessage("An error occurred while submitting your request. Please try again.", 'error');
            }
            */

            // For now, just show a client-side success message
            showTransactionMessage("Your transaction request has been submitted successfully! (Backend integration pending)", 'success');
            event.target.reset(); // Clear the form
            hideTransactionForm(); // Hide the form after successful submission
        });

        // Handle contact form submission
        contactForm.addEventListener('submit', async function(event) {
            event.preventDefault(); // Prevent default form submission

            // In a real application, you would send this data to your PHP backend
            // using fetch() or XMLHttpRequest.
            // Example (uncomment and adapt for your PHP endpoint):
            
            const formData = new FormData(event.target);
            try {
                const response = await fetch('process_contact.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json(); // Assuming your PHP returns JSON
                if (result.success) {
                    showContactMessage("Your message has been sent successfully! We will get back to you soon.", 'success');
                    event.target.reset(); // Clear the form
                } else {
                    showContactMessage("Failed to send your message: " + result.message, 'error');
                }
            } catch (e) {
                console.error("Error submitting contact form:", e);
                showContactMessage("An error occurred while sending your message. Please try again.", 'error');
            }
            

            // For now, just show a client-side success message
            showContactMessage("Your message has been sent successfully! (Backend integration pending)", 'success');
            event.target.reset(); // Clear the form
        });
    </script>
</body>
</html>
