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

    <form action="/issues" method="post">
        @csrf
        <div class="p-4 -mt-6">
            <label for="title" class="input-label">The issue title</label>
            <div class="input">
                <input name="title" id="title"/>
            </div>
            <label for="description" class="input-label">The issue description</label>
            <div class="input">
                <textarea minlength="20" maxlength="350" name="description" id="description" rows="5"></textarea>
            </div>

            <div class="flex justify-between">
                <button type="button" class="button is-muted" @click="$modal.hide('report-issue')">Cancel</button>
                <button type="submit" class="button">Submit issue</button>
            </div>
        </div>
    </form>
</modal>
