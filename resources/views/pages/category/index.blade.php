<x-layout.dashboard-layout>

    <div class="category_list p-6">
        <div class="bg-white shadow px-5 !py-5">
            <div class="flex justify-end mb-8">
                <button onclick="my_modal_1.showModal()" class="btn_primary !w-auto flex gap-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                  </svg>
                  Add Category</button>
            </div>
            <div class="category_table overflow-auto">
                <table id="categoryTable">
                    <thead class="">
                        <tr class="font-semibold">
                          <th class="pb-3 text-start min-w-[100px]">No.</th>
                          <th class="pb-3 text-start min-w-[300px]">Name</th>
                          <th class="pb-3 text-start min-w-[150px]">Action</th>
                        </tr>
                    </thead>
                    <tbody id="categoryList">

                    </tbody>

                </table>
            </div>
        </div>
    </div>



    <!-- Open the modal using ID.showModal() method -->
    <x-category.create />

    <x-category.update />

    <x-category.deleted />






    <script>

        getCategories();
        async function getCategories(){
            showLoder();
            let res = await axios.get('/getCategoryList');
            hideLoder();

            let categoryList = $('#categoryList');
            let categoryTable = $('#categoryTable');

            categoryTable.DataTable().destroy();
            categoryList.empty();

            res.data.forEach((item, index) => {

                let tbodylist = `<tr>
                                    <td class="text-start">${index+1}</td>
                                    <td>${item.categoryName}</td>
                                    <td>
                                        <div class="flex gap-5">
                                            <button data-id="${item['id']}" class="editBtn Category_editBtn">
                                                <i class="fa-regular fa-pen-to-square"></i>

                                            </button>
                                            <button data-id="${item['id']}" class="deleteBtn Category_deleteBtn">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>`


                categoryList.append(tbodylist);
            });


            $('.Category_deleteBtn').on('click', function(){

                let id = $(this).data('id');
                document.getElementById('catDeletedModel').showModal();

                document.getElementById('categoryID').value = id;


            });

            $('.Category_editBtn').on('click',async function(){
                let id = $(this).data('id');
                await getCategoryID(id);
                document.getElementById('catUpdateModel').showModal();
            })



            $('#categoryTable').DataTable({
                responsive: true,
                order: [[0, 'desc']],
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ]

            });


        }



    </script>

</x-layout.dashboard-layout>
