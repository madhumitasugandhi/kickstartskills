@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Course Catalog')

@section('content')
<style>
    /* Theme Variables */
    :root {
            --bg-body: #f8f9fa;
            --bg-sidebar: #ffffff;
            --bg-card: #ffffff;
            --bg-hover: #f8f9fa;

            --text-main: #343a40;
            --text-muted: #6c757d;

            --border-color: #e9ecef;

            /* Soft Colors */
            --soft-blue: #e7f1ff;
            --text-blue: #0d6efd;
            --soft-green: #d1e7dd;
            --text-green: #0f5132;
            --soft-orange: #ffecb5;
            --text-orange: #664d03;
            --soft-red: #f8d7da;
            --text-red: #842029;
            --soft-teal: #e0fbf6;
            --text-teal: #107c6f;
        }

        [data-theme="dark"] {
            --bg-body: #0f1626;
            --bg-sidebar: #1e293b;
            --bg-card: #2e333f;
            --bg-hover: #2e333f;

            --text-main: #e9ecef;
            --text-muted: #adb5bd;

            --border-color: #767677;

            /* Dark Mode Transparencies */
            --soft-blue: rgba(13, 110, 253, 0.15);
            --text-blue: #6ea8fe;
            --soft-green: rgba(25, 135, 84, 0.15);
            --text-green: #75b798;
            --soft-orange: rgba(255, 193, 7, 0.15);
            --text-orange: #ffda6a;
            --soft-red: rgba(220, 53, 69, 0.15);
            --text-red: #ea868f;
            --soft-teal: rgba(32, 201, 151, 0.15);
            --text-teal: #a9e5d6;
        }

    /* Search Bar */
    .search-container {
        position: relative;
        margin-bottom: 32px;
    }
    .search-input {
        padding: 16px 16px 16px 48px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        background-color: var(--bg-card);
        color: var(--text-main);
        width: 100%;
        transition: 0.2s;
    }
    .search-input:focus {
        border-color: var(--text-blue);
        box-shadow: 0 0 0 4px var(--soft-blue);
        outline: none;
    }
    .search-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 1.2rem;
    }

    /* Category Cards */
    .category-scroll {
        display: flex;
        gap: 16px;
        overflow-x: auto;
        padding-bottom: 8px;
        margin-bottom: 32px;
    }
    .category-card {
        min-width: 140px;
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 16px;
        text-align: center;
        cursor: pointer;
        transition: 0.2s;
    }
    .category-card:hover {
        transform: translateY(-4px);
        border-color: var(--text-blue);
    }
    .category-card.active {
        background-color: var(--soft-blue);
        border-color: var(--text-blue);
        color: var(--text-blue);
    }
    .cat-icon {
        font-size: 1.8rem;
        margin-bottom: 8px;
        display: block;
    }
    .cat-count {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    /* Course Cards */
    .course-card {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        overflow: hidden;
        height: 100%;
        transition: transform 0.2s;
        display: flex;
        flex-direction: column;
    }
    .course-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.06);
    }

    .thumbnail-box {
        height: 180px;
        background-color: #e0f2fe;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .thumbnail-icon {
        font-size: 3rem;
        color: rgba(13, 110, 253, 0.3);
    }
    .play-overlay {
        width: 48px; height: 48px;
        background: rgba(255,255,255,0.9);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: var(--text-blue);
        font-size: 1.5rem;
        opacity: 0.9;
    }

    .badge-float {
        position: absolute;
        top: 12px; left: 12px;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
    }
    .bg-bestseller { background-color: #ffc107; color: #000; }
    .bg-new { background-color: #198754; color: #fff; }
    .bg-discount { background-color: #dc3545; color: #fff; }

    .course-body { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; }

    .course-title {
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 6px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .instructor { font-size: 0.85rem; color: var(--text-blue); margin-bottom: 12px; }

    .rating-row {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
        color: #ffc107;
        margin-bottom: 12px;
        font-weight: 700;
    }
    .rating-count { color: var(--text-muted); font-weight: 400; font-size: 0.8rem; }

    .price-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: auto;
        padding-top: 16px;
        border-top: 1px solid var(--border-color);
    }
    .price-current { font-size: 1.1rem; font-weight: 800; color: var(--text-main); }
    .price-original { font-size: 0.9rem; text-decoration: line-through; color: var(--text-muted); }

    .enroll-btn {
        width: 100%;
        background-color: var(--soft-blue);
        color: var(--text-blue);
        border: none;
        padding: 10px;
        font-weight: 600;
        margin-top: 16px;
        border-radius: 8px;
        transition: 0.2s;
    }
    .enroll-btn:hover { background-color: var(--text-blue); color: white; }

    .enroll-btn-free {
        width: 100%;
        background-color: var(--soft-green);
        color: var(--text-green);
        border: none;
        padding: 10px;
        font-weight: 600;
        margin-top: 16px;
        border-radius: 8px;
        transition: 0.2s;
    }
    .enroll-btn-free:hover { background-color: var(--text-green); color: white; }

    .category-scroll::-webkit-scrollbar { display: none; }
</style>

<div class="content-body">

    <!-- 1. Search Bar -->
    <div class="search-container">
        <i class="bi bi-search search-icon"></i>
        <input type="text" class="search-input" placeholder="Search courses, skills, instructors...">
    </div>

    <!-- 2. Browse by Category -->
    <h6 class="fw-bold text-main mb-3">Browse by Category</h6>
    <div class="category-scroll">
        <div class="category-card active">
            <i class="bi bi-grid cat-icon"></i>
            <div class="fw-bold text-main">All</div>
            <div class="cat-count">156 courses</div>
        </div>
        <div class="category-card">
            <i class="bi bi-phone cat-icon text-primary"></i>
            <div class="fw-bold text-main">Mobile Dev</div>
            <div class="cat-count">28 courses</div>
        </div>
        <div class="category-card">
            <i class="bi bi-globe cat-icon text-success"></i>
            <div class="fw-bold text-main">Web Dev</div>
            <div class="cat-count">35 courses</div>
        </div>
        <div class="category-card">
            <i class="bi bi-bar-chart cat-icon text-warning"></i>
            <div class="fw-bold text-main">Data Science</div>
            <div class="cat-count">22 courses</div>
        </div>
        <div class="category-card">
            <i class="bi bi-cpu cat-icon text-danger"></i>
            <div class="fw-bold text-main">AI & ML</div>
            <div class="cat-count">18 courses</div>
        </div>
        <div class="category-card">
            <i class="bi bi-megaphone cat-icon text-info"></i>
            <div class="fw-bold text-main">Digital Marketing</div>
            <div class="cat-count">25 courses</div>
        </div>
         <div class="category-card">
            <i class="bi bi-palette cat-icon text-primary"></i>
            <div class="fw-bold text-main">UI/UX Design</div>
            <div class="cat-count">19 courses</div>
        </div>
         <div class="category-card">
            <i class="bi bi-shield-lock cat-icon text-danger"></i>
            <div class="fw-bold text-main">Cybersecurity</div>
            <div class="cat-count">9 courses</div>
        </div>
    </div>

    <!-- 3. Featured Courses Grid -->
    <h6 class="fw-bold text-main mb-4">Featured Courses</h6>

    <div class="row g-4">

        <!-- Course 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="course-card">
                <div class="thumbnail-box">
                    <span class="badge-float bg-bestseller">Bestseller</span>
                    <div class="play-overlay"><i class="bi bi-play-fill"></i></div>
                </div>
                <div class="course-body">
                    <h6 class="course-title">Complete Flutter Development Bootcamp with Dart</h6>
                    <div class="instructor">by Sarah Kumar</div>
                    <div class="rating-row">
                        <span>4.9</span>
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                        <span class="rating-count">(2,847)</span>
                    </div>
                    <div class="price-row">
                        <span class="price-current">₹2,999</span>
                        <span class="price-original">₹4,999</span>
                    </div>
                    <button class="enroll-btn">Enroll Now</button>
                </div>
            </div>
        </div>

        <!-- Course 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="course-card">
                <div class="thumbnail-box" style="background-color: #d1e7dd;">
                    <span class="badge-float bg-new">New</span>
                    <span class="badge-float bg-discount" style="left: auto; right: 12px;">40% OFF</span>
                    <div class="play-overlay"><i class="bi bi-play-fill"></i></div>
                </div>
                <div class="course-body">
                    <h6 class="course-title">AI-Powered Web Applications with React & Python</h6>
                    <div class="instructor">by Prof. Michael Chen</div>
                    <div class="rating-row">
                        <span>4.8</span>
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        <span class="rating-count">(1,923)</span>
                    </div>
                    <div class="price-row">
                        <span class="price-current">₹3,499</span>
                        <span class="price-original">₹5,999</span>
                    </div>
                    <button class="enroll-btn">Enroll Now</button>
                </div>
            </div>
        </div>

        <!-- Course 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="course-card">
                <div class="thumbnail-box" style="background-color: #fff3cd;">
                    <div class="play-overlay"><i class="bi bi-play-fill"></i></div>
                </div>
                <div class="course-body">
                    <h6 class="course-title">Full-Stack JavaScript Development (MERN)</h6>
                    <div class="instructor">by Rajesh Kumar</div>
                    <div class="rating-row">
                        <span>4.6</span>
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                        <span class="rating-count">(2,103)</span>
                    </div>
                    <div class="price-row">
                        <span class="text-success fw-bold fs-5">Free</span>
                    </div>
                    <button class="enroll-btn-free">Enroll Free</button>
                </div>
            </div>
        </div>

        <!-- Course 4 -->
        <div class="col-md-6 col-lg-4">
            <div class="course-card">
                <div class="thumbnail-box" style="background-color: #f8d7da;">
                    <span class="badge-float bg-bestseller">Bestseller</span>
                    <div class="play-overlay"><i class="bi bi-play-fill"></i></div>
                </div>
                <div class="course-body">
                    <h6 class="course-title">UI/UX Design Fundamentals with Figma</h6>
                    <div class="instructor">by Arjun Singh</div>
                    <div class="rating-row">
                        <span>4.7</span>
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                        <span class="rating-count">(1,432)</span>
                    </div>
                    <div class="price-row">
                        <span class="price-current">₹1,499</span>
                    </div>
                    <button class="enroll-btn">Enroll Now</button>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

