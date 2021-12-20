<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Response;
use Illuminate\Notifications\DatabaseNotification;

class CommentNotifications extends Component
{
    const NOTIFICATION_LIMIT = 10;   

    public $notifications;
    public $notificationCount;
    public $isLoading;

    protected $listeners = [
        'getNotifications'
    ];

    public function mount()
    {
        $this->notifications = collect([]);
        $this->isLoading = true;
        $this->getNotificationCount();
    }

    public function getNotificationCount()
    {
        $this->notificationCount = auth()->user()->unreadNotifications->count();

        if ($this->notificationCount > self::NOTIFICATION_LIMIT) {
            $this->notificationCount = self::NOTIFICATION_LIMIT . '+';
        }
    }

    public function getNotifications()
    {
        $this->notifications = auth()->user()->unreadNotifications
            ->take(self::NOTIFICATION_LIMIT);

        $this->isLoading = false;
    }

    public function markAsRead($notificationId)
    {
        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $notification = DatabaseNotification::findOrFail($notificationId);
        $notification->markAsRead();

        return redirect()->route('idea.show', $notification->data['idea_slug']);
    }

    public function markAllAsRead()
    {
        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        auth()->user()->unreadNotifications->markAsRead();
        $this->getNotificationsCount();
        $this->getNotifications();
    }

    public function render()
    {
        return view('livewire.comment-notifications', [
            'notifications'
        ]);
    }
}
