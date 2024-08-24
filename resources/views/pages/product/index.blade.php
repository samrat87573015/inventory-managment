<x-layout.dashboard-layout>
    <div class="productList p-6 w-full overflow-hidden">
        <div class="bg-white shadow px-5 !py-5">
            <div class="flex justify-end mb-8">
                <button onclick="productCreateModel.showModal()" class="btn_primary !w-auto flex gap-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add product</button>
            </div>
            <div class="customer_table overflow-auto">
                <table id="productTable">
                    <thead class="">
                    <tr class="font-semibold">
                        <th class="pb-3 text-start min-w-[100px]">Image</th>
                        <th class="pb-3 text-start min-w-[100px]">Name</th>
                        <th class="pb-3 text-start min-w-[100px]">Price</th>
                        <th class="pb-3 text-start min-w-[100px]">quantity</th>
                        <th class="pb-3 text-start min-w-[150px]">Action</th>
                    </tr>
                    </thead>
                    <tbody id="productList">

                    </tbody>

                </table>
            </div>
        </div>
    </div>


    <x-product.create />

   <x-product.update />

    <x-product.deleted />




    <script>

        getProductList();
        async function getProductList(){
            showLoder();
            let res = await axios.get('/getProductList');
            hideLoder();

            $('#productTable').DataTable().destroy();
            $('#productList').empty();

            res.data.forEach(function (item, index) {
                let tbodylist = `<tr>
                                    <td> <img src="${item['productImageUrl']}" class="w-[100px] h-[100px] object-cover"></td>
                                    <td>${item['productName']}</td>
                                    <td>${item['price']}</td>
                                    <td>${item['quantity']}</td>
                                    <td>
                                        <div class="flex gap-5">
                                            <button data-oldimgurl="${item['productImageUrl']}" data-id="${item['id']}" class="editBtn Product_editBtn"><i class="fa-regular fa-pen-to-square"></i></button>
                                            <button data-oldimgurl="${item['productImageUrl']}" data-id="${item['id']}" class="deleteBtn Product_deleteBtn">
                                                <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                        </div>
                                    </td>
                                  </tr>`

                $('#productList').append(tbodylist);
            });


            $('.Product_deleteBtn').on('click', function () {
                let id = $(this).data('id');
                document.getElementById('productDeletedModel').showModal();
                document.getElementById('productID').value = id;
                document.getElementById('oldImgUrl').value = $(this).data('oldimgurl');
            });

            $('.Product_editBtn').on('click', async function () {
                let id = $(this).data('id');
                let oldImgUrl = $(this).data('oldimgurl');
                await getProductById(id, oldImgUrl);
                document.getElementById('productUpdateModel').showModal();
                // document.getElementById('productID').value = id;
                // document.getElementById('oldImgUrl').value = $(this).data('oldimgurl');
            });


            $('#productTable').DataTable({
                order: [[0, 'desc']],
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ]

            });

        }

    </script>


</x-layout.dashboard-layout>
