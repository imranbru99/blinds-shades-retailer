<div class="chat-widget" x-data="{ open: false }">
    <div class="chat-panel" :class="{ open: open }" id="lw-chat-panel">
        <div class="chat-head">LumenWeave Assistant</div>
        <div class="chat-log" id="lw-chat-log">
            <div class="chat-bubble bot">Hi — ask about blinds, shades, measuring, motorization, or showroom hours.</div>
        </div>
        <form class="chat-form" id="lw-chat-form">
            <input type="text" id="lw-chat-input" placeholder="Ask a question..." autocomplete="off" required>
            <button class="btn btn-primary" style="padding:.55rem .85rem;" type="submit">Send</button>
        </form>
    </div>
    <button type="button" class="chat-toggle" onclick="document.getElementById('lw-chat-panel').classList.toggle('open')">Chat with AI</button>
</div>
<script>
(() => {
    const form = document.getElementById('lw-chat-form');
    const log = document.getElementById('lw-chat-log');
    const input = document.getElementById('lw-chat-input');
    if (!form) return;

    const addBubble = (text, who) => {
        const el = document.createElement('div');
        el.className = `chat-bubble ${who}`;
        el.textContent = text;
        log.appendChild(el);
        log.scrollTop = log.scrollHeight;
    };

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = input.value.trim();
        if (!message) return;
        addBubble(message, 'user');
        input.value = '';
        try {
            const res = await fetch(@json(route('ai.chat')), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ message }),
            });
            const data = await res.json();
            addBubble(data.reply || 'Sorry, I could not respond.', 'bot');
        } catch (err) {
            addBubble('Connection issue — please try again or call (303) 555-0184.', 'bot');
        }
    });
})();
</script>
