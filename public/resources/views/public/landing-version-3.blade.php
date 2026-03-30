@extends('components.navbar-guest')
@section('content')
    <div id="wrapper">
        <!-- Intro -->
        <section class="intro">
            <header>
                <h1 class="text-white">Mediaone Tix</h1>
                <p class="text-white">Every Event, One Destination</p>
                <ul class="actions">
                    <li>
                        <a href="#first" class="fas fa-chevron-circle-down"
                            style="font-size:48px; color:white; text-decoration:none; border:none; outline:none; box-shadow:none;"
                            onmouseover="this.style.textDecoration='none'; this.style.border='none'; this.style.outline='none'; this.style.boxShadow='none';"
                            onmouseout="this.style.textDecoration='none'; this.style.border='none'; this.style.outline='none'; this.style.boxShadow='none';"
                            onfocus="this.blur();">
                        </a>
                    </li>
                </ul>
            </header>
            <div class="content">
                <span class="image fill text-white" data-position="center"><img
                        src="{{ asset('assets/img/new-page-cover.jpeg') }}" alt="" /></span>
            </div>
        </section>

        <!-- Section -->
        <section id="first">
            <header>
                <h2 class="text-white">About MediaoneTix</h2>
            </header>
            <div class="content">
                <p><strong>MediaoneTix</strong> is an online ticketing platform built to give you a seamless way to
                    discover and purchase tickets for your favorite events. From concerts and festivals to corporate
                    gatherings and community programs, MediaoneTix makes sure that every event is just a few clicks
                    away. </p>
                <p>
                    With a personal account, users can securely log in, browse upcoming events, buy tickets instantly,
                    and manage their bookings with ease. You can check your active tickets, view your complete ticket
                    history, and keep track of all the events you’ve joined — all in one place.
                </p>
                <span class="image main"><img src="images/pic02.jpg" alt="" /></span>
            </div>
        </section>

        <!-- Section -->
        <section>
            <header>
                <h2 class="text-white">Why Choose MediaoneTix?</h2>
            </header>
            <div class="content">
                <p><strong>Convenience and security</strong> are at the heart of MediaoneTix. Whether you’re a casual
                    event-goer or a regular attendee, our platform helps you find and secure tickets quickly without the
                    hassle of long queues or physical tickets.</p>
                <ul class="feature-icons">
                    <li class="icon solid fa-laptop">Buy tickets online anytime</li>
                    <li class="icon solid fa-bolt">Instant ticket confirmation</li>
                    <li class="icon solid fa-signal">Track your ticket history</li>
                    <li class="icon solid fa-cog">Manage your bookings easily</li>
                    <li class="icon solid fa-map-marker-alt">Access events near you</li>
                    <li class="icon solid fa-code">Simple and user-friendly system</li>
                </ul>
                <p>MediaoneTix is designed to bring all your events together in one destination — making it easy,
                    reliable, and enjoyable to secure your seat at any event you want.</p>
            </div>
        </section>

        <!-- Section -->
        <section>
            <header>
                <h2 class="text-white">Your Events, Your Way</h2>
            </header>
            <div class="content">
                <p><strong>Stay connected</strong> with all the events that matter to you. Our galleries and highlights
                    showcase the vibrant experiences of MediaoneTix-powered events, giving you a glimpse of the fun,
                    energy, and memories waiting to be made.</p>

                <!-- Section -->
                <section>
                    <header>
                        <h3 class="text-white">Upcoming Highlights</h3>
                        <p class="text-white">Browse through featured events and get inspired for your next experience. From
                            live music to
                            special gatherings, MediaoneTix makes sure you don’t miss a moment.</p>
                    </header>
                    <div class="content">
                        <div class="gallery">
                            <a href="images/gallery/fulls/01.jpg" class="landscape"><img src="assets/img/pne_salindayaw.jpg"
                                    alt="" /></a>
                            <a href="images/gallery/fulls/02.jpg"><img src="assets/img/dvo_sweetnotes.jpg" alt="" /></a>
                            <a href="images/gallery/fulls/03.jpg"><img src="assets/img/andyrocks.jpg" alt="" /></a>
                        </div>
                    </div>
                </section>

                <!-- Section -->
                <section>
                    <header>
                        <h3 class="text-white">Your Ticket History</h3>
                        <p class="text-white">Every ticket you purchase is safely stored in your account, giving you the
                            ability to look
                            back on past events and keep a record of your unforgettable experiences.</p>
                    </header>
                    <div class="content">
                        <div class="gallery">
                            <a href="images/gallery/fulls/05.jpg" class="landscape"><img src="assets/img/navigating.webp"
                                    alt="" /></a>
                            <!-- <a href="images/gallery/fulls/06.jpg"><img src="images/gallery/thumbs/06.jpg" alt="" /></a>
                            <a href="images/gallery/fulls/07.jpg"><img src="images/gallery/thumbs/07.jpg" alt="" /></a> -->
                        </div>
                    </div>
                </section>

            </div>
        </section>

        <!-- Section -->
        <section>
            <header>
                <h2 class="text-white">Start Your Journey with MediaoneTix</h2>
            </header>
            <div class="content">
                <p><strong>Be part of the experience.</strong> Sign up, log in, and start exploring events that matter
                    to you. MediaoneTix is more than just tickets — it’s your gateway to memories, moments, and
                    connections.</p>
                <ul class="actions">
                    <li><a href="" class="button primary large" style="color: #fff !important">Get Started</a></li>
                    <li><a href="{{ route('login') }}" class="button large">Log In</a></li>
                </ul>
            </div>
        </section>

        <!-- Contact Section -->
        <section>
            <header>
                <h2 class="text-white">Get in touch</h2>
            </header>
            <div class="content">
                <p><strong>Have questions?</strong> Our team is here to help. Reach out to us for inquiries, event
                    partnerships, or technical support.</p>
                <form>
                    <div class="fields">
                        <div class="field half">
                            <input type="text" name="name" id="name" placeholder="Name" />
                        </div>
                        <div class="field half">
                            <input type="email" name="email" id="email" placeholder="Email" />
                        </div>
                        <div class="field">
                            <textarea name="message" id="message" placeholder="Message" rows="7"></textarea>
                        </div>
                    </div>
                    <ul class="actions">
                        <li><button type="submit" class="button primary text-white" style="color: #fff !important">Send Message</button></li>
                    </ul>
                </form>
            </div>
            <footer>
                <ul class="items">
                    <li>
                        <h3 class="text-white">Email</h3>
                        <a class="text-white" href="mailto:info@mediaonetix.com">info@mediaonetix.com</a>
                    </li>
                    <li>
                        <h3 class="text-white">Phone</h3>
                        <a class="text-white" href="#">(+63) 900-000-0000</a>
                    </li>
                    <li>
                        <h3 class="text-white">Address</h3>
                        <span class="text-white">Davao City, Philippines</span>
                    </li>
                    <li>
                        <h3 class="text-white">Follow Us</h3>
                        <ul class="icons" class="text-white">
                            <li><a href="#" class="icon brands fa-facebook-f text-white"><span
                                        class="label">Facebook</span></a>
                            </li>
                            <li><a href="#" class="icon brands fa-instagram text-white"><span
                                        class="label">Instagram</span></a>
                            </li>
                            <li><a href="#" class="icon brands fa-linkedin-in text-white"><span
                                        class="label">LinkedIn</span></a>
                            </li>
                            <li><a href="#" class="icon brands fa-github text-white"><span class="label">GitHub</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </footer>
        </section>

        <!-- Copyright -->
        <div class="copyright">&copy; MediaoneTix. All rights reserved.
        </div>

    </div>
@endsection
