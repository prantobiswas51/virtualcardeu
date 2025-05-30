console.log('Home.js');


document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('nav');
    
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            nav.classList.toggle('active');
            this.classList.toggle('active');
        });
    }
    
    // FAQ accordion functionality
    const faqItems = document.querySelectorAll('.faq-item');
    
    if (faqItems.length > 0) {
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');
            
            // Initially hide all answers
            answer.style.maxHeight = '0';
            answer.style.overflow = 'hidden';
            answer.style.transition = 'max-height 0.3s ease';
            
            question.addEventListener('click', () => {
                // Toggle active class
                item.classList.toggle('active');
                
                // Toggle answer visibility
                if (item.classList.contains('active')) {
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                    answer.style.padding = '1.5rem';
                } else {
                    answer.style.maxHeight = '0';
                    answer.style.padding = '0 1.5rem';
                }
            });
        });
    }
    
    // Card floating effect enhancement
    const virtualCard = document.querySelector('.virtual-card');
    if (virtualCard) {
        document.addEventListener('mousemove', function(e) {
            if (window.innerWidth > 768) {
                const mouseX = e.clientX;
                const mouseY = e.clientY;
                
                const rect = virtualCard.getBoundingClientRect();
                const cardCenterX = rect.left + rect.width / 2;
                const cardCenterY = rect.top + rect.height / 2;
                
                const deltaX = (mouseX - cardCenterX) / 25;
                const deltaY = (mouseY - cardCenterY) / 25;
                
                virtualCard.style.transform = `rotateY(${deltaX}deg) rotateX(${-deltaY}deg)`;
                virtualCard.style.transition = 'transform 0.1s ease';
            }
        });

        // Reset card position when mouse leaves the window
        document.addEventListener('mouseleave', function() {
            virtualCard.style.transform = 'rotateY(0) rotateX(0)';
            virtualCard.style.transition = 'transform 0.5s ease';
        });
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80, // Offset for fixed header
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Animate elements on scroll
    const animateOnScroll = () => {
        const elements = document.querySelectorAll('.feature-card, .testimonial-card, .step, .faq-item');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementPosition < windowHeight * 0.85) {
                element.classList.add('visible');
            }
        });
    };
    
    // Add scroll event listener
    window.addEventListener('scroll', animateOnScroll);
    
    // Call once to check for elements already in view
    animateOnScroll();
    
    // Form validation
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                    
                    const errorMessage = field.getAttribute('data-error-message') || 'This field is required';
                    let errorElement = field.nextElementSibling;
                    
                    if (!errorElement || !errorElement.classList.contains('error-message')) {
                        errorElement = document.createElement('div');
                        errorElement.className = 'error-message';
                        field.parentNode.insertBefore(errorElement, field.nextSibling);
                    }
                    
                    errorElement.textContent = errorMessage;
                } else {
                    field.classList.remove('error');
                    const errorElement = field.nextElementSibling;
                    if (errorElement && errorElement.classList.contains('error-message')) {
                        errorElement.remove();
                    }
                }
            });
            
            // Email validation
            const emailField = form.querySelector('input[type="email"]');
            if (emailField && emailField.value.trim()) {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(emailField.value.trim())) {
                    isValid = false;
                    emailField.classList.add('error');
                    
                    let errorElement = emailField.nextElementSibling;
                    if (!errorElement || !errorElement.classList.contains('error-message')) {
                        errorElement = document.createElement('div');
                        errorElement.className = 'error-message';
                        emailField.parentNode.insertBefore(errorElement, emailField.nextSibling);
                    }
                    
                    errorElement.textContent = 'Please enter a valid email address';
                }
            }
            
            if (!isValid) {
                event.preventDefault();
            }
        });
        
        // Clear error on input
        const formFields = form.querySelectorAll('input, textarea, select');
        formFields.forEach(field => {
            field.addEventListener('input', function() {
                this.classList.remove('error');
                const errorElement = this.nextElementSibling;
                if (errorElement && errorElement.classList.contains('error-message')) {
                    errorElement.remove();
                }
            });
        });
    });
    
    // Initialize pricing controls
    initCurrencySelector();
    
    // Pricing toggle functionality
    initPricingToggle();
    
    // Make sure monthly prices are shown by default
    showPrices('monthly', 'usd');
    
    // Testimonials slider (if needed)
    const testimonialsContainer = document.querySelector('.testimonials-container');
    if (testimonialsContainer && testimonialsContainer.classList.contains('slider')) {
        // Simple slider functionality can be added here
        // This is just a placeholder for potential slider functionality
    }
    
    // Newsletter form handling
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const emailInput = this.querySelector('input[type="email"]');
            const email = emailInput.value.trim();
            
            if (!email) return;
            
            // Here you would typically send this to a server
            // For demo purposes, we'll just show a success message
            
            // Create success message
            const successMessage = document.createElement('div');
            successMessage.className = 'newsletter-success';
            successMessage.textContent = 'Thank you for subscribing!';
            
            // Replace form with success message
            this.style.display = 'none';
            this.parentNode.appendChild(successMessage);
            
            // Optional: Reset form and show it again after some time
            setTimeout(() => {
                emailInput.value = '';
                this.style.display = 'flex';
                if (successMessage.parentNode) {
                    successMessage.parentNode.removeChild(successMessage);
                }
            }, 3000);
        });
    }
});

