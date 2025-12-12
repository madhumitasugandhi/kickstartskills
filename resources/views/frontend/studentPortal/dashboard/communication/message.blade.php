@extends('frontend.studentPortal.dashboard.layouts.app')

@section('title', 'Messages')
@section('icon', 'bi bi-envelope fs-4 p-2 bg-primary bg-opacity-10 rounded-3 text-primary')

@section('content')
<style>
    /* Theme Variables */
    :root {
        --bg-card: #ffffff;
        --text-main: #343a40;
        --text-muted: #6c757d;
        --border-color: #e9ecef;
        --soft-blue: #e7f1ff; --text-blue: #0d6efd;
        --soft-red: #f8d7da; --text-red: #842029;
    }

    [data-theme="dark"] {
        --bg-card: #2e333f;
        --text-main: #e9ecef;
        --text-muted: #adb5bd;
        --border-color: #2c2c2c;
        --soft-blue: rgba(13, 110, 253, 0.15); --text-blue: #6ea8fe;
        --soft-red: rgba(220, 53, 69, 0.15); --text-red: #ea868f;
    }

    /* Layout: Fixed height for chat window relative to viewport */
    .chat-layout {
        display: flex;
        height: calc(100vh - 140px); /* Adjust based on header height */
        gap: 24px;
    }

    /* Left Sidebar: List */
    .chat-sidebar {
        width: 320px;
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
    }

    /* Stats & Tabs */
    .chat-header-area {
        padding: 20px;
        border-bottom: 1px solid var(--border-color);
    }
    .status-text { font-size: 0.75rem; font-weight: 600; margin-bottom: 12px; }
    .status-unread { color: #dc3545; }
    .status-online { color: #10b981; }

    .chat-tabs {
        display: flex;
        padding: 4px;
        border-radius: 8px;
        margin-bottom: 16px;
        border: 1px solid var(--border-color);
    }
    .chat-tab {
        flex: 1;
        text-align: center;
        padding: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 6px;
        color: var(--text-muted);
        cursor: pointer;
        transition: 0.2s;
    }
    .chat-tab.active {
        background-color: var(--soft-blue);
        color: var(--text-blue);
    }

    .search-input {
        background-color: var(--bg-hover);
        border: 1px solid var(--border-color);
        padding: 10px 10px 10px 36px;
        border-radius: 8px;
        font-size: 0.85rem;
        width: 100%;
        color: var(--text-main);
    }
    .search-icon-pos {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    /* User List */
    .user-list {
        flex-grow: 1;
        overflow-y: auto;
        padding: 10px;
    }
    .user-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.2s;
        border-bottom: 1px solid transparent;
    }
    .user-item:hover { background-color: var(--bg-hover); }
    .user-item.active { background-color: var(--soft-blue); }

    .avatar-box {
        width: 40px; height: 40px;
        border-radius: 50%;
        background-color: #334155;
        display: flex; align-items: center; justify-content: center;
        color: white;
        font-size: 0.9rem;
        position: relative;
    }
    .status-dot {
        width: 10px; height: 10px;
        border-radius: 50%;
        border: 2px solid var(--bg-card);
        position: absolute;
        bottom: 0; right: 0;
    }
    .bg-dot-green { background-color: #10b981; }
    .bg-dot-gray { background-color: #94a3b8; }

    .user-info { flex-grow: 1; overflow: hidden; }
    .user-name { font-size: 0.9rem; font-weight: 600; color: var(--text-main); display: block; }
    .last-msg { font-size: 0.75rem; color: var(--text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block; }
    .typing-text { color: var(--text-blue); font-style: italic; }

    .meta-col { text-align: right; display: flex; flex-direction: column; align-items: flex-end; }
    .msg-time { font-size: 0.7rem; color: var(--text-muted); margin-bottom: 4px; }
    .badge-count {
        background-color: #dc3545; color: white;
        font-size: 0.65rem; padding: 2px 6px;
        border-radius: 10px; font-weight: 700;
    }

    /* Right Main Chat Area (Empty State) */
    .chat-main {
        flex-grow: 1;
        background-color: #0f172a; /* Dark background matching image */
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        border: 1px solid var(--border-color);
    }
    /* Adapting to light mode if needed, but image shows dark panel */
    [data-theme="light"] .chat-main { background-color: #f8fafc; color: var(--text-main); }

    .empty-icon {
        width: 80px; height: 80px;
        background-color: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 2.5rem;
        margin-bottom: 24px;
    }
    .btn-new-chat {
        background-color: #0ea5e9;
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        margin-top: 24px;
        transition: 0.2s;
    }
    .btn-new-chat:hover { background-color: #0284c7; }

    @media(max-width: 991px) {
        .chat-layout { flex-direction: column; height: auto; }
        .chat-sidebar { width: 100%; height: 500px; }
        .chat-main { height: 400px; }
    }
</style>

<div class="content-body">
    <div class="chat-layout">

        <!-- LEFT SIDEBAR -->
        <div class="chat-sidebar">
            <!-- Header Area -->
            <div class="chat-header-area">
                <div class="d-flex gap-3 mb-3">
                    <span class="status-text status-unread">5 Unread</span>
                    <span class="status-text status-online">7 Online</span>
                </div>

                <div class="chat-tabs">
                    <div class="chat-tab active">Messages</div>
                    <div class="chat-tab">Contacts</div>
                    <div class="chat-tab">Groups</div>
                </div>

                <div style="position: relative;">
                    <i class="bi bi-search search-icon-pos"></i>
                    <input type="text" class="search-input" placeholder="Search messages, contacts...">
                </div>
            </div>

            <!-- User List -->
            <div class="user-list custom-scrollbar">

                <!-- User 1 -->
                <div class="user-item">
                    <div class="avatar-box">
                        <img src="https://ui-avatars.com/api/?name=Sarah+Wilson&background=0D8ABC&color=fff" class="rounded-circle" width="40" height="40">
                        <div class="status-dot bg-dot-green"></div>
                    </div>
                    <div class="user-info">
                        <span class="user-name">Dr. Sarah Wilson</span>
                        <span class="last-msg fw-bold text-main">Great work on your assignment! I h...</span>
                    </div>
                    <div class="meta-col">
                        <span class="msg-time">15m</span>
                        <span class="badge-count">2</span>
                    </div>
                </div>

                <!-- User 2 -->
                <div class="user-item">
                    <div class="avatar-box">
                        <img src="https://ui-avatars.com/api/?name=Michael+Chen&background=10b981&color=fff" class="rounded-circle" width="40" height="40">
                        <div class="status-dot bg-dot-green"></div>
                    </div>
                    <div class="user-info">
                        <span class="user-name">Prof. Michael Chen</span>
                        <span class="last-msg fw-bold text-main">The database lab session is resche...</span>
                    </div>
                    <div class="meta-col">
                        <span class="msg-time">1h</span>
                        <span class="badge-count">1</span>
                    </div>
                </div>

                <!-- User 3 -->
                <div class="user-item">
                    <div class="avatar-box">
                        <img src="https://ui-avatars.com/api/?name=CS+Projects&background=6366f1&color=fff" class="rounded-circle" width="40" height="40">
                    </div>
                    <div class="user-info">
                        <span class="user-name">CS Final Year Projects</span>
                        <span class="last-msg typing-text">Typing...</span>
                    </div>
                    <div class="meta-col">
                        <span class="msg-time">2h</span>
                    </div>
                </div>

                <!-- User 4 -->
                <div class="user-item">
                    <div class="avatar-box">
                        <img src="https://ui-avatars.com/api/?name=Library&background=f59e0b&color=fff" class="rounded-circle" width="40" height="40">
                        <div class="status-dot bg-dot-gray"></div>
                    </div>
                    <div class="user-info">
                        <span class="user-name">Library Assistant</span>
                        <span class="last-msg fw-bold text-main">Your reserved book "Design Patter...</span>
                    </div>
                    <div class="meta-col">
                        <span class="msg-time">4h</span>
                        <span class="badge-count">1</span>
                    </div>
                </div>

                <!-- User 5 -->
                <div class="user-item">
                    <div class="avatar-box">
                        <img src="https://ui-avatars.com/api/?name=Algo+Group&background=ec4899&color=fff" class="rounded-circle" width="40" height="40">
                    </div>
                    <div class="user-info">
                        <span class="user-name">Study Group - Algorithms</span>
                        <span class="last-msg">Meeting tomorrow at 3 PM in Library R...</span>
                    </div>
                    <div class="meta-col">
                        <span class="msg-time">6h</span>
                    </div>
                </div>

                <!-- User 6 -->
                <div class="user-item">
                    <div class="avatar-box">
                        <img src="https://ui-avatars.com/api/?name=Academic&background=ef4444&color=fff" class="rounded-circle" width="40" height="40">
                        <div class="status-dot bg-dot-green"></div>
                    </div>
                    <div class="user-info">
                        <span class="user-name">Academic Advisor</span>
                        <span class="last-msg fw-bold text-main">Please schedule an appointment to...</span>
                    </div>
                    <div class="meta-col">
                        <span class="msg-time">1d</span>
                        <span class="badge-count">1</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- RIGHT MAIN AREA -->
        <div class="chat-main">
            <div class="empty-icon">
                <i class="bi bi-chat-text-fill"></i>
            </div>
            <h4 class="fw-bold mb-2">Welcome to Messages</h4>
            <p class="--text-muted text-center" style="max-width: 300px;">Select a conversation from the left to start messaging or connect with new peers.</p>

            <button class="btn-new-chat"><i class="bi bi-pencil-square me-2"></i> Start New Conversation</button>
        </div>

    </div>

</div>
@endsection


