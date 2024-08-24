<!-- Open the modal using ID.showModal() method -->
<dialog id="catDeletedModel" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
        <h3 class="text-4xl font-bold text-center text-red-500">Delete!</h3>
        <p class="text-center">Are you sure you want to delete this category? This action cannot be undone.</p>
        <form class="catDeleteModelForm mt-5">
            <input class="w-full border" type="hidden" name="categoryID" id="categoryID">
        </form>
        <div class="modal-action">
        <form method="dialog">
            <!-- if there is a button in form, it will close the modal -->
            <button id="catDeleteModelClose" class="btn">Close</button>
        </form>
        <button onclick="deleteCategory()" class="btn catDeleteBtn">Delete</button>
        </div>
    </div>
</dialog>


<script>
   async function deleteCategory(){

        let categoryID = document.getElementById('categoryID').value
        if(categoryID.length === 0 ){
            errorTostr('Please enter category name');
        }else{
            showLoder();
            let res = await axios.post('{{ route('deleteCategory') }}',{
                categoryID:categoryID
            });

            hideLoder();

            if(res.data['status'] === 'success'){
                successTostr(res.data.message)
                document.getElementById('catDeleteModelClose').click();
                await getCategories();
            }else{
                errorTostr(res.data.message)
            }
        }
        
    }
</script>


