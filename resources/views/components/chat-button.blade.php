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
                <h2 class="text-lg font-semibold">Jorge</h2>
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

        function scrollToBottom() {
        const messages = document.getElementById('chatMessages');
        messages.scrollTop = messages.scrollHeight;
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
            const submitButton = event.target.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.textContent;

            // Desabilita o input e botão enquanto processa
            input.disabled = true;
            submitButton.disabled = true;
            submitButton.textContent = 'Enviando...';

            const userMessage = document.createElement('div');
            userMessage.className = 'float-right bg-green-600 text-white p-2 rounded-lg max-w-xs mb-3 items-end clear-both';
            userMessage.textContent = input.value;
            messages.appendChild(userMessage);

            // Indicador de digitação com cor mais suave
            const typingIndicator = document.createElement('div');
            typingIndicator.className = 'float-left bg-gray-100 p-2 rounded-lg max-w-xs mb-3 clear-both';
            typingIndicator.innerHTML = `
                <div class="typing-animation">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            `;
            messages.appendChild(typingIndicator);
            scrollToBottom();

            try {
                const response = await axios.get("/chatbot", {
                    params: {
                        question: input.value
                    }
                });

                typingIndicator.remove();

                const botMessage = document.createElement('div');
                botMessage.className = 'float-left bg-gray-200 text-gray-800 p-2 rounded-lg max-w-xs mb-3 clear-both';
                botMessage.textContent = response.data.response;
                messages.appendChild(botMessage);

                input.value = '';
                scrollToBottom();
            } catch (error) {
                typingIndicator.remove();
                
                const errorMessage = document.createElement('div');
                errorMessage.className = 'float-left bg-red-100 text-red-600 p-2 rounded-lg max-w-xs mb-3 clear-both';
                errorMessage.textContent = 'Desculpe, ocorreu um erro ao processar sua mensagem.';
                messages.appendChild(errorMessage);
                console.error('Error:', error);
            } finally {
                // Reabilita o input e botão
                input.disabled = false;
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
                input.focus();
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</div>
