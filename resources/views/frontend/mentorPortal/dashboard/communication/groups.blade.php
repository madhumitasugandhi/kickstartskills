@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Group Discussions')
@section('icon', 'bi bi-people-fill fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')
<style>
    /* Theme Variables & Dark Mode */
    :root {
        --bg-card: #ffffff;
        --bg-hover: #f8f9fa;
        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;

        --soft-blue: #e7f1ff; --text-blue: #0d6efd;
        --chat-sent-bg: #0d6efd; --chat-sent-text: #ffffff;
        --chat-recv-bg: #f1f5f9; --chat-recv-text: #343a40;
    }

    [data-theme="dark"] {
        --bg-card: #2e333f;
        --bg-hover: #334155;
        --text-main: #e9ecef;
        --text-muted: #94a3b8;
        --border-color: #334155;

        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
        --chat-sent-bg: #2563eb; --chat-sent-text: #ffffff;
        --chat-recv-bg: #334155; --chat-recv-text: #e2e8f0;
    }

    /* Main Container Height for Desktop */
    .chat-container {
        height: calc(100vh - 200px);
        min-height: 600px;
    }

    /* Left Sidebar: Group List */
    .group-sidebar {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .group-list {
        overflow-y: auto;
        flex-grow: 1;
        scrollbar-width: thin;
    }

    .group-item {
        padding: 16px;
        border-bottom: 1px solid var(--border-color);
        cursor: pointer;
        transition: 0.2s;
        display: flex;
        gap: 12px;
        align-items: flex-start;
        position: relative;
    }
    .group-item:hover { background-color: var(--bg-hover); }
    .group-item.active { background-color: var(--soft-orange); border-left: 3px solid var(--accent-color); }

    .group-icon {
        width: 48px; height: 48px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .bg-icon-blue { background-color: rgba(253, 69, 13, 0.1); color: var(--accent-color); }
    .bg-icon-teal { background-color: rgba(32, 201, 151, 0.1); color: #20c997; }
    .bg-icon-purple { background-color: rgba(111, 66, 193, 0.1); color: #6f42c1; }

    .unread-badge {
        background-color: var(--accent-color);
        color: white;
        font-size: 0.75rem;
        padding: 2px 8px;
        border-radius: 12px;
        font-weight: 600;
        margin-left: auto;
    }

    /* Right Side: Chat Window */
    .chat-window {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .chat-header {
        padding: 16px 24px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chat-body {
        flex-grow: 1;
        padding: 24px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 24px;
        background-color: rgba(0,0,0,0.02);
    }

    /* Chat Messages */
    .msg-group {
        display: flex;
        gap: 12px;
        max-width: 80%;
    }
    .msg-group.sent {
        align-self: flex-end;
        flex-direction: row-reverse;
    }

    .msg-avatar {
        width: 32px; height: 32px;
        border-radius: 50%;
        background-color: var(--bg-hover);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--text-muted);
        flex-shrink: 0;
    }

    .msg-bubble {
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 0.9rem;
        line-height: 1.5;
        position: relative;
    }

    .msg-group.received .msg-bubble {
        background-color: var(--chat-recv-bg);
        color: var(--chat-recv-text);
        border-top-left-radius: 2px;
    }

    .msg-group.sent .msg-bubble {
        background-color: var(--accent-color);
        color: var(--chat-sent-text);
        border-top-right-radius: 2px;
    }

    .msg-meta {
        margin-bottom: 4px;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .role-badge {
        font-size: 0.65rem;
        padding: 1px 6px;
        border-radius: 4px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .role-student { background-color: rgba(13, 110, 253, 0.1); color: var(--text-blue); }
    .role-mentor { background-color: rgba(25, 135, 84, 0.1); color: #198754; }

    /* Reactions */
    .reaction-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        margin-top: 8px;
        background-color: rgba(255,255,255,0.2);
        cursor: pointer;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .msg-group.received .reaction-pill { background-color: var(--bg-card); }
    .msg-group.sent .reaction-pill { background-color: rgba(255,255,255,0.2); color: white; border: none; }

    /* Attachment */
    .chat-file {
        display: flex;
        align-items: center;
        gap: 10px;
        background-color: rgba(0,0,0,0.05);
        padding: 8px 12px;
        border-radius: 8px;
        margin-top: 8px;
        max-width: 100%;
    }
    .msg-group.sent .chat-file { background-color: rgba(255,255,255,0.2); color: white; }

    /* Footer */
    .chat-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--border-color);
        background-color: var(--bg-card);
    }

    /* Responsive */
    @media (max-width: 991px) {
        .chat-container { height: auto; min-height: auto; }
        .group-sidebar { height: 450px; margin-bottom: 24px; }
        .chat-window { height: 600px; }
        .msg-group { max-width: 90%; }

        /* Filter tabs scrolling on mobile */
        .filter-scroll {
            overflow-x: auto;
            padding-bottom: 4px;
            white-space: nowrap;
        }
    }
</style>

<div class="content-body">

    <div class="card-custom mb-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; ">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class=" fs-4 p-2 bg-soft-orange rounded-3 text-accent'">
                    <i class="bi bi-people-fill fs-3"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-main mb-1">Group Discussions</h4>
                    <p class="text-muted-custom mb-0 small">Facilitate group conversations and manage discussion forums</p>
                </div>
            </div>
            <button class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center p-0"
                    style="width: 40px; height: 40px; background-color: var(--accent-color); border: none;">
                <i class="bi bi-plus-lg fs-5"></i>
            </button>
        </div>
    </div>

    <div class="row g-4 chat-container">

        <div class="col-12 col-lg-4 h-100">
            <div class="group-sidebar">

                <div class="p-3 border-bottom" style="border-color: var(--border-color) !important;">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-hover);  color: var(--text-muted);">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 ps-0" placeholder="Search groups"
                               style="background-color: var(--bg-hover);  color: var(--text-main);">
                    </div>

                    <div class="d-flex gap-2 overflow-auto" style="scrollbar-width: none;">
                        <button class="btn btn-sm btn-primary rounded-pill px-3" style="background-color: var(--accent-color); border: none;">All Groups</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 ">Cohort Groups</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 ">General</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 ">Projects</button>
                    </div>
                </div>

                <div class="group-list">

                    <div class="group-item active">
                        <div class="group-icon bg-icon-blue">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="fw-bold text-main mb-0" style="font-size: 0.9rem;">Frontend Development - Batch 2024A</h6>
                                <small class="text-muted-custom" style="font-size: 0.7rem;">20m ago</small>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted-custom small mb-0 text-truncate" style="max-width: 180px;">
                                    Group for all students in Frontend Development cohort
                                </p>
                                <div class="d-flex align-items-center gap-2">
                                    <small class="text-muted-custom"><i class="bi bi-person"></i> 15</small>
                                    <span class="unread-badge">3</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="group-item">
                        <div class="group-icon bg-icon-blue">
                            <i class="bi bi-chat-left-dots-fill"></i>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="fw-bold text-main mb-0" style="font-size: 0.9rem;">Career Guidance</h6>
                                <small class="text-muted-custom" style="font-size: 0.7rem;">45m ago</small>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted-custom small mb-0 text-truncate" style="max-width: 180px;">
                                    General career advice and industry insights
                                </p>
                                <div class="d-flex align-items-center gap-2">
                                    <small class="text-muted-custom"><i class="bi bi-person"></i> 35</small>
                                    <span class="unread-badge bg-secondary">7</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="group-item">
                        <div class="group-icon bg-icon-teal">
                            <i class="bi bi-folder-fill"></i>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="fw-bold text-main mb-0" style="font-size: 0.9rem;">Project Showcase</h6>
                                <small class="text-muted-custom" style="font-size: 0.7rem;">1h ago</small>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted-custom small mb-0 text-truncate" style="max-width: 180px;">
                                    Share your projects and get feedback
                                </p>
                                <div class="d-flex align-items-center gap-2">
                                    <small class="text-muted-custom"><i class="bi bi-person"></i> 28</small>
                                    <span class="unread-badge">2</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="group-item">
                        <div class="group-icon bg-icon-purple">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="fw-bold text-main mb-0" style="font-size: 0.9rem;">Full Stack Dev - Batch 2024B</h6>
                                <small class="text-muted-custom" style="font-size: 0.7rem;">2h ago</small>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-muted-custom small mb-0 text-truncate" style="max-width: 180px;">
                                    Discussion group for Full Stack students
                                </p>
                                <div class="d-flex align-items-center gap-2">
                                    <small class="text-muted-custom"><i class="bi bi-person"></i> 20</small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8 h-100">
            <div class="chat-window">

                <div class="chat-header">
                    <div class="d-flex align-items-center gap-3">
                        <div class="group-icon bg-icon-blue" style="width: 40px; height: 40px; font-size: 1rem;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-main mb-0">Frontend Development - Batch 2024A</h6>
                            <small class="text-muted-custom">15 members • Cohort Group</small>
                        </div>
                    </div>
                    <div class="d-flex gap-3 text-muted-custom">
                        <i class="bi bi-people cursor-pointer fs-5"></i>
                        <i class="bi bi-gear cursor-pointer fs-5"></i>
                    </div>
                </div>

                <div class="chat-body">

                    <div class="msg-group received">
                        <div class="msg-avatar">JD</div>
                        <div class="d-flex flex-column">
                            <div class="msg-meta">
                                <span class="fw-bold text-main">John Doe</span>
                                <span class="role-badge role-student">Student</span>
                                <span class="text-muted-custom">20m ago</span>
                            </div>
                            <div class="msg-bubble">
                                Hi everyone! I'm having trouble with React state management. Can anyone help?
                                <div>
                                    <span class="reaction-pill">👍 2</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="msg-group sent">
                        <div class="d-flex flex-column align-items-end">
                            <div class="msg-meta">
                                <span class="text-muted-custom">15m ago</span>
                                <span class="role-badge role-mentor">Mentor</span>
                                <span class="fw-bold text-main">You</span>
                            </div>
                            <div class="msg-bubble">
                                Great question, John! Let's discuss this in today's session. Meanwhile, check out the React documentation on state hooks.
                                <div class="d-flex gap-2 justify-content-end">
                                    <span class="reaction-pill">❤️ 1</span>
                                    <span class="reaction-pill">👍 3</span>
                                </div>
                            </div>
                        </div>
                        <div class="msg-avatar" style="background-color: var(--accent-color); color: white;">Me</div>
                    </div>

                    <div class="msg-group received">
                        <div class="msg-avatar" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981;">JS</div>
                        <div class="d-flex flex-column">
                            <div class="msg-meta">
                                <span class="fw-bold text-main">Jane Smith</span>
                                <span class="role-badge role-student">Student</span>
                                <span class="text-muted-custom">10m ago</span>
                            </div>
                            <div class="msg-bubble">
                                Thanks for the guidance! I'll also share some useful resources I found.
                                <div class="chat-file">
                                    <i class="bi bi-file-earmark-pdf fs-4 text-danger"></i>
                                    <div>
                                        <div class="fw-bold small">react-state-guide.pdf</div>
                                        <div class="small opacity-75">1.2 MB</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="chat-footer">
                    <div class="input-group">
                        <button class="btn btn-outline-secondary border-end-0" style="border-color: var(--border-color);" type="button">
                            <i class="bi bi-paperclip"></i>
                        </button>
                        <input type="text" class="form-control border-start-0 border-end-0" placeholder="Type your message to the group..."
                               style="background-color: var(--bg-hover); border-color: var(--border-color); color: var(--text-main);">
                        <button class="btn btn-primary" style="background-color: var(--accent-color); border: none;" type="button">
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection
