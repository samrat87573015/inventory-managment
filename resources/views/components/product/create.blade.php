    <!-- Open the modal using ID.showModal() method -->
    <dialog id="productCreateModel" class="modal">
        <div class="modal-box max-w-[46rem]">
            <h3 class="text-lg font-bold text-center">Create a new Product</h3>
            <form id="createProductForm" class=" form_group mt-5">
                <div class="input_item mb-5">
                    <label class="text-sm text-black mb-2">Category</label>
                    <select id="productCatList" class="select select-bordered w-full mt-1">
                        <option value="" disabled selected>Select Category</option>
                    </select>
                </div>
                <div class="input_item">
                    <label class="text-sm text-black mb-0">Product Name</label>
                    <input id="productName" type="text" placeholder="Product Name">
                </div>
                <div class="input_item">
                    <label class="text-sm text-black mb-0">Product Price</label>
                    <input id="productPrice" type="number" placeholder="Price">
                </div>
                <div class="input_item">
                    <label class="text-sm text-black mb-0">Quantity</label>
                    <input id="productQuantity" type="number" placeholder="quantity">
                </div>
                <div class="previewIMg w-[150px] h-[150px]">
                    <img id="proviewImg" class="w-full h-full object-cover" src="{{ asset('assets/img/plasholderimg.png') }}" alt="">
                </div>
                <label class="form-control w-full max-w-xs">
                    <span class="text-sm text-black mb-0">Product Image</span>
                    <input id="productImg" oninput="proviewImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="file-input file-input-bordered w-full max-w-xs" />
                </label>
            </form>
            <div class="modal-action">
                <form method="dialog">
                    <button id="productCreateModelClose" class="btn">Close</button>
                </form>
                <button onclick="createProduct()" class="btn_primary">Create</button>
            </div>
        </div>
    </dialog>



    <script>

        getCatList();
        async function getCatList(){
            showLoder();
            let res = await axios.get('/getCategoryList');
            hideLoder();

            res.data.forEach(function (item, index) {
                let option = `<option class="py-2" value="${item['id']}">${item['categoryName']}</option>`;
                $('#productCatList').append(option);
            });
        }


        async function createProduct(){

            let productName = document.getElementById('productName').value;
            let price = document.getElementById('productPrice').value;
            let quantity = document.getElementById('productQuantity').value;
            let category_id = document.getElementById('productCatList').value;
            let Image = document.getElementById('productImg').files[0];


            if(productName.length === 0 ){
                errorTostr('Please enter product name');
            }else if(price.length === 0 ){
                errorTostr('Please enter product price');
            }else if(category_id.length === 0 ){
                errorTostr('Please select product category');
            }
            else if(quantity.length === 0 ){
                errorTostr('Please enter product quantity');
            }else if(!Image){
                errorTostr('Please select product image');
            }
            else{
                showLoder();
                let formData = new FormData();
                formData.append('productName',productName);
                formData.append('price',price);
                formData.append('quantity',quantity);
                formData.append('category_id',category_id);
                formData.append('Image',Image);

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                let res = await axios.post('{{ route('createProduct') }}',formData,config);
                hideLoder();

                if(res.data['status'] === 'success'){
                    successTostr(res.data['message']);
                    document.getElementById('proviewImg').src = "{{ asset('assets/img/plasholderimg.png') }}";
                    document.getElementById('productCreateModelClose').click();
                    document.getElementById('createProductForm').reset();
                    await getProductList();
                }else{
                    errorTostr(res.data['message']);
                }
            }


        }

    </script>
