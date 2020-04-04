<modal name="report-issue"
       classes="rounded bg-default overflow-hidden"
       scrollable
       adaptive
       v-cloak
       height="auto" xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <div class="flex flex-col items-center">
        <div class="bg-secondary w-full h-40"></div>
        <div class="bg-white p-4 -translate-y-50 rounded">
            <img class="w-24 h-24" src="/svg/bawsla-icon.svg" alt="">
        </div>
    </div>
    <create-issue-view inline-template>
        <form action="/issues"
              method="post"
              @submit.prevent="save()"
        >
            @csrf
            <div class="p-4 -mt-6">
                <label for="title" class="input-label">The issue title</label>
                <div class="input">
                    <input id="title"
                           name="title"
                           v-model="issue.title"
                           required
                    />
                </div>
                <p class="error" v-if="issue.errors.title" v-text="issue.errors.title[0]"></p>
                <label for="description" class="input-label">The issue description</label>
                <div class="input">
                <textarea id="description"
                          name="description"
                          v-model="issue.description"
                          minlength="20"
                          maxlength="350"
                          rows="5"
                          required
                ></textarea>
                </div>
                <p class="error" v-if="issue.errors.description" v-text="issue.errors.description[0]"></p>


                <div class="flex justify-between">
                    <button type="button" class="button is-muted" @click="$modal.hide('report-issue')">Cancel</button>
                    <button type="submit" class="button">Submit issue</button>
                </div>
            </div>
        </form>
    </create-issue-view>
</modal>
