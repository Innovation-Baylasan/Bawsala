<modal name="filteringModal"
       width="66.6%"
       :height="'auto'"
       v-cloak
       classes="bg-default rounded">
    <div class="p-8">
        <div class="border-b-2 border-gray-500">
            <h3 class="text-xl font-bold text-gray-500 inline-block border-b-4 border-accent">Search Filtering</h3>
        </div>
        <div class="flex p-4">
            <div class="w-1/2">
                <div class="mb-6">
                    <h4 class="font-bold">by category</h4>
                    <p class="text-sm text-gray-500">Your areas of interest are determined, what you want
                        Find it on the map </p>
                    <div class="flex -mx-2">
                        <div class="tag">
                            <input class="appearance-none" id="startups" type="checkbox">
                            <label for="startups">startups</label>
                        </div>
                        <div class="tag">
                            <input class="appearance-none" id="research-labs" type="checkbox">
                            <label for="research-labs">Research-labs</label>
                        </div>
                        <div class="tag">
                            <input class="appearance-none" id="study-centers" type="checkbox">
                            <label for="study-centers">study centers</label>
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold">according to the content</h4>
                    <p class="text-sm text-gray-500">All institutions are identified according to a framework of
                        interests And
                        audience disciplines</p>
                    <div class="flex -mx-2">
                        <div class="tag">
                            <input class="appearance-none" id="startups" type="checkbox">
                            <label for="startups">startups</label>
                        </div>
                        <div class="tag">
                            <input class="appearance-none" id="research-labs" type="checkbox">
                            <label for="research-labs">Research-labs</label>
                        </div>
                        <div class="tag">
                            <input class="appearance-none" id="study-centers" type="checkbox">
                            <label for="study-centers">study centers</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/2 pl-4">
                <div>
                    <h4 class="font-bold">According to the rates of followers</h4>
                    <p class="text-sm text-gray-500">All institutions that you select are determined according to The
                        framework of the number of users and followers of the institution</p>

                </div>
            </div>
        </div>
        <div class="flex justify-center">
            <button class="button is-wide">Apply filters</button>
        </div>
    </div>

</modal>