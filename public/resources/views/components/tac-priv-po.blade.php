<style>
    :root {
        --primary-color: #4f46e5;
        --secondary-color: #06b6d4;
        --success-color: #10b981;
        --text-dark: #1f2937;
        --text-black: #000;
        --text-light: #6b7280;
        --border-color: #e5e7eb;
        --bg-light: #f8fafc;
    }

    .modal-content {
        border: none;
        border-radius: 20px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 1.5rem 2rem;
        border-bottom: none;
    }

    .modal-header h1 {
        font-weight: 700;
        font-size: 1.5rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
        font-size: 1.2rem;
    }

    .btn-close:hover {
        opacity: 1;
        transform: scale(1.1);
    }

    .modal-body {
        padding: 0;
        background-color: #fff;
    }

    .nav-tabs {
        border-bottom: 2px solid var(--border-color);
        padding: 0 2rem;
        background-color: var(--bg-light);
    }

    .nav-tabs .nav-link {
        border: none;
        color: var(--text-dark) !important;
        font-weight: 600;
        padding: 1rem 1.5rem;
        margin-bottom: -2px;
        border-radius: 0;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: var(--primary-color);
        background-color: rgba(79, 70, 229, 0.05);
    }

    .nav-tabs .nav-link.active {
        color: var(--primary-color);
        border-bottom: 2px solid var(--primary-color);
        background-color: white;
    }

    .tab-content {
        padding: 2rem;
        max-height: 60vh;
        overflow-y: auto;
    }

    .content-section {
        margin-bottom: 2rem;
    }

    .content-section h3 {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .content-section h4 {
        color: var(--primary-color);
        font-weight: 600;
        font-size: 1.1rem;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }

    .content-section p,
    .content-section li {
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 0.75rem;
    }

    .content-section ul {
        padding-left: 1.5rem;
    }

    .highlight-box {
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.05) 0%, rgba(6, 182, 212, 0.05) 100%);
        border-left: 4px solid var(--primary-color);
        padding: 1rem 1.5rem;
        margin: 1rem 0;
        border-radius: 0 8px 8px 0;
    }

    .contact-info {
        background: var(--bg-light);
        border-radius: 12px;
        padding: 1.5rem;
        margin: 1.5rem 0;
    }

    .contact-info h4 {
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
    }

    .contact-item i {
        color: var(--primary-color);
        width: 16px;
    }

    .modal-footer {
        background-color: var(--bg-light);
        border-top: 1px solid var(--border-color);
        padding: 1.5rem 2rem;
        gap: 1rem;
    }

    .btn-sta {
        background-color: var(--text-light);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-sta:hover {
        background-color: var(--text-dark);
        transform: translateY(-1px);
    }

    .btn-success {
        background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }

    .effective-date {
        background: rgba(79, 70, 229, 0.1);
        color: var(--primary-color);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 1rem;
    }

    /* Custom scrollbar */
    .tab-content::-webkit-scrollbar {
        width: 6px;
    }

    .tab-content::-webkit-scrollbar-track {
        background: var(--border-color);
        border-radius: 3px;
    }

    .tab-content::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 3px;
    }

    .tab-content::-webkit-scrollbar-thumb:hover {
        background: #3730a3;
    }
</style>

