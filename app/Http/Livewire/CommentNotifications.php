<?php

namespace App\Http\Livewire;

use Livewire\Component;

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

    public function render()
    {
        return view('livewire.comment-notifications', [
            'notifications'
        ]);
    }
}
