<div>
    <div
        id="chatContainer"
        class="w-16 h-16 hi fixed bottom-4 right-4 bg-green-600 text-white p-4 rounded-[50%] shadow-lg z-50 transition-all duration-500 ease-in-out flex items-center justify-center"
        onclick="openChat()"
    >
        <i id="chatIcon" class="fas fa-comments text-xl"></i>
    </div>

    <div
        id="chatModal"
        class="hidden fixed bottom-4 right-4 bg-white rounded-lg shadow-lg w-11/12 md:w-2/3 lg:w-1/3 z-50 h-[50%] overflow-x-auto"
        style="transition: all 0.5s ease-in-out;"
    >
        <div class="flex flex-col h-full">
            <div class="flex justify-between items-center bg-green-600 text-white p-4">
                <h2 class="text-lg font-semibold">Chatbot</h2>
                <button onclick="closeChat()" class="text-white">&times;</button>
            </div>
            <div class="flex-1 p-4 overflow-y-auto" id="chatMessages">
            </div>
            <form class="flex p-4 border-t" onsubmit="sendMessage(event)">
                <input
                    type="text"
                    id="chatInput"
                    class="flex-1 border rounded-l-lg p-2"
                    placeholder="Digite sua mensagem"
                    required
                />
                <button type="submit" class="bg-green-600 text-white px-4 rounded-r-lg">Enviar</button>
            </form>
        </div>
    </div>

    <script>
        function openChat() {
            const chatContainer = document.getElementById('chatContainer');
            const chatModal = document.getElementById('chatModal');
            const chatIcon = document.getElementById('chatIcon');

            
            chatContainer.style.width = '40%';
            chatContainer.style.height = '50%';
            chatContainer.style.borderRadius = '12px';
            chatContainer.style.backgroundColor = '#ffffff';

            
            chatIcon.style.opacity = '0';

            
            setTimeout(() => {
                chatModal.classList.remove('hidden');
                chatContainer.classList.add('hidden');
            }, 500);
        }

        function closeChat() {
            const chatContainer = document.getElementById('chatContainer');
            const chatModal = document.getElementById('chatModal');
            const chatIcon = document.getElementById('chatIcon');

            chatContainer.style.width = '64px';
            chatContainer.style.height = '64px';
            chatContainer.style.borderRadius = '50%';
            chatContainer.style.backgroundColor = '#3CB371';
            chatContainer.style.transition = 'all 0.7s ease-in-out';
            chatModal.classList.add('hidden');
            chatContainer.classList.remove('hidden');

            setTimeout(() => {
            chatIcon.style.opacity = '1';
            chatIcon.style.transition = 'opacity 0.3s ease-in-out';
            }, 500);

            // Restaura o ícone
            setTimeout(() => {
                chatIcon.style.opacity = '1';
            }, 500);
        }

        async function sendMessage(event) {
            event.preventDefault();
            const input = document.getElementById('chatInput');
            const messages = document.getElementById('chatMessages');


            const userMessage = document.createElement('div');
            userMessage.className = 'self-end bg-gray-700 text-white p-2 rounded-lg max-w-xs mb-3';
            userMessage.textContent = input.value;
            messages.appendChild(userMessage);

            // Envia a mensagem para o backend
            const response = await fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: input.value })
            });

            const data = await response.json();

            // Adiciona a resposta do backend
            const botMessage = document.createElement('div');
            botMessage.className = 'self-start bg-gray-700 text-black p-2 rounded-lg max-w-xs mb-3';
            botMessage.textContent = data.reply;
            messages.appendChild(botMessage);

            input.value = '';
            messages.scrollTop = messages.scrollHeight;
        }
    </script>
</div>
