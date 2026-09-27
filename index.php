<?php
session_start();
require_once "includes/functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TrapoWalks | Explore Sri Lanka & Beyond</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#home">
            <i class="bi bi-compass text-brand"></i> Trapo<span class="text-brand">Walks</span>
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link nav-smooth" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link nav-smooth" href="#destinations">Destinations</a></li>
                <li class="nav-item"><a class="nav-link nav-smooth" href="#features">Why Us</a></li>
                <li class="nav-item"><a class="nav-link nav-smooth" href="#testimonials">Stories</a></li>
                <li class="nav-item"><a class="nav-link nav-smooth" href="#contact">Contact</a></li>
                <?php if (isLoggedIn()): ?>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-brand btn-sm px-3" href="dashboard.php">
                            <i class="bi bi-person-circle"></i> <?php echo sanitize($_SESSION['username']); ?>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-2"><a class="btn btn-outline-light btn-sm px-3" href="auth/login.php">Login</a></li>
                    <li class="nav-item ms-lg-1"><a class="btn btn-brand btn-sm px-3" href="auth/register.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- ================= HERO SLIDER ================= -->
<header id="home" class="hero">
    <div class="hero-slide active" style="background-image:linear-gradient(rgba(10,25,47,.55),rgba(10,25,47,.55)),url('images/hero1.svg')">
        <div class="hero-content">
            <h1 class="display-4 fw-bold">Walk Beyond the <span class="text-brand">Ordinary</span></h1>
            <p>Handcrafted journeys across Sri Lanka's hills, coasts and ancient cities.</p>
        </div>
    </div>
    <div class="hero-slide" style="background-image:linear-gradient(rgba(10,25,47,.55),rgba(10,25,47,.55)),url('images/hero2.svg')">
        <div class="hero-content">
            <h1 class="display-4 fw-bold">Sun, Surf & <span class="text-brand">Soul</span></h1>
            <p>From Mirissa's whales to Arugam Bay's waves — the coast is calling.</p>
        </div>
    </div>
    <div class="hero-slide" style="background-image:linear-gradient(rgba(10,25,47,.55),rgba(10,25,47,.55)),url('images/hero3.svg')">
        <div class="hero-content">
            <h1 class="display-4 fw-bold">Plan It. <span class="text-brand">Live It.</span></h1>
            <p>Build your personal travel itinerary and track every adventure on your dashboard.</p>
        </div>
    </div>
    <button class="hero-btn prev" id="heroPrev" aria-label="Previous slide"><i class="bi bi-chevron-left"></i></button>
    <button class="hero-btn next" id="heroNext" aria-label="Next slide"><i class="bi bi-chevron-right"></i></button>
    <div class="hero-dots" id="heroDots"></div>
    <a href="#destinations" class="scroll-down nav-smooth"><i class="bi bi-chevron-double-down"></i></a>
</header>

<!-- ================= STATS ================= -->
<section class="py-5 stats-section">
    <div class="container">
        <div class="row text-center g-4 reveal">
            <div class="col-6 col-md-3">
                <h2 class="fw-bold counter" data-target="120">0</h2><p class="text-muted mb-0">Destinations</p>
            </div>
            <div class="col-6 col-md-3">
                <h2 class="fw-bold counter" data-target="8500">0</h2><p class="text-muted mb-0">Happy Walkers</p>
            </div>
            <div class="col-6 col-md-3">
                <h2 class="fw-bold counter" data-target="340">0</h2><p class="text-muted mb-0">Local Guides</p>
            </div>
            <div class="col-6 col-md-3">
                <h2 class="fw-bold counter" data-target="98">0</h2><p class="text-muted mb-0">% Satisfaction</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= DESTINATIONS (filterable) ================= -->
