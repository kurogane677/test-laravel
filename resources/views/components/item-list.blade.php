<div class="relative overflow-x-auto sm:rounded-lg mb-4 max-w-full mx-auto p-2" x-data="searchComponent()">
    <div class="pb-4 bg-gray-100 dark:bg-gray-900">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative mt-1">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" x-model="query" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search item name">
        </div>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Item name
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <template x-for="item in filteredItems" :key="item.slug">
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" x-text="item.name"></th>
                    <td class="px-6 py-4" x-text="item.description"></td>
                    <td class="px-6 py-4 flex flex-1">
                        <a :href="'/items/' + item.slug + '/edit'" class="font-medium hover:text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">Edit </a><div class="mx-2">|</div>
                        <form x-data @submit.prevent="confirmDelete(item.slug)" action="" method="POST" x-ref="deleteForm">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="hover:text-red-600 cursor-pointer" @click="confirmDelete(item.slug)"> Delete</button>
                        </form>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
</div>

<script type="text/javascript">

function searchComponent() {
    return {
        query: '',
        items: @json($items),
        get filteredItems() {
            if (this.query === '') {
                return this.items;
            }

            return this.items.filter(item => {
                return item.name.toLowerCase().includes(this.query.toLowerCase());
            });
        },
        confirmDelete(slug) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$refs.deleteForm.action = `/items/${slug}`;
                    this.$refs.deleteForm.submit();
                }
            });
        }
    }
}
</script>
