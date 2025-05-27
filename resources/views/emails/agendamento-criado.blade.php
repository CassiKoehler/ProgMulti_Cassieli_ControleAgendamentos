<h2>Olá {{ $agendamento->cliente->nome }},</h2>

<p>Seu agendamento foi confirmado com os seguintes dados:</p>

<ul>
    <li><strong>Profissional:</strong> {{ $agendamento->profissional->nome }}</li>
    <li><strong>Serviço:</strong> {{ $agendamento->servico->nome_servico }}</li>
    <li><strong>Data e Hora:</strong> {{ \Carbon\Carbon::parse($agendamento->data_hora)->format('d/m/Y H:i') }}</li>
    <li><strong>Status:</strong> {{ $agendamento->status }}</li>
</ul>

<p>Qualquer dúvida, entre em contato pelo WhatsApp.</p>

<p>Atenciosamente,<br>Cassieli Koehler, Lash Designer</p>
