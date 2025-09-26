<div class="chat-widget">
    <div class="chat-panel" id="chatPanel" role="dialog" aria-label="Chat support">
        <div class="bg-gradient-to-r from-red-600 to-black p-4 text-white">
            <h3 class="font-bold">Chat Support</h3>
            <p class="text-sm opacity-80">How can we help you today?</p>
        </div>
        <div class="flex-1 p-4 overflow-y-auto" style="height: 280px;">
            <div id="chatMessages" class="space-y-4" role="log" aria-live="polite" aria-label="Chat messages">
                <div class="bg-gray-800 p-3 rounded-lg">
                    <p class="text-sm">👋 Hello! I'm here to help. What can I do for you?</p>
                </div>
            </div>
        </div>
        <div class="p-4 border-t border-gray-700">
            <div class="flex space-x-2">
                <input type="text" id="chatInput" placeholder="Type a message..."
                    class="flex-1 p-2 bg-gray-800 border border-gray-600 rounded text-sm focus:border-red-400 outline-none"
                    aria-label="Chat message input">
                <button onclick="sendMessage()"
                    class="bg-red-600 text-white px-4 py-2 rounded text-sm hover:bg-red-700 transition-colors"
                    aria-label="Send message">
                    Send
                </button>
            </div>
            <div class="flex space-x-2 mt-2">
                <button onclick="sendQuickReply('Tell me about your services')"
                    class="text-xs bg-gray-700 px-2 py-1 rounded hover:bg-gray-600 transition-colors">
                    Services
                </button>
                <button onclick="sendQuickReply('I need a quote')"
                    class="text-xs bg-gray-700 px-2 py-1 rounded hover:bg-gray-600 transition-colors">
                    Quote
                </button>
                <button onclick="sendQuickReply('Contact information')"
                    class="text-xs bg-gray-700 px-2 py-1 rounded hover:bg-gray-600 transition-colors">
                    Contact
                </button>
            </div>
        </div>
    </div>
    <button class="chat-toggle" onclick="toggleChat()" aria-label="Toggle chat support">
        💬
    </button>
</div>
