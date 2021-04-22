<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPolicyText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('privacy_policies')->insert(
            array(
                'page_name' => 'Privacy Policy',                
                'created_by' => 4,
                'body' => '<p>At demo, your privacy is important to us and we take information security seriously. This privacy policy describes how we collect, use, and handle your information when you use demo&rsquo;s website, and services</p>
                <p>We collect and store information about you when you use our services. This information is used to provide and improve our services, personalize your experience, fulfill your requests, analyze and track usage of our services, provide customer support, enhance the security of our services, and to comply with legal obligations. Our site is intended primarily to provide a platform to search and book musicians.</p>
                <p><strong>What information do we collect?</strong></p>
                <p><strong><em>Your personal information</em></strong></p>
                <p>We collect personally identifiable information from you when you sign up for a demo account. You may be asked, for instance, to provide information such as your name, phone number, email address, and state of residence. We may also collect mobile device information that is personally identifying.</p>
                <p>Personal information you provide when you create a demo account: email address; and user password.</p>
                <p>Personal information you submit when you create an account: first and last name; city, state, zip code and address; email address; telephone number.</p>
                <p><strong><em>Device information</em></strong></p>
                <p>Our servers also automatically record information that your browser or mobile device sends when you visit our website or use our services. This can include the type of computer or mobile device you use, your computer or mobile devices&rsquo; unique device ID, its IP address and operating system, your browser type, your mobile carrier, phone number, location (including geolocation and beacon based location) and information about the way you use the demo services. We may also access, collect, monitor, store on your device, and/or remotely store one or more &ldquo;device identifiers,&rdquo; which uniquely identify your mobile device. Device identifiers help us receive information about how you browse and use our services, and may help us (or our third party partners) provide reports or personalized content.</p>
                <p><strong><em>Anonymous/Aggregate information</em></strong></p>
                <p>We use third-party analytics tools (e.g. Google Analytics) to help us measure, research, and report traffic and usage trends for our service. These tools collect information sent by your device or our service, including the web pages you visit, and other information that assists us in improving our service. We collect and use this analytics information with analytics information from other users so it cannot reasonably be used to identify you or any particular individual user.</p>
                <p><strong><em>Information collected by cookies and other technologies</em></strong></p>
                <p>We may also use various technologies, such as cookies and web beacons (aka, &ldquo;tracking pixels&rdquo;), to capture and remember certain information about you. Cookies are small data files stored on your hard drive or in device memory that help us enable certain features of our web site, to understand your preferences, and to compile aggregate data about user traffic and behavior so we can offer better experiences and services. We may also collect information using web beacons or tracking pixels, which are electronic images used in our services or emails to help us deliver cookies, count visits, understand usage and campaign effectiveness, and determine whether an email has been opened and acted upon.</p>
                <p>Most devices are set to accept cookies by default. If you prefer, however, you can configure your browser so it does not accept cookies by following the security protocols on your device. Your choice to remove or reject browser cookies may affect your access to or availability to use certain features of demo&rsquo;s services.</p>
                <p><strong><em>Third parties</em></strong></p>
                <p>We may also partner with third parties to manage our advertising on other sites. These third parties may use technologies such as cookies to gather information about your activities on the demo website and other sites you visit to provide you with targeted advertising. Using cookies by third parties, or third party applications, are not covered by this privacy policy, and we do not have access to or control over those cookies.</p>
                <p><strong>What do we use your information for and who is it shared with?</strong></p>
                <p><strong><em>To operate our services</em></strong></p>
                <p>Your personal information and device information may provide, operate, maintain, and improve the demo services. For instance, we may use your information to:</p>
                <ul>
                <li>enable you to access and use our services;</li>
                <li>send you notices, updates, security alerts, and support and administrative messages;</li>
                <li>process and complete transactions, and send you related information, including confirmations and invoices;</li>
                <li>respond to your comments, questions, and requests and provide customer service and support;</li>
                <li>communicate with you about services, features, offers and events, and provide other news or information about demo and our select partners;</li>
                <li>investigate and prevent fraudulent transactions, including unauthorized access to your account and other illegal activities;</li>
                <li>personalize and improve the demo services, and provide content, features, and/or advertisements that match your interests and preferences or otherwise customize your experience on the demo services;</li>
                <li>send invitations or notifications about demo to contacts whose information you&rsquo;ve provided;</li>
                <li>enable you to communicate, collaborate, and share files with the contacts you designate;&nbsp;and</li>
                </ul>
                <p>We may share your personal information we obtain in connection with operating our website:</p>
                <ul>
                <li>With service providers who work on our behalf, such as cloud storage providers, and other third party partners that provide features or functionalities we integrate into our website, such as email communication providers;</li>
                <li>With third-parties for any purpose with your consent or otherwise at your direction.</li>
                </ul>
                <p>Sometimes, we may need to share your personal information and/or device information to vendors, consultants, or other service providers (e.g. payment processors, customer service support) who require your information to carry out the above services.</p>
                <p><strong><em>Advertising and promotional messages</em></strong></p>
                <p>We will never share your personal information with third parties for direct marketing purposes, unless we have your express permission. However, we may use your personal information you&rsquo;ve provided (e.g. your email, telephone number, or demo account) to send you updates and offers about new products, services, or features from us or our direct partners. If you don&rsquo;t want to receive these messages, you may opt out by following the opt-out instructions provided in those communications or emailing us at <u>hi@demo.com</u>. If you opt out, we may still send you non-promotional communications, such as security alerts and notices related to your account of use of our services. In serving interest-based ads, demo adheres to the Self-Regulatory Principles for Online Behavioral Advertising developed by the Digital Advertising Alliance.</p>
                <p><strong><em>Analytics and reporting</em></strong></p>
                <p>We may use your personal information, device information, and anonymous/aggregate data we&rsquo;ve collected to help us measure, research, monitor, analyze, and report traffic and usage trends for our service. Sometimes, we may share this information with third party analytics services (i.e. Google Analytics) to help us measure and understand our data.</p>
                <p><strong><em>Legal compliance</em></strong></p>
                <p>We may share your personal information when required under law, legal process, litigation, or request from public and governmental authorities. For instance, we may disclose your information if (1) disclosure is reasonably necessary to comply with any law, regulation, legal process or governmental request, (2) to enforce our agreements, policies and terms of service, (3) to protect the security or integrity of the demo services, (4) to protect demo, our customers or the public from harm or illegal activities, or (5) to respond to what we believe in good faith to be an emergency.</p>
                <p><strong><em>Business transfers</em></strong></p>
                <p>We may share or transfer your information in connection with, or during negotiations of, any merger, sale of company assets, financing, or acquisition of all or a portion of our business to another company.</p>
                <p><strong>What do we do to secure your information?</strong></p>
                <p>demo takes the security of your information seriously. While no service is completely secure, we use industry standard protections, such as data encryption, to protect your information from loss, theft, misuse, unauthorized access, disclosure, alteration, or destruction. We are not responsible for the security of information you transmit to our website over networks we do not control, including the Internet and wireless networks. With your demo account, use passwords sufficiently complex and not share your passwords with others.</p>
                <p><strong>Your choices, including marketing and interest-based ads and opt-outs</strong></p>
                <p>You can review and request changes to your personal information obtained by demo at any time by editing your demo account. You can have your demo account deleted by sending a request via email to <u>support@demo.com</u><u>.</u></p>
                <ul>
                <li><strong><em>Email marketing opt-out.</em></strong> You may opt out of receiving marketing or promotional emails from us by clicking on the &ldquo;unsubscribe&rdquo; link in the emails. Please remember that if you opt out of receiving marketing or promotional emails, we may still send you transactional emails or other communications relating to demo</li>
                <li><strong><em>Interest-based ads opt-outs. </em></strong>To learn more about your rights in relation to interest-based advertising on your browser, including your choice to opt out, you can follow the instructions provided by the Digital Advertising Alliance (&ldquo;DAA&rdquo;) <a target="_blank" href="http://www.aboutads.info/" style="color: rgb(100, 254, 204)">here</a> and/or the Network Advertising Initiative (&ldquo;NAI&rdquo;) <a target="_blank" href="http://optout.networkadvertising.org/" style="color: rgb(100, 254, 204)">here</a> to place an opt-out cookie on your browser. These opt-out cookies enable you to block participating companies from installing future cookies on your computer or browser.</li>
                <li><strong><em>Cookie opt-outs.</em> </strong>If you do not want cookies, most web browsers include an option that allows you to not accept them. However, if you set your browser to refuse cookies, you may not be able to log in successfully and/or some features of our website may not function properly. To learn more about opting out of these activities, click <a target="_blank" href="https://tools.google.com/dlpage/gaoptout" style="color: rgb(100, 254, 204)">here</a>.</li>
                </ul>
                <p><strong>Dispute resolution</strong></p>
                <p>Any dispute about our website (including our use of your personal information) will be resolved per the dispute resolution provision in our terms of service. Our terms of service govern your use of our website. Please take a few minutes to read our terms of service before using our website.</p>
                <p><strong>Third party sites</strong></p>
                <p>demo&rsquo;s services may allow you to link your account with other online accounts you have with third party sites. If you connect your account with one of these services, those third parties may receive information about you, such as your name, demo user ID, email address, etc.</p>
                <p>We are not responsible for the practices employed by any websites or services linked to or from our services, including the information or content within them. When you use a link to go from our services to another website or service, this privacy policy does not apply to those third-party websites or services, and your browsing and interaction on those sites or services are subject to that third party&rsquo;s own rules and policies.</p>
                <p><strong>Information retention policy</strong></p>
                <p>We will retain your information for as long as your account is active, or as required by law or for legitimate business purposes (e.g. to resolve any disputes and to enforce our agreements.</p>
                <p><strong>Children&rsquo;s privacy and note to parents and guardians</strong></p>
                <p>demo does not knowingly collect personal information from children under the age of 13, or direct our services at anyone under the age of 13. Those who are under 13 may not create an account with demo. If we learn we have unknowingly collected personal information from a child under 13, or that a child under 13 has created an account on demo, we will delete that account and make commercially reasonable efforts to delete this information from our database. If you are a parent or guardian of a child under the age of 13, and you believe that your child has provided us with personal information, please contact us here at <u style="color: rgb(100, 254, 204)">support@demo.com</u></p>
                <p>You cannot sign up for a demo account if you are under 18. However, in connection with the services we offer through our website, we may obtain information about children under the age of 13 if a parent or legal guardian submits or shares this information with us. We ask that users of our website not provide information about a child under 13 without first getting the consent of the parent or legal guardian. By providing information regarding a child under the age of 13, you are affirming that you have the legal right to do so.</p>
                <p><strong>International users</strong></p>
                <p>demo is operated from the United States primarily to provide access to a database of musicians for users interested in booking live music events and similar services governed by United States laws. Because the internet is global, note that by providing your information as an international visitor or user, you are permitting (1) the transfer of your information to the United States, which may not have the same data protection laws as the country in which you reside; and (2) the use, storage, sharing and other processing of information under this privacy policy.</p>
                <p><strong>California privacy rights</strong></p>
                <p>California law gives California residents the right to request certain information regarding how their personal information (as defined by California law) is shared with third parties for their direct marketing purposes. demo does not share your personal information with third parties for their own direct marketing purposes.</p>
                <p><strong>Do not track compliance</strong></p>
                <p>demo does not currently try to respond to browsers&rsquo; &ldquo;Do Not Track&rdquo; signals, as no uniform standard to respond to these signals has been developed.</p>
                <p><strong>Changes to this privacy policy</strong></p>
                <p>We may modify this privacy policy occasionally, and encourage you to periodically review our policy to stay informed about any changes to our information practices. If we make any material changes, we&rsquo;ll notify you both within the app and by email to the address associated with your account. We&rsquo;ll also always post the most current version of this privacy policy at www.demo.com</p>
                <p>By continuing to use our services after we publish or send a notice about our changes, you&rsquo;re consenting to our updated privacy policy.</p>
                <p><strong>Contact us</strong></p>
                <p>If you have any questions or comments about this privacy policy, please let us know:</p>
                <p><a target="_blank" href="mailto:support@demo.com" style="color: rgb(100, 254, 204)">support@demo.com</a></p>
                <p>&nbsp;</p>',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('privacy_policies')->truncate();
    }
}
