<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('Payame - Loan Tracker')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icon-css@4.1.7/css/flag-icons.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg py-3" style="background-color: #0C59B3;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
              <img src="/img/logo_h.png" alt="Payame Logo" width="120" class="me-2">
            </a>
            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle rounded-pill d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="flag-icon flag-icon-us"></span>
                        <span>English</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="/en">
                                <span class="flag-icon flag-icon-us"></span>
                                <span>English</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="/es">
                                <span class="flag-icon flag-icon-es"></span>
                                <span>Español</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="/fr">
                                <span class="flag-icon flag-icon-fr"></span>
                                <span>Français</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="btn btn-light rounded-pill px-4">@lang('home.sign_in')</button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="py-5 text-center text-white" style="background: linear-gradient(to right, #0C59B3, #1a75df);">
        <div class="container py-5">
            <h1 class="display-4 fw-bold mb-4">@lang('home.hero_title')</h1>
            <p class="lead mb-4 mx-auto" style="max-width: 600px;">
                @lang('home.hero_subtitle')
            </p>
            <button class="btn btn-light rounded-pill px-4 py-2">
                @lang('home.get_started') <i class="bi bi-arrow-right ms-2"></i>
            </button>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <div class="text-primary mb-4">
                            <i class="bi bi-bar-chart-fill fs-1" style="color: #0C59B3;"></i>
                        </div>
                        <h3 class="h4 mb-3">@lang('home.smart_analytics')</h3>
                        <p class="text-muted">@lang('Get detailed insights into your loan portfolio with intuitive charts and reports that help you make informed decisions.')</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <div class="text-primary mb-4">
                            <i class="bi bi-shield-fill-check fs-1" style="color: #0C59B3;"></i>
                        </div>
                        <h3 class="h4 mb-3">@lang('home.secure_platform')</h3>
                        <p class="text-muted">@lang('Your financial data is protected with bank-level security measures, ensuring your information stays private and secure.')</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <div class="text-primary mb-4">
                            <i class="bi bi-clock-fill fs-1" style="color: #0C59B3;"></i>
                        </div>
                        <h3 class="h4 mb-3">@lang('home.payment_reminders')</h3>
                        <p class="text-muted">@lang('Never miss a payment with automated reminders and notifications that keep you on track with your loan schedules.')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-5">
        <div class="container py-5">
            <h2 class="text-center display-5 mb-5">@lang('Simple Loan Management in 3 Easy Steps')</h2>
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="bi bi-clipboard-check fs-2" style="color: #0C59B3;"></i>
                    </div>
                    <h3 class="h4 mb-3">@lang('1. Add Your Loans')</h3>
                    <p class="text-muted">@lang('Enter your loan details and let Payame organize everything for you')</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="bi bi-graph-up fs-2" style="color: #0C59B3;"></i>
                    </div>
                    <h3 class="h4 mb-3">@lang('2. Track Progress')</h3>
                    <p class="text-muted">@lang('Monitor your payments and see your progress in real-time')</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="bi bi-arrow-right-circle fs-2" style="color: #0C59B3;"></i>
                    </div>
                    <h3 class="h4 mb-3">@lang('3. Stay on Track')</h3>
                    <p class="text-muted">@lang('Receive notifications and stay ahead of your payment schedule')</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5" style="background-color: #0C59B3;">
        <div class="container py-5 text-center text-white">
            <h2 class="display-5 mb-4">@lang('Ready to Simplify Your Loan Management?')</h2>
            <p class="lead mb-4">@lang('Join thousands of users who are taking control of their loans with Payame')</p>
            <button class="btn btn-light rounded-pill px-4 py-2">
                @lang('Get Started Now') <i class="bi bi-arrow-right ms-2"></i>
            </button>
        </div>
    </section>

    <!-- App Download Section -->
    <section class="py-5 bg-light">
      <div class="container py-5 text-center">
        <h2 class="display-5 mb-3">@lang('Get the Payame App')</h2>
        <p class="lead text-muted mb-5">@lang('Download our mobile app to manage your loans on the go')</p>
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-3">
                <a href="#" class="text-decoration-none">
                    <div class="bg-black text-white rounded-4 px-4 py-2 d-flex align-items-center" style="min-width: 200px;">
                        <i class="bi bi-apple fs-2 me-3"></i>
                        <div class="text-start">
                            <div class="small">@lang('Download on the')</div>
                            <div class="fs-5 fw-bold">@lang('App Store')</div>
                        </div>
                    </div>
                </a>
                <a href="#" class="text-decoration-none">
                    <div class="bg-black text-white rounded-4 px-4 py-2 d-flex align-items-center" style="min-width: 200px;">
                        <i class="bi bi-google-play fs-2 me-3"></i>
                        <div class="text-start">
                            <div class="small">@lang('Get it on')</div>
                            <div class="fs-5 fw-bold">@lang('Google Play')</div>
                        </div>
                    </div>
                </a>
              </div>
            </div>
          </div>
      </div>
    </section>

    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <h3 class="h5 mb-3">@lang('Payame')</h3>
                    <p class="text-muted">@lang('Simplifying loan management for everyone')</p>
                </div>
                <div class="col-md-3">
                    <h4 class="h6 mb-3">@lang('Legal')</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-muted text-decoration-none">@lang('Privacy Policy')</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">@lang('Terms of Service')</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h4 class="h6 mb-3">@lang('Contact')</h4>
                    <ul class="list-unstyled text-muted">
                        <li><i class="bi bi-envelope me-2"></i>support@payame.com</li>
                        <li><i class="bi bi-telephone me-2"></i>(555) 123-4567</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <p class="text-muted">&copy; <script>document.write(new Date().getFullYear())</script> @lang('Payame'). @lang('All rights reserved.')</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
