<!-- Open the modal using ID.showModal() method -->
<dialog id="productDeletedModel" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
        <h3 class="text-4xl font-bold text-center text-red-500">Delete!</h3>
        <p class="text-center">Are you sure you want to delete this category? This action cannot be undone.</p>
        <form class="customerDeleteModelForm mt-5">
            <input class="w-full border" type="hidden" id="productID">
            <input class="w-full border" type="hidden" id="oldImgUrl">
        </form>
        <div class="modal-action">
        <form method="dialog">
            <!-- if there is a button in form, it will close the modal -->
            <button id="productDeleteModelClose" class="btn">Close</button>
        </form>
        <button onclick="deleteProduct()" class="btn catDeleteBtn">Delete</button>
        </div>
    </div>
</dialog>


<script>
   async function deleteProduct(){

       let productID = document.getElementById('productID').value;
       let oldImgUrl = document.getElementById('oldImgUrl').value;

        showLoder();

        let res = await axios.post('{{route('deleteProduct')}}', {
            'productID': productID,
            'oldImgUrl': oldImgUrl
        });
        hideLoder();
        if(res.data['status'] === 'success'){
            document.getElementById('productDeleteModelClose').click();
            successTostr(res.data['message']);
            await getProductList();
        }else{
            errorTostr(res.data['message']);
        }

    }
</script>


