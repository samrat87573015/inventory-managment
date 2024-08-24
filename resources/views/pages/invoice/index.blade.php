<x-layout.dashboard-layout>
    <div class="p-6">
        <div class="bg-white rounded shadow px-5 !py-5">
            <div class="invoiceDataTable">
                <table id="invoicePageInvoiceTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>SubTotal</th>
                            <th>Vat</th>
                            <th>Discount</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="invoicePageInvoiceList">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-invoice.view-invoice-details />

    <x-invoice.delete-invoice />


    <script>

        getInvoiceList();

        async function getInvoiceList() {

            let res = await axios.get('{{route('invoiceSeleted')}}');

            $('#invoicePageInvoiceTable').DataTable().destroy();
            $('#invoicePageInvoiceList').empty();


            res.data.forEach(function (item, index) {
                //console.log(item);
                let tbodylist = `<tr>
                                    <td>${index+1}</td>
                                    <td>${item.customer['customerName']}</td>
                                    <td>${item.customer['customerPhone']}</td>
                                    <td>${item['total']}</td>
                                    <td>${item['vat']}</td>
                                    <td>${item['discount']}</td>
                                    <td>${item['payable']}</td>
                                    <td>
                                        <div class="flex gap-3">
                                            <button data-customerID="${item['customer']['id']}" data-id="${item['id']}" class="editBtn Invoice_detailsBtn">
                                                <i class="fa-regular fa-eye"></i>
                                            </button>
                                            <button data-id="${item['id']}" class="deleteBtn Invoice_deleteBtn">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                  </tr>`

                $('#invoicePageInvoiceList').append(tbodylist);
            });


            $('.Invoice_detailsBtn').on('click', async function (){
                let id = $(this).data('id');
                let customerID = $(this).data('customerid');
                await getInvoiceDetails(id, customerID);
                document.getElementById('viewInvoiceDetailsModel').showModal();
            });

            $('.Invoice_deleteBtn').on('click', function (){
                let id = $(this).data('id');
                document.getElementById('invoiceDeletedModel').showModal();
                document.getElementById('invoiceID').value = id;
            });

            $('#invoicePageInvoiceTable').DataTable({
                order: [[0, 'desc']],
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "All"]
                ]

            });

        }

    </script>


</x-layout.dashboard-layout>
