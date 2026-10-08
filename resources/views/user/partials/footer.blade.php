<footer class="site-footer">

    <div class="footer-main">
        <div class="container">
            <div class="row g-5">

                {{-- Brand --}}
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">

                        <div class="footer-logo">
                            <div class="logo-circle">
                                <span>M</span>
                            </div>

                            <h2>MADHU</h2>
                            <div class="logo-sub">
                                <span></span>
                                Fancy Store
                                <span></span>
                            </div>
                        </div>

                        <p>
                            Your one-stop destination for Fancy Items,
                            Beauty Products, Stationery, Accessories,
                            Gifts and more.
                        </p>

                    </div>
                </div>


                {{-- Quick Links --}}
                <div class="col-lg-2 col-md-6">
                    <div class="footer-column">

                        <h4>
                            <i class="bi bi-link-45deg"></i>
                            Quick Links
                        </h4>

                        <div class="footer-line"></div>

                        <ul>
                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="bi bi-chevron-right"></i>
                                    Home
                                </a>
                            </li>

                            <li>
                                <a href="#categories">
                                    <i class="bi bi-chevron-right"></i>
                                    Categories
                                </a>
                            </li>

                            <li>
                                <a href="#products">
                                    <i class="bi bi-chevron-right"></i>
                                    Products
                                </a>
                            </li>

                            <li>
                                <a href="#contact">
                                    <i class="bi bi-chevron-right"></i>
                                    Contact
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>


                {{-- Customer --}}
                <div class="col-lg-2 col-md-6">
                    <div class="footer-column">

                        <h4>
                            <i class="bi bi-person-fill"></i>
                            Customer
                        </h4>

                        <div class="footer-line"></div>

                        <ul>
                            <li>
                                <a href="#">
                                    <i class="bi bi-chevron-right"></i>
                                    My Account
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="bi bi-chevron-right"></i>
                                    Orders
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="bi bi-chevron-right"></i>
                                    Wishlist
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('cart.index') }}">
                                    <i class="bi bi-chevron-right"></i>
                                    Cart
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>


                {{-- Contact --}}
                <div class="col-lg-4 col-md-6">
                    <div class="footer-column contact-column">

                        <h4>
                            <i class="bi bi-telephone-fill"></i>
                            Contact
                        </h4>

                        <div class="footer-line"></div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <span>Tamil Nadu, India</span>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <span>thirusakthi2005@gmail.com</span>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <span>+91 80726 15422</span>
                        </div>


                        {{-- Social Media --}}
                        <div class="social-links">

                            <a href="#" class="social facebook">
                                <i class="bi bi-facebook"></i>
                            </a>

                            <a href="#" class="social instagram">
                                <i class="bi bi-instagram"></i>
                            </a>

                            <a href="#" class="social whatsapp">
                                <i class="bi bi-whatsapp"></i>
                            </a>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    {{-- Copyright --}}
    <div class="footer-bottom">
        <div class="copyright-line"></div>

        <div class="copyright-content">
            <i class="bi bi-flower1"></i>

            <span>
                © 2026 Madhu Fancy Store. All Rights Reserved.
            </span>

            <i class="bi bi-flower1"></i>
        </div>

        <div class="copyright-line"></div>
    </div>

</footer>