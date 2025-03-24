<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class StatusAprovadoNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // dd($notifiable->visita->data);
        return (new MailMessage)
            ->subject(Lang::get('Visita Parna Peruaçu'))
            ->line(Lang::get('Ótima notícia, sua solicitação foi aprovada!'))
            ->line(Lang::get('Visita ao Parque Nacional Cavernas do Peruaçu'))
            ->line(Lang::get('Dia: '. $notifiable->visita->data->format('d/m/Y')))
            ->line(Lang::get('Período de chegada: '. $notifiable->visita->periodo->getDescription()))
            ->line(Lang::get('Roteiros: '. $notifiable->visita->getRoteirosNomes()))
            ->line(Lang::get('Quantidade de pessoas: '.$notifiable->visita->quantidadePessoas))
            ->line(Lang::get('Condutores: '. $notifiable->visita->getCondutoresNomes()))
            ->line(Lang::get('Aproveite a aventura!'));

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
