<header class="fixed py-4 w-full z-10 flex md:-mx-4 justify-end px-2">

    <div v-if="showing == 'places'"
         class="relative hidden md:block mx-4">
        <map-categories :initial-categories="{{$categories}}"
        @category-change="getPlaces"></map-categories>
    </div>

    <search-input class="self-start"
                  :category="selectedCategories"
                  :placeholder="showing == 'places' ? 'Search Startups,investors and more' : 'Search events around you'"
    @result-clicked="selectPlace"
    ></search-input>

    <dropdown>
        <template v-slot:trigger>
            <div class="rounded-full cursor-pointer ml-4 md:mb-4 md:ml-20 w-12 h-12 overflow-hidden">
                <img src="https://www.gravatar.com/avatar/?s=200" alt="">
            </div>
        </template>
        <ul class="dropdown">

            @guest
            <li class="dropdown-item">
                <a href="/login">Login</a>
            </li>
            <li class="dropdown-item">
                <a href="/register">Regsiter</a>
            </li>
            @endguest
            @auth

            @if($authUser->isAdmin())
                <li class="dropdown-item">
                    <a href="/admin">dashboard</a>
                </li>
            @endif
            <li class="dropdown-item">
                <a href="#" @click="$modal.show('settings-modal')">settings</a>
            </li>
            @endauth
            <li class="dropdown-item">
                <a href="#" @click="$modal.show('settings-modal')">Report issue</a>
            </li>
            <li class="dropdown-item">
                <a href="/faq">FAQ</a>
            </li>
            @auth()
            <li class="dropdown-item">
                <form action="/logout" method="post" id="logout-form">
                    @csrf
                </form>
                <a href="#" onclick="document.getElementById('logout-form').submit()"
                >Logout</a>
            </li>
            @endauth
        </ul>
    </dropdown>
</header>
