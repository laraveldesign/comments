<div>
    <div class="divide-y divide-gray-200">
        <div class="pb-4">
            <h2 class="text-lg font-medium text-gray-900">Comments</h2>
        </div>
        <div class="pt-6">
            <!-- Activity feed-->
            <div class="flow-root">
                <ul role="list" class="-mb-8">

                    @foreach($comments as $comment)

                    <li>
                        <div class="relative pb-8">

                            <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                            <div class="relative flex items-start space-x-3">

                                <div class="relative">
                                    <img class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white" src="{{$comment->user()->profile_photo_url}}" alt="{{$comment->user()->name}}">

                                    <span class="absolute -bottom-0.5 -right-1 rounded-tl bg-white px-0.5 py-px">
                                        <svg class="h-5 w-5 text-gray-400" x-description="Heroicon name: mini/chat-bubble-left-ellipsis" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
  <path fill-rule="evenodd" d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902.848.137 1.705.248 2.57.331v3.443a.75.75 0 001.28.53l3.58-3.579a.78.78 0 01.527-.224 41.202 41.202 0 005.183-.5c1.437-.232 2.43-1.49 2.43-2.903V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0010 2zm0 7a1 1 0 100-2 1 1 0 000 2zM8 8a1 1 0 11-2 0 1 1 0 012 0zm5 1a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
</svg>
                                      </span>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div>
                                        <div class="text-sm">
                                            <a href="#" class="font-medium text-gray-900">{{$comment->user()->name}}</a>
                                        </div>
                                        <p class="mt-0.5 text-sm text-gray-500">Commented {{$comment->created_at->diffForHumans()}}</p>
                                    </div>
                                    <div class="mt-2 text-sm text-gray-700">
                                        {!! $comment->comment !!}
                                    </div>
                                </div>
                                    <div class="flex items-center justify-center" x-data="{
                                        show:false,
                                        interval:false,
                                        countdown:5,
                                        startTimer() {
                                            this.show=true;
                                            this.interval = setInterval(()=>{
                                                this.countdown--;
                                                if(this.countdown <=0) {
                                                    this.stopTimer();
                                                }
                                            },1000);
                                        },
                                        stopTimer() {
                                            this.show=false;
                                            clearInterval(this.interval);
                                            this.countdown = 5;
                                        }
                                    }">
                                        <x-button.danger @click="startTimer()" x-show="!show">
                                            <x-fontawesome::trash class="w-4 h-4 fill-white"/>
                                        </x-button.danger>
                                        <x-button.danger wire:click="deleteComment({{$comment->id}})"   x-show="show" x-cloak>
                                            <div class="w-4 h-4" x-text="countdown"></div>
                                        </x-button.danger>
                                    </div>
                            </div>
                            <div class="ml-10 mt-2">
                                <livewire:like-button :wire:key="'like_button_'.$comment->id" :model="$comment"></livewire:like-button>

                            </div>

                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            @auth
            <div class="mt-6">
                <div class="flex space-x-3">
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <img class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white" src="{{auth()->user()->profile_photo_url}}" alt="{{auth()->user()->name}}">

                            <span class="absolute -bottom-0.5 -right-1 rounded-tl bg-white px-0.5 py-px">
                                <svg class="h-5 w-5 text-gray-400" x-description="Heroicon name: mini/chat-bubble-left-ellipsis" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
  <path fill-rule="evenodd" d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902.848.137 1.705.248 2.57.331v3.443a.75.75 0 001.28.53l3.58-3.579a.78.78 0 01.527-.224 41.202 41.202 0 005.183-.5c1.437-.232 2.43-1.49 2.43-2.903V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0010 2zm0 7a1 1 0 100-2 1 1 0 000 2zM8 8a1 1 0 11-2 0 1 1 0 012 0zm5 1a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
</svg>
                              </span>
                        </div>
                    </div>
                    <div class="min-w-0 flex-1">
                        <form wire:submit.prevent="post">
                            <div>
                                <x-trix::trix wire:model="comment"></x-trix::trix>
                            </div>
                            <div class="mt-6 flex items-center justify-end space-x-4">
                                <x-jet-button type="submit">Comment</x-jet-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>
