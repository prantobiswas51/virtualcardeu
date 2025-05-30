<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VirtualBank - Virtual Cards & Banking Solutions</title>
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
                    <li><a href="{{ route('support') }}">Contact</a></li>

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

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <span class="hero-tag">Next Generation Banking</span>
                <h1>Virtual Banking, <span class="accent">Real Benefits</span></h1>
                <p>Experience the future of financial freedom with secure virtual cards and intelligent banking solutions designed for the digital economy.</p>
                <div class="hero-buttons">
                    <a href="register.html" class="btn-primary">Get Started <i class="fas fa-arrow-right"></i></a>
                    <a href="#features" class="btn-secondary">Explore Features</a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">500K+</span>
                        <span class="stat-label">Users</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">99.9%</span>
                        <span class="stat-label">Uptime</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">4.9/5</span>
                        <span class="stat-label">Rating</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <div class="virtual-card">
                    <div class="card-chip"></div>
                    <div class="card-logo">VirtualBank</div>
                    <div class="card-number">4589 •••• •••• 7285</div>
                    <div class="card-info">
                        <div class="card-holder">
                            <span class="label">Card Holder</span>
                            <span class="value">JOHN DOE</span>
                        </div>
                        <div class="card-expiry">
                            <span class="label">Expires</span>
                            <span class="value">09/26</span>
                        </div>
                    </div>
                    <div class="card-network">
                        <i class="fab fa-cc-visa"></i>
                    </div>
                </div>
                <div class="card-shadow"></div>
                <div class="floating-icon icon-shield"><i class="fas fa-shield-alt"></i></div>
                <div class="floating-icon icon-lock"><i class="fas fa-lock"></i></div>
                <div class="floating-icon icon-globe"><i class="fas fa-globe"></i></div>
            </div>
        </div>
        <div class="hero-wave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,112C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <section class="partners">
        <div class="container">
            <div class="partners-title">Trusted by leading companies worldwide</div>
            <div class="partners-grid">
                <div class="partner-logo"><i class="fab fa-apple"></i> Apple Pay</div>
                <div class="partner-logo"><i class="fab fa-google"></i> Google</div>
                <div class="partner-logo"><i class="fab fa-amazon"></i> Amazon</div>
                <div class="partner-logo"><i class="fab fa-microsoft"></i> Microsoft</div>
                <div class="partner-logo"><i class="fab fa-paypal"></i> PayPal</div>
            </div>
        </div>
    </section>

    <section id="features" class="features">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Core Features</span>
                <h2 class="section-title">Why Choose VirtualBank</h2>
                <p class="section-subtitle">Our cutting-edge platform provides everything you need for seamless financial management</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Bank-Grade Security</h3>
                    <p>Advanced encryption and security protocols protect your money and data at all times.</p>
                    <a href="#" class="feature-link">Learn more <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h3>Virtual Cards</h3>
                    <p>Create unlimited virtual cards for online shopping, subscriptions, and secure payments.</p>
                    <a href="#" class="feature-link">Learn more <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3>Global Payments</h3>
                    <p>Send and receive money worldwide with low fees and competitive exchange rates.</p>
                    <a href="#" class="feature-link">Learn more <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Mobile Banking</h3>
                    <p>Manage your finances from anywhere with our powerful and intuitive mobile app.</p>
                    <a href="#" class="feature-link">Learn more <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="how-it-works">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Simple Process</span>
                <h2 class="section-title">How VirtualBank Works</h2>
                <p class="section-subtitle">Get started in minutes with our straightforward setup process</p>
            </div>
            <div class="steps-container">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Create Your Account</h3>
                        <p>Sign up for free and complete our simple verification process to secure your account.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Link Your Bank</h3>
                        <p>Connect your existing bank account to fund your VirtualBank wallet securely.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Create Virtual Cards</h3>
                        <p>Generate virtual cards for different purposes with custom spending limits.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>Start Transacting</h3>
                        <p>Use your virtual cards for online payments, subscriptions, and global transfers.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="app-showcase">
        <div class="container">
            <div class="showcase-content">
                <span class="section-tag">Mobile Experience</span>
                <h2>Banking in Your Pocket</h2>
                <p>Our intuitive mobile app gives you complete control over your finances anytime, anywhere. Monitor transactions, create cards, and manage your money on the go.</p>
                <ul class="app-features">
                    <li><i class="fas fa-check-circle"></i> Real-time notifications</li>
                    <li><i class="fas fa-check-circle"></i> Instant card creation</li>
                    <li><i class="fas fa-check-circle"></i> Expense tracking</li>
                    <li><i class="fas fa-check-circle"></i> Biometric security</li>
                </ul>
                <div class="app-buttons">
                    <a href="#" class="app-button">
                        <i class="fab fa-apple"></i>
                        <div class="app-button-text">
                            <span>Download on the</span>
                            <strong>App Store</strong>
                        </div>
                    </a>
                    <a href="#" class="app-button">
                        <i class="fab fa-google-play"></i>
                        <div class="app-button-text">
                            <span>Get it on</span>
                            <strong>Google Play</strong>
                        </div>
                    </a>
                </div>
            </div>
            <div class="showcase-image">
                <div class="phone-mockup">
                    <div class="phone-screen">
                        <div class="app-interface">
                            <div class="app-header">
                                <div class="app-logo">VB</div>
                                <div class="app-actions">
                                    <i class="fas fa-bell"></i>
                                    <i class="fas fa-cog"></i>
                                </div>
                            </div>
                            <div class="app-balance">
                                <span class="balance-label">Available Balance</span>
                                <span class="balance-amount">$4,750.85</span>
                            </div>
                            <div class="app-cards">
                                <div class="app-card">
                                    <div class="app-card-top">
                                        <span class="app-card-name">Shopping Card</span>
                                        <span class="app-card-type">VISA</span>
                                    </div>
                                    <div class="app-card-number">••••7285</div>
                                </div>
                            </div>
                            <div class="app-transactions">
                                <div class="app-section-title">Recent Transactions</div>
                                <div class="app-transaction">
                                    <div class="transaction-icon shopping"><i class="fas fa-shopping-bag"></i></div>
                                    <div class="transaction-details">
                                        <span class="transaction-name">Amazon</span>
                                        <span class="transaction-date">Today</span>
                                    </div>
                                    <div class="transaction-amount">-$34.99</div>
                                </div>
                                <div class="app-transaction">
                                    <div class="transaction-icon food"><i class="fas fa-utensils"></i></div>
                                    <div class="transaction-details">
                                        <span class="transaction-name">Starbucks</span>
                                        <span class="transaction-date">Yesterday</span>
                                    </div>
                                    <div class="transaction-amount">-$5.75</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to experience modern banking?</h2>
                <p>Join thousands of satisfied customers who have made the switch to VirtualBank.</p>
                <div class="cta-buttons">
                    <a href="register.html" class="btn-primary">Open Your Account</a>
                    <a href="pricing.html" class="btn-outline">View Pricing</a>
                </div>
            </div>
            <div class="cta-image">
                <div class="cta-card">
                    <div class="card-pulse"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Testimonials</span>
                <h2 class="section-title">What Our Customers Say</h2>
                <p class="section-subtitle">Discover why thousands of users trust VirtualBank for their financial needs</p>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-content">
                        <p>"VirtualBank has transformed how I manage my online purchases. The virtual cards feature is a game-changer for security and organization!"</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">SJ</div>
                        <div>
                            <h4>Sarah J.</h4>
                            <p>Online Entrepreneur</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-content">
                        <p>"The security features give me peace of mind, and the interface is so intuitive. Best banking experience ever. I've recommended it to all my colleagues."</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">MR</div>
                        <div>
                            <h4>Michael R.</h4>
                            <p>Software Developer</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-content">
                        <p>"I can finally manage my international payments without excessive fees. VirtualBank has saved me thousands in transaction costs over the past year alone."</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">ET</div>
                        <div>
                            <h4>Elena T.</h4>
                            <p>Digital Nomad</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">FAQ</span>
                <h2 class="section-title">Frequently Asked Questions</h2>
                <p class="section-subtitle">Find answers to common questions about our services</p>
            </div>
            <div class="faq-grid">
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How secure are virtual cards?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Our virtual cards use advanced encryption and tokenization technology to ensure maximum security. Each card has a unique number and can be limited to specific merchants or amounts, adding extra layers of protection against fraud.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Are there any hidden fees?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>No hidden fees. We believe in complete transparency. All our pricing plans clearly outline what's included, and you'll never be charged for services you don't use. International transfers have a small fee disclosed upfront.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How quickly can I create a new virtual card?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Instantly! You can create a new virtual card in just seconds through our web interface or mobile app. Set spending limits, expiration dates, and specific merchants right away.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>What happens if I lose my phone?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Your account is secure. You can immediately lock your account through our website from any device. Additionally, no sensitive information is stored on your phone, and all actions require authentication.</p>
                    </div>
                </div>
            </div>
            <div class="faq-more">
                <a href="contact.html" class="btn-secondary">Have more questions? Contact us</a>
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

    <script src="{{ asset('js/home.js') }}"></script>

</body>
</html> 