function initCurrencySelector() {
    const currencyButtons = document.querySelectorAll('.currency-btn');
    if (currencyButtons.length > 0) {
        // Set USD as default active currency
        const usdButton = document.querySelector('.currency-btn[data-currency="usd"]');
        if (usdButton) {
            usdButton.classList.add('active');
        }
        
        currencyButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                currencyButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Get the selected currency
                const currency = this.getAttribute('data-currency');
                
                // Get the current billing period
                const isPriceYearly = document.querySelector('.pricing-toggle').checked;
                const period = isPriceYearly ? 'yearly' : 'monthly';
                
                // Show selected currency prices
                showPrices(period, currency);
            });
        });
    }
}

function initPricingToggle() {
    const pricingToggle = document.querySelector('.pricing-toggle');
    if (pricingToggle) {
        // Make sure it's unchecked by default (monthly pricing)
        pricingToggle.checked = false;
        
        pricingToggle.addEventListener('change', function() {
            // Get the current currency
            const activeCurrencyBtn = document.querySelector('.currency-btn.active');
            const currency = activeCurrencyBtn ? activeCurrencyBtn.getAttribute('data-currency') : 'usd';
            
            // Show appropriate prices
            if (this.checked) {
                showPrices('yearly', currency);
            } else {
                showPrices('monthly', currency);
            }
        });
    }
}

function showPrices(period, currency) {
    // Hide all pricing elements first
    document.querySelectorAll('.price-monthly, .price-yearly').forEach(el => {
        el.style.display = 'none';
    });
    
    // Show the selected period's pricing elements
    const priceElements = document.querySelectorAll(`.price-${period}`);
    priceElements.forEach(el => {
        el.style.display = 'block';
    });
    
    // Hide all currency spans in pricing cards
    document.querySelectorAll('.price-usd, .price-eur, .price-gbp').forEach(el => {
        el.style.display = 'none';
    });
    
    // Show the selected currency spans in pricing cards
    document.querySelectorAll(`.price-${currency}`).forEach(el => {
        el.style.display = 'inline';
    });
    
    // Handle the pricing table if it exists
    const pricingTable = document.querySelector('.pricing-table');
    if (pricingTable) {
        // Highlight the selected currency column
        const currencyHeaders = pricingTable.querySelectorAll('th');
        currencyHeaders.forEach((header, index) => {
            // Skip the first and last columns (Card Type and Features/Action)
            if (index > 0 && index < currencyHeaders.length - 2) {
                header.classList.remove('active-currency');
                const headerCurrency = header.querySelector(`.currency-icon.${currency}`);
                if (headerCurrency) {
                    header.classList.add('active-currency');
                }
            }
        });
        
        // Optional: Add a visual indicator for the selected currency column
        const tableRows = pricingTable.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            const cells = row.querySelectorAll('td');
            cells.forEach((cell, index) => {
                // Cells at index 1, 2, 3 are the currency price cells (USD, EUR, GBP)
                if (index >= 1 && index <= 3) {
                    cell.classList.remove('active-currency');
                    if ((currency === 'usd' && index === 1) || 
                        (currency === 'eur' && index === 2) || 
                        (currency === 'gbp' && index === 3)) {
                        cell.classList.add('active-currency');
                    }
                }
            });
        });
    }
} 