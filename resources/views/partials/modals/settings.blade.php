<modal name="settings-modal"
       height="auto"
       scrollable
       v-cloak
       classes="rounded bg-white">
    <user-info-view inline-template :user="{{$authUser}}">
        <div>
            <div class="flex flex-col items-center">
                <div class="bg-secondary w-full h-40"></div>
                <div class="bg-white p-4 -translate-y-50 rounded">
                    <img class="w-24 h-24" src="/svg/bawsla-icon.svg" alt="">
                </div>
            </div>

            <div class="px-16 pb-2 -mt-10">
                <form action="" method="post" @submit.prevent="submit">
                    <label for="name" class="input-label">name</label>
                    <div class="input">
                        <input v-model="form.name" required type="text" id="name">
                    </div>
                    <p class="error" v-if="form.errors.name" v-text="form.errors.name[0]"></p>

                    <label for="email" class="input-label">email</label>
                    <div class="input">
                        <input type="email" required v-model="form.email" id="email">
                    </div>
                    <p class="error" v-if="form.errors.name" v-text="form.errors.email[0]"></p>

                    <label for="new-password" class="input-label">password</label>
                    <div class="input">
                        <input type="password" v-model="form.password" id="new-password">
                    </div>
                    <p class="error" v-if="form.errors.password" v-text="form.errors.password[0]"></p>

                    <label for="password-confirmation" class="input-label">password confirmation</label>
                    <div class="input">
                        <input type="password" v-model="form.password_confirmation" id="password-confirmation">
                    </div>
                    <p class="error" v-if="form.errors.password_confirmation"
                       v-text="form.errors.password_confirmation[0]"></p>
                    <div class="flex justify-between">
                        <button class="button" type="submit">Done</button>
                        <button class="button is-muted"
                                @click="$modal.hide('settings-modal')"
                        >cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </user-info-view>
</modal>