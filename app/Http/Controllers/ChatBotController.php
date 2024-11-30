<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Gemini;
use Gemini\Data\Content;
use Gemini\Enums\{ModelType, Role};

class ChatBotController extends Controller
{
    protected $client;
    protected $chat;
    
    public function __construct()
    {
        $this->client = Gemini::client(env('GEMINI_API_KEY'));
        $this->chat = $this->client->geminiFlash()->startChat(history: [
            ...$this->formatChatHistory()
        ]);
    }

    public function sendQuestion(Request $request)
    {
        $question = $request->input('question');
        $response = $this->chat->sendMessage($question);

        return response()->json(['response' => $response->text()]);
    }

    private function formatChatHistory()
    {
        $history = $this->getChatHistory();
        return array_map(function($message) {
            return Content::parse(
                part: $message['parts'][0]['text'],
                role: $message['role'] === 'model' ? Role::MODEL : Role::USER
            );
        }, $history);
    }

    private function getChatHistory()
    {
        return $history = [
            [
                "role" => "user",
                "parts" => [
                    [
                        "text" => "Vou te dar várias perguntas e respostas sobre o VoteNow, uma plataforma de votações. As perguntas para treino iniciarão com a flag '[t]'. Por favor, responda apenas a perguntas relacionadas ao VoteNow, uma plataforma de votação online. Evite responder sobre outros tópicos ou fornecer informações que não sejam diretamente relacionadas a esta plataforma. Caso a pergunta não seja sobre o VoteNow, encaminhe de volta com uma mensagem informando que a dúvida está fora do escopo."
                    ]
                ]
            ],
            [
                "role" => "user",
                "parts" => [
                    [
                        "text" => "[t] Como posso criar uma sala de votação?"
                    ]
                ]
            ],
            [
                "role" => "model",
                "parts" => [
                    [
                        "text" => "Para criar uma sala de votação, vá até o painel de administração e clique em 'Criar Sala'. Escolha um nome para sua sala, adicione a pergunta e as opções de resposta. Você também pode adicionar uma imagem e gerar um código de acesso ou QR Code para compartilhar com os participantes."
                    ]
                ]
            ],
            [
                "role" => "user",
                "parts" => [
                    [
                        "text" => "[t] Como personalizo a pergunta na sala de votação?"
                    ]
                ]
            ],
            [
                "role" => "model",
                "parts" => [
                    [
                        "text" => "Para personalizar a pergunta, ao criar ou editar sua sala de votação, basta inserir o texto da pergunta no campo específico. Você também pode adicionar uma imagem relacionada à pergunta para tornar a votação mais interativa."
                    ]
                ]
            ],
            [
                "role" => "user",
                "parts" => [
                    [
                        "text" => "[t] Posso adicionar uma imagem à pergunta?"
                    ]
                ]
            ],
            [
                "role" => "model",
                "parts" => [
                    [
                        "text" => "Sim, você pode adicionar uma imagem à pergunta. Durante a criação ou edição da sala de votação, há uma opção para inserir uma URL de imagem que será exibida junto à pergunta. Isso pode tornar a votação mais visual e atrativa para os participantes."
                    ]
                ]
            ],
            [
                "role" => "user",
                "parts" => [
                    [
                        "text" => "[t] Como funciona o código da sala?"
                    ]
                ]
            ],
            [
                "role" => "model",
                "parts" => [
                    [
                        "text" => "Cada sala de votação recebe um código único de 6 dígitos. Os participantes podem usar esse código para entrar na sala de votação. Para acessá-la, basta digitar o código no campo de entrada na página inicial ou no link que você compartilhar."
                    ]
                ]
            ],
            [
                "role" => "user",
                "parts" => [
                    [
                        "text" => "[t] Como posso compartilhar o QR Code da sala de votação?"
                    ]
                ]
            ],
            [
                "role" => "model",
                "parts" => [
                    [
                        "text" => "Durante a criação ou edição da sala, você pode gerar um QR Code único. Esse código pode ser escaneado pelos participantes para entrar diretamente na sua sala de votação. Basta compartilhar o QR Code em eventos, redes sociais ou até imprimir."
                    ]
                ]
            ],
            [
                "role" => "user",
                "parts" => [
                    [
                        "text" => "[t] Como as opções de voto são exibidas na sala de votação?"
                    ]
                ]
            ],
            [
                "role" => "model",
                "parts" => [
                    [
                        "text" => "Quando os participantes entram na sala de votação, a pergunta e as opções de voto são exibidas de forma clara e interativa. As opções podem ser apresentadas como botões clicáveis, e os participantes devem selecionar uma opção para registrar seu voto."
                    ]
                ]
            ],
            [
                "role" => "user",
                "parts" => [
                    [
                        "text" => "[t] Posso editar uma sala depois de criada?"
                    ]
                ]
            ],
            [
                "role" => "model",
                "parts" => [
                    [
                        "text" => "Sim, você pode editar uma sala de votação a qualquer momento. Basta ir até a página de gerenciamento da sala, fazer as alterações necessárias (como editar a pergunta, as opções ou o nome da sala) e salvar as mudanças. A sala continuará disponível para os participantes."
                    ]
                ]
            ],
            [
                "role" => "user",
                "parts" => [
                    [
                        "text" => "[t] Qual é o limite de participantes em uma sala de votação?"
                    ]
                ]
            ],
            [
                "role" => "model",
                "parts" => [
                    [
                        "text" => "Não há limite fixo para o número de participantes em uma sala de votação. O limite depende do plano do aplicativo e dos recursos do servidor, mas geralmente, você pode ter um número bastante grande de participantes em cada sala."
                    ]
                ]
            ],
            [
                "role" => "user",
                "parts" => [
                    [
                        "text" => "[t] Como os participantes entram na sala de votação?"
                    ]
                ]
            ],
            [
                "role" => "model",
                "parts" => [
                    [
                        "text" => "Os participantes podem entrar na sala de votação de duas formas: digitando o código da sala na página de entrada ou escaneando o QR Code gerado para a sala."
                    ]
                ]
            ],
            [
                "role" => "user",
                "parts" => [
                    [
                        "text" => "[t] Qual o nome da aplicação/site/empresa?"
                    ]
                ]
            ],
            [
                "role" => "model",
                "parts" => [
                    [
                        "text" => "VoteNow"
                    ]
                ]
            ]
        ];
        
    }
}