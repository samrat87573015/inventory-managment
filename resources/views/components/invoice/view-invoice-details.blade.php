<!-- Open the modal using ID.showModal() method -->
<dialog id="viewInvoiceDetailsModel" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box !max-w-[60rem]">

        <div id="printContent" class="bg-white">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <div class="text-gray-700 font-semibold text-lg">INVOICE</div>
                </div>
                <div class="text-gray-700">
                    <div class="font-bold text-xl mb-2">INVOICE</div>
                    <div class="text-sm">Date: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>

                    <div class="text-sm text-gray-700 mb-1">Customer ID: <span id="DinvoiceCustomerID"></span></div>
                </div>
            </div>
            <div class="border-b-2 border-gray-300 pb-8 mb-8">
                <h2 class="text-2xl font-bold mb-4">Bill To:</h2>
                <div class="text-gray-700 mb-1">Name: <span id="DinvoiceCustomerName"></span></div>
                <div class="text-gray-700 mb-1">Email: <span id="DinvoiceCustomerEmail"></span></div>
                <div class="text-gray-700 mb-1">Mobile: <span id="DinvoiceCustomerPhone"></span></div>
                <div class="text-gray-700 mb-1">Address: <span id="DinvoiceCustomerAddress"></span></div>
            </div>
            <table class="w-full text-left mb-8">
                <thead class="invoiceProductTable border-b-1 border-gray-300">
                <tr>
                    <th class="text-gray-700 font-bold py-2">Name</th>
                    <th class="text-gray-700 font-bold py-2">Quantity</th>
                    <th class="text-gray-700 font-bold  py-2">Total</th>
                </tr>
                </thead>
                <tbody id="DinvoiceProductList">

                </tbody>
            </table>
            <div class="flex justify-start">
                <div class="text-gray-700 mr-2">Subtotal:</div>
                <div class="text-gray-700">$ <span id="Dtotal"></span></div>
            </div>
            <div class="flex justify-start">
                <div class="text-gray-700 mr-2">Vat(5%)</div>
                <div class="text-gray-700">$ <span id="Dvat"></span></div>
            </div>
            <div class="flex justify-start mb-2">
                <div class="text-gray-700 mr-2">Discount amount</div>
                <div class="text-gray-700">$ <span id="DdiscountAmount"></span></div>
            </div>
            <hr>
            <div class="flex justify-start mb-8 mt-2">
                <div class="text-gray-700 mr-2">Total:</div>
                <div class="text-gray-700 font-bold text-xl">$ <span id="Dpayable"></span></div>
            </div>
        </div>



        <div class="modal-action">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button id="DinvoiceModelClose" class="btn">Close</button>
            </form>
            <button onclick="printPage()" class="btn btn_primary">Print</button>
        </div>
    </div>
</dialog>


<script>
    async function getInvoiceDetails(id,customerID) {

        showLoder();
        let res = await axios.post('{{route('invoiceDetails')}}', {
            "customer_id": customerID,
            "invoice_id": id
        });
        hideLoder();
        let customer = res.data.customer;
        let products = res.data.products;
        let invoice = res.data.invoice;

        document.getElementById('DinvoiceCustomerName').innerHTML = customer['customerName'];
        document.getElementById('DinvoiceCustomerEmail').innerHTML = customer['customerEmail'];
        document.getElementById('DinvoiceCustomerPhone').innerHTML = customer['customerPhone'];
        document.getElementById('DinvoiceCustomerAddress').innerHTML = customer['customerAddress'];
        document.getElementById('DinvoiceCustomerID').innerHTML = customer['id'];


        document.getElementById('Dtotal').innerHTML = invoice['total'];
        document.getElementById('Dvat').innerHTML = invoice['vat'];
        document.getElementById('DdiscountAmount').innerHTML = invoice['discount'];
        document.getElementById('Dpayable').innerHTML = invoice['payable'];


        $('#DinvoiceProductList').empty();

        products.forEach(function (item, index) {
            console.log(item);

            let tbodylist = `<tr>
                                <td>${item['product']['productName']}</td>
                                <td>${item['quantity']}</td>
                                <td>${item['salePrice']}</td>
                            </tr>`;
            $('#DinvoiceProductList').append(tbodylist);

        });


    }


    function printPage() {

        let printContent=document.getElementById('printContent').innerHTML;

        let originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();

        document.body.innerHTML = originalContent;

        setTimeout(() => {
            window.location.reload();
        }, 500);

    }



</script>
