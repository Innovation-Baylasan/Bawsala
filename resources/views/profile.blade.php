<!DOCTYPE html>
<html lang="en" class="min-h-full min-w-screen">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="bg-gray-200 min-h-screen min-w-screen">
<div id="app" class="theme-light">
    <div class="flex flex-col md:flex-row w-full p-4 md:-mx-4 relative">
        <aside class="md:w-1/4 bg-default flex flex-col mx-4 self-start rounded overflow-hidden md:sticky top-0">
            <header class="flex flex-col justify-center items-center">
                <div class="relative">
                    <img src="{{$entity->cover}}" alt="">
                    <div class="bg-default absolute w-full h-12 cover-skewer"></div>
                </div>
                <div class="rounded-full w-40 h-40 overflow-hidden shadow-sm bg-default -translate-y-50 -mb-16">
                    <img class="w-full h-full" src="{{$entity->avatar}}" alt="">
                </div>
            </header>
            <div class="px-10 flex flex-col items-center">
                <h3 class="uppercase text-xl font-bold text-center mb-2">{{$entity->name }}</h3>

                @if($entity->parent)
                    <h6>By: <a href="{{'@'.$entity->parent->id}}">{{$entity->parent->name}}</a></h6>
                @endif

                @if($authUser->isNot($entity->owner))
                    <star-rating class="mb-2"
                                 :initial="{{$entity->ratingFor($authUser) ?: 0 }}"
                                 action="/entities/{{$entity->id}}/rate"></star-rating>
                @endif
                <p class="text-gray-300 mb-2"><span
                            class="font-bold text-gray-500">Rating: </span>{{$entity->rating()}}
                </p>
                <div class="w-full flex justify-between mb-4">
                    <div class="text-gray-500 flex flex-col text-center">
                        <span class="font-bold text-black">{{$entity->followers(App\User::class)->count()}}</span>
                        <span>Followers</span>
                    </div>
                    <div class="text-gray-500 flex flex-col text-center">
                        <span class="font-bold text-black">0</span>
                        <span>Events</span>
                    </div>
                    <div class="text-gray-500 flex flex-col text-center">
                        <span class="font-bold text-black">{{$entity->reviews->count()}}</span>
                        <span>Review</span>
                    </div>
                </div>
                @if($authUser->isNot($entity->owner))
                    <form action="/entities/{{$entity->id}}/follow"
                          method="post"
                          class="w-full flex"
                          id="follow-form">
                        @csrf
                        @method("put")
                        <a class="@if($authUser->isFollowing($entity))bg-blue-100 @endif border-blue border text-center w-full focus:outline-none text-blue-700 py-2 rounded capitalize font-bold mb-8"
                           href="#"
                           onclick="document.getElementById('follow-form').submit()"
                        >
                            {{$authUser->isFollowing($entity) ? 'following':'follow'}}
                        </a>
                    </form>
                @endif
            </div>
        </aside>

        <div class="md:w-3/4 flex flex-col mx-4 mt-4 md:mt-0">
            <header class="flex justify-between mb-4">
                <a href="/" class="button">back</a>
                @can('update',$entity)
                    <div class="flex -mx-2">
                        <a href="#" @click="$modal.show('edit-entity')" class="mx-2">
                            <img src="/svg/edit-profile-icon.svg" alt="">
                        </a>
                    </div>
                @endcan
            </header>
            <div class="bg-default p-8 mb-4 rounded">
                <h3 class="uppercase border-b mb-4 border-solid border-gray-100 text-2xl font-bold">
                    Info
                </h3>
                <p class="text-gray-500 mr-8 ">{{$entity->description}}</p>
            </div>
            <div class="bg-default p-8 mb-4 rounded">
                <h3 class="uppercase border-b mb-4 border-solid border-gray-100 text-2xl font-bold">
                    Details
                </h3>
                <p class="text-gray-500 mr-8 ">{!! $entity->details ?: 'there is no details for now' !!}</p>
            </div>
            <div class="bg-default p-8 mb-4 rounded">
                <div class="flex flex-col justify-between">
                    @forelse($entity->reviews->take(5) as $review)
                        <div class="flex flex-1 py-4 items-start border-b border-solid border-gray-100">
                            <img class="rounded shadow-sm w-12 h-12 mr-4"
                                 src="https://www.gravatar.com/avatar/{{md5( strtolower(trim( $review->writer->email)) )}}?s=200"
                                 alt="avatar">
                            <div class="flex-col">
                                <h3 class="capitalize font-bold">{{$review->writer->name}}</h3>
                                <p class=" font-hairline">{{$review->review}}</p>
                                <span class="self-end text-gray-500 text-sm">{{$review->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-1 py-4 items-start border-b border-solid border-gray-100">
                            <div class="flex-col">
                                <span class="self-end text-gray-500 text-sm">There is no reviews for now</span>
                            </div>
                        </div>
                    @endforelse

                    @if($authUser->isNot($entity->owner))
                        <div class="flex flex-1 py-4 items-center">

                            <form action="/entities/{{$entity->id}}/reviews"
                                  method="post"
                                  class="w-full flex flex-col"
                            >
                                @csrf
                                <div class="flex items-center">
                                    <img class="rounded shadow-sm w-12 h-12 mr-4"
                                         src="https://www.gravatar.com/avatar/{{md5( strtolower(trim( $authUser->email)) )}}?s=200"
                                         alt="avatar">
                                    <div class="input  w-full">
                                    <textarea class="w-full outline-none"
                                              type="text"
                                              name="review"
                                              placeholder="Leave Comment Or Review Here"></textarea>
                                    </div>

                                </div>
                                <button class="button self-end" type="submit">review</button>
                            </form>
                        </div>
                    @endif
                </div>
                <div></div>
            </div>
            <div class="bg-default p-8 rounded">
                <h3 class="uppercase border-b mb-4 border-solid border-gray-100 text-2xl font-bold">
                    Places
                </h3>

                <div class="flex -mx-2">

                </div>
            </div>
        </div>
    </div>

    @include('partials.modals.add-entity')
    @include('partials.modals.edit-entity')
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
