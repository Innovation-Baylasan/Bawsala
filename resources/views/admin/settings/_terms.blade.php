<div>
    <create-page-view identifier="terms"
                      :initial-setting="{{$terms}}"
                      inline-template
    >
        <form action="/admin/settings"
              method="post"
              @submit.prevent="save"
        >
            @csrf
            <h3 class="text-xl border-b mb-4">Terms</h3>
            <wysiwyg placeholder="Terms for Bawsala"
                     name="terms"
                     v-model="page.value"
                     class="mb-4"
            ></wysiwyg>

            <button type="submit" class="button">Update</button>
        </form>
    </create-page-view>
</div>