<section id="destinations" class="py-5 section-alt">
    <div class="container">
        <div class="text-center mb-4 reveal">
            <h2 class="fw-bold">Top <span class="text-brand">Destinations</span></h2>
            <p class="text-muted">Filter by the kind of walk you love.</p>
        </div>

        <div class="d-flex flex-wrap justify-content-center gap-2 mb-4 reveal" id="filterBar">
            <button class="btn filter-btn active" data-filter="all">All</button>
            <button class="btn filter-btn" data-filter="beach">Beach</button>
            <button class="btn filter-btn" data-filter="mountain">Mountains</button>
            <button class="btn filter-btn" data-filter="culture">Culture</button>
            <button class="btn filter-btn" data-filter="wildlife">Wildlife</button>
        </div>

        <div class="row g-4" id="destinationGrid">
            <div class="col-md-6 col-lg-4 destination-item reveal" data-category="mountain">
                <div class="card dest-card h-100 shadow-sm">
                    <img src="images/ella.svg" class="card-img-top" alt="Ella">
                    <div class="card-body">
                        <span class="badge bg-success-subtle text-success mb-2">Mountains</span>
                        <h5 class="fw-bold">Ella Gap & Nine Arches</h5>
                        <p class="text-muted small">Hike through tea country, cross the iconic bridge and watch mist roll over the gap.</p>
                        <p class="fw-semibold text-brand mb-0">From $45 / day</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 destination-item reveal" data-category="beach">
                <div class="card dest-card h-100 shadow-sm">
                    <img src="images/mirissa.svg" class="card-img-top" alt="Mirissa">
                    <div class="card-body">
                        <span class="badge bg-info-subtle text-info mb-2">Beach</span>
                        <h5 class="fw-bold">Mirissa Whale Watching</h5>
                        <p class="text-muted small">Blue whales at sunrise, palm-tree swings and the island's best beach cafés.</p>
                        <p class="fw-semibold text-brand mb-0">From $60 / day</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 destination-item reveal" data-category="culture">
                <div class="card dest-card h-100 shadow-sm">
                    <img src="images/sigiriya.svg" class="card-img-top" alt="Sigiriya">
                    <div class="card-body">
                        <span class="badge bg-warning-subtle text-warning mb-2">Culture</span>
                        <h5 class="fw-bold">Sigiriya Rock Fortress</h5>
                        <p class="text-muted small">Climb the ancient sky palace and explore frescoes of the Cloud Maidens.</p>
                        <p class="fw-semibold text-brand mb-0">From $35 / day</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 destination-item reveal" data-category="wildlife">
                <div class="card dest-card h-100 shadow-sm">
                    <img src="images/yala.svg" class="card-img-top" alt="Yala">
                    <div class="card-body">
                        <span class="badge bg-danger-subtle text-danger mb-2">Wildlife</span>
                        <h5 class="fw-bold">Yala Safari</h5>
                        <p class="text-muted small">The world's densest leopard population — plus elephants, sloth bears and crocodiles.</p>
                        <p class="fw-semibold text-brand mb-0">From $80 / day</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 destination-item reveal" data-category="mountain">
                <div class="card dest-card h-100 shadow-sm">
                    <img src="images/horton.svg" class="card-img-top" alt="Horton Plains">
                    <div class="card-body">
                        <span class="badge bg-success-subtle text-success mb-2">Mountains</span>
                        <h5 class="fw-bold">Horton Plains Trek</h5>
                        <p class="text-muted small">World's End at dawn — a sheer 870m drop above the clouds.</p>
                        <p class="fw-semibold text-brand mb-0">From $40 / day</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 destination-item reveal" data-category="beach">
                <div class="card dest-card h-100 shadow-sm">
                    <img src="images/trinco.svg" class="card-img-top" alt="Trincomalee">
                    <div class="card-body">
                        <span class="badge bg-info-subtle text-info mb-2">Beach</span>
                        <h5 class="fw-bold">Trincomalee Diving</h5>
                        <p class="text-muted small">Pigeon Island's coral gardens and the deep blue of Nilaveli.</p>
                        <p class="fw-semibold text-brand mb-0">From $55 / day</p>
                    </div>
                </div>
            </div>
        </div>
        <p id="noResults" class="text-center text-muted mt-4 d-none">No destinations match that filter yet — more walks coming soon!</p>
    </div>
</section>

<!-- ================= FEATURES ================= -->
<section id="features" class="py-5">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <h2 class="fw-bold">Why Walk <span class="text-brand">With Us</span></h2>
            <p class="text-muted">Small details, big journeys.</p>
        </div>
        <div class="row g-4 text-center">
            <div class="col-md-4 reveal">
                <div class="feature-box p-4 h-100">
                    <i class="bi bi-map feature-icon"></i>
                    <h5 class="fw-bold mt-3">Personal Itineraries</h5>
                    <p class="text-muted small">Build and manage your trip plans on your own dashboard.</p>
                </div>
            </div>
            <div class="col-md-4 reveal">
                <div class="feature-box p-4 h-100">
                    <i class="bi bi-people feature-icon"></i>
                    <h5 class="fw-bold mt-3">Local Guides</h5>
                    <p class="text-muted small">Walk with locals who know every hidden trail and story.</p>
                </div>
            </div>
            <div class="col-md-4 reveal">
                <div class="feature-box p-4 h-100">
                    <i class="bi bi-shield-check feature-icon"></i>
                    <h5 class="fw-bold mt-3">Safe & Flexible</h5>
                    <p class="text-muted small">Free rescheduling and 24/7 on-trip support, always.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= TESTIMONIALS ================= -->
