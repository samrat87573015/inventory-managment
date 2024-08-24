<x-layout.dashboard-layout>

    <div class="customer_list p-6 w-full overflow-hidden">
        <div class="bg-white shadow px-5 !py-5">
            <div class="flex justify-end mb-8">
                <button onclick="customerCreateModel.showModal()" class="btn_primary !w-auto flex gap-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                  </svg>
                  Add Customer</button>
            </div>
            <div class="customer_table overflow-auto">
                <table id="customerTable">
                    <thead class="">
                        <tr class="font-semibold">
                          <th class="pb-3 text-start min-w-[100px]">No.</th>
                          <th class="pb-3 text-start min-w-[100px]">Name</th>
                          <th class="pb-3 text-start min-w-[100px]">Email</th>
                          <th class="pb-3 text-start min-w-[100px]">Phone</th>
                          <th class="pb-3 text-start min-w-[100px]">Address</th>
                          <th class="pb-3 text-start min-w-[150px]">Action</th>
                        </tr>
                    </thead>
                    <tbody id="customerList">

                    </tbody>

                </table>
            </div>
        </div>
    </div>



    <x-customer.create />

    <x-customer.update />

    <x-customer.deleted />






    <script>

        getCustomerList();
        async function getCustomerList(){
            showLoder();
            let res = await axios.get('/getCustomerList');
            hideLoder();

            let customerTable = $('#customerTable');
            let customerList = $('#customerList');

            customerTable.DataTable().destroy();
            customerList.empty();

            res.data.forEach((item, index) => {

                let customertbodylist = `<tr>
                                    <td class="text-start">${index+1}</td>
                                    <td>${item.customerName}</td>
                                    <td>${item.customerEmail}</td>
                                    <td>${item.customerPhone}</td>
                                    <td>${item.customerAddress}</td>
                                    <td>
                                        <div class="flex gap-5">
                                            <button data-id="${item['id']}" class="editBtn customer_editBtn"><i class="fa-regular fa-pen-to-square"></i></button>
                                            <button data-id="${item['id']}" class="deleteBtn customer_deleteBtn"><i class="fa-regular fa-trash-can"></i></button>
                                        </div>
                                    </td>
                                </tr>`


                customerList.append(customertbodylist);
            });


            $('.customer_deleteBtn').on('click', function(){

                let id = $(this).data('id');
                document.getElementById('customerDeletedModel').showModal();

                document.getElementById('customerID').value = id;

            });

            $('.customer_editBtn').on('click',async function(){
                let id = $(this).data('id');
                await getCustomerID(id);
                document.getElementById('customerUpdateModel').showModal();
            })



            $('#customerTable').DataTable({
                order: [[0, 'desc']],
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ]

            });


        }



    </script>

</x-layout.dashboard-layout>
