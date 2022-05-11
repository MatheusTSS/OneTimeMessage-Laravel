<?php

namespace App\Http\Controllers;

use App\Mail\email_confirm_message;
use App\Mail\email_message_readed;
use App\Mail\email_read_message;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Main extends Controller
{
    public function index()
    {
        return view('message_form');
    }

    public function init(Request $request)
    {

        // Verifica se houve um post
        if (!$request->isMethod('post')) {
            return redirect()->route('main_index');
        }

        // Validação
        $request->validate(
            [
                'text_from' => 'required|email|max:50',
                'text_to' => 'required|email|max:50',
                'text_message' => 'required|max:250',
            ],

            [
                'text_from.required' => 'FROM é um campo OBRIGATÓRIO',
                'text_from.email' => 'Insira um e-mail válido',
                'text_from.max' => 'Máximo de 50 caracteres',
                'text_to.required' => 'TO é um campo OBRIGATÓRIO',
                'text_to.email' => 'Insira um e-mail válido',
                'text_to.max' => 'Máximo de 50 caracteres',
                'text_message.required' => 'MESSAGE é um campo OBRIGATÓRIO',
                'text_message.max' => 'Máximo de 250 caracteres',
            ]
        );

        // Create Hash (Purl_Code)
        $purl_code = Str::random(32);

        // Guardar a mensagem na base de dados
        $message = new Message();
        $message->send_from = $request->text_from;
        $message->send_to = $request->text_to;
        $message->message = $request->text_message;
        $message->purl_confirmation = $purl_code;
        $message->save();

        // Enviando o e-mail de confirmação
        Mail::to($request->text_from)->send(new email_confirm_message($purl_code));

        // Atualiza a data e a hora que o e-mail de confirmação foi enviado
        $message = Message::where('purl_confirmation', $purl_code)->first();
        $message->purl_confirmation_sent = now();
        $message->save();

        // Apresentar a View com o e-mail de confirmação enviado
        $data = [
            'email_address' => $request->text_from
        ];
        return view('email_confirmation_sent', $data);
    }

    public function confirm($purl)
    {

        // Verifica se existe um PURL
        if (empty($purl)) {
            return redirect()->route('main_index');
        }

        // Verifica se o Purl_Confirmation existe na MODEL
        $message = Message::where('purl_confirmation', $purl)->first();

        // Verifica se existe uma mensagem
        if ($message == null) {

            // Apresenta uma View Indicando que ocorreu um ERRO
            return view('error');
        }

        // Obter o endereço do destinatário
        $email_to = $message->send_to;

        // Remover o Purl_Confirmation e Create Hash (Purl_Read)
        $purl_code = Str::random(32);
        $message->purl_confirmation = null;
        $message->purl_read = $purl_code;
        $message->purl_read_sent = now();
        $message->save();

        // Enviar o e-mail ao destinatário
        Mail::to($$email_to)->send(new email_read_message($purl_code));

        // Apresentar a View que a mensagem foi enviada com sucesso
        $data = [
            'email_address' => $email_to
        ];
        return view('message_sent', $data);

    }

    public function read($purl)
    {
        // Verifica se existe um PURL
        if (empty($purl)) {
            return redirect()->route('main_index');
        }

        // Verifica se o Purl_Confirmation existe na MODEL
        $message = Message::where('purl_read', $purl)->first();

        // Verifica se existe uma mensagem
        if ($message == null) {

            // Apresenta uma View Indicando que ocorreu um ERRO
            return view('error');
        }

        // Remover o Purl_Read e guarda a menssage_readed
        $message_readed = now();
        $email_recipient = $message->send_to;
        $email_from = $message->send_from;

        $message->purl_read = null;
        $message->message_readed = $message_readed;
        $message->save();

        // Enviar email de confirmação, caso o destinatário tenha lido, para o Emissor
        Mail::to($email_from)->send(new email_message_readed($message_readed, $email_recipient));

        // Dispaly - Mensagem Única (One Time Message)
        $data = [
            'mensagem' => $message->message,
            'emissor' => $message->send_from,
        ];
        return view('read_message', $data);
    }
}