<section id="testimonials" class="py-5 section-alt">
    <div class="container">
        <div class="text-center mb-4 reveal">
            <h2 class="fw-bold">Walker <span class="text-brand">Stories</span></h2>
        </div>
        <div id="storyCarousel" class="carousel slide reveal" data-bs-ride="carousel">
            <div class="carousel-inner text-center px-md-5">
                <div class="carousel-item active">
                    <blockquote class="blockquote">
                        <p>"The Ella trek arranged by TrapoWalks was flawless — our guide knew every shortcut and the best king-coconut stop."</p>
                        <footer class="blockquote-footer">Sithum, Colombo</footer>
                    </blockquote>
                </div>
                <div class="carousel-item">
                    <blockquote class="blockquote">
                        <p>"We saw three leopards on our Yala safari. Booking and planning through the dashboard was effortless."</p>
                        <footer class="blockquote-footer">Amaya & Ravi, Kandy</footer>
                    </blockquote>
                </div>
                <div class="carousel-item">
                    <blockquote class="blockquote">
                        <p>"As a solo traveller I felt safe the whole way. The contact team replied within hours every time."</p>
                        <footer class="blockquote-footer">Nadeesha, Galle</footer>
                    </blockquote>
                </div>
            </div>
            <button class="carousel-control-prev" data-bs-target="#storyCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" data-bs-target="#storyCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section>

<!-- ================= CONTACT ================= -->
<section id="contact" class="py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5 reveal">
                <h2 class="fw-bold">Let's Plan Your <span class="text-brand">Next Walk</span></h2>
                <p class="text-muted">Drop us a message — we usually reply within one working day.</p>
                <ul class="list-unstyled contact-info">
                    <li class="mb-2"><i class="bi bi-geo-alt text-brand"></i> Mihintale Street, Anuradhapura, Sri Lanka</li>
                    <li class="mb-2"><i class="bi bi-envelope text-brand"></i> hello@trapowalks.lk</li>
                    <li><i class="bi bi-telephone text-brand"></i> +94 77 555 1234</li>
                </ul>
            </div>
            <div class="col-lg-7 reveal">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <?php if (isset($_SESSION['contact_success'])): ?>
                            <div class="alert alert-success"><?php echo $_SESSION['contact_success']; unset($_SESSION['contact_success']); ?></div>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['contact_error'])): ?>
                            <div class="alert alert-danger"><?php echo $_SESSION['contact_error']; unset($_SESSION['contact_error']); ?></div>
                        <?php endif; ?>
                        <form method="POST" action="contact.php" id="contactForm" novalidate>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" id="cName" class="form-control" placeholder="Your name" required>
                                    <small class="text-danger d-none" id="cNameErr">Please enter your name.</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" id="cEmail" class="form-control" placeholder="you@example.com" required>
                                    <small class="text-danger d-none" id="cEmailErr">Please enter a valid email.</small>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Message</label>
                                    <textarea name="message" id="cMessage" rows="4" class="form-control" placeholder="Where do you want to walk next?" required></textarea>
                                    <small class="text-danger d-none" id="cMessageErr">Message must be at least 10 characters.</small>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-brand mt-3 px-4">
                                <i class="bi bi-send"></i> Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="text-white pt-5 pb-3" style="background:#0a192f">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5 class="fw-bold"><i class="bi bi-compass text-brand"></i> TrapoWalks</h5>
                <p class="small text-white-50">Walking tours and handcrafted journeys across Sri Lanka.</p>
            </div>
            <div class="col-md-4">
                <h6 class="fw-bold">Quick Links</h6>
                <ul class="list-unstyled small">
                    <li><a href="#destinations" class="footer-link nav-smooth">Destinations</a></li>
                    <li><a href="#features" class="footer-link nav-smooth">Why Us</a></li>
                    <li><a href="#contact" class="footer-link nav-smooth">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="fw-bold">Follow the Walk</h6>
                <div class="d-flex gap-3 fs-5">
                    <a href="#" class="footer-link"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="footer-link"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="footer-link"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>
        <hr class="border-secondary">
        <p class="text-center small text-white-50 mb-0">&copy; 2026 TrapoWalks — ICT2206 Mini Project. All rights reserved.</p>
    </div>
</footer>

<button id="backToTop" class="btn btn-brand rounded-circle shadow" aria-label="Back to top"><i class="bi bi-arrow-up"></i></button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
