<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing - VirtualBank</title>
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

    <section class="pricing">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Subscription Plans</span>
                <h2 class="section-title">Choose Your Plan</h2>
                <p class="section-subtitle">Select the plan that matches your financial needs and preferences</p>
            </div>
            
            
<!--             
            <div class="section-header card-types-header">
                <span class="section-tag">Pricing Details</span>
                <h2 class="section-title">Comprehensive Pricing Table</h2>
                <p class="section-subtitle">Compare all options across card types and currencies</p>
            </div> -->
            
            <div class="pricing-table-container">
                <table class="pricing-table">
                    <thead>
                        <tr>
                            <th>Card Type</th>
                            <th>
                                <div class="currency-icon usd">
                                    <i class="fas fa-dollar-sign"></i>
                                    <span>USD</span>
                                </div>
                            </th>
                            <th>
                                <div class="currency-icon eur">
                                    <i class="fas fa-euro-sign"></i>
                                    <span>EUR</span>
                                </div>
                            </th>
                            <th>
                                <div class="currency-icon gbp">
                                    <i class="fas fa-pound-sign"></i>
                                    <span>GBP</span>
                                </div>
                            </th>
                            <th>Features</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Temporary Card Row -->
                        <tr>
                            <td>
                                <div class="table-card-info">
                                    <div class="table-card-icon">
                                        <i class="fas fa-stopwatch"></i>
                                    </div>
                                    <div>
                                        <h3>Temporary Card</h3>
                                        <p>Valid for 30 days</p>
                                    </div>
                                </div>
                            </td>
                            <td class="price-cell">
                                <div class="price-amount">$4.99</div>
                                <div class="price-period">per card</div>
                            </td>
                            <td class="price-cell">
                                <div class="price-amount">€4.79</div>
                                <div class="price-period">per card</div>
                            </td>
                            <td class="price-cell">
                                <div class="price-amount">£4.29</div>
                                <div class="price-period">per card</div>
                            </td>
                            <td>
                                <ul class="table-features">
                                    <li><i class="fas fa-check"></i> Single or multiple use</li>
                                    <li><i class="fas fa-check"></i> Custom spending limits</li>
                                    <li><i class="fas fa-check"></i> Auto-expiry for safety</li>
                                </ul>
                            </td>
                            <td>
                                <a href="register.html" class="btn-primary btn-table">Get Started</a>
                            </td>
                        </tr>
                        
                        <!-- Reloadable Card Row -->
                        <tr>
                            <td>
                                <div class="table-card-info">
                                    <div class="table-card-icon">
                                        <i class="fas fa-sync-alt"></i>
                                    </div>
                                    <div>
                                        <h3>Reloadable Card</h3>
                                        <p>Unlimited reloads</p>
                                    </div>
                                </div>
                            </td>
                            <td class="price-cell">
                                <div class="price-amount">$7.99</div>
                                <div class="price-period">monthly</div>
                            </td>
                            <td class="price-cell">
                                <div class="price-amount">€7.69</div>
                                <div class="price-period">monthly</div>
                            </td>
                            <td class="price-cell">
                                <div class="price-amount">£6.89</div>
                                <div class="price-period">monthly</div>
                            </td>
                            <td>
                                <ul class="table-features">
                                    <li><i class="fas fa-check"></i> No transaction fees</li>
                                    <li><i class="fas fa-check"></i> Spending controls</li>
                                    <li><i class="fas fa-check"></i> Instant top-ups</li>
                                </ul>
                            </td>
                            <td>
                                <a href="register.html" class="btn-primary btn-table">Get Started</a>
                            </td>
                        </tr>
                        
                        <!-- Gift Card Row -->
                        <tr>
                            <td>
                                <div class="table-card-info">
                                    <div class="table-card-icon">
                                        <i class="fas fa-gift"></i>
                                    </div>
                                    <div>
                                        <h3>Gift Card</h3>
                                        <p>Customizable designs</p>
                                    </div>
                                </div>
                            </td>
                            <td class="price-cell">
                                <div class="price-amount">$2.99</div>
                                <div class="price-period">+ card value</div>
                            </td>
                            <td class="price-cell">
                                <div class="price-amount">€2.89</div>
                                <div class="price-period">+ card value</div>
                            </td>
                            <td class="price-cell">
                                <div class="price-amount">£2.59</div>
                                <div class="price-period">+ card value</div>
                            </td>
                            <td>
                                <ul class="table-features">
                                    <li><i class="fas fa-check"></i> Digital delivery option</li>
                                    <li><i class="fas fa-check"></i> 5-year expiry</li>
                                    <li><i class="fas fa-check"></i> Recipient activation</li>
                                </ul>
                            </td>
                            <td>
                                <a href="register.html" class="btn-primary btn-table">Get Started</a>
                            </td>
                        </tr>
                        
                        <!-- USD Bank Transfer Row -->
                        <tr>
                            <td>
                                <div class="table-card-info">
                                    <div class="table-card-icon">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <div>
                                        <h3>USD Bank Account</h3>
                                        <p>U.S. banking services</p>
                                    </div>
                                </div>
                            </td>
                            <td class="price-cell featured-price">
                                <div class="price-amount">$5.99</div>
                                <div class="price-period">monthly</div>
                            </td>
                            <td class="price-cell">
                                <div class="price-amount">€5.79</div>
                                <div class="price-period">monthly</div>
                            </td>
                            <td class="price-cell">
                                <div class="price-amount">£5.19</div>
                                <div class="price-period">monthly</div>
                            </td>
                            <td>
                                <ul class="table-features">
                                    <li><i class="fas fa-check"></i> U.S. routing number</li>
                                    <li><i class="fas fa-check"></i> ACH transfers</li>
                                    <li><i class="fas fa-check"></i> Check deposit</li>
                                </ul>
                            </td>
                            <td>
                                <a href="register.html" class="btn-primary btn-table">Get Started</a>
                            </td>
                        </tr>
                        
                        <!-- EUR Bank Transfer Row -->
                        <tr>
                            <td>
                                <div class="table-card-info">
                                    <div class="table-card-icon">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <div>
                                        <h3>EUR Bank Account</h3>
                                        <p>European banking services</p>
                                    </div>
                                </div>
                            </td>
                            <td class="price-cell">
                                <div class="price-amount">$6.49</div>
                                <div class="price-period">monthly</div>
                            </td>
                            <td class="price-cell featured-price">
                                <div class="price-amount">€5.99</div>
                                <div class="price-period">monthly</div>
                            </td>
                            <td class="price-cell">
                                <div class="price-amount">£5.49</div>
                                <div class="price-period">monthly</div>
                            </td>
                            <td>
                                <ul class="table-features">
                                    <li><i class="fas fa-check"></i> IBAN account number</li>
                                    <li><i class="fas fa-check"></i> SEPA transfers</li>
                                    <li><i class="fas fa-check"></i> EU direct deposits</li>
                                </ul>
                            </td>
                            <td>
                                <a href="register.html" class="btn-primary btn-table">Get Started</a>
                            </td>
                        </tr>
                        
                        <!-- GBP Bank Transfer Row -->
                        <tr>
                            <td>
                                <div class="table-card-info">
                                    <div class="table-card-icon">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <div>
                                        <h3>GBP Bank Account</h3>
                                        <p>UK banking services</p>
                                    </div>
                                </div>
                            </td>
                            <td class="price-cell">
                                <div class="price-amount">$6.49</div>
                                <div class="price-period">monthly</div>
                            </td>
                            <td class="price-cell">
                                <div class="price-amount">€5.99</div>
                                <div class="price-period">monthly</div>
                            </td>
                            <td class="price-cell featured-price">
                                <div class="price-amount">£5.49</div>
                                <div class="price-period">monthly</div>
                            </td>
                            <td>
                                <ul class="table-features">
                                    <li><i class="fas fa-check"></i> UK account number</li>
                                    <li><i class="fas fa-check"></i> Faster Payments</li>
                                    <li><i class="fas fa-check"></i> BACS transfers</li>
                                </ul>
                            </td>
                            <td>
                                <a href="register.html" class="btn-primary btn-table">Get Started</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="pricing-note">
                <p>Need a custom plan? <a href="contact.html">Contact our team</a> for enterprise solutions.</p>
            </div>
        </div>
    </section>

    <section class="currency-advantages">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Global Support</span>
                <h2 class="section-title">Multi-Currency Advantages</h2>
                <p class="section-subtitle">Benefits of our multi-currency virtual cards</p>
            </div>
            
            <div class="advantages-grid">
                <div class="advantage-card">
                    <div class="advantage-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3>Worldwide Acceptance</h3>
                    <p>Use your virtual cards anywhere in the world with automatic currency conversion at competitive rates.</p>
                </div>
                
                <div class="advantage-card">
                    <div class="advantage-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3>Save on Exchange Fees</h3>
                    <p>Avoid excessive bank charges by holding and spending in the local currency of your choice.</p>
                </div>
                
                <div class="advantage-card">
                    <div class="advantage-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Enhanced Security</h3>
                    <p>Create separate cards for different currencies to better manage and protect your finances.</p>
                </div>
                
                <div class="advantage-card">
                    <div class="advantage-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Currency Strategy</h3>
                    <p>Take advantage of favorable exchange rates by switching between currencies strategically.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="faq">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">FAQ</span>
                <h2 class="section-title">Frequently Asked Questions</h2>
                <p class="section-subtitle">Find answers to common questions about our pricing and cards</p>
            </div>
            
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How does virtual card security work?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Our virtual cards use bank-grade encryption and generate unique card numbers for each transaction. This means even if your card details are compromised, they can't be used for unauthorized purchases.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Can I upgrade or downgrade my plan later?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, you can change your plan at any time. When upgrading, you'll be charged the prorated difference. When downgrading, your new rate will apply at the next billing cycle.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Are there any transaction fees?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>There are no hidden transaction fees for standard usage. International transactions may incur a small currency conversion fee of 1%, which is significantly lower than most traditional banks.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>What's the difference between temporary and reloadable cards?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Temporary cards are valid for 30 days and are ideal for one-time or short-term payments. Reloadable cards can be topped up repeatedly and function more like traditional debit cards with enhanced security features.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>How do currency conversions work?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>We use real-time exchange rates with a small 1% conversion fee, which is much lower than standard bank rates. Premium and Business plans include multiple currency wallets that allow you to hold balances in different currencies.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Is my money protected?</h3>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, all funds are held in regulated financial institutions and are protected by industry-standard safeguards. Your actual bank account details are never shared when you use our virtual cards.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to get started with VirtualBank?</h2>
                <p>Choose a plan that works for you and experience the future of banking today.</p>
                <div class="cta-buttons">
                    <a href="register.html" class="btn-primary">Open Your Account</a>
                    <a href="contact.html" class="btn-outline">Contact Sales</a>
                </div>
            </div>
            <div class="cta-image">
                <div class="cta-card">
                    <div class="card-pulse"></div>
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