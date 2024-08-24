<div class="invoice lg:w-1/3 w-full bg-white rounded">
    <div class="bg-white rounded-lg shadow-lg px-8 py-10 max-w-xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="text-gray-700 font-semibold text-lg">INVOICE</div>
            </div>
            <div class="text-gray-700">
                <div class="font-bold text-xl mb-2">INVOICE</div>
                <div class="text-sm">Date: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
                <div class="text-sm text-gray-700 mb-1">Customer ID: <span id="invoiceCustomerID"></span></div>
            </div>
        </div>
        <div class="border-b-2 border-gray-300 pb-8 mb-8">
            <h2 class="text-2xl font-bold mb-4">Bill To:</h2>
            <div class="text-gray-700 mb-1">Name: <span id="invoiceCustomerName"></span></div>
            <div class="text-gray-700 mb-1">Email: <span id="invoiceCustomerEmail"></span></div>
            <div class="text-gray-700 mb-1">Mobile: <span id="invoiceCustomerPhone"></span></div>
            <div class="text-gray-700 mb-1">Address: <span id="invoiceCustomerAddress"></span></div>
        </div>
        <table class="w-full text-left mb-8">
            <thead class="invoiceProductTable border-b-1 border-gray-300">
                <tr>
                    <th class="text-gray-700 font-bold py-2">Name</th>
                    <th class="text-gray-700 font-bold py-2">Quantity</th>
                    <th class="text-gray-700 font-bold  py-2">Total</th>
                    <th class="text-gray-700 font-bold py-2">Action</th>
                </tr>
            </thead>
            <tbody id="invoiceProductList">

            </tbody>
        </table>
        <div class="flex justify-start">
            <div class="text-gray-700 mr-2">Subtotal:</div>
            <div class="text-gray-700">$ <span id="total"></span></div>
        </div>
        <div class="flex justify-start">
            <div class="text-gray-700 mr-2">Vat(5%)</div>
            <div class="text-gray-700">$ <span id="vat"></span></div>
        </div>
        <div class="flex justify-start">
            <div class="text-gray-700 mr-2">Discount amount</div>
            <div class="text-gray-700">$ <span id="discountAmount"></span></div>
        </div>
        <div class="mb-8 text-start">
            <div class="text-gray-700 mb-2">Discount %</div>
            <input
            class="text-gray-700 border border-gray-300 h-8 px-2 w-32"
            value="0"
            min="0"
            step="0.50"
            type="number"
            id="discount"

            onchange="calculateTotal()"
            >
        </div>
        <div class="flex justify-start mb-8">
            <div class="text-gray-700 mr-2">Total:</div>
            <div class="text-gray-700 font-bold text-xl">$ <span id="payable"></span></div>
        </div>
        <div class="border-t-2 border-gray-300 pt-8 mb-8 text-start">
            <button class="btn btn_primary" onclick="createInvoice()">Create Invoice</button>
        </div>
    </div>
</div>



<script>

    function getCustomerById(id,name,email,phone,address){

        document.getElementById('invoiceCustomerID').innerHTML= id;
        document.getElementById('invoiceCustomerName').innerHTML= name;
        document.getElementById('invoiceCustomerAddress').innerHTML= address;
        document.getElementById('invoiceCustomerEmail').innerHTML= email;
        document.getElementById('invoiceCustomerPhone').innerHTML= phone;


    }



    function InvoicePickProduct(){
        $("#invoiceProductList").empty();

        pickInvoiceProductList.forEach(function (item, index) {
            //console.log(item);

            let tbodylist = `<tr>
                                <td>${item['productName']}</td>
                                <td>${item['quantity']}</td>
                                <td>${item['salePrice']}</td>
                                <td>
                                    <div class="">
                                        <button data-index="${index}" class="deleteBtn text-end product_removeBtn"><i class="fa-regular fa-trash-can"></i></button>
                                    </div>
                                </td>
                            </tr>`


            $('#invoiceProductList').append(tbodylist);

            calculateTotal();


            $('.product_removeBtn').on('click', function () {
                let index = $(this).data('index');
                removeInvoiceProduct(index);
            });


        });

    }

    function removeInvoiceProduct(index){

        pickInvoiceProductList.splice(index, 1);

        InvoicePickProduct();
    }



    function calculateTotal(){

        let total = 0;
        let discount = 0;
        let vat = 0;
        let payable = 0;

        let discountValue = document.getElementById('discount').value;
        parseFloat(discountValue).toFixed(2);

        pickInvoiceProductList.forEach(function (item, index) {
            console.log(item);
            total = total + parseFloat(item['salePrice']);
            //console.log(total);
        });

        if(discountValue === 0){
            vat = total*5/100;

        }else{
            discount = total*discountValue/100;
            total = total-discount.toFixed(2);
            vat = total*5/100;
        }


        payable = total + vat;

        document.getElementById('total').innerHTML = total.toFixed(2);
        document.getElementById('vat').innerHTML = vat.toFixed(2);
        document.getElementById('payable').innerHTML = payable.toFixed(2);
        document.getElementById('discountAmount').innerHTML = discount.toFixed(2);


    }


    async function createInvoice(){

        let total = document.getElementById('total').innerText;
        let discount = document.getElementById('discountAmount').innerText;
        let vat = document.getElementById('vat').innerText;
        let payable = document.getElementById('payable').innerText;
        let customer_id = document.getElementById('invoiceCustomerID').innerText;


        let Data = {
            "total": total,
            "discount": discount,
            "vat": vat,
            "payable": payable,
            "customer_id": customer_id,
            "products": pickInvoiceProductList
        }


        if(customer_id.length === 0 ){
            errorTostr('Please select customer');
        }else if(pickInvoiceProductList.length === 0){
            errorTostr('Please select product');
        }else {
            showLoder();
            let res = await axios.post('{{route('createInvoice')}}',Data);
            hideLoder();

            if(res.data === 1){
                successTostr('Invoice created successfully');

                setTimeout(() => {
                    window.location.href = '/invoice';
                },1000);

            }else{
                errorTostr('Something went wrong');
            }
        }



    }


</script>
