<?php
    // Pull real published news for the blog-preview strip. Fail soft so the
    // marketing page still renders if the DB is unreachable.
    $news_items = [];
    if (@include_once('action_php/database.php')) {
        if (isset($conn) && $conn) {
            $q = @mysqli_query($conn, "SELECT id, title, image FROM news_table WHERE status = 'published' ORDER BY id DESC LIMIT 3");
            if ($q) {
                while ($r = mysqli_fetch_assoc($q)) {
                    $news_items[] = $r;
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acadex — Run Your Whole School on One Platform</title>
    <meta name="description" content="Acadex is a complete school management platform — admissions to results. Attendance, CBT online exams, fees, communication and reporting for every role in your school.">

    <link rel="icon" href="image/school/logo.jpg">
    <link rel="stylesheet" href="css/headers_css.css?v=2">
    <link rel="stylesheet" href="css/homes_css.css?v=2">
    <link rel="stylesheet" href="css/footers_css.css?v=2">
    <link rel="stylesheet" href="css/sidebars_css.css?v=2">
</head>
<body>

    <?php include('general/header.php'); ?>

    <main id="main">

    <!-- ============================= HERO ============================= -->
    <section class="hero">
        <div class="wrap hero-inner">

            <div class="hero-copy" data-reveal>
                <div class="hero-tags">
                    <span class="rank">One platform</span>
                    <span class="verified">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M12 2l2.4 1.8 3 .1 1 2.8 2.4 1.8-1 2.8 1 2.8-2.4 1.8-1 2.8-3 .1L12 22l-2.4-1.8-3-.1-1-2.8L3.2 15.5l1-2.8-1-2.8L5.6 8.1l1-2.8 3-.1L12 2z" fill="currentColor" opacity=".18"/><path d="M8.5 12.5l2.5 2.5 4.5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Live in a real school, every school day
                    </span>
                </div>

                <h1>Run your <span class="accent">whole school</span> on one platform.</h1>

                <p class="hero-sub">
                    Stop stitching together spreadsheets, paper registers and separate exam tools.
                    Acadex runs your entire academic year — admissions, attendance, CBT exams,
                    results and fees — in one connected system, with a secure portal for every role.
                </p>

                <div class="hero-cta">
                    <a href="contact.php" class="btn btn-primary">Book a Demo</a>
                    <a href="#how" class="btn btn-outline on-dark">
                        <svg class="icon" viewBox="0 0 24 24" style="width:18px;height:18px;"><circle cx="12" cy="12" r="9"/><path d="M10 9l5 3-5 3V9z" fill="currentColor" stroke="none"/></svg>
                        See how it works
                    </a>
                </div>

                <div class="hero-proof">
                    <div class="avatars">
                        <span>D</span><span>P</span><span>A</span><span>E</span>
                    </div>
                    Already running the full academic year for a live pilot school
                </div>
            </div>

            <div class="hero-visual" data-reveal>
                <div class="mock-card mock-main">
                    <div class="mock-head">
                        <span class="brand" style="color:var(--ink)">
                            <span class="brand-mark">
                                <svg viewBox="0 0 24 24" fill="none"><path d="M12 3L2 8l10 5 10-5-10-5z" stroke="#fff" stroke-width="1.6" stroke-linejoin="round"/><path d="M6 10.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-5.5" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            Acadex
                        </span>
                        <span class="mock-dots"><i></i><i></i><i></i></span>
                    </div>

                    <div class="mock-stats">
                        <div class="mock-stat primary">
                            <div class="label">Total Students</div>
                            <div class="value">1,740</div>
                            
                            <div class="sub">Both arms · this session</div>
                        </div>
                        <div class="mock-stat">
                            <div class="label">Staff</div>
                            <div class="value">38</div>
                            <div class="sub">Attendance tracked</div>
                        </div>
                        <div class="mock-stat">
                            <div class="label">Results Approved</div>
                            <div class="value">96%</div>
                            <div class="sub">Awaiting compilation</div>
                        </div>
                        <div class="mock-stat">
                            <div class="label">Fees Collected</div>
                            <div class="value">₦12.4m</div>
                            <div class="sub">This term</div>
                        </div>
                    </div>

                    <div class="mock-chart">
                        <div class="chart-top">
                            <span class="t">Fee collection · this term</span>
                            <span class="v">₦12.4m</span>
                        </div>
                        <svg viewBox="0 0 320 64" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="g" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0" stop-color="#7c3aed" stop-opacity=".28"/>
                                    <stop offset="1" stop-color="#7c3aed" stop-opacity="0"/>
                                </linearGradient>
                            </defs>
                            <path d="M0 50 C40 46 60 30 90 32 S150 20 180 24 240 8 320 14" fill="none" stroke="#7c3aed" stroke-width="2.5" stroke-linecap="round"/>
                            <path d="M0 50 C40 46 60 30 90 32 S150 20 180 24 240 8 320 14 L320 64 L0 64 Z" fill="url(#g)"/>
                        </svg>
                    </div>
                </div>

                <div class="mock-float f1">
                    <div class="label">New enrollments</div>
                    <div class="value">+24</div>
                </div>

                <div class="mock-float f2">
                    <div class="row">
                        <span class="chip-ico">
                            <svg class="icon" viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h10"/></svg>
                        </span>
                        <div>
                            <div class="label">CBT exam</div>
                            <div class="value">Live now</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ===================== TRUSTED / ROLES STRIP ===================== -->
    <section class="trusted">
        <div class="wrap">
            <p>One connected system for every role in your school</p>
            <div class="trusted-logos">
                <span>Director</span>
                <span>Principal</span>
                <span>Admin Officer</span>
                <span>Academic Officer</span>
                <span>Exam Officer</span>
                <span>Finance Officer</span>
                <span>Form Masters</span>
            </div>
        </div>
    </section>

    <!-- ============================ PROBLEM ============================ -->
    <section class="section bg-soft" id="problem">
        <div class="wrap">
            <div class="section-head center" data-reveal>
                <span class="eyebrow">The problem</span>
                <h2>Running a school on spreadsheets and paper is quietly costing you</h2>
                <p>Scores live in one file, fees in another, attendance on a paper register — and none of it reconciles. Every term-end becomes a scramble that steals time from teaching and leadership.</p>
            </div>

            <div class="card-grid">

                <div class="feature-card" data-reveal>
                    <div class="feature-ico">
                        <svg class="icon" viewBox="0 0 24 24"><rect x="4" y="4" width="7" height="7" rx="1"/><rect x="13" y="13" width="7" height="7" rx="1"/><path d="M11 7h4a2 2 0 012 2v4"/></svg>
                    </div>
                    <h3>Disconnected tools</h3>
                    <p>Separate spreadsheets and registers for scores, fees and attendance mean the same data is keyed three times — and still never adds up.</p>
                </div>

                <div class="feature-card" data-reveal>
                    <div class="feature-ico">
                        <svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                    </div>
                    <h3>Days lost to compilation</h3>
                    <p>Working out class positions and printing result sheets by hand eats days of staff time and invites the kind of errors parents notice first.</p>
                </div>

                <div class="feature-card" data-reveal>
                    <div class="feature-ico">
                        <svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M9.6 9.2a2.5 2.5 0 113.4 2.5V13"/><path d="M12 16.5v.01"/></svg>
                    </div>
                    <h3>No single source of truth</h3>
                    <p>When the director asks how the term is really going, the answer takes a week of chasing officers for numbers that never quite match.</p>
                </div>

            </div>

            <p class="pricing-foot" style="margin-top:28px;">Acadex replaces all of it with one connected system — here is how it fits together.</p>
        </div>
    </section>

    <!-- ============================ STATS ============================ -->
    <section class="section tight bg-ink">
        <div class="wrap">
            <div class="stats-band">
                <div class="stat-block" data-reveal>
                    <div class="num">7</div>
                    <div class="cap">Dedicated role portals, each with its own secure login</div>
                </div>
                <div class="stat-block" data-reveal>
                    <div class="num">2</div>
                    <div class="cap">School arms — nursery/primary and secondary — run side by side</div>
                </div>
                <div class="stat-block" data-reveal>
                    <div class="num">100%</div>
                    <div class="cap">Auto-marked CBT exams with instant results and positions</div>
                </div>
                <div class="stat-block" data-reveal>
                    <div class="num">1</div>
                    <div class="cap">Login-to-results workflow, wired end to end</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======================= CORE FEATURES ======================= -->
    <section class="section" id="features">
        <div class="wrap">
            <div class="section-head center" data-reveal>
                <span class="eyebrow">Core capabilities</span>
                <h2>Everything a school needs to run — in one place</h2>
                <p>No spreadsheets stitched together, no separate tools for exams and fees. Acadex handles the full academic year from registration to printed result sheets.</p>
            </div>

            <div class="card-grid">

                <div class="feature-card" data-reveal>
                    <div class="feature-ico">
                        <svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="8" r="3.2"/><path d="M5 20c0-3.3 3.1-5.5 7-5.5s7 2.2 7 5.5"/></svg>
                    </div>
                    <h3>Student Information</h3>
                    <p>Onboard a whole session in an afternoon. Register and edit students and pupils across both arms, sort them into classes, generate PINs and print detail sheets — all from the admin officer's hub.</p>
                </div>

                <div class="feature-card" data-reveal>
                    <div class="feature-ico">
                        <svg class="icon" viewBox="0 0 24 24"><rect x="4" y="5" width="16" height="15" rx="2"/><path d="M8 3v4M16 3v4M4 10h16M9 14l1.5 1.5L14 12"/></svg>
                    </div>
                    <h3>Attendance</h3>
                    <p>Retire the paper register for good. Form masters take daily attendance for their class each term while staff attendance is recorded centrally, and daily and termly summaries roll up automatically.</p>
                </div>

                <div class="feature-card" data-reveal>
                    <div class="feature-ico">
                        <svg class="icon" viewBox="0 0 24 24"><path d="M8 3H6a2 2 0 00-2 2v14a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2h-2"/><rect x="8" y="2" width="8" height="4" rx="1"/><path d="M9 12l2 2 4-4"/></svg>
                    </div>
                    <h3>Examination &amp; Results</h3>
                    <p>Turn days of result compilation into minutes. Enter CA and exam scores per class, compile results with per-subject class positions, route through academic-officer approval, and print result sheets as PDF.</p>
                </div>

                <div class="feature-card" data-reveal>
                    <div class="feature-ico">
                        <svg class="icon" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="14" rx="2"/><path d="M3 18l4 3M21 18l-4 3M8 9h8M8 13h5"/></svg>
                    </div>
                    <h3>Online Exams (CBT)</h3>
                    <p>Run exams that mark themselves. Create question banks, open and close exams, and let students sit randomized MCQs at the hall machine — every script auto-marked with results ready to print.</p>
                </div>

                <div class="feature-card" data-reveal>
                    <div class="feature-ico">
                        <svg class="icon" viewBox="0 0 24 24"><path d="M12 3v18M17 6.5c0-1.4-2-2.5-5-2.5S7 5 7 6.5 9 9 12 9s5 1.1 5 2.5-2 2.5-5 2.5-5-1.1-5-2.5"/></svg>
                    </div>
                    <h3>Finance &amp; Fees</h3>
                    <p>Generate class vouchers, set amounts, record payments, deposits and withdrawals — with principal approval on withdrawals and printable transaction PDFs.</p>
                </div>

                <div class="feature-card" data-reveal>
                    <div class="feature-ico">
                        <svg class="icon" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h10"/><circle cx="19" cy="18" r="2.4"/></svg>
                    </div>
                    <h3>Reports &amp; Analytics</h3>
                    <p>Academic officers get general, subject and class-level performance analytics across CA, exam and final results for both students and pupils.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================= MODULES / SINGLE STOP ======================= -->
    <section class="section bg-soft" id="modules">
        <div class="wrap">
            <div class="section-head center" data-reveal>
                <span class="eyebrow">Single-stop solution</span>
                <h2>Comprehensive modules for every part of school management</h2>
                <p>The essentials are live today. The badged modules are on the roadmap — tell us which matters most and we'll prioritise it.</p>
            </div>

            <div class="module-grid">

                <div class="module-tile" data-reveal>
                    <span class="m-ico"><svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="8" r="3.2"/><path d="M5 20c0-3.3 3.1-5.5 7-5.5s7 2.2 7 5.5"/></svg></span>
                    <h3>Student &amp; Class Setup</h3>
                    <p>Registration, class insertion, subjects and PIN generation — the operational backbone.</p>
                </div>

                <div class="module-tile" data-reveal>
                    <span class="m-ico"><svg class="icon" viewBox="0 0 24 24"><rect x="4" y="5" width="16" height="15" rx="2"/><path d="M8 3v4M16 3v4M4 10h16"/></svg></span>
                    <h3>Attendance</h3>
                    <p>Per-term form-master credentials, daily entry, and termly summaries per class.</p>
                </div>

                <div class="module-tile" data-reveal>
                    <span class="m-ico"><svg class="icon" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="14" rx="2"/><path d="M8 9h8M8 13h5"/></svg></span>
                    <h3>CBT Online Exams</h3>
                    <p>Question banks, exam status control, randomized delivery and auto-marking.</p>
                </div>

                <div class="module-tile" data-reveal>
                    <span class="m-ico"><svg class="icon" viewBox="0 0 24 24"><path d="M12 3v18M17 6.5C17 5 15 4 12 4S7 5 7 6.5 9 9 12 9s5 1.1 5 2.5"/></svg></span>
                    <h3>Fee Management</h3>
                    <p>Vouchers, payments, deposits, withdrawals and printable transaction records.</p>
                </div>

                <div class="module-tile" data-reveal>
                    <span class="m-ico"><svg class="icon" viewBox="0 0 24 24"><path d="M4 20V10M10 20V4M16 20v-8M20 20H2"/></svg></span>
                    <h3>Performance Analytics</h3>
                    <p>Subject, class and general breakdowns across CA, exam and result stages.</p>
                </div>

                <div class="module-tile" data-reveal>
                    <span class="m-ico"><svg class="icon" viewBox="0 0 24 24"><path d="M4 5h16v11H7l-3 3V5z"/></svg></span>
                    <h3>Communication</h3>
                    <p>Public enquiry form routes messages to staff, plus a published news channel.</p>
                </div>

                <div class="module-tile" data-reveal>
                    <span class="m-ico"><svg class="icon" viewBox="0 0 24 24"><path d="M4 6h13l3 3v9H4z"/><circle cx="9" cy="18" r="1.6"/><circle cx="17" cy="18" r="1.6"/></svg></span>
                    <h3>Transport <span class="badge-soon">Soon</span></h3>
                    <p>Routes, vehicles and pickup tracking — on the roadmap.</p>
                </div>

                <div class="module-tile" data-reveal>
                    <span class="m-ico"><svg class="icon" viewBox="0 0 24 24"><path d="M4 6c2-1 5-1 8 0v13c-3-1-6-1-8 0zM20 6c-2-1-5-1-8 0v13c3-1 6-1 8 0z"/></svg></span>
                    <h3>Library <span class="badge-soon">Soon</span></h3>
                    <p>Catalogue, lending and returns — on the roadmap.</p>
                </div>

                <div class="module-tile" data-reveal>
                    <span class="m-ico"><svg class="icon" viewBox="0 0 24 24"><path d="M12 3l2.5 1.8 M12 3v6M4 10l8-4 8 4-8 4-8-4zM6 12v5c0 1.5 2.7 3 6 3s6-1.5 6-3v-5"/></svg></span>
                    <h3>Online Learning <span class="badge-soon">Soon</span></h3>
                    <p>Lessons, assignments and an LMS layer — on the roadmap.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================= HOW IT WORKS ======================= -->
    <section class="section">
        <div class="wrap">
            <div class="section-head center" data-reveal>
                <span class="eyebrow">How it works</span>
                <h2>From staff onboarding to printed results</h2>
                <p>Acadex follows the real chain a school runs each year — every step passes cleanly to the next.</p>
            </div>

            <div class="steps">
                <div class="step" data-reveal>
                    <div class="step-n">1</div>
                    <h3>Onboard your team</h3>
                    <p>The director registers the principal, who sets up the academic, exam, finance and admin officers — each with an email-verified login.</p>
                </div>
                <div class="step" data-reveal>
                    <div class="step-n">2</div>
                    <h3>Set up the year</h3>
                    <p>The admin officer registers classes and students, and provisions form-master attendance credentials per term.</p>
                </div>
                <div class="step" data-reveal>
                    <div class="step-n">3</div>
                    <h3>Assess &amp; approve</h3>
                    <p>The exam officer enters CA and exam scores or runs CBT; the academic officer approves results before compilation.</p>
                </div>
                <div class="step" data-reveal>
                    <div class="step-n">4</div>
                    <h3>Compile &amp; collect</h3>
                    <p>Print result sheets with class positions, while finance tracks vouchers, payments and approved withdrawals.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ======================= ROLE PORTALS ======================= -->
    <section class="section bg-soft" id="portals">
        <div class="wrap">
            <div class="section-head center" data-reveal>
                <span class="eyebrow">Role-based portals</span>
                <h2>Every role gets exactly the portal it needs</h2>
                <p>Separate, session-gated logins — no shared dashboards, no seeing what isn't yours.</p>
            </div>

            <div class="portal-grid">

                <div class="portal-card" data-reveal>
                    <span class="p-ico"><svg class="icon" viewBox="0 0 24 24"><path d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z"/></svg></span>
                    <div>
                        <h3>Director</h3>
                        <p>Register principals, verify their email, and view principal details.</p>
                        <a href="administration/director/director_login.php" class="p-link">Log in <svg class="icon" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
                    </div>
                </div>

                <div class="portal-card" data-reveal>
                    <span class="p-ico"><svg class="icon" viewBox="0 0 24 24"><circle cx="12" cy="7" r="3.2"/><path d="M5 20c0-3.3 3.1-5.5 7-5.5s7 2.2 7 5.5"/></svg></span>
                    <div>
                        <h3>Principal</h3>
                        <p>Manage the four officer roles and approve finance withdrawals.</p>
                        <a href="administration/principal/principal_login.php" class="p-link">Log in <svg class="icon" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
                    </div>
                </div>

                <div class="portal-card" data-reveal>
                    <span class="p-ico"><svg class="icon" viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="2"/><path d="M8 9h8M8 13h5"/></svg></span>
                    <div>
                        <h3>Admin Officer</h3>
                        <p>The operational hub: students, classes, subjects, staff, PINs and news.</p>
                        <a href="administration/admin_officer/admin_officer_login.php" class="p-link">Log in <svg class="icon" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
                    </div>
                </div>

                <div class="portal-card" data-reveal>
                    <span class="p-ico"><svg class="icon" viewBox="0 0 24 24"><path d="M4 19V5M4 19h16M8 16v-4M12 16V8M16 16v-6"/></svg></span>
                    <div>
                        <h3>Academic Officer</h3>
                        <p>Performance analytics plus CA and exam result approval workflows.</p>
                        <a href="administration/academic_officer/academic_officer_login.php" class="p-link">Log in <svg class="icon" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
                    </div>
                </div>

                <div class="portal-card" data-reveal>
                    <span class="p-ico"><svg class="icon" viewBox="0 0 24 24"><path d="M8 3H6a2 2 0 00-2 2v14a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2h-2"/><rect x="8" y="2" width="8" height="4" rx="1"/><path d="M9 13l2 2 4-4"/></svg></span>
                    <div>
                        <h3>Exam Officer</h3>
                        <p>The results engine: score entry, compilation, CBT and result prints.</p>
                        <a href="administration/exam_officer/exam_officer_login.php" class="p-link">Log in <svg class="icon" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
                    </div>
                </div>

                <div class="portal-card" data-reveal>
                    <span class="p-ico"><svg class="icon" viewBox="0 0 24 24"><rect x="3" y="6" width="18" height="12" rx="2"/><circle cx="12" cy="12" r="2.4"/><path d="M6 9v6M18 9v6"/></svg></span>
                    <div>
                        <h3>Finance Officer</h3>
                        <p>Vouchers, fee payments, deposits, withdrawals and transaction PDFs.</p>
                        <a href="administration/finance/finance_officer_login.php" class="p-link">Log in <svg class="icon" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================= WHY ACADEX ======================= -->
    <section class="section bg-ink" id="why">
        <div class="wrap why-split">

            <div data-reveal>
                <span class="eyebrow on-dark">Why Acadex</span>
                <h2 class="section-head" style="color:#fff;margin-bottom:6px;">Built from the way schools actually run</h2>
                <p style="color:rgba(255,255,255,0.7);font-size:17px;margin-bottom:8px;">Not a generic admin tool bent to fit — every module follows a real school's chain of work, both nursery/primary and secondary.</p>

                <div class="why-list">
                    <div class="why-item">
                        <span class="w-ico"><svg class="icon" viewBox="0 0 24 24"><path d="M9 18h6M10 21h4M12 3a6 6 0 00-4 10.5c.6.6 1 1.3 1 2.1V16h6v-.4c0-.8.4-1.5 1-2.1A6 6 0 0012 3z"/></svg></span>
                        <div>
                            <h3>Wired end to end</h3>
                            <p>Onboarding, year setup, results and fees pass cleanly from one role to the next — no re-keying between disconnected tools.</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <span class="w-ico"><svg class="icon" viewBox="0 0 24 24"><path d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z"/><path d="M9 12l2 2 4-4"/></svg></span>
                        <div>
                            <h3>Separation by design</h3>
                            <p>Every role has its own session-gated portal, so people only ever touch what belongs to their job.</p>
                        </div>
                    </div>
                    <div class="why-item">
                        <span class="w-ico"><svg class="icon" viewBox="0 0 24 24"><path d="M4 6c2-1 5-1 8 0v13c-3-1-6-1-8 0zM20 6c-2-1-5-1-8 0v13c3-1 6-1 8 0z"/></svg></span>
                        <div>
                            <h3>Two arms, one system</h3>
                            <p>Nursery/primary and secondary run in parallel, each with its own students, classes, exams and finances.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="why-visual" data-reveal>
                <div class="why-ring">
                    <div class="ring" style="--p:100">
                        <b>CBT</b>
                    </div>
                    <div class="rtext">
                        <h3>Exams that mark themselves</h3>
                        <p>Students sit randomized MCQs at the hall machine and results are scored the moment they submit — ready to view and print.</p>
                    </div>
                </div>
                <div class="why-badges">
                    <span>Email-verified logins</span>
                    <span>Per-term attendance</span>
                    <span>Class positions</span>
                    <span>Approval workflows</span>
                    <span>Printable PDFs</span>
                </div>
            </div>

        </div>
    </section>

    <!-- ======================= PRICING ======================= -->
    <section class="section" id="pricing">
        <div class="wrap">
            <div class="section-head center" data-reveal>
                <span class="eyebrow">Pricing</span>
                <h2>Simple plans that scale with your school</h2>
                <p>Indicative pricing while we finalise packaging. Talk to us and we'll tailor a plan to your enrolment and the arms you run.</p>
            </div>

            <div class="pricing-grid">

                <div class="price-card" data-reveal>
                    <h3>Starter</h3>
                    <p class="p-desc">For a single small school getting the essentials online.</p>
                    <div class="price-amount"><span class="amt">₦0</span><span class="per">/ setup pilot</span></div>
                    <p class="p-note">Indicative — confirmed on demo</p>
                    <ul class="price-features">
                        <li><svg class="icon" viewBox="0 0 24 24"><path d="M5 12l4 4 10-10"/></svg> Student &amp; class registration</li>
                        <li><svg class="icon" viewBox="0 0 24 24"><path d="M5 12l4 4 10-10"/></svg> Attendance tracking</li>
                        <li><svg class="icon" viewBox="0 0 24 24"><path d="M5 12l4 4 10-10"/></svg> Result entry &amp; prints</li>
                        <li><svg class="icon" viewBox="0 0 24 24"><path d="M5 12l4 4 10-10"/></svg> Up to 3 role portals</li>
                    </ul>
                    <a href="#" class="btn btn-outline btn-block nav-soon" data-soon="Guided demos are launching soon — reach us through the Contact page.">Book a demo</a>
                </div>

                <div class="price-card featured" data-reveal>
                    <h3>School</h3>
                    <p class="p-desc">The full workflow for a school running both arms.</p>
                    <div class="price-amount"><span class="amt">Custom</span><span class="per">/ term</span></div>
                    <p class="p-note">Priced on enrolment &amp; arms</p>
                    <ul class="price-features">
                        <li><svg class="icon" viewBox="0 0 24 24"><path d="M5 12l4 4 10-10"/></svg> Everything in Starter</li>
                        <li><svg class="icon" viewBox="0 0 24 24"><path d="M5 12l4 4 10-10"/></svg> All 7 role portals</li>
                        <li><svg class="icon" viewBox="0 0 24 24"><path d="M5 12l4 4 10-10"/></svg> CBT online exams</li>
                        <li><svg class="icon" viewBox="0 0 24 24"><path d="M5 12l4 4 10-10"/></svg> Finance, fees &amp; approvals</li>
                        <li><svg class="icon" viewBox="0 0 24 24"><path d="M5 12l4 4 10-10"/></svg> Performance analytics</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-block nav-soon" data-soon="Self-serve sign-up is launching soon — use Book a Demo or Contact us and we'll set your school up.">Start free trial</a>
                </div>

                <div class="price-card" data-reveal>
                    <h3>Group</h3>
                    <p class="p-desc">For a group of schools managed together.</p>
                    <div class="price-amount"><span class="amt">Let's talk</span></div>
                    <p class="p-note">Multi-school onboarding</p>
                    <ul class="price-features">
                        <li><svg class="icon" viewBox="0 0 24 24"><path d="M5 12l4 4 10-10"/></svg> Everything in School</li>
                        <li><svg class="icon" viewBox="0 0 24 24"><path d="M5 12l4 4 10-10"/></svg> Super admin oversight</li>
                        <li><svg class="icon" viewBox="0 0 24 24"><path d="M5 12l4 4 10-10"/></svg> Priority onboarding support</li>
                        <li><svg class="icon" viewBox="0 0 24 24"><path d="M5 12l4 4 10-10"/></svg> Roadmap module early access</li>
                    </ul>
                    <a href="contact.php" class="btn btn-outline btn-block">Contact sales</a>
                </div>

            </div>
            <p class="pricing-foot">All plans include the modules that are live today. Roadmap modules (transport, library, LMS and more) are added as they ship.</p>
        </div>
    </section>

    <!-- ======================= TESTIMONIALS ======================= -->
    <section class="section bg-soft">
        <div class="wrap">
            <div class="section-head center" data-reveal>
                <span class="eyebrow">In their words</span>
                <h2>What running on Acadex feels like</h2>
                <p>Reflections from the roles that use it day to day.</p>
            </div>

            <div class="quote-grid">

                <div class="quote-card" data-reveal>
                    <div class="q-mark">&ldquo;</div>
                    <p>Score entry, approval and printing used to live in three different places. Now the exam officer enters, I approve, and the sheets come out with positions already worked out.</p>
                    <div class="quote-author">
                        <span class="qa-avatar">AO</span>
                        <div>
                            <div class="qa-name">Academic Officer</div>
                            <div class="qa-role">Secondary arm</div>
                        </div>
                    </div>
                </div>

                <div class="quote-card" data-reveal>
                    <div class="q-mark">&ldquo;</div>
                    <p>Provisioning a form master for the term takes a minute, and the daily and termly attendance just adds up on its own. I'm not chasing paper registers anymore.</p>
                    <div class="quote-author">
                        <span class="qa-avatar">AD</span>
                        <div>
                            <div class="qa-name">Admin Officer</div>
                            <div class="qa-role">Nursery / primary arm</div>
                        </div>
                    </div>
                </div>

                <div class="quote-card" data-reveal>
                    <div class="q-mark">&ldquo;</div>
                    <p>Vouchers, payments and withdrawals sit in one ledger, and nothing leaves without the principal's approval. Reconciling a term is finally straightforward.</p>
                    <div class="quote-author">
                        <span class="qa-avatar">FO</span>
                        <div>
                            <div class="qa-name">Finance Officer</div>
                            <div class="qa-role">Fees &amp; transactions</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================= FAQ ======================= -->
    <section class="section" id="faq">
        <div class="wrap">
            <div class="section-head center" data-reveal>
                <span class="eyebrow">FAQ</span>
                <h2>Questions schools ask us</h2>
            </div>

            <div class="faq-list" data-reveal>

                <div class="faq-item">
                    <button class="faq-q" type="button" aria-expanded="false">
                        Does Acadex handle both a primary and a secondary school?
                        <span class="plus"><svg class="icon" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg></span>
                    </button>
                    <div class="faq-a"><p>Yes. Acadex is built around two arms running in parallel — nursery/primary and secondary — each with its own students, classes, exams, attendance and finances, so a group of schools can operate them side by side.</p></div>
                </div>

                <div class="faq-item">
                    <button class="faq-q" type="button" aria-expanded="false">
                        How do online (CBT) exams work?
                        <span class="plus"><svg class="icon" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg></span>
                    </button>
                    <div class="faq-a"><p>The exam officer builds a question bank and opens the exam. A student logs in at the hall machine with their admission number and a generated PIN, then sits a randomized set of multiple-choice questions. Answers are auto-marked on submit, and results can be viewed and printed.</p></div>
                </div>

                <div class="faq-item">
                    <button class="faq-q" type="button" aria-expanded="false">
                        Who can see what?
                        <span class="plus"><svg class="icon" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg></span>
                    </button>
                    <div class="faq-a"><p>Each of the seven roles — director, principal, admin officer, academic officer, exam officer, finance officer and form masters — has its own separate, session-gated login. People only reach the portal for their own job.</p></div>
                </div>

                <div class="faq-item">
                    <button class="faq-q" type="button" aria-expanded="false">
                        Are results and transactions printable?
                        <span class="plus"><svg class="icon" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg></span>
                    </button>
                    <div class="faq-a"><p>Yes. Result sheets are compiled with per-subject class positions and exported as PDF, and finance transactions produce printable records as well.</p></div>
                </div>

                <div class="faq-item">
                    <button class="faq-q" type="button" aria-expanded="false">
                        What about modules like transport, library or an LMS?
                        <span class="plus"><svg class="icon" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg></span>
                    </button>
                    <div class="faq-a"><p>Those are on the roadmap and marked "Soon" across the site. The core academic, attendance, exam and finance workflows are live today. Tell us which upcoming module matters most and we'll prioritise it.</p></div>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================= BLOG PREVIEW ======================= -->
    <section class="section bg-soft">
        <div class="wrap">
            <div class="section-head center" data-reveal>
                <span class="eyebrow">From the blog</span>
                <h2>News &amp; updates</h2>
                <p>The latest published stories from the school news channel.</p>
            </div>

            <div class="blog-grid" data-reveal>
                <?php if (!empty($news_items)): ?>
                    <?php foreach ($news_items as $item): ?>
                        <a class="blog-card" href="news_view.php?id=<?php echo (int)$item['id']; ?>">
                            <div class="blog-thumb">
                                <?php if (!empty($item['image'])): ?>
                                    <img src="image/news/<?php echo htmlspecialchars($item['image']); ?>" alt="">
                                <?php endif; ?>
                            </div>
                            <div class="blog-body">
                                <span class="b-tag">School news</span>
                                <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                                <span class="b-link">Read more <svg class="icon" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="blog-empty">
                        No published stories yet. Once your admin officer publishes news, it appears here automatically.
                    </div>
                <?php endif; ?>
            </div>

            <div style="text-align:center;margin-top:32px;">
                <a href="news.php" class="btn btn-outline">View all news <svg class="icon" viewBox="0 0 24 24" style="width:16px;height:16px;"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
            </div>
        </div>
    </section>

    <!-- ======================= CTA BANNER ======================= -->
    <section class="section">
        <div class="wrap">
            <div class="cta-banner" data-reveal>
                <span class="eyebrow on-dark">Ready when you are</span>
                <h2>Ready to run your whole school on one platform?</h2>
                <p>See Acadex handle the full academic year — from onboarding your team to printing results.</p>
                <div class="hero-cta">
                    <a href="#" class="btn btn-primary nav-soon" data-soon="Self-serve sign-up is launching soon — use Book a Demo or Contact us and we'll set your school up.">Start Free Trial</a>
                    <a href="contact.php" class="btn btn-outline on-dark">Talk to us</a>
                </div>
            </div>
        </div>
    </section>

    </main>

    <?php include('general/footer.php'); ?>
    <?php include('general/sidebar.php'); ?>

    <script src="javascript/home_js.js?v=2"></script>
</body>
</html>
