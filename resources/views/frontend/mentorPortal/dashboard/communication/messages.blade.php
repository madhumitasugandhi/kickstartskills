@extends('frontend.mentorPortal.dashboard.layouts.app')

@section('title', 'Messages')
@section('icon', 'bi bi-envelope fs-4 p-2 bg-soft-orange rounded-3 text-accent')

@section('content')
<style>
    /* Theme Variables */
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

    /* Layout Containers */
    .chat-container {
        height: calc(100vh - 200px); /* Fill remaining height on desktop */
        min-height: 600px;
    }

    /* Left Sidebar: Conversations */
    .conv-sidebar {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .conv-list {
        overflow-y: auto;
        flex-grow: 1;
        scrollbar-width: thin;
    }

    /* Conversation Item */
    .conv-item {
        padding: 16px;
        border-bottom: 1px solid var(--border-color);
        cursor: pointer;
        transition: 0.2s;
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }
    .conv-item:hover { background-color: var(--bg-hover); }
    .conv-item.active { background-color: rgba(13, 110, 253, 0.05); border-left: 3px solid var(--text-blue); }

    .avatar-circle {
        width: 40px; height: 40px;
        border-radius: 50%;
        background-color: var(--soft-blue);
        color: var(--text-blue);
        display: flex; align-items: center; justify-content: center;
        font-weight: 700;
        flex-shrink: 0;
        position: relative;
    }

    .status-dot {
        width: 10px; height: 10px;
        border-radius: 50%;
        border: 2px solid var(--bg-card);
        position: absolute;
        bottom: 0; right: 0;
    }
    .status-online { background-color: #10b981; }
    .status-offline { background-color: #94a3b8; }

    .badge-unread {
        background-color: var(--accent-color);
        color: white;
        font-size: 0.7rem;
        padding: 2px 6px;
        border-radius: 6px;
        font-weight: 600;
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
        gap: 20px;
        background-color: rgba(0,0,0,0.02); /* Slight contrast for message area */
    }

    /* Message Bubbles */
    .msg-row { display: flex; gap: 12px; width: 100%; }
    .msg-row.sent { justify-content: flex-end; }

    .msg-bubble {
        max-width: 75%;
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 0.9rem;
        line-height: 1.5;
        position: relative;
    }

    .msg-received .msg-bubble {
        background-color: var(--chat-recv-bg);
        color: var(--chat-recv-text);
        border-bottom-left-radius: 2px;
    }

    .msg-sent .msg-bubble {
        background-color: var(--accent-color);
        color: var(--chat-sent-text);
        border-bottom-right-radius: 2px;
    }

    .msg-time {
        font-size: 0.7rem;
        opacity: 0.7;
        margin-top: 4px;
        display: block;
        text-align: right;
    }

    /* File Attachment in Chat */
    .chat-file {
        display: flex;
        align-items: center;
        gap: 10px;
        background-color: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        padding: 8px 12px;
        border-radius: 8px;
        margin-top: 8px;
    }
    .chat-file i { font-size: 1.2rem; }

    /* Chat Footer */
    .chat-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--border-color);
        background-color: var(--bg-card);
    }

    .chat-input {
        background-color: var(--bg-hover);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        border-radius: 8px;
        padding: 10px 14px;
    }
    .chat-input:focus {
        background-color: var(--bg-card);
        border-color: var(--text-blue);
        box-shadow: none;
    }

    /* Responsive Tweaks */
    @media (max-width: 991px) {
        /* Stack columns on tablet/mobile */
        .chat-container {
            height: auto;
            min-height: auto;
        }

        .conv-sidebar {
            height: 400px; /* Limit height on mobile so user can see chat below */
            margin-bottom: 24px;
        }

        .chat-window {
            height: 600px; /* Fixed height for chat area on mobile */
        }

        .msg-bubble { max-width: 85%; }
    }
</style>

<div class="content-body">

    <div class="card-custom mb-4" style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 12px; padding: 24px;">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <div class="fs-4 p-2 bg-soft-orange rounded-3 text-accent">
                    <i class="bi bi-envelope fs-3"></i>
                </div>
                <div>
                    <h4 class="fw-bold text-main mb-1">Messages</h4>
                    <p class="text-muted-custom mb-0 small">Communicate with your students and manage conversations</p>
                </div>
            </div>
            <button class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center p-0"
                    style="width: 40px; height: 40px; background-color: var(--accent-color); border: none;">
                <i class="bi bi-pencil-square fs-5"></i>
            </button>
        </div>
    </div>

    <div class="row g-4 chat-container">

        <div class="col-12 col-lg-4 h-100">
            <div class="conv-sidebar">
                <div class="p-3 border-bottom" style="border-color: 1px solid var(--border-color) !important;">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-bg-hover border-end-0" style="background-color: var(--bg-hover);  color: var(--text-muted);">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 ps-0" placeholder="Search conversations"
                               style="background-color: var(--bg-hover);  color: var(--text-main);">
                    </div>

                    <div class="d-flex gap-2 overflow-auto" style="scrollbar-width: none;">
                        <button class="btn btn-sm btn-primary rounded-pill px-3" style="background-color: var(--accent-color); border: none;">All Messages</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3  ">Unread</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3  ">Direct</button>
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 ">Groups</button>
                    </div>
                </div>

                <div class="conv-list">
                    <div class="conv-item active">
                        <div class="avatar-circle">
                            JD
                            <span class="status-dot status-online"></span>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-main" style="font-size: 0.95rem;">John Doe</span>
                                <small class="text-muted-custom" style="font-size: 0.7rem;">15m ago</small>
                            </div>
                            <p class="text-muted-custom small mb-0 text-truncate">
                                <i class="bi bi-check2-all text-primary me-1"></i> Thank you for the feedback on my React project.
                            </p>
                        </div>
                        <span class="badge-unread">2</span>
                    </div>

                    <div class="conv-item">
                        <div class="avatar-circle" style="background-color: var(--bg-hover); color: var(--text-muted);">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-main" style="font-size: 0.95rem;">Frontend Team 2024A</span>
                                <small class="text-muted-custom" style="font-size: 0.7rem;">30m ago</small>
                            </div>
                            <p class="text-muted-custom small mb-0 text-truncate">
                                Sarah Wilson: Great progress everyone! Let's sync up tomorrow.
                            </p>
                        </div>
                        <span class="badge-unread">5</span>
                    </div>

                    <div class="conv-item">
                        <div class="avatar-circle" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981;">
                            JS
                            <span class="status-dot status-offline"></span>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-main" style="font-size: 0.95rem;">Jane Smith</span>
                                <small class="text-muted-custom" style="font-size: 0.7rem;">1h ago</small>
                            </div>
                            <p class="text-muted-custom small mb-0 text-truncate">
                                The API integration is working perfectly now! Ready for the next phase.
                            </p>
                        </div>
                    </div>

                    <div class="conv-item">
                        <div class="avatar-circle" style="background-color: rgba(249, 115, 22, 0.1); color: #f97316;">
                            MJ
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-main" style="font-size: 0.95rem;">Mike Johnson</span>
                                <small class="text-muted-custom" style="font-size: 0.7rem;">3h ago</small>
                            </div>
                            <p class="text-muted-custom small mb-0 text-truncate">
                                I'm struggling with the database design. Could we schedule a quick...
                            </p>
                        </div>
                        <span class="badge-unread">1</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8 h-100">
            <div class="chat-window">
                <div class="chat-header">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-circle">
                            JD
                            <span class="status-dot status-online"></span>
                        </div>
                        <div>
                            <h6 class="fw-bold text-main mb-0">John Doe</h6>
                            <small class="text-success" style="font-size: 0.75rem;">Online</small>
                        </div>
                    </div>
                    <div class="d-flex gap-3 text-muted-custom">
                        <i class="bi bi-camera-video cursor-pointer fs-5"></i>
                        <i class="bi bi-info-circle cursor-pointer fs-5"></i>
                    </div>
                </div>

                <div class="chat-body">
                    <div class="msg-row msg-received">
                        <div class="avatar-circle" style="width: 32px; height: 32px; font-size: 0.8rem;">JD</div>
                        <div class="msg-bubble">
                            <div class="fw-bold small mb-1">John Doe</div>
                            Hi! I have a question about the React component structure.
                            <span class="msg-time">2h ago</span>
                        </div>
                    </div>

                    <div class="msg-row msg-sent">
                        <div class="msg-bubble">
                            Hi John! I'd be happy to help. Can you share your current component structure?
                            <span class="msg-time">1h ago</span>
                        </div>
                        <div class="avatar-circle" style="width: 32px; height: 32px; font-size: 0.8rem; background-color: var(--accent-color); color: white;">Me</div>
                    </div>

                    <div class="msg-row msg-received">
                        <div class="avatar-circle" style="width: 32px; height: 32px; font-size: 0.8rem;">JD</div>
                        <div class="msg-bubble">
                            <div class="fw-bold small mb-1">John Doe</div>
                            Here's my current structure. I'm having trouble with state management between parent and child components.

                            <div class="chat-file">
                                <i class="bi bi-file-earmark-code"></i>
                                <div>
                                    <div class="fw-bold small">component-structure.js</div>
                                    <div class="small opacity-75">2.3 KB</div>
                                </div>
                            </div>
                            <span class="msg-time">1h ago</span>
                        </div>
                    </div>

                    <div class="msg-row msg-sent">
                        <div class="msg-bubble">
                            I see the issue. You should lift the state up to the parent component and pass it down as props. Here is how you can refactor it...
                            <span class="msg-time">Just now</span>
                        </div>
                        <div class="avatar-circle" style="width: 32px; height: 32px; font-size: 0.8rem; background-color: var(--accent-color); color: white;">Me</div>
                    </div>
                </div>

                <div class="chat-footer">
                    <div class="input-group">
                        <button class="btn btn-outline-secondary border-end-0" style="border-color: var(--border-color);" type="button">
                            <i class="bi bi-paperclip"></i>
                        </button>
                        <input type="text" class="form-control border-start-0 border-end-0" placeholder="Type your message..."
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
