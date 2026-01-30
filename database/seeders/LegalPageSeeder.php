<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LegalPage;

class LegalPageSeeder extends Seeder
{
    public function run(): void
    {
        LegalPage::updateOrCreate(
            [
                'slug' => 'privacy-policy',
            ],
            [
                'type' => 'privacy',
                'title' => 'Privacy Policy',
                'content' => '<h2>1. Introduction</h2>
        <p>Welcome to Destiny Life Coaching Kenya ("we," "our," or "us"). We are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.</p>

        <h2>2. Information We Collect</h2>
        <p>We may collect information about you in a variety of ways. The information we may collect includes:</p>
        <ul>
            <li><strong>Personal Information:</strong> Name, email address, phone number, and other contact information you provide when registering for our programs or contacting us.</li>
            <li><strong>Payment Information:</strong> Credit card details and billing information when you make a purchase (processed securely through third-party payment processors).</li>
            <li><strong>Usage Data:</strong> Information about how you access and use our website, including IP address, browser type, pages visited, and time spent on pages.</li>
            <li><strong>Cookies:</strong> We use cookies and similar tracking technologies to track activity on our website and store certain information.</li>
        </ul>

        <h2>3. How We Use Your Information</h2>
        <p>We use the information we collect to:</p>
        <ul>
            <li>Provide, maintain, and improve our services</li>
            <li>Process your registrations and payments</li>
            <li>Send you updates, newsletters, and promotional materials (with your consent)</li>
            <li>Respond to your inquiries and provide customer support</li>
            <li>Monitor and analyze usage patterns and trends</li>
            <li>Detect, prevent, and address technical issues and security threats</li>
        </ul>

        <h2>4. Information Sharing and Disclosure</h2>
        <p>We do not sell, trade, or rent your personal information to third parties. We may share your information only in the following circumstances:</p>
        <ul>
            <li><strong>Service Providers:</strong> With trusted third-party service providers who assist us in operating our website and conducting our business</li>
            <li><strong>Legal Requirements:</strong> When required by law or to protect our rights and safety</li>
            <li><strong>Business Transfers:</strong> In connection with any merger, sale, or acquisition of our business</li>
        </ul>

        <h2>5. Data Security</h2>
        <p>We implement appropriate technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the Internet is 100% secure.</p>

        <h2>6. Your Rights</h2>
        <p>You have the right to:</p>
        <ul>
            <li>Access and receive a copy of your personal information</li>
            <li>Request correction of inaccurate information</li>
            <li>Request deletion of your personal information</li>
            <li>Opt-out of marketing communications</li>
            <li>Withdraw consent where processing is based on consent</li>
        </ul>

        <h2>7. Cookies</h2>
        <p>We use cookies to enhance your experience on our website. You can choose to disable cookies through your browser settings, though this may affect website functionality.</p>

        <h2>8. Third-Party Links</h2>
        <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices of these external sites. We encourage you to review their privacy policies.</p>

        <h2>9. Children\'s Privacy</h2>
        <p>Our services are not directed to individuals under the age of 18. We do not knowingly collect personal information from children.</p>

        <h2>10. Changes to This Privacy Policy</h2>
        <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last updated" date.</p>

        <h2>11. Contact Us</h2>
        <p>If you have any questions about this Privacy Policy, please contact us at:</p>
        <p>
            <strong>Destiny Life Coaching Kenya</strong><br>
            Email: info@dlc.co.ke<br>
            Phone: +254 722 992 111
        </p>',
                'meta_title' => 'Privacy Policy | Destiny Life Coaching Kenya',
                'meta_description' => 'Read our privacy policy to understand how we collect, use, and protect your personal information at Destiny Life Coaching Kenya.',
                'is_published' => 1,
                'created_at' => '2026-01-27 11:36:27',
                'updated_at' => '2026-01-27 11:36:27',
            ]
        );

        LegalPage::updateOrCreate(
            [
                'slug' => 'terms-of-service',
            ],
            [
                'type' => 'terms',
                'title' => 'Terms of Service',
                'content' => '<h2>1. Acceptance of Terms</h2>
        <p>By accessing and using the Destiny Life Coaching Kenya website and services, you accept and agree to be bound by these Terms of Service. If you do not agree to these terms, please do not use our services.</p>

        <h2>2. Description of Services</h2>
        <p>Destiny Life Coaching Kenya provides life coaching certification programs, training courses, workshops, and related educational services. We reserve the right to modify, suspend, or discontinue any aspect of our services at any time.</p>

        <h2>3. Registration and Account</h2>
        <p>To access certain features of our services, you may be required to register for an account. You agree to:</p>
        <ul>
            <li>Provide accurate, current, and complete information</li>
            <li>Maintain and update your information to keep it accurate</li>
            <li>Maintain the security of your account credentials</li>
            <li>Accept responsibility for all activities under your account</li>
            <li>Notify us immediately of any unauthorized use of your account</li>
        </ul>

        <h2>4. Payment Terms</h2>
        <p>For paid services:</p>
        <ul>
            <li>All fees are stated in Kenyan Shillings (KES) unless otherwise specified</li>
            <li>Payment must be made in full before access to services is granted</li>
            <li>We reserve the right to change our pricing at any time</li>
            <li>Refunds are subject to our refund policy, which may vary by program</li>
            <li>All payments are processed securely through third-party payment processors</li>
        </ul>

        <h2>5. Intellectual Property</h2>
        <p>All content on our website, including text, graphics, logos, images, audio, video, and software, is the property of Destiny Life Coaching Kenya or its content suppliers and is protected by copyright and other intellectual property laws. You may not reproduce, distribute, modify, or create derivative works without our express written permission.</p>

        <h2>6. User Conduct</h2>
        <p>You agree not to:</p>
        <ul>
            <li>Use our services for any unlawful purpose</li>
            <li>Violate any applicable laws or regulations</li>
            <li>Infringe upon the rights of others</li>
            <li>Transmit any harmful, offensive, or inappropriate content</li>
            <li>Interfere with or disrupt our services or servers</li>
            <li>Attempt to gain unauthorized access to our systems</li>
            <li>Use automated systems to access our services without permission</li>
        </ul>

        <h2>7. Certification and Credentials</h2>
        <p>Upon successful completion of our certification programs, you will receive a certificate of completion. Certification is subject to:</p>
        <ul>
            <li>Successful completion of all required coursework and assessments</li>
            <li>Adherence to our code of conduct and professional standards</li>
            <li>Payment of all required fees</li>
        </ul>
        <p>We reserve the right to revoke certification if you violate these terms or our professional standards.</p>

        <h2>8. Disclaimer of Warranties</h2>
        <p>Our services are provided "as is" and "as available" without warranties of any kind, either express or implied. We do not guarantee that:</p>
        <ul>
            <li>Our services will be uninterrupted, secure, or error-free</li>
            <li>The results obtained from using our services will meet your expectations</li>
            <li>Any errors will be corrected</li>
        </ul>

        <h2>9. Limitation of Liability</h2>
        <p>To the maximum extent permitted by law, Destiny Life Coaching Kenya shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses resulting from your use of our services.</p>

        <h2>10. Indemnification</h2>
        <p>You agree to indemnify and hold harmless Destiny Life Coaching Kenya, its officers, directors, employees, and agents from any claims, damages, losses, liabilities, and expenses (including legal fees) arising out of your use of our services or violation of these terms.</p>

        <h2>11. Termination</h2>
        <p>We may terminate or suspend your account and access to our services immediately, without prior notice, for any breach of these Terms of Service. Upon termination, your right to use our services will cease immediately.</p>

        <h2>12. Modifications to Terms</h2>
        <p>We reserve the right to modify these Terms of Service at any time. We will notify users of any material changes by posting the updated terms on our website. Your continued use of our services after such modifications constitutes acceptance of the updated terms.</p>

        <h2>13. Governing Law</h2>
        <p>These Terms of Service shall be governed by and construed in accordance with the laws of Kenya, without regard to its conflict of law provisions.</p>

        <h2>14. Dispute Resolution</h2>
        <p>Any disputes arising out of or relating to these terms or our services shall be resolved through good faith negotiation. If negotiation fails, disputes shall be resolved through binding arbitration in accordance with Kenyan arbitration laws.</p>

        <h2>15. Contact Information</h2>
        <p>If you have any questions about these Terms of Service, please contact us at:</p>
        <p>
            <strong>Destiny Life Coaching Kenya</strong><br>
            Email: info@dlc.co.ke<br>
            Phone: +254 722 992 111
        </p>',
                'meta_title' => 'Terms of Service | Destiny Life Coaching Kenya',
                'meta_description' => 'Read our terms of service to understand the rules and regulations for using Destiny Life Coaching Kenya services.',
                'is_published' => 1,
                'created_at' => '2026-01-27 11:36:27',
                'updated_at' => '2026-01-27 11:36:27',
            ]
        );

    }
}