<div class="modal fade" id="PrivPoTaC" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="staticBackdropLabel">
                    <i class="fas fa-shield-alt"></i>
                    Privacy Policy & Terms of Service
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="policyTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active btn btn-info" id="privacy-tab" data-bs-toggle="tab" data-bs-target="#privacy"
                            type="button" role="tab">
                            <i class="fas fa-user-shield"></i> Privacy Policy
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link btn btn-info" id="terms-tab" data-bs-toggle="tab" data-bs-target="#terms"
                            type="button" role="tab">
                            <i class="fas fa-file-contract"></i> Terms & Conditions
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="policyTabContent">
                    <!-- Privacy Policy Tab -->
                    <div class="tab-pane fade show active" id="privacy" role="tabpanel">
                        <span class="effective-date">
                            <i class="fas fa-calendar-alt"></i> Effective Date: July 18, 2025
                        </span>

                        <div class="content-section">
                            <h3><i class="fas fa-info-circle"></i> Introduction</h3>
                            <p>This Privacy Policy outlines how MediaOne Tix collects, uses, stores, and protects your
                                personal information in accordance with the Philippine Data Privacy Act of 2012
                                (Republic Act No. 10173) ("DPA") and its Implementing Rules and Regulations ("IRR").</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-database"></i> What Personal Information Do We Collect?</h3>
                            <p><strong>Basic information:</strong> Full name, contact number, email address, date of
                                birth.</p>
                            <p><strong>Account Information:</strong> Username, password, login information.</p>
                            <p><strong>Transaction Data:</strong> Order history, ticket purchases, and payment-related
                                details.</p>
                            <p><strong>Technical Data:</strong> IP address, device information, browser type, and
                                website usage through cookies and analytics tools.</p>
                            <p><strong>Sensitive Personal Information (if applicable):</strong> Any medical, biometric,
                                or financial information that you voluntarily provide, subject to applicable laws.</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-download"></i> How We Collect Your Personal Information</h3>
                            <p>We collect personal data in the following ways:</p>
                            <ul>
                                <li>When you register for an account on our website or app.</li>
                                <li>When you purchase event tickets or engage in other transactions.</li>
                                <li>When you contact our support team or communicate with us.</li>
                                <li>When you browse our website and interact with our services via cookies or tracking
                                    technologies.</li>
                            </ul>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-cogs"></i> Purposes of Collecting Personal Information</h3>
                            <p>Your personal information is used for the following purposes:</p>
                            <ul>
                                <li>To process and fulfil your ticket purchases and transactions.</li>
                                <li>To facilitate payments through our authorized payment provider, Dragonpay.</li>
                                <li>To deliver your digital tickets and provide relevant updates.</li>
                                <li>To provide customer service and support.</li>
                                <li>To enhance and personalize your user experience.</li>
                                <li>To send event updates, promotions, and marketing messages (with your consent).</li>
                                <li>To comply with applicable legal obligations and regulatory requirements.</li>
                            </ul>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-share-alt"></i> Use of Third-Party Services</h3>
                            <p>We may share your information with third-party providers strictly for the following
                                purposes:</p>
                            <div class="highlight-box">
                                <p><strong>Payment Processing:</strong> Your payment details are processed securely
                                    through Dragonpay, our official payment partner. We do not store your credit/debit
                                    card or bank details on our servers. Dragonpay operates under its own privacy and
                                    security policies.</p>
                            </div>
                            <p><strong>Technical Support and Analytics:</strong> Providers assisting with analytics,
                                infrastructure hosting, and customer service.</p>
                            <p><strong>Marketing Platforms:</strong> Partners who help us manage marketing
                                communications (only with your consent).</p>
                            <p>All data shared with third-party providers is subject to strict confidentiality and data
                                protection agreements.</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-users"></i> Sharing of Personal Information</h3>
                            <p>We may share your personal data with our trusted third-party service providers who assist
                                us in operating our business, such as payment gateways, shipping carriers, and marketing
                                platforms.</p>
                            <p>We will only share your personal information with these third parties with appropriate
                                safeguards and only to the extent necessary to achieve the purposes outlined above.</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-user-check"></i> Your Privacy Rights</h3>
                            <p><strong>Access:</strong> You have the right to access your personal information and
                                request a copy.</p>
                            <p><strong>Rectification:</strong> You can request to correct any inaccurate or incomplete
                                personal information.</p>
                            <p><strong>Erasure:</strong> You can request to delete your personal information, subject to
                                certain legal exceptions.</p>
                            <p><strong>Objection:</strong> You can object to the processing of your personal information
                                in certain circumstances.</p>
                            <p><strong>Restriction:</strong> You can request to restrict the processing of your personal
                                information.</p>

                            <h4>How to Exercise Your Rights:</h4>
                            <p>You may exercise your data privacy rights or raise any concerns by contacting us at:</p>
                            <p>Email: ruinze@mediaoneph.com<br>
                                Phone: +63 999 223 4498</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-lock"></i> Data Security</h3>
                            <p>We implement industry-standard security measures, including encryption, access controls,
                                and secure data storage, to protect your information from unauthorised access, loss,
                                misuse, or alteration.</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-clock"></i> Data Retention</h3>
                            <p>We will retain your personal information for as long as necessary to fulfill the purposes
                                for which it was collected, considering legal requirements and our business needs. After
                                this period, your data will be securely deleted or anonymised.</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-edit"></i> Changes to this Privacy Policy</h3>
                            <p>This Privacy Policy may be updated periodically to reflect changes in our practices or
                                regulatory requirements. Any significant changes will be communicated through our
                                website or via email.</p>
                        </div>

                        <div class="contact-info">
                            <h4><i class="fas fa-envelope"></i> Contact Information</h4>
                            <p>For any questions, feedback, or data-related concerns, please contact:</p>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>ruinze@mediaoneph.com</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-globe"></i>
                                <span>MediaOne Software Solutions</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>NHA Bangkal, Ground Floor Cordillera, corner Waling Waling, Davao City,
                                    8000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Terms & Conditions Tab -->
                    <div class="tab-pane fade" id="terms" role="tabpanel">
                        <span class="effective-date">
                            <i class="fas fa-calendar-alt"></i> Effective Date: July 18, 2025
                        </span>

                        <div class="content-section">
                            <h3><i class="fas fa-handshake"></i> Introduction</h3>
                            <p>Welcome to MediaOne Tix. These Terms and Conditions ("Terms") govern your access to and
                                use of our website, mobile app, and services related to purchasing event tickets. By
                                using our platform, you agree to be bound by these Terms. If you disagree, please
                                refrain from using our services.</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-book"></i> 1. Definitions</h3>
                            <p>"MediaOne Tix," "we," "our," or "us" refers to the event ticketing platform operated by
                                MediaOne Software Solutions.</p>
                            <p>"User," "you," or "your" refers to any person accessing or using our platform to browse,
                                register, or purchase tickets.</p>
                            <p>"Event Organizer" refers to the third-party individual or entity responsible for managing
                                the event for which tickets are sold.</p>
                            <p>"Dragonpay" refers to our official third-party payment gateway, which is used to process
                                transactions.</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-cogs"></i> 2. Use of Services</h3>
                            <p>You must be at least 18 years old or have parental/guardian consent to use this platform.
                            </p>
                            <p>You agree to use MediaOne Tix only for lawful purposes and in compliance with all
                                applicable laws and regulations in the Philippines.</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-user-plus"></i> 3. Account Registration</h3>
                            <p>You may be required to create an account to purchase tickets.</p>
                            <p>You are responsible for maintaining the confidentiality of your login credentials and for
                                all activity under your account.</p>
                            <p>Providing false, inaccurate, or misleading information may result in account suspension
                                or termination.</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-ticket-alt"></i> 4. Ticket Purchase & Payment</h3>
                            <div class="highlight-box">
                                <p>All ticket sales are processed through Dragonpay, which accepts various payment
                                    options (e.g., GCash, Maya, online banking, credit/debit cards).</p>
                            </div>
                            <p>You agree to provide accurate billing and payment information.</p>
                            <p>Once your transaction is confirmed, your ticket (typically a QR code or digital file)
                                will be sent to the email address you provided.</p>
                            <p>All sales are considered final unless the event is canceled or rescheduled (see Section
                                6).</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-door-open"></i> 5. Ticket Usage & Event Admission</h3>
                            <p>Tickets are valid only for the event indicated and may not be transferred or duplicated
                                without consent.</p>
                            <p>You must present a valid ticket (printed or digital) at the event venue for admission.
                            </p>
                            <p>Event Organizers may impose additional rules for entry, including age restrictions, dress
                                codes, or ID verification.</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-undo-alt"></i> 6. Cancellations, Refunds, and Exchanges</h3>
                            <p>MediaOne Tix does not offer refunds unless the event is canceled or significantly
                                rescheduled by the Event Organizer.</p>
                            <p>If an event is canceled, MediaOne Tix will notify ticket holders via email and assist in
                                processing eligible refunds as directed by the Event Organizer.</p>
                            <p>In the event of a rescheduled event, your ticket will remain valid for the new date
                                unless otherwise stated.</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-user-shield"></i> 7. User Conduct</h3>
                            <p>You agree not to:</p>
                            <ul>
                                <li>Use the platform for any fraudulent or illegal activity.</li>
                                <li>Attempt to interfere with the website's operation or security.</li>
                                <li>Reproduce, resell, or exploit tickets for commercial gain without permission.</li>
                            </ul>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-copyright"></i> 8. Intellectual Property</h3>
                            <p>All content, logos, and materials on the MediaOne Tix platform are the property of
                                MediaOne Software Solutions or its licensors and are protected by intellectual property
                                laws. You may not use, copy, or distribute any part of the platform without prior
                                written consent.</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-balance-scale"></i> 9. Limitation of Liability</h3>
                            <p>MediaOne Tix is a ticketing platform and is not responsible for the conduct, quality, or
                                safety of events hosted by third-party organizers. To the maximum extent permitted by
                                law, we disclaim any liability for losses, damages, or injuries resulting from:</p>
                            <ul>
                                <li>Event cancellations or changes</li>
                                <li>Errors in ticket delivery caused by incorrect user information</li>
                                <li>Technical issues affecting access to our platform</li>
                            </ul>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-user-secret"></i> 10. Privacy</h3>
                            <p>Your personal information is collected and processed in accordance with our Privacy
                                Policy, which complies with the Philippine Data Privacy Act of 2012. By using our
                                platform, you consent to the collection and use of your data as described.</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-edit"></i> 11. Amendments</h3>
                            <p>We reserve the right to update or modify these Terms at any time. Any changes will take
                                effect upon posting on our website. Continued use of the platform after changes
                                constitutes your acceptance of the updated Terms.</p>
                        </div>

                        <div class="content-section">
                            <h3><i class="fas fa-gavel"></i> 12. Governing Law</h3>
                            <p>These Terms are governed by and construed in accordance with the laws of the Republic of
                                the Philippines. Any disputes arising from these Terms will be subject to the exclusive
                                jurisdiction of the courts of Davao City, Philippines.</p>
                        </div>

                        <div class="contact-info">
                            <h4><i class="fas fa-envelope"></i> 13. Contact Us</h4>
                            <p>For any questions or concerns regarding these Terms, please contact us at:</p>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>ruinze@mediaoneph.com</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span>+63 999 223 4498</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sta" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Close
                </button>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                    <i class="fas fa-check"></i> I Understand & Agree
                </button>
            </div>
        </div>
    </div>
</div>