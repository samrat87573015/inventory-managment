<div class="products lg:w-1/3 w-full bg-white px-5 py-5 shadow rounded-md">

    <div class="salePage_ptWrapper">
        <table id="salePage_productTable">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>pick</th>
                </tr>
            </thead>
            <tbody id="salePage_productList">

            </tbody>
        </table>
    </div>
</div>



    <!-- Open the modal using ID.showModal() method -->
    <dialog id="pickProductModel" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-center">Add to invoice</h3>
            <form id="addToInvoiceForm" class=" form_group mt-5">
                <div class="input_item">
                    <input id="pickProductID" type="text" placeholder="Product id">
                </div>
                <div class="input_item">
                    <label class="text-sm text-black mb-0" >Product Name</label>
                    <input id="pickProductName" type="text" placeholder="Product Name">
                </div>
                <div class="input_item">
                    <label class="text-sm text-black mb-0">Price</label>
                    <input id="pickProductPrice" type="number" placeholder="price">
                </div>
                <div class="input_item">
                    <label class="text-sm text-black mb-0">Quantity</label>
                    <input id="pickProductQuantity" type="number" placeholder="Quantity">
                </div>
            </form>
            <div class="modal-action">
                <form method="dialog">
                    <button id="pickProductModelClose" class="btn">Close</button>
                </form>
                <button onclick="addToInvoice()" class="btn_primary">Add to invoice</button>
            </div>
        </div>
    </dialog>



<script>

    getProductList();

    let pickInvoiceProductList=[];

    async function getProductList(){
        showLoder();
        let res = await axios.get('/getProductList');
        hideLoder();


        $('#salePage_productTable').DataTable().destroy();
        $('#salePage_productList').empty();

        res.data.forEach(function (item, index) {
            let tbodylist = `<tr>
                                <td><img src="${item['productImageUrl']}" class="w-[50px] h-[50px] object-cover"> ${item['productName']}</td>
                                <td>
                                    <div class="flex gap-3">
                                        <button data-id="${item['id']}" data-name="${item['productName']}" data-price="${item['price']}" class="btn_primary product_pickBtn">Add</button>
                                    </div>
                                </td>
                            </tr>`

            $('#salePage_productList').append(tbodylist);
        });


        $('.product_pickBtn').on('click', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');
            pickProductModal(id, name, price);
        });





        $('#salePage_productTable').DataTable({
            order: [[0, 'desc']],
            info: false,
            lengthChange: false,

        });

    }


    function pickProductModal(id,name,price){

        document.getElementById('pickProductID').value= id;
        document.getElementById('pickProductName').value= name;
        document.getElementById('pickProductPrice').value= price;
        document.getElementById('pickProductModel').showModal();
    }




    function addToInvoice(){

        let id = document.getElementById('pickProductID').value;
        let name = document.getElementById('pickProductName').value;
        let price = document.getElementById('pickProductPrice').value;
        let quantity = document.getElementById('pickProductQuantity').value;

        let totalPrice = parseFloat(price) * parseFloat(quantity).toFixed(2);

        if(id.length === 0 ){
            errorTostr('Please select product');
        }else if(quantity.length === 0){
            errorTostr('Please enter product quantity');
        }else if(name === 0){
            errorTostr('Please enter product name');
        }else if(price === 0){
            errorTostr('Please enter product price');
        }else{
            let pickProductList = {
                product_id: id,
                productName: name,
                salePrice: totalPrice,
                quantity: quantity,
            }


            pickInvoiceProductList.push(pickProductList);

            document.getElementById('pickProductModelClose').click();
            document.getElementById('addToInvoiceForm').reset();

            InvoicePickProduct();

            //console.log(pickInvoiceProductList);
        }
    }



</script>
