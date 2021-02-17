<div class="rounded-lg" x-data="{ showMoreButton:@entangle('showMoreButton') }">
    <div>
        @foreach($comments as $comment)
            @php
                $owner = \App\Models\User::findOrFail($comment->user_id);
            @endphp
            <div wire:key="{{time().$comment->id}}" class="bg-gray-100 p-4 my-2 rounded-lg">
                <div class="flex">
                    <div class="w-14 mr-2">
                        <img src="{{$owner->profile_photo_url}}" alt="" class=""/>
                    </div>
                    <div class="flex flex-col w-full">

                        <div class="flex w-full bg-gray-200 p-4 rounded-lg">
                            <div class="flex flex-col w-full">
                                <div class="flex sm:justify-between">
                                    <div class="font-bold">{{$owner->name}}</div>
                                    @auth
                                        @if($owner->id == auth()->user()->id)
                                            <button class="focus:outline-none" wire:click="delete({{$comment->id}})">
                                                <x-comments::icons.trash></x-comments::icons.trash>
                                            </button>
                                        @endif
                                    @endauth
                                </div>

                                <div>{{$comment->created_at->diffForHumans()}}</div>
                                <div>{!! $comment->comment !!}</div>
                            </div>
                        </div>
                        <div class="flex mt-2">
                            <livewire:like-button::like-button :key="time().$comment->id"
                                                               :model="$comment">

                            </livewire:like-button::like-button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-2 mb-2" x-show="showMoreButton" style="display:none;">
        <button wire:click="more" class="focus:outline-none w-full bg-blue-400 rounded-lg px-4 py-2 bg-white">Show
            more...
        </button>
    </div>
    @auth
        @if ($errors->any())
            <div class="mt-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-one">
                            {{$error}}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form wire:submit.prevent="save">
            <div class="flex">
                <form class="m-4 flex">
                    <input wire:model="comment"
                           class="focus:outline-none flex flex-grow rounded-l-lg px-4 py-2 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white"
                           placeholder="Write a comment..."/>
                    <button
                        class="focus:outline-none px-8 rounded-r-lg bg-yellow-400  text-gray-800 font-bold px-4 py-1 uppercase border-yellow-500 border-t border-b border-r">
                        Comment
                    </button>
                </form>
            </div>

        </form>
    @endauth
</div>
