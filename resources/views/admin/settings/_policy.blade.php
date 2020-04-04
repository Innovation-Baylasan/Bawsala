<div>
    <create-page-view identifier="policy"
                      :initial-setting="{{$policy}}"
                      inline-template>
        <form action="/admin/settings"
              method="post"
              @submit.prevent="save"
        >
            @csrf
            <h3 class="text-xl border-b mb-4">Policy</h3>
            <wysiwyg placeholder="Policy for Bawsala"
                     name="policy"
                     v-model="page.value"
                     class="mb-4"
            ></wysiwyg>

            <button type="submit" class="button">Update</button>
        </form>
    </create-page-view>
</div>