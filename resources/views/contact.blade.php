<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - VirtualBank</title>
    <link rel="stylesheet" href="{{ asset('/css/home.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="{{ route('home') }}">VirtualBank</a>
            </div>
            <nav>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('pricing') }}">Pricing</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>

                    @auth
                        <li><a href="{{ route('dashboard') }}" class="btn-login">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="btn-login">Login</a></li>
                        <li><a href="{{ route('register') }}" class="btn-primary">Register</a></li>
                    @endauth
                </ul>
            </nav>
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <section class="contact-hero">
        <div class="container">
            <div class="contact-hero-content">
                <span class="contact-tag">Get in Touch</span>
                <h1>We'd Love to <span class="accent">Hear</span> From You</h1>
                <p>Our dedicated team is ready to assist you with any questions, feedback, or support needs.</p>
            </div>
            <div class="contact-cards">
                <div class="contact-card">
                    <div class="contact-card-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>Customer Support</h3>
                    <p>Get help with your account, transactions, or technical issues</p>
                    <div class="contact-card-info">
                        <span><i class="fas fa-envelope"></i> support@virtualbank.com</span>
                        <span><i class="fas fa-phone"></i> +1 (555) 123-4567</span>
                    </div>
                </div>
                <div class="contact-card">
                    <div class="contact-card-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Business Inquiries</h3>
                    <p>Explore partnerships, integrations, or enterprise solutions</p>
                    <div class="contact-card-info">
                        <span><i class="fas fa-envelope"></i> partnerships@virtualbank.com</span>
                        <span><i class="fas fa-phone"></i> +1 (555) 987-6543</span>
                    </div>
                </div>
                <div class="contact-card">
                    <div class="contact-card-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3>Careers</h3>
                    <p>Join our innovative team and help shape the future of banking</p>
                    <div class="contact-card-info">
                        <span><i class="fas fa-envelope"></i> careers@virtualbank.com</span>
                        <span><i class="fas fa-link"></i> View open positions</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-hero-shape"></div>
    </section>

    <section class="contact-form-section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-form-wrapper">
                    <div class="contact-form-header">
                        <h2>Send Us a Message</h2>
                        <p>Fill out the form below and we'll get back to you as soon as possible.</p>
                    </div>
                    <form id="contactForm" class="contact-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-user"></i>
                                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Phone Number (Optional)</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-phone"></i>
                                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-tag"></i>
                                    <select id="subject" name="subject" required>
                                        <option value="" disabled selected>Select a subject</option>
                                        <option value="general">General Inquiry</option>
                                        <option value="support">Technical Support</option>
                                        <option value="billing">Billing Question</option>
                                        <option value="partnership">Partnership Opportunity</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <div class="input-with-icon textarea-icon">
                                <i class="fas fa-comment-alt"></i>
                                <textarea id="message" name="message" placeholder="Type your message here..." required></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group checkbox-group">
                            <input type="checkbox" id="privacy" name="privacy" required>
                            <label for="privacy">I agree to the <a href="privacy.html">Privacy Policy</a> and consent to being contacted regarding my inquiry.</label>
                        </div>
                        
                        <button type="submit" class="btn-primary btn-submit">
                            <span>Send Message</span>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
                
                <div class="contact-info-wrapper">
                    <div class="contact-office">
                        <h3>Our Office</h3>
                        <div class="office-image">
                            <img src="images/office.jpg" alt="VirtualBank Office" onerror="this.src='https://via.placeholder.com/500x300?text=VirtualBank+Office'">
                        </div>
                        <div class="office-details">
                            <div class="office-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <h4>Address</h4>
                                    <p>123 Finance Street</p>
                                    <p>Digital City, DC 10101</p>
                                </div>
                            </div>
                            <div class="office-item">
                                <i class="fas fa-clock"></i>
                                <div>
                                    <h4>Business Hours</h4>
                                    <p>Monday-Friday: 9am-6pm EST</p>
                                    <p>Saturday: 10am-2pm EST</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-socials">
                        <h3>Connect With Us</h3>
                        <p>Follow us on social media for updates, tips, and more</p>
                        <div class="social-icons-large">
                            <a href="#" class="social-icon facebook">
                                <i class="fab fa-facebook-f"></i>
                                <span>Facebook</span>
                            </a>
                            <a href="#" class="social-icon twitter">
                                <i class="fab fa-twitter"></i>
                                <span>Twitter</span>
                            </a>
                            <a href="#" class="social-icon instagram">
                                <i class="fab fa-instagram"></i>
                                <span>Instagram</span>
                            </a>
                            <a href="#" class="social-icon linkedin">
                                <i class="fab fa-linkedin-in"></i>
                                <span>LinkedIn</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="map-section">
        <div class="map-container interactive-map">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.30591910525!2d-74.25986432970718!3d40.697149422113014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sus!4v1652892234220!5m2!1sen!2sus" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <div class="map-overlay">
                <div class="map-card">
                    <h3><i class="fas fa-map-marker-alt"></i> Find Us</h3>
                    <p>123 Finance Street</p>
                    <p>Digital City, DC 10101</p>
                    <a href="https://goo.gl/maps/123" target="_blank" class="btn-secondary btn-directions">
                        <i class="fas fa-directions"></i> Get Directions
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-mini">
        <div class="container">
            <div class="faq-mini-header">
                <h2>Frequently Asked Questions</h2>
                <p>Can't find what you're looking for? <a href="#contactForm">Contact us</a> directly.</p>
            </div>
            <div class="faq-mini-grid">
                <div class="faq-mini-item">
                    <h3><i class="fas fa-question-circle"></i> How quickly will I receive a response?</h3>
                    <p>We aim to respond to all inquiries within 24 hours during business days. For urgent matters, please call our customer support directly.</p>
                </div>
                <div class="faq-mini-item">
                    <h3><i class="fas fa-question-circle"></i> Do you offer in-person consultations?</h3>
                    <p>Yes, we offer in-person consultations at our main office by appointment only. Please contact us to schedule a meeting.</p>
                </div>
                <div class="faq-mini-item">
                    <h3><i class="fas fa-question-circle"></i> How can I report a technical issue?</h3>
                    <p>For technical issues, select "Technical Support" in the contact form subject line or email support@virtualbank.com with details of the problem.</p>
                </div>
                <div class="faq-mini-item">
                    <h3><i class="fas fa-question-circle"></i> Are there regional offices outside Digital City?</h3>
                    <p>We currently maintain our headquarters in Digital City with plans to expand to other locations. Remote support is available worldwide.</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-column">
                        <div class="footer-logo">
                            <a href="index.html">VirtualBank</a>
                        </div>
                        <p>Next-generation virtual banking and card services for the digital economy.</p>
                        <div class="social-icons">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="footer-column">
                        <h3>Company</h3>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="pricing.html">Pricing</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3>Products</h3>
                        <ul>
                            <li><a href="#">Virtual Cards</a></li>
                            <li><a href="#">Banking App</a></li>
                            <li><a href="#">Business Accounts</a></li>
                            <li><a href="#">Currency Exchange</a></li>
                            <li><a href="#">Financial Tools</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3>Resources</h3>
                        <ul>
                            <li><a href="#">Help Center</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Developers</a></li>
                            <li><a href="privacy.html">Privacy Policy</a></li>
                            <li><a href="terms.html">Terms & Conditions</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3>Contact</h3>
                        <ul class="contact-info">
                            <li><i class="fas fa-envelope"></i> support@virtualbank.com</li>
                            <li><i class="fas fa-phone"></i> +1 (555) 123-4567</li>
                            <li><i class="fas fa-map-marker-alt"></i> 123 Finance Street, Digital City</li>
                        </ul>
                        <div class="newsletter">
                            <h4>Subscribe to our newsletter</h4>
                            <form class="newsletter-form">
                                <input type="email" placeholder="Your email address" required>
                                <button type="submit"><i class="fas fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <p>&copy; 2023 VirtualBank. All rights reserved.</p>
                    <div class="footer-bottom-links">
                        <a href="#">Security</a>
                        <a href="#">Accessibility</a>
                        <a href="#">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html> 