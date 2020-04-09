<x-admin>
    <tabs>
        <tab name="Terms">
            <div>
                @include('admin.settings._terms')
            </div>
        </tab>
        <tab name="Policy">
            @include('admin.settings._policy')
        </tab>
    </tabs>
</x-admin>