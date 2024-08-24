    <!-- Open the modal using ID.showModal() method -->
    <dialog id="productUpdateModel" class="modal">
        <div class="modal-box max-w-[46rem]">
            <h3 class="text-lg font-bold text-center">Update a new Product</h3>
            <form id="createProductForm" class=" form_group mt-5">
                <input type="hidden" id="productIDUpdate">
                <input type="hidden" id="oldImgUrlUpdate">
                <div class="input_item mb-5">
                    <label class="text-sm text-black mb-2">Category</label>
                    <select id="ProductCatListUpdate" class="select select-bordered w-full mt-1">
                        <option value="" disabled selected>Select Category</option>
                    </select>
                </div>
                <div class="input_item">
                    <label class="text-sm text-black mb-0">Product Name</label>
                    <input id="ProductNameUpdate" type="text" placeholder="Product Name">
                </div>
                <div class="input_item">
                    <label class="text-sm text-black mb-0">Product Price</label>
                    <input id="productPriceUpdate" type="number" placeholder="Price">
                </div>
                <div class="input_item">
                    <label class="text-sm text-black mb-0">Quantity</label>
                    <input id="productQuantityUpdate" type="number" placeholder="quantity">
                </div>
                <div class="previewIMg w-[150px] h-[150px]">
                    <img id="proviewImgUpdate" class="w-full h-full object-cover" src="{{ asset('assets/img/plasholderimg.png') }}" alt="">
                </div>
                <label class="form-control w-full max-w-xs">
                    <span class="text-sm text-black mb-0">Product Image</span>
                    <input id="productImgUpdate" oninput="proviewImgUpdate.src=window.URL.createObjectURL(this.files[0])" type="file" class="file-input file-input-bordered w-full max-w-xs" />
                </label>
            </form>
            <div class="modal-action">
                <form method="dialog">
                    <button id="UpdateProductModelClose" class="btn">Close</button>
                </form>
                <button onclick="UpdateProduct()" class="btn_primary">Update</button>
            </div>
        </div>
    </dialog>



    <script>

        //getCatListUpdate();
        async function getCatListUpdate(){
            showLoder();
            let res = await axios.get('/getCategoryList');
            hideLoder();

            res.data.forEach(function (item, index) {
                let option = `<option class="py-2" value="${item['id']}">${item['categoryName']}</option>`;
                $('#ProductCatListUpdate').append(option);
            });
        }



        async function getProductById(id,oldImgUrl){

            document.getElementById('productIDUpdate').value = id;
            document.getElementById('oldImgUrlUpdate').value = oldImgUrl;
            document.getElementById('proviewImgUpdate').src = oldImgUrl;


            showLoder();
            await getCatListUpdate();
            let res = await axios.post('/getProductByID', {
                productID: id,
            });
            hideLoder();

            console.log(res.data);

            document.getElementById('ProductNameUpdate').value = res.data['productName'];
            document.getElementById('productPriceUpdate').value = res.data['price'];
            document.getElementById('productQuantityUpdate').value = res.data['quantity'];
            document.getElementById('ProductCatListUpdate').value = res.data['category_id'];
            //document.getElementById('productImgUpdate').files[0] = res.data['productImageUrl'];
        

        }




        async function UpdateProduct(){


            let productName = document.getElementById('ProductNameUpdate').value
            let price = document.getElementById('productPriceUpdate').value
            let quantity = document.getElementById('productQuantityUpdate').value
            let category_id = document.getElementById('ProductCatListUpdate').value
            let Image = document.getElementById('productImgUpdate').files[0];
            let productID = document.getElementById('productIDUpdate').value
            let oldImgUrl = document.getElementById('oldImgUrlUpdate').value


            if(productName.length === 0 ){
                errorTostr('Please enter product name');
            }else if(price.length === 0 ){
                errorTostr('Please enter product price');
            }else if(category_id.length === 0 ){
                errorTostr('Please select product category');
            }
            else if(quantity.length === 0 ){
                errorTostr('Please enter product quantity');
            }
            else{
                showLoder();
                let formData = new FormData();
                formData.append('productName',productName);
                formData.append('price',price);
                formData.append('quantity',quantity);
                formData.append('category_id',category_id);
                formData.append('Image',Image);
                formData.append('productID',productID);
                formData.append('oldImgUrl',oldImgUrl);

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                let res = await axios.post('{{ route('updateProduct') }}',formData,config);
                hideLoder();

                if(res.status === 200){
                    successTostr('Product updated successfully');
                    document.getElementById('UpdateProductModelClose').click();
                    await getProductList();
                }else{
                    errorTostr('Product not updated');
                }
            }


        }

    </script>
