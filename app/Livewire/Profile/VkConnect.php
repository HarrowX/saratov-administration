<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VkConnect extends Component
{
    public $user;

    public $vkConnected = false;

    public $vkAvatar = null;

    public $vkId = null;

    public function mount()
    {
        $this->user = Auth::user();
        $this->vkConnected = ! is_null($this->user->vk_id);
        $this->vkAvatar = $this->user->vk_avatar;
        $this->vkId = $this->user->vk_id;
    }

    public function render()
    {
        return view('livewire.profile.vk-connect');
    }
}
